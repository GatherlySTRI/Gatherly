<?php

require_once('vendor/autoload.php');

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['id_utilisateur'])) {
    // L'utilisateur est connecté, rediriger vers la page d'accueil
    header('Location: /login');
    exit;
}

use tools\event_tools;
use Twig\Loader\FilesystemLoader;
use Twig\Environment;

$loader = new FilesystemLoader('src/view');
$twig = new Environment($loader);

$eventsAll = event_tools::getAllEvents();

echo $twig->render("event/default.twig", ['events' => $eventsAll, 'is_session' => isset($_SESSION['id_utilisateur']), 'is_admin' => $_SESSION['est_Admin']]);
