<?php


class MaterielReservation
{
    private $ID;
    private $Reservation_ID;
    private $Designation;
    private $Quantite;

    /**
     * MaterielReservation constructor.
     * @param $ID
     * @param $Reservation_ID
     * @param $Designation
     * @param $Quantite
     */
    public function __construct($ID, $Reservation_ID, $Designation, $Quantite)
    {
        $this->ID = $ID;
        $this->Reservation_ID = $Reservation_ID;
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
    public function getReservationID()
    {
        return $this->Reservation_ID;
    }

    /**
     * @param mixed $Reservation_ID
     */
    public function setReservationID($Reservation_ID): void
    {
        $this->Reservation_ID = $Reservation_ID;
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