<?php

namespace models\organisation;

use models\BaseEntity;

class Attribuer_Recompense extends BaseEntity {
    protected $id_attribuer_recompense;
    protected $id_evenement_attribuer_recompense;
    protected $id_recompense_attribuer_recompense;

    // Constructeur
    public function __construct($id_attribuer_recompense=null, $id_evenement_attribuer_recompense=null, $id_recompense_attribuer_recompense=null) {
        $this->id_attribuer_recompense = $id_attribuer_recompense;
        $this->id_evenement_attribuer_recompense = $id_evenement_attribuer_recompense;
        $this->id_recompense_attribuer_recompense = $id_recompense_attribuer_recompense;
    }

    // Getters
    public function get_id_attribuer_recompense() {
        return $this->id_attribuer_recompense;
    }

    public function get_id_evenement_attribuer_recompense() {
        return $this->id_evenement_attribuer_recompense;
    }

    public function get_id_recompense_attribuer_recompense() {
        return $this->id_recompense_attribuer_recompense;
    }

    // Setters
    public function set_id_attribuer_recompense($id_attribuer_recompense) {
        $this->id_attribuer_recompense = $id_attribuer_recompense;
    }

    public function set_id_evenement_attribuer_recompense($id_evenement_attribuer_recompense) {
        $this->id_evenement_attribuer_recompense = $id_evenement_attribuer_recompense;
    }

    public function set_id_recompense_attribuer_recompense($id_recompense_attribuer_recompense) {
        $this->id_recompense_attribuer_recompense = $id_recompense_attribuer_recompense;
    }
}