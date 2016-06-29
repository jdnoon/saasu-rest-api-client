<?php

namespace Terah\Saasu\Values;


/**
 * Class ItemAttribute
 *
 * @package Terah\Saasu\Values
 */
class ItemAttribute extends Value
{
    /**
     * 	The Id/Key of the attribute.
     * @var integer
     */
    public $AttributeId     = null;

    /**
     * Name of the attribute.
     * @var string
     */
    public $Name	        = '';

    /**
     * Value of the attribute.
     * @var string
     */
    public $Value	        = '';
}