<?php
    class EmployeController
    {
        public function __construct()
        {
            
        }

        public function getFormulaireLogin()
        {
            Flight::render('loginEmp', ['depts' => Departement::getAll()]);
        }

        public function login() {
            $nom = Flight::request()->data->nom;
            $prenom = Flight::request()->data->prenom;
            $mdp = Flight::request()->data->mdp;
            $departement = Flight::request()->data->departement;
            
            if (Employe::login($nom,$prenom,$mdp,$departement)) {
                Flight::redirect('/employe');
            } else {
                Flight::redirect('/loginEmp');
            }
        }
    }
    