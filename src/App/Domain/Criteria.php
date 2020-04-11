<?php

namespace App\Domain;

use Core\Exception\StartDateGreaterThanEndDateException;
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
     * @throws StartDateGreaterThanEndDateException
     */
    public function __construct(DateTime $startDate,
                                DateTime $endDate)
    {
        if ($endDate < $startDate) {
            header(
                HTTP_VERSION . ' 500 Internal Server Error',
                true
            );

            throw new StartDateGreaterThanEndDateException;
        }

        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }
}