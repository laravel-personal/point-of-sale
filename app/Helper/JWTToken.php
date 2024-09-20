<?php

namespace App\Helper;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class JWTToken
{
    /**
     * Generate JWT Token
     *
     * @param $userEmail
     * @return string
     */
    public static function generateToken($userEmail)
    {
        $payload = [
            'iss' => "lumen-jwt",
            'userEmail' => $userEmail,
            'iat' => time(),
            'exp' => time() + 60*60
        ];

        return JWT::encode($payload, env('JWT_KEY'), 'HS256');
    }

    /**
     * Decode JWT Token
     *
     * @param $token
     * @return string
     */
    public static function decodeToken($token)
    {
        try {
            return JWT::decode($token, new KEY( env('JWT_KEY'), 'HS256'))->userEmail;
        } catch (\Exception $e) {
            return 'Unauthorized';
        }
    }
}
