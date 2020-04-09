<?php

namespace Core\Exception;

class AccessDeniedException extends BaseException
{
    /**
     * @var int $code
     */
    protected $code = 403;

    /**
     * @var string $message
     */
    protected $message = 'You are not allowed to perform this action.';
}