<?php
require_once '../app/config/Database.php';

class Atencion {

    private $id;
    private $id_cita;
    private $id_mascota;
    private $descripcion;
    private $observaciones;
    private $diagnosticos;
    private $tratamiento;
    private $fecha;
    private $creado_por;
    private $actualizado_por;
    private $estado;
    private $id_estadoatencion;
    private $veterinario;



    public function __construct($id, $id_cita, $id_mascota, $descripcion, $observaciones, $diagnosticos, $tratamiento, $fecha, $creado_por, $actualizado_por, $estado ,$id_estadoatencion,$veterinario)
    {
        $this->id = $id;
        $this->id_cita = $id_cita;
        $this->id_mascota = $id_mascota;
        $this->descripcion = $descripcion;
        $this->observaciones = $observaciones;
        $this->diagnosticos = $diagnosticos;
        $this->tratamiento = $tratamiento;
        $this->fecha = $fecha;
        $this->creado_por = $creado_por;
        $this->actualizado_por = $actualizado_por;
        $this->estado = $estado;
        $this->id_estadoatencion = $id_estadoatencion;
        $this->veterinario = $veterinario;
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
     * Get the value of id_cita
     */ 
    public function getId_cita()
    {
        return $this->id_cita;
    }

    /**
     * Set the value of id_cita
     *
     * @return  self
     */ 
    public function setId_cita($id_cita)
    {
        $this->id_cita = $id_cita;

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
     * Get the value of observaciones
     */ 
    public function getObservaciones()
    {
        return $this->observaciones;
    }

    /**
     * Set the value of observaciones
     *
     * @return  self
     */ 
    public function setObservaciones($observaciones)
    {
        $this->observaciones = $observaciones;

        return $this;
    }

    /**
     * Get the value of diagnosticos
     */ 
    public function getDiagnosticos()
    {
        return $this->diagnosticos;
    }

    /**
     * Set the value of diagnosticos
     *
     * @return  self
     */ 
    public function setDiagnosticos($diagnosticos)
    {
        $this->diagnosticos = $diagnosticos;

        return $this;
    }

    /**
     * Get the value of tratamiento
     */ 
    public function getTratamiento()
    {
        return $this->tratamiento;
    }

    /**
     * Set the value of tratamiento
     *
     * @return  self
     */ 
    public function setTratamiento($tratamiento)
    {
        $this->tratamiento = $tratamiento;

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
     * Get the value of id_estadoatencion
     */ 
    public function getId_estadoatencion()
    {
        return $this->id_estadoatencion;
    }

    /**
     * Set the value of id_estadoatencion
     *
     * @return  self
     */ 
    public function setId_estadoatencion($id_estadoatencion)
    {
        $this->id_estadoatencion = $id_estadoatencion;

        return $this;
    }

    /**
     * Get the value of veterinario
     */ 
    public function getVeterinario()
    {
        return $this->veterinario;
    }

    /**
     * Set the value of veterinario
     *
     * @return  self
     */ 
    public function setVeterinario($veterinario)
    {
        $this->veterinario = $veterinario;

        return $this;
    }


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
                LEFT JOIN raza t8 on t8.id = t2.id_raza
                LEFT JOIN especie t5 on t5.id = t8.id_especie
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

        $sql .= " ORDER BY t1.fecha desc LIMIT :limit OFFSET :offset";

        
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':limit', $filters['length'], PDO::PARAM_INT);
        $stmt->bindValue(':offset', $filters['start'], PDO::PARAM_INT);

        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Cerrar la conexión después de utilizarla
        Database::closeConnection();

        return $result;
    }


    public static function getTotal() {
        $db = Database::getConnection();
        $sql = "SELECT COUNT(*) FROM atencion where estado = 1";
        $stmt = $db->query($sql);
        $total = $stmt->fetchColumn(); // Devolver el total de registros

        // Cerrar la conexión después de utilizarla
        Database::closeConnection();

        return $total;
    }

    public static function getAllAttencionesByDate($filters) {

        $db = Database::getConnection();
        $sql = "SELECT 
                    t1.id,
                    'Atención' as descripcion,
                    t1.fecha,
                    'Atención' as type,
                    '#80DEEA' as color,
                    '' as tipo

                FROM atencion t1
                LEFT JOIN mascota t2 on t2.id = t1.id_mascota 
                LEFT JOIN cliente t3 on t3.id = t2.id_cliente
                LEFT JOIN user t4 on t4.id = t1.creado_por
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
    
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Cerrar la conexión después de utilizarla
        Database::closeConnection();

        return $result;

    }

    public static function getAllAttencionesByDateAll($filters) {

        $db = Database::getConnection();
        $sql = "SELECT 
                    t1.id,
                    t1.descripcion,
                    t1.fecha,
                    t1.observaciones,
                    t1.diagnosticos,
                    t1.tratamiento,
                    t1.id_cita,
                    t2.fecha_nac,


                    t2.nombre as mascota,
                    t2.id as id_mascota,
                
                    t2.edad,

                    t3.nombre as cliente,
                    t3.apellido_paterno,
                    t3.apellido_materno,
                    t3.telefono,
                    t3.correo,

                    t4.username,

                    t9.peso,
                    t10.altura,

                    t5.nombre as especie,
                    t6.nombre AS estadoatencion,
                    t6.clasecolor AS estadoatencioncolor,

                    t7.name as veterinarionombre,
                    t7.lastname as veterinarioapellido


                FROM atencion t1
                LEFT JOIN mascota t2 on t2.id = t1.id_mascota 
                LEFT JOIN cliente t3 on t3.id = t2.id_cliente
                LEFT JOIN user t4 on t4.id = t1.creado_por
                LEFT JOIN raza t8 on t8.id = t2.id_raza
                LEFT JOIN especie t5 on t5.id = t8.id_especie
                LEFT JOIN estadoatencion t6 on t6.id = t1.id_estadoatencion
                LEFT JOIN user t7 on t7.id = t1.veterinario
                LEFT JOIN (
                    SELECT id_mascota, created_at, peso,
                        ROW_NUMBER() OVER (PARTITION BY id_mascota ORDER BY created_at DESC) AS rn
                    FROM peso
                ) t9 ON t2.id = t9.id_mascota AND t9.rn = 1
                LEFT JOIN (
                    SELECT id_mascota, created_at, altura,
                        ROW_NUMBER() OVER (PARTITION BY id_mascota ORDER BY created_at DESC) AS rn
                    FROM altura
                ) t10 ON t2.id = t10.id_mascota AND t10.rn = 1

                WHERE 1=1 AND t1.estado in (1,2) AND t1.id_estadoatencion in (1,2)";
  

        /*if (!empty($filters['name'])) {
            $sql .= " AND name LIKE :name";
            $params[':name'] = '%' . $filters['name'] . '%';
        }

        if (!empty($filters['email'])) {
            $sql .= " AND email LIKE :email";
            $params[':email'] = '%' . $filters['email'] . '%';
        }*/

        $sql .= " AND t1.fecha between :start and :end ORDER BY t1.fecha ASC";

        
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':start', $filters['start']);
        $stmt->bindValue(':end', $filters['end']);

        $stmt->execute();
    
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Cerrar la conexión después de utilizarla
        Database::closeConnection();

        return $result;

    }

