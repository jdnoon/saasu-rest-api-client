<?php

namespace Terah\Saasu;

use function Terah\Assert\Assert;

/**
 * Class RestClient
 * @package Terah\Saasu
 */
class RestClient extends \Terah\RestClient\RestClient
{
    /** @var int */
    protected $fileId = null;

    public function __construct($serviceUrl, $accessToken, $fileId)
    {
        Assert($serviceUrl)->url('Invalid service URL');
        Assert($accessToken)->string('Invalid access token')->notEmpty('Invalid access token');
        Assert($fileId)->notEmpty('Invalid file id')->numeric('Invalid file id');
        $this->fileId   = $fileId;
        parent::__construct($serviceUrl, $accessToken);
    }

    /**
     * @param $entity
     * @return string
     */
    protected function getUrl($entity)
    {
        $entity         = preg_replace('/^\//', '', $entity);
        $this->curlUrl  = $this->serviceUrl . $entity;
        $query          = [
            'wsAccessKey'   => $this->accessToken,
            'FileId'        => $this->fileId,
        ];
        if ( $this->method === 'GET' && ! empty($this->data) )
        {
            $query          = array_merge($query, $this->data);
        }
        $this->curlUrl = rtrim($this->curlUrl, '?') . '?' . http_build_query($query);
        return $this->curlUrl;
    }

    /**
     * @param $data
     * @return $this
     */
    public function setValue($data)
    {
        $this->data = $data;
        return $this;
    }

    /**
     * @return RestResponse
     */
    protected function getResponseObj()
    {
        return new RestResponse();
    }

}