<?php

namespace Tests\Utils\Traits;

use App\Utils\Traits\Json;
use PHPUnit\Framework\TestCase;

class JsonTest extends TestCase
{
    use Json;

    public function testToJson(): void
    {
        $this->assertSame('{"test":true}', $this->toJson(['test' => true]));
    }
}