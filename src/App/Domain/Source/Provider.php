<?php

namespace App\Domain\Source;

use App\Domain\Criteria;
use App\Domain\Model\Visit;

/**
 * Class Provider
 * This component provides abstraction for open-close principle due to open for extension but closed for modifications.
 * The main purpose is to implement `fetch` method in derived classes in order to provide different data from different providers.
 * @package App\Domain\Source
 */
abstract class Provider
{
    /**
     * @var Visit[] $data
     */
    protected $data = [];

    /**
     * @var Criteria $criteria
     */
    protected $criteria;

    /**
     * Provider constructor.
     * @param Criteria $criteria
     */
    public function __construct(Criteria $criteria)
    {
        $this->criteria = $criteria;
    }

    abstract public function fetch(): void;

    /**
     * @return Visit[]
     */
    public function getData(): array
    {
        return $this->data;
    }
}