<?php
require_once 'vendor/autoload.php';

// Vérifier si l'utilisateur est connecté
if (isset($_SESSION['id_utilisateur'])) { // Si l'utilisateur est connecté
    // Redirection vers la page d'accueil
    ob_start(); // Start output buffering
    header('Location: /');
    ob_end_flush(); // End output buffering and flush the buffer
    exit;
}

use models\humain\Utilisateur;
use models\humain\Personne;
use Twig\Loader\FilesystemLoader;
use Twig\Environment;

$loader = new FilesystemLoader('src/view');
$twig = new Environment($loader);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $utilisateur = new Utilisateur();
    $utilisateur->find_by_column(null, 'mail', $_POST['mail']);
    if ($utilisateur->get_id_utilisateur() == null || password_verify($_POST['mdp'], $utilisateur->get_mdp())  == false) {
        echo $twig->render("login.twig", ['error' => 'Email ou mot de passe incorrect', 'session' => $_SESSION]);
        exit;
    } elseif ($utilisateur->get_id_utilisateur() != null && password_verify($_POST['mdp'], $utilisateur->get_mdp())) {
        session_destroy();
        session_start();
        $_SESSION['id_utilisateur'] = $utilisateur->get_id_utilisateur();
        $_SESSION['est_Admin'] = $utilisateur->get_est_admin();
        $personne = new Personne();
        $personne->find(null, $utilisateur->get_id_personne_utilisateur());
        $_SESSION['prenom'] = $personne->get_prenom_personne();
        header('Location: /');
        exit;
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
    echo $twig->render("login.twig", ['session' => $_SESSION]);
} else {
    http_response_code(405);
    exit;
}
