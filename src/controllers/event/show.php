<?php

require_once('vendor/autoload.php');

use models\organisation\Evenement;
use models\organisation\Organiser;
use models\humain\Utilisateur;
use Twig\Loader\FilesystemLoader;
use Twig\Environment;

session_start();
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

// Initilisation des objets de la base de données
$id_evenement = $_GET['id'];
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

$loader = new FilesystemLoader('src/view');
$twig = new Environment($loader);

echo $twig->render("event/show.twig", ['evenement' => $evenement->getData(), 'organiser' => $organiser, 'is_session' => isset($_SESSION['id_utilisateur'])]);


?>