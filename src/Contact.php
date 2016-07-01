<?php

namespace Terah\Saasu;

use Terah\Saasu\Values\Contact as ContactDetail;

/**
 * Class Contact
 *
 * @package Terah\Saasu
 */
class Contact extends Entity
{
    use EntityFetchOneTrait;
    use EntityFetchTrait;
    use EntityCreateTrait;
    use EntityUpdateTrait;
    use EntityDeleteTrait;

    protected $singularAttribute    = 'Contact';
    protected $pluralAttribute      = 'Contacts';

    /**
     * @var array
     */
    protected $filters          = [
        //	Specifies the page number of the result set to return.	integer.
        'Page'                      => null,
        //	Specifies the number of records on each page of results. Maximum page size is
        // 100. Defaults to 25 if not specified.	integer.
        'PageSize'                  => null,
        //	Filter records with LastModifiedDate greater than or equal to a date in UTC (must also specifify LastModifiedToDate).	date.
        'LastModifiedFromDate'      => null,
        //	Filter records with LastModifiedDate less than or equal to a date in UTC (must also specifify LastModifiedFromDate).	date.
        'LastModifiedToDate'        => null,
        //	Filter records with a given name matching the supplied parameter.	string.
        'GivenName'                 => null,
        //	Filter records with a family name matching the supplied parameter.	string.
        'FamilyName'                => null,
        //	Filter records with a company name matching the supplied parameter.	string.
        'CompanyName'               => null,
        //	Filter records with a company id matching the supplied parameter.	string.
        'CompanyId'                 => null,
        //	Filter records that are either Active (IsActive=true) or Inactive (IsActive=false).	boolean.
        'IsActive'                  => null,
        //	Filter records with that are a customer (IsCustomer=true) or not a customer (IsCustomer=false).	boolean.
        'IsCustomer'                => null,
        //	Filter records with that are a supplier (IsSupplier=true) or not a supplier (IsSupplier=false).	boolean.
        'IsSupplier'                => null,
        //	Filter records with that are a contractor (IsContractor=true) or not a contractor (IsContractor=false).	boolean.
        'IsContractor'              => null,
        //	Filter records with that are a partner (IsPartner=true) or not a partner (IsPartner=false).	boolean.
        'IsPartner'                 => null,
        //	One or more tags that are used to filter the result set by. More tags can be separated with a comma, for example 'tags=tag1,tag2'.	string.
        'Tags'                      => null,
        //	Specifies how to filter when using the supplied tags.Valid values are: requireAny -
        // filter records with ANY ONE of the supplied tags, requireAll -
        // filter records with ALL of the supplied tags, excludeAny -
        // filter records excluding any records with ANY ONE of the specified tags, excludeAll -
        // filter records excluding any records with ALL of the specified tags.	string.
        'TagSelection'              => null,
        //	Filter records with an email address equal to the specified value.	string.
        'Email'                     => null,
        //	Filter records with a Contact Id equal to the specified value.	string.
        'ContactId'                 => null,
    ];

    /**
     * @param \stdClass $data
     * @return ContactDetail
     */
    protected function getValueObject(\stdClass $data)
    {
        return new ContactDetail($data);
    }
}