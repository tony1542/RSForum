<?php

// This example is just going to build off of the last example
// More variables, more functions, a little more in-depth
class rune_char {
    public $gear = ''; //gear is Make
    public $str = ''; //Str is year
    public $def = ''; // def is miles
    public $user = '';
    public $gp = 0; // Should be by itself
    
    public function __construct($gear, $str, $def, $user, $gp) {
        $this->gear = $gear;
        $this->str = $str;
        $this->def = $def;
        $this->user = $user;
        $this->gp = $gp;
    }
    
    //Calculation to check item and if user can afford it.
    public function print_item() {
        //if you were checking for a word and didn't want uppper/lower to matter, use strtolower($this->$att);
        $gear = strtolower($this->gear);
        $gp = $this->gp;
        $can_buy = false; //set can_buy to false so it will auto echo get rinsed until you pass enough gp into the if statement.
        
        // check for $gp here in the if statement instead of re-assinging it on line 29 right?
        // something similar to this:
        // if ($gear === 'bandos' && $gp >= 49152369)
        if ($gear === 'bandos' && $gp >= 49152369) {
            $can_buy = true;
        }
        
        if ($gear === 'bronze' && $gp >= 1266) {
            $can_buy = true;
        }
        
        if ($gear === 'justiciar' && $gp >= 67490862) {
            $can_buy = true;
        }
        
        if ($can_buy == true) {
            echo $this->user . " can buy this gear.";
        } else {
            echo  $this->user ." can not buy this gear, get rinsed kid; you're not tall enough to ride.";
        }
    }
    
    public function print_data() {
        echo "<h5>Gear : " . $this->gear . "</h5>";
        echo "<h5>Strength: " . $this->str . "</h5>";
        echo "<h5>Defence: " . $this->def . "</h5>";
    }
}
