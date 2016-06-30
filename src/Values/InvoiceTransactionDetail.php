<?php

namespace Terah\Saasu\Values;

/**
 * Class InvoiceTransactionDetail
 *
 * @package Terah\Saasu\Values
 */
class InvoiceTransactionDetail extends RestableValue
{
    /**
     * The line items associated with this invoice.
     * Collection of InvoiceTransactionLineItem
     * Required
     * @var InvoiceTransactionLineItem[]
     */
    public $LineItems                        = [];

    /**
     * Textual notes set by the system.
     * @var string
     */
    public $NotesInternal                    = '';

    /**
     * Textual notes set by the user.
     * @var null
     */
    public $NotesExternal                    = '';

    /**
     * The trading terms of the invoice.
     * @var TradingTerms
     */
    public $Terms                            = null;

    /**
     * List of attachments associated with this invoice.
     * This data is returned only and cannot be added or updated when issuing a POST or PUT.
     * Collection of FileAttachmentInfo
     * @var FileAttachmentInfo[]
     */
    public $Attachments                      = [];

    /**
     * The Id/key of the template (if any) associated with this invoice.
     * @var integer
     */
    public $TemplateId                       = null;

    /**
     * Instruct the system to send an email to the contact as part of the insert/update.
     * @var bool
     */
    public $SendEmailToContact               = false;

    /**
     * The Email message to send to the contact if instructed.
     * Note: This is only applicable when updating (PUT) or inserting (POST) a transaction and is not returned when making a GET request.
     * @var Email
     */
    public $EmailMessage                     = null;

    /**
     * Payment to be applied to this invoice.
     * Quickpayments can only be inserted/added via a HTTP POST request.
     * Updates via HTTP PUT are not support.
     * Note: This is only applicable when updating (PUT) or inserting (POST) a transaction and is not returned when making a GET request.
     * @var InvoiceQuickPaymentDetail
     */
    public $QuickPayment                     = null;

    /**
     * The Id/key of the invoice/transaction.
     * This data is returned only and cannot be added or updated when issuing a POST or PUT.
     * @var int
     */
    public $TransactionId                    = null;

    /**
     * A data field used to check concurrency when performing updates.
     * This data is returned only and used for concurrency checking when performing an update/PUT.
     * @var string
     */
    public $LastUpdatedId                    = '';

    /**
     * The currency code of the amounts. Eg. AUD.
     * @var string
     */
    public $Currency                         = 'AUD';

    /**
     * Invoice number.
     * Use a value of <Auto Number> to automatically generate an invoice number.
     * @var string
     */
    public $InvoiceNumber                    = '';

    /**
     * Available types are:
     * "Pre-Quote Opportunity", "Quote" , "Purchase Order",
     * "Sale Order", "Tax Invoice", "Adjustment Note",
     * "RCT Invoice", "Money In (Income)",
     * "Money Out (Expense)".
     * @var string
     */
    public $InvoiceType                      = 'Tax Invoice';

    /**
     * The transaction type of the invoice.
     * Supported types are: 'S' = sale, 'P' = purchase, 'SP' = sale payment, 'PP' = purchase payment.
     * @var string
     */
    public $TransactionType                  = 'S';

    /**
     * The Layout of the invoice.
     * I = Item Sale, S = Service Sale.
     * @var string
     */
    public $Layout                           = 'I';

    /**
     * Invoice summary.
     * @var string
     */
    public $Summary                          = '';

    /**
     * Total amount of the invoice.
     * @var float
     */
    public $TotalAmount                      = null;

    /**
     * Total tax amount of the invoice.
     * @var null
     */
    public $TotalTaxAmount                   = null;

    /**
     * Indicates if tax is included in the amounts.
     * On an invoice insert or update, if this element is not included or specified, then false is assumed.
     * @var bool
     */
    public $IsTaxInc                         = false;

    /**
     * Total amount paid.
     * @var float
     */
    public $AmountPaid                       = 0.0;

    /**
     * Total amount owed.
     * @var float
     */
    public $AmountOwed                       = 11.5;

    /**
     * FXRate (Foreign exchange rate) applied to this invoice.
     * @var float
     */
    public $FxRate                           = 1.0;

    /**
     * Determines whether the FxRate is automatically populated using the Fx feed.
     * @var bool
     */
    public $AutoPopulateFxRate               = false;

    /**
     * Indicates whether the invoice requires follow up.
     * @var bool
     */
    public $RequiresFollowUp                 = false;

    /**
     * Indicates whether the invoice was sent to the contact.
     * @var bool
     */
    public $SentToContact                    = true;

