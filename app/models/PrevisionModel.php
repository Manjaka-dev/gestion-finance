<?php
namespace app\models;
use PDO;
use PDOException;
use Exception;
class PrevisionModel
{

    public $db;

    public function __construct($db)
    {
        $this->db = $db;
    }
    public function getRecetteParPeriodeParDepartement($id_per, $id_dept)
    {
        try {
            // Préparer la requête SQL avec une jointure si nécessaire
            $sql = "SELECT
                        SUM(Prevision.montant_prev) m
                    FROM
                        Prevision
                        JOIN Rubrique ON Prevision.id_per = Rubrique.id_per
                    WHERE
                        Rubrique.id_cat = :id_cat
                        AND Rubrique.id_per = id_per
                        AND Rubrique.id_dept = id_dept";


            // Préparation de la requête
            $stmt = $this->db->prepare($sql);

            // Liaison des paramètres
            $stmt->bindParam(':id_cat', 1, PDO::PARAM_INT);
            $stmt->bindParam(':id_per', $id_per, PDO::PARAM_INT);
            $stmt->bindParam(':id_dept', $id_dept, PDO::PARAM_INT);

            // Exécuter la requête
            $stmt->execute();

            // Récupérer toutes les données sous forme de tableau associatif
            return $stmt->fetch(PDO::FETCH_ASSOC)['m'];
        } catch (PDOException $e) {
            // Gestion des erreurs
            echo "Erreur : " . $e->getMessage();
            return [];
        }
    }
    public function getDepenseParPeriodeParDepartement($id_per, $id_dept)
    {
        try {
            // Préparer la requête SQL avec une jointure si nécessaire
            $sql = "SELECT
                        SUM(Prevision.montant_prev) m
                    FROM
                        Prevision
                        JOIN Rubrique ON Prevision.id_per = Rubrique.id_per
                    WHERE
                        Rubrique.id_cat = :id_cat
                        AND Rubrique.id_per = id_per
                        AND Rubrique.id_dept = id_dept";


            // Préparation de la requête
            $stmt = $this->db->prepare($sql);

            // Liaison des paramètres
            $stmt->bindParam(':id_cat', 2, PDO::PARAM_INT);
            $stmt->bindParam(':id_per', $id_per, PDO::PARAM_INT);
            $stmt->bindParam(':id_dept', $id_dept, PDO::PARAM_INT);

            // Exécuter la requête
            $stmt->execute();

            // Récupérer toutes les données sous forme de tableau associatif
            return $stmt->fetch(PDO::FETCH_ASSOC)['m'];
        } catch (PDOException $e) {
            // Gestion des erreurs
            echo "Erreur : " . $e->getMessage();
            return [];
        }
    }
    public function getSoldeFin($id_per, $id_dept, $solde_debut)
    {
        $recette = $this->getRecetteParPeriodeParDepartement($id_per, $id_dept);
        $depense = $this->getDepenseParPeriodeParDepartement($id_per, $id_dept);
        $retour = $solde_debut + $recette - $depense;
        return $retour;
    }
    public function getEcartParPreiode($id_per, $id_dept)
    {
        $recette = $this->getRecetteParPeriodeParDepartement($id_per, $id_dept);
        $depense = $this->getDepenseParPeriodeParDepartement($id_per, $id_dept);
        $retour = $recette - $depense;
        return $retour;
    }
    function getPeriodeIdsByStart(int $idStart, int $nombre): array {
        try {
            // Obtenez la date correspondante à l'id_per de départ
            $sqlDateStart = "SELECT date_per FROM Periode WHERE id_per = :id_per";
            $stmtDateStart = $this->db->prepare($sqlDateStart);
            $stmtDateStart->bindParam(':id_per', $idStart, PDO::PARAM_INT);
            $stmtDateStart->execute();
            $dateStart = $stmtDateStart->fetchColumn();
    
            if (!$dateStart) {
                throw new Exception("Aucune période trouvée pour id_per = $idStart");
            }
    
            // Obtenez l'année et le mois de la date de départ
            $yearStart = date('Y', strtotime($dateStart));
            $monthStart = date('m', strtotime($dateStart));
    
            // Requête pour récupérer les id_per
            $sql = "SELECT id_per
                    FROM Periode
                    WHERE YEAR(date_per) = :year_start
                      AND MONTH(date_per) >= :month_start
                    ORDER BY date_per ASC
                    LIMIT :nombre";
    
            $stmt = $this->db->prepare($sql);
    
            // Liaison des paramètres
            $stmt->bindParam(':year_start', $yearStart, PDO::PARAM_INT);
            $stmt->bindParam(':month_start', $monthStart, PDO::PARAM_INT);
            $stmt->bindParam(':nombre', $nombre, PDO::PARAM_INT);
    
            // Exécute la requête
            $stmt->execute();
    
            // Retourne les id_per sous forme de tableau
            return $stmt->fetchAll(PDO::FETCH_COLUMN);
    
        } catch (PDOException $e) {
            echo "Erreur SQL : " . $e->getMessage();
            return [];
        } catch (Exception $e) {
            echo "Erreur : " . $e->getMessage();
            return [];
        }
    }
    public function getRecetteParPeriodeParDepartementParNombreMois($nombre_mois, $id_per, $id_dept)
    {
        $retour =[];
        $id = [];
        for ($i=0; $i < 12 % $nombre_mois ; $i++) { 
            $retour[$i] = 0;
            $id = $this->getPeriodeIdsByStart($id_per,$nombre_mois);
            for ($i=0; $i < count($id); $i++) { 
                $retour[$i] = $retour[$i] + $this->getRecetteParPeriodeParDepartement($id[$i]['id_per'], $id_dept);
            }
            $id_per = $id[count($id)-1]['id_per'];
        }
        return $retour;
    }
    public function getDepenseParPeriodeParDepartementParNombreMois($nombre_mois, $id_per, $id_dept)
    {
        $retour =[];
        $id = [];
        for ($i=0; $i < 12 % $nombre_mois ; $i++) { 
            $retour[$i] = 0;
            $id = $this->getPeriodeIdsByStart($id_per,$nombre_mois);
            for ($i=0; $i < count($id); $i++) { 
                $retour[$i] = $retour[$i] + $this->getDepenseParPeriodeParDepartement($id[$i]['id_per'], $id_dept);
            }
            $id_per = $id[count($id)-1]['id_per'];
        }
        return $retour;
    }
    public function getSoldeFinAllPeriode($solde_debut, $nombre_mois, $id_per_start, $id_dept)
    {
        $retour = [];
        $recette = $this->getRecetteParPeriodeParDepartementParNombreMois($nombre_mois, $id_per_start, $id_dept);
        $depense = $this->getDepenseParPeriodeParDepartementParNombreMois($nombre_mois, $id_per_start, $id_dept);
        $solde_fin_realise =Flight::RealisationModel()->getSoldeFinAllPeriode($solde_debut, $nombre_mois, $id_per_start, $id_dept);
        for ($i=0; $i < count($recette); $i++) { 
            $retour[$i] = $solde_debut + $recette[$i] - $depense[$i];
            $solde_debut = $solde_fin_realise[$i];
        }
        return $retour;
    }
}