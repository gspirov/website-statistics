<?php

namespace Core\Http\Request;

use Throwable;

class Dispatcher
{
    /**
     * @var Router $router
     */
    private $router;

    /**
     * Dispatcher constructor.
     * @param Router $router
     */
    public function __construct(Router $router)
    {
        $this->router = $router;
    }

    public function handle(Request $request)
    {
        try {
            $route = $this->router->getRoute($request->getRoutePath());
        } catch (Throwable $exception) {
            throw new $exception($exception->getMessage(), $exception->getCode());
        }

        call_user_func_array([
            $route->getController(),
            $route->getAction()->getName()
        ], $route->getAction()->getParams());
    }
}