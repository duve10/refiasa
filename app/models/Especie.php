<?php


class Especie {
    public static function getEspecies() {
        $db = Database::getConnection(); // Asume que tienes una clase Database para la conexión

        $query = "SELECT id, nombre FROM especie WHERE estado = 1";
        $stmt = $db->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // Cerrar la conexión después de utilizarla
        Database::closeConnection();
        return $result;
    }
}