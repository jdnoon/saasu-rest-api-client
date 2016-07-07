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
    protected $filters              = [
        // Specifies the page number of the result set to return. integer
        'Page'                      => null,
        // Specifies the number of records on each page of results. Maximum page size is 100. Defaults to 25 if not specified.	integer
        'PageSize'                  => null,
        // Filter by Invoice Number. String
        'InvoiceNumber'             => null,
        // Filter records with LastModifiedDate greater than or equal to a date in UTC (must also specifiy LastModifiedToDate).	date
        'LastModifiedFromDate'      => null,
        // Filter records with LastModifiedDate less than or equal to a date in UTC (must also specifiy LastModifiedFromDate). date
        'LastModifiedToDate'        => null,
        // Filter records with the specified TransactionType (S = Sale, P = Purchase).	string
        'TransactionType'           => null,
        // One or more tags that are used to filter the result set by. More tags can be separated with a comma.	string
        'Tags'                      => null,
        // Specifies how to filter when using the supplied tags.Valid values are: requireAny. string
        'TagSelection'              => null,
        // Filter records with Date greater than or equal to a date in UTC (must also specifiy ToDate). string
        'InvoiceFromDate'           => null,
        // Filter records with Date less than or equal to a date in UTC (must also specifiy FromDate).	string
        'InvoiceToDate'             => null,
        // Filter records with a status of Q = Quote, O = Order, I = Invoice. Example, ?InvoiceStatus=Q. string
        'InvoiceStatus'             => null,
        // Filter records with PaymentStatus of P = Paid, U = Unpaid, A = All. Defaults to showing 'All' if not specified. string
        'PaymentStatus'             => null,
        // Filter records with a Billing Contact Id equal to the specified value. string
        'BillingContactId'          => null,
    ];

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
