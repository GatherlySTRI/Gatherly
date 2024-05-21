<?php

namespace models\competition;

use models\BaseEntity;

class Etape_Arbre extends BaseEntity {
    protected $id_etape_arbre;
    protected $id_arbre_etape_arbre;
    protected $etape;

    const TYPE_etape_arbre = ['seizieme', 'huitieme', 'quart', 'demi', 'finale'];

    // Constructeur
    public function __construct($id_etape_arbre=null, $id_arbre_etape_arbre=null, $etape=null) {
        $this->id_etape_arbre = $id_etape_arbre;
        $this->id_arbre_etape_arbre = $id_arbre_etape_arbre;
        $this->set_etape($etape);
    }

    // Getters
    public function get_id_etape_arbre() {
        return $this->id_etape_arbre;
    }

    public function get_id_arbre_etape_arbre() {
        return $this->id_arbre_etape_arbre;
    }

    public function get_etape() {
        return $this->etape;
    }

    // Setters
    public function set_id_etape_arbre($id_etape_arbre) {
        $this->id_etape_arbre = $id_etape_arbre;
    }

    public function set_id_arbre_etape_arbre($id_arbre_etape_arbre) {
        $this->id_arbre_etape_arbre = $id_arbre_etape_arbre;
    }

    public function set_etape($etape) {
        if (!in_array($etape, self::TYPE_etape_arbre)) {
            throw new \InvalidArgumentException("Invalid type for etape");
        }
        $this->etape = $etape;
    }
}