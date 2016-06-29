<?php

namespace Terah\Saasu\Values;

/**
 * Class DirectDepositDetails
 * @package Terah\Saasu\Values
 */
class DirectDepositDetails extends Value
{
    /**
     * Accept "Direct Deposit" as a payment method.
     * @var bool
     */
    public $AcceptDirectDeposit     = true;

    /**
     * The account name to use for direct deposits if the contact accepts direct deposits.
     * @var string
     */
    public $AccountName             = '';

    /**
     * The BSB to use for direct deposits if the contact accepts direct deposits.
     * @var string
     */
    public $AccountBSB              = '';

    /**
     * The account number to use for direct deposits if the contact accepts direct deposits.
     * @var string
     */
    public $AccountNumber           = '';
}
