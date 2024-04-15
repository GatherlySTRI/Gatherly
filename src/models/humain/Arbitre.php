<?php

namespace models\humain;

use models\BaseEntity;

class Arbitre extends BaseEntity {
    private $id_arbitre;
    private $id_personne_arbitre;

    // Constructeur
    public function __construct($id_arbitre, $id_personne_arbitre) {
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
}

?>