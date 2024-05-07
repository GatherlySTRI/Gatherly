<?php

namespace models\competition;

use models\BaseEntity;

class Etape_Contient extends BaseEntity {
    protected $id_etape_contient;
    protected $id_phase_arbre_etape;
    protected $id_match_rugby_etape;

    // Constructeur
    public function __construct($id_etape_contient=null, $id_phase_arbre_etape=null, $id_match_rugby_etape=null) {
        $this->id_etape_contient = $id_etape_contient;
        $this->id_phase_arbre_etape = $id_phase_arbre_etape;
        $this->id_match_rugby_etape = $id_match_rugby_etape;
    }

    // Getters
    public function get_id_etape_contient() {
        return $this->id_etape_contient;
    }

    public function get_id_phase_arbre_etape() {
        return $this->id_phase_arbre_etape;
    }

    public function get_id_match_rugby_etape() {
        return $this->id_match_rugby_etape;
    }

    // Setters
    public function set_id_etape_contient($id_etape_contient) {
        $this->id_etape_contient = $id_etape_contient;
    }

    public function set_id_phase_arbre_etape($id_phase_arbre_etape) {
        $this->id_phase_arbre_etape = $id_phase_arbre_etape;
    }

    public function set_id_match_rugby_etape($id_match_rugby_etape) {
        $this->id_match_rugby_etape = $id_match_rugby_etape;
    }
}