<?php

namespace App\Utils;

/**
 * This class is enforcing we have the proper values in our .env configuration file
 */
class EnvValidator
{
    /**
     * @param string $path
     *
     * @throws EnvException
     */
    public static function fileExists(string $path): void
    {
        if (!file_exists($path)) {
            throw new EnvException('No configuration found for the site');
        }
    }

    /**
     * Loops through the enforcements & checks our .env file for them
     * If they are not found, an exception is thrown
     *
     * @throws EnvException
     */
    public static function enforce(): void
    {
        $enforcements = [
            'DB_NAME',
            'DB_CONNECTION_URL',
            'DB_USERNAME',
            'DB_PASSWORD',
            'DB_PORT',
            'JWT_SECRET_KEY'
        ];

        $throw_exception = false;
        $exception_messages = [];
        foreach ($enforcements as $enforcement) {
            if ($_ENV[$enforcement] === false) {
                $throw_exception = true;
                $exception_messages[] = $enforcement;
            }
        }

        if ($throw_exception) {
            throw new EnvException('Missing .env configuration(s) for: ' . implode(', ', $exception_messages));
        }
    }
}
