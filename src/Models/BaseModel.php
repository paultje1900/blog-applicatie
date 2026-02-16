<?php

namespace App\Models;

use App\Core\Database;

abstract class BaseModel
{
    protected static string $table = '';

    public static function findById(int $id): array|false
    {
        return Database::query(
            "SELECT * FROM " . static::$table . " WHERE id = ?",
            [$id]
        )->fetch();
    }

    public static function findAll(): array
    {
        return Database::query(
            "SELECT * FROM " . static::$table . " ORDER BY created_at DESC"
        )->fetchAll();
    }

    public static function create(array $data): string
    {
        $columns = implode(', ', array_keys($data));
        $placeholders = implode(', ', array_fill(0, count($data), '?'));

        Database::query(
            "INSERT INTO " . static::$table . " ({$columns}) VALUES ({$placeholders})",
            array_values($data)
        );

        return Database::lastInsertId();
    }

    public static function update(int $id, array $data): void
    {
        $setClause = implode(', ', array_map(
            fn($col) => "{$col} = ?",
            array_keys($data)
        ));

        Database::query(
            "UPDATE " . static::$table . " SET {$setClause} WHERE id = ?",
            [...array_values($data), $id]
        );
    }

    public static function delete(int $id): void
    {
        Database::query(
            "DELETE FROM " . static::$table . " WHERE id = ?",
            [$id]
        );
    }
}