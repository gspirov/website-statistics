<?php

namespace Core\Http\Request;

use Core\Exception\BadRequestException;
use Core\Exception\ControllerNotFoundException;
use Core\Exception\MethodNotAllowedException;
use Core\Exception\RouteNotFoundException;
use Core\Filter\ActionFilter;
use Core\Service\ActionFinder;
use Core\Service\ControllerFinder;
use ReflectionException;

class Router
{
    /**
     * @var Route[] $_routes
     */
    private $_routes;

    /**
     * @var Request $request
     */
    private $request;

    /**
     * @var ControllerFinder $controllerFinder
     */
    private $controllerFinder;

    /**
     * @var ActionFinder $actionFinder
     */
    private $actionFinder;

    /**
     * Router constructor.
     * @param Request $request
     * @throws BadRequestException
     * @throws ControllerNotFoundException
     * @throws MethodNotAllowedException
     * @throws ReflectionException
     * @throws RouteNotFoundException
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->controllerFinder = new ControllerFinder;
        $this->actionFinder = new ActionFinder($request);
        $this->parseRoutes();
    }

    /**
     * @param string $route
     * @return Route|null
     * @throws RouteNotFoundException
     */
    public function getRoute(string $route): ?Route
    {
        if (!empty($this->_routes[$route])) {
            return $this->_routes[$route];
        }

        throw new RouteNotFoundException;
    }

    /**
     * @throws BadRequestException
     * @throws ControllerNotFoundException
     * @throws MethodNotAllowedException
     * @throws ReflectionException
     * @throws RouteNotFoundException
     */
    private function parseRoutes()
    {
        $routes = require_once $_SERVER['DOCUMENT_ROOT'] . '/src/Core/Config/routes.php';

        foreach ($routes as $route => $options) {
            list($controllerClass, $actionName) = $this->extractRoutePath($route);

            $controller = $this->controllerFinder->find($controllerClass);
            $action = $this->actionFinder->find(
                $controller,
                $actionName,
                new ActionFilter($options['methods'])
            );

            $this->_routes[$route] = new Route(
                $route,
                $controller,
                $action,
                $options['methods']
            );
        }
    }

    /**
     * @param string $route
     * @return array
     */
    private function extractRoutePath(string $route): array
    {
        return array_values(
            array_filter(
                explode('/', $route)
            )
        );
    }
}