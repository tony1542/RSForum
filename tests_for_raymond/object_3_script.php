<?php

include 'person.php';

// TODO make 3 different instances of the 'person' class and pass it the 3 ages shown in the 'get_status' function
// have it print out the 3 different strings shown in the function's TODO
$Tony = new person('23', 'Tony');
$Tony->get_status();
$Tony->print_data();

echo "<hr>";

$Ray = new person('26', "Ray");
$Ray->get_status();
$Ray->print_data();

echo "<hr>";

$Susan = new person("52", "Susan");
$Susan->get_status();
$Susan->print_data();

echo "<hr>";

$Ghost = new person('1250', "Casper");
$Ghost->get_status();
$Ghost->print_data();