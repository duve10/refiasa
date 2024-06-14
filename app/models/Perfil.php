<?php
require_once '../app/config/Database.php';

class Perfil {

    public static function getAll($filters) {
        $db = Database::getConnection();
        $sql = 'SELECT 
                    t1.id,
                    t1.nombre
                FROM perfil t1
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
        $sql = "SELECT COUNT(*) FROM perfil where estado = 1";
        $stmt = $db->query($sql);
        return $stmt->fetchColumn(); // Devolver el total de registros
    }
}
