<?php

namespace src\models;

use PDO;

class EtapasModel
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
    public function insertEtapa($name, $status, $idDesarrollo)
    {
        $query = 'INSERT INTO etapas (name, status, idDesarrollo, dateCreation) 
                  VALUES (:name, :status, :idDesarrollo, NOW())';
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':idDesarrollo', $idDesarrollo);
        return $stmt->execute();
    }

    /**
     * Recupera todos los etapas de la base de datos.
     * @return array
     */
    public function getAllEtapas()
    {
        $query = 'SELECT * FROM etapas';
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Recupera una etapa por su ID.
     * @param int $id
     * @return array
     */
    public function getEtapaById($id)
    {
        $query = 'SELECT * FROM etapas WHERE id = :id';
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
    public function updateEtapa($id, $name, $status, $idDesarrollo)
    {
        $query = 'UPDATE etapas SET name = :name, status = :status, idDesarrollo = :idDesarrollo WHERE id = :id';
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
     * Recupera todas las etapas, opcionalmente filtrando por desarrollo.
     * @param int|null $idDesarrollo
     * @return array
     */
    public function getEtapasWithDesarrollos($idDesarrollo = null)
    {
        if ($idDesarrollo) {
            $query = 'SELECT e.id, e.name as etapa_name, e.status, d.name as desarrollo_name
                      FROM etapas e
                      JOIN desarrollos d ON e.idDesarrollo = d.id
                      WHERE e.idDesarrollo = :idDesarrollo';
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':idDesarrollo', $idDesarrollo, PDO::PARAM_INT);
        } else {
            $query = 'SELECT e.id, e.name as etapa_name, e.status, d.name as desarrollo_name
                      FROM etapas e
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
