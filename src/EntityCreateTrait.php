<?php

namespace Terah\Saasu;

use function Terah\Assert\Assert;
use Terah\Saasu\Values\RestableValue;

trait EntityCreateTrait
{
    /**
     * @param RestableValue $value
     * @return RestableValue
     */
    public function create(RestableValue $value)
    {
        if ( ! empty($value->getId()) )
        {
            $value->setId(null);
        }
        $restClient = $this->restClient;
        /** @var RestClient $restClient */
        $data = $restClient->method(Client::INSERT)->setValue($value)->sendRequest($this->getSingular());
        return $value->set($data);
    }
}