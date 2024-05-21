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

$id_utilisateur = $_SESSION['id_utilisateur'];

//Récupération de l'id de l'évenement dans le cas d'un match simple
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $id_evenement = $_GET['id_evenement'];
}
elseif($_SERVER['REQUEST_METHOD'] === 'POST'){
    $id_evenement = $_POST['id_evenement'];
}
else{
    http_response_code(405);
    exit;
}

if (!verify_exist_event($id_evenement)) { // Vérification que l'évenement existe
    http_response_code(404);
    exit;
}
if (!verify_right($id_evenement, $id_utilisateur)) { // Vérification que l'évènement appartient bien à l'utilisateur ou si l'utilisateur est admin
    http_response_code(403);
    exit;
}
if(get_type_evenement($id_evenement) != 'Match'){
    http_response_code(400);       
    exit;
}

use models\BaseEntity;
use models\competition\Match_Rugby;
use Twig\Loader\FilesystemLoader;
use Twig\Environment;
use models\competition\Equipe;
use models\competition\Jouer;

$loader = new FilesystemLoader('src/view');
$twig = new Environment($loader);
$equipes = BaseEntity::find_all_by_column(null, 'Equipe', Equipe::class, 'id_utilisateur_equipe', $id_utilisateur);
$equipes_array = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!verify_params_match($_POST)) {
        http_response_code(400);
        exit;
    }
    // Vérification que les équipes sont différentes
    if ($_POST ['equipe1'] == $_POST ['equipe2']) {
        header('Location: /match/create?error=Vous devez choisir 2 équipes différentes &id_evenement=' . $id_evenement);
        exit;
    }
    // Si l'evenement ets de type match simple
    if ($id_evenement != null) {
        $match = new Match_Rugby(null, $_POST['address_id'], $_POST['date_debut'], $_POST['heure'], $id_evenement);
        $db = $match->save();
        $id_match = $db->lastInsertId();
    }
    else {
        http_response_code(400);
        exit;
    }

    $jouer_1 = new Jouer(null, $id_match,  $_POST['equipe1']);
    $db = $jouer_1->save();
    $jouer_2 = new Jouer(null, $id_match,  $_POST['equipe2']);
    $db = $jouer_2->save();

    header('Location: /event/show?id=' . $id_evenement);
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Récupération de toutes les équipes
    $error = $_GET['error'] ?? 0;
    foreach ($equipes as $equipe) {
        $equipes_array[] = $equipe->getData();
    }
    echo $twig->render("match/create.twig", ['session' => $_SESSION, 'id_evenement' => $id_evenement, 'equipes' => $equipes_array, 'error' => $error]);
} else {
    http_response_code(405);
    exit;
}
