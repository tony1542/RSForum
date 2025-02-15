<?php

namespace Tests\Utils\Input;

use App\Utils\Input\Sanitizer;
use PHPUnit\Framework\TestCase;

class SanitizerTest extends TestCase
{
    public function testSanitize(): void
    {
        $this->assertSame('expected', Sanitizer::sanitize('expected'));
        $this->assertSame('no slashes', Sanitizer::sanitize('no \slashes'));
        $this->assertSame('&lt;script&gt;alert(&quot;something&quot;)&lt;/script&gt;', Sanitizer::sanitize('<script>alert("something")</script>'));
    }
}