<?php

require_once('vendor/autoload.php');
require_once('src/controllers/event/tools.php');

if (!isset($_SESSION['id_utilisateur'])) {
    header('Location: /login');
    exit;
}

use models\organisation\Evenement;
use models\organisation\Organiser;
use models\organisation\Periode_Evenement;
use models\humain\Utilisateur;
use Twig\Loader\FilesystemLoader;
use Twig\Environment;

$loader = new FilesystemLoader('src/view');
$twig = new Environment($loader);

// Initilisation des objets de la base de données
$id_evenement = $_GET['id'];
$id_utilisateur = $_SESSION['id_utilisateur'];
$evenement = new Evenement();
$evenement->find(null, $id_evenement);
$organiser = new Organiser();
$organiser->find_by_column(null, 'id_evenement_organise', $id_evenement);
$utilisateur = new Utilisateur();
$utilisateur->find(null, $id_utilisateur);
$periode_evenement = new Periode_Evenement();
$periode_evenement->find_by_column(null, 'id_evenement_periode', $id_evenement);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!verify_all_params($_POST)) {
        http_response_code(400);
        exit;
    }

    $evenement->set_nom_evenement($_POST['nom']);
    $evenement->set_description_evenement($_POST['description']);
    $evenement->set_type_rugby($_POST['type']);
    $evenement->set_categorie_evenement($_POST['categorie']);
    $evenement->set_variante_rugby($_POST['variante']);
    $evenement->edit();

    header('Location: /event/show?id=' . $evenement->get_id_evenement());
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {

    echo $twig->render("event/edit.twig", [
        'is_session' => isset($_SESSION['id_utilisateur']),
        'evenement' => $evenement->getData(),
        'organiser' => $organiser->getData(),
        'periode_evenement' => $periode_evenement->getData(),
        'session' => $_SESSION
    ]);
} else {
    http_response_code(405);
    exit;
}

?>