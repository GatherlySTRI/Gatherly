<?php

namespace models\organisation;

use models\BaseEntity;

class Periode_Evenement extends BaseEntity {
    protected $id_periode_evenement;
    protected $id_evenement_periode;
    protected $date_debut;
    protected $date_fin;

    // Constructeur
    public function __construct($id_periode_evenement=null, $id_evenement_periode=null, $date_debut=null, $date_fin=null) {
        $this->id_periode_evenement = $id_periode_evenement;
        $this->id_evenement_periode = $id_evenement_periode;
        $this->date_debut = $date_debut;
        $this->date_fin = $date_fin;
    }

    // Getters
    public function get_id_periode_evenement() {
        return $this->id_periode_evenement;
    }

    public function get_id_evenement_periode() {
        return $this->id_evenement_periode;
    }

    public function get_date_debut() {
        return $this->date_debut;
    }

    public function get_date_fin() {
        return $this->date_fin;
    }

    // Setters
    public function set_id_periode_evenement($id_periode_evenement) {
        $this->id_periode_evenement = $id_periode_evenement;
    }

    public function set_id_evenement_periode($id_evenement_periode) {
        $this->id_evenement_periode = $id_evenement_periode;
    }

    public function set_date_debut($date_debut) {
        $this->date_debut = $date_debut;
    }

    public function set_date_fin($date_fin) {
        $this->date_fin = $date_fin;
    }
}