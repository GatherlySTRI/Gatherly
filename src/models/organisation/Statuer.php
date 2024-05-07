<?php

namespace models\organisation;

use models\BaseEntity;

class Statuer extends BaseEntity {
    protected $id_statuer;
    protected $id_etat;
    protected $id_utilisateur_etat;
    protected $date_statut;

    // Constructeur
    public function __construct($id_statuer=null, $id_etat=null, $id_utilisateur_etat=null, $date_statut=null) {
        $this->id_statuer = $id_statuer;
        $this->id_etat = $id_etat;
        $this->id_utilisateur_etat = $id_utilisateur_etat;
        $this->date_statut = $date_statut;
    }

    // Getters
    public function get_id_statuer() {
        return $this->id_statuer;
    }

    public function get_id_etat() {
        return $this->id_etat;
    }

    public function get_id_utilisateur_etat() {
        return $this->id_utilisateur_etat;
    }

    public function get_date_statut() {
        return $this->date_statut;
    }

    // Setters
    public function set_id_statuer($id_statuer) {
        $this->id_statuer = $id_statuer;
    }

    public function set_id_etat($id_etat) {
        $this->id_etat = $id_etat;
    }

    public function set_id_utilisateur_etat($id_utilisateur_etat) {
        $this->id_utilisateur_etat = $id_utilisateur_etat;
    }

    public function set_date_statut($date_statut) {
        $this->date_statut = $date_statut;
    }
}