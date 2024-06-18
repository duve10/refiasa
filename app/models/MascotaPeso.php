<?php
class MascotaPeso {
    public static function registrarPeso($id_mascota, $peso, $creado_por) {
        $db = Database::getConnection();
        $sql = 'INSERT INTO peso (id_mascota, peso, creado_por) VALUES (:id_mascota, :peso, :creado_por)';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':id_mascota', $id_mascota, PDO::PARAM_INT);
        $stmt->bindValue(':peso', $peso);
        $stmt->bindValue(':creado_por', $creado_por);
        
        $result = $stmt->execute();

        // Cerrar la conexión
        Database::closeConnection($db);

        return $result;
    }
}
?>
