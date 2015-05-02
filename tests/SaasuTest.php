<?php

namespace Terah\Saasu\Test;

use Terah\Saasu\Contact;
use Terah\Saasu\Request;

class SaasuTest extends \PHPUnit_Framework_TestCase
{
    public $saasu = null;

    public function setUp()
    {
        $this->saasu = new Request(0, '');
    }

//    public function testContact()
//    {
//        $data = array(
//
//        );
//        $contact  = new Contact($this->saasu);
//        $response = $contact->save(null, $data);
//        $response = $contact->getContact($response->something);
//        $response = $contact->updateContact($id, $data);
//        $response = $contact->getContacts($filters);
//        $response = $contact->deleteContact($id);
//        $response = $contact->getContact($id);
//    }

//    public function testInvoiceAttachment()
//    {
//        $data = array(
//
//        );
//        $response = $this->saasu->addInvoiceAttachment($data);
//        $response = $this->saasu->getInvoiceAttachment($id);
//        $response = $this->saasu->updateInvoiceAttachment($id, $data);
//        $response = $this->saasu->getInvoiceAttachments($filters);
//        $response = $this->saasu->deleteInvoiceAttachment($id);
//        $response = $this->saasu->getInvoiceAttachment($id);
//    }
//
//    public function testAccount()
//    {
//        $data = array(
//
//        );
//        $response = $this->saasu->addAccount($data);
//        $response = $this->saasu->getAccount($id);
//        $response = $this->saasu->updateAccount($id, $data);
//        $response = $this->saasu->getAccounts($filters);
//        $response = $this->saasu->deleteAccount($id);
//        $response = $this->saasu->getAccount($id);
//    }

    public function testInvoice()
    {
        $data = array(

        );
        $response = $this->saasu->addInvoice($data);
        $response = $this->saasu->getInvoice($id);
        $response = $this->saasu->updateInvoice($id, $data);
        $response = $this->saasu->getInvoices($filters);
        $response = $this->saasu->deleteInvoice($id);
        $response = $this->saasu->getInvoice($id);
    }

    public function testPayment()
    {
        $response = $this->saasu->addPayment($data);
        $response = $this->saasu->getPayment($id);
        $response = $this->saasu->updatePayment($id, $data);
        $response = $this->saasu->getPayments($filters);
        $response = $this->saasu->deletePayment($id);
        $response = $this->saasu->getPayment($id);
    }
}
