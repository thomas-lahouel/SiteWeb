<?php



class Admin {
    private $Pseudo;
    private $Motdepasse;
    
    function __construct($Pseudo, $Motdepasse) {
        $this->Pseudo = $Pseudo;
        $this->Motdepasse = $Motdepasse;
    }
    
    function getPseudo() {
        return $this->Pseudo;
    }

    function getMotdepasse() {
        return $this->Motdepasse;
    }

    function setPseudo($Pseudo): void {
        $this->Pseudo = $Pseudo;
    }

    function setMotdepasse($Motdepasse): void {
        $this->Motdepasse = $Motdepasse;
    }
}
