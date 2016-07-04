<?php
namespace Terah\Saasu;

use function Terah\Assert\Assert;
use Terah\Saasu\Values\RestableValue;

trait EntityDeleteTrait
{
    /**
     * @param $id
     * @return null|\stdClass|string
     */
    public function delete($id)
    {
        return $this->restClient->method(Client::DELETE)->sendRequest($this->getSingular($id));
    }


    /**
     * @param $id
     * @return RestableValue
     * @throws \Exception
     */
    public function fetchOne($id)
    {
        Assert($id)->integer("ID must be an integer");
        $data = $this->restClient->method(Client::FETCH)->sendRequest($this->getSingular($id));
        return $this->getValueObject($data);
    }
}