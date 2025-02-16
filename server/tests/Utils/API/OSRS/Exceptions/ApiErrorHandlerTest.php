<?php

namespace Tests\Utils\API\OSRS\Exceptions;

use App\Utils\API\ApiException;
use App\Utils\API\OSRS\Exceptions\ApiErrorHandler;
use PHPUnit\Framework\TestCase;

class ApiErrorHandlerTest extends TestCase
{
    public function testCheckForErrorsException(): void
    {
        $this->expectException(ApiException::class);
        $this->expectExceptionMessage('No data found');

        $error_handler = new ApiErrorHandler();
        $error_handler->checkForErrors('');
    }
}