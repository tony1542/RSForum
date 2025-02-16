<?php

namespace App\Utils\Http;

use Exception;
use Firebase\JWT\JWT;
use stdClass;

class JWTAuthenticator
{
    public static function authenticate(string $jwt): bool|stdClass
    {
        try {
            return JWT::decode($jwt, self::getSecretKey(), array("HS256"));
        } catch (Exception) {
            return false;
        }
    }

    private static function getSecretKey(): string
    {
        return $_ENV["JWT_SECRET_KEY"];
    }

    public static function generate(array $data): string
    {
        $issuer_claim = self::getSecretKey();
        $audience_claim = "RSForum";
        $issuedat_claim = time(); // issued at
        $notbefore_claim = $issuedat_claim; // not before in seconds
        $expire_claim = $issuedat_claim + (60 * 60 * 60 * 60 * 60); // expire time in seconds
        $payload = array(
            "iss" => $issuer_claim,
            "aud" => $audience_claim,
            "iat" => $issuedat_claim,
            "nbf" => $notbefore_claim,
            "exp" => $expire_claim,
            "data" => array(
                "id" => $data["id"],
                "username" => $data["username"],
                "email" => $data["email"]
            )
        );

        return JWT::encode($payload, self::getSecretKey());
    }
}
