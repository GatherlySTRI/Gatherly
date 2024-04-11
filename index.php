<?php


if (empty($_GET['slug'])) //S'il n'y pas de slug.
{
    require_once("controllers/home/default.php");
    
} elseif (strpos($_GET['slug'], "/") !== false) { //Si le slug contient un slash.
    $slug = explode("/", $_GET['slug']);
    $slug0 = $slug[0];
    $slug1 = $slug[1];

    if (empty($slug1))
    {
        require_once("controllers/$slug0/default.php");
    } else {
        require_once("controllers/$slug0/$slug1.php");
    }

} else { //S'il n'y a pas de slash.
    $slug = trim($_GET['slug']);

    require_once("controllers/$slug/default.php");
}