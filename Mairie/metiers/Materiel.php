<?php


class Materiel
{
    private $ID;
    private $Designation;
    private $Quantite;

    /**
     * Materiel constructor.
     * @param $ID
     * @param $Designation
     * @param $Quantite
     */
    public function __construct($ID, $Designation, $Quantite)
    {
        $this->ID = $ID;
        $this->Designation = $Designation;
        $this->Quantite = $Quantite;
    }

    /**
     * @return mixed
     */
    public function getID()
    {
        return $this->ID;
    }

    /**
     * @param mixed $ID
     */
    public function setID($ID): void
    {
        $this->ID = $ID;
    }

    /**
     * @return mixed
     */
    public function getDesignation()
    {
        return $this->Designation;
    }

    /**
     * @param mixed $Designation
     */
    public function setDesignation($Designation): void
    {
        $this->Designation = $Designation;
    }

    /**
     * @return mixed
     */
    public function getQuantite()
    {
        return $this->Quantite;
    }

    /**
     * @param mixed $Quantite
     */
    public function setQuantite($Quantite): void
    {
        $this->Quantite = $Quantite;
    }




}