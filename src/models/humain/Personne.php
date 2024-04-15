<?php

namespace models\humain;

use models\BaseEntity;

class Personne extends BaseEntity {
    // Variables
    private $id_personne;
    private $prenom_personne;
    private $nom_personne;
    private $date_naissance;
    private $sexe;

    // Constructeur
    public function __construct($id_personne, $prenom_personne, $nom_personne, $date_naissance, $sexe) {
        $this->id_personne = $id_personne;
        $this->prenom_personne = $prenom_personne;
        $this->nom_personne = $nom_personne;
        $this->date_naissance = $date_naissance;
        $this->sexe = $sexe;
    }

    // Getters
    public function get_id_personne() {
        return $this->id_personne;
    }

    public function get_prenom_personne() {
        return $this->prenom_personne;
    }

    public function get_nom_personne() {
        return $this->nom_personne;
    }

    public function get_date_naissance() {
        return $this->date_naissance;
    }

    public function get_sexe() {
        return $this->sexe;
    }

    // Setters
    public function set_prenom_personne($prenom_personne) {
        $this->prenom_personne = $prenom_personne;
    }

    public function set_nom_personne($nom_personne) {
        $this->nomPersonne = $nomPersonne;
    }

    public function set_date_naissance($date_naissance) {
        $this->date_naissance = $date_naissance;
    }

    public function set_sexe($sexe) {
        $this->sexe = $sexe;
    }
}
?>