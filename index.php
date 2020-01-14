<?php

require('vendor/autoload.php');

use App\Utils\Http\Router;

try {
    setApplicationVariables();
    Router::callAction();
} catch (Throwable $t) {
    view('partials/error', [
        'errors' => [
            '<h4>Message</h4> ' . $t->getMessage(),
            '<h4>File</h4><pre>' . $t->getFile() . '</pre>',
            '<h4>Line</h4><pre>' . $t->getLine() . '</pre>',
            '<h4>Trace</h4><pre>' . $t->getTraceAsString() . '</pre>'
        ]
    ]);
}
