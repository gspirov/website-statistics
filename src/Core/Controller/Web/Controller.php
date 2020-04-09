<?php

namespace Core\Controller\Web;

use Core\Http\JsonResponse;

abstract class Controller
{
    /**
     * @param array $data
     * @return JsonResponse
     */
    protected function asJson(array $data): JsonResponse
    {
        return new JsonResponse($data);
    }
}