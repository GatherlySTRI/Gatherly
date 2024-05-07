<?php

namespace models\organisation;

use models\BaseEntity;

class Media extends BaseEntity {
    protected $id_media;
    protected $nom_media;
    protected $email_media;
    protected $telephone_media;

    // Constructeur
    public function __construct($id_media=null, $nom_media=null, $email_media=null, $telephone_media=null) {
        $this->id_media = $id_media;
        $this->nom_media = $nom_media;
        $this->email_media = $email_media;
        $this->telephone_media = $telephone_media;
    }

    // Getters
    public function get_id_media() {
        return $this->id_media;
    }

    public function get_nom_media() {
        return $this->nom_media;
    }

    public function get_email_media() {
        return $this->email_media;
    }

    public function get_telephone_media() {
        return $this->telephone_media;
    }

    // Setters
    public function set_id_media($id_media) {
        $this->id_media = $id_media;
    }

    public function set_nom_media($nom_media) {
        $this->nom_media = $nom_media;
    }

    public function set_email_media($email_media) {
        $this->email_media = $email_media;
    }

    public function set_telephone_media($telephone_media) {
        $this->telephone_media = $telephone_media;
    }
}