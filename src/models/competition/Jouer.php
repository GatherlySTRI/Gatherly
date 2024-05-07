<?php

namespace models\competition;

use models\BaseEntity;

class Jouer extends BaseEntity {
    protected $id_jouer;
    protected $id_match_rugby_jouer;
    protected $id_equipe_jouer;

    // Constructeur
    public function __construct($id_jouer=null, $id_match_rugby_jouer=null, $id_equipe_jouer=null) {
        $this->id_jouer = $id_jouer;
        $this->id_match_rugby_jouer = $id_match_rugby_jouer;
        $this->id_equipe_jouer = $id_equipe_jouer;
    }

    // Getters
    public function get_id_jouer() {
        return $this->id_jouer;
    }

    public function get_id_match_rugby_jouer() {
        return $this->id_match_rugby_jouer;
    }

    public function get_id_equipe_jouer() {
        return $this->id_equipe_jouer;
    }

    // Setters
    public function set_id_jouer($id_jouer) {
        $this->id_jouer = $id_jouer;
    }

    public function set_id_match_rugby_jouer($id_match_rugby_jouer) {
        $this->id_match_rugby_jouer = $id_match_rugby_jouer;
    }

    public function set_id_equipe_jouer($id_equipe_jouer) {
        $this->id_equipe_jouer = $id_equipe_jouer;
    }
}