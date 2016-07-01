<?php

namespace Terah\Saasu;

use Terah\Saasu\Values\AccountDetail;

class Account extends Entity
{
    use EntityFetchOneTrait;
    use EntityFetchTrait;
    use EntityCreateTrait;
    use EntityUpdateTrait;
    use EntityDeleteTrait;

    protected $singularAttribute    = 'Account';
    protected $pluralAttribute      = 'Accounts';
    protected $filters              = [
        // Specifies the page number of the result set to return.	integer	None.
        'Page'                          => null,
        // 	Specifies the number of records on each page of results. Maximum page size is 100. Defaults to 25 if not specified.	integer	None.
        'PageSize'                      => null,
        // 	Filter records that are either Active (IsActive=true) or Inactive (IsActive=false).	boolean	None.
        'IsActive'                      => null,
        // 	Filter records that are either a bank account (IsBankAccount=true) or not (IsBankAccount=false).	boolean	None.
        'IsBankAccount'                 => null,
        // 	Filter records account type equal to the specified value.	string	None.
        'AccountType'                   => null,
        // 	Filter records to include built in accounts (IncludeBuiltIn=true) or not (IncludeBuiltIn=false).	string	None.
        'IncludeBuiltIn'                => null,
        // 	Filter accounts to only those which are the children of a certain header account.	string	None.
        'HeaderAccountId'               => null,
        // 	Filter records on account level ('header' or 'detail').	string	None.
        'AccountLevel'                  => null,
    ];

    /**
     * @param \stdClass $data
     * @return AccountDetail
     */
    protected function getValueObject(\stdClass $data)
    {
        return new AccountDetail($data);
    }
}