<?php

namespace models\organisation;

use models\BaseEntity;

class Acceder extends BaseEntity {
    protected $id_acceder;
    protected $id_billet_acceder;
    protected $id_match_rugby_acceder;

    // Constructeur
    public function __construct($id_acceder=null, $id_billet_acceder=null, $id_match_rugby_acceder=null) {
        $this->id_acceder = $id_acceder;
        $this->id_billet_acceder = $id_billet_acceder;
        $this->id_match_rugby_acceder = $id_match_rugby_acceder;
    }

    // Getters
    public function get_id_acceder() {
        return $this->id_acceder;
    }

    public function get_id_billet_acceder() {
        return $this->id_billet_acceder;
    }

    public function get_id_match_rugby_acceder() {
        return $this->id_match_rugby_acceder;
    }

    // Setters
    public function set_id_acceder($id_acceder) {
        $this->id_acceder = $id_acceder;
    }

    public function set_id_billet_acceder($id_billet_acceder) {
        $this->id_billet_acceder = $id_billet_acceder;
    }

    public function set_id_match_rugby_acceder($id_match_rugby_acceder) {
        $this->id_match_rugby_acceder = $id_match_rugby_acceder;
    }
}