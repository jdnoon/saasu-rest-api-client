<?php

namespace Terah\Saasu\Values;

/**
 * Class Address
 * @package Terah\Saasu\Values
 */
class Address extends Value
{
    /**
     * Street number and name.
     * @var string
     */
    public $Street                  = '';
    
    /**
     * City.
     * @var string
     */
    public $City                    = '';
    
    /**
     * State.
     * @var string
     */
    public $State                   = '';

    /**
     * Postcode.
     * @var string
     */
    public $Postcode                = '';

    /**
     * Country.
     * @var string
     */
    public $Country                 = '';
}
