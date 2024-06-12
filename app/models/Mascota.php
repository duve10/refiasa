<?php
require_once '../app/config/Database.php';
class Mascota {

    public static function getAll($filters) {
        $db = Database::getConnection();
        $sql = 'SELECT 
                    t1.id,
                    t1.nombre,
                    t4.nombre as especie,
                    t1.raza,
                    t1.edad,
                    t1.peso,
                    t2.nombre as nombreCliente,
                    t2.apellido_paterno,
                    t3.username
                FROM mascota t1
                LEFT JOIN cliente t2 on t2.id = t1.id_cliente 
                LEFT JOIN user t3 on t3.id = t1.creado_por
                LEFT JOIN especie t4 on t4.id = t1.especie_id
                WHERE 1=1 AND t1.estado = 1';
  

        /*if (!empty($filters['name'])) {
            $sql .= " AND name LIKE :name";
            $params[':name'] = '%' . $filters['name'] . '%';
        }

        if (!empty($filters['email'])) {
            $sql .= " AND email LIKE :email";
            $params[':email'] = '%' . $filters['email'] . '%';
        }*/

        $sql .= " LIMIT :limit OFFSET :offset";

        
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':limit', $filters['length'], PDO::PARAM_INT);
        $stmt->bindValue(':offset', $filters['start'], PDO::PARAM_INT);

        $stmt->execute();
    
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public static function getTotal() {
        $db = Database::getConnection();
        $sql = "SELECT COUNT(*) FROM mascota where estado = 1";
        $stmt = $db->query($sql);
        return $stmt->fetchColumn(); // Devolver el total de registros
    }
}
