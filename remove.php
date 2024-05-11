<?php

require_once 'vendor/autoload.php';

use models\organisation\Evenement;
use models\humain\Personne;


// $db_host = getenv('DB_HOST');
// $db_port = getenv('DB_PORT');
// $db_name = getenv('DB_NAME');
// $db_user = getenv('DB_USER');
// $db_password = getenv('DB_PASSWORD');
// $db = new \PDO("pgsql:host=$db_host;port=$db_port;dbname=$db_name", $db_user, $db_password);

$evenement = new Evenement();
$evenement->find(null, 5);

var_dump($evenement);
$evenement->delete();
?>