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

    public static function getAll($filters) {
        $db = Database::getConnection();
        $sql = 'SELECT 
                    t1.id,
                    t1.nombre,
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
                    t1.descripcion,
                    t1.precio,
                    t2.stock
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
}
