<?php

require_once('vendor/autoload.php');

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['id_utilisateur'])) {
    // L'utilisateur est connecté, rediriger vers la page d'accueil
    header('Location: /login');
    exit;
}

if($_SERVER['REQUEST_METHOD'] != 'GET'){// Vérification de la méthode de la requête
    http_response_code(405);
    exit;
}

use models\organisation\Evenement;
use models\organisation\Organiser;
use models\humain\Utilisateur;
use models\competition\Match_Rugby;

// Initilisation des objets de la base de données
$id_match = $_GET['id'];
$match_rugby = new Match_Rugby();
$match_rugby->find(null, $id_match);
$id_evenement = $match_rugby->get_id_evenement();
$id_utilisateur = $_SESSION['id_utilisateur'];
$evenement = new Evenement();
$evenement->find(null, $id_evenement);
$organiser = new Organiser();
$organiser->find_by_column(null, 'id_evenement_organise', $id_evenement);
$utilisateur = new Utilisateur();
$utilisateur->find(null, $id_utilisateur);

if($evenement->get_id_evenement() == null){// Vérification que l'évenement existe
    http_response_code(404);
    exit;
}

if($organiser->get_id_organisateur() != $_SESSION['id_utilisateur'] && !$utilisateur->get_est_admin()){// Vérification que l'évènement appartient bien à l'utilisateur ou si l'utilisateur est admin
    http_response_code(403);
    exit;
}

$match_rugby->delete();

header('Location: /');

?>