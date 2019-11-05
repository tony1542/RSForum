<?php

namespace App\Utils\CrystalMathLabs\Exceptions;

class ApiErrorHandler
{
    const INVALID_USER_ERROR     = -1;
    const INVALID_USERNAME_ERROR = -2;
    const DATABASE_ERROR         = -3;
    const HEAVY_LOAD_ERROR       = -4;
    const UNKNOWN_ERROR          = '';
    
    const ERRORS = [
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
    public function checkForErrors($result)
    {
        if (in_array($result, array_keys(self::ERRORS))) {
            throw new ApiException(self::ERRORS[$result]);
        }
    }
    
    public static function getGenericMessage()
    {
        return 'Something went wrong while trying to fetch the data.';
    }
}
