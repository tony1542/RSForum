<?php

// including our class so we can use it in this script
include 'car.php';

$bandos = new rune_char('Bandos', 0, 65, 'Tony X', 'Kize');
$bandos->print_item();
$bandos->help_tony_print_data();

echo "<hr>";

$bronze= new rune_char('Bronze', 99, 1, 'Tony X', 'Kize');
$bronze->print_item();
$bronze->help_tony_print_data();

echo "<hr>";

$Justiciar = new rune_Char('Justiciar', 643, 99999999, 'Tony X', 'Kize');
$Justiciar->print_item();
$Justiciar->help_tony_print_data();
