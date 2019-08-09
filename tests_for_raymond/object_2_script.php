<?php

// including our class so we can use it in this script
include 'car.php';

$ford = new car('Ford', 2010, 156000);
$ford->print_price();
$ford->print_data();

echo "<hr>";

$chevy = new car('chevy', 2017, 12500);
$chevy->print_price();
$chevy->print_data();

echo "<hr>";

$pontiac = new car('Pontiac', 1874, 99999999);
$pontiac->print_price();
$pontiac->print_data();
