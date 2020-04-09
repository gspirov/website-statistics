<?php

use Core\Exception\BadRequestException;
use Core\Exception\MethodNotAllowedException;
use Core\Exception\NotAcceptableException;

return [
    'Accept' => function () {
        $exception = new NotAcceptableException;

        header(
            'Not Acceptable',
            true,
            $exception->getCode()
        );

        throw $exception;
    },
    'Accept-Charset' => function () {
        $exception = new NotAcceptableException;

        header(
            'Not Acceptable',
            true,
            $exception->getCode()
        );

        throw $exception;
    },
    'Access-Control-Allow-Methods' => function (array $acceptableRequestMethods) {
        $exception = new MethodNotAllowedException(
            $acceptableRequestMethods
        );

        header(
            'Access-Control-Allow-Methods: GET',
            true,
            $exception->getCode()
        );

        throw $exception;
    },
    'Missing-Mandatory-HTTP-Request-Headers' => function (array $missingHeaders) {
        $exception = new BadRequestException(
            sprintf(
                'Missing mandatory HTTP request headers: %s',
                implode(', ', $missingHeaders)
            )
        );

        header(
            sprintf(
                'Missing-Mandatory-HTTP-Headers: %s',
                implode(', ', $missingHeaders)
            ),
            true,
            $exception->getCode()
        );

        throw $exception;
    }
];