<?php

namespace controllers\register;

require_once 'vendor/autoload.php';

if (isset($_SESSION['id_utilisateur'])) { // Si l'utilisateur est connecté
    // Redirection vers la page d'accueil
    ob_start(); // Start output buffering
    header('Location: /');
    ob_end_flush(); // End output buffering and flush the buffer
    exit;
}

use models\humain\Personne;
use models\humain\Utilisateur;
use Twig\Loader\FilesystemLoader;
use Twig\Environment;

use tools\form_tools;

function verify_all_params($params)
{ // Vérification de la présence et validité des paramètres
    $required_params = ['nom', 'prenom', 'date_naissance', 'sexe', 'email', 'telephone', 'mdp'];
    foreach ($required_params as $param) {
        if (!array_key_exists($param, $params) || $params[$param] == "") {
            return false;
        }
    }
    if (!form_tools::is_date_valid($params['date_naissance'])) { // Vérification de la validité de la date

        return false;
    } elseif (!filter_var($params['email'], FILTER_VALIDATE_EMAIL)) { // Vérification de la validité de l'email
        return false;
    } elseif (!preg_match('/^[0-9]{10}$/', $params['telephone'])) { // Vérification de la validité du numéro de téléphone
        return false;
    } elseif (strlen($params['mdp']) < 8) { // Vérification de la validité du mot de passe
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
    if (Utilisateur::is_mail_exist(null, $_POST['email'])) { // Si l'email existe déjà
        // Renvoie vers la page login avec une variable qui active une popup
        $loader = new FilesystemLoader('src/view');
        $twig = new Environment($loader);
        echo $twig->render("login.twig", ['email_exist' => true, 'is_session' => isset($_SESSION['id_utilisateur'])]);
        exit;
    }

    

    //Hashage du mot de passe
    $_POST['mdp'] = password_hash($_POST['mdp'], PASSWORD_DEFAULT);

    // Création de la personne
    $personne->set_nom_personne($_POST['nom']);
    $personne->set_prenom_personne($_POST['prenom']);
    $personne->set_date_naissance($_POST['date_naissance']);
    $personne->set_sexe($_POST['sexe']);
    $db = $personne->save();

    // Création de l'utilisateur
    $utilisateur->set_id_personne_utilisateur($db->lastInsertId());
    $utilisateur->set_mail($_POST['email']);
    $utilisateur->set_telephone($_POST['telephone']);
    $utilisateur->set_mdp($_POST['mdp']);
    $utilisateur->set_est_admin('false');
    $utilisateur->save();

    //Redirection vers la page de login
    $loader = new FilesystemLoader('src/view');
    $twig = new Environment($loader);
    echo $twig->render("login.twig", ['register_success' => true, 'session' => $_SESSION]);
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') { // Si la requête est de type GET

    //Chargement de la vue
    $loader = new FilesystemLoader('src/view');
    $twig = new Environment($loader);
    echo $twig->render("register.twig");
} else {
    http_response_code(405);
}
