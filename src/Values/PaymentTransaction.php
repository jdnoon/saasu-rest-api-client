<?php

namespace Terah\Saasu\Values;


/**
 * Class PaymentTransaction
 *
 * @package Terah\Saasu\Values
 */
class PaymentTransaction extends Value
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
     * @var null
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
    public $TransactionType                  =  '';

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
}
