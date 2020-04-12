<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TypeFormation
 *
 * @author sofia
 */
class TypeFormation {
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
