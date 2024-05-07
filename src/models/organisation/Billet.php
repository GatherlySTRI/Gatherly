<?php

namespace models\organisation;

use models\BaseEntity;

class Billet extends BaseEntity {
    protected $id_billet;
    protected $prix;
    protected $description_billet;
    protected $categorie_billet;
    protected $est_gratuit;

    // Constructeur
    public function __construct($id_billet = null, $prix = null, $description_billet = null, $categorie_billet = null, $est_gratuit = false) {
        $this->id_billet = $id_billet;
        $this->prix = $prix;
        $this->description_billet = $description_billet;
        $this->categorie_billet = $categorie_billet;
        $this->est_gratuit = $est_gratuit;
    }

    // Getters
    public function get_id_billet() {
        return $this->id_billet;
    }

    public function get_prix() {
        return $this->prix;
    }

    public function get_description_billet() {
        return $this->description_billet;
    }

    public function get_categorie_billet() {
        return $this->categorie_billet;
    }

    public function get_est_gratuit() {
        return $this->est_gratuit;
    }

    // Setters
    public function set_prix($prix) {
        $this->prix = $prix;
    }

    public function set_description_billet($description_billet) {
        $this->description_billet = $description_billet;
    }

    public function set_categorie_billet($categorie_billet) {
        $this->categorie_billet = $categorie_billet;
    }

    public function set_est_gratuit($est_gratuit) {
        $this->est_gratuit = $est_gratuit;
    }
}

?>