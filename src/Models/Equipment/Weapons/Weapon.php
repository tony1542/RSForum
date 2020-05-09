<?php

namespace App\Models\Equipment\Weapons;

abstract class Weapon
{
    abstract public function levelRequirement(): int;
}
