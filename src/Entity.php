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

    public function __construct(RestClient $saasu)
    {
        $this->saasu = $saasu;
        (new Assert($this->entities))->keysExist(['singular', 'plural'])->all()->notEmpty("The keys have not been specified for the url segments.");
    }

    public function create(Value $value)
    {
        unset($value->id);
        return $this->save($value);
    }

    public function update(Value $value)
    {
        Assert($value->id)->id();
        return $this->save($value);
    }

    public function delete($id)
    {
        return $this->saasu->method(Client::DELETE)->sendRequest($this->getPlural());
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
     * @param array|null $filter
     *
     * @return object
     */
    public function fetch(array $filter=[])
    {
        $data   = $this->saasu->method(Client::FETCH)->data($filter)->sendRequest($this->getPlural());
        $data   = isset($data[$this->entities['plural']]) ? $data[$this->entities['plural']] : [];
        foreach ( $data as $idx => $item )
        {
            $data[$idx] = $this->getValueObject($item);
        }
        return $data;
    }

    /**
     * @param $id
     * @return Entity
     * @throws \Exception
     */
    public function fetchOne($id)
    {
        Assert($id)->integer("ID must be an integer");
        $data = $this->saasu->method(Client::FETCH)->itemId($id)->sendRequest($this->getSingular());
        return $this->getValueObject($data);
    }

    /**
     * @param string $keyedOn
     * @param string $valueField
     * @param array $filter
     * @return array
     * @throws \Exception
     */
    public function fetchList($keyedOn, $valueField, array $filter=[])
    {
        //(new Assert($this->fields))->keysExist([$keyedOn, $valueField]);
        $result = $this->saasu->method(Client::FETCH)->data($filter)->sendRequest($this->getPlural());
        $result = isset($result[$this->entities['plural']]) ? $result[$this->entities['plural']] : [];
        $data   = [];
        foreach ( $result as $idx => $item )
        {
            $data[$item[$keyedOn]] = $item[$valueField];
        }
        return $data;
    }

    /**
     * @return object
     */
    public function save(Value $value)
    {
        if ( is_null($value->id) )
        {
            $data = $this->saasu->method(Client::INSERT)->data($value)->sendRequest($this->getPlural());
        }
        $data = $this->saasu->method(Client::UPDATE)->data($value)->sendRequest($this->getSingular());
    }

    /**
     * @return string
     */
    public function getSingular()
    {
        return strtolower($this->entities['singular']);
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