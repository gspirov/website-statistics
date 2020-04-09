<?php

namespace Core\Http\Request;

use ArrayAccess;

class Headers implements ArrayAccess
{
    /**
     * @var array $_headers
     */
    private $_headers = [];

    public function offsetExists($offset)
    {
        return array_key_exists($offset, $this->_headers);
    }

    public function offsetGet($offset)
    {
        return $this->offsetExists($offset) ? $this->_headers[$offset] : null;
    }

    public function offsetSet($offset, $value)
    {
        $this->_headers[$offset] = $value;
    }

    public function offsetUnset($offset)
    {
        if (!$this->offsetExists($offset)) {
            return;
        }

        unset($this->_headers[$offset]);
    }

    /**
     * @return array
     */
    public function getAll(): array
    {
        return $this->_headers;
    }
}