<?php

namespace Terah\Saasu;

/**
 * Class Attachment
 * @package Terah\Saasu
 *
 * @property int Id
 * @property string Name
 * @property string Abn
 * @property string Website
 * @property string LastUpdatedId
 * @property string LongDescription
 * @property string LogoUrl
 * @property string TradingName
 * @property string CompanyEmail
 * @property \DateTime LastModifiedDateUtc
 * @property \DateTime CreatedDateUtc
 * @property int LastModifiedByUserId
 * @property array _links
 */
class Company extends Entity
{
    protected $entities         = [
        'singular'                  => 'Company',
        'plural'                    => 'Companies'
    ];

    protected $fields           = [
        'Id'                        =>  null,
        'Name'                      =>  '',
        'Abn'                       =>  '',
        'Website'                   =>  '',
        'LastUpdatedId'             =>  '',
        'LongDescription'           =>  '',
        'LogoUrl'                   =>  '',
        'TradingName'               =>  '',
        'CompanyEmail'              =>  '',
        'LastModifiedDateUtc'       =>  null,
        'CreatedDateUtc'            =>  null,
        'LastModifiedByUserId'      =>  null,
        '_links'                    =>  []
    ];
}



