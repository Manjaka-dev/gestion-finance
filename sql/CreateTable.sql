CREATE TABLE Categorie (
    id_cat INT PRIMARY KEY NOT NULL,
    nom_cat VARCHAR(20) NOT NULL
);

CREATE TABLE Type (
    id_type INT PRIMARY KEY NOT NULL,
    nom_type VARCHAR(20) NOT NULL
);

CREATE TABLE Rubrique (
    id_rub INT PRIMARY KEY NOT NULL,
    nom_rub VARCHAR(255) NOT NULL,
    id_cat INT NOT NULL,
    id_type INT NOT NULL,
    FOREIGN KEY (id_cat) REFERENCES Categorie(id_cat),
    FOREIGN KEY (id_type) REFERENCES Type(id_type)
);

CREATE TABLE Periode (
    id_per INT PRIMARY KEY NOT NULL,
    date_per DATE NOT NULL,
    id_rub INT,
    FOREIGN KEY (id_rub) REFERENCES Rubrique(id_rub)
);

CREATE TABLE Departement (
    id_dept INT PRIMARY KEY NOT NULL,
    nom_dept VARCHAR(20) NOT NULL
);

CREATE TABLE Prevision (
    id_prev INT PRIMARY KEY NOT NULL,
    montant_prev DOUBLE NOT NULL,
    est_valider BOOLEAN,
    id_per INT,
    id_dept INT,
    FOREIGN KEY (id_per) REFERENCES Periode(id_per),
    FOREIGN KEY (id_dept) REFERENCES Departement(id_dept)
);

CREATE TABLE Realisation (
    id_rea INT PRIMARY KEY NOT NULL,
    montant_rea DOUBLE NOT NULL,
    est_valider BOOLEAN,
    id_dept INT,
    id_per INT,
    FOREIGN KEY (id_dept) REFERENCES Departement(id_dept),
    FOREIGN KEY (id_per) REFERENCES Periode(id_per)
);

CREATE TABLE Employer (
    id_emp INT PRIMARY KEY NOT NULL,
    nom_emp VARCHAR(20) NOT NULL,
    prenom_emp VARCHAR(20) NOT NULL,
    date_naissance DATE
);

CREATE TABLE Poste (
    id_post INT PRIMARY KEY NOT NULL,
    nom_post VARCHAR(20)
);

CREATE TABLE Mouvement_emp (
    id_mouv_emp INT PRIMARY KEY NOT NULL,
    date_mouv_emp DATE,
    id_emp INT,
    id_dept INT,
    id_post INT,
    FOREIGN KEY (id_emp) REFERENCES Employer(id_emp),
    FOREIGN KEY (id_dept) REFERENCES Departement(id_dept),
    FOREIGN KEY (id_post) REFERENCES Poste(id_post)
);

CREATE TABLE Vue_departement (
    id_vue INT PRIMARY KEY NOT NULL,
    master_id INT,
    slave_id INT,
    FOREIGN KEY (master_id) REFERENCES Departement(id_dept),
    FOREIGN KEY (slave_id) REFERENCES Departement(id_dept)
);
