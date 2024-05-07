<?php

namespace models\humain;

use models\BaseEntity;

class Arbitre extends BaseEntity {
    protected $id_arbitre;
    protected $id_personne_arbitre;

    // Constructeur
    public function __construct($id_arbitre=null, $id_personne_arbitre=null) {
        $this->id_arbitre = $id_arbitre;
        $this->id_personne_arbitre = $id_personne_arbitre;
    }

    // Getters
    public function get_id_arbitre() {
        return $this->id_arbitre;
    }

    public function get_id_personne_arbitre() {
        return $this->id_personne_arbitre;
    }

    // Setters
    public function set_id_arbitre($id_arbitre) {
        $this->id_arbitre = $id_arbitre;
    }

    public function set_id_personne_arbitre($id_personne_arbitre) {
        $this->id_personne_arbitre = $id_personne_arbitre;
    }
}

?>