<?php

namespace App\Classes\Equipment\Weapons\Daggers;

use App\Classes\Equipment\Weapons\Weapon;

abstract class Dagger extends Weapon {
    // Function will be required for all children to provide an answer to
    abstract public function getLevelRequirement();
    
    // Giving the parent class the level requirement
    public function canWield() {
        return $this->getLevelRequirement();
    }
}
