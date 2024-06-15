<?php
require_once '../app/config/Database.php';

class Usuario {

    public static function getAll($filters) {
        $db = Database::getConnection();
        $sql = 'SELECT 
                    t1.id,
                    t1.username,
                    t1.password,
                    t1.status,
                    t1.name,
                    t1.lastname,
                    t1.phone,
                    t1.mail,
                    t1.imagen,
                    t2.nombre as perfil
                FROM user t1
                LEFT JOIN perfil t2 on t2.id = t1.id_perfil 
                WHERE 1=1 AND t1.status = 1';
      

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
        $sql = "SELECT COUNT(*) FROM user where status = 1";
        $stmt = $db->query($sql);
        $total = $stmt->fetchColumn();
        
        // Cerrar la conexión
        Database::closeConnection($db);
        
        return $total;
    }
}
