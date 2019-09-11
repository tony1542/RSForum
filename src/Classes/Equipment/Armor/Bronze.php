<?php

namespace App\Classes\Equipment\Armor;

// Use the 'extends' keyword and specify a class name to become a child class of it.
// This means we inherit anything the parent has that isn't marked with 'private' as a visibility
class Bronze extends Armor {
    public function getDefenceLevel() {
        return 1;
    }
}
