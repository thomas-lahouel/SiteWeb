<?php


class PublicVise{
    private $ID;
    private $Designation;
    
    function __construct($ID, $Designation) {
        $this->ID = $ID;
        $this->Designation = $Designation;
    }
    
    function getID() {
        return $this->ID;
    }

    function getDesignation() {
        return $this->Designation;
    }

    function setID($ID): void {
        $this->ID = $ID;
    }

    function setDesignation($Designation): void {
        $this->Designation = $Designation;
    }



   
    
    
}
