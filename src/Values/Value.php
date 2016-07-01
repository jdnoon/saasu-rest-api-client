<?php

namespace Terah\Saasu\Values;

use function Terah\Assert\Assert;

/**
 * Class Value
 *
 * @package Terah\Saasu\Values
 */
abstract class Value
{
    //protected $reflectionClass = null;
    /**
     * Value constructor.
     *
     * @param \stdClass $data
     */
    public function __construct(\stdClass $data)
    {
        $this->set($data);
    }

    /**
     * @param \stdClass $data
     * @return $this
     */
    public function set(\stdClass $data)
    {
        foreach ( $data as $field => $value )
        {
            if ( is_scalar($value) )
            {
                $this->{$field} = $value;
                unset($data->{$field});
                continue;
            }
        }
        if ( ! empty($data->_links) )
        {
            $this->_links = $data->_links;
            unset($data->{$field});
        }
        if ( ! empty($data->LastModified) && is_string($data->LastModified) )
        {
            $this->LastModified = new DateTime($this->LastModified);
        }
        return $this;
    }
//
//    /**
//     * @param $name
//     * @return array
//     */
//    protected function getFieldType($name)
//    {
//        if ( is_null($this->reflectionClass) )
//        {
//            $this->reflectionClass = new \ReflectionClass($this);
//        }
//        $property = $this->reflectionClass->getProperty($name);
//        if ( ! $property )
//        {
//            return ['', false];
//        }
//        $docBlock = $property->getDocComment();
//        if ( ! $docBlock )
//        {
//            return ['', false];
//        }
//        $docBlock = explode("\n", $docBlock);
//        foreach ( $docBlock as $line )
//        {
//            if ( stripos($line, '@var') === false )
//            {
//                continue;
//            }
//            if ( preg_match('/^@var +([a-zA-z\[\]]+)/', $line, $matches) )
//            {
//                return [$matches, true];
//            }
//        }
//        return ['', false];
//    }

    /**
     * @return bool
     */
    public function validate()
    {
        return true;
    }
}