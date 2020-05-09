<?php

namespace App\Models\Equipment\Armor;

class Mithril extends Armor
{
    public function getDefenceLevel(): int
    {
        return 20;
    }
}
