<?php

require_once('vendor/autoload.php');
require_once('src/controllers/event/tools.php');

use models\BaseEntity;
use models\competition\Match_Rugby;
use models\organisation\Evenement;
use models\organisation\Organiser;
use models\competition\Equipe;
use models\humain\Utilisateur;
use models\competition\Jouer;
use Twig\Loader\FilesystemLoader;
use Twig\Environment;

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['id_utilisateur'])) {
    // L'utilisateur est connecté, rediriger vers la page d'accueil
    header('Location: /login');
    exit;
}


if ($_SERVER['REQUEST_METHOD'] != 'GET') { // Vérification de la méthode de la requête
    http_response_code(405);
    exit;
}


// Initilisation des objets de la base de données
$id_evenement = $_GET['id'];
$voir_matchs = $_GET['voir_matchs'] ?? 0;
$id_utilisateur = $_SESSION['id_utilisateur'];
$evenement = new Evenement();
$evenement->find(null, $id_evenement);
$organiser = new Organiser();
$organiser->find_by_column(null, 'id_evenement_organise', $id_evenement);
$utilisateur = new Utilisateur();
$utilisateur->find(null, $id_utilisateur);
$matchs = [];
// Vérification si c'est un match simple
if ($evenement->get_categorie_evenement() == 'Match') {
    $matchs = BaseEntity::find_all_by_column(null, 'Match_Rugby', Match_Rugby::class, 'id_evenement', $id_evenement);
    $equipes = [];
    foreach ($matchs as $match) {
        $jouers = BaseEntity::find_all_by_column(null, 'Jouer', Jouer::class, 'id_match_rugby_jouer', $match->get_id_match_rugby());
        $equipe1 = new Equipe();
        $equipe1->find(null, $jouers[0]->get_id_equipe_jouer());
        $equipe2 = new Equipe();
        $equipe2->find(null, $jouers[1]->get_id_equipe_jouer());
        $equipes[] = ['equipe1' => $equipe1->get_nom_equipe(), 'equipe2' => $equipe2->get_nom_equipe()];
    }
}
if (!verify_exist_event($id_evenement)) { // Vérification que l'évenement existe
    http_response_code(404);
    exit;
}

if (!verify_right($id_evenement, $id_utilisateur)) { // Vérification que l'évènement appartient bien à l'utilisateur ou si l'utilisateur est admin
    http_response_code(403);
    exit;
}

$loader = new FilesystemLoader('src/view');
$twig = new Environment($loader);
echo $twig->render("event/show.twig", ['evenement' => $evenement->getData(), 'organiser' => $organiser->getData(), 'session' => $_SESSION, 'voir_matchs' => $voir_matchs, 'id_evenement' => $id_evenement, 'is_session' => isset($_SESSION['id_utilisateur']), 'matchs' => $matchs, 'equipes' => $equipes, 'utilisateur' => $utilisateur->getData()]);
