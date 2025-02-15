<?php

namespace Tests\Utils\Container;

use PHPUnit\Framework\TestCase;
use App\Utils\Container\DependencyInjectionContainer;
use Psr\Container\NotFoundExceptionInterface;

class DependencyInjectionContainerTest extends TestCase
{
    public function testSetAndHas()
    {
        $container = new DependencyInjectionContainer();
        $container->set('testKey', 'testValue');

        $this->assertTrue($container->has('testKey'));
        $this->assertFalse($container->has('nonExistentKey'));
    }

    public function testGet()
    {
        $container = new DependencyInjectionContainer();
        $container->set('testKey', 'testValue');

        $this->assertEquals('testValue', $container->get('testKey'));
    }

    public function testGetNotFound()
    {
        $this->expectException(NotFoundExceptionInterface::class);
        $this->expectExceptionMessage('Could not find requested resource (nonExistentKey) in the container.');

        $container = new DependencyInjectionContainer();
        $container->get('nonExistentKey');
    }
}
