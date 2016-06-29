<?php

namespace Terah\Saasu\Values;


/**
 * Class FileSettings
 *
 * @package Terah\Saasu\Values
 */
class FileSettings extends Value
{
    /**
     * This setting indicates whether sale amounts should include tax by default. Default is true
     * @var bool
     */
    public $SaleAmountsIncludeTax      = true;

    /**
     * This setting indicates whether purchase amounts should include tax by default. Default is true.
     * @var bool
     */
    public $PurchaseAmountsIncludeTax  = true;

    /**
     * Hypermedia links.
     * Contains contextual links to possible next actions related to this resource.
     * Only present in responses.
     * This data is not to be sent to the server.
     * Collection of Link
     * @var array
     */
    public $_links                     =  [];
}