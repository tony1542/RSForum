<?php

namespace Tests\Utils\Http;

use PHPUnit\Framework\TestCase;
use App\Utils\Http\Request;
use App\Controllers\PagesController;

class RequestTest extends TestCase
{
    protected function setUp(): void
    {
        $_SERVER['REQUEST_URI'] = '/pages/show/123';
        $_POST = ['key' => 'value'];
        $_GET = ['param' => 'value'];
        $_REQUEST = array_merge($_POST, $_GET);
    }

    public function testGetController()
    {
        $this->assertEquals('pagessController', Request::getController());

        $_SERVER['REQUEST_URI'] = '/';
        $this->assertEquals(PagesController::class, Request::getController());
    }

    public function testGetAction()
    {
        $this->assertEquals('show', Request::getAction());

        $_SERVER['REQUEST_URI'] = '/';
        $this->assertEquals('index', Request::getAction());
    }

    public function testGetID()
    {
        $this->assertEquals('123', Request::getID());

        $_SERVER['REQUEST_URI'] = '/';
        $this->assertEquals('0', Request::getID());
    }

    public function testGetParameters()
    {
        $_POST = ['parameters' => ['param' => 'value']];
        $this->assertEquals(['param' => 'value'], Request::getParameters());

        $_POST = [];
        $_SERVER['REQUEST_URI'] = '/';
        $this->assertEquals([], Request::getParameters());
    }

    public function testGetPostValues()
    {
        $this->assertEquals(['key' => 'value'], Request::getPostValues());
    }

    public function testGetGetValues()
    {
        $this->assertEquals(['param' => 'value'], Request::getGetValues());
    }
}
