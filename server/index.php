<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With');
header('Access-Control-Allow-Methods: POST, GET, PATCH, DELETE');
header('Content-Type: application/json');

require('vendor/autoload.php');

use App\Models\User\User;
use App\Utils\EnvException;
use App\Utils\Http\JWTAuthenticator;
use App\Utils\Http\Router;
use App\Utils\Http\Server;

try {
    setApplicationVariables();

    $header = Server::getAuthHeader();
    if ($header) {
        $decoded = JWTAuthenticator::authenticate($header);

        // JWT failed
        if ($decoded === false) {
            header('HTTP/1.1 401 Unauthorized');
            jsonResponse([
                'message' => 'Access denied.'
            ]);
        } else {
            setSignedInUser(new User($decoded->data->id));
        }
    }

    Router::callAction();
} catch (Throwable $t) {
    $errors = ['Something went wrong.'];

    if (Server::isLocalHost() || getSignedInUser()->isAdmin()) {
        $errors = [
            'Message ' . $t->getMessage(),
            'File ' . $t->getFile(),
            'Line ' . $t->getLine(),
            'Trace ' . $t->getTraceAsString(),
        ];

        if ($t instanceof EnvException) {
            $errors = [$t->getMessage()];
        }
    }

    \jsonResponse([
        'errors' => $errors
    ]);
}

die;
