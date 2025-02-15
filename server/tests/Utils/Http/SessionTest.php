<?php

namespace Tests\Utils\Http;

use PHPUnit\Framework\TestCase;
use App\Utils\Http\Session;

class SessionTest extends TestCase
{
    protected function setUp(): void
    {
        $_SESSION = [];
    }

    public function testFlash()
    {
        $_SESSION['testKey'] = 'testValue';
        $this->assertEquals('testValue', Session::flash('testKey'));
        $this->assertArrayNotHasKey('testKey', $_SESSION);
    }

    public function testGet()
    {
        $_SESSION['testKey'] = 'testValue';
        $this->assertEquals('testValue', Session::get('testKey'));
        $this->assertFalse(Session::get('nonExistentKey'));
    }

    public function testHas()
    {
        $_SESSION['testKey'] = 'testValue';
        $this->assertTrue(Session::has('testKey'));
        $this->assertFalse(Session::has('nonExistentKey'));
    }

    public function testSet()
    {
        Session::set('testKey', 'testValue');
        $this->assertEquals('testValue', $_SESSION['testKey']);
    }

    public function testUnset()
    {
        $_SESSION['testKey'] = 'testValue';
        Session::unset('testKey');
        $this->assertArrayNotHasKey('testKey', $_SESSION);
    }
}
