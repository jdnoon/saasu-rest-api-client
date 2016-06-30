<?php

namespace Terah\Saasu\Values;


/**
 * Class InvoiceQuickPaymentDetail
 *
 * @package Terah\Saasu\Values
 */
class InvoiceQuickPaymentDetail extends Value
{
    /**
     * When the payment was made.
     * Required
     * @var DateTime
     */
    public $DatePaid            = null;

    /**
     * When the payment was cleared.
     * @var DateTime
     */
    public $DateCleared         = null;

    /**
     * The bank account uid where the payment was banked to.
     * @required
     * @var int
     */
    public $BankedToAccountId	= null;

    /**
     * The payment amount. It must be less than the invoice total. Maximum 2 decimals.
     * @required
     * @var float
     */
    public $Amount	            = null;

    /**
     * Payment reference. It can be used to track cheque #, etc.
     * @var string
     */
    public $Reference	        = '';

    /**
     * Brief summary for this payment. Leave this blank to let the system sets this automatically.
     * @var string
     */
    public $Summary             = '';

    /**
     * InvoiceQuickPaymentDetail constructor.
     *
     * @param \stdClass $data
     */
    public function __construct(\stdClass $data)
    {
        parent::__construct($data);
        if ( isset($data->DatePaid) )
        {
            $this->DatePaid = new DateTime($data->DatePaid);
        }
        if ( isset($data->DateCleared) )
        {
            $this->DateCleared = new DateTime($data->DateCleared);
        }
    }
}
