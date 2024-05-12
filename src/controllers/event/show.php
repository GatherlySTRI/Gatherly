<?php

require_once('vendor/autoload.php');
require_once('src/controllers/event/tools.php');

use models\organisation\Evenement;
use models\organisation\Organiser;
use models\humain\Utilisateur;
use Twig\Loader\FilesystemLoader;
use Twig\Environment;

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['id_utilisateur'])) {
    // L'utilisateur est connecté, rediriger vers la page d'accueil
    header('Location: /login');
    exit;
}


if ($_SERVER['REQUEST_METHOD'] != 'GET') { // Vérification de la méthode de la requête
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

if (!verify_exist_event($id_evenement)) { // Vérification que l'évenement existe
    http_response_code(404);
    exit;
}

if (!verify_right($id_evenement, $id_utilisateur)) { // Vérification que l'évènement appartient bien à l'utilisateur ou si l'utilisateur est admin
    http_response_code(403);
    exit;
}

$loader = new FilesystemLoader('src/view');
$twig = new Environment($loader);

echo $twig->render("event/show.twig", ['evenement' => $evenement->getData(), 'organiser' => $organiser, 'is_session' => isset($_SESSION['id_utilisateur'])]);
