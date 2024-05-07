<?php

namespace models\organisation;

use models\BaseEntity;

class Evenement extends BaseEntity {
    protected $id_evenement;
    protected $nom_evenement;
    protected $description_evenement;
    protected $type_rugby;
    protected $variante_rugby;
    protected $categorie_evenement;

    // Constructeur
    public function __construct($id_evenement = null, $nom_evenement = null, $description_evenement = null, $type_rugby = null, $variante_rugby = null, $categorie_evenement = null) {
        $this->id_evenement = $id_evenement;
        $this->nom_evenement = $nom_evenement;
        $this->description_evenement = $description_evenement;
        $this->type_rugby = $type_rugby;
        $this->variante_rugby = $variante_rugby;
        $this->categorie_evenement = $categorie_evenement;
    }

    // Getters
    public function get_id_evenement() {
        return $this->id_evenement;
    }

    public function get_nom_evenement() {
        return $this->nom_evenement;
    }

    public function get_description_evenement() {
        return $this->description_evenement;
    }

    public function get_type_rugby() {
        return $this->type_rugby;
    }

    public function get_variante_rugby() {
        return $this->variante_rugby;
    }

    public function get_categorie_evenement() {
        return $this->categorie_evenement;
    }

    // Setters
    public function set_id_evenement($id_evenement) {
        $this->id_evenement = $id_evenement;
    }

    public function set_nom_evenement($nom_evenement) {
        $this->nom_evenement = $nom_evenement;
    }

    public function set_description_evenement($description_evenement) {
        $this->description_evenement = $description_evenement;
    }

    public function set_type_rugby($type_rugby) {
        $allowed_values = ['contact', 'toucher'];
        if (!in_array($type_rugby, $allowed_values)) {
            throw new \InvalidArgumentException('Invalid value for type_rugby');
        }
        $this->type_rugby = $type_rugby;
    }

    public function set_variante_rugby($variante_rugby) {
        $allowed_values = ['15', '7', '13'];
        if (!in_array($variante_rugby, $allowed_values)) {
            throw new \InvalidArgumentException('Invalid value for variante_rugby');
        }
        $this->variante_rugby = $variante_rugby;
    }

    public function set_categorie_evenement($categorie_evenement) {
        $this->categorie_evenement = $categorie_evenement;
    }
}

?>