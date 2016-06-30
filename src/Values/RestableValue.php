<?php

namespace Terah\Saasu\Values;


abstract class RestableValue extends Value
{
    /**
     * @return integer
     */
    public function getId()
    {
        return $this->Id;
    }

    /**
     * @param $value
     * @return $this
     */
    public function setId($value)
    {
        $this->Id = $value;
        return $this;
    }
}