<?php

namespace Core\Exception;

use Exception;

class AccessDeniedException extends Exception
{
    /**
     * @var int $code
     */
    protected $code = 403;

    /**
     * @var string $message
     */
    protected $message = 'You are not allowed to perform this action via CLI.' . PHP_EOL;
}