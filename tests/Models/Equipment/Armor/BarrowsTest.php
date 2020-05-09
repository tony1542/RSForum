<?php

namespace Tests\Models\Equipment\Armor;

use App\Models\Equipment\Armor\Barrows;
use Tests\BaseTest;

class BarrowsTest extends BaseTest
{
    public function testGetDefenceLevel(): void
    {
        $barrows = new Barrows();
        $this->assertEquals(70, $barrows->getDefenceLevel());
    }
}
