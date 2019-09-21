<?php

require('vendor/autoload.php');

use App\Http\Router;

try {
    session_start();
    Router::callAction();
} catch (Exception $e) {
    view('partials/error', ['errors' => [$e->getMessage()]]);
}
