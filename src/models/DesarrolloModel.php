<?php

namespace src\models;

use PDO;

class DesarrolloModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    /**
     * Inserta un nuevo desarrollo en la base de datos.
     * @param string $name
     * @param int $status
     * @return bool
     */
    public function insertDesarrollo($name, $status) {
        $query = 'INSERT INTO desarrollos (name, status, dateCreation) VALUES (:name, :status, NOW())';
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':status', $status);
        return $stmt->execute();
    }

    /**
     * Recupera todos los desarrollos de la base de datos.
     * @return array
     */
    public function getAllDesarrollos() {
        $query = 'SELECT * FROM desarrollos';
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Recupera un desarrollo por su ID.
     * @param int $id
     * @return array
     */
    public function getDesarrolloById($id) {
        $query = 'SELECT * FROM desarrollos WHERE id = :id';
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Actualiza un desarrollo existente en la base de datos.
     * @param int $id
     * @param string $name
     * @param int $status
     * @return bool
     */
    public function updateDesarrollo($id, $name, $status) {
        $query = 'UPDATE desarrollos SET name = :name, status = :status WHERE id = :id';
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
