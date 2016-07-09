<?php
namespace Terah\Saasu;

use function Terah\Assert\Assert;
use Terah\Saasu\Values\RestableValue;

/**
 * Class EntityFetchOneTrait
 *
 * @package Terah\Saasu
 */
trait EntityFetchOneTrait
{
    /**
     * @param $id
     * @return RestableValue
     * @throws \Exception
     */
    public function fetchOne($id)
    {
        Assert($id)->integer("ID must be an integer");
        $data = $this->restClient->method(Client::FETCH)->sendRequest(strtolower($this->getSingular($id)));
        return $this->getValueObject($data);
    }
}