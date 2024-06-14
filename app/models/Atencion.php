<?php
require_once '../app/config/Database.php';

class Atencion {

    public static function getAll($filters) {
        $db = Database::getConnection();
        $sql = 'SELECT 
                    t1.id,
                    t1.descripcion,
                    t1.fecha,
                    t1.observaciones,
                    t1.diagnosticos,
                    t1.tratamiento,
                    t1.id_cita,


                    t2.nombre as mascota,
                    t2.peso,
                    t2.edad,

                    t3.nombre as cliente,
                    t3.apellido_paterno,
                    t3.apellido_materno,
                    t3.telefono,
                    t3.correo,

                    t4.username,

                    t5.nombre as especie,
                    t6.nombre AS estadoatencion,
                    t6.clasecolor AS estadoatencioncolor,

                    t7.name as veterinarionombre,
                    t7.lastname as veterinarioapellido

                FROM atencion t1
                LEFT JOIN mascota t2 on t2.id = t1.id_mascota 
                LEFT JOIN cliente t3 on t3.id = t2.id_cliente
                LEFT JOIN user t4 on t4.id = t1.creado_por
                LEFT JOIN especie t5 on t5.id = t2.especie_id
                LEFT JOIN estadoatencion t6 on t6.id = t1.id_estadoatencion
                LEFT JOIN user t7 on t7.id = t1.veterinario
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
        $sql = "SELECT COUNT(*) FROM atencion where estado = 1";
        $stmt = $db->query($sql);
        return $stmt->fetchColumn(); // Devolver el total de registros
    }

    public static function getAllAttencionesByDate($filters) {

        $db = Database::getConnection();
        $sql = "SELECT 
                    t1.id,
                    t1.descripcion,
                    t1.fecha,
                    'Atencion' as type,
                    '#80DEEA' as color

                FROM atencion t1
                LEFT JOIN mascota t2 on t2.id = t1.id_mascota 
                LEFT JOIN cliente t3 on t3.id = t2.id_cliente
                LEFT JOIN user t4 on t4.id = t1.creado_por
                LEFT JOIN especie t5 on t5.id = t2.especie_id
                LEFT JOIN estadoatencion t6 on t6.id = t1.id_estadoatencion
                LEFT JOIN user t7 on t7.id = t1.veterinario
                WHERE 1=1 AND t1.estado = 1";
  

        /*if (!empty($filters['name'])) {
            $sql .= " AND name LIKE :name";
            $params[':name'] = '%' . $filters['name'] . '%';
        }

        if (!empty($filters['email'])) {
            $sql .= " AND email LIKE :email";
            $params[':email'] = '%' . $filters['email'] . '%';
        }*/

        $sql .= " AND t1.fecha between :start and :end";

        
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':start', $filters['start']);
        $stmt->bindValue(':end', $filters['end']);

        $stmt->execute();
    
        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }
}
