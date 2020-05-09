<?php

namespace Tests\Models\Equipment\Armor;

use App\Models\Equipment\Armor\Dragon;
use Tests\BaseTest;

class DragonTest extends BaseTest
{
    public function testGetDefenceLevel(): void
    {
        $dragon = new Dragon();
        $this->assertEquals(60, $dragon->getDefenceLevel());
    }
}
