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
    if ($utilisateur->get_id_utilisateur() == null || $utilisateur->get_mdp() != md5($_POST['mdp'])) {
        echo $twig->render("login.twig", ['error' => 'Email ou mot de passe incorrect', 'is_session' => isset($_SESSION['id_utilisateur'])]);
        exit;
    } elseif ($utilisateur->get_id_utilisateur() != null && $utilisateur->get_mdp() == md5($_POST['mdp'])) {
        session_destroy();
        session_start();
        $_SESSION['id_utilisateur'] = $utilisateur->get_id_utilisateur();
        $personne = new Personne();
        $personne->find(null, $utilisateur->get_id_personne_utilisateur());
        $_SESSION['prenom'] = $personne->get_prenom_personne();
        header('Location: /');
        exit;
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
    echo $twig->render("login.twig", ['is_session' => isset($_SESSION['id_utilisateur'])]);
} else {
    http_response_code(405);
    exit;
}
