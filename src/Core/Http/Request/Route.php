<?php

namespace Core\Http\Request;

use Core\Controller\Web\Controller;
use Core\Http\Request\Action\Action;

class Route
{
    /**
     * @var string $name
     */
    private $name;

    /**
     * @var Controller $controller
     */
    private $controller;

    /**
     * @var Action $action
     */
    private $action;

    /**
     * @var array $methods
     */
    private $methods;

    /**
     * Route constructor.
     * @param string $name
     * @param Controller $controller
     * @param Action $action
     * @param array $methods
     */
    public function __construct(string $name,
                                Controller $controller,
                                Action $action,
                                array $methods)
    {
        $this->name = $name;
        $this->controller = $controller;
        $this->action = $action;
        $this->methods = $methods;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return Action
     */
    public function getAction(): Action
    {
        return $this->action;
    }

    /**
     * @return array
     */
    public function getMethods(): array
    {
        return $this->methods;
    }

    /**
     * @return Controller
     */
    public function getController(): Controller
    {
        return $this->controller;
    }
}