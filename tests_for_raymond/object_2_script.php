<?php

// including our class so we can use it in this script
include 'car.php';
include 'rune_Char.php';

$bandos = new rune_char('Bandos', 0, 65, 'Tony X');
$bandos->print_item();
$bandos->help_tony_print_data();

echo "<hr>";

$bronze= new rune_char('Bronze', 99, 1, 'Tony X');
$bronze->print_item();
$bronze->help_tony_print_data();

echo "<hr>";

$Justiciar = new rune_Char('Justiciar', 643, 99999999, 'Tony X');
$Justiciar->print_item();
$Justiciar->help_tony_print_data();

echo "<hr>";

$dragon = new runescape_user('Dragon', 0, 60, 'Kize');
$dragon->print_item2();
$dragon->help_kize_print_data();

echo "<hr>";

$iron = new runescape_user('Iron', 0, 10, 'Kize');
$iron->print_item2();
$iron->help_kize_print_data();

echo "<hr>";

$bronzet = new runescape_user('bronzeT', 19999901, 1, "Kize");
$bronzet->print_item2();
$bronzet->help_kize_print_data();

if($bandos->user === "Tony X" && $dragon->user2 === 'Kize') {
    echo "<hr>";
    echo "While " . $bandos->user . " can afford bandos, " . $dragon->user2 . " cannot afford Bandos. GG";

}
