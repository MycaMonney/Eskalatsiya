-- =========================
-- Création de la base
-- =========================
CREATE DATABASE IF NOT EXISTS eskalatsiya
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;

USE eskalatsiya;

-- =========================
-- TABLE : LIEU
-- =========================
CREATE TABLE lieu (
    id_lieu INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    adresse VARCHAR(255),
    latitude FLOAT,
    longitude FLOAT
) ENGINE=InnoDB;

-- =========================
-- TABLE : VOIE
-- =========================
CREATE TABLE voie (
    id_voie INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    difficulte VARCHAR(50),
    description TEXT,
    duree_moyenne INT,
    id_lieu INT,
    CONSTRAINT fk_voie_lieu
        FOREIGN KEY (id_lieu)
        REFERENCES lieu(id_lieu)
        ON DELETE SET NULL
        ON UPDATE CASCADE
) ENGINE=InnoDB;

-- =========================
-- TABLE : UTILISATEUR
-- =========================
CREATE TABLE utilisateur (
    id_utilisateur INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    mot_de_passe_hash VARCHAR(255) NOT NULL
) ENGINE=InnoDB;

-- =========================
-- TABLE : SORTIE
-- =========================
CREATE TABLE sortie (
    id_sortie INT AUTO_INCREMENT PRIMARY KEY,
    date_sortie DATE NOT NULL,
    distance FLOAT,
    duree INT,
    vitesse_moyenne FLOAT,
    denivele INT,
    id_utilisateur INT,
    id_voie INT,
    CONSTRAINT fk_sortie_utilisateur
        FOREIGN KEY (id_utilisateur)
        REFERENCES utilisateur(id_utilisateur)
        ON DELETE SET NULL
        ON UPDATE CASCADE,
    CONSTRAINT fk_sortie_voie
        FOREIGN KEY (id_voie)
        REFERENCES voie(id_voie)
        ON DELETE SET NULL
        ON UPDATE CASCADE
) ENGINE=InnoDB;

-- =========================
-- TABLE : POINT_GPS
-- =========================
CREATE TABLE point_gps (
    id_point_gps INT AUTO_INCREMENT PRIMARY KEY,
    latitude FLOAT NOT NULL,
    longitude FLOAT NOT NULL,
    altitude FLOAT,
    timestamp DATETIME NOT NULL,
    id_sortie INT,
    CONSTRAINT fk_pointgps_sortie
        FOREIGN KEY (id_sortie)
        REFERENCES sortie(id_sortie)
        ON DELETE CASCADE
        ON UPDATE CASCADE
) ENGINE=InnoDB;