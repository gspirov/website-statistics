<?php

namespace App\Domain;

use DateTime;

class Criteria
{
    /**
     * @var DateTime $startDate
     */
    public $startDate;

    /**
     * @var DateTime $endDate
     */
    public $endDate;

    /**
     * Criteria constructor.
     * @param DateTime $startDate
     * @param DateTime $endDate
     */
    public function __construct(DateTime $startDate,
                                DateTime $endDate)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }
}