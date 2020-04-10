<?php

namespace App\Domain\Source;

use App\Domain\Model\Visit;
use Core\Database\Database;
use Exception;
use PDO;

class DatabaseProvider extends Provider
{
    /**
     * @throws Exception
     */
    public function fetch(): void
    {
        $db = Database::get();

        $sql = <<<SQL
        select visitor, visits_count
        from visits 
        where date between :start_date and :end_date
SQL;

        $statement = $db->prepare($sql);

        $statement->execute([
            ':start_date' => $this->criteria->startDate->format('Y-m-d H:i:s'),
            ':end_date' => $this->criteria->endDate->format('Y-m-d H:i:s'),
        ]);

        while ($source = $statement->fetch(PDO::FETCH_ASSOC)) {
            $this->data[] = new Visit(
                $source['visitor'],
                $source['visits_count']
            );
        }

    }
}