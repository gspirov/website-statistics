<?php

namespace Core\Http;

use Core\Exception\BadRequestException;
use Core\Exception\MethodNotAllowedException;
use Core\Exception\NotAcceptableException;
use Core\Exception\RouteNotFoundException;
use Core\Http\Request\Headers;

abstract class Response
{
    /**
     * @var Headers $_headers
     */
    protected $_headers;

    /**
     * @var string $_contentType
     */
    protected $_contentType;

    /**
     * @var mixed $_content
     */
    private $_content;

    /**
     * Response constructor.
     */
    public function __construct()
    {
        $this->_headers = new Headers;

        $this->_headers->offsetSet(
            'Content-Type',
            $this->_contentType
        );

        $this->_content = $this->prepareContent();
    }

    abstract protected function prepareContent();

    public function send()
    {
        foreach ($this->_headers->getAll() as $header => $value) {
            header('HTTP/1.0 200 OK');
            header("{$header}: {$value}");
        }

        echo $this->_content;
    }

    /**
     * @return Headers
     */
    public function getHeaders(): Headers
    {
        return $this->_headers;
    }

    /**
     * @throws RouteNotFoundException
     */
    public static function sendNotFound()
    {
        header(
            'HTTP/1.0 404 Not Found',
            true,
            404
        );

        throw new RouteNotFoundException;
    }

    /**
     * @param array $allowedHttpMethods
     * @throws MethodNotAllowedException
     */
    public static function sendMethodNotAllowed(array $allowedHttpMethods)
    {
        header(
            'HTTP/1.0 405 Method Not Allowed',
            true,
            405
        );

        throw new MethodNotAllowedException(
            $allowedHttpMethods
        );
    }

    /**
     * @param string|null $message
     * @throws BadRequestException
     */
    public static function sendBadRequest(?string $message = null)
    {
        $exception = new BadRequestException;

        if (!empty($message)) {
            $exception->setMessage($message);
        }

        header(
            'HTTP/1.0 400 Bad Request',
            true,
            400
        );

        throw $exception;
    }

    /**
     * @param array $missingHttpHeaders
     * @throws BadRequestException
     */
    public static function sendMissingMandatoryHttpRequestHeaders(array $missingHttpHeaders)
    {
        $exception = new BadRequestException(
            sprintf(
                'Missing mandatory HTTP request headers: %s',
                implode(', ', $missingHttpHeaders)
            )
        );

        header(
            sprintf(
                'Missing-Mandatory-HTTP-Headers: %s',
                implode(', ', $missingHttpHeaders)
            ),
            true,
            $exception->getCode()
        );

        throw $exception;
    }

    /**
     * @param array $acceptableHttpRequestHeaders
     * @throws NotAcceptableException
     */
    public static function sendNotAcceptedHttpRequestHeaders(array $acceptableHttpRequestHeaders)
    {
        $exception = new NotAcceptableException(
            $acceptableHttpRequestHeaders
        );

        header(
            'HTTP/1.0 406 Not Acceptable',
            true,
            $exception->getCode()
        );

        throw $exception;
    }
}