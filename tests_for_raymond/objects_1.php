<?php

// We are going to take a closer look at what classes / objects are and what they can do boi
// The following is a very basic declaration of a class.

class player {
    // A public variable of the class means it can be accessed by anyone when we have an instance of it
    // I'll show an example of it below
    public $username = '';
    
    // This is the constructor, in PHP, constructors use the '__construct' naming conventions.
    // All constructors are named like this in modern PHP
    // We are going to pass in a parameter to assign to our username and then print it out.
    public function __construct($username) {
        // The $this keyword in php means the class that we are in. we do this to specifically say 'assign my variable $username'
        $this->username = $username;
    }
}

// Now that we have our basic class declaration, lets instantiate our `player` class, and print out the username we fed it
$player = new player('Tony_x');
echo $player->username;
