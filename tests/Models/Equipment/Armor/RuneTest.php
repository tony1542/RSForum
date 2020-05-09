<?php

namespace Tests\Models\Equipment\Armor;

use App\Models\Equipment\Armor\Rune;
use Tests\BaseTest;

class RuneTest extends BaseTest
{
    public function testGetDefenceLevel(): void
    {
        $rune = new Rune();
        $this->assertEquals(40, $rune->getDefenceLevel());
    }
}
