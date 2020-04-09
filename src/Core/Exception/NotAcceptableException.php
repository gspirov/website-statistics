<?php

namespace Core\Exception;

class NotAcceptableException extends BaseException
{
    /**
     * @var int $code
     */
    protected $code = 406;

    /**
     * @var string $message
     */
    protected $message = 'Not acceptable request content type negotiation.';
}