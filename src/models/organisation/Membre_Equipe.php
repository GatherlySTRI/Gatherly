<?php

namespace models\organisation;

use models\BaseEntity;

class Membre_Equipe extends BaseEntity {
    protected $id_membre;
    protected $id_personne_membre;
    protected $role_membre;
    protected $poste;

    // Constructeur
    public function __construct($id_membre = null, $id_personne_membre = null, $role_membre = null, $poste = null) {
        $this->id_membre = $id_membre;
        $this->id_personne_membre = $id_personne_membre;
        $this->role_membre = $role_membre;
        $this->poste = $poste;
    }

    // Getters
    public function get_id_membre() {
        return $this->id_membre;
    }

    public function get_id_personne_membre() {
        return $this->id_personne_membre;
    }

    public function get_role_membre() {
        return $this->role_membre;
    }

    public function get_poste() {
        return $this->poste;
    }

    // Setters
    public function set_id_membre($id_membre) {
        $this->id_membre = $id_membre;
    }

    public function set_id_personne_membre($id_personne_membre) {
        $this->id_personne_membre = $id_personne_membre;
    }

    public function set_role_membre($role_membre) {
        $allowed_values = ['entraineur', 'joueur'];
        if (!in_array($role_membre, $allowed_values)) {
            throw new \InvalidArgumentException('Invalid value for role_membre');
        }
        $this->role_membre = $role_membre;
    }

    public function set_poste($poste) {
        $this->poste = $poste;
    }
}

?>