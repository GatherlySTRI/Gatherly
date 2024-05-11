<?php

require_once 'vendor/autoload.php';

use models\humain\Utilisateur;
use models\humain\Personne;


// $db_host = getenv('DB_HOST');
// $db_port = getenv('DB_PORT');
// $db_name = getenv('DB_NAME');
// $db_user = getenv('DB_USER');
// $db_password = getenv('DB_PASSWORD');
// $db = new \PDO("pgsql:host=$db_host;port=$db_port;dbname=$db_name", $db_user, $db_password);

$personne = new Personne();
$db = $personne->find($db, 100);

$personne->set_nom_personne('Joe_bis');
$personne->set_prenom_personne('Doe_bis');
$db = $personne->edit($db);

$p = new Personne();
$p->find($db, $db->lastInsertId());
var_dump($p);

?>