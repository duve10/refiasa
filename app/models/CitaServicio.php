<?php
class CitaServicio {
    public static function asignarServicioACita($idCita, $idServicio) {
        $db = Database::getConnection();
        $sql = 'INSERT INTO cita_servicio (id_cita, id_servicio) VALUES (:idCita, :idServicio)';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':idCita', $idCita, PDO::PARAM_INT);
        $stmt->bindValue(':idServicio', $idServicio, PDO::PARAM_INT);
        
        $result = $stmt->execute();

        // Cerrar la conexión
        Database::closeConnection($db);

        return $result;
    }
}
?>
