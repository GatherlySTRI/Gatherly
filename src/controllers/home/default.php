<?php
require_once 'vendor/autoload.php';

$loader = new \Twig\Loader\FilesystemLoader('src/view');
$twig = new \Twig\Environment($loader);

echo $twig->render('home.html', ['var' => 'Twig fonctionne !']);