<?php
/**
  * @package Terah\Saasu
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 * @author        Terry Cullen - terry@terah.com.au
 */

namespace Terah\Saasu;

use function Terah\Assert\Assert;
use Terah\Saasu\Values\RestableValue;
use Terah\Saasu\Values\Value;

/**
 * Class Entity
 *
 * @package Terah\Saasu
 */
abstract class Entity
{
    /** @var RestClient */
    protected $saasu        = null;
    protected $entities     = [];
    protected $filters      = [];

    public function __construct(RestClient $saasu)
    {
        $this->saasu = $saasu;
        Assert($this->entities)->keysExist(['singular', 'plural'])->all()->notEmpty("The keys have not been specified for the url segments.");
    }

    /**
     * @param RestableValue $value
     * @return RestableValue
     */
    public function create(RestableValue $value)
    {
        if ( ! empty($value->getId()) )
        {
            $value->setId(null);
        }
        return $this->save($value);
    }

    /**
     * @param RestableValue $value
     * @return RestableValue
     */
    public function update(RestableValue $value)
    {
        Assert($value->getId())->id();
        return $this->save($value);
    }

    /**
     * @param $id
     * @return null|\stdClass|string
     */
    public function delete($id)
    {
        return $this->saasu->method(Client::DELETE)->sendRequest($this->getSingular($id));
    }

    /**
     * @return $this
     */
    public function reset()
    {
        $this->saasu->reset();
        return $this;
    }

    /**
     * @param array $filters
     *
     * @return RestableValue[]
     */
    public function fetch(array $filters=[])
    {
        Assert($this->filters)->keysExist(array_keys($filters));

        $plural                 = $this->entities['plural'];
        $resultObjs             = [];
        $filters['pagesize']    = ! empty($filters['pagesize']) ? $filters['pagesize'] : 25;
        $filters['page']        = ! empty($filters['page']) ? $filters['page'] : 1;
        $maxIterations          = 100; // 2500 records
        $count                  = 0;
        while ( $count < $maxIterations )
        {
            $data           = $this->saasu->method(Client::FETCH)->data($filters)->sendRequest(strtolower($this->entities['plural']));
            $linksData      = $data->_links;
            $data           = isset($data->{$plural}) ? $data->{$plural} : [];
            foreach ( $data as $idx => $item )
            {
                $resultObjs[] = $this->getValueObject($item);
            }
            if ( count($data) < $filters['pagesize'] )
            {
                return $resultObjs;
            }
            foreach ( $linksData as $linkObj )
            {
                if ( $linkObj->rel !== 'next' )
                {
                    continue;
                }
                $urlParts               = (object)parse_url($linkObj->href);
                parse_str($urlParts->query, $query);
                $filters['page']        = (int)$query['page'];
                $filters['pagesize']    = (int)$query['pagesize'];
            }
            $count++;
        }

        return $resultObjs;
    }

    /**
     * @param $id
     * @return RestableValue
     * @throws \Exception
     */
    public function fetchOne($id)
    {
        Assert($id)->integer("ID must be an integer");
        $data = $this->saasu->method(Client::FETCH)->sendRequest($this->getSingular($id));
        return $this->getValueObject($data);
    }

    /**
     * @param string $keyedOn
     * @param string $valueField
     * @param array $filters
     * @return array
     * @throws \Exception
     */
    public function fetchList($keyedOn, $valueField, array $filters=[])
    {
        $results    = $this->fetch($filters);
        $data       = [];
        foreach ( $results as $idx => $item )
        {
            $data[$item->{$keyedOn}] = $item->{$valueField};
        }
        return $data;
    }

    /**
     * @param RestableValue $value
     * @return RestableValue
     */
    public function save(RestableValue $value)
    {
        if ( is_null($value->getId()) )
        {
            $data = $this->saasu->method(Client::INSERT)->setValue($value)->sendRequest($this->getSingular());
            return $value->set($data);
        }
        $data = $this->saasu->method(Client::UPDATE)->setValue($value)->sendRequest($this->getSingular($value->getId()));
        return $value->set($data);
    }

    /**
     * @param null|int $id
     * @return string
     */
    public function getSingular($id=null)
    {
        $idReference = $id ? "/{$id}" : '';
        return strtolower($this->entities['singular']) . $idReference;
    }

    /**
     * @return string
     */
    public function getPlural()
    {
        return strtolower($this->entities['plural']);
    }

    /**
     * @param $data
     * @return Value
     */
    abstract protected function getValueObject(\stdClass $data);

}