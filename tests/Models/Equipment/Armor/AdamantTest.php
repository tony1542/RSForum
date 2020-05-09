<?php

namespace Tests\Models\Equipment\Armor;

use App\Models\Equipment\Armor\Adamant;
use Tests\BaseTest;

class AdamantTest extends BaseTest
{
    public function testGetDefenceLevel(): void
    {
        $adamant = new Adamant();
        $this->assertEquals(30, $adamant->getDefenceLevel());
    }
}
