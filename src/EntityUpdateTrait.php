<?php

namespace Terah\Saasu;

use function Terah\Assert\Assert;
use Terah\Saasu\Values\RestableValue;

trait EntityUpdateTrait
{
    /**
     * @param RestableValue $value
     * @return RestableValue
     */
    public function update(RestableValue $value)
    {
        Assert($value->getId())->id();
        $data = $this->restClient->method(Client::UPDATE)->setValue($value)->sendRequest($this->getSingular($value->getId()));
        return $value->set($data);
    }
}