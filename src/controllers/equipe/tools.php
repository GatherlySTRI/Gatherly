<?php

function verify_params_equipe($params)
{ // Vérification de la présence et validité des paramètres
    $required_params = ['nom_equipe'];
    foreach ($required_params as $param) {
        if (!array_key_exists($param, $params) || $params[$param] == "") {
            return false;
        }
    }
    return true;
}