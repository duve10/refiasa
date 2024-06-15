<?php
require_once '../app/config/Database.php';

class Servicio {

    public static function getAll($filters) {
        $db = Database::getConnection();
        $sql = 'SELECT 
                    t1.id,
                    t1.nombre,
                    t1.descripcion,
                    t1.precio,
                    t2.username
                FROM servicio t1
                LEFT JOIN user t2 on t2.id = t1.creado_por
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
        
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Cerrar la conexión
        Database::closeConnection($db);

        return $results;
    }


    public static function getTotal() {
        $db = Database::getConnection();
        $sql = "SELECT COUNT(*) FROM servicio where estado = 1";
        $stmt = $db->query($sql);
        $total = $stmt->fetchColumn();

        // Cerrar la conexión
        Database::closeConnection($db);

        return $total;
    }

    public static function getAllServicios() {
        $db = Database::getConnection();
        $sql = 'SELECT 
                    t1.id,
                    t1.nombre,
                    t1.descripcion,
                    t1.precio,
                    t2.username
                FROM servicio t1
                LEFT JOIN user t2 on t2.id = t1.creado_por
                WHERE 1=1 AND t1.estado = 1';
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Cerrar la conexión
        Database::closeConnection($db);

        return $result;
    }
}
