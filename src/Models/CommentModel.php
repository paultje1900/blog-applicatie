<?php

namespace App\Models;

use App\Core\Database;

class CommentModel extends BaseModel
{
    protected static string $table = 'comments';

    public static function findByPostId(int $postId): array
    {
        return Database::query(
            "SELECT comments.*, users.username
             FROM comments
             JOIN users ON comments.user_id = users.id
             WHERE comments.post_id = ?
             ORDER BY comments.created_at ASC",
            [$postId]
        )->fetchAll();
    }
}