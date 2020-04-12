<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ReservationGateway
 *
 * @author sofia
 */
class ReservationGateway {
    
     private $con;
    public function __construct(Connection $con) {
        $this->con = $con;
    }
    
    
    public function TrouverToutesLesReservations($pseudo) : Array{
        $query="SELECT * from reservation where Pseudo='$pseudo'";
        
        $this->con->executeQuery($query); 
        $result=$this->con->getResults();
        $Reservation=[];
        foreach ($result as $row) {
            $Reservation[]=new Reservation($row['ID'],$row['Intitule'],$row['Type'],$row['DateDebut'],$row['DateFin'],$row['PublicVise'],$row['Pseudo'],$row['NbrPersonnes']);
            
        }
        return $Reservation;  
    }

    public function TrouverReservation($intitule,$type,$dateDebut,$dateFin,$publicVise,$EmailClient,$nbrPersonnes): Array{
        $query="SELECT * from reservation where Intitule='$intitule' and Type='$type' and DateDebut='$dateDebut' and DateFin='$dateFin' and PublicVise='$publicVise' and Pseudo='$EmailClient' and NbrPersonnes='$nbrPersonnes'";
        $this->con->executeQuery($query);
        $result=$this->con->getResults();
        $Reservation=[];
        foreach ($result as $row) {
            $Reservation[]=new Reservation($row['ID'],$row['Intitule'],$row['Type'],$row['DateDebut'],$row['DateFin'],$row['PublicVise'],$row['Pseudo'],$row['NbrPersonnes']);

        }
        return $Reservation;
    }

    public function SupprimerLaReservation($ID){
        $query="DELETE from reservation where ID='$ID'";
        $this->con->executeQuery($query);
    }

    public function CreerUneReservationPersonelle($intitule,$type,$dateDebut,$dateFin,$publicVise,$EmailClient,$nbrPersonnes){
        $query = "INSERT INTO reservation VALUES(NULL,:Intitule,:Type,:DateDebut,:DateFin,:PublicVise,:Pseudo,:NbrPersonnes)";
        $this->con->executeQuery($query, array(':Intitule'=> array($intitule,PDO::PARAM_STR),
            ':Type'=> array($type,PDO::PARAM_STR),
            ':DateDebut'=> array($dateDebut,PDO::PARAM_STR),
            ':DateFin'=> array($dateFin,PDO::PARAM_STR),
            ':PublicVise'=> array($publicVise,PDO::PARAM_STR),
            ':Pseudo'=> array($EmailClient,PDO::PARAM_STR),
            ':NbrPersonnes'=> array($nbrPersonnes,PDO::PARAM_INT)));
    }

    public function TrouverToutesLesReservations2(): array{
        $query="SELECT * from reservation";
        $this->con->executeQuery($query);
        $result=$this->con->getResults();
        $Reservation=[];
        foreach ($result as $row) {
            $Reservation[]=new Reservation($row['ID'],$row['Intitule'],$row['Type'],$row['DateDebut'],$row['DateFin'],$row['PublicVise'],$row['Pseudo'],$row['NbrPersonnes']);

        }
        return $Reservation;
    }


}

