<?php

namespace App\Utils\API\OSRS\Exceptions;

use App\Utils\API\ApiErrorHandlerInterface;
use App\Utils\API\ApiException;

class ApiErrorHandler implements ApiErrorHandlerInterface
{
    public function checkForErrors(string $result): void
    {
        if (!$result) {
            throw new ApiException('No data found.');
        }
    }
}
