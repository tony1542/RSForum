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
        $old = false;       //set to false until true
        $adult = false;     //set to false until true
        $young = false;     //set to false until true

        //Checking age
        if ($age > 35 && $age < 130){
            $old = true; //if age is greater then 35 and less than 130, set it to true
        } else if ($age <= 35 && $age >= 25){
            $adult = true; //if age is less or equal to 35 AND greater or equal to 25, set it to true
        }else if ($age < 25 && $age > 0){
            $young = true; //if age is less then 25 AND greater than 0, set it to true
        }

        if ($old == true) {
            echo  $name . " is old as hell";
        }else if ($adult == true) {
            echo  $name . " is extremely adult";
        }else if ($young == true) {
            echo  $name . " is a young baby, ready to be smothered with a pillow.";
        } else {
            echo $name .", this is all a dream; wake up!";
        }
    }

    public function print_data() {
        echo "<h5>Name: " . $this->name ."</h5>";
        echo "<h5>age: " . $this->age ."</h5>";
    }
}
