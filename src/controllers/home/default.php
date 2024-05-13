<?php
require_once 'vendor/autoload.php';


use models\humain\Personne;
use Twig\Loader\FilesystemLoader;
use Twig\Environment;

use tools\event_tools;

$loader = new FilesystemLoader('src/view');
$twig = new Environment($loader);

$events = event_tools::getAllEvents();

krsort($events); //mets les events les plus récents en premier

$events = event_tools::retirerArchive($events);
$events = event_tools::retirerNonApprouve($events);

echo $twig->render('home.twig', ['events' => $events, 'is_session' => isset($_SESSION['id_utilisateur']), 'is_admin' => $_SESSION['est_Admin']]);
