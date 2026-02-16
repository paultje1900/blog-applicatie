<?php

namespace App\Core;

class Csrf
{
    public static function token(): string
    {
        if (!Session::get('_token')) {
            Session::set('_token', bin2hex(random_bytes(32)));
        }

        return Session::get('_token');
    }

    public static function verify(): void
    {
        $token = trim($_POST['_token'] ?? '');
        $sessionToken = trim(Session::get('_token') ?? '');

        if (!hash_equals($sessionToken, $token)) {
            http_response_code(403);
            die('CSRF token mismatch.');
        }
    }

    public static function field(): string
    {
        return '<input type="hidden" name="_token" value="' . self::token() . '">';
    }
}