    public function guardar() {
        try {
            $db = Database::getConnection();
            $sql = "INSERT INTO atencion (id_cita, id_mascota, descripcion, observaciones, diagnosticos, tratamiento, fecha, creado_por, created_at,estado,id_estadoatencion,veterinario) 
                    VALUES (:id_cita, :id_mascota, :descripcion, :observaciones, :diagnosticos, :tratamiento, :fecha, :creado_por, NOW(), :estado, :id_estadoatencion, :veterinario)";
            $stmt = $db->prepare($sql);
            $stmt->bindValue(':id_cita', $this->id_cita);
            $stmt->bindValue(':id_mascota', $this->id_mascota);
            $stmt->bindValue(':descripcion', $this->descripcion);
            $stmt->bindValue(':observaciones', $this->observaciones);
            $stmt->bindValue(':diagnosticos', $this->diagnosticos);
            $stmt->bindValue(':tratamiento', $this->tratamiento);
            $stmt->bindValue(':fecha', $this->fecha);
            $stmt->bindValue(':creado_por', $this->creado_por);
            $stmt->bindValue(':estado', $this->estado);
            $stmt->bindValue(':id_estadoatencion', $this->id_estadoatencion);
            $stmt->bindValue(':veterinario', $this->veterinario);

            $result = $stmt->execute();

            $this->id = $db->lastInsertId();

            // Cerrar la conexión después de utilizarla
            Database::closeConnection();

            return $result;
        } catch (PDOException $e) {
            echo "Error al guardar la atencion: " . $e->getMessage();
            return false;
        }
    }

    public function actualizarRT() {
        try {
            $db = Database::getConnection();
            $sql = " UPDATE atencion SET descripcion = :descripcion, observaciones = :observaciones, diagnosticos = :diagnosticos, tratamiento = :tratamiento,id_estadoatencion = :id_estadoatencion, actualizado_por = :actualizado_por, updated_at = NOW()
                    WHERE id = :id_atencion
                    ";
            $stmt = $db->prepare($sql);
            $stmt->bindValue(':descripcion', $this->descripcion);
            $stmt->bindValue(':observaciones', $this->observaciones);
            $stmt->bindValue(':diagnosticos', $this->diagnosticos);
            $stmt->bindValue(':tratamiento', $this->tratamiento);
            $stmt->bindValue(':actualizado_por', $this->actualizado_por);
            $stmt->bindValue(':id_estadoatencion', $this->id_estadoatencion);
            $stmt->bindValue(':id_atencion', $this->id);
   

            $result = $stmt->execute();

            // Cerrar la conexión después de utilizarla
            Database::closeConnection();

            return $result;
        } catch (PDOException $e) {
            echo "Error al guardar la atencion: " . $e->getMessage();
            return false;
        }
    }

    public static function eliminar($id, $userDelete)
    {
        $db = Database::getConnection();

        $sql = 'UPDATE atencion set estado = 0,updated_at = NOW(),actualizado_por=:userDelete WHERE id = :id';
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':userDelete', $userDelete, PDO::PARAM_INT);

        $result = $stmt->execute();
        // Cerrar la conexión después de utilizarla
        Database::closeConnection();

        return $result;
    }

}
