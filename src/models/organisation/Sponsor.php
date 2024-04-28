<?php

namespace models\organisation;

use models\BaseEntity;

class Sponsor extends BaseEntity {
    protected $id_sponsor;
    protected $nom_sponsor;
    protected $email_sponsor;
    protected $telephone_sponsor;

    // Constructeur
    public function __construct($id_sponsor=null, $nom_sponsor=null, $email_sponsor=null, $telephone_sponsor=null) {
        $this->id_sponsor = $id_sponsor;
        $this->nom_sponsor = $nom_sponsor;
        $this->email_sponsor = $email_sponsor;
        $this->telephone_sponsor = $telephone_sponsor;
    }

    // Getters
    public function get_id_sponsor() {
        return $this->id_sponsor;
    }

    public function get_nom_sponsor() {
        return $this->nom_sponsor;
    }

    public function get_email_sponsor() {
        return $this->email_sponsor;
    }

    public function get_telephone_sponsor() {
        return $this->telephone_sponsor;
    }

    // Setters
    public function set_id_sponsor($id_sponsor) {
        $this->id_sponsor = $id_sponsor;
    }

    public function set_nom_sponsor($nom_sponsor) {
        $this->nom_sponsor = $nom_sponsor;
    }

    public function set_email_sponsor($email_sponsor) {
        $this->email_sponsor = $email_sponsor;
    }

    public function set_telephone_sponsor($telephone_sponsor) {
        $this->telephone_sponsor = $telephone_sponsor;
    }
}