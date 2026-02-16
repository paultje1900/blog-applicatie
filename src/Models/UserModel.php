<?php

namespace App\Models;

use App\Core\Database;

class UserModel extends BaseModel
{
    protected static string $table = 'users';

    public static function findByEmail(string $email): array|false
    {
        return Database::query(
            "SELECT * FROM users WHERE email = ?",
            [$email]
        )->fetch();
    }

    public static function emailExists(string $email): bool
    {
        return Database::query(
            "SELECT id FROM users WHERE email = ?",
            [$email]
        )->fetch() !== false;
    }
}