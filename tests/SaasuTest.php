<?php

namespace Terah\Saasu\Test;

require_once __DIR__ . '/../../../../vendor/autoload.php';

use Terah\Saasu\Invoice;
use Terah\Saasu\Item;
use Terah\Saasu\Payment;
use Terah\Saasu\RestClient;
use Terah\Saasu\Account;
use Terah\Saasu\TaxCode;
use Terah\Saasu\Values\Contact as ContactDetail;
use Terah\Saasu\Values\ContactAggregate as ContactAggregateDetail;
use Terah\Saasu\Company;
use Terah\Saasu\Contact;
use Terah\Saasu\FileIdentity;
use Terah\Saasu\Values\AccountDetail;
use Terah\Saasu\Values\CompanyDetail;
use Terah\Saasu\ContactAggregate;
use Terah\Saasu\Values\DateTime;
use Terah\Saasu\Values\FileIdentityDetail;
use Terah\Saasu\Values\InvoiceQuickPaymentDetail;
use Terah\Saasu\Values\InvoiceTransactionDetail;
use Terah\Saasu\Values\ItemDetail;
use Terah\Saasu\Values\PaymentItem;
use Terah\Saasu\Values\PaymentTransaction;
use Terah\Saasu\Values\TaxCodeDetail;

/**
 * Class SaasuTest
 * @package Terah\Saasu\Test
 */
class SaasuTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var null
     */
    public $restClient = null;

    /**
     *
     */
    public function setUp()
    {
        $this->restClient = new RestClient('https://api.saasu.com/', getenv('SAASU_TOKEN'), getenv('SAASU_FILE_ID'));
    }

    /**
     *
     */
    public function testAccount()
    {
        // CREATION

        // Fetch raw data for use in testing
        $rawData  = $this->getAccountTestData();
        // Create a instance of AccountDetail (Bucket of data);
        $valueObj = new AccountDetail(deepClone($rawData));
        // Check that the serialized (json_encoded) data
        // is the same as the original raw data checking
        // the the values don't damage the data
        $this->assertEquals(json_encode($rawData), json_encode($valueObj));
        // Create a new transport object
        $accountClient    = new Account($this->restClient);
        // Now create a new invoice via http
        $valueObj = $accountClient->create($valueObj);
        // Get the id number from the newly created account
        $idNumber = $valueObj->getId();
        // Check the id number exists
        $this->assertTrue(is_int($idNumber), 'Failed to create account detail');
        // Fetch the new object/record from saasu to make sure it was created correctly
        $valueObj = $accountClient->fetchOne($valueObj->getId());
        // Make sure the ids are the same
        $this->assertEquals($idNumber, $valueObj->getId());

        // UPDATE
        // Added test to the end of the name
        /** @var AccountDetail $valueObj */
        $newName        = $valueObj->Name . '-Test';
        $valueObj->Name = $newName;
        // Update the name on the server
        $valueObj       = $accountClient->update($valueObj);
        // Check the response id is the same as it was
        $this->assertEquals($idNumber, $valueObj->getId());


        // FETCH MANY
        // Add some filters for the search and fetch from the server
        $valueObjs = $accountClient->fetch([
            'IsBankAccount'  => true,
            'IsActive'       => true,
            'IncludeBuiltIn' => false,
            'PageSize'       => 100
        ]);
        // Make sure there is an array of values
        $this->assertTrue(is_array($valueObjs));
        // Make sure that there is more than zero values
        $this->assertNotEmpty($valueObjs);
        // Fetch the value that has our new name
        $valueObj = $this->getObjectByName($valueObjs, $newName);
        // Make sure it was in the list from fetch()
        $this->assertNotEmpty($valueObj);


        // DELETES
        // Delete the account via it's id.
        $accountClient->delete($valueObj->getId());
        // Create an expected failure (Exception) for fetch a supposed missing record
        $badRequest = function () use ($accountClient, $valueObj)
        {
            $accountClient->fetchOne($valueObj->getId());
        };
        $this->assertException($badRequest);
    }

