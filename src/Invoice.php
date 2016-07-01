<?php

namespace Terah\Saasu;

use function Terah\Assert\Assert;
use Terah\Saasu\Values\InvoiceTransactionDetail;

/**
 * Class Invoice
 *
 * @package Terah\Saasu
 */
class Invoice extends Entity
{
    use EntityFetchOneTrait;
    use EntityFetchTrait;
    use EntityCreateTrait;
    use EntityUpdateTrait;
    use EntityDeleteTrait;

    protected $singularAttribute    = 'Invoice';
    protected $pluralAttribute      = 'Invoices';
    protected $filters              = [];

    /**
     * @param \stdClass $data
     * @return InvoiceTransactionDetail
     */
    protected function getValueObject(\stdClass $data)
    {
        return new InvoiceTransactionDetail($data);
    }

    /**
     * @param int $invoiceId
     * @return bool
     */
    public function sendEmailToEmailContact($invoiceId)
    {
        Assert($invoiceId)->id();
        return true;
    }

    /**
     * @param int $invoiceId
     * @param $emailAddress
     * @return bool
     */
    public function sendEmail($invoiceId, $emailAddress)
    {
        Assert($invoiceId)->id();
        Assert($emailAddress)->email();
        return true;
    }
}
