<?php

namespace controllers\register;

require_once 'src/controllers/tools/form_tools.php';
require_once 'src/controllers/tools/account_tools.php';
require_once 'vendor/autoload.php';

use models\humain\Personne;
use models\humain\Utilisateur;
use Twig\Loader\FilesystemLoader;
use Twig\Environment;
use controllers\tools\form_tools;
use controllers\tools\account_tools;

function verify_all_params($params)
{ // Vérification de la présence et validité des paramètres
    $required_params = ['name', 'prenom', 'date_naissance', 'sexe', 'email', 'telephone', 'password'];
    foreach ($required_params as $param) {
        if (!array_key_exists($param, $params) || $params[$param] == "") {
            return false;
        }
    }
    if (!form_tools\is_date_valid($params['date_naissance'])) { // Vérification de la validité de la date
        return false;
    } elseif (!filter_var($params['email'], FILTER_VALIDATE_EMAIL)) { // Vérification de la validité de l'email
        return false;
    } elseif (!preg_match('/^[0-9]{10}$/', $params['telephone'])) { // Vérification de la validité du numéro de téléphone
        return false;
    } elseif (strlen($params['password']) < 8) { // Vérification de la validité du mot de passe
        return false;
    } elseif ($params['sexe'] != 'homme' && $params['sexe'] != 'femme') { // Vérification de la validité du sexe
        return false;
    }
    return true;
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') { // Si la requête est de type POST
    // Initialisation des models
    $personne = new Personne();
    $utilisateur = new Utilisateur();

    if (!verify_all_params($_POST)) { // Si les paramètres ne sont pas valides
        http_response_code(400);
        exit;
    }

    // Création de la personne
    //$personne->set_prenom_personne($_POST['prenom']);
    //$personne->set_nom_personne($_POST['name']);
    //$personne->set_date_naissance($_POST['date_naissance']);

    $personne->set_date_naissance("2024-01-01");
    $personne->set_prenom_personne("prenom");
    $personne->set_nom_personne("nom");


    if ($_POST['sexe'] == 'homme') {
        $personne->set_sexe('M');
    } else {
        $personne->set_sexe('F');
    }
    $personne->save();
    phpinfo();

    // Création de l'utilisateur
    $utilisateur->set_id_personne_utilisateur($personne->get_id_personne());
    $utilisateur->set_mail($_POST['email']);
    $hash = account_tools\hashPassword($_POST['password']);
    $utilisateur->set_mdp($hash);
    $utilisateur->set_telephone($_POST['telephone']);
    $utilisateur->set_est_admin(false);
    //$utilisateur->save();

    //Redirection vers la page de login
    header('Location: login');
    exit;
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') { // Si la requête est de type GET
    //Chargement de la vue
    $loader = new FilesystemLoader('src/view');
    $twig = new Environment($loader);
    echo $twig->render("register.twig");
} else {
    http_response_code(405);
}
