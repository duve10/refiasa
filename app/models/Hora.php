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


    public static function obtenerListaHorasPorFecha($fecha) {
        $db = Database::getConnection(); // Asume que tienes una clase Database para la conexión

        $query = "SELECT T1.id,T1.hora,T2.id AS idCita FROM lista_horas T1
                    LEFT JOIN cita T2 ON T1.id = T2.id_hora AND T2.fecha = :fecha AND T2.estado = 1
                    ORDER BY T1.hora;";

        $stmt = $db->prepare($query);
        $stmt->bindValue(':fecha', $fecha);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }
}