<?php
require_once '../app/config/Database.php';
class Cita
{

    private $id;
    private $id_mascota;
    private $creado_por;
    private $id_hora;
    private $fecha;
    private $descripcion;
    private $estado;
    private $actualizado_por;
    private $id_estadocita;
    private $comentario;
    private $id_tipocita;



    public function __construct($id, $id_mascota, $creado_por, $id_hora, $fecha, $descripcion, $estado, $actualizado_por, $id_estadocita, $comentario, $id_tipocita)
    {
        $this->id = $id;
        $this->id_mascota = $id_mascota;
        $this->creado_por = $creado_por;
        $this->id_hora = $id_hora;
        $this->fecha = $fecha;
        $this->descripcion = $descripcion;
        $this->estado = $estado;
        $this->actualizado_por = $actualizado_por;
        $this->id_estadocita = $id_estadocita;
        $this->comentario = $comentario;
        $this->id_tipocita = $id_tipocita;
    }
    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of id_mascota
     */
    public function getId_mascota()
    {
        return $this->id_mascota;
    }

    /**
     * Set the value of id_mascota
     *
     * @return  self
     */
    public function setId_mascota($id_mascota)
    {
        $this->id_mascota = $id_mascota;

        return $this;
    }

    /**
     * Get the value of creado_por
     */
    public function getCreado_por()
    {
        return $this->creado_por;
    }

    /**
     * Set the value of creado_por
     *
     * @return  self
     */
    public function setCreado_por($creado_por)
    {
        $this->creado_por = $creado_por;

        return $this;
    }

    /**
     * Get the value of id_hora
     */
    public function getId_hora()
    {
        return $this->id_hora;
    }

    /**
     * Set the value of id_hora
     *
     * @return  self
     */
    public function setId_hora($id_hora)
    {
        $this->id_hora = $id_hora;

        return $this;
    }

    /**
     * Get the value of fecha
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set the value of fecha
     *
     * @return  self
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }

    /**
     * Get the value of descripcion
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set the value of descripcion
     *
     * @return  self
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get the value of estado
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Set the value of estado
     *
     * @return  self
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Get the value of actualizado_por
     */
    public function getActualizado_por()
    {
        return $this->actualizado_por;
    }

    /**
     * Set the value of actualizado_por
     *
     * @return  self
     */
    public function setActualizado_por($actualizado_por)
    {
        $this->actualizado_por = $actualizado_por;

        return $this;
    }

    /**
     * Get the value of id_estadocita
     */
    public function getId_estadocita()
    {
        return $this->id_estadocita;
    }

    /**
     * Set the value of id_estadocita
     *
     * @return  self
     */
    public function setId_estadocita($id_estadocita)
    {
        $this->id_estadocita = $id_estadocita;

        return $this;
    }

    /**
     * Get the value of comentario
     */
    public function getComentario()
    {
        return $this->comentario;
    }

    /**
     * Set the value of comentario
     *
     * @return  self
     */
    public function setComentario($comentario)
    {
        $this->comentario = $comentario;

        return $this;
    }

    /**
     * Get the value of id_tipocita
     */
    public function getId_tipocita()
    {
        return $this->id_tipocita;
    }

    /**
     * Set the value of id_tipocita
     *
     * @return  self
     */
    public function setId_tipocita($id_tipocita)
    {
        $this->id_tipocita = $id_tipocita;

        return $this;
    }


    public static function getAll($filters)
    {
        try {
            $db = Database::getConnection();
            $sql = 'SELECT 
                        t1.id,
                        t1.descripcion,
                        t1.fecha,
                        t2.nombre as mascota,
                        t2.edad,
                        t2.id as id_mascota,
                        t3.nombre as cliente,
                        t3.apellido_paterno,
                        t3.apellido_materno,
                        t3.telefono,
                        t3.correo,
                        t4.username,
                        t5.nombre as especie,
                        t6.hora,
                        t8.id AS id_estadocita,
                        t8.nombre AS estadocita,
                        t8.clasecolor AS estadocitacolor,
                        t9.nombre as tipocita,
                        t9.clase as claseCita
                    FROM cita t1
                    LEFT JOIN mascota t2 on t2.id = t1.id_mascota 
                    LEFT JOIN cliente t3 on t3.id = t2.id_cliente
                    LEFT JOIN user t4 on t4.id = t1.creado_por
                    LEFT JOIN raza t10 on t10.id = t2.id_raza
                    LEFT JOIN especie t5 on t5.id = t10.id_especie
                    LEFT JOIN lista_horas t6 on t6.id = t1.id_hora
                    LEFT JOIN estadocita t8 on t8.id = t1.id_estadocita
                    LEFT JOIN tipo_Cita t9 on t9.id = t1.id_tipocita
                    WHERE 1=1 AND t1.estado in ( 1, 2 ) and DATE(t1.fecha) between :fecha_desde and :fecha_hasta';

                    
            if ($filters['id_cliente'] != '') {
                $sql .= " AND t3.id = :id_cliente";
            }


            $sql .= " ORDER BY t1.fecha DESC, t6.hora DESC";
            $sql .= " LIMIT :limit OFFSET :offset";

            $stmt = $db->prepare($sql);
            $stmt->bindValue(':limit', $filters['length'], PDO::PARAM_INT);
            $stmt->bindValue(':offset', $filters['start'], PDO::PARAM_INT);
            $stmt->bindValue(':fecha_desde', $filters['fecha_desde']);
            $stmt->bindValue(':fecha_hasta', $filters['fecha_hasta']);

            if ($filters['id_cliente'] != '') {
                $stmt->bindValue(':id_cliente', $filters['id_cliente']);
            }

            $stmt->execute();

            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Cerrar la conexión después de utilizarla
            Database::closeConnection();

            return $result;
        } catch (PDOException $e) {
            echo "Error al obtener las citas: " . $e->getMessage();
            return [];
        }
    }


