<?php

namespace Core\Http\Request\Action;

class Action
{
    /**
     * @var string $name
     */
    private $name;

    /**
     * @var array $params
     */
    private $params;

    /**
     * Action constructor.
     * @param string $name
     * @param array $params
     */
    public function __construct(string $name,
                                array $params)
    {
        $this->name = $name;
        $this->params = $params;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return array
     */
    public function getParams(): array
    {
        return $this->params;
    }
}