<?php


if (empty($_GET['slug'])) //S'il n'y pas de slug.
{
    require_once("controllers/home.php");
    
} elseif (strpos($_GET['slug'], "/") !== false) { //Si le slug contient un slash.
    $slug = explode("/", $_GET['slug']);
    $slug0 = $slug[0];
    $slug1 = $slug[1];

    //TODO: acceder au controlleur

} else { //S'il n'y a pas de slash.
    $slug = $_GET['slug'];

    //TODO: acceder au controlleur
    echo "ICI : $slug";
    $controller = "controllers/".$slug."php";
    echo "ICI : $controller";
    require_once($controller);
}