<?php

require_once('vendor/autoload.php');

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['id_utilisateur'])) {
    // L'utilisateur est connecté, rediriger vers la page d'accueil
    header('Location: /login');
    exit;
}

use models\organisation\Evenement;
use models\organisation\Organiser;
use models\organisation\Periode_Evenement;
use Twig\Loader\FilesystemLoader;
use Twig\Environment;

$loader = new FilesystemLoader('src/view');
$twig = new Environment($loader);

function verify_all_params($params)
{ // Vérification de la présence et validité des paramètres
    $required_params = ['nom', 'description', 'type', 'categorie', 'variante', 'date_debut', 'date_fin'];
    foreach ($required_params as $param) {
        if (!array_key_exists($param, $params) || $params[$param] == "") {
            return false;
        }
    }
    if ($params['variante'] != '15' && $params['variante'] != '13' && $params['variante'] != '7') {
        return false;
    }
    if ($params['type'] != 'contact' && $params['type'] != 'touche') {
        return false;
    }
    if ($params['date_debut'] > $params['date_fin']) {
        return false;
    }
    return true;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!verify_all_params($_POST)) { // Si les paramètres sont invalides
        http_response_code(400);
        exit;
    }
    $evenement = new Evenement(null, $_POST['nom'], $_POST['description'], $_POST['type'], $_POST['variante'], $_POST['categorie']);
    $db = $evenement->save();
    $evenement_id = $db->lastInsertId();

    $organiser = new Organiser(null, $_SESSION['id_utilisateur'], $evenement_id, date('Y-m-d H:i:s'));
    $organiser->save();

    $periode_evenement = new Periode_Evenement(null, $evenement_id, $_POST['date_debut'], $_POST['date_fin']);
    $periode_evenement->save();

    header('Location: /event/show?id=' . $evenement_id);
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
    echo $twig->render("event/create.twig", ['is_session' => isset($_SESSION['id_utilisateur'])]);
} else {
    http_response_code(405);
    exit;
}
