<?php

namespace Tests\Utils\Http;

use PHPUnit\Framework\TestCase;
use App\Utils\Http\Server;

class ServerTest extends TestCase
{
    protected function setUp(): void
    {
        // Mock the $_SERVER array for testing purposes
        $_SERVER = [
            'DOCUMENT_ROOT' => '/var/www/html',
            'PWD' => '/home/user',
            'HTTP_AUTHORIZATION' => 'Bearer abc123',
            'REMOTE_ADDR' => '127.0.0.1',
            'HTTP_HOST' => 'localhost'
        ];
    }

    public function testGetRootCommandLine()
    {
        $serverMock = $this->getMockBuilder(Server::class)
            ->onlyMethods(['isCommandLine'])
            ->getMock();
        $serverMock->method('isCommandLine')->willReturn(true);

        $this->assertEquals('/home/user', $serverMock->getRoot());
    }

    public function testGetRootWebServer()
    {
        $serverMock = $this->getMockBuilder(Server::class)
            ->onlyMethods(['isCommandLine'])
            ->getMock();
        $serverMock->method('isCommandLine')->willReturn(false);

        $this->assertEquals('/var/www/html', $serverMock->getRoot());
    }

    public function testGetAuthHeader()
    {
        $server = new Server();

        $this->assertEquals('abc123', $server->getAuthHeader());

        $_SERVER['HTTP_AUTHORIZATION'] = 'Bearer';
        $this->assertEquals('', $server->getAuthHeader());

        $_SERVER['HTTP_AUTHORIZATION'] = 'Bearer null';
        $this->assertEquals('', $server->getAuthHeader());

        unset($_SERVER['HTTP_AUTHORIZATION']);
        $this->assertEquals('', $server->getAuthHeader());
    }

    public function testIsLocalHost()
    {
        $serverMock = $this->getMockBuilder(Server::class)
            ->onlyMethods(['isCommandLine', 'getOptions'])
            ->getMock();
        $serverMock->method('isCommandLine')->willReturn(true);
        $this->assertTrue($serverMock->isLocalHost());

        $serverMock->method('isCommandLine')->willReturn(false);
        $_SERVER['REMOTE_ADDR'] = '127.0.0.1';
        $this->assertTrue($serverMock->isLocalHost());

        $_SERVER['REMOTE_ADDR'] = '192.168.1.1';
        $_SERVER['HTTP_HOST'] = 'localhost';
        $this->assertTrue($serverMock->isLocalHost());
    }
}