    public static function getTotal()
    {

        try {
            $db = Database::getConnection();
            $sql = "SELECT COUNT(*) FROM cita where estado in ( 1, 2)";
            $stmt = $db->query($sql);
            $total = $stmt->fetchColumn(); // Devolver el total de registros

            // Cerrar la conexión después de utilizarla
            Database::closeConnection();

            return $total;
        } catch (PDOException $e) {
            echo "Error al obtener el total de citas: " . $e->getMessage();
            return 0;
        }
    }

    public function guardar()
    {
        try {
            $db = Database::getConnection();
            $sql = "INSERT INTO cita (id_mascota, creado_por, id_hora, fecha, descripcion, estado, id_estadocita, comentario, id_tipocita) 
                    VALUES (:id_mascota, :creado_por, :id_hora, :fecha, :descripcion, :estado, :id_estadocita, :comentario, :id_tipocita)";
            $stmt = $db->prepare($sql);
            $stmt->bindValue(':id_mascota', $this->id_mascota);
            $stmt->bindValue(':creado_por', $this->creado_por);
            $stmt->bindValue(':id_hora', $this->id_hora);
            $stmt->bindValue(':fecha', $this->fecha);
            $stmt->bindValue(':descripcion', $this->descripcion);
            $stmt->bindValue(':estado', $this->estado);
            $stmt->bindValue(':id_estadocita', $this->id_estadocita);
            $stmt->bindValue(':comentario', $this->comentario);
            $stmt->bindValue(':id_tipocita', $this->id_tipocita);

            $result = $stmt->execute();

            $this->id = $db->lastInsertId();

            // Cerrar la conexión después de utilizarla
            Database::closeConnection();

            return $result;
        } catch (PDOException $e) {
            echo "Error al guardar la cita: " . $e->getMessage();
            return false;
        }
    }

    public static function getAllCitasByDate($filters)
    {

        try {
            $db = Database::getConnection();
            $sql = "SELECT 
                        t1.id,
                        CONCAT('Cita: ', DATE_FORMAT(t6.hora, '%h:%i %p')) as descripcion,
                        t1.fecha,
                        'Cita' as type,
                        '#FFD54F' as color,
                        id_tipocita as tipo
    
                    FROM cita t1
                    LEFT JOIN mascota t2 on t2.id = t1.id_mascota 
                    LEFT JOIN cliente t3 on t3.id = t2.id_cliente
                    LEFT JOIN user t4 on t4.id = t1.creado_por
                    LEFT JOIN lista_horas t6 on t6.id = t1.id_hora
                    LEFT JOIN estadocita t8 on t8.id = t1.id_estadocita
                    WHERE 1=1 AND t1.estado = 1 ";

            $sql .= " AND t1.fecha BETWEEN :start AND :end";

            $stmt = $db->prepare($sql);
            $stmt->bindValue(':start', $filters['start']);
            $stmt->bindValue(':end', $filters['end']);

            $stmt->execute();

            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Cerrar la conexión después de utilizarla
            Database::closeConnection();

            return $results;
        } catch (PDOException $e) {
            echo "Error al obtener las citas por fecha: " . $e->getMessage();
            return [];
        }
    }

    public static function eliminar($id, $userDelete)
    {
        $db = Database::getConnection();

        $sql = 'UPDATE cita set estado = 0,updated_at = NOW(),actualizado_por=:userDelete WHERE id = :id';
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':userDelete', $userDelete, PDO::PARAM_INT);

        $result = $stmt->execute();
        // Cerrar la conexión después de utilizarla
        Database::closeConnection();

        return $result;
    }

    public static function updateEstado($id,$id_estadocita, $userUpdate)
    {
        $db = Database::getConnection();

        $sql = 'UPDATE cita set id_estadocita = :id_estadocita,updated_at = NOW(),actualizado_por=:userUpdate WHERE id = :id';
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':userUpdate', $userUpdate, PDO::PARAM_INT);
        $stmt->bindParam(':id_estadocita', $id_estadocita, PDO::PARAM_INT);

        $result = $stmt->execute();
        // Cerrar la conexión después de utilizarla
        Database::closeConnection();

        return $result;
    }
}
