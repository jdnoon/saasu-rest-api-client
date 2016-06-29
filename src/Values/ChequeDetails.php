<?php

namespace Terah\Saasu\Values;

/**
 * Class ChequeDetails
 *
 * @package Terah\Saasu\Values
 */
class ChequeDetails extends Value
{
    /**
     * Accept cheque as a payment method.
     * @var bool
     */
    public $AcceptCheque            = false;

    /**
     * The named payee that will receive the money.
     * @var null
     */
    public $ChequePayableTo         = null;
}
