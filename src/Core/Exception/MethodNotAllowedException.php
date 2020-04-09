<?php

namespace Core\Exception;

use Throwable;

class MethodNotAllowedException extends BaseException
{
    /**
     * @var int $code
     */
    protected $code = 405;

    /**
     * MethodNotAllowedException constructor.
     * @param array $allowedMethods
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct(array $allowedMethods,
                                int $code = 0,
                                Throwable $previous = null)
    {
        parent::__construct(
            sprintf(
                'Method is not allowed while invoking this action. Allowed HTTP methods: %s',
                implode(' | ', $allowedMethods)
            ),
            $code,
            $previous
        );
    }
}