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
 * @property array   DirectDepositDetails
 * @property array   ChequeDetails
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
 * @property array   BpayDetails
 * @property array   PostalAddress
 * @property array   OtherAddress
 * @property array   SaleTradingTerms
 * @property array   PurchaseTradingTerms
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
        'DirectDepositDetails'      => [
            'AcceptDirectDeposit'       => true,
            'AccountName'               => '',
            'AccountBSB'                => '',
            'AccountNumber'             => '',
        ],
        'ChequeDetails'             => [
            'AcceptCheque'              => false,
            'ChequePayableTo'           => null,
        ],
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
        'BpayDetails'               => [
            'BillerCode'                => '',
            'CRN'                       => '',
        ],
        'PostalAddress'             => [
            'Street'                    => '',
            'City'                      => '',
            'State'                     => '',
            'Postcode'                  => '',
            'Country'                   => '',
        ],
        'OtherAddress'              => [
            'Street'                    => '',
            'City'                      => '',
            'State'                     => '',
            'Postcode'                  => '',
            'Country'                   => '',
        ],
        'SaleTradingTerms'          => [
            'TradingTermsType'          => null,
            'TradingTermsInterval'      => null,
            'TradingTermsIntervalType'  => null,
        ],
        'PurchaseTradingTerms'      => [
            'TradingTermsType'         => null,
            'TradingTermsInterval'     => null,
            'TradingTermsIntervalType' => null,
        ],
        '_links'                    => [],
    ];

    public function __construct(Client $saasu)
    {

    }
}

class DirectDepositDetails
{
    protected $fields = [
        'AcceptDirectDeposit'       => true,
        'AccountName'               => '',
        'AccountBSB'                => '',
        'AccountNumber'             => '',
    ];
}