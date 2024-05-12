<?php

// ini_set('display_errors', '0');
error_reporting(E_ALL & ~E_DEPRECATED);

session_start();

if (empty($_GET['slug'])) // S'il n'y pas de slug.
{
    require_once("src/controllers/home/default.php");
} else {
    $slug = explode("/", $_GET['slug']);
    $filePath = "src/controllers/" . implode("/", $slug) . ".php";
    if (file_exists($filePath)) { //Si la page n'existe pas --> 404
        require_once($filePath);
    } elseif (file_exists("src/controllers/" . $slug[0] . "/default.php")) {
        require_once("src/controllers/" . $slug[0] . "/default.php");
    } else {
        require_once("src/controllers/404.php");
    }
}
