<?php
require_once '../app/config/Database.php';

class User {
    public $id;
    public $user;
    public $password;

    public const USER_NOT_FOUND = 1;
    public const WRONG_PASSWORD = 2;

    public static function authenticate($user, $password) {
        $db = Database::getConnection();
        if (!$db) {
            // Manejar error de conexión
            return null;
        }

        $stmt = $db->prepare('SELECT * FROM user WHERE username = :user');
        $stmt->execute(['user' => $user]);
        $user = $stmt->fetch(PDO::FETCH_OBJ);
        
      
        if (!$user) {
            return self::USER_NOT_FOUND;
        }

        if (!password_verify($password, $user->password)) {
            return self::WRONG_PASSWORD;
        }

        return $user;
    }
}
