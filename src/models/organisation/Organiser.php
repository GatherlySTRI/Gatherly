<?php

namespace models\organisation;

use models\BaseEntity;

class Organiser extends BaseEntity {
    protected $id_organiser;
    protected $id_organisateur;
    protected $id_evenement_organise;
    protected $date_creation;

    // Constructeur
    public function __construct($id_organiser = null, $id_organisateur = null, $id_evenement_organise = null, $date_creation = null) {
        $this->id_organiser = $id_organiser;
        $this->id_organisateur = $id_organisateur;
        $this->id_evenement_organise = $id_evenement_organise;
        $this->date_creation = $date_creation;
    }

    // Getters
    public function get_id_organiser() {
        return $this->id_organiser;
    }

    public function get_id_organisateur() {
        return $this->id_organisateur;
    }

    public function get_id_evenement_organise() {
        return $this->id_evenement_organise;
    }

    public function get_date_creation() {
        return $this->date_creation;
    }

    // Setters
    public function set_id_organiser($id_organiser){
        $this->id_organiser = $id_organiser;
    }

    public function set_id_organisateur($id_organisateur) {
        $this->id_organisateur = $id_organisateur;
    }

    public function set_id_evenement_organise($id_evenement_organise) {
        $this->id_evenement_organise = $id_evenement_organise;
    }

    public function set_date_creation($date_creation) {
        $this->date_creation = $date_creation;
    }
}

?>