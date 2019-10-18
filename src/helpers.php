<?php

/**
 * Used to 'pretty-print' any array, object, or the like
 *
 * @param mixed $array
 * @param bool  $verbose - A flag to specify whether we want a print_r or a more verbose var_dump
 */
function dump($array, $verbose = false) {
    $method = $verbose ? 'var_dump' : 'print_r';
    echo '<pre>'; $method($array); echo '</pre>';
}

/**
 * Dump and die
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
 * Redirect to a new page
 *
 * @param string $path
 */
function redirect($path)
{
    header('Location: /' . $path);
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
    // This extract function allows our views to be able to communicate with the data passed in
    // @see https://www.php.net/manual/en/function.extract.php
    // @see https://www.php.net/manual/en/function.get-defined-vars.php - You can play with this function by using it with 'extract()' commented out and then not to see the difference
    extract($data, EXTR_OVERWRITE);
    
    // Our 'home-page' or master page
    $page = __DIR__ . '/../public/views/partials/page.php';
    
    // Our error partial
    $error_file = __DIR__ . '/../public/views/partials/error.php';
    
    // The dynamic file name we are grabbing
    $file_name = __DIR__ . '/../public/views/' . $name . '.php';
    
    $data['rendered_view'] = null;
    $data['rendered_errors'] = null;
    
    if (is_file($file_name)) {
        ob_start();
        require($file_name);
        $data['rendered_view'] = ob_get_clean();
        
        // If there are any errors passed to our view, render them & send them into our view
        if (isset($data['errors']) && count($data['errors']) && $name !== 'partials/error') {
            ob_start();
            require($error_file);
            $data['rendered_errors'] = ob_get_clean();
        }
    }
    
    require($page);
    die;
}

function isLocalhost() {
    return $_SERVER['SERVER_NAME'] === 'localhost';
}
