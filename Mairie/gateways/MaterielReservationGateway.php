<?php


class MaterielReservationGateway
{
    public function __construct(Connection $con) {
        $this->con = $con;
    }

    public function InsererMaterielReservation($ID,$designation,$quantite){
        $query="INSERT INTO materielreservation VALUES (NULL,:reservation_ID,:Designation,:Quantite)";
        $this->con->executeQuery($query, array(':reservation_ID'=> array($ID,PDO::PARAM_STR),
            ':Designation'=> array($designation,PDO::PARAM_STR),
            ':Quantite'=> array($quantite,PDO::PARAM_INT)));
    }
}