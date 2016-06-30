<?php

namespace Terah\Saasu;
use Terah\Saasu\Values\CompanyDetail;

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
    /**
     * @var array
     */
    protected $entities         = [
        'singular'                  => 'Company',
        'plural'                    => 'Companies'
    ];

    /**
     * @var array
     */
    protected $filters           = [
        //	The Web Service access key for this user and file which allows access
        // to the API for the associated file (found in File - Settings).
        // Using OAuth authentication mechanism is the preferred method to allow API access.
        //string	Optional. Legacy authentication method and only required if not using OAuth.
        // OAuth is preferred.
        'WsAccessKey'               => null,
        //	Specifies the file id of the file to perform the operation upon.	integer	Required
        'FileId'                    => null,
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



