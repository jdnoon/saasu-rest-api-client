<?php

namespace Terah\Saasu;

use Terah\Saasu\Values\PaymentItem;

/**
 * Class Item
 *
 * @package Terah\Saasu
 */
class Payment extends Entity
{
    use EntityFetchOneTrait;
    use EntityFetchTrait;
    use EntityCreateTrait;
    use EntityUpdateTrait;
    use EntityDeleteTrait;

    protected $singularAttribute    = 'Payment';
    protected $pluralAttribute      = 'Payments';
    protected $filters              = [];

    /**
     * @param \stdClass $data
     * @return PaymentItem
     */
    protected function getValueObject(\stdClass $data)
    {
        return new PaymentItem($data);
    }
}