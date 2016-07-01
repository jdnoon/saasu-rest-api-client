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
    /**
     * @var array
     */
    protected $entities = [
        'singular'          => 'ContactAggregate',
        'plural'            => 'NotApplicable',
    ];

    /**
     * @var array
     */
    protected $filters          = [];

    /**
     * @param array $filters
     * @return ContactAggregateDetail
     * @throws \Exception
     */
    public function fetch(array $filters=[])
    {
        throw new \Exception('Cannot call fetch on ContactAggregate types');
        return $this->getValueObject((object)[]);
    }

    /**
     * @param string $keyedOn
     * @param string $valueField
     * @param array  $filters
     * @return array
     * @throws \Exception
     */
    public function fetchList($keyedOn, $valueField, array $filters=[])
    {
        throw new \Exception('Cannot call fetch on ContactAggregate types');
        return [];
    }

    /**
     * @param \stdClass $data
     * @return ContactAggregateDetail
     */
    protected function getValueObject(\stdClass $data)
    {
        return new ContactAggregateDetail($data);
    }
}