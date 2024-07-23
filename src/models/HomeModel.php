<?php
// src/models/HomeModel.php
namespace src\models;

use core\Model;
use PDOException;

class HomeModel extends Model {
    private $id;

    public function setId($id) {
        $this->id = $id;
    }

    public function getId() {
        return $this->id;
    }

    public function getUser() {
        try {
            $stmt = $this->db->prepare("SELECT * FROM tbl_users WHERE id = :id");
            $stmt->bindParam(':id', $this->id, \PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch();
        } catch (PDOException $e) {
            error_log("Error en la consulta: " . $e->getMessage());
            return false; 
        }
    }
}
