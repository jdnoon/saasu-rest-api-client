<?php

namespace Terah\Saasu\Values;

/**
 * Class AccountDetail
 * @package Terah\Saasu\Values
 */
class AccountDetail extends Value
{
    /**
     * The unique Id for the account.
     * @var integer
     */
    public $Id                          =  null;

    /**
     * The account name.
     * @var string
     *
     */
    public $Name                        =  '';

    /**
     * The level of account - either "Header" or "Detail". Default is Detail.
     * @var string
     */
    public $AccountLevel                =  'Detail';

    /**
     * The type of account. E.g. "Income"
     * @var string
     */
    public $AccountType                 =  'Income';

    /**
     * Whether the account is active or not.
     * @var bool
     */
    public $IsActive                    =  true;

    /**
     * Whether the account is a default one that comes with the subscription or not.
     * @var bool
     */
    public $IsBuiltIn                   =  false;

    /**
     * Unique identifier to ensure concurrency issue avoidance when performing updates.
     * @var string
     */
    public $LastUpdatedId               =  null;

    /**
     * The default tax code used for the account.
     * @var string
     */
    public $DefaultTaxCode              =  '';

    /**
     * A unique code to identify the account in general ledger.
     * @var string
     */
    public $LedgerCode                  =  '';

    /**
     * The currency used for the account.
     * @var string
     */
    public $Currency                    =  'AUD';

    /**
     * The Header account for this detail account.
     * @var int
     */
    public $HeaderAccountId             =  null;

    /**
     * The base currency account for foreign exchange.
     * @var int
     */
    public $ExchangeAccountId           =  null;

    /**
     * Whether the account is a bank account or not.
     * @var bool
     */
    public $IsBankAccount               =  false;

    /**
     * The date and time the account was created.
     * @var \DateTime
     */
    public $CreatedDateUtc              =  '';

    /**
     * The date and time and the account was last modified.
     * @var \DateTime
     */
    public $LastModifiedDateUtc         =  '';

    /**
     * Whether to include the account in Forecaster report and data forecasting.
     * @var bool
     */
    public $IncludeInForecaster         =  false;

    /**
     * BSB of the bank.
     * @var string
     */
    public $BSB                         =  '';

    /**
     * The bank account number.
     * @var string
     */
    public $Number                      =  '';

    /**
     * The name of the bank account.
     * @var string
     */
    public $BankAccountName             =  '';

    /**
     * Enables/Disables the ability to upload an ABA file to the account.
     * @var bool
     */
    public $BankFileCreationEnabled     =  false;

    /**
     * The Bank code.
     * @var string
     */
    public $BankCode                    =  '';

    /**
     * The Bank client user Id.
     * @var string
     */
    public $UserNumber                  =  '';

    /**
     * The merchant fee account Id.
     * @var int
     */
    public $MerchantFeeAccountId        =  null;

    /**
     * Indicates whether to include pending transactions.
     * @var bool
     */
    public $IncludePendingTransactions  =  false;

    /**
     * @var array
     * Hypermedia links. Contains contextual links to possible next actions related to this resource.
     * Only present in responses.
     * This data is not to be sent to the server.
     * Collection of Link
     */
    public $_links                      =  [];

    /**
     * AccountDetail constructor.
     *
     * @param \stdClass $data
     */
    public function __construct(\stdClass $data)
    {
        parent::__construct($data);
        if ( isset($data->CreatedDateUtc) )
        {
            $this->CreatedDateUtc = new \DateTime($data->CreatedDateUtc);
        }
        if ( isset($data->LastModifiedDateUtc) )
        {
            $this->LastModifiedDateUtc = new \DateTime($data->LastModifiedDateUtc);
        }
    }
}