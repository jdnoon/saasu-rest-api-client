<?php

namespace Terah\Saasu;

use Terah\Saasu\Values\AccountDetail;

class Account extends Entity
{
    protected $entities         = [
        'singular'                  => 'Account',
        'plural'                    => 'Accounts'
    ];

    protected $filters          = [
        // Specifies the page number of the result set to return.	integer	None.
        'Page'                      => null,
        // 	Specifies the number of records on each page of results. Maximum page size is 100. Defaults to 25 if not specified.	integer	None.
        'PageSize'                  => null,
        // 	The Web Service access key for this user and file which allows
        // access to the API for the associated file (found in File - Settings).
        // Using OAuth authentication mechanism is the preferred method to allow API access.
        //string	Optional. Legacy authentication method and only required if not using OAuth. OAuth is preferred.
        'WsAccessKey'               => null,
        // 	Specifies the file id of the file to perform the operation upon.	integer	Required
        'FileId'                    => null,
        // 	Filter records that are either Active (IsActive=true) or Inactive (IsActive=false).	boolean	None.
        'IsActive'                  => null,
        // 	Filter records that are either a bank account (IsBankAccount=true) or not (IsBankAccount=false).	boolean	None.
        'IsBankAccount'             => null,
        // 	Filter records account type equal to the specified value.	string	None.
        'AccountType'               => null,
        // 	Filter records to include built in accounts (IncludeBuiltIn=true) or not (IncludeBuiltIn=false).	string	None.
        'IncludeBuiltIn'            => null,
        // 	Filter accounts to only those which are the children of a certain header account.	string	None.
        'HeaderAccountId'           => null,
        // 	Filter records on account level ('header' or 'detail').	string	None.
        'AccountLevel'              => null,
    ];

    protected function getValueObject(\stdClass $data)
    {
        return new AccountDetail($data);
    }
}