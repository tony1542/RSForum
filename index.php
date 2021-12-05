<?php

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
header("Access-Control-Allow-Methods: POST, GET, PATCH, DELETE");
header('Content-Type: application/json');

require('vendor/autoload.php');

use App\Utils\Database\EnvException;
use App\Utils\Http\Router;
use App\Utils\Http\Server;

try {
    $header = Server::getAuthHeader();

    if ($header) {
        \App\Utils\Http\JWTAuthenticator::authenticate($header);
    }

    // TODO have a helper method here to check a JWT if it exists
    setApplicationVariables();
    Router::callAction();
} catch (Throwable $t) {
    $errors = ['Something went wrong.'];
    
    if (Server::isLocalHost() || getSignedInUser()->isAdmin()) {
        $errors = [
            'Message ' => [$t->getMessage()],
            'File '    => [$t->getFile()],
            'Line '    => [$t->getLine()],
            'Trace '   => [$t->getTraceAsString()],
        ];
        
        if ($t instanceof EnvException) {
            $errors = [$t->getMessage()];
        }
    }

    \jsonResponse($errors);
}

die;
