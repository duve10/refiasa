<?php
require_once '../app/config/Database.php';
class MiMascota
{
    public static function getMascotas($id)
    {
        $db = Database::getConnection();
        $sql = 'SELECT 
                    t1.id,
                    t1.nombre,
                    t1.foto,
                    t7.nombre as especie,
                    t4.nombre as raza,
                    t1.fecha_nac,
                    t5.peso,
                    t2.nombre as nombreCliente,
                    t2.apellido_paterno,
                    t3.username,
                    t6.altura
                FROM mascota t1
                LEFT JOIN cliente t2 on t2.id = t1.id_cliente 
                LEFT JOIN user t3 on t3.id = t1.creado_por
                LEFT JOIN raza t4 on t4.id = t1.id_raza
                LEFT JOIN especie t7 on t7.id = t4.id_especie
                LEFT JOIN (SELECT id_mascota,peso FROM peso WHERE (id_mascota,created_at) in  (SELECT id_mascota,MAX(created_at) FROM peso GROUP BY id_mascota)) T5 ON T5.id_mascota = T1.ID
                LEFT JOIN (SELECT id_mascota,altura FROM altura WHERE (id_mascota,created_at) in  (SELECT id_mascota,MAX(created_at) FROM altura GROUP BY id_mascota)) T6 ON T6.id_mascota = T1.ID
                WHERE 1=1 AND t1.estado = 1 ';



        /*if (!empty($filters['email'])) {
            $sql .= " AND email LIKE :email";
            $params[':email'] = '%' . $filters['email'] . '%';
        }*/

        $sql .= "AND T2.ID = :id";


        $stmt = $db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);


        $stmt->execute();

        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Cerrar la conexión
        Database::closeConnection();

        return $results;
    }



}
