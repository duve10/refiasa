<?php


class Altura {

    private $id;
    private $id_mascota;
    private $altura;
    private $creado_por;

    public function __construct($id, $id_mascota, $altura, $creado_por)
    {
        $this->id = $id;
        $this->id_mascota = $id_mascota;
        $this->altura = $altura;
        $this->creado_por = $creado_por;
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
     * Get the value of peso
     */ 
    public function getAltura()
    {
        return $this->altura;
    }

    /**
     * Set the value of peso
     *
     * @return  self
     */ 
    public function setAltura($altura)
    {
        $this->altura = $altura;

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

    public static function getLastAltura() {
        $db = Database::getConnection(); // Asume que tienes una clase Database para la conexión

        $query = "SELECT id_mascota, alturaa FROM altura WHERE id_mascota = :id_mascota ORDER BY created_at DESC LIMIT 1";
        $stmt = $db->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // Cerrar la conexión después de utilizarla
        Database::closeConnection();
        return $result;
    }

    public function guardar() {
        try {
            $db = Database::getConnection();
            $sql = "INSERT INTO altura (id_mascota, altura, creado_por) 
                    VALUES (:id_mascota, :altura, :creado_por)";
            $stmt = $db->prepare($sql);
            $stmt->bindValue(':id_mascota', $this->id_mascota);
            $stmt->bindValue(':altura', $this->altura);
            $stmt->bindValue(':creado_por', $this->creado_por);

            $result = $stmt->execute();

            $this->id = $db->lastInsertId();

            // Cerrar la conexión después de utilizarla
            Database::closeConnection();

            return $result;
        }  catch (PDOException $e) {
            echo "Error al guardar la altura: " . $e->getMessage();
            return false;
        }
    }


}