<?php

namespace App\Models;

use App\Core\Database;

class PostModel extends BaseModel
{
    protected static string $table = 'posts';

    public static function findAllWithAuthor(): array
    {
        return Database::query(
            "SELECT posts.*, users.username
             FROM posts
             JOIN users ON posts.user_id = users.id
             ORDER BY posts.created_at DESC"
        )->fetchAll();
    }

    public static function findByIdWithAuthor(int $id): array|false
    {
        return Database::query(
            "SELECT posts.*, users.username
             FROM posts
             JOIN users ON posts.user_id = users.id
             WHERE posts.id = ?",
            [$id]
        )->fetch();
    }
}