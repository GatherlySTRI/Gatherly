<?php

use models\humain\Personne;

require_once('test/models/creation_JDD.php');

$personne = new Personne();
$personne->find($db, 10);
$personne->delete($db);

$evenement1->delete($db);
?>