<?php

namespace App\Utils\Http;

use DateTimeImmutable;
use Exception;
use Firebase\JWT\JWT;
use stdClass;

// TODO extract secret key into .env
class JWTAuthenticator
{
    private static function getSecretKey(): string
    {
        return getenv('JWT_SECRET_KEY');
    }

    public static function authenticate(string $jwt): bool|stdClass
    {
        try {
            $decoded = JWT::decode($jwt, self::getSecretKey(), array('HS256'));

            $now = new DateTimeImmutable();
            $timestamp = $now->getTimestamp();

            if ($decoded->nbf > $timestamp || $decoded->exp < $timestamp) {
                return false;
            }

            return $decoded;
        } catch (Exception $e) {
            return false;
        }
    }

    public static function generate(array $data): string
    {
        // TODO maybe move to an ENV key
        $issuer_claim = "localhost:8080";
        // TODO is this needed?
        $audience_claim = "test_audience";
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
                "id" => $data['id'],
                "username" => $data['username'],
                "email" => $data['email']
            )
        );

        return JWT::encode($payload, self::getSecretKey());
    }
}
