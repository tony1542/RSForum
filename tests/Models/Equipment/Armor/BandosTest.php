<?php

namespace Tests\Models\Equipment\Armor;

use App\Models\Equipment\Armor\Bandos;
use Tests\BaseTest;

class BandosTest extends BaseTest
{
    
    public function testGetDefenceLevel(): void
    {
        $bandos = new Bandos();
        $this->assertEquals(65, $bandos->getDefenceLevel());
    }
}
