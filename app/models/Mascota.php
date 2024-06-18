<?php
require_once '../app/config/Database.php';
class Mascota {

    private $id;
    private $nombre;
    private $id_cliente;
    private $creado_por;
    private $actualizado_por;
    private $estado;
    private $fecha_nac;
    private $sexo;
    private $id_raza;
    private $comentario;
    private $foto;

    public function __construct($id, $nombre, $id_cliente, $creado_por,$actualizado_por, $estado, $fecha_nac, $sexo, $id_raza, $comentario, $foto)
    {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->id_cliente = $id_cliente;
        $this->creado_por = $creado_por;
        $this->actualizado_por = $actualizado_por;
        $this->estado = $estado;
        $this->fecha_nac = $fecha_nac;
        $this->sexo = $sexo;
        $this->id_raza = $id_raza;
        $this->comentario = $comentario;
        $this->foto = $foto;
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
     * Get the value of nombre
     */ 
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set the value of nombre
     *
     * @return  self
     */ 
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get the value of id_cliente
     */ 
    public function getId_cliente()
    {
        return $this->id_cliente;
    }

    /**
     * Set the value of id_cliente
     *
     * @return  self
     */ 
    public function setId_cliente($id_cliente)
    {
        $this->id_cliente = $id_cliente;

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
     * Get the value of fecha_nac
     */ 
    public function getFecha_nac()
    {
        return $this->fecha_nac;
    }

    /**
     * Set the value of fecha_nac
     *
     * @return  self
     */ 
    public function setFecha_nac($fecha_nac)
    {
        $this->fecha_nac = $fecha_nac;

        return $this;
    }

    /**
     * Get the value of sexo
     */ 
    public function getSexo()
    {
        return $this->sexo;
    }

    /**
     * Set the value of sexo
     *
     * @return  self
     */ 
    public function setSexo($sexo)
    {
        $this->sexo = $sexo;

        return $this;
    }

    
    /**
     * Get the value of id_raza
     */ 
    public function getId_raza()
    {
        return $this->id_raza;
    }

    /**
     * Set the value of id_raza
     *
     * @return  self
     */ 
    public function setId_raza($id_raza)
    {
        $this->id_raza = $id_raza;

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
     * Get the value of foto
     */ 
    public function getFoto()
    {
        return $this->foto;
    }

    /**
     * Set the value of foto
     *
     * @return  self
     */ 
    public function setFoto($foto)
    {
        $this->foto = $foto;

        return $this;
    }

    public static function getAll($filters) {
        $db = Database::getConnection();
        $sql = 'SELECT 
                    t1.id,
                    t1.nombre,
                    t7.nombre as especie,
                    t4.nombre as raza,
                    t1.edad,
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
        Database::closeConnection();

        return $results;
    }


    public static function getTotal() {
        $db = Database::getConnection();
        $sql = "SELECT COUNT(*) FROM mascota where estado = 1";
        $stmt = $db->query($sql);
        $total = $stmt->fetchColumn();

        // Cerrar la conexión
        Database::closeConnection($db);

        return $total; // Devolver el total de registros
    }

    public static function getMascotasByCliente($idCliente) {
        $db = Database::getConnection();
        $sql = 'SELECT 
                    t1.id,
                    t1.nombre,
                    t4.nombre as raza,
                    t7.nombre as especie,
                    t1.edad,    
                    t2.nombre as nombreCliente,
                    t2.apellido_paterno,
                    t3.username,
                    T5.peso
                FROM mascota t1
                LEFT JOIN cliente t2 on t2.id = t1.id_cliente 
                LEFT JOIN user t3 on t3.id = t1.creado_por
                LEFT JOIN raza t4 on t4.id = t1.id_raza
                LEFT JOIN especie t7 on t7.id = t4.id_especie
                LEFT JOIN (SELECT id_mascota,peso FROM peso WHERE (id_mascota,created_at) in  (SELECT id_mascota,MAX(created_at) FROM peso GROUP BY id_mascota)) T5 ON T5.id_mascota = T1.ID
                WHERE 1=1 AND t1.estado = 1 AND t2.id = :idCliente';

        $stmt = $db->prepare($sql);
        $stmt->bindValue(':idCliente', $idCliente, PDO::PARAM_INT);
        $stmt->execute();

        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // Cerrar la conexión
        Database::closeConnection($db);

        return $results;
    }

    public function guardar()  {
        try {
            $db = Database::getConnection();
            $sql = "INSERT INTO mascota (nombre, id_cliente, creado_por, estado, fecha_nac, sexo, id_raza, comentario, foto) 
                    VALUES (:nombre, :id_cliente, :creado_por, :estado, :fecha_nac, :sexo, :id_raza, :comentario, :foto)";
            $stmt = $db->prepare($sql);
            $stmt->bindValue(':nombre', $this->nombre);
            $stmt->bindValue(':id_cliente', $this->id_cliente);
            $stmt->bindValue(':estado', $this->estado);
            $stmt->bindValue(':fecha_nac', $this->fecha_nac);
            $stmt->bindValue(':sexo', $this->sexo);
            $stmt->bindValue(':id_raza', $this->id_raza);
            $stmt->bindValue(':comentario', $this->comentario);
            $stmt->bindValue(':foto', $this->foto);

            $result = $stmt->execute();

            $this->id = $db->lastInsertId();

            // Cerrar la conexión después de utilizarla
            Database::closeConnection();

            return $result;
        }  catch (PDOException $e) {
            echo "Error al guardar la mascota: " . $e->getMessage();
            return false;
        }
    }




}
