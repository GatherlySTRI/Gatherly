<?php

require_once 'vendor/autoload.php';

use models\humain\Personne;
use models\humain\Arbitre;
use models\humain\Utilisateur;
use models\organisation\Billet;
use models\organisation\Acheter;
use models\organisation\Membre_Equipe;
use models\organisation\Evenement;
use models\organisation\Organiser;
use models\organisation\Participer;
use models\organisation\Assister;
use models\organisation\Periode_Evenement;
use models\organisation\Etat;
use models\organisation\Statuer;
use models\organisation\Sponsor;
use models\organisation\Sponsoriser;
use models\organisation\Media;
use models\organisation\Couvrir;
use models\competition\Arbre;
use models\competition\Phase_A_R;
use models\competition\Phase_Poule;
use models\competition\Match_Rugby;
use models\competition\Aller_Retour;
use models\competition\Phase_Arbre;
use models\competition\Etape_Contient;
use models\competition\Poule;
use models\competition\Poule_Contient;
use models\organisation\Acceder;
use models\competition\Equipe;
use models\organisation\Composer;
use models\organisation\Recompense;
use models\organisation\Recevoir_Recompense;
use models\organisation\Attribuer_Recompense;
use models\competition\Jouer;
use models\organisation\Disputer;
use models\organisation\Arbitrer;

// Récupération des variables d'environnement pour la connection à la bd.
$db_host = getenv('DB_HOST');
$db_port = getenv('DB_PORT');
$db_name = getenv('DB_NAME');
$db_user = getenv('DB_USER');
$db_password = getenv('DB_PASSWORD');

// Fichier de tests des classes models.

try {

    // Instanciation connecteur BDD

    
    // /!\ ATTENTION /!\ CETTE LIGNE VA SUPPRIMER LA BASE DE DONNEES ET LA RECREER. /!\ ATTENTION /!\
    $db = new \PDO("pgsql:host=$db_host;port=$db_port;dbname=postgres", $db_user, $db_password);
    $db->exec('DROP DATABASE IF EXISTS gatherly_db;');
    $db->exec('CREATE DATABASE gatherly_db;');
    $db = null;
    $db = new \PDO("pgsql:host=$db_host;port=$db_port;dbname=$db_name", $db_user, $db_password);
    $sql = file_get_contents('postgres/create_db.sql');
    $db->exec($sql);
    // /!\ ATTENTION /!\ CETTE LIGNE VA SUPPRIMER LA BASE DE DONNEES ET LA RECREER. /!\ ATTENTION /!\


    $personne = new Personne(null, 'John', 'Doe', '2000-01-01', 'M');
    $personne->save($db);
    $personne_2 = new Personne(null, 'Marie', 'Jeanne', '2000-01-01', 'F');
    $personne_2->save($db);
    $personne_3 = new Personne(null, 'QQUN', 'CEMEC', '2000-01-01', 'N');
    $personne_3->save($db);
    $personne_4 = new Personne(null, 'orga', 'dd', '2000-01-01', 'G');
    $personne_4->save($db);
    $personne_5 = new Personne(null, 'assis', 'dd', '2000-01-01', 'G');
    $personne_5->save($db);

    $arbitre = new Arbitre(null, 1);
    $arbitre->save($db);

    $utilisateur = new Utilisateur(null, 2, "mail@mail.com", "123456789", "mdp", "true");
    $utilisateur->save($db);
    $utilisateur_2 = new Utilisateur(null, 5, "mail@mail.com", "123456789", "mdp", "true");
    $utilisateur_2->save($db);

    $billet = new Billet(null, "50", "Billet stylé pour le rugby", "VIP", "false");
    $billet->save($db);

    $acheter = new Acheter(null, 1, 1);
    $acheter->save($db);

    $membre_equipe = new Membre_Equipe(null, 3, "joueur", "ailier");
    $membre_equipe->save($db);

    $evenement = new Evenement(null, "Truc cool", "Endroit cool", "toucher", "15", "Amateur");
    $evenement->save($db);

    $organiser = new Organiser(null, 1, 1, "2021-01-14");
    $organiser->save($db);

    $participer = new Participer(null, 1, 1, "2021-01-14");
    $participer->save($db);

    $assister = new Assister(null, 2, 1, "2021-01-14");
    $assister->save($db);

    $periode_evenement = new Periode_Evenement(null, 1, "2021-01-14", "2021-01-15");
    $periode_evenement->save($db);

    $etat = new Etat(null, 1, "false", "false");
    $etat->save($db);

    $statuer = new Statuer(null, 1, 1, "2021-01-14");
    $statuer->save($db);

    $sponsor = new Sponsor(null, "SponsorX", "sponsor@sponsor.com", "12345678");
    $sponsor->save($db);

    $sponsoriser = new Sponsoriser(null, 1, 1);
    $sponsoriser->save($db);

    $media = new Media(null, "mediaX", "media@mail.com", "123456789");
    $media->save($db);

    $couvrir = new Couvrir(null, 1, 1);
    $couvrir->save($db);

    $arbre = new Arbre(null, 1, "2021-01-14");
    $arbre->save($db);

    $phase_a_r = new Phase_A_R(null, 1, "2021-01-14", 1);
    $phase_a_r->save($db);

    $phase_poule = new Phase_Poule(null, 1, "2021-01-14", 1);
    $phase_poule->save($db);

    $match_rugby = new Match_Rugby(null, 1, "2021-01-14", "15:00:00");
    $match_rugby->save($db);

    $match_rugby_2 = new Match_Rugby(null, 1, "2021-01-14", "15:00:00");
    $match_rugby_2->save($db);

    $match_rugby_3 = new Match_Rugby(null, 1, "2021-01-14", "15:00:00");
    $match_rugby_3->save($db);

    $match_rugby_4 = new Match_Rugby(null, 1, "2021-01-14", "15:00:00");
    $match_rugby_4->save($db);

    $aller_retour = new Aller_Retour(null, 1, 2, 1);
    $aller_retour->save($db);

    $phase_arbre = new Phase_Arbre(null, 1, "huitieme");
    $phase_arbre->save($db);

    $etape_contient = new Etape_Contient(null, 1, 3);
    $etape_contient->save($db);

    $poule = new Poule(null, 1, "Groupe A", "2021-01-14");
    $poule->save($db);

    $poule_contient = new Poule_Contient(null, 1, 4);
    $poule_contient->save($db);

    $acceder = new Acceder(null, 1, 1);
    $acceder->save($db);

    $equipe = new Equipe(null, "EquipeX");
    $equipe->save($db);

    $composer = new Composer(null, 1, 1);
    $composer->save($db);

    $recompense = new Recompense(null, "Médaille d'or", "Or");
    $recompense->save($db);

    $recevoir_recompense = new Recevoir_Recompense(null, 1, 1);
    $recevoir_recompense->save($db);

    $attribuer_recompense = new Attribuer_Recompense(null, 1, 1);
    $attribuer_recompense->save($db);

    $jouer = new Jouer(null, 1, 1);
    $jouer->save($db);

    $disputer = new Disputer(null, 1, 1);
    $disputer->save($db);

    $arbitrer = new Arbitrer(null, 1, 1);
    $arbitrer->save($db);

    echo "TEST REUSSI\n";
} catch (Exception $e) {
    echo "TEST FAILED: $e\n";
}

?>