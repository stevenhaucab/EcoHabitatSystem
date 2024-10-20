<?php

namespace src\models;

use PDO;

class LotesModel
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    /**
     * Inserta una nueva etapa en la base de datos.
     * @param string $name
     * @param int $status
     * @param int $idDesarrollo
     * @return bool
     */
    public function insertLote($name, $status, $idDesarrollo)
    {
        $query = 'INSERT INTO lotes (name, status, idDesarrollo, dateCreation) 
                  VALUES (:name, :status, :idDesarrollo, NOW())';
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':idDesarrollo', $idDesarrollo);
        return $stmt->execute();
    }

    /**
     * Recupera todos los lotes de la base de datos.
     * @return array
     */
    public function getAllLotes()
    {
        $query = 'SELECT * FROM lotes';
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Recupera una etapa por su ID.
     * @param int $id
     * @return array
     */
    public function getLoteById($id)
    {
        $query = 'SELECT * FROM lotes WHERE id = :id';
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Actualiza una etapa existente en la base de datos.
     * @param int $id
     * @param string $name
     * @param int $status
     * @param int $idDesarrollo
     * @return bool
     */
    public function updateLote($id, $name, $status, $idDesarrollo)
    {
        $query = 'UPDATE lotes SET name = :name, status = :status, idDesarrollo = :idDesarrollo WHERE id = :id';
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':idDesarrollo', $idDesarrollo);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }


    /**
     * Recupera todos los desarrollos de la base de datos.
     * @return array
     */
    public function getAllDesarrollos()
    {
        $query = 'SELECT id, name FROM desarrollos';
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Recupera todas las lotes, opcionalmente filtrando por desarrollo.
     * @param int|null $idDesarrollo
     * @return array
     */
    public function getLotesWithDesarrollos($idDesarrollo = null)
    {
        if ($idDesarrollo) {
            $query = 'SELECT e.id, e.name as etapa_name, e.status, d.name as desarrollo_name
                      FROM lotes e
                      JOIN desarrollos d ON e.idDesarrollo = d.id
                      WHERE e.idDesarrollo = :idDesarrollo';
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':idDesarrollo', $idDesarrollo, PDO::PARAM_INT);
        } else {
            $query = 'SELECT e.id, e.name as etapa_name, e.status, d.name as desarrollo_name
                      FROM lotes e
                      JOIN desarrollos d ON e.idDesarrollo = d.id';
            $stmt = $this->db->prepare($query);
        }

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Recupera el nombre del desarrollo por su ID.
     * @param int $idDesarrollo
     * @return string|null
     */
    public function getDesarrolloNameById($idDesarrollo)
    {
        $query = 'SELECT name FROM desarrollos WHERE id = :idDesarrollo';
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':idDesarrollo', $idDesarrollo, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchColumn(); // Devuelve solo la columna 'name'
    }
}
