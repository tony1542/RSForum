<?php

namespace Tests;

use App\Utils\Database\EnvException;
use PHPUnit\Framework\TestCase;

class BaseTest extends TestCase
{
    /**
     * Bootstraps our testing suite to mimic a standard website request
     *
     * @throws EnvException
     */
    public static function setUpBeforeClass(): void
    {
        $_SERVER['DOCUMENT_ROOT'] = __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR;
        @setApplicationVariables();
        parent::setUpBeforeClass();
    }
    
    // Note this is just a sample test, we will remove this eventually
    // TODO @tony1542
    public function testSimpleEquation(): void
    {
        $this->assertTrue(1 === 1);
    }
}
