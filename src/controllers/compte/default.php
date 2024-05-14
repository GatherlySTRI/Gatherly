<?php

require_once 'vendor/autoload.php';

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['id_utilisateur'])) {
    // L'utilisateur est connecté, rediriger vers la page d'accueil
    header('Location: /login');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] != 'GET') {
    http_response_code(405);
    exit;
}

use Twig\Loader\FilesystemLoader;
use Twig\Environment;
use models\organisation\Evenement;
use models\organisation\Organiser;
use models\BaseEntity;

$organiser = BaseEntity::find_all_by_column(null, 'Organiser', Organiser::class, 'id_organisateur', $_SESSION['id_utilisateur']);

var_dump($organiser[0]->getData());	
?>