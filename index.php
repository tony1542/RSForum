<?php

require('vendor/autoload.php');

use App\Utils\Http\Router;

try {
    setApplicationVariables();
    Router::callAction();
} catch (Exception $e) {
    view('partials/error', ['errors' => [$e->getMessage()]]);
}
