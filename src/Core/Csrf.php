<?php

namespace App\Core;

class Csrf
{
    private const TOKEN_KEY = '_csrf_token';

    public static function token(): string
    {
        Session::start();

        if (Session::has(self::TOKEN_KEY)) {
            return Session::get(self::TOKEN_KEY);
        }

        $token = bin2hex(random_bytes(32));

        Session::set(self::TOKEN_KEY, $token);

        return $token;
    }

    public static function verify(?string $token): bool
    {
        Session::start();

        $sessionToken = Session::get(self::TOKEN_KEY);

        if ($sessionToken === null || $token === null) {
            self::fail();
        }

        if (!hash_equals($sessionToken, $token)) {
            self::fail();
        }

        return true;
    }

    private static function fail(): never
    {
        http_response_code(403);
        require __DIR__ . '/../../templates/errors/403.php';
        exit;
    }
}