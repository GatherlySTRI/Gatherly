-- create_db.sql

CREATE TABLE Personne (
    id_personne SERIAL PRIMARY KEY,
    prenom_personne VARCHAR(100),
    nom_personne VARCHAR(100),
    date_naissance DATE,
    sexe CHAR(10)
);

CREATE TABLE Arbitre (
    id_arbitre SERIAL PRIMARY KEY,
    id_personne_arbitre INT NOT NULL UNIQUE REFERENCES Personne(id_personne) ON DELETE CASCADE
);

CREATE TABLE Utilisateur (
    id_utilisateur SERIAL PRIMARY KEY,
    id_personne_utilisateur INT NOT NULL UNIQUE REFERENCES Personne(id_personne) ON DELETE CASCADE,
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
    est_gratuit BOOLEAN
    id_match_rugby INT NOT NULL,
    id_adresse_API VARCHAR(50) NOT NULL,
    FOREIGN KEY(id_match_rugby, id_adresse_API) REFERENCES MatchRubgy(id_match_rugby, id_adresse_API) ON DELETE CASCADE
);

CREATE TABLE Acheter (
    id_achat SERIAL PRIMARY KEY,
    date_achat DATE NOT NULL,
    id_utilisateur_achat INT NOT NULL REFERENCES Utilisateur(id_utilisateur) ON DELETE CASCADE,
    id_billet_achat INT NOT NULL REFERENCES Billet(id_billet) ON DELETE CASCADE
);

CREATE TYPE Role AS ENUM ('entraineur', 'joueur');

CREATE TABLE Membre_Equipe (
    id_membre SERIAL PRIMARY KEY,
    id_personne_membre INT NOT NULL REFERENCES Personne(id_personne) ON DELETE CASCADE,
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
    categorie_evenement VARCHAR(255),
    id_etat INT NOT NULL REFERENCES Etat(id_etat) ON DELETE CASCADE,
);

CREATE TABLE Organiser(
    id_organiser SERIAL PRIMARY KEY,
    id_organisateur INT NOT NULL REFERENCES Utilisateur(id_utilisateur) ON DELETE CASCADE,
    id_evenement_organise INT NOT NULL REFERENCES Evenement(id_evenement) ON DELETE CASCADE,
    date_creation DATE
);

CREATE TABLE Participer(
    id_participer SERIAL PRIMARY KEY,
    id_participant INT NOT NULL REFERENCES Utilisateur(id_utilisateur) ON DELETE CASCADE,
    id_evenement_participe INT NOT NULL REFERENCES Evenement(id_evenement) ON DELETE CASCADE,
    date_inscription DATE
);

CREATE TABLE Assister(
    id_assister SERIAL PRIMARY KEY,
    id_spectateur INT NOT NULL REFERENCES Utilisateur(id_utilisateur) ON DELETE CASCADE,
    id_evenement_assister INT NOT NULL REFERENCES Evenement(id_evenement) ON DELETE CASCADE,
    date_achat DATE
);

CREATE TABLE Periode_Evenement(
    id_periode_evenement SERIAL PRIMARY KEY,
    id_evenement_periode INT NOT NULL REFERENCES Evenement(id_evenement) ON DELETE CASCADE,
    date_debut DATE,
    date_fin DATE
);

CREATE TABLE Etat(
    id_etat SERIAL PRIMARY KEY,
    est_archive BOOLEAN,
    est_approuve BOOLEAN
);

CREATE TABLE Statuer(
    id_statuer SERIAL PRIMARY KEY,
    id_etat INT NOT NULL REFERENCES Etat(id_etat) ON DELETE CASCADE,
    id_utilisateur_etat INT NOT NULL REFERENCES Utilisateur(id_utilisateur) ON DELETE CASCADE,
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
    id_sponsor_sponsoriser INT NOT NULL REFERENCES Sponsor(id_sponsor) ON DELETE CASCADE,
    id_evenement_sponsoriser INT NOT NULL REFERENCES Evenement(id_evenement) ON DELETE CASCADE
);

CREATE TABLE Media(
    id_media SERIAL PRIMARY KEY,
    nom_media VARCHAR(255),
    email_media VARCHAR(255),
    telephone_media VARCHAR(255)
);

