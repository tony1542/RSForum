<?php

// including our class so we can use it in this script
include 'car.php';

// new up two instances of the class, one for me, one for you to compare
$bronze = new rune_char('Bronze', 99, 1, 'Tony X', 99999999);
$rune = new rune_char('Rune', 25, 85, 'KizeKaze', 11111111);

if ($bronze->user === 'Tony X' && $rune->user === 'KizeKaze') {
    // do things
}
