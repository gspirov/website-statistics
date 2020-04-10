<?php

namespace App\Domain\Model;

class Visit
{
    /**
     * @var string $visitor
     */
    private $visitor;

    /**
     * @var integer $visits
     */
    private $visits;

    /**
     * Visit constructor.
     * @param string $visitor
     * @param int $visits
     */
    public function __construct(string $visitor,
                                int $visits)
    {
        $this->visitor = $visitor;
        $this->visits = $visits;
    }

    /**
     * @return string
     */
    public function getVisitor(): string
    {
        return $this->visitor;
    }

    /**
     * @return int
     */
    public function getVisits(): int
    {
        return $this->visits;
    }
}