<?php

require('vendor/autoload.php');

use App\Utils\Database\EnvException;
use App\Utils\Http\Router;
use App\Utils\Http\Server;

try {
    setApplicationVariables();
    Router::callAction();
} catch (Throwable $t) {
    $errors = ['Something went wrong.'];
    
    if (Server::isLocalHost() || getSignedInUser()->isAdmin()) {
        $errors = [
            '<h4>Message</h4> ' . $t->getMessage(),
            '<h4>File</h4><pre>' . $t->getFile() . '</pre>',
            '<h4>Line</h4><pre>' . $t->getLine() . '</pre>',
            '<h4>Trace</h4><pre>' . $t->getTraceAsString() . '</pre>'
        ];
    
        if ($t instanceof EnvException) {
            $errors = [$t->getMessage()];
        }
    }
    
    view('partials/error', [
        'errors' => $errors
    ]);
}
