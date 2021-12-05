<?php

namespace App\Utils\Http;

use Exception;
use Firebase\JWT\JWT;

// TODO extract secret key into .env
class JWTAuthenticator
{
    private static function getSecretKey():string
    {
        return getenv('JWT_SECRET_KEY');
    }

    public static function authenticate($jwt)
    {
        try {
            $decoded = JWT::decode($jwt, self::getSecretKey(), array('HS256'));

            // Access is granted. Add code of the operation here
//                echo json_encode(array(
//                    "message" => "Access granted:",
//                    "error" => $e->getMessage()
//                ));


        } catch (Exception $e) {
            echo json_encode(array(
                "message" => "Access denied.",
                "error" => $e->getMessage()
            ));
        }
    }

    public static function test($data)
    {
        $issuer_claim = "localhost:8080"; // this can be the servername
        $audience_claim = "test_audience";
        $issuedat_claim = time(); // issued at
        $notbefore_claim = $issuedat_claim + 10; //not before in seconds
        $expire_claim = $issuedat_claim + 60; // expire time in seconds
        $payload = array(
            "iss" => $issuer_claim,
            "aud" => $audience_claim,
            "iat" => $issuedat_claim,
            "nbf" => $notbefore_claim,
            "exp" => $expire_claim,
            "data" => array(
                "id" => $data['id'],
                "username" => $data['username'],
                "email" => $data['email']
            )
        );

        jsonResponse(JWT::encode($payload, self::getSecretKey()));
    }
}
