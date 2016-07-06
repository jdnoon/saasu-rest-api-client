<?php

namespace Terah\Saasu\Values;

/**
 * Class ItemDetail
 *
 * @package Terah\Saasu\Values
 */
class ItemDetail extends RestableValue
{
    /**
     * Custom notes associated with this item.
     * @var string
     */
    public $Notes                    = '';

    /**
     * The items that constitute or form the 'build' of this item.
     * @var BuildItem[]
     */
    public $BuildItems               = [];

    /**
     * The Unique Id/key for the resource.
     * @var int
     */
    public $Id                       = null;

    /**
     * The code for this item.
     * @var string
     */
    public $Code                     = '';

    /**
     * The description for this item.
     * @var string
     */
    public $Description              = '';

    /**
     * The type of this item.
     * Supported types are 'I' = Inventory item, 'C' = Combo item.
     * @var string
     */
    public $Type                     = 'I';

    /**
     * Indicates if the item is active.
     * @var bool
     */
    public $IsActive                 = true;

    /**
     * Indicates if the item is inventoried.
     * @var bool
     */
    public $IsInventoried            = false;

    /**
     * The associated asset account id.
     * @var int
     */
    public $AssetAccountId           = null;

    /**
     * Indicates if the item is sold.
     * @var bool
     */
    public $IsSold                   = true;

    /**
     * The associated sale income account id.
     * @var int
     */
    public $SaleIncomeAccountId      = null;

    /**
     * The associated sale tax code id.
     * @var int
     */
    public $SaleTaxCodeId            = null;

    /**
     * The associated cost of sale account id.
     * @var int
     */
    public $SaleCoSAccountId         = null;

    /**
     * Indicates if the item is bought.
     * @var bool
     */
    public $IsBought                 = true;

    /**
     * The associated purchase expense account id.
     * @var integer
     */
    public $PurchaseExpenseAccountId = null;

    /**
     * The associated purchase tax code id.
     * @var integer
     */
    public $PurchaseTaxCodeId        = null;

    /**
     * The minimum stock level allowed.
     * @var float
     */
    public $MinimumStockLevel        = null;

    /**
     * The current stock on hand.
     * This data is returned only and cannot be added or updated when issuing a POST or PUT.
     * @var float
     */
    public $StockOnHand              = null;

    /**
     * The current value of the item. This data is returned only and cannot be added or updated when issuing a POST or PUT.
     * @var float
     */
    public $CurrentValue             = null;

    /**
     * The primary supplier's contact id (if any).
     * @var int
     */
    public $PrimarySupplierContactId = null;

    /**
     * The primary supplier's item code.
     * @var string
     */
    public $PrimarySupplierItemCode  = '';

    /**
     * The default re-order quantity when the minimum stock level is reached.
     * @var float
     */
    public $DefaultReOrderQuantity   = null;

    /**
     * The unique id generated after an update that is required
     * to be passed in when next updating this resource to ensure consistency.
     * @var string
     */
    public $LastUpdatedId            = '';

    /**
     * Indicates if this item is visible.
     * @var bool
     */
    public $IsVisible                = true;

    /**
     * Indicate if this is a virtual item.
     * @var bool
     */
    public $IsVirtual                = false;

    /**
     * Indicates the 'virtual type' of the item.
     * @var string
     */
    public $VType                    = '';

    /**
     * The selling price of the item.
     * @var float
     */
    public $SellingPrice             = null;

    /**
     * Indicates if the selling price includes tax.
     * @var bool
     */
    public $IsSellingPriceIncTax     = true;

    /**
     * The date and time that the item was created in UTC.
     * @var DateTime
     */
    public $CreatedDateUtc           = '';

    /**
     * The date and time that the item was modified in UTC.
     * @var DateTime
     */
    public $LastModifiedDateUtc      = '';

    /**
     * The user id that last modified this item.
     * @var int
     */
    public $LastModifiedBy           = null;

    /**
     * The buying price of this item.
     * @var float
     */
    public $BuyingPrice              = null;

    /**
     * Indicates if the buying price includes tax.
     * @var bool
     */
    public $IsBuyingPriceIncTax      = true;

    /**
     * Indicates if the item represents a voucher.
     * @var bool
     */
    public $IsVoucher                = false;

    /**
     * If this item is a voucher (IsVoucher = true), this indicates the date and
     * time that the voucher item is valid from.
     * @var DateTime
     */
    public $ValidFrom                = '';

    /**
     * If this item is a voucher (IsVoucher = true), this indicates the date and
     * time that the voucher item is valid to.
     * @var DateTime
     */
    public $ValidTo                  = '';

    /**
     * The number of items currently on order.
     * @var float
     */
    public $OnOrder                  = null;

    /**
     * The number of items currently committed.
     * @var float
     */
    public $Committed                = null;

    /**
     * Hypermedia links.
     * Contains contextual links to possible next actions related to this resource.
     * Only present in responses. This data is not to be sent to the server.
     * Collection ofLink
     * None.
     * @var array
     */
    public $_links                   = [];

    /**
     * @param \stdClass $data
     * @return $this
     */
    public function set(\stdClass $data)
    {
        if ( isset($data->InsertedItemId) )
        {
            $this->Id = $data->InsertedItemId;
            unset($data->InsertedItemId);
        }
        if ( isset($data->BuildItems) && is_array($data->BuildItems) )
        {
            foreach ( $data->BuildItems as $buildItem )
            {
                $this->BuildItems[] = new BuildItem($buildItem);
            }
            unset($data->BuildItems);
        }
        if ( isset($data->CreatedDateUtc) )
        {
            $this->CreatedDateUtc = new DateTime($data->CreatedDateUtc);
            unset($data->CreatedDateUtc);
        }
        if ( isset($data->LastModifiedDateUtc) )
        {
            $this->LastModifiedDateUtc = new DateTime($data->LastModifiedDateUtc);
            unset($data->LastModifiedDateUtc);
        }
        if ( isset($data->ValidFrom) )
        {
            $this->ValidFrom = new DateTime($data->ValidFrom);
            unset($data->ValidFrom);
        }
        if ( isset($data->ValidTo) )
        {
            $this->ValidTo = new DateTime($data->ValidTo);
            unset($data->ValidTo);
        }
        return parent::set($data);
    }
    
}

