<?php
namespace controllers\register;


require_once 'vendor/autoload.php';

use models\humain\Personne;
use models\humain\Utilisateur;
use Twig\Loader\FilesystemLoader;
use Twig\Environment;
use controllers\tools\form_tools;

function verify_all_params($params) {// Vérification de la présence et validité des paramètres
    $required_params = ['name', 'prenom', 'date_naissance', 'sexe', 'email', 'telephone', 'password'];
    foreach ($required_params as $param) {
        if ($params[$param] == "") {
            return false;
        }
    }
    if (!form_tools\is_date_valid($params['date_naissance'])) {
        return false;
    }
    return true;
}

//Chargement de la vue


if ($_SERVER['REQUEST_METHOD'] === 'POST') {// Si la requête est de type POST
    // Initialisation des models
    $personne = new Personne();
    $utilisateur = new Utilisateur();

    if (!verify_all_params($_POST)) {// Si les paramètres ne sont pas valides
        http_response_code(400);
        exit;
    }
    //Redirection vers la page de login
    header('Location: login');
    exit;
}

$loader = new FilesystemLoader('src/view');
$twig = new Environment($loader);

echo $twig->render("register.twig");