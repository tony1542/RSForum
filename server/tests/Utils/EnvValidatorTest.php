<?php

namespace Tests\Utils;

use App\Utils\EnvException;
use PHPUnit\Framework\TestCase;
use App\Utils\EnvValidator;

class EnvValidatorTest extends TestCase
{
    public function testFileExists()
    {
        $this->expectException(EnvException::class);
        $this->expectExceptionMessage("No configuration found for the site");
        $validator = new EnvValidator();
        $validator->fileExists("/2342342/asdfsad/sdfsd");
    }

    public function testEnforce()
    {
        $enforcements = [
            "DB_NAME",
            "DB_CONNECTION_URL",
            "DB_USERNAME",
            "DB_PASSWORD",
            "DB_PORT",
            "JWT_SECRET_KEY"
        ];

        foreach ($enforcements as $enforcement) {
            $_ENV["$enforcement"] = "value";
        }

        EnvValidator::enforce();

        $_ENV["DB_NAME"] = false;
        $_ENV["DB_CONNECTION_URL"] = false;

        $this->expectException(EnvException::class);
        $this->expectExceptionMessage("Missing .env configuration(s) for: DB_NAME, DB_CONNECTION_URL");
        EnvValidator::enforce();
    }
}
