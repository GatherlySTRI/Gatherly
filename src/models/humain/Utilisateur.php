<?php

namespace models\humain;

use models\BaseEntity;

class Utilisateur extends BaseEntity {
    protected $id_utilisateur;
    protected $id_personne_utilisateur;
    protected $mail;
    protected $telephone;
    protected $mdp;
    protected $est_admin;

    // Constructeur
    public function __construct($id_utilisateur = null, $id_personne_utilisateur = null, $mail = null, $telephone = null, $mdp = null, $est_admin = null) {
        $this->id_utilisateur = $id_utilisateur;
        $this->id_personne_utilisateur = $id_personne_utilisateur;
        $this->mail = $mail;
        $this->telephone = $telephone;
        $this->mdp = $mdp;
        $this->est_admin = $est_admin;
    }

    // Getters
    public function get_id_utilisateur() {
        return $this->id_utilisateur;
    }

    public function get_id_personne_utilisateur() {
        return $this->id_personne_utilisateur;
    }

    public function get_mail() {
        return $this->mail;
    }

    public function get_telephone() {
        return $this->telephone;
    }

    public function get_mdp() { #TODO: A modifier avec encyrption
        return $this->mdp;
    }

    public function get_est_admin() {
        return $this->est_admin;
    }

    // Setters
    public function set_id_utilisateur($id_utilisateur) {
        $this->id_utilisateur = $id_utilisateur;
    }

    public function set_id_personne_utilisateur($id_personne_utilisateur) {
        $this->id_personne_utilisateur = $id_personne_utilisateur;
    }

    public function set_mail($mail) {
        $this->mail = $mail;
    }

    public function set_telephone($telephone) {
        $this->telephone = $telephone;
    }

    public function set_mdp($mdp) { // TODO: A modifier avec encryption
        $this->mdp = $mdp;
    }

    public function set_est_admin($est_admin) {
        $this->est_admin = $est_admin;
    }
}
?>