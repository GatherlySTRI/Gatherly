<?php

namespace models\organisation;

use models\BaseEntity;

class Acheter extends BaseEntity {
    protected $id_achat;
    protected $date_achat;
    protected $id_utilisateur_achat;
    protected $id_billet_achat;

    // Constructeur
    public function __construct($id_achat = null, $date_achat= null ,$id_utilisateur_achat = null, $id_billet_achat = null) {
        $this->id_achat = $id_achat;
        $this->date_achat = $date_achat;
        $this->id_utilisateur_achat = $id_utilisateur_achat;
        $this->id_billet_achat = $id_billet_achat;
    }

    // Getters
    public function get_id_achat() {
        return $this->id_achat;
    }

    public function get_date_achat() {
        return $this->date_achat;
    }

    public function get_id_utilisateur_achat() {
        return $this->id_utilisateur_achat;
    }

    public function get_id_billet_achat() {
        return $this->id_billet_achat;
    }

    // Setters
    public function set_id_achat($id_achat) {
        $this->id_achat = $id_achat;
    }

    public function set_date_achat($date_achat) {
        $this->date_achat = $date_achat;
    }

    public function set_id_utilisateur_achat($id_utilisateur_achat) {
        $this->id_utilisateur_achat = $id_utilisateur_achat;
    }

    public function set_id_billet_achat($id_billet_achat) {
        $this->id_billet_achat = $id_billet_achat;
    }
}
?>