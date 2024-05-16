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

$eventsAll = event_tools::retirerArchive($eventsAll);
$eventsAll = event_tools::retirerNonApprouve($eventsAll);

echo $twig->render("event/default.twig", ['events' => $eventsAll, 'session' => $_SESSION]);
