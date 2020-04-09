<?php

namespace Core\Service;

use Core\Controller\Web\Controller;
use Core\Exception\ControllerNotFoundException;

class ControllerFinder
{
    /**
     * @param string $controllerClass
     * @return Controller
     * @throws ControllerNotFoundException
     */
    public function find(string $controllerClass): Controller
    {
        $controllerClass = ucfirst($controllerClass);
        $class = "App\\Controller\\{$controllerClass}Controller";

        if (!class_exists($class)) {
            throw new ControllerNotFoundException;
        }

        return new $class;
    }
}