<?php

namespace models\organisation;

use models\BaseEntity;

class Recevoir_Recompense extends BaseEntity {
    protected $id_recevoir_recompense;
    protected $id_recompense_recevoir_recompense;
    protected $id_equipe_recevoir_recompense;

    // Constructeur
    public function __construct($id_recevoir_recompense=null, $id_recompense_recevoir_recompense=null, $id_equipe_recevoir_recompense=null) {
        $this->id_recevoir_recompense = $id_recevoir_recompense;
        $this->id_recompense_recevoir_recompense = $id_recompense_recevoir_recompense;
        $this->id_equipe_recevoir_recompense = $id_equipe_recevoir_recompense;
    }

    // Getters
    public function get_id_recevoir_recompense() {
        return $this->id_recevoir_recompense;
    }

    public function get_id_recompense_recevoir_recompense() {
        return $this->id_recompense_recevoir_recompense;
    }

    public function get_id_equipe_recevoir_recompense() {
        return $this->id_equipe_recevoir_recompense;
    }

    // Setters
    public function set_id_recevoir_recompense($id_recevoir_recompense) {
        $this->id_recevoir_recompense = $id_recevoir_recompense;
    }

    public function set_id_recompense_recevoir_recompense($id_recompense_recevoir_recompense) {
        $this->id_recompense_recevoir_recompense = $id_recompense_recevoir_recompense;
    }

    public function set_id_equipe_recevoir_recompense($id_equipe_recevoir_recompense) {
        $this->id_equipe_recevoir_recompense = $id_equipe_recevoir_recompense;
    }
}