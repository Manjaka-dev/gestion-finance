<?php

namespace app\models;

use Exception;
use Flight;

class Departement
{
    private $id_dept;
    private $nom_dept;
    private $db;


    // Getters et Setters
    public function getId()
    {
        return $this->id_dept;
    }
    public function setId($id)
    {
        $this->id_dept = $id;
    }

    public function getNom(): string
    {
        return $this->nom_dept;
    }
    public function setNom(string $nom): void
    {
        $this->nom_dept = $nom;
    }

    public function __construct($id_dept, $nom_dept)
    {
        $this->db = Flight::db();
        $this->setId($id_dept);
        $this->setNom($nom_dept);
    }

    // Ajouter un département
    public function ajouter()
    {
        try {
            $stmt = $this->db->prepare("INSERT INTO Departement (nom_dept) VALUES (?)");
            return $stmt->execute([$this->nom_dept]);
        } catch (Exception $e) {
            echo "Erreur : " . $e->getMessage();
            return false;
        }
    }

    // Récupérer un département par ID
    public static function getById($id)
    {
        $db =  Flight::db();
        $stmt = $db->prepare("SELECT * FROM Departement WHERE id_dept = ?");
        $stmt->execute([$id]);
        $data = $stmt->fetch();

        if ($data) {
            $departement = new Departement($data['id_dept'], $data['nom_dept']);
            return $departement;
        }
        return null;
    }

    // Mettre à jour un département
    public function mettreAJour()
    {
        try {
            $stmt = $this->db->prepare("UPDATE Departement SET nom_dept = ? WHERE id_dept = ?");
            return $stmt->execute([$this->nom_dept, $this->id_dept]);
        } catch (Exception $e) {
            echo "Erreur : " . $e->getMessage();
            return false;
        }
    }

    // Supprimer un département
    public function supprimer()
    {
        try {
            $stmt = $this->db->prepare("DELETE FROM Departement WHERE id_dept = ?");
            return $stmt->execute([$this->id_dept]);
        } catch (Exception $e) {
            echo "Erreur : " . $e->getMessage();
            return false;
        }
    }

    // Récupérer tous les départements
    public static function getAll()
    {
        $db = Flight::db();
        $stmt = $db->query("SELECT * FROM Departement ORDER BY nom_dept");
        return $stmt->fetchAll();
    }

    //voir si moi (en tant que departement) a le droit sur un departement
    public function getVueDepartement(Departement $slave)
    {
        $db = Flight::db();
        $stmt = $db->prepare("SELECT * FROM Vue_departement WHERE master_id = ? and slave_id = ?");
        $stmt->execute([$this->getId(), $slave->getId()]);
        $data = $stmt->fetch();

        if ($data) {
            return true;
        }
        return false;
    }
}
