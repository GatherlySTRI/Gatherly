-- create_db.sql

DROP DATABASE gatherly_db;
CREATE DATABASE gatherly_db;

\c gatherly_db;

CREATE TABLE Personne (
    id_personne SERIAL PRIMARY KEY,
    prenomPersonne VARCHAR(100),
    nomPersonne VARCHAR(100),
    date_naissance DATE,
    sexe CHAR(1)
);

CREATE TABLE Arbitre (
    id_arbitre SERIAL PRIMARY KEY,
    id_personne_arbitre INT NOT NULL REFERENCES Personne(id_personne)
);

CREATE TABLE Utilisateur (
    id_utilisateur SERIAL PRIMARY KEY,
    id_personne_utilisateur INT NOT NULL REFERENCES Personne(id_personne),
    mail VARCHAR(255),
    telephone VARCHAR(20),
    mdp VARCHAR(255),
    est_admin BOOLEAN
);

CREATE TABLE Billet (
    id_billet SERIAL PRIMARY KEY,
    prix DECIMAL(5,2),
    description_billet VARCHAR(255),
    categorie_billet VARCHAR(255),
    est_reduction BOOLEAN
);

CREATE TABLE Acheter (
    id_achat SERIAL PRIMARY KEY,
    id_utilisateur_achat INT NOT NULL REFERENCES Utilisateur(id_utilisateur),
    id_billet_achat INT NOT NULL REFERENCES Billet(id_billet)
);

CREATE TYPE Role AS ENUM ('entraineur', 'joueur');

CREATE TABLE Membre_Equipe (
    id_membre SERIAL PRIMARY KEY,
    id_personne_membre INT NOT NULL REFERENCES Personne(id_personne),
    role_membre Role,
    poste VARCHAR(255)
);

CREATE TYPE Type_Rugby AS ENUM ('contact', 'toucher');
CREATE TYPE Variante_Rugby AS ENUM ('15', '7', '13');

CREATE TABLE Evenement (
    id_evenement SERIAL PRIMARY KEY,
    nom_evenement VARCHAR(255),
    description_evenement VARCHAR(1000),
    type_rugby Type_Rugby,
    variante_rugby Variante_Rugby,
    categorie_evenement VARCHAR(255)
);

CREATE TABLE Organiser(
    id_organisateur INT NOT NULL REFERENCES Utilisateur(id_utilisateur),
    id_evenement_organise INT NOT NULL REFERENCES Evenement(id_evenement),
    date_creation DATE
);

CREATE TABLE Participer(
    id_participant INT NOT NULL REFERENCES Membre_Equipe(id_membre),
    id_evenement_participe INT NOT NULL REFERENCES Evenement(id_evenement),
    date_inscription DATE
);

CREATE TABLE Assister(
    id_spectateur INT NOT NULL REFERENCES Utilisateur(id_utilisateur),
    id_evenement_assiste INT NOT NULL REFERENCES Evenement(id_evenement),
    date_achat DATE
);

CREATE TABLE Periode_Evenement(
    id_periode_evenement SERIAL PRIMARY KEY,
    id_evenement_periode INT NOT NULL REFERENCES Evenement(id_evenement),
    date_debut DATE,
    date_fin DATE
);

CREATE TABLE Etat(
    id_etat SERIAL PRIMARY KEY,
    id_evenement INT NOT NULL REFERENCES Evenement(id_evenement),
    est_archive BOOLEAN,
    est_approuve BOOLEAN
);

CREATE TABLE Statuer(
    id_statuer SERIAL PRIMARY KEY,
    id_etat INT NOT NULL REFERENCES Etat(id_etat),
    id_utilisateur_etat INT NOT NULL REFERENCES Utilisateur(id_utilisateur),
    date_statut DATE
);

CREATE TABLE Sponsor(
    id_sponsor SERIAL PRIMARY KEY,
    nom_sponsor VARCHAR(255),
    email_sponsor VARCHAR(255),
    telephone_sponsor VARCHAR(20)
);

