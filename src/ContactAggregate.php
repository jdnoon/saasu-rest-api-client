<?php

namespace Terah\Saasu;

use Terah\Saasu\Values\ContactAggregate as ContactAggregateDetail;

/**
 * Class Contact
 *
 * @package Terah\Saasu
 */
class ContactAggregate extends Entity
{
    use EntityFetchOneTrait;
    use EntityCreateTrait;
    use EntityUpdateTrait;

    protected $singularAttribute    = 'ContactAggregate';

    /**
     * @param \stdClass $data
     * @return ContactAggregateDetail
     */
    protected function getValueObject(\stdClass $data)
    {
        return new ContactAggregateDetail($data);
    }
}