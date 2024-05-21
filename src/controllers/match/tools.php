<?php

use models\competition\Match_Rugby;
use models\competition\Equipe;

function verify_params_match($params)
{ // Vérification de la présence et validité des paramètres
    $required_params = ['address_id', 'date_debut', 'heure', 'equipe1', 'equipe2'];
    foreach ($required_params as $param) {
        if (!array_key_exists($param, $params) || $params[$param] == "") {
            return false;
        }
    }
    $equipe1 = new Equipe();
    $equipe1->find(null, $params['equipe1']);
    if ($equipe1->get_id_equipe() == null) {
        return false;
    }
    $equipe2 = new Equipe();
    $equipe2->find(null, $params['equipe2']);
    if ($equipe2->get_id_equipe() == null) {
        return false;
    }
    return true;
}

function verify_exist_match($id_match)
{ // Vérification de l'existence du match
    $match = new Match_Rugby();
    $match->find(null, $id_match);
    if ($match->get_id_match_rugby() == null) {
        return false;
    }
    return true;
}