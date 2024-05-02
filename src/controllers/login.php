<?php
require_once 'vendor/autoload.php';

use models\humain\Personne;
use models\humain\Utilisateur;
use Twig\Loader\FilesystemLoader;
use Twig\Environment;

$loader = new FilesystemLoader('src/view');
$twig = new Environment($loader);

echo $twig->render("login.twig");