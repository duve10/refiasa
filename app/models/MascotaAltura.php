<?php
class MascotaAltura {
    public static function registrarAltura($id_mascota, $altura, $creado_por) {
        $db = Database::getConnection();
        $sql = 'INSERT INTO altura (id_mascota, altura, creado_por) VALUES (:id_mascota, :altura, :creado_por)';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':id_mascota', $id_mascota, PDO::PARAM_INT);
        $stmt->bindValue(':altura', $altura);
        $stmt->bindValue(':creado_por', $creado_por);
        
        $result = $stmt->execute();

        // Cerrar la conexión
        Database::closeConnection($db);

        return $result;
    }
}
?>
