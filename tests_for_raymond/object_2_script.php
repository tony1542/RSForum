<?php

// including our class so we can use it in this script
include 'car.php';

// new up two instances of the class, one for me, one for you to compare
$Runescape_playerTony = new rune_char('bandos', 99, 60, 'Tony X', 99999999);
$Runescape_playerTony->print_item();
$Runescape_playerTony->print_data();
echo "<hr>";
$Runescape_playerZez = new rune_char('bronze', 27, 1, 'Zezima', 1);
$Runescape_playerZez->print_item();
$Runescape_playerZez->print_data();

echo "<hr>";

$Runescape_playerKize = new rune_char('justiciar', 75, 85, 'KizeKaze', 3000000);
$Runescape_playerKize->print_item();
$Runescape_playerKize->print_data();

echo "<hr>";

$Runescape_playerShadeGang = new rune_char('bandos', 69, 35, 'ShadeGang', 999999999);
$Runescape_playerShadeGang->print_item();
$Runescape_playerShadeGang->print_data();

echo "<hr>";


if ($Runescape_playerTony->user === 'Tony X' && $Runescape_playerKize->user === 'KizeKaze') {
    echo $Runescape_playerTony->user . " can afford Bandos while " . $Runescape_playerKize->user . " can't afford Justiciar!";
}
