<?php

namespace Tests\Utils\Http;

use PHPUnit\Framework\TestCase;
use App\Utils\Http\Server;

class ServerTest extends TestCase
{
    private array $serverData = [
        'DOCUMENT_ROOT' => '/var/www/html',
        'PWD' => '/home/user',
        'HTTP_AUTHORIZATION' => 'Bearer abc123',
        'REMOTE_ADDR' => '127.0.0.1',
        'HTTP_HOST' => 'localhost'
    ];

    protected function setUp(): void
    {
        $_SERVER = $this->serverData;
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
        $serverMock->method('isCommandLine')->willReturn(false);
        $serverMock->method('getOptions')->willReturn($this->serverData);
        $this->assertTrue($serverMock->isLocalHost());
    }

    public function testIsLocalHostIsCommandLine(): void
    {
        $serverMock = $this->getMockBuilder(Server::class)
            ->onlyMethods(['isCommandLine', 'getOptions'])
            ->getMock();
        $serverMock->method('isCommandLine')->willReturn(true);
        $this->assertTrue($serverMock->isLocalHost());
    }

    public function testIsLocalHostIsWhiteListed(): void
    {
        $serverMock = $this->getMockBuilder(Server::class)
            ->onlyMethods(['isCommandLine', 'getOptions'])
            ->getMock();
        $serverMock->method('isCommandLine')->willReturn(false);

        $data = $this->serverData;
        $data['REMOTE_ADDR'] = '192.168.1.1';
        $data['HTTP_HOST'] = 'localhost';

        $serverMock->method('getOptions')->willReturn($data);
        $this->assertTrue($serverMock->isLocalHost());
    }
}
