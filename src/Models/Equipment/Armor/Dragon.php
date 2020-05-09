<?php

namespace App\Models\Equipment\Armor;

class Dragon extends Armor
{
    public function getDefenceLevel(): int
    {
        return 60;
    }
}
