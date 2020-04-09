<?php

namespace Core\Http\Request;

class Request
{
    /**
     * @var array $_queryParams
     */
    private $_queryParams;

    /**
     * @var array $_postParams
     */
    private $_postParams;

    /**
     * @var Headers $_headers
     */
    private $_headers;

    /**
     * @var array $_acceptableHeaders
     */
    private $_acceptableHeaders = [
        'Accept' => 'application/json',
        'Accept-Charset' => 'UTF-8'
    ];

    /**
     * Request constructor.
     */
    public function __construct()
    {
        $responseExceptions = require_once $_SERVER['DOCUMENT_ROOT'] . '/src/Core/Config/http_response_exceptions.php';

        if (!$this->isGet()) {
            $responseExceptions['Access-Control-Allow-Methods']([
                'GET'
            ]);
        }

        $this->_queryParams = $_GET;
        $this->_postParams = $_POST;
        $this->_headers = new Headers;

        if ($missingHttpRequestHeaders = array_diff_key($this->_acceptableHeaders, getallheaders())) {
            $responseExceptions['Missing-Mandatory-HTTP-Request-Headers'](
                array_keys($missingHttpRequestHeaders)
            );
        }

        foreach (getallheaders() as $header => $value) {
            if (!empty($this->_acceptableHeaders[$header]) && strtolower($this->_acceptableHeaders[$header]) !== strtolower($value)) {
                $responseExceptions[$header]();
            }

            $this->_headers->offsetSet($header, $value);
        }
    }

    /**
     * @return string
     */
    public function getRoutePath(): string
    {
        return parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    }

    /**
     * @return string
     */
    public function getRequestMethod(): string
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    /**
     * @return bool
     */
    public function isPost(): bool
    {
        return $_SERVER['REQUEST_METHOD'] === 'POST';
    }

    /**
     * @return bool
     */
    public function isGet(): bool
    {
        return $_SERVER['REQUEST_METHOD'] === 'GET';
    }

    /**
     * @return array
     */
    public function getQueryParams(): array
    {
        return $this->_queryParams;
    }

    /**
     * @return array
     */
    public function getPostParams(): array
    {
        return $this->_postParams;
    }

    /**
     * @param string $param
     * @return mixed|null
     */
    public function getQueryParam(string $param)
    {
        if (!empty($this->_queryParams[$param])) {
            return $this->_queryParams[$param];
        }

        return null;
    }

    /**
     * @param string $param
     * @return mixed|null
     */
    public function getPostParam(string $param)
    {
        if (!empty($this->_postParams[$param])) {
            return $this->_postParams[$param];
        }

        return null;
    }
}