<?php

namespace Tests\Utils;

use App\Utils\EnvException;
use PHPUnit\Framework\TestCase;
use App\Utils\EnvValidator;

class EnvValidatorTest extends TestCase
{
    public function testFileExists()
    {
        $mock = $this->getMockBuilder(EnvValidator::class)
            ->onlyMethods(['nativeFileExists'])
            ->getMock();
        $mock->method('nativeFileExists')->willReturn(true);

        $validPath = '/var/www/html/.env';
        $invalidPath = '/invalid/path/.env';

        $mock->fileExists($validPath);

        $mock->method('nativeFileExists')->willReturn(false);
        $this->expectException(EnvException::class);
        $this->expectExceptionMessage('No configuration found for the site');
        $mock->fileExists($invalidPath);
    }

    public function testEnforce()
    {
        $enforcements = [
            'DB_NAME',
            'DB_CONNECTION_URL',
            'DB_USERNAME',
            'DB_PASSWORD',
            'DB_PORT',
            'JWT_SECRET_KEY'
        ];

        foreach ($enforcements as $enforcement) {
            putenv("$enforcement=value");
        }

        EnvValidator::enforce();

        putenv('DB_NAME');
        putenv('DB_CONNECTION_URL');
        $this->expectException(EnvException::class);
        $this->expectExceptionMessage('Missing .env configuration(s) for: DB_NAME, DB_CONNECTION_URL');
        EnvValidator::enforce();
    }
}
