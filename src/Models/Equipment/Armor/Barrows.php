<?php

namespace App\Models\Equipment\Armor;

class Barrows extends Armor
{
    public function getDefenceLevel(): int
    {
        return 70;
    }
}
