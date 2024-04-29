<?php

var_dump($_GET['slug']);

if (empty($_GET['slug'])) // S'il n'y pas de slug.
{
    require_once("src/controllers/home/default.php");
} else {
    $slug = explode("/", $_GET['slug']);
    $filePath = "src/controllers/" . implode("/", $slug) . ".php";
    require_once($filePath);
}