<?php


class Formation{
    
    private $ID;
    private $Intitule;
    private $Type;
    private $DateDebut;
    private $DateFin;
    private $PublicVise;
    private $Description;
    
    function __construct($ID, $Intitule, $Type, $DateDebut, $DateFin, $PublicVise,$Description) {
        $this->ID = $ID;
        $this->Intitule = $Intitule;
        $this->Type = $Type;
        $this->DateDebut = $DateDebut;
        $this->DateFin = $DateFin;
        $this->PublicVise = $PublicVise;
        $this->Description = $Description;
    }
    
    function getID() {
        return $this->ID;
    }

    function getIntitule() {
        return $this->Intitule;
    }

    function getType() {
        return $this->Type;
    }

    function getDateDebut() {
        return $this->DateDebut;
    }

    function getDateFin() {
        return $this->DateFin;
    }

    function getPublicVise() {
        return $this->PublicVise;
    }

    function setID($ID): void {
        $this->ID = $ID;
    }

    function setIntitule($Intitule): void {
        $this->Intitule = $Intitule;
    }

    function setType($Type): void {
        $this->Type = $Type;
    }

    function setDateDebut($DateDebut): void {
        $this->DateDebut = $DateDebut;
    }

    function setDateFin($DateFin): void {
        $this->DateFin = $DateFin;
    }

    function setPublicVise($PublicVise): void {
        $this->PublicVise = $PublicVise;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->Description;
    }

    /**
     * @param mixed $Description
     */
    public function setDescription($Description): void
    {
        $this->Description = $Description;
    }








}
?>