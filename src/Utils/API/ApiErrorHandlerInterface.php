<?php

namespace App\Utils\API;

use GuzzleHttp\Exception\RequestException;

interface ApiErrorHandlerInterface
{
    /**
     * @param string $result
     *
     * @throws RequestException|ApiException
     */
    public function checkForErrors(string $result): void;
}