<?php
class AtencionServicio
{
    public static function asignarServicioAAtencion($idAtencion, $idServicio)
    {
        $db = Database::getConnection();
        $sql = 'INSERT INTO atencion_servicio (id_atencion, id_servicio) VALUES (:idAtencion, :idServicio)';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':idAtencion', $idAtencion, PDO::PARAM_INT);
        $stmt->bindValue(':idServicio', $idServicio, PDO::PARAM_INT);

        $result = $stmt->execute();
        // Cerrar la conexión
        Database::closeConnection($db);

        return $result;
    }
}
