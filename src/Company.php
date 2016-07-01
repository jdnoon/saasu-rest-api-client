<?php

namespace Terah\Saasu;
use Terah\Saasu\Values\CompanyDetail;

/**
 * Class Company
 *
 * @package Terah\Saasu
 */
class Company extends Entity
{
    use EntityFetchOneTrait;
    use EntityFetchTrait;
    use EntityCreateTrait;
    use EntityUpdateTrait;
    use EntityDeleteTrait;

    protected $singularAttribute    = 'Company';
    protected $pluralAttribute      = 'Companies';
    /**
     * @var array
     */
    protected $filters           = [
        //	Specifies the page number of the result set to return.	integer	None.
        'Page'                      => null,
        //	Specifies the number of records on each page of results.
        // Maximum page size is 100. Defaults to 25 if not specified.	integer	None.
        'PageSize'                  => null,
        //	Filter records with LastModifiedDate greater than or equal to a
        // date in UTC (must also specify LastModifiedToDate).	date	None.
        'LastModifiedFromDate'      => null,
        //	Filter records with LastModifiedDate less than or equal to a date in
        // UTC (must also specify LastModifiedFromDate).	date	None.
        'LastModifiedToDate'        => null,
        //	Filter records with a company name matching the supplied parameter.	string	None.
        'CompanyName'               => null,
    ];

    /**
     * @param \stdClass $data
     * @return CompanyDetail
     */
    protected function getValueObject(\stdClass $data)
    {
        return new CompanyDetail($data);
    }
}