//    public function testAttachment()
//    {
//        $rawData  = $this->getAttachmentTestData();
//        $valueObj = new FileAttachment(deepClone($rawData));
//        $this->assertEquals(json_encode($rawData), json_encode($valueObj));
//        $saasu    = new Account($this->restClient);
//        $valueObj = $saasu->create($valueObj);
//        $idNumber = $valueObj->getId();
//        $this->assertTrue(is_int($idNumber), 'Failed to create account detail');
//        $valueObj = $saasu->fetchOne($valueObj->getId());
//        $this->assertEquals($idNumber, $valueObj->getId());
//        $newName        = $valueObj->Name . '-Test';
//        $valueObj->Name = $newName;
//        $valueObj       = $saasu->update($valueObj);
//        $this->assertEquals($idNumber, $valueObj->getId());
//        $valueObjs = $saasu->fetch([
//            'IsBankAccount'  => true,
//            'IsActive'       => true,
//            'IncludeBuiltIn' => false,
//            'PageSize'       => 25
//        ]);
//        $this->assertTrue(is_array($valueObjs));
//        $this->assertNotEmpty($valueObjs);
//        $valueObj = $this->getObjectByName($valueObjs, $newName);
//        $this->assertNotEmpty($valueObj);
//        $response   = $saasu->delete($valueObj->getId());
//        $badRequest = function () use ($saasu, $valueObj)
//        {
//            $response = $saasu->fetchOne($valueObj->getId());
//        };
//        $this->assertException($badRequest);
//    }

    /**
     *
     */
    public function testCompany()
    {
        // CREATE

        // Fetch raw data for use in testing
        $rawData  = $this->getCompanyTestData();
        // Create a instance of AccountDetail (Bucket of data);
        $valueObj = new CompanyDetail(deepClone($rawData));
        // Check that the serialized (json_encoded) data
        // is the same as the original raw data checking
        // the the values don't damage the data
        $this->assertEquals(json_encode($rawData), json_encode($valueObj));
        // Create a new transport object
        $saasu    = new Company($this->restClient);
        // Now create a new invoice via http
        $valueObj = $saasu->create($valueObj);
        // Get the id number from the newly created account
        $idNumber = $valueObj->getId();
        // Check the id number exists
        $this->assertTrue(is_int($idNumber), 'Failed to create company detail');
        // Fetch the new object/record from saasu to make sure it was created correctly
        $valueObj = $saasu->fetchOne($valueObj->getId());
        // Make sure the ids are the same
        $this->assertEquals($idNumber, $valueObj->getId());

        // UPDATE
        // Added test to the end of the name
        /** @var AccountDetail $valueObj */
        $newName        = $valueObj->Name . '-Test';
        $valueObj->Name = $newName;
        // Update the name on the server
        $valueObj       = $saasu->update($valueObj);
        // Check the response id is the same as it was
        $this->assertEquals($idNumber, $valueObj->getId());

        // FETCH MANY
        // Add some filters for the search and fetch from the server
        $valueObjs = $saasu->fetch([
            'LastModifiedFromDate' => new DateTime('-1 mins'),
            'LastModifiedToDate'   => new DateTime('+1 mins'),
            'CompanyName'          => $newName,
        ]);
        // Make sure there is an array of values
        $this->assertTrue(is_array($valueObjs));
        // Make sure that there is more than zero values
        $this->assertNotEmpty($valueObjs);
        // Fetch the value that has our new name
        $valueObj = $this->getObjectByName($valueObjs, $newName);
        // Make sure it was in the list from fetch()
        $this->assertNotEmpty($valueObj);

        // DELETES
        // Delete the account via it's id.
        $saasu->delete($valueObj->getId());
        // Create an expected failure (Exception) for fetch a supposed missing record
        $badRequest = function () use ($saasu, $valueObj)
        {
            $saasu->fetchOne($valueObj->getId());
        };
        $this->assertException($badRequest);
    }

    /**
     *
     */
    public function testContact()
    {
        $companyData = $this->getCompanyTestData();
        $companyObj  = new CompanyDetail(deepClone($companyData));
        $companyReq  = new Company($this->restClient);
        $companyObj  = $companyReq->create($companyObj);

        $rawData  = $this->getContactTestData();
        $valueObj = new ContactDetail(deepClone($rawData));
        $this->assertEquals(json_encode($rawData), json_encode($valueObj));
        $valueObj->CompanyId = $companyObj->getId();
        $saasu               = new Contact($this->restClient);
        $valueObj            = $saasu->create($valueObj);
        $idNumber            = $valueObj->getId();
        $this->assertTrue(is_int($idNumber), 'Failed to create company detail');
        /** @var ContactDetail $valueObj */
        $valueObj = $saasu->fetchOne($valueObj->getId());
        $this->assertEquals($idNumber, $valueObj->getId());
        $newName              = $valueObj->FamilyName . '-Test';
        $valueObj->FamilyName = $newName;
        $valueObj             = $saasu->update($valueObj);
        $this->assertEquals($idNumber, $valueObj->getId());
        $valueObjs = $saasu->fetch([
            'LastModifiedFromDate' => new DateTime('-1 mins'),
            'LastModifiedToDate'   => new DateTime('+1 mins'),
            'FamilyName'           => $newName,
        ]);
        $this->assertTrue(is_array($valueObjs));
        $this->assertNotEmpty($valueObjs);
        $valueObj = $this->getObjectByName($valueObjs, $newName, 'FamilyName');
        $this->assertNotEmpty($valueObj);
        $saasu->delete($valueObj->getId());
        $badRequest = function () use ($saasu, $valueObj)
        {
            $saasu->fetchOne($valueObj->getId());
        };
        $this->assertException($badRequest);
    }

    /**
     *
     */
    public function testContactAggregate()
    {
        $rawData  = $this->getContactAggregateTestData();
        $valueObj = new ContactAggregateDetail(deepClone($rawData));
        $this->assertEquals(json_encode($rawData), json_encode($valueObj));
        $saasu    = new ContactAggregate($this->restClient);
        $valueObj = $saasu->create($valueObj);
        $idNumber = $valueObj->getId();
        $this->assertTrue(is_int($idNumber), 'Failed to create company detail');
        /** @var ContactAggregateDetail $valueObj */
        $valueObj = $saasu->fetchOne($valueObj->getId());
        $this->assertEquals($idNumber, $valueObj->getId());
        $newName              = $valueObj->FamilyName . '-Test';
        $valueObj->FamilyName = $newName;
        $valueObj             = $saasu->update($valueObj);
        $this->assertEquals($idNumber, $valueObj->getId());

        $valueObj = $saasu->fetchOne($valueObj->getId());
        $this->assertEquals($newName, $valueObj->FamilyName);
    }

    /**
     *
     */
    public function testFileIdentity()
    {
        $saasu     = new FileIdentity($this->restClient);
        $valueObjs = $saasu->fetch([]);
        $this->assertTrue(is_array($valueObjs));
        $this->assertNotEmpty($valueObjs);
        /** @var FileIdentityDetail $valueObj */
        $valueObj = $valueObjs[0];
        $companyName = $valueObj->Name;
        $valueObj = $saasu->fetchOne(0);
        $this->assertEquals($companyName, $valueObj->Name);
    }

    /**
     *
     */
    public function testInvoice()
    {
        // CREATION

        // Fetch raw data for use in testing
        $rawData            = $this->getInvoiceTestData();
        // Create a instance of InvoiceDetail (Bucket of data);
        $valueObj           = new InvoiceTransactionDetail(deepClone($rawData));
        // Check that the serialized (json_encoded) data
        // is the same as the original raw data checking
        // the the values don't damage the data
        $this->assertEquals(json_encode($rawData, JSON_PRETTY_PRINT), json_encode($valueObj, JSON_PRETTY_PRINT));
        $testContactId      = $valueObj->BillingContactId;
        // Create a new transport object
        $invoiceClient      = new Invoice($this->restClient);
        //Now create a new invoice via http
        $valueObj           = $invoiceClient->create($valueObj);
        // Get the id number from the newly created invoice
        $idNumber         = $valueObj->getId();
        // Check the id number exists
        $this->assertTrue(is_int($idNumber), 'Failed to create invoice detail');
        // Fetch the new object/record from saasu to make sure it was created correctly
        /** @var InvoiceTransactionDetail $valueObj */
        $valueObj         = $invoiceClient->fetchOne($valueObj->getId());
        // Make sure the ids are the same
        $this->assertEquals($idNumber, $valueObj->getId());

        // UPDATE
        // Added test to the end of the name
        $newSummary                     = $valueObj->Summary . '-test';
        $valueObj->Summary              = $newSummary;
        // Update the name on the server
        $valueObj           = $invoiceClient->update($valueObj);
        // Check the response id is the same as it was
        $this->assertEquals($idNumber, $valueObj->getId());


        // FETCH MANY
        // Add some filters for the search and fetch from the server
        $valueObjs = $invoiceClient->fetch([
            'InvoiceNumber'             => $valueObj->InvoiceNumber,
            'TransactionType'           => 'S',
        ]);
        // Make sure there is an array of values
        $this->assertTrue(is_array($valueObjs));
        // Make sure that there is more than zero values
        $this->assertNotEmpty($valueObjs);
        // Fetch the value that has our new name
        $valueObj = $this->getObjectByName($valueObjs, $newSummary, 'Summary');
        // Make sure it was in the list from fetch()
        $this->assertNotEmpty($valueObj);


        // DELETES
        // Delete the invoice via it's id.
        $invoiceClient->delete($valueObj->getId());
        // Create an expected failure (Exception) for fetch a supposed missing record
        $badRequest = function () use ($invoiceClient, $valueObj)
        {
            $invoiceClient->fetchOne($valueObj->getId());
        };
        $this->assertException($badRequest);

        $this->deleteTestContact($testContactId);

    }

    /**
     *
     */
    public function testItem()
    {
        // CREATION

        // Fetch raw data for use in testing
        $rawData        = $this->getItemTestData();
        // Create a instance of ItemDetail (Bucket of data);
        $valueObj       = new ItemDetail(deepClone($rawData));
        // Check that the serialized (json_encoded) data
        // is the same as the original raw data checking
        // the the values don't damage the data
        $this->assertEquals(json_encode($rawData, JSON_PRETTY_PRINT), json_encode($valueObj, JSON_PRETTY_PRINT));
        // Create a new transport object
        $itemClient     = new Item($this->restClient);
        // Now create a new invoice via http
        $valueObj       = $itemClient->create($valueObj);
        // Get the id number from the newly created item
        $idNumber       = $valueObj->getId();
        // Check the id number exists
        $this->assertTrue(is_int($idNumber), 'Failed to create item detail');
        // Fetch the new object/record from saasu to make sure it was created correctly
        $valueObj       = $itemClient->fetchOne($valueObj->getId());
        // Make sure the ids are the same
        $this->assertEquals($idNumber, $valueObj->getId());

        // UPDATE
        // Added test to the end of the name
        /** @var ItemDetail $valueObj */
        $newName        = $valueObj->Code . '-Test';
        $valueObj->Code = $newName;
        // Update the name on the server
        $valueObj       = $itemClient->update($valueObj);
        // Check the response id is the same as it was
        $this->assertEquals($idNumber, $valueObj->getId());


        // FETCH MANY
        // Add some filters for the search and fetch from the server
        $valueObjs = $itemClient->fetch([
            // Filter item records by type.	string
            'ItemType'                      => 'I',
            // Filter item records by specifying search method to search which can be either 'Contains' or 'StartsWith' and searches on the code or description.	string
            'SearchMethod'                  => 'Contains',
            // Filter item records by specifying text to search for in code or description.	string
            'SearchText'                    => $newName,
        ]);
        // Make sure there is an array of values
        $this->assertTrue(is_array($valueObjs));
        // Make sure that there is more than zero values
        $this->assertNotEmpty($valueObjs);
        // Fetch the value that has our new name
        $valueObj = $this->getObjectByName($valueObjs, $newName, 'Code');
        // Make sure it was in the list from fetch()
        $this->assertNotEmpty($valueObj);


        // DELETES
        // Delete the item via it's id.
        $itemClient->delete($valueObj->getId());
        // Create an expected failure (Exception) for fetch a supposed missing record
        $badRequest = function () use ($itemClient, $valueObj)
        {
            $itemClient->fetchOne($valueObj->getId());
        };
        $this->assertException($badRequest);
    }

    /**
     *
     */
    public function testPayment()
    {

        // Fetch raw data for use in testing
        $rawData            = $this->getPaymentTestData();
        // Create a instance of PaymentTransaction (Bucket of data);
        $valueObj           = new PaymentTransaction(deepClone($rawData));
        // Check that the serialized (json_encoded) data
        // is the same as the original raw data checking
        // the the values don't damage the data
        $this->assertEquals(json_encode($rawData, JSON_PRETTY_PRINT), json_encode($valueObj, JSON_PRETTY_PRINT));
        $testContactId      = $valueObj->TransactionId;
        // Create a new transport object
        $paymentClient      = new Payment($this->restClient);
        // Now create a new invoice via http
        $valueObj           = $paymentClient->create($valueObj);
        // Get the id number from the newly created invoice
//        $idNumber         = $valueObj->getId();
//        // Check the id number exists
//        $this->assertTrue(is_int($idNumber), 'Failed to create invoice detail');
//        // Fetch the new object/record from saasu to make sure it was created correctly
//        /** @var InvoiceTransactionDetail $valueObj */
//        $valueObj         = $invoiceClient->fetchOne($valueObj->getId());
//        // Make sure the ids are the same
//        $this->assertEquals($idNumber, $valueObj->getId());

    }

    /**
     *
     */
    public function testTaxCode()
    {

        // Fetch raw data for use in testing
        $rawData  = $this->getTaxCodeTestData();
        // Create a instance of AccountDetail (Bucket of data);
        $valueObj = new TaxCodeDetail(deepClone($rawData));
        // Check that the serialized (json_encoded) data
        // is the same as the original raw data checking
        // the the values don't damage the data
        $this->assertEquals(json_encode($rawData), json_encode($valueObj));

        $saasu     = new TaxCode($this->restClient);
        $valueObjs = $saasu->fetch([
            'isActive' => 'true',
        ]);
        $this->assertTrue(is_array($valueObjs));
        $this->assertNotEmpty($valueObjs);
        /** @var TaxCodeDetail $valueObj */
        $valueObj = $valueObjs[0];
        $idNumber = $valueObj->getId();
        $valueObj = $saasu->fetchOne($idNumber);
        $this->assertEquals($idNumber, $valueObj->getId());

    }

    /**
     * @param array $values
     * @param $nameToMatch
     * @param string $field
     * @return bool|mixed
     */
    protected function getObjectByName(array $values, $nameToMatch, $field = 'Name')
    {
        foreach ( $values as $value )
        {
            if ( $value->{$field} === $nameToMatch )
            {
                return $value;
            }
        }
        return false;
    }

    /**
     * @param callable $callback
     * @param string $expectedException
     * @param null $expectedCode
     * @param null $expectedMessage
     */
    protected function assertException(callable $callback, $expectedException = 'Exception', $expectedCode = null, $expectedMessage = null)
    {
        if ( ! class_exists($expectedException) && ! interface_exists($expectedException) )
        {
            $this->fail("An exception of type '$expectedException' does not exist.");
        }

        try
        {
            $callback();
        }
        catch (\Exception $e)
        {
            $class   = get_class($e);
            $message = $e->getMessage();
            $code    = $e->getCode();

            $extraInfo = $message ? " (message was $message, code was $code)" : ( $code ? " (code was $code)" : '' );
            $this->assertInstanceOf($expectedException, $e, "Failed asserting the class of exception$extraInfo.");

            if ( $expectedCode !== null )
            {
                $this->assertEquals($expectedCode, $code, "Failed asserting code of thrown $class.");
            }
            if ( $expectedMessage !== null )
            {
                $this->assertContains($expectedMessage, $message, "Failed asserting the message of thrown $class.");
            }
            return;
        }

        $extraInfo = $expectedException !== 'Exception' ? " of type $expectedException" : '';
        $this->fail("Failed asserting that exception$extraInfo was thrown.");
    }

    /**
     * @return mixed
     */
    protected function getAccountTestData()
    {
        $randomise = microtime(true) . rand(5, 590000);
        return j('{
      "Id": 1,
      "Name": "Personal Loan Account' . $randomise . '",
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
    }

    /**
     * @return mixed
     */
    protected function createTestItemAccountData()
    {
        //$randomise = microtime(true) . rand(5, 590000);
        return j('{
      "Id": 1,
      "Name": null,
      "AccountLevel": "Detail",
      "AccountType": "Asset",
      "IsActive": true,
      "IsBuiltIn": false,
      "LastUpdatedId": null,
      "DefaultTaxCode": null,
      "LedgerCode": "11160",
      "Currency": "AUD",
      "HeaderAccountId": null,
      "ExchangeAccountId": null,
      "IsBankAccount": false,
      "CreatedDateUtc": null,
      "LastModifiedDateUtc": "2012-11-22T23:44:53.633",
      "BankCode": null,
      "UserNumber": null,
      "MerchantFeeAccountId": null,
      "IncludePendingTransactions": false,
      "_links": []
}');
    }

    /**
     * @return mixed
     */
    protected function getCompanyTestData()
    {
        $randomise = microtime(true) . rand(5, 590000);
        return j('{
  "Id": 1,
  "Name": "Test Company' . $randomise . '",
  "Abn": "12341234",
  "Website": null,
  "LastUpdatedId": "AAAAAJlkOcM=",
  "LongDescription": null,
  "LogoUrl": null,
  "TradingName": "Test Digi",
  "CompanyEmail": null,
  "LastModifiedDateUtc": "2016-06-30T11:57:05.477",
  "CreatedDateUtc": "2016-06-30T11:57:05.477",
  "LastModifiedByUserId": 171132,
  "_links": []
}');
    }

    /**
     * @return mixed
     */
    protected function getContactTestData()
    {
        $randomise = microtime(true) . rand(5, 590000);
        return j('{
  "Id": 1,
  "CreatedDateUtc": "2016-06-19T21:07:25.701",
  "LastModifiedDateUtc": "2016-06-19T21:07:25.701",
  "LastUpdatedId": "AAAAAFwWAN8=",
  "Salutation": "Mr.",
  "GivenName": "Joe",
  "MiddleInitials": null,
  "FamilyName": "Blogs' . $randomise . '",
  "IsActive": true,
  "CompanyId": 3,
  "PositionTitle": "BigBoss",
  "WebsiteUrl": null,
  "PrimaryPhone": "02 4444 5555",
  "HomePhone": null,
  "OtherPhone": null,
  "MobilePhone": null,
  "Fax": null,
  "EmailAddress": null,
  "ContactId": "1234",
  "ContactManagerId": null,
  "DirectDepositDetails": {
    "AcceptDirectDeposit": true,
    "AccountName": "Account name",
    "AccountBSB": "602456",
    "AccountNumber": "34234234"
  },
  "ChequeDetails": {
    "AcceptCheque": false,
    "ChequePayableTo": null
  },
  "CustomField1": "",
  "CustomField2": "",
  "TwitterId": "",
  "SkypeId": "",
  "LinkedInProfile": "",
  "AutoSendStatement": true,
  "IsPartner": false,
  "IsCustomer": false,
  "IsSupplier": false,
  "IsContractor": false,
  "Tags": [
    "Advisor",
    "Business"
  ],
  "DefaultSaleDiscount": null,
  "DefaultPurchaseDiscount": null,
  "LastModifiedByUserId": 567,
  "BpayDetails": {
    "BillerCode": "111222",
    "CRN": "8732993"
  },
  "PostalAddress": {
    "Street": "123 Acme Street",
    "City": "Sydney",
    "State": "NSW",
    "Postcode": "2000",
    "Country": "Australia"
  },
  "OtherAddress": {
    "Street": "123 other Street",
    "City": "Melbourne",
    "State": "VIC",
    "Postcode": "3000",
    "Country": "Australia"
  },
  "SaleTradingTerms": {
    "TradingTermsType": 1,
    "TradingTermsInterval": 2,
    "TradingTermsIntervalType": 1
  },
  "PurchaseTradingTerms": {
    "TradingTermsType": 1,
    "TradingTermsInterval": 3,
    "TradingTermsIntervalType": 2
  },
  "_links": []
}');
    }

    /**
     * @param bool $isSupplier
     * @param bool $isCustomer
     * @return mixed
     */
    protected function getContactAggregateTestData($isSupplier=false, $isCustomer=true)
    {
        $randomise      = microtime(true) . rand(5, 590000);
        $isSupplier     = $isSupplier ? 'true' : 'false';
        $isCustomer     = $isCustomer ? 'true' : 'false';
        $data           = <<<JSON
        {
  "Id": 54353,
  "LastUpdatedId": "null",
  "Salutation": "Mr.",
  "GivenName": "Joe",
  "MiddleInitials": null,
  "FamilyName": "Blogs' . $randomise . '",
  "Company": {
    "Id": null,
    "Name": "ACME Co",
    "Abn": "12345618",
    "LastUpdatedId": "null",
    "LongDescription": "The ACME company Pty Ltd",
    "TradingName": "ACME 2",
    "CompanyEmail": "company@email.com",
    "_links": []
  },
  "PositionTitle": "BigBoss",
  "PrimaryPhone": "02 4444 5555",
  "MobilePhone": null,
  "HomePhone": "02 4564 7897",
  "Fax": null,
  "EmailAddress": null,
  "ContactId": "1234",
  "ContactManager": {
    "Id": null,
    "LastUpdatedId": "null",
    "Salutation": "Mrs.",
    "GivenName": "Joanne",
    "MiddleInitials": "B",
    "FamilyName": "Blogs",
    "PositionTitle": "UberBoss",
    "_links": []
  },
  "IsPartner": false,
  "IsCustomer": {$isCustomer},
  "IsSupplier": {$isSupplier},
  "IsContractor": false,
  "PostalAddress": {
    "Street": "123 Acme Street",
    "City": "Sydney",
    "State": "NSW",
    "Postcode": "2000",
    "Country": "Australia"
  },
  "_links": []
}
JSON;
        return j($data);
    }


    /**
     * @return mixed
     */
    protected function getInvoiceTestData()
    {
        $contactId  = $this->createTestContact()->getId();
        $itemId  = $this->createTestItem()->getId();
        $randomise  = microtime(true) . rand(5, 590000);
        $data       = <<<JSON
{
  "LineItems": [
    {
      "Id": 0,
      "Description": "Sale Item",
      "AccountId": null,
      "TaxCode": "G1",
      "TotalAmount": 10.45,
      "Quantity": 3.0,
      "UnitPrice": 11.5,
      "PercentageDiscount": 0.0,
      "InventoryId": {$itemId},
      "ItemCode": "CC123",
      "Tags": [],
      "Attributes": [],
      "_links": []
    }
  ],
  "NotesInternal": null,
  "NotesExternal": null,
  "Terms": {
    "Type": 1,
    "Interval": 3,
    "IntervalType": null,
    "TypeEnum": "DueIn",
    "IntervalTypeEnum": "Week"
  },
  "Attachments": [
    {
      "Id": 1,
      "Size": 0,
      "Name": "test.txt",
      "Description": "Test document",
      "ItemIdAttachedTo": 0,
      "_links": [
        {
          "rel": "detail",
          "href": "https://api.saasu.com/InvoiceAttachment/1?FileId=123",
          "method": "GET",
          "title": null
        }
      ]
    }
  ],
  "TemplateId": null,
  "SendEmailToContact": null,
  "EmailMessage": null,
  "QuickPayment": null,
  "TransactionId": null,
  "LastUpdatedId": "AAAAAAAKgc=",
  "Currency": "AUD",
  "InvoiceNumber": "INV-1123{$randomise}",
  "InvoiceType": "Tax Invoice",
  "TransactionType": "S",
  "Layout": "I",
  "Summary": "Invoice for order 1123",
  "TotalAmount": 10.45,
  "TotalTaxAmount": null,
  "IsTaxInc": true,
  "AmountPaid": 0.0,
  "AmountOwed": 11.5,
  "FxRate": 1.0,
  "AutoPopulateFxRate": false,
  "RequiresFollowUp": false,
  "SentToContact": true,
  "TransactionDate": "2015-01-24T00:00:00",
  "BillingContactId": {$contactId},
  "BillingContactFirstName": "Freddy",
  "BillingContactLastName": "Fungus",
  "BillingContactOrganisationName": "Fungal Innovation",
  "ShippingContactId": {$contactId},
  "ShippingContactFirstName": "Big",
  "ShippingContactLastName": "Bob",
  "ShippingContactOrganisationName": "Bobbby Inc",
  "CreatedDateUtc": "2016-07-04T21:52:31.896",
  "LastModifiedDateUtc": "2016-07-05T21:52:31.896",
  "PaymentStatus": "U",
  "DueDate": null,
  "InvoiceStatus": "I",
  "PurchaseOrderNumber": "PO-4456",
  "PaymentCount": 0,
  "Tags": [
    "Note, Supplier, Toys"
  ],
  "_links": []
}
JSON;
        return j($data);
    }


    /**
     * @return mixed
     */
    protected function getPaymentTestData()
    {
        $randomise              = microtime(true) . rand(5, 590000);
        $paymentAccountId       = $this->createTestAccount('Income - ' . $randomise, 'Income', 41000)->getId();

        $invoiceIdOne           = $this->createTestInvoice()->getId();
        $invoiceIdTwo           = $this->createTestInvoice()->getId();

        $data                   = <<<JSON
{
  "Notes": "payment notes",
  "PaymentItems": [
    {
      "InvoiceTransactionId": {$invoiceIdOne},
      "AmountPaid": 120.0
    },
    {
      "InvoiceTransactionId": {$invoiceIdTwo},
      "AmountPaid": 150.0
    }
  ],
  "TransactionId": 324,
  "TransactionDate": "2016-07-07T14:00:00.000",
  "TransactionType": null,
  "PaymentAccountId": {$paymentAccountId},
  "TotalAmount": 10.0,
  "FeeAmount": 0.0,
  "Summary": "Payment for invoice 1",
  "Reference": "Toy inv",
  "ClearedDate": "2016-07-08T00:00:00.000",
  "Currency": "AUD",
  "AutoPopulateFxRate": false,
  "FxRate": 0.0,
  "CreatedDateUtc": "2016-07-07T22:00:09.601",
  "LastModifiedDateUtc": "2016-07-07T22:00:09.601",
  "LastUpdatedId": null,
  "RequiresFollowUp": false,
  "_links": []
}
JSON;
        return j($data);
    }


    /**
     * @return mixed
     */
    protected function getItemTestData()
    {
        //$contactId  = $this->createTestContact()->getId();
        $randomise                  = microtime(true) . rand(5, 590000);

        //$cos                        = (new Account($this->restClient))->fetchOne(2583357);
        $AssetAccountId             = $this->createTestAccount('Inventory - ' . $randomise, 'Asset', 11002)->getId();
        $SaleIncomeAccountId        = $this->createTestAccount('Income - ' . $randomise, 'Income', 41000)->getId();
        $SaleCoSAccountId           = $this->createTestAccount('Stock - ' . $randomise, 'CostOfSales', '')->getId();
        $SaleTaxCodeId              = 1359152;
        $PurchaseExpenseAccountId   = 'null';
        $PurchaseTaxCodeId          = 1359162;
        $PrimarySupplierContactId   = $this->createTestContact(true, false)->getId();
        $PrimarySupplierItemCode    = "XYZ";


        $data                       = <<<JSON
{
  "Notes": "Some custom notes",
  "BuildItems": [
    {
      "Id": 1,
      "Code": "Code1",
      "Description": "Build Item 1",
      "Quantity": 5.0,
      "_links": [
        {
          "rel": "detail",
          "href": "https://api.saasu.com/Item/1?FileId=123",
          "method": "GET",
          "title": null
        }
      ]
    },
    {
      "Id": 2,
      "Code": "Code2",
      "Description": "Build Item 2",
      "Quantity": 15.0,
      "_links": [
        {
          "rel": "detail",
          "href": "https://api.saasu.com/Item/2?FileId=123",
          "method": "GET",
          "title": null
        }
      ]
    }
  ],
  "Id": 0,
  "Code": "ABC{$randomise}",
  "Description": "Some item",
  "Type": "I",
  "IsActive": true,
  "IsInventoried": false,
  "AssetAccountId": {$AssetAccountId},
  "IsSold": true,
  "SaleIncomeAccountId": {$SaleIncomeAccountId},
  "SaleTaxCodeId": {$SaleTaxCodeId},
  "SaleCoSAccountId": {$SaleCoSAccountId},
  "IsBought": false,
  "PurchaseExpenseAccountId": {$PurchaseExpenseAccountId},
  "PurchaseTaxCodeId": {$PurchaseTaxCodeId},
  "MinimumStockLevel": 2.0,
  "StockOnHand": 10.0,
  "CurrentValue": 10.1,
  "PrimarySupplierContactId": {$PrimarySupplierContactId},
  "PrimarySupplierItemCode": "{$PrimarySupplierItemCode}",
  "DefaultReOrderQuantity": 5.0,
  "LastUpdatedId": "AAAAAKgc=",
  "IsVisible": true,
  "IsVirtual": false,
  "VType": "ZYX",
  "SellingPrice": 20.99,
  "IsSellingPriceIncTax": true,
  "CreatedDateUtc": "2016-07-05T22:15:41.083",
  "LastModifiedDateUtc": "2016-06-25T22:15:41.083",
  "LastModifiedBy": 123,
  "BuyingPrice": 10.2,
  "IsBuyingPriceIncTax": true,
  "IsVoucher": false,
  "ValidFrom": "2016-06-15T22:15:41.083",
  "ValidTo": "2016-07-25T22:15:41.083",
  "OnOrder": null,
  "Committed": null,
  "_links": []
}
JSON;
        return j($data);
    }


    /**
     * @return mixed
     */
    protected function getTaxCodeTestData()
    {

        $data = <<<JSON
{
  "Notes": "some notes",
  "Id": 1,
  "Code": "G1",
  "Name": "Sale Inc GST",
  "Rate": 0.1,
  "PostingAccountId": 123,
  "IsSale": true,
  "IsPurchase": false,
  "IsPayroll": true,
  "IsInbuilt": false,
  "IsShared": true,
  "IsActive": true,
  "CreatedDateUtc": "2015-07-06T21:24:01.890",
  "LastModifiedDateUtc": "2016-07-05T21:24:01.890",
  "LastModifiedByUserId": 123,
  "LastUpdatedId": "AAAAAAkh==",
  "_links": []
}
JSON;
        return j($data);
    }

    /**
     * @param bool $isSupplier
     * @param bool $isCustomer
     * @return \Terah\Saasu\Values\RestableValue
     */
    protected function createTestContact($isSupplier=false, $isCustomer=true)
    {

        $rawData = $this->getContactAggregateTestData($isSupplier, $isCustomer);
        $valueObj = new ContactAggregateDetail(deepClone($rawData));
        $this->assertEquals(json_encode($rawData), json_encode($valueObj));
        $saasu    = new ContactAggregate($this->restClient);
        return $saasu->create($valueObj);

    }

    /**
     * @return \Terah\Saasu\Values\RestableValue
     */
    protected function createTestItem()
    {

        $rawData = $this->getItemTestData();
        $valueObj = new ItemDetail(deepClone($rawData));
        $this->assertEquals(json_encode($rawData), json_encode($valueObj));
        $saasu    = new Item($this->restClient);
        return $saasu->create($valueObj);

    }

    /**
     * @param String $name
     * @param String $accountType
     * @param String $ledgerCode
     * @return \Terah\Saasu\Values\RestableValue
     */
    protected function createTestAccount($name, $accountType, $ledgerCode)
    {

        // Fetch raw data for use in testing
        $rawData                    = $this->createTestItemAccountData();
        // Create a instance of AccountDetail (Bucket of data);
        $valueObj                   = new AccountDetail(deepClone($rawData));
        $valueObj->Name             = $name;
        $valueObj->AccountType      = $accountType;
        $valueObj->LedgerCode       = $ledgerCode;
        // Create a new transport object
        $accountClient              = new Account($this->restClient);
        // Now create a new invoice via http
        return $accountClient->create($valueObj);

    }

    /**
     * @param String $name
     * @param String $accountType
     * @param String $ledgerCode
     * @return \Terah\Saasu\Values\RestableValue
     */
    protected function createTestInvoice() //$name, $accountType, $ledgerCode)
    {

        $rawData            = $this->getInvoiceTestData();
        // Create a instance of InvoiceDetail (Bucket of data);
        $valueObj           = new InvoiceTransactionDetail(deepClone($rawData));
        // Check that the serialized (json_encoded) data
        // is the same as the original raw data checking
        // the the values don't damage the data
        $this->assertEquals(json_encode($rawData, JSON_PRETTY_PRINT), json_encode($valueObj, JSON_PRETTY_PRINT));
        $testContactId      = $valueObj->BillingContactId;
        // Create a new transport object
        $invoiceClient      = new Invoice($this->restClient);
        //Now create a new invoice via http
        return $invoiceClient->create($valueObj);


    }

    /**
     * @param $id
     * @return null|\stdClass|string
     */
    protected function deleteTestContact($id)
    {
        $saasu    = new Contact($this->restClient);
        return $saasu->delete($id);

    }

}

/**
 * @param $json
 * @return mixed
 */
function j($json)
{
    return json_decode($json, false);
}

/**
 * @param $obj
 * @return mixed
 */
function deepClone($obj)
{
    return json_decode(json_encode($obj));
}

// cd /Users/jamesnoon/Projects/Saasu/vendor/terah/saasu-rest-api-client/tests
// phpunit --filter=testAccount SaasuTest.php