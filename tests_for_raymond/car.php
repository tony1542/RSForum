<?php

// This example is just going to build off of the last example
// More variables, more functions, a little more in-depth
class car {
    public $make = '';
    public $year = '';
    public $miles = '';
    
    public function __construct($make, $year, $miles) {
        $this->make = $make;
        $this->year = $year;
        $this->miles = $miles;
    }
    
    // We are going to a do a simple little calculation to check the cars make and return a price
    public function print_price() {
        // doing strtolower so the upper/lower case of make won't matter
        $make = strtolower($this->make);
        $price = null;
        
        if ($make === 'ford') {
            $price = 10000;
        }
    
        if ($make === 'chevy') {
            $price = 500;
        }
    
        if ($make === 'pontiac') {
            $price = -5000; // lol
        }
        
        echo "<h5>Price: " . $price . "</h5>";
    }
    
    // helper function that will nicely output our object data
    public function print_data() {
        echo "<h5>Make: " . $this->make . "</h5>";
        echo "<h5>Year: " . $this->year . "</h5>";
        echo "<h5>Miles: " . $this->miles . "</h5>";
    }
}
