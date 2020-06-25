<?php

namespace Tests\Models\Equipment\Armor;

use App\Models\Equipment\Armor\Justiciar;
use Tests\BaseTest;

class JusticiarTest extends BaseTest
{
    public function testGetDefenceLevel(): void
    {
        $justiciar = new Justiciar();
        $this->assertEquals(75, $justiciar->getDefenceLevel());
    }
}
