<?php

// Note the namespace. Our global one is App, but we are within the 'Classes' directory, so we add it to the namespace link
// Again, think of this like a website's directory layout
namespace App\Classes;

// Base class for runescape armor
// Note the use of the word 'abstract' here. It means you cannot instantiate it. (Cannot use $armor = new Armor())
abstract class Armor {
    // Abstract function here telling all children classes they MUST implement their own version of this
    // An example of this would be a bronze child class returning 1
    abstract function getDefenceLevel();
}
