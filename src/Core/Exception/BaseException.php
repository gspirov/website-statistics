<?php

namespace Core\Exception;

use Exception;
use JsonSerializable;

abstract class BaseException extends Exception implements JsonSerializable
{
    /**
     * @return array
     */
    public function jsonSerialize(): array
    {
        return [
            'error' => $this->getCode(),
            'message' => $this->getMessage()
        ];
    }
}