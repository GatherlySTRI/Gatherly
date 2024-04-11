<?php


if (empty($_GET['slug'])) //S'il n'y pas de slug.
{
    //TODO: acceder au controlleur de la page d'accueil

    require_once("controllers/home.php");
    echo "1";
    
} elseif (strpos($_GET['slug'], "/") !== false) { //Si le slug contient un slash.
    $slug = explode("/", $_GET['slug']);
    $slug0 = $slug[0];
    $slug1 = $slug[1];

    //TODO: acceder au controlleur
    echo "2";

} else { //S'il n'y a pas de slash.
    $slug = $_GET['slug'];

    //TODO: acceder au controlleur

    require_once("controllers/$slug.php");

    echo "3";
}