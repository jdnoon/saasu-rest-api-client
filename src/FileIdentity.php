<?php

namespace Terah\Saasu;

/**
 * Class Attachment
 * @package Terah\Saasu
 *
 * @property string Name
 * @property string FullLegalName
 * @property string TradingNameOrAlternativeBrandName
 * @property string BusinessIdentifier
 * @property string CompanyIdentifier
 * @property string PrimaryPhone
 * @property string Website
 * @property string Email
 * @property string Street
 * @property string City
 * @property string State
 * @property string PostCode
 * @property string Country
 * @property string Zone
 * @property string CurrencyCode
 * @property FileSettings FileSettings
 * @property array _links
 */
class FileIdentity extends Entity
{
    protected $entities         = [
        'singular'                  => 'Company',
        'plural'                    => 'Companies'
    ];

    protected $fields           = [
        'Name'                              =>  '',
        'FullLegalName'                     =>  '',
        'TradingNameOrAlternativeBrandName' =>  '',
        'BusinessIdentifier'                =>  '',
        'CompanyIdentifier'                 =>  '',
        'PrimaryPhone'                      =>  '',
        'Website'                           =>  '',
        'Email'                             =>  '',
        'Street'                            =>  '',
        'City'                              =>  '',
        'State'                             =>  '',
        'PostCode'                          =>  '',
        'Country'                           =>  '',
        'Zone'                              =>  '',
        'CurrencyCode'                      =>  null,
        'FileSettings'                      =>  null,
        '_links'                            =>  []
    ];
}

class FileSettings
{
    public $SaleAmountsIncludeTax      = true;
    public $PurchaseAmountsIncludeTax  = true;
    public $_links                     =  [];
}


