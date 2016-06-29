<?php

namespace Terah\Saasu\Values;

/**
 * Class BpayDetails
 * @package Terah\Saasu\Values
 */
class BpayDetails extends Value
{
    /**
     * BillerCode	Bpay biller code of the contact if using this method.
     * @var string
     */
    public $BillerCode              = '';

    /**
     * CRN	Bpay CRN if the contact uses Bpay.
     * @var string
     */
    public $CRN                     = '';
}
