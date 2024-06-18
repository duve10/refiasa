<?php

require_once '../app/config/Database.php';

class Raza {
    public static function getRazaByEspecie($id_especie) {
        $db = Database::getConnection(); // Asume que tienes una clase Database para la conexión

        $sql = "SELECT id, nombre FROM raza WHERE estado = 1 and id_especie = :id_especie";
        $stmt = $db->prepare($sql);

        $stmt->bindValue(':id_especie', $id_especie, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // Cerrar la conexión después de utilizarla
        Database::closeConnection();
        return $result;
    }
}