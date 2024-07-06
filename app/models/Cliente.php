<?php
require_once '../app/config/Database.php';
class Cliente
{

    private $id;
    private $razon;
    private $nombre;
    private $apellido_paterno;
    private $apellido_materno;
    private $direccion;
    private $telefono;
    private $correo;
    private $creado_por;
    private $actualizado_por;
    private $documento;
    private $tipo_documento_id;
    private $estado;
    private $fecha_nac;
    private $sexo;


    public function __construct($id, $razon, $nombre, $apellido_paterno, $apellido_materno, $direccion, $telefono, $correo, $creado_por, $actualizado_por, $documento, $tipo_documento_id, $estado, $fecha_nac, $sexo)
    {
        $this->id = $id;
        $this->razon = $razon;
        $this->nombre = $nombre;
        $this->apellido_paterno = $apellido_paterno;
        $this->apellido_materno = $apellido_materno;
        $this->direccion = $direccion;
        $this->telefono = $telefono;
        $this->correo = $correo;
        $this->creado_por = $creado_por;
        $this->actualizado_por = $actualizado_por;
        $this->documento = $documento;
        $this->tipo_documento_id = $tipo_documento_id;
        $this->estado = $estado;
        $this->fecha_nac = $fecha_nac;
        $this->sexo = $sexo;
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
     * Get the value of razon
     */
    public function getRazon()
    {
        return $this->razon;
    }

    /**
     * Set the value of razon
     *
     * @return  self
     */
    public function setRazon($razon)
    {
        $this->razon = $razon;

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
     * Get the value of apellido_paterno
     */
    public function getApellido_paterno()
    {
        return $this->apellido_paterno;
    }

    /**
     * Set the value of apellido_paterno
     *
     * @return  self
     */
    public function setApellido_paterno($apellido_paterno)
    {
        $this->apellido_paterno = $apellido_paterno;

        return $this;
    }

    /**
     * Get the value of apellido_materno
     */
    public function getApellido_materno()
    {
        return $this->apellido_materno;
    }

    /**
     * Set the value of apellido_materno
     *
     * @return  self
     */
    public function setApellido_materno($apellido_materno)
    {
        $this->apellido_materno = $apellido_materno;

        return $this;
    }

    /**
     * Get the value of direccion
     */
    public function getDireccion()
    {
        return $this->direccion;
    }

    /**
     * Set the value of direccion
     *
     * @return  self
     */
    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;

        return $this;
    }

    /**
     * Get the value of telefono
     */
    public function getTelefono()
    {
        return $this->telefono;
    }

    /**
     * Set the value of telefono
     *
     * @return  self
     */
    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;

        return $this;
    }

    /**
     * Get the value of correo
     */
    public function getCorreo()
    {
        return $this->correo;
    }

    /**
     * Set the value of correo
     *
     * @return  self
     */
    public function setCorreo($correo)
    {
        $this->correo = $correo;

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
     * Get the value of documento
     */
    public function getDocumento()
    {
        return $this->documento;
    }

    /**
     * Set the value of documento
     *
     * @return  self
     */
    public function setDocumento($documento)
    {
        $this->documento = $documento;

        return $this;
    }

    /**
     * Get the value of tipo_documento_id
     */
    public function getTipo_documento_id()
    {
        return $this->tipo_documento_id;
    }

    /**
     * Set the value of tipo_documento_id
     *
     * @return  self
     */
    public function setTipo_documento_id($tipo_documento_id)
    {
        $this->tipo_documento_id = $tipo_documento_id;

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

    public static function getAll($filters)
    {
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


    public static function getTotal()
    {
        $db = Database::getConnection();
        $sql = "SELECT COUNT(*) FROM cliente where estado = 1";
        $stmt = $db->query($sql);
        $total = $stmt->fetchColumn(); // Devolver el total de registros

        // Cerrar la conexión después de utilizarla
        Database::closeConnection();

        return $total;
    }

    public static function getClienteByNameDoc($nameDoc)
    {
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

    public static function getVetByNameDoc($nameDoc)
    {
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

    public function guardar()
    {
        try {
            $db = Database::getConnection();
            $sql = "INSERT INTO cliente (nombre, apellido_paterno, apellido_materno, direccion, telefono, correo, creado_por, documento, tipo_documento_id,estado,fecha_nac,sexo,razon) 
                    VALUES (:nombre, :apellido_paterno, :apellido_materno, :direccion, :telefono, :correo, :creado_por, :documento, :tipo_documento_id, :estado, :fecha_nac, :sexo, :razon)";

            $stmt = $db->prepare($sql);

            $stmt->bindValue(':nombre', $this->nombre);
            $stmt->bindValue(':apellido_paterno', $this->apellido_paterno);
            $stmt->bindValue(':apellido_materno', $this->apellido_materno);
            $stmt->bindValue(':direccion', $this->direccion);
            $stmt->bindValue(':telefono', $this->telefono);
            $stmt->bindValue(':correo', $this->correo);
            $stmt->bindValue(':creado_por', $this->creado_por);
            $stmt->bindValue(':documento', $this->documento);
            $stmt->bindValue(':tipo_documento_id', $this->tipo_documento_id);
            $stmt->bindValue(':estado', $this->estado);
            $stmt->bindValue(':fecha_nac', $this->fecha_nac);
            $stmt->bindValue(':sexo', $this->sexo);
            $stmt->bindValue(':razon', $this->razon);

            $result = $stmt->execute();

            $this->id = $db->lastInsertId();

            // Cerrar la conexión después de utilizarla
            Database::closeConnection();

            return $result;
        } catch (PDOException $e) {
            echo "Error al guardar cliente: " . $e->getMessage();
            return false;
        }
    }

}
