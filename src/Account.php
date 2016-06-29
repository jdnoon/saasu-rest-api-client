<?php

namespace Terah\Saasu;

use Terah\Saasu\Values\AccountDetail;

class Account extends Entity
{
    protected $entities         = [
        'singular'                  => 'Account',
        'plural'                    => 'Accounts'
    ];

    protected function getValueObject(\stdClass $data)
    {
        return new AccountDetail($data);
    }
}