<?php

namespace models\organisation;

use models\BaseEntity;

class Couvrir extends BaseEntity {
    protected $id_couvrir;
    protected $id_media_couvrir;
    protected $id_evenement_couvrir;

    // Constructeur
    public function __construct($id_couvrir=null, $id_media_couvrir=null, $id_evenement_couvrir=null) {
        $this->id_couvrir = $id_couvrir;
        $this->id_media_couvrir = $id_media_couvrir;
        $this->id_evenement_couvrir = $id_evenement_couvrir;
    }

    // Getters
    public function get_id_couvrir() {
        return $this->id_couvrir;
    }

    public function get_id_media_couvrir() {
        return $this->id_media_couvrir;
    }

    public function get_id_evenement_couvrir() {
        return $this->id_evenement_couvrir;
    }

    // Setters
    public function set_id_couvrir($id_couvrir) {
        $this->id_couvrir = $id_couvrir;
    }

    public function set_id_media_couvrir($id_media_couvrir) {
        $this->id_media_couvrir = $id_media_couvrir;
    }

    public function set_id_evenement_couvrir($id_evenement_couvrir) {
        $this->id_evenement_couvrir = $id_evenement_couvrir;
    }
}