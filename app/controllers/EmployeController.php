<?php
namespace app\controllers;
session_start();
use app\models\Departement;
use app\models\Employe;
use Flight;
    class EmployeController
    {
        public function __construct()
        {
            
        }

        public function getFormulaireLogin()
        {
            Flight::render('loginEmp', ['depts' => Departement::getAll()]);
        }

        public function getAccueil()
        {
            Flight::render('accueil');
        }

        public function login() {
            $nom = Flight::request()->data->nom;
            $prenom = Flight::request()->data->prenom;
            $mdp = Flight::request()->data->mdp;
            
            $emp = Employe::login($nom,$prenom,$mdp);
            if ($emp) {
                $_SESSION['idEmploye'] = $emp->getId();
                Flight::redirect('/employe/accueil');
            } else {
                Flight::redirect('/employe');
            }
        }

        public function logout() {
            session_destroy();
            Flight::redirect('/employe');
        }
    }
    