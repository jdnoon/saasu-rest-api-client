<?php
namespace Terah\Saasu;

use function Terah\Assert\Assert;

trait EntityDeleteTrait
{
    /**
     * @param $id
     * @return null|\stdClass|string
     */
    public function delete($id)
    {
        return $this->restClient->method(Client::DELETE)->sendRequest(strtolower($this->getSingular($id)));
    }
}