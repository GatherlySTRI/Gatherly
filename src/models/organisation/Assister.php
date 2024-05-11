<?php

namespace models\organisation;

use models\BaseEntity;

class Assister extends BaseEntity{
    protected $id_assister;
    protected $id_spectateur;
    protected $id_evenement_assister;
    protected $date_achat;

    public function __construct($id_assister = null, $id_spectateur = null, $id_evenement_assister = null, $date_achat) {
        $this->id_assister = $id_assister;
        $this->id_spectateur = $id_spectateur;
        $this->id_evenement_assister = $id_evenement_assister;
        $this->date_achat = $date_achat;
    }

    // Getters 
    public function get_id_spectateur() {
        return $this->id_spectateur;
    }

    public function get_id_evenement_assister() {
        return $this->id_evenement_assiste;
    }

    public function get_date_achat() {
        return $this->date_achat;
    }

    // Setters
    public function set_id_spectateur($id_spectateur) {
        $this->id_spectateur = $id_spectateur;
    }

    public function set_id_evenement_assister($id_evenement_assiste) {
        $this->id_evenement_assiste = $id_evenement_assiste;
    }
    
    public function set_date_achat($date_achat) {
        $this->date_achat = $date_achat;
    }

}
?>