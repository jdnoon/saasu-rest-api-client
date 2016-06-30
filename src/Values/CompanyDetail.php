<?php

namespace Terah\Saasu\Values;

/**
 * Class CompanyDetail
 * @package Terah\Saasu\Values
 */
class CompanyDetail extends Value
{
    /**
     * The unique key/Id of the company.
     * @var integer
     */
    public $Id                      = null;

    /**
     * Name of the company.
     * @var string
     */
    public $Name                    = '';

    /**
     * Company ABN.
     * @var string
     */
    public $Abn                     = '';

    /**
     * Url of the company website.
     * @var string
     */
    public $Website                 = '';

    /**
     * Identifier used for concurrency checking. Required for update.
     * @var string
     */
    public $LastUpdatedId           = '';

    /**
     * Description of the company.
     * @var string
     */
    public $LongDescription         = '';

    /**
     * Url of the company logo. Note: This field is not supported and will be removed in a future version.
     * @var string
     */
    public $LogoUrl                 = '';

    /**
     * Company trading name.
     * @var string
     */
    public $TradingName             = '';
    
    /**
     * Company email address.
     * @var string
     */
    public $CompanyEmail            = '';

    /**
     * Date and time that the company data was last modified in UTC.
     * @var DateTime
     */
    public $LastModifiedDateUtc     = '';

    /**
     * Date and time that the company was created in UTC.
     * @var DateTime
     */
    public $CreatedDateUtc          = '';

    /**
     * The user id that last modified the company data.
     *
     * @var null
     */
    public $LastModifiedByUserId    = null;

    /**
     * Hypermedia links.
     * Contains contextual links to possible next actions related to this resource.
     * Only present in responses.
     * This data is not to be sent to the server.
     * Collection of Link
     * @var array
     */
    public $_links                  = [];

    /**
     * CompanyDetail constructor.
     *
     * @param \stdClass $data
     */
    public function __construct(\stdClass $data)
    {
        parent::__construct($data);
        if ( isset($data->CreatedDateUtc) )
        {
            $this->CreatedDateUtc = new DateTime($data->CreatedDateUtc);
        }
        if ( isset($data->LastModifiedDateUtc) )
        {
            $this->LastModifiedDateUtc = new DateTime($data->LastModifiedDateUtc);
        }
    }

}



