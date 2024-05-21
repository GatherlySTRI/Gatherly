<?php

require_once('vendor/autoload.php');
require_once('src/controllers/equipe/tools.php');

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['id_utilisateur'])) {
    // L'utilisateur est connecté, rediriger vers la page d'accueil
    header('Location: /login');
    exit;
}

$id_utilisateur = $_SESSION['id_utilisateur'];

use models\competition\Equipe;
use Twig\Loader\FilesystemLoader;
use Twig\Environment;

$loader = new FilesystemLoader('src/view');
$twig = new Environment($loader);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!verify_params_equipe($_POST)) {
        http_response_code(400);
        exit;
    }

    $equipe = new Equipe(null, $_POST['nom_equipe'], $id_utilisateur);
    $equipe->save();

    header('Location: /equipe/show');
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
    echo $twig->render("equipe/create.twig", ['session' => $_SESSION]);
} else {
    http_response_code(405);
    exit;
}
