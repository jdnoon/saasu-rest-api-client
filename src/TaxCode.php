<?php

namespace Terah\Saasu;

/**
 * Class TaxCode
 *
 * @package Terah\Saasu
 *
 * @property string Notes
 * @property integer Id
 * @property string Code
 * @property string Name
 * @property double Rate
 * @property integer PostingAccountId
 * @property boolean IsSale
 * @property boolean IsPurchase
 * @property boolean IsPayroll
 * @property boolean IsInbuilt
 * @property boolean IsShared
 * @property boolean IsActive
 * @property string CreatedDateUtc
 * @property string LastModifiedDateUtc
 * @property integer LastModifiedByUserId
 * @property string LastUpdatedId
 * @property array _links
 */
class TaxCode extends Entity
{
    protected $entities = [
        'singular' => 'TaxCode',
        'plural'   => 'TaxCodes'
    ];

    protected $fields = [
        'Notes'                => '',
        'Id'                   => null,
        'Code'                 => '',
        'Name'                 => '',
        'Rate'                 => null,
        'PostingAccountId'     => null,
        'IsSale'               => true,
        'IsPurchase'           => false,
        'IsPayroll'            => true,
        'IsInbuilt'            => false,
        'IsShared'             => true,
        'IsActive'             => true,
        'CreatedDateUtc'       => '',
        'LastModifiedDateUtc'  => '',
        'LastModifiedByUserId' => null,
        'LastUpdatedId'        => '',
        '_links'               => [],
    ];

}