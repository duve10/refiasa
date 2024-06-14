<?php

class Horas {
    public static function obtenerListaHoras() {
        $db = Database::getConnection(); // Asume que tienes una clase Database para la conexión

        $query = "SELECT id, hora FROM lista_horas";
        $stmt = $db->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }
}