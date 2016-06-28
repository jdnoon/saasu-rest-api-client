<?php

namespace Terah\Saasu;

/**
 * Class Account
 * @package Terah\Saasu
 *
 * @property int Id
 * @property string Name
 * @property string AccountLevel
 * @property string AccountType
 * @property bool IsActive
 * @property bool IsBuiltIn
 * @property string LastUpdatedId
 * @property string DefaultTaxCode
 * @property string LedgerCode
 * @property string Currency
 * @property int HeaderAccountId
 * @property int ExchangeAccountId
 * @property bool IsBankAccount
 * @property \DateTime CreatedDateUtc
 * @property \DateTime LastModifiedDateUtc
 * @property string IncludeInForecaster
 * @property string BSB
 * @property string Number
 * @property string BankAccountName
 * @property string BankFileCreationEnabled
 * @property string BankCode
 * @property string UserNumber
 * @property int MerchantFeeAccountId
 * @property bool IncludePendingTransactions
 * @property array _links
 */
class Account extends Entity
{
    protected $entities         = [
        'singular'                  => 'Account',
        'plural'                    => 'Accounts'
    ];

    protected $fields           = [
        'Id'                        =>  null,
        'Name'                      =>  '',
        'AccountLevel'              =>  'Detail', // "Header" or "Detail".
        'AccountType'               =>  'Income',
        'IsActive'                  =>  true,
        'IsBuiltIn'                 =>  false,
        'LastUpdatedId'             =>  null,
        'DefaultTaxCode'            =>  null,
        'LedgerCode'                =>  null,
        'Currency'                  =>  'AUD',
        'HeaderAccountId'           =>  null,
        'ExchangeAccountId'         =>  null,
        'IsBankAccount'             =>  false,
        'CreatedDateUtc'            =>  null,
        'LastModifiedDateUtc'       =>  null,
        'IncludeInForecaster'       =>  false,
        'BSB'                       =>  null,
        'Number'                    =>  null,
        'BankAccountName'           =>  null,
        'BankFileCreationEnabled'   =>  null,
        'BankCode'                  =>  null,
        'UserNumber'                =>  null,
        'MerchantFeeAccountId'      =>  null,
        'IncludePendingTransactions'=>  null,
        '_links'                    =>  []
    ];
}