<?php

use models\organisation\Evenement;
use models\organisation\Organiser;
use models\humain\Utilisateur;

function verify_all_params($params)
{ // Vérification de la présence et validité des paramètres
    $required_params = ['nom', 'description', 'type', 'categorie', 'variante', 'date_debut', 'date_fin'];
    foreach ($required_params as $param) {
        if (!array_key_exists($param, $params) || $params[$param] == "") {
            return false;
        }
    }
    if ($params['variante'] != '15' && $params['variante'] != '13' && $params['variante'] != '7') {
        return false;
    }
    if ($params['type'] != 'contact' && $params['type'] != 'touche') {
        return false;
    }
    if ($params['date_debut'] > $params['date_fin']) {
        return false;
    }
    return true;
}

function verify_right($id_evenement, $id_utilisateur){
    $evenement = new Evenement();
    $evenement->find(null, $id_evenement);
    $organiser = new Organiser();
    $organiser->find_by_column(null, 'id_evenement_organise', $id_evenement);
    $utilisateur = new Utilisateur();
    $utilisateur->find(null, $id_utilisateur);

    return ($organiser->get_id_organisateur() == $_SESSION['id_utilisateur'] || $utilisateur->get_est_admin()); // Vérification que l'évènement appartient bien à l'utilisateur ou si l'utilisateur est admin

}

function verify_exist_event($id_evenement){
    $evenement = new Evenement();
    $evenement->find(null, $id_evenement);
    return ($evenement->get_id_evenement() != null); // Vérification que l'évenement existe
}

function get_type_evenement($id_evenement){
    $evenement = new Evenement();
    $evenement->find(null, $id_evenement);
    return $evenement->get_categorie_evenement(); // Récupération du type de l'évènement
}