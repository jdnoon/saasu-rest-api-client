<?php

namespace Terah\Saasu;

use Terah\Saasu\Values\TaxCodeDetail;

use function Terah\Assert\Assert;

/**
 * Class TaxCode
 *
 * @package Terah\Saasu
 */
class TaxCode extends Entity
{
    use EntityFetchOneTrait;
    use EntityFetchTrait;

    protected $singularAttribute    = 'TaxCode';
    protected $pluralAttribute      = 'TaxCodes';

    /**
     * @var array
     */
    protected $filters           = [
        //	Specifies the page number of the result set to return. integer
        'Page'                      => null,
        // Specifies the number of records on each page of results. Maximum page size is 100. Defaults to 25 if not specified. integer
        'PageSize'                  => null,
        // Filter records that are either Active (IsActive=true) or Inactive (IsActive=false). boolean
        'isActive'                  => null,

    ];

    /**
     * @param \stdClass $data
     * @return TaxCodeDetail
     */
    protected function getValueObject(\stdClass $data)
    {
        return new TaxCodeDetail($data);
    }
}


