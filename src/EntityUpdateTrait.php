<?php

namespace Terah\Saasu;

use function Terah\Assert\Assert;
use Terah\Saasu\Values\RestableValue;

trait EntityUpdateTrait
{
    use RestClientTrait;

    /**
     * @param RestableValue $value
     * @return RestableValue
     */
    public function update(RestableValue $value)
    {
        Assert($value->getId())->id();
        $data = $this->saasu->method(Client::UPDATE)->setValue($value)->sendRequest($this->getSingular($value->getId()));
        return $value->set($data);
    }
}