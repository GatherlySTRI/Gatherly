<?php
require_once 'vendor/autoload.php';

session_start();

use models\humain\Personne;
use Twig\Loader\FilesystemLoader;
use Twig\Environment;

$loader = new FilesystemLoader('src/view');
$twig = new Environment($loader);

echo $twig->render('home.twig', ['is_session' => isset($_SESSION['id_utilisateur'])]);