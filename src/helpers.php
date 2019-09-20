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

/**
 * Function pulls in our header & footer and inserts our data in between
 * Note: this function will kill execution of the script when it is done
 *
 * @param string $name - The name of the view we want
 * @param mixed  $data - The various data being passed to the view
 *
 * @see https://www.php.net/manual/en/language.constants.predefined.php#constant.dir
 */
function view($name, $data = []) {
    // Our pre-made partials
    $header = __DIR__ . '/../public/views/partials/header.php';
    $footer = __DIR__ . '/../public/views/partials/footer.php';
    
    // The dynamic file name we are grabbing
    $file_name = __DIR__ . '/../public/views/' . $name . '.php';
    
    if (is_file($file_name)) {
        require $header;
        require $file_name;
        require $footer;
    }
    
    die;
}
