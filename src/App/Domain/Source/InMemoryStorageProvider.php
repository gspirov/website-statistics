<?php

namespace App\Domain\Source;

use App\Domain\Model\Visit;

class InMemoryStorageProvider extends Provider
{
    public function fetch(): void
    {
        $fp = fopen(
            $_SERVER['DOCUMENT_ROOT'] . '/in_memory_visits_statistics.csv',
            'r'
        );

        while (($data = fgetcsv($fp, 1000, ',')) !== false) {
            list(
                $visitor,
                $visitsCount,
                $date
            ) = $data;

            $dateTimestamp = strtotime($date);

            if ($dateTimestamp >= $this->criteria->startDate->getTimestamp() &&
                $dateTimestamp <= $this->criteria->endDate->getTimestamp())
            {
                $this->data[] = new Visit(
                    $visitor,
                    $visitsCount
                );
            }
        }

        fclose($fp);
    }
}





