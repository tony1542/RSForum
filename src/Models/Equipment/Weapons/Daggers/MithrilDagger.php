<?php

namespace App\Models\Equipment\Weapons\Daggers;

class MithrilDagger extends Dagger
{
    public function levelRequirement(): int
    {
        return 20;
    }
}