CREATE TABLE Sponsoriser(
    id_sponsoriser SERIAL PRIMARY KEY,
    id_sponsor_sponsoriser INT NOT NULL REFERENCES Sponsor(id_sponsor),
    id_evenement_sponsoriser INT NOT NULL REFERENCES Evenement(id_evenement)
);

CREATE TABLE Media(
    id_media SERIAL PRIMARY KEY,
    nom_media VARCHAR(255),
    email_media VARCHAR(255),
    telephone_media VARCHAR(255)
);

CREATE TABLE Couvrir(
    id_couvrir SERIAL PRIMARY KEY,
    id_media_couvrir INT NOT NULL REFERENCES Media(id_media),
    id_evenement_couvrir INT NOT NULL REFERENCES Evenement(id_evenement)
);

CREATE TABLE Arbre(
    id_arbre SERIAL PRIMARY KEY,
    id_evenement_arbre INT NOT NULL REFERENCES Evenement(id_evenement),
    date_creation_arbre DATE
);

CREATE TABLE Phase_A_R(
    id_phase_a_r SERIAL PRIMARY KEY,
    id_evenement_phase_A_R INT NOT NULL REFERENCES Evenement(id_evenement),
    date_creation_A_R DATE,
    id_phase_A_R_arbre INT REFERENCES Arbre(id_arbre)
);

CREATE TABLE Phase_Poule(
    id_phase_poule SERIAL PRIMARY KEY,
    id_evenement_phase_poule INT NOT NULL REFERENCES Evenement(id_evenement),
    date_creation_poule DATE,
    id_phase_poule_arbre INT NOT NULL REFERENCES Arbre(id_arbre)
);

CREATE TABLE Match(
    id_match SERIAL PRIMARY KEY,
    id_adresse_API INT,
    date_match DATE,
    heure_match TIME
);

CREATE TABLE Aller_Retour(
    id_aller_retour SERIAL PRIMARY KEY,
    id_match_aller INT NOT NULL REFERENCES Match(id_match),
    id_match_retour INT NOT NULL REFERENCES Match(id_match),
    id_phase_A_R_aller_retour INT NOT NULL REFERENCES Phase_A_R(id_phase_a_r)
);

CREATE TYPE Type_Phase_Arbre AS ENUM ('seizieme','huitieme', 'quart', 'demi', 'finale');

CREATE TABLE Phase_Arbre(
    id_phase_arbre SERIAL PRIMARY KEY,
    id_phase_arbre_arbre INT NOT NULL REFERENCES Arbre(id_arbre),
    etape Type_Phase_Arbre
);

CREATE TABLE Etape_Contient(
    id_etape_contient SERIAL PRIMARY KEY,
    id_phase_arbre_etape INT NOT NULL REFERENCES Phase_Arbre(id_phase_arbre),
    id_match_etape INT NOT NULL REFERENCES Match(id_match)
);

CREATE TABLE Poule(
    id_poule SERIAL PRIMARY KEY,
    id_phase_poule_poule INT NOT NULL REFERENCES Phase_Poule(id_phase_poule),
    nom_poule VARCHAR(255),
    date_debut_poule DATE
);

CREATE TABLE Poule_Contient(
    id_poule_contient SERIAL PRIMARY KEY,
    id_poule_poule_contient INT NOT NULL REFERENCES Poule(id_poule),
    id_match_poule_contient INT NOT NULL REFERENCES Match(id_match)
);

CREATE TABLE Acceder(
    id_acceder INT SERIAL PRIMARY KEY,
    id_billet_acceder INT NOT NULL REFERENCES Billet(id_billet),
    id_match_acceder INT NOT NULL REFERENCES Match(id_match)
)

CREATE TABLE Equipe(
    id_equipe SERIAL PRIMARY KEY,
    nom_equipe VARCHAR(255),
);

CREATE TABLE Composer(
    id_composer SERIAL PRIMARY KEY,
    id_membre_equipe_composer INT NOT NULL REFERENCES Membre_Equipe(id_membre),
    id_equipe_composer INT NOT NULL REFERENCES Equipe(id_equipe)
);