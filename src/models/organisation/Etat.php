<?php

namespace models\organisation;

use models\BaseEntity;

class Etat extends BaseEntity {
    protected $id_etat;
    protected $id_evenement;
    protected $est_archive;
    protected $est_approuve;

    // Constructeur
    public function __construct($id_etat=null, $id_evenement=null, $est_archive=null, $est_approuve=null) {
        $this->id_etat = $id_etat;
        $this->id_evenement = $id_evenement;
        $this->est_archive = $est_archive;
        $this->est_approuve = $est_approuve;
    }

    // Getters
    public function get_id_etat() {
        return $this->id_etat;
    }

    public function get_id_evenement() {
        return $this->id_evenement;
    }

    public function get_est_archive() {
        return $this->est_archive;
    }

    public function get_est_approuve() {
        return $this->est_approuve;
    }

    // Setters
    public function set_id_etat($id_etat) {
        $this->id_etat = $id_etat;
    }

    public function set_id_evenement($id_evenement) {
        $this->id_evenement = $id_evenement;
    }

    public function set_est_archive($est_archive) {
        $this->est_archive = $est_archive;
    }

    public function set_est_approuve($est_approuve) {
        $this->est_approuve = $est_approuve;
    }
}