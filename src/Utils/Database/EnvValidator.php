<?php

namespace App\Utils\Database;

/**
 * Class job is to enforce we have the proper values in our .env configuration file
 */
class EnvValidator
{
    /**
     * @param string $database_name
     *
     * @throws EnvException
     */
    public static function enforce($database_name)
    {
        $enforcements = [
            $database_name . '_NAME',
            $database_name . '_CONNECTION_URL',
            $database_name . '_USERNAME',
            $database_name . '_PASSWORD'
        ];
        
        $throw_exception = false;
        $exception_messages = [];
        foreach ($enforcements as $enforcement) {
            if (getenv($enforcement) === false) {
                $throw_exception = true;
                $exception_messages[] = $enforcement;
            }
        }
        
        if ($throw_exception) {
            throw new EnvException('Missing .env configuration(s) for: ' . implode(', ', $exception_messages));
        }
    }
}
