<?php

namespace App\Utils\Http;

class Server
{
    public static function getRoot(): string
    {
        if (self::isCommandLine()) {
            return self::getOptions()['PWD'];
        }

        return self::getOptions()['DOCUMENT_ROOT'];
    }

    public static function isCommandLine(): bool
    {
        return PHP_SAPI === 'cli';
    }

    public static function getOptions(): array
    {
        return $_SERVER;
    }

    public static function getAuthHeader(): string
    {
        $header = self::getOptions()['HTTP_AUTHORIZATION'] ?? '';

        if ($header === 'Bearer' || $header === '') {
            return '';
        }

        $header = explode(' ', $header)[1];

        if ($header === 'null') {
            return '';
        }

        return $header;
    }

    public static function isLocalHost(): bool
    {
        if (self::isCommandLine()) {
            return true;
        }

        $address = self::getOptions()['REMOTE_ADDR'];

        $whitelist = [
            '127.0.0.1',
            '::1',
            '[::1]'
        ];

        if (in_array($address, $whitelist)) {
            return true;
        }

        return self::getOptions()['HTTP_HOST'] === 'localhost';
    }
}
