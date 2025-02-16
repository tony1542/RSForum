<?php

namespace Tests\Utils\Runescape;

use App\Utils\Runescape\Levels;
use PHPUnit\Framework\TestCase;

class LevelsTest extends TestCase
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
            $this->assertSame($level, Levels::findFromExp($experience));
        }

        $this->assertSame(99, Levels::findFromExp(200_000_000, false));
    }

    public function testGetTotalLevel(): void
    {
        $this->assertSame(141, Levels::getTotalLevel([20, 15, 25, 10, 30, 5, 20, 16]));
        $this->assertSame(220, Levels::getTotalLevel([126, 15, 25, 10, 30, 5, 20, 16]));
        $this->assertSame(0, Levels::getTotalLevel([]));
        $this->assertSame(0, Levels::getTotalLevel(['string', 'still not a number']));
    }

    public function testGetTotalVirtualLevel(): void
    {
        $this->assertSame(258, Levels::getTotalLevel([126, 126, 1, 1, 1, 1, 1, 1], true));
    }
}