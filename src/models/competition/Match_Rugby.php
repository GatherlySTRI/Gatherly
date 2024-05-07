<?php

namespace models\competition;

use models\BaseEntity;

class Match_Rugby extends BaseEntity {
    protected $id_match_rugby;
    protected $id_adresse_API;
    protected $date_match_rugby;
    protected $heure_match_rugby;

    // Constructeur
    public function __construct($id_match_rugby=null, $id_adresse_API=null, $date_match_rugby=null, $heure_match_rugby=null) {
        $this->id_match_rugby = $id_match_rugby;
        $this->id_adresse_API = $id_adresse_API;
        $this->date_match_rugby = $date_match_rugby;
        $this->heure_match_rugby = $heure_match_rugby;
    }

    // Getters
    public function get_id_match_rugby() {
        return $this->id_match_rugby;
    }

    public function get_id_adresse_API() {
        return $this->id_adresse_API;
    }

    public function get_date_match_rugby() {
        return $this->date_match_rugby;
    }

    public function get_heure_match_rugby() {
        return $this->heure_match_rugby;
    }

    // Setters
    public function set_id_match_rugby($id_match_rugby) {
        $this->id_match_rugby = $id_match_rugby;
    }

    public function set_id_adresse_API($id_adresse_API) {
        $this->id_adresse_API = $id_adresse_API;
    }

    public function set_date_match_rugby($date_match_rugby) {
        $this->date_match_rugby = $date_match_rugby;
    }

    public function set_heure_match_rugby($heure_match_rugby) {
        $this->heure_match_rugby = $heure_match_rugby;
    }
}