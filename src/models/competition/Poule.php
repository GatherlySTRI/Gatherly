<?php

namespace models\competition;

use models\BaseEntity;

class Poule extends BaseEntity {
    protected $id_poule;
    protected $id_phase_poule_poule;
    protected $nom_poule;
    protected $date_debut_poule;

    // Constructeur
    public function __construct($id_poule=null, $id_phase_poule_poule=null, $nom_poule=null, $date_debut_poule=null) {
        $this->id_poule = $id_poule;
        $this->id_phase_poule_poule = $id_phase_poule_poule;
        $this->nom_poule = $nom_poule;
        $this->date_debut_poule = $date_debut_poule;
    }

    // Getters
    public function get_id_poule() {
        return $this->id_poule;
    }

    public function get_id_phase_poule_poule() {
        return $this->id_phase_poule_poule;
    }

    public function get_nom_poule() {
        return $this->nom_poule;
    }

    public function get_date_debut_poule() {
        return $this->date_debut_poule;
    }

    // Setters
    public function set_id_poule($id_poule) {
        $this->id_poule = $id_poule;
    }

    public function set_id_phase_poule_poule($id_phase_poule_poule) {
        $this->id_phase_poule_poule = $id_phase_poule_poule;
    }

    public function set_nom_poule($nom_poule) {
        $this->nom_poule = $nom_poule;
    }

    public function set_date_debut_poule($date_debut_poule) {
        $this->date_debut_poule = $date_debut_poule;
    }
}