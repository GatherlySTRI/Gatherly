<?php

namespace models\competition;

use models\BaseEntity;

class Phase_Arbre extends BaseEntity {
    protected $id_phase_arbre;
    protected $id_arbre_phase_arbre;
    protected $etape;

    const TYPE_PHASE_ARBRE = ['seizieme', 'huitieme', 'quart', 'demi', 'finale'];

    // Constructeur
    public function __construct($id_phase_arbre=null, $id_arbre_phase_arbre=null, $etape=null) {
        $this->id_phase_arbre = $id_phase_arbre;
        $this->id_arbre_phase_arbre = $id_arbre_phase_arbre;
        $this->set_etape($etape);
    }

    // Getters
    public function get_id_phase_arbre() {
        return $this->id_phase_arbre;
    }

    public function get_id_arbre_phase_arbre() {
        return $this->id_arbre_phase_arbre;
    }

    public function get_etape() {
        return $this->etape;
    }

    // Setters
    public function set_id_phase_arbre($id_phase_arbre) {
        $this->id_phase_arbre = $id_phase_arbre;
    }

    public function set_id_arbre_phase_arbre($id_arbre_phase_arbre) {
        $this->id_arbre_phase_arbre = $id_arbre_phase_arbre;
    }

    public function set_etape($etape) {
        if (!in_array($etape, self::TYPE_PHASE_ARBRE)) {
            throw new \InvalidArgumentException("Invalid type for etape");
        }
        $this->etape = $etape;
    }
}