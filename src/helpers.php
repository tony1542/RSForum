<?php

/**
 * Used to 'pretty-print' any array, object, or the like.
 *
 * @param mixed $array
 * @param bool  $verbose - A flag to specify whether we want a print_r or a more verbose var_dump
 */
function dump($array, $verbose = false) {
    $method = $verbose ? 'var_dump' : 'print_r';
    echo '<pre>'; $method($array); echo '</pre>';
}

/**
 * Dump and die.
 *
 * @param mixed $array
 * @param bool  $verbose
 *
 * @see dump()
 */
function dd($array, $verbose = false) {
    dump($array, $verbose);
    die;
}
