<?php

echo "<h3>Example 1 - by variable</h3>";

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

############################################################################################################################3
echo "<h3>Example 2 - by function</h3>";


/*
 * So lets break that down a little more, our $player variable is an instance of the `player` class, right?
 * We used the constructor and passed in a username like it asks for, and then we print out the variable by using the `->` symbol in PHP
 * `->` just means 'access to a function / variable' of an object.
 * I'm going to do the same example as above, but with a function to print out the username.
 */

class player_two {
    // Notice this was changed from 'public' to 'protected'
    // This is called changing visibility. It means that ONLY the object itself & its children can access this variable.
    // It means that if we want to print out the username anywhere else, we will need to use our `getUsername` function
    protected $username = '';
    
    public function __construct($username) {
        $this->username = $username;
    }
    
    // Print out our username variable
    public function getUsername() {
        return $this->username;
    }
}

// Now that we have our basic class declaration, lets instantiate our `player` class, and print out the username we fed it by calling the function
$player = new player_two('Tony_x');
echo $player->getUsername();