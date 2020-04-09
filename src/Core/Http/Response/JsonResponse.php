<?php

namespace Core\Http;

use JsonSerializable;

class JsonResponse extends Response implements JsonSerializable
{
    /**
     * @var array $_data
     */
    private $_data;

    /**
     * JsonResponse constructor.
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->_contentType = 'application/json; charset=utf-8';
        $this->_data = $data;

        parent::__construct();
    }

    /**
     * @return array
     */
    public function jsonSerialize(): array
    {
        return $this->_data;
    }

    protected function prepareContent()
    {
        return json_encode(
            $this
        );
    }
}