<?php
class Database {
    // Configuración de conexión a la base de datos
    private const DB_HOST = 'localhost'; // Cambiar según tu configuración
    private const DB_NAME = 'refiasa'; // Cambiar según tu configuración
    private const DB_USER = 'root'; // Cambiar según tu configuración
    private const DB_PASS = ''; // Cambiar según tu configuración
    private const DB_CHARSET = 'utf8mb4'; // Cambiar según tu configuración
    
    private static $connection = null;

    // Método para obtener la conexión a la base de datos
    public static function getConnection() {
        if (self::$connection === null) {
            try {
                self::$connection = new PDO(
                    "mysql:host=" . self::DB_HOST . ";dbname=" . self::DB_NAME . ";charset=" . self::DB_CHARSET,
                    self::DB_USER,
                    self::DB_PASS
                );
                self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die("Error de conexión: " . $e->getMessage());
            }
        }
        return self::$connection;
    }

    // Método para cerrar la conexión a la base de datos
    public static function closeConnection() {
        self::$connection = null;
    }
}
?>
