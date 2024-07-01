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

    public static function getAllServiciosByAtencion($idAtencion)
    {
        $db = Database::getConnection();
        $sql = 'SELECT t1.id  as id_servicio,t1.nombre,t2.id_servicio as selected  FROM  servicio t1
                left join atencion_servicio t2 on t2.id_servicio = t1.id and t2.id_atencion = :idAtencion WHERE  t1.estado = 1';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':idAtencion', $idAtencion, PDO::PARAM_INT);


        $stmt->execute();
        $servicios = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // Cerrar la conexión
        Database::closeConnection($db);

        return $servicios;
    }
}
