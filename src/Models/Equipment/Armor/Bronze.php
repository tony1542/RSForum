<?php

namespace App\Models\Equipment\Armor;

class Bronze extends Armor
{
    public function getDefenceLevel(): int
    {
        return 1;
    }
}
