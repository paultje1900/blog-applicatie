<?php

namespace App\Core;

use App\Models\UserModel;

class Auth
{
    private static array|false|null $currentUser = null;

    public static function register(string $username, string $email, string $password): string
    {
        $userId = UserModel::create([
            'username' => $username,
            'email'    => $email,
            'password' => password_hash($password, PASSWORD_DEFAULT),
        ]);

        Session::regenerate();
        Session::set('user_id', $userId);

        return $userId;
    }

    public static function attempt(string $email, string $password): bool
    {
        $user = UserModel::findByEmail($email);

        if (!$user || !password_verify($password, $user['password'])) {
            return false;
        }

        Session::regenerate();
        Session::set('user_id', $user['id']);

        return true;
    }

    public static function logout(): void
    {
        Session::remove('user_id');
        Session::regenerate();
        self::$currentUser = null;
    }

    public static function user(): array|false
    {
        if (self::$currentUser === null) {
            $userId = Session::get('user_id');

            if (!$userId) {
                self::$currentUser = false;
                return false;
            }

            self::$currentUser = UserModel::findById($userId);
        }

        return self::$currentUser;
    }

    public static function check(): bool
    {
        return self::user() !== false;
    }

    public static function guest(): bool
    {
        return !self::check();
    }
}