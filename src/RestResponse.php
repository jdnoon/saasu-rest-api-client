<?php

namespace Terah\Saasu;

class RestResponse extends \Terah\RestClient\RestResponse
{
    /**
     * @return string
     */
    public function getNotification()
    {
       return parent::getNotification() . ' - ' . $this->body;
    }
}