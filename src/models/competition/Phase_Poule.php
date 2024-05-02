<?php

namespace models\competition;

use models\BaseEntity;

class Phase_Poule extends BaseEntity {
    protected $id_phase_poule;
    protected $id_evenement_phase_poule;
    protected $date_creation_poule;
    protected $id_arbre_phase_poule;

    // Constructeur
    public function __construct($id_phase_poule=null, $id_evenement_phase_poule=null, $date_creation_poule=null, $id_arbre_phase_poule=null) {
        $this->id_phase_poule = $id_phase_poule;
        $this->id_evenement_phase_poule = $id_evenement_phase_poule;
        $this->date_creation_poule = $date_creation_poule;
        $this->id_arbre_phase_poule = $id_arbre_phase_poule;
    }

    // Getters
    public function get_id_phase_poule() {
        return $this->id_phase_poule;
    }

    public function get_id_evenement_phase_poule() {
        return $this->id_evenement_phase_poule;
    }

    public function get_date_creation_poule() {
        return $this->date_creation_poule;
    }

    public function get_id_arbre_phase_poule() {
        return $this->id_arbre_phase_poule;
    }

    // Setters
    public function set_id_phase_poule($id_phase_poule) {
        $this->id_phase_poule = $id_phase_poule;
    }

    public function set_id_evenement_phase_poule($id_evenement_phase_poule) {
        $this->id_evenement_phase_poule = $id_evenement_phase_poule;
    }

    public function set_date_creation_poule($date_creation_poule) {
        $this->date_creation_poule = $date_creation_poule;
    }

    public function set_id_arbre_phase_poule($id_arbre_phase_poule) {
        $this->id_arbre_phase_poule = $id_arbre_phase_poule;
    }
}