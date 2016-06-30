<?php

namespace Terah\Saasu\Test;

require_once __DIR__ . '/../../../../vendor/autoload.php';

use Terah\Saasu\RestClient;
use Terah\Saasu\Account;
use Terah\Saasu\Attachment;
use Terah\Saasu\Company;
use Terah\Saasu\Contact;
use Terah\Saasu\FileIdentity;
use Terah\Saasu\Invoice;
use Terah\Saasu\Item;
use Terah\Saasu\Payment;
use Terah\Saasu\TaxCode;
use Terah\Saasu\Values\AccountDetail;

class SaasuTest extends \PHPUnit_Framework_TestCase
{
    public $saasu = null;

    public function setUp()
    {
        $this->saasu = new RestClient('https://api.saasu.com/', getenv('SAASU_TOKEN'), getenv('SAASU_FILE_ID'));
    }

    public function testAccount()
    {
        $rawData       = j('{
      "Id": 1,
      "Name": "Personal Loan Account",
      "AccountLevel": "Detail",
      "AccountType": "Liability",
      "IsActive": true,
      "IsBuiltIn": false,
      "LastUpdatedId": "AAAAABr2Lgs=",
      "DefaultTaxCode": null,
      "LedgerCode": "11160",
      "Currency": "AUD",
      "HeaderAccountId": null,
      "ExchangeAccountId": null,
      "IsBankAccount": true,
      "CreatedDateUtc": null,
      "LastModifiedDateUtc": "2012-11-22T23:44:53.633",
      "IncludeInForecaster": true,
      "BSB": "114879",
      "Number": "410 352 421",
      "BankAccountName": "Sarah & Terry Cullen",
      "BankFileCreationEnabled": false,
      "BankCode": null,
      "UserNumber": null,
      "MerchantFeeAccountId": null,
      "IncludePendingTransactions": false,
      "_links": []
}');
        $data       = new AccountDetail($rawData);
        $this->assertEquals(json_encode($rawData), json_encode($data));
        $saasu      = new Account($this->saasu);
        $response   = $saasu->create($data);
        $response   = $saasu->fetchOne($response->something);
        $response   = $saasu->update($data);
        $response   = $saasu->fetch($filters);
        $response   = $saasu->delete($id);
        $response   = $saasu->fetchOne($id);
    }

    public function testAttachment()
    {
        $data       = [];
        $saasu      = new Attachment($this->saasu);
        $response   = $saasu->create(null, $data);
        $response   = $saasu->fetchOne($response->something);
        $response   = $saasu->update($id, $data);
        $response   = $saasu->get($filters);
        $response   = $saasu->delete($id);
        $response   = $saasu->get($id);
    }

    public function testCompany()
    {
        $data       = [];
        $saasu      = new Company($this->saasu);
        $response   = $saasu->create(null, $data);
        $response   = $saasu->fetchOne($response->something);
        $response   = $saasu->update($id, $data);
        $response   = $saasu->get($filters);
        $response   = $saasu->delete($id);
        $response   = $saasu->get($id);
    }

    public function testContact()
    {
        $data       = [];
        $saasu      = new Contact($this->saasu);
        $response   = $saasu->create(null, $data);
        $response   = $saasu->fetchOne($response->something);
        $response   = $saasu->update($id, $data);
        $response   = $saasu->get($filters);
        $response   = $saasu->delete($id);
        $response   = $saasu->get($id);
    }

    public function testFileIdentity()
    {
        $data       = [];
        $saasu      = new FileIdentity($this->saasu);
        $response   = $saasu->create(null, $data);
        $response   = $saasu->fetchOne($response->something);
        $response   = $saasu->update($id, $data);
        $response   = $saasu->get($filters);
        $response   = $saasu->delete($id);
        $response   = $saasu->get($id);
    }

    public function testInvoice()
    {
        $data       = [];
        $saasu      = new Invoice($this->saasu);
        $response   = $saasu->create(null, $data);
        $response   = $saasu->fetchOne($response->something);
        $response   = $saasu->update($id, $data);
        $response   = $saasu->get($filters);
        $response   = $saasu->delete($id);
        $response   = $saasu->get($id);
    }

    public function testItem()
    {
        $data       = [];
        $saasu      = new Item($this->saasu);
        $response   = $saasu->create(null, $data);
        $response   = $saasu->fetchOne($response->something);
        $response   = $saasu->update($id, $data);
        $response   = $saasu->get($filters);
        $response   = $saasu->delete($id);
        $response   = $saasu->get($id);
    }

    public function testPayment()
    {
        $data       = [];
        $saasu      = new Payment($this->saasu);
        $response   = $saasu->create(null, $data);
        $response   = $saasu->fetchOne($response->something);
        $response   = $saasu->update($id, $data);
        $response   = $saasu->get($filters);
        $response   = $saasu->delete($id);
        $response   = $saasu->get($id);
    }

    public function testTaxCode()
    {
        $data       = [];
        $saasu      = new TaxCode($this->saasu);
        $response   = $saasu->create(null, $data);
        $response   = $saasu->fetchOne($response->something);
        $response   = $saasu->update($id, $data);
        $response   = $saasu->get($filters);
        $response   = $saasu->delete($id);
        $response   = $saasu->get($id);
    }
}

function j($json)
{
    return json_decode($json, false);
}