<?php


class Article{

    private $ID;
    private $Titre;
    private $Contenu;
    private $Date;

    function __construct($ID, $Titre, $Contenu, $Date) {
        $this->ID = $ID;
        $this->Titre = $Titre;
        $this->Contenu = $Contenu;
        $this->Date = $Date;
    }

    function getID() {
        return $this->ID;
    }

    function getTitre() {
        return $this->Titre;
    }

    function getContenu() {
        return $this->Contenu;
    }

    function getDate() {
        return $this->Date;
    }

    function setID($ID) {
        $this->ID = $ID;
    }

    function setTitre($Titre) {
        $this->Titre = $Titre;
    }

    function setContenu($Contenu) {
        $this->Contenu = $Contenu;
    }

    function setDate($Date) {
        $this->Date = $Date;
    }


    public function __toString() {
        return " Le numéro de cet article est : " . $this->ID . "Son titre est : " . $this->Titre . " Son contenu est : " . $this->Contenu . " Sa date de création est : " . $this ->Date;
    }


}
?>