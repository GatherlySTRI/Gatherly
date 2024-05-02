<?php

namespace models\competition;

use models\BaseEntity;

class Arbre extends BaseEntity {
    protected $id_arbre;
    protected $id_evenement_arbre;
    protected $date_creation_arbre;

    // Constructeur
    public function __construct($id_arbre=null, $id_evenement_arbre=null, $date_creation_arbre=null) {
        $this->id_arbre = $id_arbre;
        $this->id_evenement_arbre = $id_evenement_arbre;
        $this->date_creation_arbre = $date_creation_arbre;
    }

    // Getters
    public function get_id_arbre() {
        return $this->id_arbre;
    }

    public function get_id_evenement_arbre() {
        return $this->id_evenement_arbre;
    }

    public function get_date_creation_arbre() {
        return $this->date_creation_arbre;
    }

    // Setters
    public function set_id_arbre($id_arbre) {
        $this->id_arbre = $id_arbre;
    }

    public function set_id_evenement_arbre($id_evenement_arbre) {
        $this->id_evenement_arbre = $id_evenement_arbre;
    }

    public function set_date_creation_arbre($date_creation_arbre) {
        $this->date_creation_arbre = $date_creation_arbre;
    }
}