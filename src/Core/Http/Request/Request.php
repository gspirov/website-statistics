<?php

namespace Core\Http\Request;

use Core\Exception\BadRequestException;
use Core\Exception\MethodNotAllowedException;
use Core\Http\Response;

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
     * @throws BadRequestException
     * @throws MethodNotAllowedException
     * @throws \Core\Exception\NotAcceptableException
     */
    public function __construct()
    {
        // prevent all different from `GET` request methods because the user will be only able to fetch data
        if (!$this->isGet()) {
            Response::sendMethodNotAllowed([
                'GET'
            ]);
        }

        $this->_queryParams = $_GET;
        $this->_postParams = $_POST;
        $this->_headers = new Headers;

        // throw an exception when there is missing header from http request compared against `_acceptableHeaders` collection
        if ($missingHttpRequestHeaders = array_diff_key($this->_acceptableHeaders, getallheaders())) {
            Response::sendMissingMandatoryHttpRequestHeaders(
                $missingHttpRequestHeaders
            );
        }

        // throw an exception where there is invalid http request header value compared against `_acceptableHeaders` collection
        if (array_udiff($this->_acceptableHeaders, getallheaders(), 'strcasecmp')) {
            Response::sendNotAcceptedHttpRequestHeaders(
                $this->_acceptableHeaders
            );
        }

        // capture all valid http request headers
        foreach (getallheaders() as $header => $value) {
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