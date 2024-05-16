<?php

require_once('vendor/autoload.php');
require_once('src/controllers/event/tools.php');

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['id_utilisateur'])) {
    // L'utilisateur est connecté, rediriger vers la page d'accueil
    header('Location: /login');
    exit;
}

use models\organisation\Evenement;
use models\organisation\Organiser;
use models\organisation\Periode_Evenement;
use models\organisation\Etat;
use Twig\Loader\FilesystemLoader;
use Twig\Environment;

$loader = new FilesystemLoader('src/view');
$twig = new Environment($loader);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!verify_all_params($_POST)) { // Si les paramètres sont invalides
        http_response_code(400);
        exit;
    }
    $evenement = new Evenement(null, $_POST['nom'], $_POST['description'], $_POST['type'], $_POST['variante'], $_POST['categorie']);
    $db = $evenement->save();
    $evenement_id = $db->lastInsertId();

    $organiser = new Organiser(null, $_SESSION['id_utilisateur'], $evenement_id, date('Y-m-d H:i:s'));
    $db = $organiser->save();

    $periode_evenement = new Periode_Evenement(null, $evenement_id, $_POST['date_debut'], $_POST['date_fin']);
    $db = $periode_evenement->save();

    if ($_SESSION['est_Admin'] == true) {
        $etat = new Etat(null, $evenement_id, 0, 1); //pre approuvé si admin
    } else {
        $etat = new Etat(null, $evenement_id, 0, 0);
    }
    $db = $etat->save();

    header('Location: /event/show?id=' . $evenement_id);
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
    echo $twig->render("event/create.twig", ['session' => $_SESSION]);
} else {
    http_response_code(405);
    exit;
}
