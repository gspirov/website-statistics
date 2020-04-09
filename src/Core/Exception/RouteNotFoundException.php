<?php

namespace Core\Exception;

class RouteNotFoundException extends BaseException
{
    /**
     * @var int $code
     */
    protected $code = 404;

    /**
     * @var string $message
     */
    protected $message = 'Route cannot be found.';
}