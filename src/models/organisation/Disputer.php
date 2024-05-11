<?php

namespace models\organisation;

use models\BaseEntity;

class Disputer extends BaseEntity {
    protected $id_disputer;
    protected $id_match_disputer;
    protected $id_evenement_disputer;

    // Constructeur
    public function __construct($id_disputer=null, $id_match_disputer=null, $id_evenement_disputer=null) {
        $this->id_disputer = $id_disputer;
        $this->id_match_disputer = $id_match_disputer;
        $this->id_evenement_disputer = $id_evenement_disputer;
    }

    // Getters
    public function get_id_disputer() {
        return $this->id_disputer;
    }

    public function get_id_match_disputer() {
        return $this->id_match_disputer;
    }

    public function get_id_evenement_disputer() {
        return $this->id_evenement_disputer;
    }

    // Setters
    public function set_id_disputer($id_disputer) {
        $this->id_disputer = $id_disputer;
    }

    public function set_id_match_disputer($id_match_disputer) {
        $this->id_match_disputer = $id_match_disputer;
    }

    public function set_id_evenement_disputer($id_evenement_disputer) {
        $this->id_evenement_disputer = $id_evenement_disputer;
    }
}