CREATE TABLE Couvrir(
    id_couvrir SERIAL PRIMARY KEY,
    id_media_couvrir INT NOT NULL REFERENCES Media(id_media) ON DELETE CASCADE,
    id_evenement_couvrir INT NOT NULL REFERENCES Evenement(id_evenement) ON DELETE CASCADE
);

CREATE TABLE Phase_Arbre(
    id_arbre SERIAL PRIMARY KEY,
    id_evenement_arbre INT NOT NULL REFERENCES Evenement(id_evenement) ON DELETE CASCADE,
    date_creation_arbre DATE
);

CREATE TABLE Phase_A_R(
    id_phase_a_r SERIAL PRIMARY KEY,
    id_evenement_phase_A_R INT NOT NULL REFERENCES Evenement(id_evenement) ON DELETE CASCADE,
    date_creation_A_R DATE,
    id_arbre_phase_A_R INT REFERENCES Phase_Arbre(id_arbre)
);

CREATE TABLE Phase_Poule(
    id_phase_poule SERIAL PRIMARY KEY,
    id_evenement_phase_poule INT NOT NULL REFERENCES Evenement(id_evenement) ON DELETE CASCADE,
    date_debut_phase_poule DATE,
    id_arbre_phase_poule INT NOT NULL REFERENCES Phase_Arbre(id_arbre) ON DELETE CASCADE
);

CREATE TABLE Match_Rugby(
    id_match_rugby SERIAL PRIMARY KEY,
    id_adresse_API INT,
    date_match_rugby DATE,
    heure_match_rugby TIME
);

CREATE TABLE Aller_Retour(
    id_aller_retour SERIAL PRIMARY KEY,
    id_match_rugby_aller INT NOT NULL REFERENCES Match_Rugby(id_match_rugby) ON DELETE CASCADE,
    id_match_rugby_retour INT NOT NULL REFERENCES Match_Rugby(id_match_rugby) ON DELETE CASCADE,
    id_aller_retour_phase_A_R_ INT NOT NULL REFERENCES Phase_A_R(id_phase_a_r) ON DELETE CASCADE
);

//A débattre
CREATE TABLE Se_deplacer(
   id_match_rugby,
   ID_adresse_API INT,
   date_retour DATE NOT NULL,
   ID_A_R INT NOT NULL,
   PRIMARY KEY(ID_Match, ID_adresse_API),
   UNIQUE(ID_A_R),
   FOREIGN KEY(ID_Match, ID_adresse_API) REFERENCES MatchRubgy(ID_Match, ID_adresse_API),
   FOREIGN KEY(ID_A_R) REFERENCES Aller_Retour(ID_A_R)
);

//A débattre
CREATE TABLE Recevoir(
   ID_Match INT,
   ID_adresse_API VARCHAR(50),
   date_aller DATE NOT NULL,
   ID_A_R INT NOT NULL,
   PRIMARY KEY(ID_Match, ID_adresse_API),
   UNIQUE(ID_A_R),
   FOREIGN KEY(ID_Match, ID_adresse_API) REFERENCES MatchRubgy(ID_Match, ID_adresse_API),
   FOREIGN KEY(ID_A_R) REFERENCES Aller_Retour(ID_A_R)
);

CREATE TYPE Type_Phase_Arbre AS ENUM ('seizieme','huitieme', 'quart', 'demi', 'finale');

CREATE TABLE Etape_Arbre(
    id_etape_arbre SERIAL PRIMARY KEY,
    id_phase_arbre INT NOT NULL REFERENCES Phase_Arbre(id_arbre) ON DELETE CASCADE,
    etape Type_Phase_Arbre
);

CREATE TABLE Disputer_Etape(
    id_etape_contient SERIAL PRIMARY KEY,
    id_phase_arbre_etape INT NOT NULL REFERENCES Etape_Arbre(id_etape_arbre) ON DELETE CASCADE,
    FOREIGN KEY(id_match_rugby, id_adresse_API) REFERENCES MatchRubgy(id_match_rugby, id_adresse_API) ON DELETE CASCADE
);

