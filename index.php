<?php

use Core\Exception\BaseException;
use Core\Http\Request\Dispatcher;
use Core\Http\Request\Request;
use Core\Http\Request\Router;

require_once 'vendor/autoload.php';

set_exception_handler(function (BaseException $exception) {
    echo json_encode($exception);
});

$request = new Request;
$router = new Router($request);

$dispatcher = new Dispatcher($router);
$dispatcher->handle($request);
