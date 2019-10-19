<?php

namespace App\Models\Equipment\Weapons\Daggers;

use App\Models\Equipment\Weapons\Weapon;

abstract class Dagger extends Weapon
{
    abstract public function levelRequirement();
}
