<?php

namespace Terah\Saasu;

/**
 * Class Contact
 *
 * @package Terah\Saasu
 *
 * @property integer Id
 * @property string  CreatedDateUtc
 * @property string  LastModifiedDateUtc
 * @property string  LastUpdatedId
 * @property string  Salutation
 * @property string  GivenName
 * @property null    MiddleInitials
 * @property string  FamilyName
 * @property boolean IsActive
 * @property integer CompanyId
 * @property string  PositionTitle
 * @property null    WebsiteUrl
 * @property string  PrimaryPhone
 * @property null    HomePhone
 * @property null    OtherPhone
 * @property null    MobilePhone
 * @property null    Fax
 * @property null    EmailAddress
 * @property string  ContactId
 * @property null    ContactManagerId
 * @property DirectDepositDetails   DirectDepositDetails
 * @property ChequeDetails   ChequeDetails
 * @property string  CustomField1
 * @property string  CustomField2
 * @property string  TwitterId
 * @property string  SkypeId
 * @property string  LinkedInProfile
 * @property boolean AutoSendStatement
 * @property boolean IsPartner
 * @property boolean IsCustomer
 * @property boolean IsSupplier
 * @property boolean IsContractor
 * @property array   Tags
 * @property null    DefaultSaleDiscount
 * @property null    DefaultPurchaseDiscount
 * @property integer LastModifiedByUserId
 * @property BpayDetails   BpayDetails
 * @property PostalAddress   PostalAddress
 * @property OtherAddress   OtherAddress
 * @property SaleTradingTerms   SaleTradingTerms
 * @property PurchaseTradingTerms   PurchaseTradingTerms
 * @property array   _links
 */
class Contact extends Entity
{
    protected $entities = [
        'singular' => 'contact',
        'plural'   => 'contacts'
    ];

    protected $fields = [
        'Id'                        => null,
        'CreatedDateUtc'            => '',
        'LastModifiedDateUtc'       => '',
        'LastUpdatedId'             => '',
        'Salutation'                => '',
        'GivenName'                 => '',
        'MiddleInitials'            => null,
        'FamilyName'                => '',
        'IsActive'                  => true,
        'CompanyId'                 => null,
        'PositionTitle'             => '',
        'WebsiteUrl'                => null,
        'PrimaryPhone'              => '',
        'HomePhone'                 => null,
        'OtherPhone'                => null,
        'MobilePhone'               => null,
        'Fax'                       => null,
        'EmailAddress'              => null,
        'ContactId'                 => '',
        'ContactManagerId'          => null,
        'DirectDepositDetails'      => null,
        'ChequeDetails'             => null,
        'CustomField1'              => '',
        'CustomField2'              => '',
        'TwitterId'                 => '',
        'SkypeId'                   => '',
        'LinkedInProfile'           => '',
        'AutoSendStatement'         => true,
        'IsPartner'                 => false,
        'IsCustomer'                => false,
        'IsSupplier'                => false,
        'IsContractor'              => false,
        'Tags'                      => [],
        'DefaultSaleDiscount'       => null,
        'DefaultPurchaseDiscount'   => null,
        'LastModifiedByUserId'      => null,
        'BpayDetails'               => null,
        'PostalAddress'             => null,
        'OtherAddress'              => null,
        'SaleTradingTerms'          => null,
        'PurchaseTradingTerms'      => null,
        '_links'                    => [],
    ];
}

class ChequeDetails
{
    public $AcceptCheque            = false;
    public $ChequePayableTo         = null;
}

class BpayDetails
{
    public $BillerCode              = '';
    public $CRN                     = '';
}

class DirectDepositDetails
{
    public $AcceptDirectDeposit     = true;
    public $AccountName             = '';
    public $AccountBSB              = '';
    public $AccountNumber           = '';
}

class SaleTradingTerms
{
    public $TradingTermsType        = null;
    public $TradingTermsInterval    = null;
    public $TradingTermsIntervalType= null;
}

class PurchaseTradingTerms extends SaleTradingTerms
{
}


class PostalAddress
{
    public $Street                  = '';
    public $City                    = '';
    public $State                   = '';
    public $Postcode                = '';
    public $Country                 = '';
}


class OtherAddress extends PostalAddress
{
}

