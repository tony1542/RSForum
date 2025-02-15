<?php

namespace Tests\Utils\Traits;

use PHPUnit\Framework\TestCase;

class Json extends TestCase
{
    use \App\Utils\Traits\Json;

    public function testToJson(): void
    {
        $this->assertSame('{"test":true}', $this->toJson(['test' => true]));
    }
}