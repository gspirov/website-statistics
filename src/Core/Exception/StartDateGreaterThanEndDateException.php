<?php

namespace Core\Exception;

class StartDateGreaterThanEndDateException extends BaseException
{
    /**
     * @var int $code
     */
    protected $code = 500;

    /**
     * @var string $message
     */
    protected $message = 'Start date cannot be greater than end date.';
}