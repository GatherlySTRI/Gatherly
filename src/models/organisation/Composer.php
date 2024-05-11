<?php

namespace models\organisation;

use models\BaseEntity;

class Composer extends BaseEntity {
    protected $id_composer;
    protected $id_membre_equipe_composer;
    protected $id_equipe_composer;

    // Constructeur
    public function __construct($id_composer=null, $id_membre_equipe_composer=null, $id_equipe_composer=null) {
        $this->id_composer = $id_composer;
        $this->id_membre_equipe_composer = $id_membre_equipe_composer;
        $this->id_equipe_composer = $id_equipe_composer;
    }

    // Getters
    public function get_id_composer() {
        return $this->id_composer;
    }

    public function get_id_membre_equipe_composer() {
        return $this->id_membre_equipe_composer;
    }

    public function get_id_equipe_composer() {
        return $this->id_equipe_composer;
    }

    // Setters
    public function set_id_composer($id_composer) {
        $this->id_composer = $id_composer;
    }

    public function set_id_membre_equipe_composer($id_membre_equipe_composer) {
        $this->id_membre_equipe_composer = $id_membre_equipe_composer;
    }

    public function set_id_equipe_composer($id_equipe_composer) {
        $this->id_equipe_composer = $id_equipe_composer;
    }
}