    /**
     * Date of this transaction.
     * @var DateTime
     */
    public $TransactionDate                  = '';

    /**
     * The Id/key of the billing contact.
     * @var int
     */
    public $BillingContactId                 = null;

    /**
     * Billing contact first name.
     * This data is returned only and cannot be added or updated when issuing a POST or PUT.
     * @var string
     */
    public $BillingContactFirstName          = '';

    /**
     * Billing contact last name.
     * This data is returned only and cannot be added or updated when issuing a POST or PUT.
     * @var string
     */
    public $BillingContactLastName           = '';

    /**
     * Billing contact organisation name.
     * This data is returned only and cannot be added or updated when issuing a POST or PUT.
     * @var string
     */
    public $BillingContactOrganisationName   = '';

    /**
     * The Id/key of the shipping contact.
     * @var int
     */
    public $ShippingContactId                = null;

    /**
     * Shipping contact first name.
     * This data is returned only and cannot be added or updated when issuing a POST or PUT.
     * @var string
     */
    public $ShippingContactFirstName         = '';

    /**
     * Shipping contact last name.
     * This data is returned only and cannot be added or updated when issuing a POST or PUT.
     * @var string
     */
    public $ShippingContactLastName          = '';

    /**
     * Shipping contact organisation name.
     * This data is returned only and cannot be added or updated when issuing a POST or PUT.
     * @var string
     */
    public $ShippingContactOrganisationName  = '';

    /**
     * The date and time this resource was created in UTC.
     * This data is returned only and cannot be added or updated when issuing a POST or PUT.
     * @var DateTime
     */
    public $CreatedDateUtc                   = '';

    /**
     * The date and time this resource was last modified in UTC.
     * This data is returned only and cannot be added or updated when issuing a POST or PUT.
     * @var DateTime
     */
    public $LastModifiedDateUtc              = '';

    /**
     * The payment status of this invoice.
     * Supported types are: 'A' = all, 'P' = paid, 'U' = unpaid.
     * This data is returned only and cannot be added or updated when issuing a POST or PUT.
     * @var string
     */
    public $PaymentStatus                    = 'U';

    /**
     * The date that this invoice is due.
     * @var DateTime
     */
    public $DueDate                          = null;

    /**
     * Not required for inserting/adding an invoice as it is determined by the "InvoiceType'.
     * Indicator specifying: Q = Quote, O = Order, I = Invoice.
     * Note: This field is deprecated (is readonly) and is inferred from InvoiceType.
     * It is here for backwards compatibility only.
     * This data is returned only and cannot be added or updated when issuing a POST or PUT.
     * @var string
     */
    public $InvoiceStatus                    = '';

    /**
     * The purchase order number.
     * @var string
     */
    public $PurchaseOrderNumber              = '';

    /**
     * The number of payments applied (if any).
     * This data is returned only and cannot be added or updated when issuing a POST or PUT.
     * @var int
     */
    public $PaymentCount                     = 0;

    /**
     * List of tags associated with this resource.	Collection of string
     * @var string[]
     */
    public $Tags                             = [];

    /**
     * Hypermedia links.
     * Contains contextual links to possible next actions related to this resource.
     * Only present in responses.
     * This data is not to be sent to the server.
     * Collection ofLink
     * @var array
     */
    public $_links                           = [];

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->TransactionId;
    }

    /**
     * @param $value
     * @return $this
     */
    public function setId($value)
    {
        $this->TransactionId = $value;
        return $this;
    }

    /**
     * @param \stdClass $data
     * @return $this
     */
    public function set(\stdClass $data)
    {
        parent::__construct($data);
        if ( isset($data->InsertId) )
        {
            $this->TransactionId = $data->InsertId;
        }
        if ( isset($data->LineItems) && is_array($data->LineItems) )
        {
            foreach ( $data->LineItems as $lineItem )
            {
                $this->LineItems[] = new InvoiceTransactionLineItem($lineItem);
            }
        }
        if ( isset($data->Terms ) )
        {
            $this->Terms  = new TradingTerms($data->Terms);
        }
        if ( isset($data->Attachments) && is_array($data->Attachments) )
        {
            foreach ( $data->Attachments as $attachment )
            {
                $this->Attachments[] = new FileAttachmentInfo($attachment);
            }
        }
        if ( isset($data->CreatedDateUtc) )
        {
            $this->CreatedDateUtc = new DateTime($data->CreatedDateUtc);
        }
        if ( isset($data->LastModifiedDateUtc) )
        {
            $this->LastModifiedDateUtc = new DateTime($data->LastModifiedDateUtc);
        }
        return $this;
    }
}

