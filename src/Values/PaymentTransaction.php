<?php

namespace Terah\Saasu\Values;


/**
 * Class PaymentTransaction
 *
 * @package Terah\Saasu\Values
 */
/**
 * Class PaymentTransaction
 * @package Terah\Saasu\Values
 */
class PaymentTransaction extends RestableValue
{

    /**
     * Custom user supplied notes about the payment.
     * @var string
     */
    public $Notes                            =  '';

    /**
     * Invoices that are paid as part of the payment.
     * @required
     * @var PaymentItem[]
     */
    public $PaymentItems                     =  [];

    /**
     * The Id of the transaction.
     * @var int
     */
    public $TransactionId                    =  null;

    /**
     * The date the payment was received or made.
     * @required
     * @var DateTime
     */
    public $TransactionDate                  =  '';

    /**
     * Payment(SP) or Purchase Payment(PP)
     * @required
     * @var string
     */
    public $TransactionType                  =  null;

    /**
     * Bank Account ID used to receive or pay funds.
     * @required
     * @var int
     */
    public $PaymentAccountId                 =  null;

    /**
     * Total payment amount received or paid.
     * @var float
     */
    public $TotalAmount                      =  0.0;

    /**
     * Fee amount associated with the payment.
     * @var float
     */
    public $FeeAmount                        =  0.0;

    /**
     * Summary of the payment.
     * @var string
     */
    public $Summary                          =  '';

    /**
     * Payment reference identifier.
     * @var string
     */
    public $Reference                        =  '';

    /**
     * The date the payment was cleared.
     * @var DateTime
     */
    public $ClearedDate                      =  null;

    /**
     * Currency code of the payment eg: AUD or USD.
     * Defaults to base currency for the file if not supplied or invalid value supplied.
     * @var string
     */
    public $Currency                         =  'AUD';

    /**
     * Determines with if FxRate is automatically populated using the Saasu FX Feed.
     * @var bool
     */
    public $AutoPopulateFxRate               =  true;

    /**
     * If AutoPopulateFxRate is False then the specified FxRate will be used.
     * @var float
     */
    public $FxRate                           =  0.0;

    /**
     * The date and time when this payment was created in UTC.
     * @var DateTime
     */
    public $CreatedDateUtc                   =  '';

    /**
     * The date and time when this payment last modified in UTC.
     * @var DateTime
     */
    public $LastModifiedDateUtc              =  '';

    /**
     * Used for checking concurrency when performing updates.
     * @var string
     */
    public $LastUpdatedId                    =  null;

    /**
     * Indicates whether this payment requires follow up.
     * @var bool
     */
    public $RequiresFollowUp                 =  false;

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
     * @return null
     */
    public function getId()
    {
        return $this->TransactionId;
    }

    /**
     * @param $value
     * @return $this
     */
    public function setId($value)
    {
        $this->TransactionId = $value;
        return $this;
    }

    /**
     * @param \stdClass $data
     * @return $this
     */
    public function set(\stdClass $data)
    {
        if ( isset($data->InsertedEntityId) )
        {
            $this->TransactionId = $data->InsertedEntityId;
            unset($data->InsertedEntityId);
        }
        if ( isset($data->CreatedDateUtc) )
        {
            $this->CreatedDateUtc = new DateTime($data->CreatedDateUtc);
            unset($data->CreatedDateUtc);
        }
        if ( isset($data->LastModifiedDateUtc) )
        {
            $this->LastModifiedDateUtc = new DateTime($data->LastModifiedDateUtc);
            unset($data->LastModifiedDateUtc);
        }
        if ( isset($data->ClearedDate) )
        {
            $this->ClearedDate = new DateTime($data->ClearedDate);
            unset($data->ClearedDate);
        }
        if ( isset($data->TransactionDate) )
        {
            $this->TransactionDate = new DateTime($data->TransactionDate);
            unset($data->TransactionDate);
        }
        if ( isset($data->PaymentItems) && is_array($data->PaymentItems) )
        {
            foreach ( $data->PaymentItems as $paymentItem )
            {
                $this->PaymentItems[] = new PaymentItem($paymentItem);
            }
            unset($data->PaymentItems);
        }
        return parent::set($data);
    }

}
