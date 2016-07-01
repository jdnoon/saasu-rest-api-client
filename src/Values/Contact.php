<?php

namespace Terah\Saasu\Values;

/**
 * Class Contact
 *
 * @package Terah\Saasu\Values
 */
class Contact extends RestableValue
{
    /**
     * Contact's Id in Saasu system.
     * @var int
     */
    public $Id                        = null;

    /**
     * UTC date/time that contact was created in Saasu system.
     * @var DateTime
     */
    public $CreatedDateUtc            = null;

    /**
     * UTC date/time that contact was last modified in Saasu system.
     * @var DateTime
     */
    public $LastModifiedDateUtc       = null;

    /**
     * Identifier used for concurrency checking. Required for update.
     * @var string
     */
    public $LastUpdatedId             = null;

    /**
     * The salutation or title of the contact. Valid values: Mr., Mrs., Ms., Dr., Prof.
     * @var string
     */
    public $Salutation                = null;

    /**
     * The first or given name of the contact.
     * @var string
     */
    public $GivenName                 = null;

    /**
     * The middle initials of the contact.
     * @var null
     */
    public $MiddleInitials            = null;

    /**
     * The last name or surname of the contact.
     * @var string
     */
    public $FamilyName                = null;

    /**
     * Indicates whether the contact is active.
     * @var bool
     */
    public $IsActive                  = true;

    /**
     * Id in Saasu of the Organisation or Company that employs the Contact.
     * @var int
     */
    public $CompanyId                 = null;

    /**
     * Contact's position or role.
     * @var string
     */
    public $PositionTitle             = null;

    /**
     * Url of a website owned by the contact.
     * @var string
     */
    public $WebsiteUrl                = null;

    /**
     * Primary contact number for the contact.
     * @var string
     */
    public $PrimaryPhone              = null;

    /**
     * Home contact number for the contact.
     * @var string
     */
    public $HomePhone                 = null;

    /**
     * The contacts alternate or other phone number.
     * @var string
     */
    public $OtherPhone                = null;

    /**
     * The contact's mobile phone number.
     * @var string
     */
    public $MobilePhone               = null;

    /**
     * The contacts fax number.
     * @var string
     */
    public $Fax                       = null;

    /**
     * The contact's email address.
     * @var string
     */
    public $EmailAddress              = null;

    /**
     * Is used as an Account or Contact reference for this person if they are a supplier or customer. This is your reference or their reference depending on how you prefer to use this field.
     * @var string
     */
    public $ContactId                 = null;

    /**
     * This is another Contact record in Saasu and is used to represent the Account Manager, Salesperson or similar for this Contact record.
     * @var int
     */
    public $ContactManagerId          = null;

    /**
     * Direct deposit details for the contact.
     * @var DirectDepositDetails
     */
    public $DirectDepositDetails      = null;

    /**
     * Cheque details for the contact.
     * @var ChequeDetails
     */
    public $ChequeDetails             = null;

    /**
     * Can be used to manage extra, customer specific information.
     * @var string
     */
    public $CustomField1              = null;

    /**
     * A second field that can be used to manage extra, customer specific information.
     * @var string
     */
    public $CustomField2              = null;

    /**
     * Twitter handle/id for this contact. This information is for your reference and is not used in Saasu at present.
     * @var string
     */
    public $TwitterId                 = null;

    /**
     * Skype name for this contact. This information is for your reference and is not used in Saasu at present.
     * @var string
     */
    public $SkypeId                   = null;

    /**
     * LinkedIn profile name for this contact. This information is for your reference and is not used in Saasu at present.
     * @var string
     */
    public $LinkedInProfile           = null;

    /**
     * Determines whether statements will be automatically sent to this contact if they have any outstanding receivables.
     * @var bool
     */
    public $AutoSendStatement         = true;

    /**
     * Indicates if the contact is a partner.
     * @var bool
     */
    public $IsPartner                 = false;

    /**
     * Indicates if the contact is a customer.
     * @var bool
     */
    public $IsCustomer                = false;

    /**
     * Indicates if the contact is a supplier.
     * @var bool
     */
    public $IsSupplier                = false;

    /**
     * Indicates if the contact is a contractor. This is important if you need to use the taxable payment reporting feature.
     * @var bool
     */
    public $IsContractor              = false;

    /**
     * Indicates the list of tags associated with this contact.	Collection of string
     * @var string[]
     */
    public $Tags                      = [];

    /**
     * Default discount to be applied when creating a sale for this particular contact.
     * @var float
     */
    public $DefaultSaleDiscount       = null;

    /**
     * Default discount to be applied when creating a purchase for this particular contact.	decimal number	None.
     * @var float
     */
    public $DefaultPurchaseDiscount   = null;

    /**
     * The user id of the last person to modify this contact record.
     * @var integer
     */
    public $LastModifiedByUserId      = null;

    /**
     * Bpay details for the contact.
     * @var BpayDetails
     */
    public $BpayDetails               = null;

    /**
     * The postal or mailing address for the contact.
     * @var Address
     */
    public $PostalAddress             = null;

    /**
     * E.g. "Shipping Address".
     * @var Address
     */
    public $OtherAddress              = null;

    /**
     * Used for setting the due date/expiry date when creating sales invoices, orders and quotes for contacts.
     * @var TradingTerms
     */
    public $SaleTradingTerms          = null;

    /**
     * Used for setting the due date/expiry date when creating purchase invoices, orders and quotes for contacts.
     * @var TradingTerms
     */
    public $PurchaseTradingTerms      = null;

    /**
     * Hypermedia links.
     * Contains contextual links to possible next actions related to this resource.
     * Only present in responses. This data is not to be sent to the server.
     * Collection ofLink
     * @var array
     */
    public $_links                    = [];

    /**
     * @param \stdClass $data
     * @return $this
     */
    public function set(\stdClass $data)
    {
        if ( isset($data->InsertedContactId) )
        {
            $this->setId($data->InsertedContactId);
            unset($data->InsertedContactId);
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
        if ( isset($data->DirectDepositDetails) )
        {
            $this->DirectDepositDetails = new DirectDepositDetails($data->DirectDepositDetails);
            unset($data->DirectDepositDetails);
        }
        if ( isset($data->ChequeDetails) )
        {
            $this->ChequeDetails = new ChequeDetails($data->ChequeDetails);
            unset($data->ChequeDetails);
        }
        if ( isset($data->Tags ) )
        {
            $this->Tags  = $data->Tags;
            unset($data->Tags);
        }
        if ( isset($data->BpayDetails ) )
        {
            $this->BpayDetails  = new BpayDetails($data->BpayDetails);
            unset($data->BpayDetails);
        }
        if ( isset($data->PostalAddress ) )
        {
            $this->PostalAddress  = new Address($data->PostalAddress);
            unset($data->PostalAddress);
        }
        if ( isset($data->OtherAddress ) )
        {
            $this->OtherAddress  = new Address($data->OtherAddress);
            unset($data->OtherAddress);
        }
        if ( isset($data->SaleTradingTerms ) )
        {
            $this->SaleTradingTerms  = new TradingTerms($data->SaleTradingTerms);
            unset($data->SaleTradingTerms);
        }
        if ( isset($data->PurchaseTradingTerms ) )
        {
            $this->PurchaseTradingTerms  = new TradingTerms($data->PurchaseTradingTerms);
            unset($data->PurchaseTradingTerms);
        }
        return parent::set($data);
    }
}
