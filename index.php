<?php

// ini_set('display_errors', '0');

session_start();

if (empty($_GET['slug'])) // S'il n'y pas de slug.
{
    require_once("src/controllers/home/default.php");
} else {
    $slug = explode("/", $_GET['slug']);
    $filePath = "src/controllers/" . implode("/", $slug) . ".php";
    require_once($filePath);
}
