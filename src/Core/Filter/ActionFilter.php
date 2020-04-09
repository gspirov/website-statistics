<?php

namespace Core\Filter;

use Core\Exception\MethodNotAllowedException;
use Core\Http\Request\Request;

class ActionFilter
{
    /**
     * @var array
     */
    private $methods;

    /**
     * ActionFilter constructor.
     * @param array $methods
     */
    public function __construct(array $methods)
    {
        $this->methods = $methods;
    }

    /**
     * @param Request $request
     * @return bool
     * @throws MethodNotAllowedException
     */
    public function satisfiedBy(Request $request): bool
    {
        if (!$this->isMethodAccepted($request)) {
            throw new MethodNotAllowedException(
                $this->methods
            );
        }

        return true;
    }

    /**
     * @param Request $request
     * @return bool
     */
    private function isMethodAccepted(Request $request): bool
    {
        return array_search($request->getRequestMethod(), $this->methods) !== false;
    }
}