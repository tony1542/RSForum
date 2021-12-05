<?php

namespace App\Utils\API\CrystalMathLabs\Exceptions;

use App\Utils\API\ApiErrorHandlerInterface;
use App\Utils\API\ApiException;

class ApiErrorHandler implements ApiErrorHandlerInterface
{
    public const INVALID_USER_ERROR     = -1;
    public const INVALID_USERNAME_ERROR = -2;
    public const DATABASE_ERROR         = -3;
    public const HEAVY_LOAD_ERROR       = -4;
    public const UNKNOWN_ERROR          = '';
    
    public const ERRORS = [
        self::INVALID_USER_ERROR     => 'User not in database.',
        self::INVALID_USERNAME_ERROR => 'Invalid username.',
        self::DATABASE_ERROR         => 'Database error.',
        self::HEAVY_LOAD_ERROR       => 'API is under heavy load; try again in a bit.',
        self::UNKNOWN_ERROR          => 'Something undetermined went wrong.'
    ];
    
    /**
     * @param string $result
     *
     * @throws ApiException
     */
    public function checkForErrors(string $result): void
    {
        if (array_key_exists($result, self::ERRORS)) {
            throw new ApiException(self::ERRORS[$result]);
        }
    }
}
