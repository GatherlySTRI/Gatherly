<?php
require_once 'vendor/autoload.php';


use models\humain\Personne;
use Twig\Loader\FilesystemLoader;
use Twig\Environment;

use tools\event_tools;

$loader = new FilesystemLoader('src/view');
$twig = new Environment($loader);

$events = event_tools::getAllEvents();


echo $twig->render('home.twig', ['events' => $events, 'is_session' => isset($_SESSION['id_utilisateur'])]);
