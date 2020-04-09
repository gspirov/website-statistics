<?php

namespace Core\Exception;

class ControllerNotFoundException extends BaseException
{
    /**
     * @var int $code
     */
    protected $code = 404;

    /**
     * @var string $message
     */
    protected $message = 'Controller cannot be found by resolving requested URL.';
}