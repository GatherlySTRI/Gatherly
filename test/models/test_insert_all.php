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

    $utilisateur = new Utilisateur(null, 2, "t.collet974@gmail.com", "0784202855", "mdp", "true");
    $utilisateur->save($db);
    $utilisateur_2 = new Utilisateur(null, 5, "t.collet974@outlook.fr", "0784202855", "mdp", "true");
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

} catch (Exception $e) {
    echo "TEST FAILED: $e\n";
}

?>