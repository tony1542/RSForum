<?php

include 'person.php';

// TODO make 3 different instances of the 'person' class and pass it the 3 ages shown in the 'get_status' function
// have it print out the 3 different strings shown in the function's TODO
$Tony = new person('23', 'Tony');
$Tony->print_data();
$Tony->get_status();

echo "<hr>";

$Ray = new person('26', "Ray");
$Ray->print_data();
$Ray->get_status();

echo "<hr>";

$Susan = new person("52", "Susan");
$Susan->print_data();
$Susan->get_status();

echo "<hr>";

$Ghost = new person('1250', "Casper");
$Ghost->print_data();
$Ghost->get_status();