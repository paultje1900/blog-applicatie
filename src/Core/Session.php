<?php

namespace App\Core;

class Session
{

    private static bool $started = false;

    public static function start(): void
    {
        if (self::$started) {
            return;
        }

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        self::$started = true;
    }

    public static function get(string $key, mixed $default = null): mixed
    {
        self::start();
        return $_SESSION[$key] ?? $default;
    }

    public static function set(string $key, mixed $value): void
    {
        self::start();
        $_SESSION[$key] = $value;
    }

    public static function has(string $key): bool
    {
        self::start();
        return isset($_SESSION[$key]);
    }

    public static function remove(string $key): void
    {
        self::start();
        unset($_SESSION[$key]);
    }

    public static function flash(string $key, string $message): void
    {
        self::start();
        $_SESSION['_flash'][$key] = $message;
    }

    public static function getFlash(string $key): ?string
    {
        self::start();

        $message = $_SESSION['_flash'][$key] ?? null;

        unset($_SESSION['_flash'][$key]);

        if (empty($_SESSION['_flash'])) {
            unset($_SESSION['_flash']);
        }

        return $message;
    }

    public static function hasFlash(string $key): bool
    {
        self::start();
        return isset($_SESSION['_flash'][$key]);
    }

    public static function setOld(array $data): void
    {
        self::start();
        $_SESSION['_old'] = $data;
    }

    public static function getOld(string $key, string $default = ''): string
    {
        self::start();

        $value = $_SESSION['_old'][$key] ?? $default;

        // Verwijder deze specifieke key uit _old
        unset($_SESSION['_old'][$key]);

        // Ruim _old op als die leeg is
        if (empty($_SESSION['_old'])) {
            unset($_SESSION['_old']);
        }

        return $value;
    }

    public static function isLoggedIn(): bool
    {
        return self::has('user_id');
    }

    public static function userId(): ?int
    {
        $id = self::get('user_id');
        return $id !== null ? (int) $id : null;
    }

    public static function login(int $userId): void
    {
        self::start();
        session_regenerate_id(true);
        $_SESSION['user_id'] = $userId;
    }

    public static function logout(): void
    {
        self::start();

        $_SESSION = [];

        if (ini_get('session.use_cookies')) {
            $params = session_get_cookie_params();
            setcookie(
                session_name(),
                '',
                time() - 42000,
                $params['path'],
                $params['domain'],
                $params['secure'],
                $params['httponly']
            );
        }

        session_destroy();
        self::$started = false;
    }
}