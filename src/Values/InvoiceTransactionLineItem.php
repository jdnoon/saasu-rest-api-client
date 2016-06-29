<?php

namespace Terah\Saasu\Values;


/**
 * Class InvoiceTransactionLineItem
 *
 * @package Terah\Saasu\Values
 */
class InvoiceTransactionLineItem extends Value
{
    /**
     * The Id/Key of the line item.
     * @var int
     */
    public $Id                  = null;

    /**
     * Description of the line item.
     * @var string
     */
    public $Description         = '';

    /**
     * The associated account id of the line item.
     * @var int
     */
    public $AccountId           = null;

    /**
     * The tax code associated with this line item.
     * @var string
     */
    public $TaxCode             = '';

    /**
     * Total amount of this line item.
     * @var float
     */
    public $TotalAmount         = null;

    /**
     * Quantity of items for this line item.
     * @var float
     */
    public $Quantity            = null;

    /**
     * Unit price of the item.
     * @var float
     */
    public $UnitPrice           = null;

    /**
     * Percentage discount to apply to this line item.
     * @var float
     */
    public $PercentageDiscount  = null;

    /**
     * The Id of the inventory item for this line item.
     * @var int
     */
    public $InventoryId         = null;

    /**
     * The Inventory Item code for this line item. Not required when inserting a line item.
     * @var string
     */
    public $ItemCode            = '';

    /**
     * List of tags associated with this line item.
     * @var string[]
     */
    public $Tags                = [];

    /**
     * List of attributes associated with this line item.
     * @var ItemAttribute[]
     */
    public $Attributes          = [];

    /**
     * Hypermedia links.
     * Contains contextual links to possible next actions related to this resource.
     * Only present in responses.
     * This data is not to be sent to the server.
     * Collection of Link
     * @var array
     */
    public $_links              = [];
}
