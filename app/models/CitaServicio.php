<?php
class CitaServicio
{
    public static function asignarServicioACita($idCita, $idServicio)
    {
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

    public static function getAllServiciosByCita($idCita)
    {
        $db = Database::getConnection();
        $sql = 'SELECT t1.id  as id_servicio,t1.nombre,t2.id_cita as selected  FROM  servicio t1
                left join cita_servicio t2 on t2.id_servicio = t1.id and t2.id_cita = :idCita WHERE  t1.estado = 1 and t1.citas = 1';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':idCita', $idCita, PDO::PARAM_INT);

        $result = $stmt->execute();
        $servicios = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // Cerrar la conexión
        Database::closeConnection($db);

        return $servicios;
    }
}
