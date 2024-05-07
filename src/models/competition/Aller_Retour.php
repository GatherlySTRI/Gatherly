<?php

namespace models\competition;

use models\BaseEntity;

class Aller_Retour extends BaseEntity {
    protected $id_aller_retour;
    protected $id_match_rugby_aller;
    protected $id_match_rugby_retour;
    protected $id_aller_retour_phase_A_R_;

    // Constructeur
    public function __construct($id_aller_retour=null, $id_match_rugby_aller=null, $id_match_rugby_retour=null, $id_aller_retour_phase_A_R_=null) {
        $this->id_aller_retour = $id_aller_retour;
        $this->id_match_rugby_aller = $id_match_rugby_aller;
        $this->id_match_rugby_retour = $id_match_rugby_retour;
        $this->id_aller_retour_phase_A_R_ = $id_aller_retour_phase_A_R_;
    }

    // Getters
    public function get_id_aller_retour() {
        return $this->id_aller_retour;
    }

    public function get_id_match_rugby_aller() {
        return $this->id_match_rugby_aller;
    }

    public function get_id_match_rugby_retour() {
        return $this->id_match_rugby_retour;
    }

    public function get_id_aller_retour_phase_A_R_() {
        return $this->id_aller_retour_phase_A_R_;
    }

    // Setters
    public function set_id_aller_retour($id_aller_retour) {
        $this->id_aller_retour = $id_aller_retour;
    }

    public function set_id_match_rugby_aller($id_match_rugby_aller) {
        $this->id_match_rugby_aller = $id_match_rugby_aller;
    }

    public function set_id_match_rugby_retour($id_match_rugby_retour) {
        $this->id_match_rugby_retour = $id_match_rugby_retour;
    }

    public function set_id_aller_retour_phase_A_R_($id_aller_retour_phase_A_R_) {
        $this->id_aller_retour_phase_A_R_ = $id_aller_retour_phase_A_R_;
    }
}