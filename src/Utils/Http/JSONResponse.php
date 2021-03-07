<?php

namespace App\Utils\Http;

class JSONResponse
{
    public static function send(string $response): void
    {
        header('Content-type: application/json');
        echo json_encode($response);
    }
}
