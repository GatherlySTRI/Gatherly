<?php

namespace models\competition;

use models\BaseEntity;

class Poule_Contient extends BaseEntity {
    protected $id_poule_contient;
    protected $id_poule_poule_contient;
    protected $id_match_rugby_poule_contient;

    // Constructeur
    public function __construct($id_poule_contient=null, $id_poule_poule_contient=null, $id_match_rugby_poule_contient=null) {
        $this->id_poule_contient = $id_poule_contient;
        $this->id_poule_poule_contient = $id_poule_poule_contient;
        $this->id_match_rugby_poule_contient = $id_match_rugby_poule_contient;
    }

    // Getters
    public function get_id_poule_contient() {
        return $this->id_poule_contient;
    }

    public function get_id_poule_poule_contient() {
        return $this->id_poule_poule_contient;
    }

    public function get_id_match_rugby_poule_contient() {
        return $this->id_match_rugby_poule_contient;
    }

    // Setters
    public function set_id_poule_contient($id_poule_contient) {
        $this->id_poule_contient = $id_poule_contient;
    }

    public function set_id_poule_poule_contient($id_poule_poule_contient) {
        $this->id_poule_poule_contient = $id_poule_poule_contient;
    }

    public function set_id_match_rugby_poule_contient($id_match_rugby_poule_contient) {
        $this->id_match_rugby_poule_contient = $id_match_rugby_poule_contient;
    }
}