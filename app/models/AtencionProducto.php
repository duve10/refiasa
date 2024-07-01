<?php
class AtencionProducto
{
    public static function asignarProductoAAtencion($idAtencion, $idProducto)
    {
        $db = Database::getConnection();
        $sql = 'INSERT INTO atencion_producto (id_atencion, id_producto) VALUES (:idAtencion, :idProducto)';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':idAtencion', $idAtencion, PDO::PARAM_INT);
        $stmt->bindValue(':idProducto', $idProducto, PDO::PARAM_INT);

        $result = $stmt->execute();
        // Cerrar la conexión
        Database::closeConnection($db);

        return $result;
    }
}
