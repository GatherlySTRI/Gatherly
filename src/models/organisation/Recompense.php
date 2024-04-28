<?php

namespace models\organisation;

use models\BaseEntity;

class Recompense extends BaseEntity {
    protected $id_recompense;
    protected $nom_recompense;
    protected $categorie_recompense;

    // Constructeur
    public function __construct($id_recompense=null, $nom_recompense=null, $categorie_recompense=null) {
        $this->id_recompense = $id_recompense;
        $this->nom_recompense = $nom_recompense;
        $this->categorie_recompense = $categorie_recompense;
    }

    // Getters
    public function get_id_recompense() {
        return $this->id_recompense;
    }

    public function get_nom_recompense() {
        return $this->nom_recompense;
    }

    public function get_categorie_recompense() {
        return $this->categorie_recompense;
    }

    // Setters
    public function set_id_recompense($id_recompense) {
        $this->id_recompense = $id_recompense;
    }

    public function set_nom_recompense($nom_recompense) {
        $this->nom_recompense = $nom_recompense;
    }

    public function set_categorie_recompense($categorie_recompense) {
        $this->categorie_recompense = $categorie_recompense;
    }
}