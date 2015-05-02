<?php

namespace Terah\Saasu;

class Client
{
    const SAASU_URL         = 'https://api.saasu.com/';

    const FETCH             = 'GET';
    const INSERT            = 'POST';
    const UPDATE            = 'PUT';
    const DELETE            = 'DELETE';

    /** @var int $fileId */
    protected $fileId       = null;

    /** @var string $accessToken */
    protected $accessToken  = null;

    /** @var string $method */
    protected $method       = 'GET';

    /** @var string $format */
    protected $format       = 'json';

    /** @var string $version */
    protected $version      = '2.0';

    /** @var array $headers */
    protected $headers      = [];

    /** @var int $itemId */
    protected $itemId       = null;

    /** @var array $data */
    protected $data         = [];

    /** @var string $error */
    protected $error        = null;

    /** @var int $errorNo */
    protected $errorNo      = null;

    /**
     * Create a new Saasu Instance
     *
     * @param int $fileId
     * @param string $accessToken
     */
    public function __construct($fileId, $accessToken)
    {
        $this->fileId       = $fileId;
        $this->accessToken  = $accessToken;
        $this->reset();
    }

    /**
     * @param $name
     * @param $value
     *
     * @return $this
     */
    public function header($name, $value)
    {
        $this->headers[$name] = $value;
        return $this;
    }

    /**
     * @param array $headers
     *
     * @return $this
     */
    public function headers(array $headers)
    {
        foreach ( $headers as $name => $value )
        {
            $this->header($name, $value);
        }
        return $this;
    }

    public function itemId($id)
    {
        $this->itemId = $id;
        return $this;
    }
    /**
     * @param array $data
     *
     * @return $this
     */
    public function data(array $data)
    {
        $this->data = $data;
        return $this;
    }

    /**
     * @return $this
     */
    public function reset()
    {
        $this->data     = [];
        $this->itemId   = null;
        $this->method   = 'GET';
        $this->errorNo  = null;
        $this->error    = null;
        $this->format('json');
        $this->header('X-Api-Version', '2.0');
        return $this;
    }

    /**
     * @param $method
     *
     * @return $this
     */
    public function method($method)
    {
        $this->method = strtoupper($method);
        return $this;
    }

    /**
     * @param $format
     *
     * @return $this
     */
    public function format($format)
    {
        $this->format = $format === 'json' ? 'json' : 'xml';
        return $this;
    }

    /**
     * @param $version
     *
     * @return $this
     */
    public function version($version)
    {
        $this->version = $version;
        return $this;
    }

    /**
     * @param $entity
     * @return mixed|null
     * @throws \Exception
     */
    public function sendRequest($entity)
    {
        $id         = $this->itemId ? "/{$this->itemId}" : '';
        $url        = self::SAASU_URL . $entity . $id . "?FileId={$this->fileId}&wsAccessKey={$this->accessToken}";
        $headers    = [];
        $format     = $this->format === 'json' ? 'json' : 'xml';
        $types      = [
            'json'  => 'application/json',
            'xml'   => 'application/xml',
        ];
        $this->header('Accept', $types[$format]);
        foreach ( $this->headers as $name => $value )
        {
            $headers[$name] = "{$name}:{$value}";
        }
        if ( $this->method === 'GET' && ! empty($this->data) )
        {
            $url = strpos($url, '?') !== false ? $url : "{$url}?";
            $url .= http_build_query($this->data);
        }
        $curlObj = curl_init();
        curl_setopt($curlObj, CURLOPT_URL, $url);
        curl_setopt($curlObj, CURLOPT_HTTPHEADER, $headers);
        //curl_setopt($curlObj, CURLOPT_HEADER, 1);
        curl_setopt($curlObj, CURLOPT_RETURNTRANSFER, true);
        //curl_setopt($curlObj, CURLOPT_VERBOSE, 1);
        curl_setopt($curlObj, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curlObj, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curlObj, CURLOPT_CUSTOMREQUEST, $this->method);
        curl_setopt($curlObj, CURLOPT_ENCODING, '');
        if ( in_array(strtoupper($this->method), ['POST', 'PUT']) )
        {
            $data = is_array($this->data) ? http_build_query($this->data) : $this->data;
            curl_setopt($curlObj, CURLOPT_POST, true);
            curl_setopt($curlObj, CURLOPT_POSTFIELDS, $data);
        }
        $this->reset();
        $response   = curl_exec($curlObj);
        $http_code  = curl_getinfo($curlObj, CURLINFO_HTTP_CODE);
        $curl_error = curl_error($curlObj);
        $error_num  = curl_errno($curlObj);
        if ( $error_num || $http_code > 300 )
        {
            throw new \Exception($this->_formatException($http_code, $curl_error, $response), $http_code);
        }
        if ( $this->format === 'json' )
        {
            $response = json_decode($response, true);
        }
        return $response;
    }

    protected function _formatException($http_code, $curl_error, $saasu_error)
    {
        return <<<TEXT
SAASU REQUEST ERROR:
    HTTP_CODE: {$http_code}
    CURL_ERROR: {$curl_error}
    SAASU_ERROR: {$saasu_error}
TEXT;
    }
}
