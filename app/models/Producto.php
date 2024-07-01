<?php
require_once '../app/config/Database.php';

class Producto {

    private $id;
    private $nombre;
    private $descripcion;
    private $precio;
    private $stock;
    private $creado_por;
    private $actualizado_por;
    private $estado;
    private $foto;

    public function __construct($id, $nombre, $descripcion, $precio, $stock, $creado_por, $actualizado_por, $estado, $foto)
    {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->descripcion = $descripcion;
        $this->precio = $precio;
        $this->stock = $stock;
        $this->creado_por = $creado_por;
        $this->actualizado_por = $actualizado_por;
        $this->estado = $estado;
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
     * Get the value of precio
     */ 
    public function getPrecio()
    {
        return $this->precio;
    }

    /**
     * Set the value of precio
     *
     * @return  self
     */ 
    public function setPrecio($precio)
    {
        $this->precio = $precio;

        return $this;
    }

    /**
     * Get the value of stock
     */ 
    public function getStock()
    {
        return $this->stock;
    }

    /**
     * Set the value of stock
     *
     * @return  self
     */ 
    public function setStock($stock)
    {
        $this->stock = $stock;

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
                    t1.foto,
                    t1.descripcion,
                    t1.precio,
                    t1.stock,
                    t2.username
                FROM producto t1
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
        $sql = "SELECT COUNT(*) FROM producto where estado = 1";
        $stmt = $db->query($sql);
        $total = $stmt->fetchColumn();

        // Cerrar la conexión
        Database::closeConnection($db);

        return $total;
    }

    public static function getAllProductos() {
        $db = Database::getConnection();
        $sql = 'SELECT 
                    t1.id,
                    t1.nombre,
                    t1.foto,
                    t1.descripcion,
                    t1.precio,
                    t1.stock
                FROM producto t1
                LEFT JOIN user t2 on t2.id = t1.creado_por
                WHERE 1=1 AND t1.estado = 1';
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Cerrar la conexión
        Database::closeConnection($db);

        return $result;
    }

    public function guardar()
    {
        try {
            $db = Database::getConnection();
            $sql = "INSERT INTO producto (nombre, descripcion, precio, stock, creado_por, estado, foto) 
                    VALUES (:nombre, :descripcion, :precio, :stock, :creado_por, :estado, :foto)";

            $stmt = $db->prepare($sql);

            $stmt->bindValue(':nombre', $this->nombre);
            $stmt->bindValue(':descripcion', $this->descripcion);
            $stmt->bindValue(':precio', $this->precio);
            $stmt->bindValue(':stock', $this->stock);
            $stmt->bindValue(':creado_por', $this->creado_por);
            $stmt->bindValue(':estado', $this->estado);
            $stmt->bindValue(':foto', $this->foto);

            $result = $stmt->execute();

            $this->id = $db->lastInsertId();

            // Cerrar la conexión después de utilizarla
            Database::closeConnection();

            return $result;
        } catch (PDOException $e) {
            echo "Error al guardar la mascota: " . $e->getMessage();
            return false;
        }
    }

    public static function eliminar($id, $userDelete)
    {
        $db = Database::getConnection();

        $sql = 'UPDATE producto set estado = 0,updated_at = NOW(),actualizado_por=:userDelete WHERE id = :id';
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':userDelete', $userDelete, PDO::PARAM_INT);

        $result = $stmt->execute();
        // Cerrar la conexión después de utilizarla
        Database::closeConnection();

        return $result;
    }


}
