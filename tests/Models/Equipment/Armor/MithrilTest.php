<?php

namespace Tests\Models\Equipment\Armor;

use App\Models\Equipment\Armor\Mithril;
use Tests\BaseTest;

class MithrilTest extends BaseTest
{
    public function testGetDefenceLevel(): void
    {
        $adamant = new Mithril();
        $this->assertEquals(20, $adamant->getDefenceLevel());
    }
}
