<?php

namespace Terah\Saasu\Test;

require_once __DIR__ . '/../../../../vendor/autoload.php';

use Terah\Saasu\RestClient;
use Terah\Saasu\Account;
use Terah\Saasu\Attachment;
use Terah\Saasu\Values\Contact as ContactDetail;
use Terah\Saasu\Values\ContactAggregate as ContactAggregateDetail;
use Terah\Saasu\Company;
use Terah\Saasu\Contact;
use Terah\Saasu\FileIdentity;
use Terah\Saasu\Invoice;
use Terah\Saasu\Item;
use Terah\Saasu\Payment;
use Terah\Saasu\TaxCode;
use Terah\Saasu\Values\AccountDetail;
use Terah\Saasu\Values\CompanyDetail;
use Terah\Saasu\ContactAggregate;
use Terah\Saasu\Values\DateTime;
use Terah\Saasu\Values\FileAttachment;
use Terah\Saasu\Values\FileIdentityDetail;

class SaasuTest extends \PHPUnit_Framework_TestCase
{
    public $restClient = null;

    public function setUp()
    {
        $this->restClient = new RestClient('https://api.saasu.com/', getenv('SAASU_TOKEN'), getenv('SAASU_FILE_ID'));
    }

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
        // Now create a new account via http
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

    public function testAttachment()
    {
        $rawData  = $this->getAttachmentTestData();
        $valueObj = new FileAttachment(deepClone($rawData));
        $this->assertEquals(json_encode($rawData), json_encode($valueObj));
        $saasu    = new Account($this->restClient);
        $valueObj = $saasu->create($valueObj);
        $idNumber = $valueObj->getId();
        $this->assertTrue(is_int($idNumber), 'Failed to create account detail');
        $valueObj = $saasu->fetchOne($valueObj->getId());
        $this->assertEquals($idNumber, $valueObj->getId());
        $newName        = $valueObj->Name . '-Test';
        $valueObj->Name = $newName;
        $valueObj       = $saasu->update($valueObj);
        $this->assertEquals($idNumber, $valueObj->getId());
        $valueObjs = $saasu->fetch([
            'IsBankAccount'  => true,
            'IsActive'       => true,
            'IncludeBuiltIn' => false,
            'PageSize'       => 25
        ]);
        $this->assertTrue(is_array($valueObjs));
        $this->assertNotEmpty($valueObjs);
        $valueObj = $this->getObjectByName($valueObjs, $newName);
        $this->assertNotEmpty($valueObj);
        $response   = $saasu->delete($valueObj->getId());
        $badRequest = function () use ($saasu, $valueObj)
        {
            $response = $saasu->fetchOne($valueObj->getId());
        };
        $this->assertException($badRequest);
    }

    public function testCompany()
    {
        $rawData  = $this->getCompanyTestData();
        $valueObj = new CompanyDetail(deepClone($rawData));
        $this->assertEquals(json_encode($rawData), json_encode($valueObj));
        $saasu    = new Company($this->restClient);
        $valueObj = $saasu->create($valueObj);
        $idNumber = $valueObj->getId();
        $this->assertTrue(is_int($idNumber), 'Failed to create company detail');
        $valueObj = $saasu->fetchOne($valueObj->getId());
        $this->assertEquals($idNumber, $valueObj->getId());
        $newName        = $valueObj->Name . '-Test';
        $valueObj->Name = $newName;
        $valueObj       = $saasu->update($valueObj);
        $this->assertEquals($idNumber, $valueObj->getId());
        $valueObjs = $saasu->fetch([
            'LastModifiedFromDate' => new DateTime('-1 mins'),
            'LastModifiedToDate'   => new DateTime('+1 mins'),
            'CompanyName'          => $newName,
        ]);
        $this->assertTrue(is_array($valueObjs));
        $this->assertNotEmpty($valueObjs);
        $valueObj = $this->getObjectByName($valueObjs, $newName);
        $this->assertNotEmpty($valueObj);
        $saasu->delete($valueObj->getId());
        $badRequest = function () use ($saasu, $valueObj)
        {
            $saasu->fetchOne($valueObj->getId());
        };
        $this->assertException($badRequest);
    }

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

    public function testContactAggregate()
    {
        $rawData  = $this->getContactAggregateTestData();
        $valueObj = new ContactAggregateDetail(deepClone($rawData));
        $this->assertEquals(json_encode($rawData), json_encode($valueObj));
        $saasu    = new ContactAggregate($this->restClient);
        $valueObj = $saasu->create($valueObj);
        $idNumber = $valueObj->getId();
        $this->assertTrue(is_int($idNumber), 'Failed to create company detail');
        $valueObj = $saasu->fetchOne($valueObj->getId());
        $this->assertEquals($idNumber, $valueObj->getId());
        $newName              = $valueObj->FamilyName . '-Test';
        $valueObj->FamilyName = $newName;
        $valueObj             = $saasu->update($valueObj);
        $this->assertEquals($idNumber, $valueObj->getId());

        $valueObj = $saasu->fetchOne($valueObj->getId());
        $this->assertEquals($newName, $valueObj->FamilyName);
    }

    public function testFileIdentity()
    {
        $saasu     = new FileIdentity($this->restClient);
        $valueObjs = $saasu->fetch([]);
        $this->assertTrue(is_array($valueObjs));
        $this->assertNotEmpty($valueObjs);
        $valueObj = $valueObjs[0];
        $idNumber = $valueObj->getId();
        $valueObj = $saasu->fetchOne($idNumber);
        $this->assertEquals($idNumber, $valueObj->getId());
    }

    public function testInvoice()
    {
        $data     = [];
        $saasu    = new Invoice($this->restClient);
        $response = $saasu->create(null, $data);
        $response = $saasu->fetchOne($response->something);
        $response = $saasu->update($id, $data);
        $response = $saasu->get($filters);
        $response = $saasu->delete($id);
        $response = $saasu->get($id);
    }

    public function testItem()
    {
        $data     = [];
        $saasu    = new Item($this->restClient);
        $response = $saasu->create(null, $data);
        $response = $saasu->fetchOne($response->something);
        $response = $saasu->update($id, $data);
        $response = $saasu->get($filters);
        $response = $saasu->delete($id);
        $response = $saasu->get($id);
    }

    public function testPayment()
    {
        $data     = [];
        $saasu    = new Payment($this->restClient);
        $response = $saasu->create(null, $data);
        $response = $saasu->fetchOne($response->something);
        $response = $saasu->update($id, $data);
        $response = $saasu->get($filters);
        $response = $saasu->delete($id);
        $response = $saasu->get($id);
    }

    public function testTaxCode()
    {
        $data     = [];
        $saasu    = new TaxCode($this->restClient);
        $response = $saasu->create(null, $data);
        $response = $saasu->fetchOne($response->something);
        $response = $saasu->update($id, $data);
        $response = $saasu->get($filters);
        $response = $saasu->delete($id);
        $response = $saasu->get($id);
    }

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

    protected function getContactAggregateTestData()
    {
        $randomise = microtime(true) . rand(5, 590000);
        return j('{
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
  "IsCustomer": false,
  "IsSupplier": false,
  "IsContractor": false,
  "PostalAddress": {
    "Street": "123 Acme Street",
    "City": "Sydney",
    "State": "NSW",
    "Postcode": "2000",
    "Country": "Australia"
  },
  "_links": []
}');
    }
}

function j($json)
{
    return json_decode($json, false);
}

function deepClone($obj)
{
    return json_decode(json_encode($obj));
}