CREATE TABLE Poule(
    id_poule SERIAL PRIMARY KEY,
    id_phase_poule INT NOT NULL REFERENCES Phase_Poule(id_phase_poule) ON DELETE CASCADE,
    nom_poule VARCHAR(255),
    date_debut_poule DATE
);

CREATE TABLE Disputer_Match_Poule(
    id_poule_contient SERIAL PRIMARY KEY,
    id_poule_poule_contient INT NOT NULL REFERENCES Poule(id_poule) ON DELETE CASCADE,
    id_match_rugby_poule_contient INT NOT NULL REFERENCES Match_Rugby(id_match_rugby) ON DELETE CASCADE
);

CREATE TABLE Acceder(
    id_acceder SERIAL PRIMARY KEY,
    id_billet_acceder INT NOT NULL REFERENCES Billet(id_billet) ON DELETE CASCADE,
    id_match_rugby_acceder INT NOT NULL REFERENCES Match_Rugby(id_match_rugby) ON DELETE CASCADE
);

CREATE TABLE Equipe(
    id_equipe SERIAL PRIMARY KEY,
    nom_equipe VARCHAR(255)
);

CREATE TABLE Composer(
    id_composer SERIAL PRIMARY KEY,
    id_membre_equipe_composer INT NOT NULL REFERENCES Membre_Equipe(id_membre) ON DELETE CASCADE,
    id_equipe_composer INT NOT NULL REFERENCES Equipe(id_equipe) ON DELETE CASCADE
);

CREATE TABLE Recompense(
    id_recompense SERIAL PRIMARY KEY,
    nom_recompense VARCHAR(255),
    categorie_recompense VARCHAR(255),
    id_evenement_recompense INT NOT NULL REFERENCES Evenement(id_evenement) ON DELETE CASCADE,
    id_equipe_recompense INT NOT NULL REFERENCES Equipe(id_equipe) ON DELETE CASCADE
);

CREATE TABLE Recevoir_Recompense(
    id_recevoir_recompense SERIAL PRIMARY KEY,
    id_recompense_recevoir_recompense INT NOT NULL REFERENCES Recompense(id_recompense) ON DELETE CASCADE,
    id_equipe_recevoir_recompense INT NOT NULL REFERENCES Equipe(id_equipe) ON DELETE CASCADE
);

CREATE TABLE Attribuer_Recompense(
    id_attribuer_recompense SERIAL PRIMARY KEY,
    id_evenement_attribuer_recompense INT NOT NULL REFERENCES Evenement(id_evenement) ON DELETE CASCADE,
    id_recompense_attribuer_recompense INT NOT NULL REFERENCES Recompense(id_recompense) ON DELETE CASCADE
);

CREATE TABLE Jouer(
    id_jouer SERIAL PRIMARY KEY,
    FOREIGN KEY (id_match_rugby_jouer, id_adresse_API) INT NOT NULL REFERENCES Match_Rugby(id_match_rugby, id_adresse_API) ON DELETE CASCADE,
    id_equipe_jouer INT NOT NULL REFERENCES Equipe(id_equipe) ON DELETE CASCADE,
    score INT NOT NULL,
    nb_essais INT
);

CREATE TABLE Disputer(
    id_disputer SERIAL PRIMARY KEY,
    id_match_disputer INT NOT NULL REFERENCES Match_Rugby(id_match_rugby) ON DELETE CASCADE,
    id_evenement_disputer INT NOT NULL REFERENCES Evenement(id_evenement) ON DELETE CASCADE
);

CREATE TABLE Arbitrer(
    id_arbitrer SERIAL PRIMARY KEY,
    id_arbitre_arbitrer INT NOT NULL REFERENCES Arbitre(id_arbitre) ON DELETE CASCADE,
    id_match_arbitrer INT NOT NULL REFERENCES Match_Rugby(id_match_rugby) ON DELETE CASCADE,
    id_adresse_API_arbitrer INT NOT NULL REFERENCES Match_Rugby(id_adresse_API) ON DELETE CASCADE,
    FOREIGN KEY(id_match_rugby, id_adresse_API) REFERENCES MatchRubgy(id_match_rugby, id_adresse_API) ON DELETE CASCADE,
    role_Arbitre VARCHAR(255)
);
