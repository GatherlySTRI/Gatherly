<?php

namespace models\organisation;

use models\BaseEntity;

class Sponsoriser extends BaseEntity {
    protected $id_sponsoriser;
    protected $id_sponsor_sponsoriser;
    protected $id_evenement_sponsoriser;

    // Constructeur
    public function __construct($id_sponsoriser=null, $id_sponsor_sponsoriser=null, $id_evenement_sponsoriser=null) {
        $this->id_sponsoriser = $id_sponsoriser;
        $this->id_sponsor_sponsoriser = $id_sponsor_sponsoriser;
        $this->id_evenement_sponsoriser = $id_evenement_sponsoriser;
    }

    // Getters
    public function get_id_sponsoriser() {
        return $this->id_sponsoriser;
    }

    public function get_id_sponsor_sponsoriser() {
        return $this->id_sponsor_sponsoriser;
    }

    public function get_id_evenement_sponsoriser() {
        return $this->id_evenement_sponsoriser;
    }

    // Setters
    public function set_id_sponsoriser($id_sponsoriser) {
        $this->id_sponsoriser = $id_sponsoriser;
    }

    public function set_id_sponsor_sponsoriser($id_sponsor_sponsoriser) {
        $this->id_sponsor_sponsoriser = $id_sponsor_sponsoriser;
    }

    public function set_id_evenement_sponsoriser($id_evenement_sponsoriser) {
        $this->id_evenement_sponsoriser = $id_evenement_sponsoriser;
    }
}