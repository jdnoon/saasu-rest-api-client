<?php


namespace Terah\Saasu;

/**
 * Class Item
 *
 * @package Terah\Saasu
 * @property string Notes
 * @property array BuildItems
 * @property integer Id
 * @property string Code
 * @property string Description
 * @property string Type
 * @property boolean IsActive
 * @property boolean IsInventoried
 * @property integer AssetAccountId
 * @property boolean IsSold
 * @property integer SaleIncomeAccountId
 * @property integer SaleTaxCodeId
 * @property integer SaleCoSAccountId
 * @property boolean IsBought
 * @property integer PurchaseExpenseAccountId
 * @property integer PurchaseTaxCodeId
 * @property double MinimumStockLevel
 * @property double StockOnHand
 * @property double CurrentValue
 * @property integer PrimarySupplierContactId
 * @property string PrimarySupplierItemCode
 * @property double DefaultReOrderQuantity
 * @property string LastUpdatedId
 * @property boolean IsVisible
 * @property boolean IsVirtual
 * @property string VType
 * @property double SellingPrice
 * @property boolean IsSellingPriceIncTax
 * @property string CreatedDateUtc
 * @property string LastModifiedDateUtc
 * @property integer LastModifiedBy
 * @property double BuyingPrice
 * @property boolean IsBuyingPriceIncTax
 * @property boolean IsVoucher
 * @property string ValidFrom
 * @property string ValidTo
 * @property array _links
 */
class Item extends Entity
{
    protected $entities = [
        'singular' => 'Item',
        'plural'   => 'Items'
    ];

    protected $fields = [
        'Notes'                    => '',
        'BuildItems'               => [
//            [
//                'Id'          => null,
//                'Code'        => '',
//                'Description' => '',
//                'Quantity'    => null,
//                '_links'      => [
//                ],
//            ],
        ],
        'Id'                       => null,
        'Code'                     => '',
        'Description'              => '',
        'Type'                     => '',
        'IsActive'                 => true,
        'IsInventoried'            => false,
        'AssetAccountId'           => null,
        'IsSold'                   => true,
        'SaleIncomeAccountId'      => null,
        'SaleTaxCodeId'            => null,
        'SaleCoSAccountId'         => null,
        'IsBought'                 => true,
        'PurchaseExpenseAccountId' => null,
        'PurchaseTaxCodeId'        => null,
        'MinimumStockLevel'        => null,
        'StockOnHand'              => null,
        'CurrentValue'             => null,
        'PrimarySupplierContactId' => null,
        'PrimarySupplierItemCode'  => '',
        'DefaultReOrderQuantity'   => null,
        'LastUpdatedId'            => '',
        'IsVisible'                => true,
        'IsVirtual'                => false,
        'VType'                    => '',
        'SellingPrice'             => null,
        'IsSellingPriceIncTax'     => true,
        'CreatedDateUtc'           => '',
        'LastModifiedDateUtc'      => '',
        'LastModifiedBy'           => null,
        'BuyingPrice'              => null,
        'IsBuyingPriceIncTax'      => true,
        'IsVoucher'                => false,
        'ValidFrom'                => '',
        'ValidTo'                  => '',
        '_links'                   => [],
    ];

    public function save()
    {
        throw new \Exception("Save is not available on items at this time. See: https://api.saasu.com/");
    }
}