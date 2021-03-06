<?php

namespace Core\Exception;

class BadRequestException extends BaseException
{
    /**
     * @var int $code
     */
    protected $code = 400;

    /**
     * @var string $message
     */
    protected $message = 'Missing mandatory URL params from route path.';

    /**
     * @param string $message
     */
    public function setMessage(string $message): void
    {
        $this->message = $message;
    }
}