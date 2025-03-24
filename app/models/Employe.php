<?php
    class Employe {
        private $id_emp;
        private $nom_emp;
        private $prenom_emp;
        private $date_naissance;
        private $db;
    
        public function __construct($id_emp,$nom_emp,$prenom_emp,$date_naissance) {
            $this->db = Flight::db();
            $this->setId($id_emp);
            $this->setNom($nom_emp);
            $this->setPrenom($prenom_emp);
            $this->setDateNaissance($date_naissance);
        }
    
        // Getters et Setters
        public function getId() { return $this->id_emp; }
        public function setId($id) { $this->id_emp = $id; }
    
        public function getNom(){ return $this->nom_emp; }
        public function setNom($nom) { $this->nom_emp = $nom; }
    
        public function getPrenom() { return $this->prenom_emp; }
        public function setPrenom($prenom) { $this->prenom_emp = $prenom; }
    
        public function getDateNaissance() { return $this->date_naissance; }
        public function setDateNaissance($date) { $this->date_naissance = $date; }
    
        // Ajouter un employé
        public function ajouter() {
            try {
                $stmt = $this->db->prepare("INSERT INTO Employer (nom_emp, prenom_emp, date_naissance) VALUES (?, ?, ?)");
                return $stmt->execute([$this->nom_emp, $this->prenom_emp, $this->date_naissance]);
            } catch (PDOException $e) {
                echo "Erreur : " . $e->getMessage();
                return false;
            }
        }
    
        // Récupérer un employé par son ID
        public static function getById($id) {
            $db = Flight::db();
            $stmt = $db->prepare("SELECT * FROM Employer WHERE id_emp = ?");
            $stmt->execute([$id]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
            if ($row) {
                $employe = new Employe($row['id_emp'], $row['nom_emp'], $row['prenom_emp'], $row['date_naissance']);
                return $employe;
            }
            return null;
        }
    
        // Mettre à jour un employé
        public function mettreAJour() {
            try {
                $stmt = $this->db->prepare("UPDATE Employer SET nom_emp = ?, prenom_emp = ?, date_naissance = ? WHERE id_emp = ?");
                return $stmt->execute([$this->nom_emp, $this->prenom_emp, $this->date_naissance, $this->id_emp]);
            } catch (PDOException $e) {
                echo "Erreur : " . $e->getMessage();
                return false;
            }
        }
    
        // Supprimer un employé
        public function supprimer() {
            try {
                $stmt = $this->db->prepare("DELETE FROM Employer WHERE id_emp = ?");
                return $stmt->execute([$this->id_emp]);
            } catch (PDOException $e) {
                echo "Erreur : " . $e->getMessage();
                return false;
            }
        }
    
        // Récupérer tous les employés
        public static function getAll() {
            $db = Flight::db();
            $stmt = $db->query("SELECT * FROM Employer ORDER BY nom_emp, prenom_emp");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }


        //get Poste anle olona tamle date (raha hijery n actu de ataovy date androany le date)
        public function getPosteByDate($date) {
            $stmt = $this->db->prepare("
                SELECT p.id_post, p.nom_post 
                FROM Mouvement_emp m
                JOIN Poste p ON m.id_post = p.id_post
                WHERE m.id_emp = ? AND m.date_mouv_emp <= ?
                ORDER BY m.date_mouv_emp DESC
                LIMIT 1
            ");
            $stmt->execute([$this->getId(), $date]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
            return $row ? new Poste($row['id_post'], $row['nom_post']) : null;
        }
    
        // get departement nisy anle olona tamina date ray
        public function getDepartementByDate($date) {
            $stmt = $this->db->prepare("
                SELECT d.id_dept, d.nom_dept 
                FROM Mouvement_emp m
                JOIN Departement d ON m.id_dept = d.id_dept
                WHERE m.id_emp = ? AND m.date_mouv_emp <= ?
                ORDER BY m.date_mouv_emp DESC
                LIMIT 1
            ");
            $stmt->execute([$this->getId(), $date]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
            return $row ? new Departement($row['id_dept'], $row['nom_dept']) : null;
        }

        public static function login($nom,$prenom,$mdp,$departement) {
            $db = Flight::db();
            $stmt = $db->prepare("SELECT * FROM Employer WHERE nom_emp = ? AND prenom_emp = ? AND mdp = ? AND id_dept = ?");
            $stmt->execute([$nom,$prenom,$mdp,$departement]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
            if ($row) {
                return true;
                // $employe = new Employe($row['id_emp'], $row['nom_emp'], $row['prenom_emp'], $row['date_naissance']);
                // return $employe;
            }
            return false;
        }

    }
    