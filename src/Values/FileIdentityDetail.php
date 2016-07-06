<?php

namespace Terah\Saasu\Values;

/**
 * Class FileIdentityDetail
 *
 * @package Terah\Saasu\Values
 */
class FileIdentityDetail extends RestableValue
{

    /**
     * Id of record (Not documented)
     * @var int
     */
    public $Id                              = null;

    /**
     * File name used by the business in Saasu.
     * @var string
     */
    public $Name                             = null;

    /**
     * Legal registered business name.
     * @var string
     */
    public $FullLegalName                    = null;

    /**
     * 'Trading as' name or alternative brand name.
     * @var string
     */
    public $TradingNameOrAlternativeBrandName= null;

    /**
     * Business identifier issued for the business(eg. ABN in Australia).
     * @var string
     */
    public $BusinessIdentifier               = null;

    /**
     * Company identifier issued for the business(eg. ACN in Australia).
     * @var string
     */
    public $CompanyIdentifier                = null;

    /**
     * Primary telephone number used by the business.
     * @var string
     */
    public $PrimaryPhone                     = null;

    /**
     * Website used for the business.
     * @var string
     */
    public $Website                          = null;

    /**
     * Primary email of the business.
     * @var string
     */
    public $Email                            = null;

    /**
     * Street number and name of the business.
     * @var string
     */
    public $Street                           = null;

    /**
     * City the business is located in.
     * @var string
     */
    public $City                             = null;

    /**
     * State the business is located in.
     * @var string
     */
    public $State                            = null;

    /**
     * Postcode where the business is located.
     * @var string
     */
    public $PostCode                         = null;

    /**
     * The country where the business is located.
     * @var string
     */
    public $Country                          = null;

    /**
     * Tax zone the business is operating from.
     * @var string
     */
    public $Zone                             = null;

    /**
     * Currency code of the payment eg: AUD or USD.
     * @var string
     */
    public $CurrencyCode                     =  'AUD';

    /**
     * Settings that specify the default behaviour for a file.
     * @var FileSettings
     */
    public $FileSettings                     =  null;

    /**
     * Hypermedia links.
     * Contains contextual links to possible next actions related to this resource.
     * Only present in responses.
     * This data is not to be sent to the server.
     * Collection ofLink
     * @var array
     */
    public $_links                           =  [];

    /**
     * @param \stdClass $data
     * @return $this
     */
    public function set(\stdClass $data)
    {
        if ( isset($data->FileSettings ) )
        {
            $this->FileSettings  = new FileSettings($data->FileSettings);
            unset($data->FileSettings);
        }
        return parent::set($data);
    }
}
