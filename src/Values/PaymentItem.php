<?php


namespace Terah\Saasu\Values;


/**
 * Class PaymentItem
 *
 * @package Terah\Saasu\Values
 */
class PaymentItem extends Value
{
    /**
     * The ID of the invoice paid.
     * @var int
     */
    public $InvoiceTransactionId        = null;

    /**
     * The amount paid.
     * Has to be equal to or less than the total amount owed.
     * @var float
     */
    public $AmountPaid                  = null;
}