<?php

namespace Terah\Saasu;

/**
 * Class Attachment
 * @package Terah\Saasu
 *
 * @property LineItem[] LineItems
 * @property string NotesInternal
 * @property string NotesExternal
 * @property Terms Terms
 * @property Attachment[] Attachments
 * @property int TemplateId
 * @property bool SendEmailToContact
 * @property string EmailMessage
 * @property QuickPayment QuickPayment
 * @property int TransactionId
 * @property string LastUpdatedId
 * @property string Currency
 * @property string InvoiceNumber
 * @property string InvoiceType
 * @property string TransactionType
 * @property string Layout
 * @property string Summary
 * @property float TotalAmount
 * @property float TotalTaxAmount
 * @property int IsTaxInc
 * @property float AmountPaid
 * @property float AmountOwed
 * @property float FxRate
 * @property bool AutoPopulateFxRate
 * @property bool RequiresFollowUp
 * @property bool SentToContact
 * @property \DateTime TransactionDate
 * @property int BillingContactId
 * @property string BillingContactFirstName
 * @property string BillingContactLastName
 * @property string BillingContactOrganisationName
 * @property int ShippingContactId
 * @property string ShippingContactFirstName
 * @property string ShippingContactLastName
 * @property string ShippingContactOrganisationName
 * @property \DateTime CreatedDateUtc
 * @property \DateTime LastModifiedDateUtc
 * @property string PaymentStatus
 * @property \DateTime DueDate
 * @property string InvoiceStatus
 * @property string PurchaseOrderNumber
 * @property int PaymentCount
 * @property array Tags
 * @property array _links
 */
class Invoice extends Entity
{
    protected $entities         = [
        'singular'                  => 'Invoice',
        'plural'                    => 'Invoices'
    ];

    protected $fields           = [
        'LineItems'                         => [],
        'NotesInternal'                     => null,
        'NotesExternal'                     => null,
        'Terms'                             => null,
        'Attachments'                       => [],
        'TemplateId'                        => null,
        'SendEmailToContact'                => null,
        'EmailMessage'                      => null,
        'QuickPayment'                      => null,
        'TransactionId'                     => 5093684,
        'LastUpdatedId'                     => 'AAAAAAAKgc=',
        'Currency'                          => 'AUD',
        'InvoiceNumber'                     => 'INV-1123',
        'InvoiceType'                       => 'Tax Invoice',
        'TransactionType'                   => 'S',
        'Layout'                            => 'I',
        'Summary'                           => 'Invoice for order 1123',
        'TotalAmount'                       => 10.45,
        'TotalTaxAmount'                    => null,
        'IsTaxInc'                          => true,
        'AmountPaid'                        => 0.0,
        'AmountOwed'                        => 11.5,
        'FxRate'                            => 1.0,
        'AutoPopulateFxRate'                => false,
        'RequiresFollowUp'                  => false,
        'SentToContact'                     => true,
        'TransactionDate'                   => '2015-01-24T00:00:00',
        'BillingContactId'                  => 1568986,
        'BillingContactFirstName'           => 'Freddy',
        'BillingContactLastName'            => 'Fungus',
        'BillingContactOrganisationName'    => 'Fungal Innovation',
        'ShippingContactId'                 => 10,
        'ShippingContactFirstName'          => 'Big',
        'ShippingContactLastName'           => 'Bob',
        'ShippingContactOrganisationName'   => 'Bobbby Inc',
        'CreatedDateUtc'                    => '2016-06-22T21:35:04.9721648Z',
        'LastModifiedDateUtc'               => '2016-06-23T21:35:04.9721648Z',
        'PaymentStatus'                     => 'U',
        'DueDate'                           => null,
        'InvoiceStatus'                     => 'I',
        'PurchaseOrderNumber'               => 'PO-4456',
        'PaymentCount'                      => 0,
        'Tags'                              => [],
        '_links'                            => [],
    ];
}

class LineItem
{
    /** @var int */
    public $Id                  = null;
    /** @var string  */
    public $Description         = '';
    /** @var int */
    public $AccountId           = null;
    /** @var string */
    public $TaxCode             = '';
    /** @var float */
    public $TotalAmount         = null;
    /** @var float */
    public $Quantity            = null;
    /** @var float  */
    public $UnitPrice           = null;
    /** @var float  */
    public $PercentageDiscount  = null;
    /** @var int  */
    public $InventoryId         = null;
    /** @var string  */
    public $ItemCode            = '';
    /** @var array  */
    public $Tags                = [];
    /** @var array  */
    public $Attributes          = [];
    /** @var array  */
    public $_links              = [];
}

class Terms
{
    /** @var int  */
    public $Type                = null;
    /** @var int  */
    public $Interval            = null;
    /** @var null  */
    public $IntervalType        = null;
    /** @var string  */
    public $TypeEnum            = '';
    /** @var string  */
    public $IntervalTypeEnum    = '';
}

class QuickPayment
{
    /** @var \DateTime */
    public $DatePaid            = null; //	When the payment was made.	date Required
    /** @var \DateTime */
    public $DateCleared         = null; // 	When the payment was cleared.	date
    /** @var int */
    public $BankedToAccountId	= null; // The bank account uid where the payment was banked to.	integer Required
    /** @var float */
    public $Amount	            = null; //The payment amount. It must be less than the invoice total. Maximum 2 decimals.	decimal number Required
    /** @var string */
    public $Reference	        = '';   // Payment reference. It can be used to track cheque #, etc.	string
    /** @var  string */
    public $Summary             = '';  // Brief summary for this payment. Leave this blank to let the system sets this automatically.	string
}
