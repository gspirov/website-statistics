<?php

/*
 * |-----------------------------------------------------------------------------------|
 * | This is the front controller of the application. It will handle the request, pass |
 * | it to the router which will be handled via dispatcher. All console invocations    |
 * | will be denied.                                                                   |
 * |-----------------------------------------------------------------------------------|
 */

use Core\Exception\AccessDeniedException;
use Core\Exception\BaseException;
use Core\Http\Request\Dispatcher;
use Core\Http\Request\Request;
use Core\Http\Request\Router;

require_once 'vendor/autoload.php';

// handling the exceptions and sends the to the end-user
// with friendly and informative messages and response status codes
set_exception_handler(function (Throwable $exception) {
    if ($exception instanceof BaseException) {
        echo json_encode($exception);
    } else {
        echo $exception->getMessage();
    }
});

// deny all console invocations
if (php_sapi_name() === 'cli') {
    throw new AccessDeniedException;
}

require_once 'src/App/Config/predefined_constants.php';

$request = new Request;
$router = new Router($request);

$dispatcher = new Dispatcher($router);
$dispatcher->handle($request);
