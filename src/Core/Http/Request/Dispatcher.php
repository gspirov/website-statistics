<?php

namespace Core\Http\Request;

use Core\Exception\RouteNotFoundException;
use Core\Http\Response;

/**
 * The dispatcher only cares for the registered routes via the `Router` component.
 * When there is available match from current request url and registered routes collection,
 * the dispatcher will invoke appropriate controller/action with it's parameters, otherwise
 * it will throw 404 Not Found exception if there is not available route match.
 * Class Dispatcher
 * @package Core\Http\Request
 */
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

    /**
     * @param Request $request
     * @throws RouteNotFoundException
     */
    public function handle(Request $request)
    {
        $route = $this->router->getRoute($request->getRoutePath());

        if (empty($route)) {
            Response::sendNotFound();
        }

        call_user_func_array([
            $route->getController(),
            $route->getAction()->getName()
        ], $route->getAction()->getParams());
    }
}