<?php

namespace Terah\Saasu\Test;

require_once __DIR__ . '/../../../../vendor/autoload.php';

use Terah\Saasu\RestClient;
use Terah\Saasu\Account;
use Terah\Saasu\Attachment;
use Terah\Saasu\Values\Contact as ContactDetail;
use Terah\Saasu\Company;
use Terah\Saasu\Contact;
use Terah\Saasu\FileIdentity;
use Terah\Saasu\Invoice;
use Terah\Saasu\Item;
use Terah\Saasu\Payment;
use Terah\Saasu\TaxCode;
use Terah\Saasu\Values\AccountDetail;
use Terah\Saasu\Values\CompanyDetail;
use Terah\Saasu\Values\DateTime;
use Terah\Saasu\Values\FileAttachment;

class SaasuTest extends \PHPUnit_Framework_TestCase
{
    public $saasu = null;

    public function setUp()
    {
        $this->saasu = new RestClient('https://api.saasu.com/', getenv('SAASU_TOKEN'), getenv('SAASU_FILE_ID'));
    }

    public function testAccount()
    {
        $rawData        = $this->getAccountTestData();
        $valueObj       = new AccountDetail($rawData);
        $this->assertEquals(json_encode($rawData), json_encode($valueObj));
        $saasu          = new Account($this->saasu);
        $valueObj       = $saasu->create($valueObj);
        $idNumber       = $valueObj->getId();
        $this->assertTrue(is_int($idNumber), 'Failed to create account detail');
        $valueObj       = $saasu->fetchOne($valueObj->getId());
        $this->assertEquals($idNumber, $valueObj->getId());
        $newName        = $valueObj->Name . '-Test';
        $valueObj->Name = $newName;
        $valueObj       = $saasu->update($valueObj);
        $this->assertEquals($idNumber, $valueObj->getId());
        $valueObjs      = $saasu->fetch([
            'IsBankAccount'     => true,
            'IsActive'          => true,
            'IncludeBuiltIn'    => false,
            'PageSize'          => 25
        ]);
        $this->assertTrue(is_array($valueObjs));
        $this->assertNotEmpty($valueObjs);
        $valueObj       = $this->getObjectByName($valueObjs, $newName);
        $this->assertNotEmpty($valueObj);
        $response       = $saasu->delete($valueObj->getId());
        $badRequest    = function() use ($saasu, $valueObj)
        {
            $response       = $saasu->fetchOne($valueObj->getId());
        };
        $this->assertException($badRequest);

    }

    public function testAttachment()
    {
        $rawData        = $this->getAttachmentTestData();
        $valueObj       = new FileAttachment($rawData);
        $this->assertEquals(json_encode($rawData), json_encode($valueObj));
        $saasu          = new Account($this->saasu);
        $valueObj       = $saasu->create($valueObj);
        $idNumber       = $valueObj->getId();
        $this->assertTrue(is_int($idNumber), 'Failed to create account detail');
        $valueObj       = $saasu->fetchOne($valueObj->getId());
        $this->assertEquals($idNumber, $valueObj->getId());
        $newName        = $valueObj->Name . '-Test';
        $valueObj->Name = $newName;
        $valueObj       = $saasu->update($valueObj);
        $this->assertEquals($idNumber, $valueObj->getId());
        $valueObjs      = $saasu->fetch([
            'IsBankAccount'     => true,
            'IsActive'          => true,
            'IncludeBuiltIn'    => false,
            'PageSize'          => 25
        ]);
        $this->assertTrue(is_array($valueObjs));
        $this->assertNotEmpty($valueObjs);
        $valueObj       = $this->getObjectByName($valueObjs, $newName);
        $this->assertNotEmpty($valueObj);
        $response       = $saasu->delete($valueObj->getId());
        $badRequest    = function() use ($saasu, $valueObj)
        {
            $response       = $saasu->fetchOne($valueObj->getId());
        };
        $this->assertException($badRequest);

    }

