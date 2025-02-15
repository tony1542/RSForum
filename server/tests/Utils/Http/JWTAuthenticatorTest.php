<?php

namespace Tests\Utils\Http;

use PHPUnit\Framework\TestCase;
use App\Utils\Http\JWTAuthenticator;
use Firebase\JWT\JWT;

class JWTAuthenticatorTest extends TestCase
{
    private $secretKey = 'your_secret_key';

    protected function setUp(): void
    {
        putenv("JWT_SECRET_KEY={$this->secretKey}");
    }

    public function testGenerate()
    {
        $data = [
            'id' => 1,
            'username' => 'testuser',
            'email' => 'testuser@example.com'
        ];

        $jwt = JWTAuthenticator::generate($data);

        $decoded = JWT::decode($jwt, $this->secretKey, ['HS256']);
        $this->assertEquals($data['id'], $decoded->data->id);
        $this->assertEquals($data['username'], $decoded->data->username);
        $this->assertEquals($data['email'], $decoded->data->email);
    }

    public function testAuthenticateValidToken()
    {
        $data = [
            'id' => 1,
            'username' => 'testuser',
            'email' => 'testuser@example.com'
        ];

        $jwt = JWTAuthenticator::generate($data);
        $result = JWTAuthenticator::authenticate($jwt);

        $this->assertInstanceOf(\stdClass::class, $result);
        $this->assertEquals($data['id'], $result->data->id);
        $this->assertEquals($data['username'], $result->data->username);
        $this->assertEquals($data['email'], $result->data->email);
    }

    public function testAuthenticateExpiredToken()
    {
        $data = [
            'id' => 1,
            'username' => 'testuser',
            'email' => 'testuser@example.com'
        ];

        $issuedAt = time() - 3600; // 1 hour ago
        $expireAt = time() - 1800; // 30 minutes ago

        $payload = array(
            "iss" => $this->secretKey,
            "aud" => "RSForum",
            "iat" => $issuedAt,
            "nbf" => $issuedAt,
            "exp" => $expireAt,
            "data" => $data
        );

        $jwt = JWT::encode($payload, $this->secretKey);

        $result = JWTAuthenticator::authenticate($jwt);

        $this->assertFalse($result);
    }

    public function testAuthenticateInvalidToken()
    {
        $invalidJwt = 'invalid.jwt.token';
        $result = JWTAuthenticator::authenticate($invalidJwt);
        $this->assertFalse($result);
    }
}

