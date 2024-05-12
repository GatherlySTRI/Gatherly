<?php

require_once('vendor/autoload.php');

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['id_utilisateur'])) {
    // L'utilisateur est connecté, rediriger vers la page d'accueil
    header('Location: /login');
    exit;
}

use models\organisation\Evenement;
use models\organisation\Periode_Evenement;
use models\organisation\Etat;
use Twig\Loader\FilesystemLoader;
use Twig\Environment;

$loader = new FilesystemLoader('src/view');
$twig = new Environment($loader);

$event = new Evenement();
$periode = new Periode_Evenement();
$etat = new Etat();

$events = $event->getAllLines();
$periodes = $periode->getAllLines();
$etats = $etat->getAllLines();

$eventsAll = [];

//mets tout dans une var
foreach ($events as $event) {
    foreach ($periodes as $periode) {
        foreach ($etats as $etat) {

            if ($periode['id_evenement_periode'] === $event['id_evenement'] && $etat['id_evenement'] === $event['id_evenement'] || !empty($etat['id_evenement'])) {
                array_push($eventsAll, array_merge($event, array_merge($periode, $etat)));
                break (2);
            }
        }
    }
}

echo $twig->render("event/default.twig", ['events' => $eventsAll, 'is_session' => isset($_SESSION['id_utilisateur'])]);
