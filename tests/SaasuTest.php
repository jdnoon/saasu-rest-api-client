<?php

namespace Terah\Saasu\Test;

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

class SaasuTest extends \PHPUnit_Framework_TestCase
{
    public $saasu = null;

    public function setUp()
    {
        $this->saasu = new RestClient('https://api.saasu.com/', getenv('SAASU_TOKEN'), getenv('SAASU_FILE_ID'));
    }

    public function testAccount()
    {
        $data       = [];
        $saasu      = new Account($this->saasu);
        $response   = $saasu->create(null, $data);
        $response   = $saasu->fetchOne($response->something);
        $response   = $saasu->update($id, $data);
        $response   = $saasu->get($filters);
        $response   = $saasu->delete($id);
        $response   = $saasu->get($id);
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
