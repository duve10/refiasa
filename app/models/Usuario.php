<?php
require_once '../app/config/Database.php';

class Usuario {

    private $id;
    private $username;
    private $password;
    private $status;
    private $name;
    private $lastname;
    private $phone;
    private $mail;
    private $document;
    private $type_doc;
    private $id_perfil;
    private $imagen;
    private $creado_por;
    private $actualizado_por;


    public function __construct($id, $username, $password, $status, $name, $lastname, $phone, $mail, $document, $type_doc, $id_perfil, $imagen, $creado_por, $actualizado_por)
    {
        $this->id = $id;
        $this->username = $username;
        $this->password = $password;
        $this->status = $status;
        $this->name = $name;
        $this->lastname = $lastname;
        $this->phone = $phone;
        $this->mail = $mail;
        $this->document = $document;
        $this->type_doc = $type_doc;
        $this->id_perfil = $id_perfil;
        $this->imagen = $imagen;
        $this->creado_por = $creado_por;
        $this->actualizado_por = $actualizado_por;
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
     * Get the value of username
     */ 
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set the value of username
     *
     * @return  self
     */ 
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get the value of password
     */ 
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @return  self
     */ 
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get the value of status
     */ 
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set the value of status
     *
     * @return  self
     */ 
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get the value of name
     */ 
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */ 
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of lastname
     */ 
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set the value of lastname
     *
     * @return  self
     */ 
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get the value of phone
     */ 
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set the value of phone
     *
     * @return  self
     */ 
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get the value of mail
     */ 
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * Set the value of mail
     *
     * @return  self
     */ 
    public function setMail($mail)
    {
        $this->mail = $mail;

        return $this;
    }

    /**
     * Get the value of document
     */ 
    public function getDocument()
    {
        return $this->document;
    }

    /**
     * Set the value of document
     *
     * @return  self
     */ 
    public function setDocument($document)
    {
        $this->document = $document;

        return $this;
    }

    /**
     * Get the value of type_doc
     */ 
    public function getType_doc()
    {
        return $this->type_doc;
    }

    /**
     * Set the value of type_doc
     *
     * @return  self
     */ 
    public function setType_doc($type_doc)
    {
        $this->type_doc = $type_doc;

        return $this;
    }

    /**
     * Get the value of id_perfil
     */ 
    public function getId_perfil()
    {
        return $this->id_perfil;
    }

    /**
     * Set the value of id_perfil
     *
     * @return  self
     */ 
    public function setId_perfil($id_perfil)
    {
        $this->id_perfil = $id_perfil;

        return $this;
    }

    /**
     * Get the value of imagen
     */ 
    public function getImagen()
    {
        return $this->imagen;
    }

    /**
     * Set the value of imagen
     *
     * @return  self
     */ 
    public function setImagen($imagen)
    {
        $this->imagen = $imagen;

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

    public static function getAll($filters) {
        $db = Database::getConnection();
        $sql = 'SELECT 
                    t1.id,
                    t1.username,
                    t1.password,
                    t1.status,
                    t1.name,
                    t1.lastname,
                    t1.phone,
                    t1.mail,
                    t1.imagen,
                    t2.nombre as perfil
                FROM user t1
                LEFT JOIN perfil t2 on t2.id = t1.id_perfil 
                WHERE 1=1 AND t1.status in ( 1, 0)';
      

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
        $sql = "SELECT COUNT(*) FROM user where status in ( 1, 0)";
        $stmt = $db->query($sql);
        $total = $stmt->fetchColumn();
        
        // Cerrar la conexión
        Database::closeConnection($db);
        
        return $total;
    }

    public static function eliminar($id,$userDelete) {
        $db = Database::getConnection();

        $sql = 'UPDATE user set status = 0,date_update = NOW(),actualizado_por=:userDelete WHERE id = :id';
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':userDelete', $userDelete, PDO::PARAM_INT);

        $result = $stmt->execute();
            // Cerrar la conexión después de utilizarla
        Database::closeConnection();

        return $result;
    }

    public function guardar()
    {
        try {
            $db = Database::getConnection();
            $sql = "INSERT INTO user (username, password, status, name, lastname, phone, mail, document, type_doc, id_perfil, imagen, creado_por) 
                    VALUES (:username, :password, :status, :name, :lastname, :phone, :mail, :document, :type_doc, :id_perfil, :imagen, :creado_por)";

            $stmt = $db->prepare($sql);

            $stmt->bindValue(':username', $this->username);
            $stmt->bindValue(':password', $this->password);
            $stmt->bindValue(':status', $this->status);
            $stmt->bindValue(':name', $this->name);
            $stmt->bindValue(':lastname', $this->lastname);
            $stmt->bindValue(':phone', $this->phone);
            $stmt->bindValue(':mail', $this->mail);
            $stmt->bindValue(':document', $this->document);
            $stmt->bindValue(':type_doc', $this->type_doc);
            $stmt->bindValue(':id_perfil', $this->id_perfil);
            $stmt->bindValue(':imagen', $this->imagen);
            $stmt->bindValue(':creado_por', $this->creado_por);

            $result = $stmt->execute();

            $this->id = $db->lastInsertId();

            // Cerrar la conexión después de utilizarla
            Database::closeConnection();

            return $result;
        } catch (PDOException $e) {
            echo "Error al guardar servicio: " . $e->getMessage();
            return false;
        }
    }



}
