<?php

class Database {
    private static $dsn = 'mysql:host=localhost;dbname=refiasa;charset=utf8mb4';
    private static $username = 'root';
    private static $password = '';

    public static function getConnection() {
        try {
            return new PDO(self::$dsn, self::$username, self::$password);
        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
            return null;
        }
    }
}
