<?php

namespace App\Classes\Equipment\Weapons\Daggers;

use App\Classes\Equipment\Weapons\Weapon;

abstract class Dagger extends Weapon {
    abstract public function levelRequirement();
}
