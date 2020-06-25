<?php

namespace Tests\Models\Equipment\Armor;

use App\Models\Equipment\Armor\Iron;
use Tests\BaseTest;

class IronTest extends BaseTest
{
    public function testGetDefenceLevel(): void
    {
        $iron = new Iron();
        $this->assertEquals(1, $iron->getDefenceLevel());
    }
}
