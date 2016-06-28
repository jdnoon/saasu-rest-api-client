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

use Terah\Assert\Assert;

class Entity  implements \JsonSerializable
{
    protected $saasu        = null;
    protected $fields       = [];
    protected $entities     = [];
    protected $dirty        = [];

    public function __construct(Client $saasu)
    {
        $this->saasu = $saasu;
        (new Assert($this->entities))->keysExist(['singular', 'plural'])->all()->notEmpty("The keys have not been specified for the url segments.");
    }

    /**
     * @param int $id
     * @return Entity
     */
    public function load($id)
    {
        (new Assert($id))->integer("ID must be null or integer");
        $data = $this->saasu->method(Client::FETCH)->itemId($id)->sendRequest($this->getSingular());
        return $this->hydrate($data)->reset();
    }

    /**
     * @param array $data
     * @return $this
     */
    public function hydrate(array $data)
    {
        foreach ( $data as $field => $value )
        {
            $this->set($field, $value);
        }
        return $this;
    }

    /**
     * @param array $data
     * @return Entity
     */
    public function spawn(array $data)
    {
        $spawn = clone $this;
        return $spawn->reset()->hydrate($data);
    }

    /**
     * @return $this
     */
    public function reset()
    {
        $this->dirty = [];
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
        $data = $this->saasu->method(Client::FETCH)->data($filter)->sendRequest($this->getPlural());
        $data = isset($data[$this->entities['plural']]) ? $data[$this->entities['plural']] : [];
        foreach ( $data as $idx => $item )
        {
            $data[$idx] = $this->spawn($item);
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
        (new Assert($id))->integer("ID must be null or integer");
        $data = $this->saasu->method(Client::FETCH)->itemId($id)->sendRequest($this->getSingular());
        return $this->spawn($data);
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
        (new Assert($this->fields))->keysExist([$keyedOn, $valueField]);
        $result = $this->saasu->method(Client::FETCH)->data($filter)->sendRequest($this->getPlural());
        $result = isset($result[$this->entities['plural']]) ? $result[$this->entities['plural']] : [];
        $data   = [];
        foreach ( $result as $idx => $item )
        {
            $data[$item[$keyedOn]] = $item[$valueField];
        }
        return $data;
    }

    public function isUnchanged()
    {
        return empty($this->dirty);
    }

    /**
     * @return object
     */
    public function save()
    {
        $data   = $this->get();
        if ( is_null($data['id']) )
        {
            $data = $this->saasu->method(Client::INSERT)->data($data)->sendRequest($this->getPlural());
        }
        $data = $this->saasu->method(Client::UPDATE)->itemId($data['id'])->data($data)->sendRequest($this->getSingular());
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
     * @param string|array $name
     * @param mixed $value
     *
     * @return $this
     */
    public function set($name, $value=null)
    {
        if ( is_array($name) )
        {
            foreach ( $name as $key => $value )
            {
                $this->set($key, $value);
            }
        }
        (new Assert($this->fields))->keyExists($name);
        if ( $this->fields[$name] !== $value )
        {
            $this->dirty[$name] = [$this->fields[$name], $value];
            $this->fields[$name] = $value;
        }
        return $this;
    }

    public function __set($name, $value)
    {
        return $this->set($name, $value);
    }

    public function get($name=null)
    {
        if ( is_null($name) )
        {
            return $this->fields;
        }
        (new Assert($this->fields))->keyExists($name);
        return  $this->fields[$name];
    }

    public function __get($name)
    {
        return $this->get($name);
    }

    public function jsonSerialize()
    {
        return json_encode($this->fields);
    }

}