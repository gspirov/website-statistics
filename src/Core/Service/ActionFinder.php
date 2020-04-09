<?php

namespace Core\Service;

use Core\Controller\Web\Controller;
use Core\Exception\BadRequestException;
use Core\Exception\MethodNotAllowedException;
use Core\Exception\RouteNotFoundException;
use Core\Filter\ActionFilter;
use Core\Http\Request\Action\Action;
use Core\Http\Request\Request;
use ReflectionClass;
use ReflectionException;
use ReflectionMethod;

class ActionFinder
{
    /**
     * @var Request $request
     */
    private $request;

    /**
     * ActionFinder constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * @param Controller $controller
     * @param string $action
     * @param ActionFilter $filter
     * @return Action
     * @throws BadRequestException
     * @throws ReflectionException
     * @throws RouteNotFoundException
     * @throws MethodNotAllowedException
     */
    public function find(Controller $controller,
                         string $action,
                         ActionFilter $filter): Action
    {
        $reflectionClass = new ReflectionClass($controller);

        if (!$reflectionClass->hasMethod($action)) {
            throw new RouteNotFoundException;
        }

        $filter->satisfiedBy($this->request);

        return new Action(
            $action,
            $this->applyActionParameters(
                $reflectionClass->getMethod($action)
            )
        );
    }

    /**
     * @param ReflectionMethod $method
     * @return array
     * @throws BadRequestException
     */
    private function applyActionParameters(ReflectionMethod $method): array
    {
        $params = [];

        foreach ($method->getParameters() as $param) {
            $queryParam = $this->request->getQueryParam($param->getName());

            if (empty($queryParam)) {
                throw new BadRequestException;
            }

            $params[$param->getName()] = $queryParam;
        }

        return $params;
    }
}