<?php

class person {
    public $age = null;
    public $name = "";
    
    public function __construct($age, $name) {
        // TODO set the properties $name & $age to our parameters sent in
        $this->age = $age;
        $this->name = $name;
    }
    
    public function get_status() {
        // TODO if the age is below 25, print out 'young'
        // if the age is between 25 and 35 print out 'adult'
        // if the age is above 35, print 'old'

        $name = strtolower($this->name);
        $age = $this->age;

        //Checking age
        if ($age > 35 && $age < 130){
            echo  $name . " is old as hell";
        } else if ($age <= 35 && $age >= 25){
            echo  $name . " is extremely adult";
        }else if ($age < 25 && $age > 0){
            echo  $name . " is a young baby, ready to be smothered with a pillow.";
        }else {
            echo $name .", this is all a dream; wake up!";
        }
    }

    public function print_data() {
        echo "<h5>Name: " . $this->name ."</h5>";
        echo "<h5>age: " . $this->age ."</h5>";
    }
}
