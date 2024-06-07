<?php

class User extends Model {
    public function getUserByUsernameAndPassword($username, $password) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE username = ? AND password = ?");
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }
}
