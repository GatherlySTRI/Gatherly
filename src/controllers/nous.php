<?php
require_once 'vendor/autoload.php';

use Twig\Loader\FilesystemLoader;
use Twig\Environment;

$loader = new FilesystemLoader('src/view');
$twig = new Environment($loader);
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    echo $twig->render("nous.twig", ['session' => $_SESSION]);
} else {
    http_response_code(405);
    exit;
}
