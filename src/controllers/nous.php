<?php
require_once 'vendor/autoload.php';
use Twig\Loader\FilesystemLoader;
use Twig\Environment;

$loader = new FilesystemLoader('src/view');
$twig = new Environment($loader);
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    echo $twig->render("nous.twig", ['is_session' => isset($_SESSION['id_utilisateur'])]);
}
else {
    http_response_code(405);
    exit;
}