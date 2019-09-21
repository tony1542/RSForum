<?php

require('vendor/autoload.php');

/**
 * This file is overhauled. We are dynamically routing the requested uri through our Router class to call the requested controller and its action
 *
 * EXAMPLE (these classes don't exist yet, they are just to help understand how the routing works)
 * let's say we have this as a URL "/Character/Show/23"
 * the 1st spot, Character, is our controller (CharactersController)
 * the 2nd spot, 'Show' is the function we are calling (CharactersController->show)
 * the 3rd spot (optional), is the ID we are passing (CharactersController->show(23))
 *
 * This might be hard to understand at first, but we can break it down and try a bunch of examples to show how it works
 *
 * Also the try/catch is a concept that isn't important to know for now.
 * Just know that it will catch errors that are thrown and will be displayed in our '/partials/error.php' template!
 */

use App\Http\Router;

try {
    session_start();
    Router::callAction();
} catch (Exception $e) {
    view('partials/error', ['errors' => [$e->getMessage()]]);
}
