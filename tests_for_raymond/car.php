<?php

// This example is just going to build off of the last example
// More variables, more functions, a little more in-depth
class rune_char {

    public $gear = ''; //gear is Make
    public $str = ''; //Str is year
    public $def = ''; // def is miles
    public $user = '';

    public function __construct($gear, $str, $def, $user) {

        $this->gear = $gear;
        $this->str = $str;
        $this->def = $def;
        $this->user = $user;
    }
        //Calculation to check item and if user can afford it.
        public function print_item(){
            //if you were checking for a word and didn't want uppper/lower to matter, use strtolower($this->$att);
            $gear = strtolower($this->gear);
            $user = $this->user;
            $gp = null;
            $can_buy = null;

            if($gear === 'bandos' && $user === 'Tony X') { // I know the && $user === Tony X isn't needed, just kept it. only 1 user so I dont need to be so specific.
                $gp = 49152369;
                $can_buy ='✓';
            }
            if ($gear === 'bronze' && $user === 'Tony X') {
                $gp = 1266;
                $can_buy ="✓, but it's beneath him.";
            }
            if ($gear === 'justiciar' && $user === 'Tony X'){
                $gp = 67490862;
                $can_buy = '✓';
            }
            echo "<h5>Gp Cost: $" . number_format($gp, 2 ,'.', ',') . "</h5>";
                echo "<h5>Can Tony X Buy this?: " . $can_buy . "</h5>";
        }
        //helper function that I'll use for Tony so his eyes stop bleeding.
        public function help_tony_print_data(){
            echo "<h5>Gear : " . $this->gear . "</h5>";
            echo "<h5>Strength: " . $this->str . "</h5>";
            echo "<h5>Defence: " . $this->def . "</h5>";
        }
}
