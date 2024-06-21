<?php
require_once '../app/config/Database.php';
class Cliente {

    public static function getAll($filters) {
        $db = Database::getConnection();
        $sql = 'SELECT 
                    t1.id,
                    t1.nombre,
                    t1.apellido_paterno,
                    t1.apellido_materno,
                    t1.direccion,
                    t1.telefono,
                    t1.correo,
                    t3.username,
                    t1.documento,
                    t2.nombre as tipoDoc 
                FROM cliente t1
                LEFT JOIN tipo_documento t2 on t2.id = t1.tipo_documento_id 
                LEFT JOIN user t3 on t3.id = t1.creado_por
                WHERE 1=1 AND estado = 1';
        $params = [];

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
        
        $clientes = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Cerrar la conexión después de utilizarla
        Database::closeConnection();

        return $clientes;
    }


    public static function getTotal() {
        $db = Database::getConnection();
        $sql = "SELECT COUNT(*) FROM cliente where estado = 1";
        $stmt = $db->query($sql);
        $total = $stmt->fetchColumn(); // Devolver el total de registros

        // Cerrar la conexión después de utilizarla
        Database::closeConnection();

        return $total;
    }

    public static function getClienteByNameDoc($nameDoc) {
        $db = Database::getConnection();
      
        $nameDoc = '%' . $nameDoc . '%'; 
        $sql = "SELECT 
                    t1.id,
                    t1.nombre,
                    t1.apellido_paterno,
                    t1.apellido_materno,
                    t1.documento
                FROM cliente t1
                WHERE 1=1 AND estado = 1
                AND (t1.nombre LIKE :nameDoc OR t1.apellido_paterno LIKE :nameDoc OR t1.apellido_materno LIKE :nameDoc OR t1.documento LIKE :nameDoc)
                LIMIT 10";


        $stmt = $db->prepare($sql);

        $stmt->bindValue(':nameDoc', $nameDoc, PDO::PARAM_STR);
        $stmt->execute();
        
        $clientes = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Cerrar la conexión después de utilizarla
        Database::closeConnection();

        return $clientes;
    }

    public static function getVetByNameDoc($nameDoc) {
        $db = Database::getConnection();
      
        $nameDoc = '%' . $nameDoc . '%'; 
        $sql = "SELECT 
                    t1.id,
                    t1.username,
                    t1.name,
                    t1.lastname,
                    t1.phone
                FROM user t1
                WHERE 1=1 AND status = 1 AND t1.id_perfil = 2
                AND (t1.name LIKE :nameDoc OR t1.lastname LIKE :nameDoc OR t1.username LIKE :nameDoc OR t1.document LIKE :nameDoc)
                LIMIT 10";


        $stmt = $db->prepare($sql);

        $stmt->bindValue(':nameDoc', $nameDoc, PDO::PARAM_STR);
        $stmt->execute();
        
        $veterinarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Cerrar la conexión después de utilizarla
        Database::closeConnection();

        return $veterinarios;
    }
}
