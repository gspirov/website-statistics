<?php

namespace Core\Exception;

use Throwable;

class NotAcceptableException extends BaseException
{
    /**
     * @var int $code
     */
    protected $code = 406;

    /**
     * @var string $message
     */
    protected $message = '';

    /**
     * NotAcceptableException constructor.
     * @param array $acceptableHttpRequestHeaders
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct(array $acceptableHttpRequestHeaders,
                                int $code = 0,
                                Throwable $previous = null)
    {
        $headers = [];

        foreach ($acceptableHttpRequestHeaders as $header => $value) {
            $headers[] = "{$header} => $value";
        }

        parent::__construct(
            sprintf(
                'Not acceptable request content type negotiation. Acceptable HTTP request headers: %s',
                implode(', ', $headers)
            ),
            $code,
            $previous
        );
    }
}