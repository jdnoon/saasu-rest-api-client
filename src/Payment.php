<?php

namespace Terah\Saasu;

/**
 * Class Attachment
 * @package Terah\Saasu
 *
 * @property string Notes
 * @property PaymentItem[] PaymentItems
 * @property int TransactionId
 * @property \DateTime TransactionDate
 * @property string TransactionType
 * @property int PaymentAccountId
 * @property float TotalAmount
 * @property float FeeAmount
 * @property string Summary
 * @property string Reference
 * @property \DateTime ClearedDate
 * @property string Currency
 * @property bool AutoPopulateFxRate
 * @property float FxRate
 * @property \DateTime CreatedDateUtc
 * @property \DateTime LastModifiedDateUtc
 * @property int LastUpdatedId
 * @property bool RequiresFollowUp
 * @property array _links
 */
class FileIdentity extends Entity
{
    protected $entities         = [
        'singular'                  => 'Company',
        'plural'                    => 'Companies'
    ];

    protected $fields               = [
        'Notes'                             =>  '',
        'PaymentItems'                      =>  [],
        'TransactionId'                     =>  null,
        'TransactionDate'                   =>  '',
        'TransactionType'                   =>  '',
        'PaymentAccountId'                  =>  null,
        'TotalAmount'                       =>  0,
        'FeeAmount'                         =>  0,
        'Summary'                           =>  '',
        'Reference'                         =>  '',
        'ClearedDate'                       =>  null,
        'Currency'                          =>  'AUD',
        'AutoPopulateFxRate'                =>  false,
        'FxRate'                            =>  0,
        'CreatedDateUtc'                    =>  null,
        'LastModifiedDateUtc'               =>  null,
        'LastUpdatedId'                     =>  null,
        'RequiresFollowUp'                  =>  false,
        '_links'                            =>  []
    ];
}

class PaymentItem
{
    /** @var int */
    public $InvoiceTransactionId        = null;
    /** @var float */
    public $AmountPaid                  = null;
}
