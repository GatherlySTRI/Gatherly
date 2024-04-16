<?php

require_once 'vendor/autoload.php';

use models\humain\Personne;
use models\humain\Arbitre;

$db_host = getenv('DB_HOST');
$db_port = getenv('DB_PORT');
$db_name = getenv('DB_NAME');
$db_user = getenv('DB_USER');
$db_password = getenv('DB_PASSWORD');

try {

    // Instanciation connecteur BDD
    $db = new \PDO("pgsql:host=$db_host;port=$db_port;dbname=$db_name", $db_user, $db_password);

    $personne = new Personne(null, 'John', 'Doe', '2000-01-01', 'M');
    $personne->save($db);

    $arbitre = new Arbitre(null, 1);
    $arbitre->save($db);
    $arbitre_bd = new Arbitre();
    $arbitre_bd = $arbitre_bd->find($db, 1);
    $personne_arbitre = new Personne();
    $personne_arbitre = $personne_arbitre->find($db, $arbitre_bd->get_id_arbitre());
    echo $personne_arbitre->get_prenom_personne();

} catch (Exception $e) {
    echo "TEST FAILED: $e\n";
}

?>