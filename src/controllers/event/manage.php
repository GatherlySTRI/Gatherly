<?php

require_once('vendor/autoload.php');
require_once('src/controllers/event/tools.php');

if (!isset($_SESSION['id_utilisateur'])) {
    header('Location: /login');
    exit;
}

use tools\event_tools;
use models\organisation\Etat;
use Twig\Loader\FilesystemLoader;
use Twig\Environment;

$loader = new FilesystemLoader('src/view');
$twig = new Environment($loader);

if ($_SESSION['est_Admin'] == false) {
    require_once('src/controllers/404.php');
    exit();
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST['idEventApprouve'])) {
        $idEvent = $_POST['idEventApprouve'];
        $etat = new Etat();

        $etat->find_by_column(null, 'id_evenement', $idEvent);

        $etat->set_est_approuve(1);

        if ($etat->get_est_archive() == 1) {
            $etat->set_est_archive(1);
        } else {
            $etat->set_est_archive(0);
        }

        $etat->edit();
    }
    if (isset($_POST['idEventDearchive'])) {
        $idEvent = $_POST['idEventDearchive'];
        $etat = new Etat();
        $etat->find_by_column(null, 'id_evenement', $idEvent);

        if ($etat->get_est_approuve()) {
            $etat->set_est_approuve(1);
        } else {
            $etat->set_est_approuve(0);
        }

        $etat->set_est_archive(0);
        $etat->edit();
    }
}
$eventsAll = event_tools::getAllEvents();
echo $twig->render("event/manage.twig", ['events' => $eventsAll, 'session' => $_SESSION]);
