<?php

namespace Core\Http;

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
}