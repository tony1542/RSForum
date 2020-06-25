<?php

namespace Tests\Models\Equipment\Armor;

use App\Models\Equipment\Armor\Bronze;
use Tests\BaseTest;

class BronzeTest extends BaseTest
{
    public function testGetDefenceLevel(): void
    {
        $bronze = new Bronze();
        $this->assertEquals(1, $bronze->getDefenceLevel());
    }
}
