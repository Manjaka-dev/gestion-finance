DROP TABLE IF EXISTS Vue_departement;
DROP TABLE IF EXISTS Mouvement_emp;
DROP TABLE IF EXISTS Poste;
DROP TABLE IF EXISTS Employer;
DROP TABLE IF EXISTS Realisation;
DROP TABLE IF EXISTS Prevision;
DROP TABLE IF EXISTS Departement;
DROP TABLE IF EXISTS Rubrique;
DROP TABLE IF EXISTS Periode;
DROP TABLE IF EXISTS Type;
DROP TABLE IF EXISTS Categorie;


-- Désactiver temporairement les contraintes de clé étrangère
SET FOREIGN_KEY_CHECKS = 0;

-- Vider les tables dans le bon ordre (les tables dépendantes en dernier)
TRUNCATE TABLE Vue_departement;
TRUNCATE TABLE Mouvement_emp;
TRUNCATE TABLE Realisation;
TRUNCATE TABLE Prevision;
TRUNCATE TABLE Rubrique;
TRUNCATE TABLE Employer;
TRUNCATE TABLE Poste;
TRUNCATE TABLE Departement;
TRUNCATE TABLE Periode;
TRUNCATE TABLE Type;
TRUNCATE TABLE Categorie;

-- Réactiver les contraintes de clé étrangère
SET FOREIGN_KEY_CHECKS = 1;
