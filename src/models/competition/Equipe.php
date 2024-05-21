<?php

namespace models\competition;

use models\BaseEntity;

class Equipe extends BaseEntity {
    protected $id_equipe;
    protected $nom_equipe;
    protected $id_utilisateur_equipe;

    // Constructeur
    public function __construct($id_equipe=null, $nom_equipe=null, $id_utilisateur_equipe=null) {
        $this->id_equipe = $id_equipe;
        $this->nom_equipe = $nom_equipe;
        $this->id_utilisateur_equipe = $id_utilisateur_equipe;
    }

    // Getters
    public function get_id_equipe() {
        return $this->id_equipe;
    }

    public function get_nom_equipe() {
        return $this->nom_equipe;
    }

    public function get_id_utilisateur_equipe() {
        return $this->id_utilisateur_equipe;
    }

    // Setters
    public function set_id_equipe($id_equipe) {
        $this->id_equipe = $id_equipe;
    }

    public function set_nom_equipe($nom_equipe) {
        $this->nom_equipe = $nom_equipe;
    }

    public function set_id_utilisateur_equipe($id_utilisateur_equipe) {
        $this->id_utilisateur_equipe = $id_utilisateur_equipe;
    }
}