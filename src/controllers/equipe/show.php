<?php

require_once('vendor/autoload.php');
require_once('src/controllers/equipe/tools.php');

use models\competition\Equipe;
use models\humain\Personne;
use models\BaseEntity;
use models\humain\Utilisateur;
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
$equipes = BaseEntity::find_all_by_column(null, "Equipe", Equipe::class, "id_utilisateur_equipe", $_SESSION['id_utilisateur']);
$equipes_array = [];
foreach ($equipes as $equipe) {
    $equipes_array[] = $equipe->getData();
} 

$utilisateur = new Utilisateur();
$utilisateur->find_by_column(null, "id_utilisateur", $_SESSION['id_utilisateur']);
$personne = new Personne();
$personne->find(null, $utilisateur->get_id_personne_utilisateur());


$loader = new FilesystemLoader('src/view');
$twig = new Environment($loader);
echo $twig->render("equipe/show.twig", ['session' => $_SESSION, 'equipes'=>$equipes_array, 'personne'=>$personne->getData()]);
