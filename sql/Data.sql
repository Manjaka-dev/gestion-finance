-- Données pour la table Categorie
INSERT INTO Categorie (id_cat, nom_cat) VALUES
(1, 'Marketing'),
(2, 'Finance'),
(3, 'Ressources Humaines');

-- Données pour la table Type
INSERT INTO Type (id_type, nom_type) VALUES
(1, 'Fixe'),
(2, 'Variable');

-- Données pour la table Periode
INSERT INTO Periode (id_per, date_per) VALUES
(1, '2023-01-01'),
(2, '2023-02-01'),
(3, '2023-03-01');

-- Données pour la table Rubrique
INSERT INTO Rubrique (id_rub, id_per, nom_rub, id_cat, id_type) VALUES
(1, 1, 'Publicité', 1, 2),
(2, 1, 'Salaires', 3, 1),
(3, 2, 'Consulting', 2, 2);

-- Données pour la table Departement
INSERT INTO Departement (id_dept, nom_dept) VALUES
(1, 'Ventes'),
(2, 'IT'),
(3, 'Support');

-- Données pour la table Prevision
INSERT INTO Prevision (id_prev, montant_prev, est_valider, id_per, id_dept) VALUES
(1, 10000.00, TRUE, 1, 1),
(2, 15000.00, FALSE, 2, 2),
(3, 20000.00, TRUE, 3, 3);

-- Données pour la table Realisation
INSERT INTO Realisation (id_rea, montant_rea, est_valider, id_dept, id_per) VALUES
(1, 9500.00, TRUE, 1, 1),
(2, 14000.00, FALSE, 2, 2),
(3, 21000.00, TRUE, 3, 3);

-- Données pour la table Employer
INSERT INTO Employer (id_emp, nom_emp, prenom_emp, date_naissance) VALUES
(1, 'Dupont', 'Jean', '1980-05-15'),
(2, 'Martin', 'Sophie', '1990-07-20'),
(3, 'Durand', 'Pierre', '1985-11-30');

-- Données pour la table Poste
INSERT INTO Poste (id_post, nom_post) VALUES
(1, 'Manager'),
(2, 'Analyste'),
(3, 'Développeur');

-- Données pour la table Mouvement_emp
INSERT INTO Mouvement_emp (id_mouv_emp, date_mouv_emp, id_emp, id_dept, id_post) VALUES
(1, '2023-01-10', 1, 1, 1),
(2, '2023-02-15', 2, 2, 2),
(3, '2023-03-20', 3, 3, 3);

-- Données pour la table Vue_departement
INSERT INTO Vue_departement (id_vue, master_id, slave_id) VALUES
(1, 1, 2),
(2, 2, 3),
(3, 3, 1);
