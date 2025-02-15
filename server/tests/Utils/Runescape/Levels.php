<?php

namespace Tests\Utils\Runescape;

use PHPUnit\Framework\TestCase;

class Levels extends TestCase
{
    public function testFindFromExp(): void
    {
        $cases = [
            1 => 1,
            969 => 9,
            368_598 => 62,
            3_972_294 => 87,
            13_034_431 => 99,
            200_000_000 => 126,
        ];

        foreach ($cases as $experience => $level) {
            $this->assertSame($level, \App\Utils\Runescape\Levels::findFromExp($experience));
        }

        $this->assertSame(99, \App\Utils\Runescape\Levels::findFromExp(200_000_000, false));
    }

    public function testGetTotalLevel(): void
    {
        $this->assertSame(141, \App\Utils\Runescape\Levels::getTotalLevel([20, 15, 25, 10, 30, 5, 20, 16]));
        $this->assertSame(0, \App\Utils\Runescape\Levels::getTotalLevel([]));
    }

    public function testGetTotalVirtualLevel(): void
    {
        $this->assertSame(258, \App\Utils\Runescape\Levels::getTotalLevel([126, 126, 1, 1, 1, 1, 1, 1], true));
    }
}