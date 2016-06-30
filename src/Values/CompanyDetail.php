<?php

namespace Terah\Saasu\Values;

/**
 * Class CompanyDetail
 * @package Terah\Saasu\Values
 */
class CompanyDetail extends RestableValue
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
    public $Name                    = null;

    /**
     * Company ABN.
     * @var string
     */
    public $Abn                     = null;

    /**
     * Url of the company website.
     * @var string
     */
    public $Website                 = null;

    /**
     * Identifier used for concurrency checking. Required for update.
     * @var string
     */
    public $LastUpdatedId           = null;

    /**
     * Description of the company.
     * @var string
     */
    public $LongDescription         = null;

    /**
     * Url of the company logo. Note: This field is not supported and will be removed in a future version.
     * @var string
     */
    public $LogoUrl                 = null;

    /**
     * Company trading name.
     * @var string
     */
    public $TradingName             = null;
    
    /**
     * Company email address.
     * @var string
     */
    public $CompanyEmail            = null;

    /**
     * Date and time that the company data was last modified in UTC.
     * @var DateTime
     */
    public $LastModifiedDateUtc     = null;

    /**
     * Date and time that the company was created in UTC.
     * @var DateTime
     */
    public $CreatedDateUtc          = null;

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
     * @param \stdClass $data
     * @return $this
     */
    public function set(\stdClass $data)
    {
        parent::set($data);
        if ( isset($data->InsertedCompanyId) )
        {
            $this->setId($data->InsertedCompanyId);
        }
        if ( isset($data->CreatedDateUtc) )
        {
            $this->CreatedDateUtc = new DateTime($data->CreatedDateUtc);
        }
        if ( isset($data->LastModifiedDateUtc) )
        {
            $this->LastModifiedDateUtc = new DateTime($data->LastModifiedDateUtc);
        }
        return $this;
    }

}



