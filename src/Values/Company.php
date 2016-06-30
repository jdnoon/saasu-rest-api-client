<?php

namespace Terah\Saasu\Values;

/**
 * Class Company
 *
 * @package Terah\Saasu\Values
 */
class Company extends Value
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
     * Hypermedia links.
     * Contains contextual links to possible next actions related to this resource.
     * Only present in responses.
     * This data is not to be sent to the server.
     * Collection of Link
     * @var array
     */
    public $_links                  = [];
}