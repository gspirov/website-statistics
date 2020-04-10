<?php

namespace App\Controller;

use App\Domain\Aggregator;
use App\Domain\Criteria;
use App\Domain\Source\DatabaseProvider;
use App\Domain\Source\InMemoryStorageProvider;
use Core\Controller\Web\Controller;
use Core\Http\JsonResponse;
use DateTime;
use Exception;

class StatisticsController extends Controller
{
    /**
     * @param DateTime $startDate
     * @param DateTime $endDate
     * @return JsonResponse
     * @throws Exception
     */
    public function index(DateTime $startDate, DateTime $endDate)
    {
        $criteria = new Criteria(
            $startDate,
            $endDate
        );

        $aggregator = new Aggregator(
            new DatabaseProvider($criteria),
            new InMemoryStorageProvider($criteria)
        );

        $response = $this->asJson([
            'error' => false,
            'message' => '',
            'data' => $aggregator->aggregate()
        ]);

        $response->send();
        return $response;
    }
}