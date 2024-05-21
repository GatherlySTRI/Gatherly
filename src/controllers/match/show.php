<?php

require_once('vendor/autoload.php');
require_once('src/controllers/event/tools.php');
require_once('src/controllers/match/tools.php');

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['id_utilisateur'])) {
    // L'utilisateur est connecté, rediriger vers la page d'accueil
    header('Location: /login');
    exit;
}

use models\organisation\Evenement;
use models\competition\Match_Rugby;
use Twig\Loader\FilesystemLoader;
use Twig\Environment;

$loader = new FilesystemLoader('src/view');
$twig = new Environment($loader);

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $id_match = $_GET['id'];
    if(!verify_exist_match($id_match)){
        http_response_code(404);
        exit;
    }	
    $match = new Match_Rugby();
    $match->find(null, $id_match);
    echo $twig->render("match/show.twig", ['session' => $_SESSION, 'match' => $match->getData()]);
} else {
    http_response_code(405);
    exit;
}
