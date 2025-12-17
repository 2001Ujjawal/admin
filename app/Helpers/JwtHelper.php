<?php

namespace App\Helpers;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use CodeIgniter\Cookie\Cookie;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;

class JwtHelper
{
    private static function generateJWTtoken(array $userData): string
    {
        $key = getenv('JWT_PRIVATE_KEY');
        $expireTime = 3600;

        if (strlen($key) < 32) {
            throw new Exception('JWT key must be at least 32 characters');
        }

        $payload = [
            'iss'  => base_url(),
            'iat'  => time(),
            'exp'  => time() + $expireTime,
            'data' => $userData
        ];

        return JWT::encode($payload, $key, 'HS256');
    }

    public static function setCookieToken(array $userData): ResponseInterface
    {
        $token = self::generateJWTtoken($userData);

        $cookie = new Cookie(
            getenv('COOKIE_NAME') ?? 'access_token',
            $token,
            [
                'expires'  => time() + 3600,
                'httponly' => true,   // MUST be true
                'secure'   => false,  // true in HTTPS
                'path'     => '/',
                'samesite' => 'Lax'
            ]
        );
        return service('response')->setCookie($cookie);
    }

    public static function verifyToken(string $token): object
    {
        $key = getenv('JWT_PRIVATE_KEY');
        return JWT::decode($token, new Key($key, 'HS256'));
    }
}
