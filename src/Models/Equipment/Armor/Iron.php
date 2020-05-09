<?php

namespace App\Models\Equipment\Armor;

class Iron extends Armor
{
    public function getDefenceLevel(): int
    {
        return 5;
    }
}
