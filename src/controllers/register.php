<?php
namespace controllers\register;

require_once 'src/controllers/tools/form_tools.php';
require_once 'vendor/autoload.php';

use models\humain\Personne;
use models\humain\Utilisateur;
use Twig\Loader\FilesystemLoader;
use Twig\Environment;
use controllers\tools\form_tools;

function verify_all_params($params) {// Vérification de la présence et validité des paramètres
    $required_params = ['nom', 'prenom', 'date_naissance', 'sexe', 'email', 'telephone', 'mdp'];
    foreach ($required_params as $param) {
        if (!array_key_exists($param, $params) || $params[$param] == "") {
            return false;
        }
    }
    if (!form_tools\is_date_valid($params['date_naissance'])) {// Vérification de la validité de la date
        return false;
    }
    elseif(!filter_var($params['email'], FILTER_VALIDATE_EMAIL)){// Vérification de la validité de l'email
        return false;
    }
    elseif(!preg_match('/^[0-9]{10}$/', $params['telephone'])){// Vérification de la validité du numéro de téléphone
        return false;
    }
    elseif(strlen($params['mdp'])<8){// Vérification de la validité du mot de passe
        return false;
    }
    elseif($params['sexe'] != 'homme' && $params['sexe'] != 'femme'){// Vérification de la validité du sexe
        return false;
    }
    return true;
}


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
elseif($_SERVER['REQUEST_METHOD'] === 'GET'){// Si la requête est de type GET
    //Chargement de la vue
    $loader = new FilesystemLoader('src/view');
    $twig = new Environment($loader);
    echo $twig->render("register.twig");
}
else{
    http_response_code(405);
}
