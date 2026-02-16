<?php

namespace App\Core;

use PDO;
use PDOStatement;
use PDOException;

class Database
{
    private static ?PDO $connection = null;

    private static function getConnection(): PDO
    {
        if (self::$connection !== null) {
            return self::$connection;
        }

        $host     = $_ENV['DB_HOST'];
        $port     = $_ENV['DB_PORT'];
        $database = $_ENV['DB_DATABASE'];
        $username = $_ENV['DB_USERNAME'];
        $password = $_ENV['DB_PASSWORD'];

        $dsn = "mysql:host={$host};port={$port};dbname={$database};charset=utf8mb4";

        self::$connection = new PDO($dsn, $username, $password, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ]);

        return self::$connection;
    }

    public static function query(string $sql, array $params = []): PDOStatement
    {
        $stmt = self::getConnection()->prepare($sql);
        $stmt->execute($params);
        return $stmt;
    }

    public static function lastInsertId(): string
    {
        return self::getConnection()->lastInsertId();
    }
}