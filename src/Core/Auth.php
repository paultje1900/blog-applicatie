<?php

namespace App\Core;

class Auth
{
    private static ?array $currentUser = null;

    public static function attempt(string $email, string $password): bool
    {
        $user = Database::query(
            "SELECT * FROM users WHERE email = ?",
            [$email]
        )->fetch();

        if (!$user) {
            return false;
        }

        if (!password_verify($password, $user['password'])) {
            return false;
        }

        Session::regenerate();
        Session::set('user_id', $user['id']);

        return true;
    }

    public static function register(string $username, string $email, string $password): string
    {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        Database::query(
            "INSERT INTO users (username, email, password) VALUES (?, ?, ?)",
            [$username, $email, $hashedPassword]
        );

        $userId = Database::lastInsertId();

        Session::regenerate();
        Session::set('user_id', $userId);

        return $userId;
    }

    public static function user(): ?array
    {
        if (self::$currentUser !== null) {
            return self::$currentUser;
        }

        $userId = Session::get('user_id');
        if (!$userId) {
            return null;
        }

        self::$currentUser = Database::query(
            "SELECT id, username, email FROM users WHERE id = ?",
            [$userId]
        )->fetch();

        if (!self::$currentUser) {
            self::logout();
            return null;
        }

        return self::$currentUser;
    }

    public static function check(): bool
    {
        return self::user() !== null;
    }

    public static function logout(): void
    {
        Session::remove('user_id');
        Session::regenerate();
        self::$currentUser = null;
    }
}