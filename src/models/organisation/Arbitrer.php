<?php

namespace models\organisation;

use models\BaseEntity;

class Arbitrer extends BaseEntity {
    protected $id_arbitrer;
    protected $id_arbitre_arbitrer;
    protected $id_match_arbitrer;

    // Constructeur
    public function __construct($id_arbitrer=null, $id_arbitre_arbitrer=null, $id_match_arbitrer=null) {
        $this->id_arbitrer = $id_arbitrer;
        $this->id_arbitre_arbitrer = $id_arbitre_arbitrer;
        $this->id_match_arbitrer = $id_match_arbitrer;
    }

    // Getters
    public function get_id_arbitrer() {
        return $this->id_arbitrer;
    }

    public function get_id_arbitre_arbitrer() {
        return $this->id_arbitre_arbitrer;
    }

    public function get_id_match_arbitrer() {
        return $this->id_match_arbitrer;
    }

    // Setters
    public function set_id_arbitrer($id_arbitrer) {
        $this->id_arbitrer = $id_arbitrer;
    }

    public function set_id_arbitre_arbitrer($id_arbitre_arbitrer) {
        $this->id_arbitre_arbitrer = $id_arbitre_arbitrer;
    }

    public function set_id_match_arbitrer($id_match_arbitrer) {
        $this->id_match_arbitrer = $id_match_arbitrer;
    }
}