    public function testCompany()
    {
        $rawData        = $this->getCompanyTestData();
        $valueObj       = new CompanyDetail($rawData);
        $this->assertEquals(json_encode($rawData), json_encode($valueObj));
        $saasu          = new Company($this->saasu);
        $valueObj       = $saasu->create($valueObj);
        $idNumber       = $valueObj->getId();
        $this->assertTrue(is_int($idNumber), 'Failed to create company detail');
        $valueObj       = $saasu->fetchOne($valueObj->getId());
        $this->assertEquals($idNumber, $valueObj->getId());
        $newName        = $valueObj->Name . '-Test';
        $valueObj->Name = $newName;
        $valueObj       = $saasu->update($valueObj);
        $this->assertEquals($idNumber, $valueObj->getId());
        $valueObjs      = $saasu->fetch([
            'LastModifiedFromDate'      => new DateTime('-1 mins'),
            'LastModifiedToDate'        => new DateTime('+1 mins'),
            'CompanyName'               => $newName,
        ]);
        $this->assertTrue(is_array($valueObjs));
        $this->assertNotEmpty($valueObjs);
        $valueObj       = $this->getObjectByName($valueObjs, $newName);
        $this->assertNotEmpty($valueObj);
        $saasu->delete($valueObj->getId());
        $badRequest    = function() use ($saasu, $valueObj)
        {
            $response       = $saasu->fetchOne($valueObj->getId());
        };
        $this->assertException($badRequest);
    }

    public function testContact()
    {
        $rawData        = $this->getContactTestData();
        $valueObj       = new ContactDetail($rawData);
        $this->assertEquals(json_encode($rawData), json_encode($valueObj));
        $saasu          = new Contact($this->saasu);
        $valueObj       = $saasu->create($valueObj);
        $idNumber       = $valueObj->getId();
        $this->assertTrue(is_int($idNumber), 'Failed to create company detail');
        $valueObj       = $saasu->fetchOne($valueObj->getId());
        $this->assertEquals($idNumber, $valueObj->getId());
        $newName        = $valueObj->Name . '-Test';
        $valueObj->Name = $newName;
        $valueObj       = $saasu->update($valueObj);
        $this->assertEquals($idNumber, $valueObj->getId());
        $valueObjs      = $saasu->fetch([
            'LastModifiedFromDate'      => new DateTime('-1 mins'),
            'LastModifiedToDate'        => new DateTime('+1 mins'),
            'CompanyName'               => $newName,
        ]);
        $this->assertTrue(is_array($valueObjs));
        $this->assertNotEmpty($valueObjs);
        $valueObj       = $this->getObjectByName($valueObjs, $newName);
        $this->assertNotEmpty($valueObj);
        $saasu->delete($valueObj->getId());
        $badRequest    = function() use ($saasu, $valueObj)
        {
            $response       = $saasu->fetchOne($valueObj->getId());
        };
        $this->assertException($badRequest);
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

    protected function getObjectByName(array $values, $nameToMatch)
    {
        foreach ( $values as $value )
        {
            if ( $value->Name === $nameToMatch )
            {
                return $value;
            }
        }
        return false;
    }

    protected function assertException(callable $callback, $expectedException = 'Exception', $expectedCode = null, $expectedMessage = null)
    {
        if (!class_exists($expectedException) && !interface_exists($expectedException)) {
            $this->fail("An exception of type '$expectedException' does not exist.");
        }

        try {
            $callback();
        } catch (\Exception $e) {
            $class = get_class($e);
            $message = $e->getMessage();
            $code = $e->getCode();

            $extraInfo = $message ? " (message was $message, code was $code)" : ($code ? " (code was $code)" : '');
            $this->assertInstanceOf($expectedException, $e, "Failed asserting the class of exception$extraInfo.");

            if ($expectedCode !== null) {
                $this->assertEquals($expectedCode, $code, "Failed asserting code of thrown $class.");
            }
            if ($expectedMessage !== null) {
                $this->assertContains($expectedMessage, $message, "Failed asserting the message of thrown $class.");
            }
            return;
        }

        $extraInfo = $expectedException !== 'Exception' ? " of type $expectedException" : '';
        $this->fail("Failed asserting that exception$extraInfo was thrown.");
    }

    protected function getAccountTestData()
    {
        $randomise     = microtime(true) . rand(5, 590000);
        return j('{
      "Id": 1,
      "Name": "Personal Loan Account' . $randomise. '",
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
        $randomise     = microtime(true) . rand(5, 590000);
        return        j('{
  "Id": 1,
  "Name": "Test Company' . $randomise .'",
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
        $randomise     = microtime(true) . rand(5, 590000);
        return        j('{
  "Id": 1,
  "CreatedDateUtc": "2016-06-19T21:07:25.7019212Z",
  "LastModifiedDateUtc": "2016-06-29T21:07:25.7019212Z",
  "LastUpdatedId": "AAAAAFwWAN8=",
  "Salutation": "Mr.",
  "GivenName": "Joe",
  "MiddleInitials": null,
  "FamilyName": "Blogs",
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
}

function j($json)
{
    return json_decode($json, false);
}