<?php

namespace App\Controller;

use Core\Controller\Web\Controller;

class StatisticsController extends Controller
{
    public function index(int $id)
    {
        $response = $this->asJson([
            'id' => $id
        ]);

        $response->send();
    }
}