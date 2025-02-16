<?php

namespace Tests\Utils\Http;

use App\Utils\Http\Router;
use PHPUnit\Framework\TestCase;
use RuntimeException;

class RouterTest extends TestCase
{
    public function testCallAction(): void
    {
        $_SERVER['REQUEST_URI'] = 'test';
        $this->expectException(RuntimeException::class);
        Router::callAction();

        $_SERVER['REQUEST_URI'] = '/';
        $this->assertNotNull(Router::callAction());
    }

    public function testCallActionMethodNotDefined(): void
    {
        $_SERVER['REQUEST_URI'] = '/user/nonsenseFunction';
        $this->expectException(RuntimeException::class);
        Router::callAction();
    }

    public function testCallActionNoAccess(): void
    {
        $_SERVER['REQUEST_URI'] = '/user/details';
        $this->expectException(RuntimeException::class);
        Router::callAction();
    }
}