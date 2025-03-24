<?php
    use Flight;
    class Poste {
        private $id_poste;
        private $nom_poste;
        private $db;
    
        
        // Getters et Setters
        public function getId() { return $this->id_poste; }
        public function setId($id) { $this->id_poste = $id; }
        
        public function getNom() { return $this->nom_poste; }
        public function setNom($nom) { $this->nom_poste = $nom; }
        
        public function __construct($id_poste,$nom_poste) {
            $this->db = Flight::db();
            $this->setId($id_poste);
            $this->setNom($nom_poste);
        }
        
        // Ajouter un département
        public function ajouter() {
            try {
                $stmt = $this->db->prepare("INSERT INTO Poste (nom_poste) VALUES (?)");
                return $stmt->execute([$this->nom_poste]);
            } catch (PDOException $e) {
                echo "Erreur : " . $e->getMessage();
                return false;
            }
        }
    
        // Récupérer un département par ID
        public static function getById(int $id) {
            $db =  Flight::db();
            $stmt = $db->prepare("SELECT * FROM Poste WHERE id_poste = ?");
            $stmt->execute([$id]);
            $data = $stmt->fetch();
    
            if ($data) {
                $poste = new Poste($data['id_poste'],$data['nom_poste']);
                return $poste;
            }
            return null;
        }
    
        // Mettre à jour un département
        public function mettreAJour() {
            try {
                $stmt = $this->db->prepare("UPDATE Poste SET nom_poste = ? WHERE id_poste = ?");
                return $stmt->execute([$this->nom_poste, $this->id_poste]);
            } catch (PDOException $e) {
                echo "Erreur : " . $e->getMessage();
                return false;
            }
        }
    
        // Supprimer un département
        public function supprimer() {
            try {
                $stmt = $this->db->prepare("DELETE FROM Poste WHERE id_poste = ?");
                return $stmt->execute([$this->id_poste]);
            } catch (PDOException $e) {
                echo "Erreur : " . $e->getMessage();
                return false;
            }
        }
    
        // Récupérer tous les départements
        public static function getAll(): array {
            $db = Flight::db();
            $stmt = $db->query("SELECT * FROM Poste ORDER BY nom_poste");
            return $stmt->fetchAll();
        }
    }
    