<?php

namespace models\competition;

use models\BaseEntity;

class Phase_A_R extends BaseEntity {
    protected $id_phase_a_r;
    protected $id_evenement_phase_A_R;
    protected $date_creation_A_R;
    protected $id_arbre_phase_A_R;

    // Constructeur
    public function __construct($id_phase_a_r=null, $id_evenement_phase_A_R=null, $date_creation_A_R=null, $id_arbre_phase_A_R=null) {
        $this->id_phase_a_r = $id_phase_a_r;
        $this->id_evenement_phase_A_R = $id_evenement_phase_A_R;
        $this->date_creation_A_R = $date_creation_A_R;
        $this->id_arbre_phase_A_R = $id_arbre_phase_A_R;
    }

    // Getters
    public function get_id_phase_a_r() {
        return $this->id_phase_a_r;
    }

    public function get_id_evenement_phase_A_R() {
        return $this->id_evenement_phase_A_R;
    }

    public function get_date_creation_A_R() {
        return $this->date_creation_A_R;
    }

    public function get_id_arbre_phase_A_R() {
        return $this->id_arbre_phase_A_R;
    }

    // Setters
    public function set_id_phase_a_r($id_phase_a_r) {
        $this->id_phase_a_r = $id_phase_a_r;
    }

    public function set_id_evenement_phase_A_R($id_evenement_phase_A_R) {
        $this->id_evenement_phase_A_R = $id_evenement_phase_A_R;
    }

    public function set_date_creation_A_R($date_creation_A_R) {
        $this->date_creation_A_R = $date_creation_A_R;
    }

    public function set_id_arbre_phase_A_R($id_arbre_phase_A_R) {
        $this->id_arbre_phase_A_R = $id_arbre_phase_A_R;
    }
}