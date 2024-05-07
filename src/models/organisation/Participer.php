<?php

namespace models\organisation;

use models\BaseEntity;

class Participer extends BaseEntity {
    protected $id_participer;
    protected $id_participant;
    protected $id_evenement_participe;
    protected $date_inscription;

    // Constructeur
    public function __construct($id_participer = null, $id_participant = null, $id_evenement_participe = null, $date_inscription = null) {
        $this->id_participer = $id_participer;
        $this->id_participant = $id_participant;
        $this->id_evenement_participe = $id_evenement_participe;
        $this->date_inscription = $date_inscription;
    }

    // Getters
    public function get_id_participer(){
        return $this->id_participer;
    }

    public function get_id_participant() {
        return $this->id_participant;
    }

    public function get_id_evenement_participe() {
        return $this->id_evenement_participe;
    }

    public function get_date_inscription() {
        return $this->date_inscription;
    }

    // Setters
    public function set_id_participer($id_participer){
        $this->id_participer = $id_participer;
    }

    public function set_id_participant($id_participant) {
        $this->id_participant = $id_participant;
    }

    public function set_id_evenement_participe($id_evenement_participe) {
        $this->id_evenement_participe = $id_evenement_participe;
    }

    public function set_date_inscription($date_inscription) {
        $this->date_inscription = $date_inscription;
    }
}

?>