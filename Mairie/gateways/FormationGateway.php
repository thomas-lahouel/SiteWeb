<?php


class FormationGateway
{
    
  
    private $con;
    public function __construct(Connection $con) {
        $this->con = $con;
    }
    
    
    
    public function TrouverUneFormationParID($id) : Array{
        $query='SELECT * from formation where ID='.$id;
        
        $this->con->executeQuery($query); 
        $result=$this->con->getResults();
        foreach ($result as $row) {
            $Formation[]=new Formation($row['ID'],$row['Intitule'],$row['Type'],$row['DateDebut'],$row['DateFin'],$row['PublicVise'],$row['Description']);
            
        }
        return $Formation;  
    }
        
    public function TrouverToutesLesFormations() : Array {
        $query='SELECT * from formation';
       
        $this->con->executeQuery($query);
        $result=$this->con->getResults();
        $Formation=[];
   
       

        foreach ($result as $row){
             $Formation[]=new Formation($row['ID'],$row['Intitule'],$row['Type'],$row['DateDebut'],$row['DateFin'],$row['PublicVise'],$row['Description']);
        }
        return $Formation;
    }
    
    public function SupprimerFormation($id){
        $query="DELETE from formation where ID='$id'";
        $this->con->executeQuery($query);
    }
    
    public function InsererReservation($ID,$nbrPersonnes,$pseudo){
        /*$query="INSERT INTO reservation
                SELECT * FROM formation where ID=".$ID;
         
         */
        $query="INSERT INTO reservation(ID,Intitule,Type,DateDebut,DateFin,PublicVise) SELECT ID,Intitule,Type,DateDebut,DateFin,PublicVise FROM formation WHERE ID=".$ID;
        $this->con->executeQuery($query);
        $query2="Update reservation SET NbrPersonnes=".$nbrPersonnes." where ID=".$ID;
        $this->con->executeQuery($query2);
        $query3="Update reservation SET Pseudo='$pseudo' where ID=".$ID;
        $this->con->executeQuery($query3);

    }
    
    public function AjouterUneFormation($intitule,$type,$datedebut,$datefin,$publicvise,$description){
        $query="INSERT INTO formation VALUES (NULL,:Intitule,:Type,:DateDebut,:DateFin,:PublicVise,:Description)";
        $this->con->executeQuery($query, array(':Intitule'=> array($intitule,PDO::PARAM_STR),
                                               ':Type'=> array($type,PDO::PARAM_STR),
                                               ':DateDebut'=> array($datedebut,PDO::PARAM_STR),
                                               ':DateFin'=> array($datefin,PDO::PARAM_STR),
                                               ':PublicVise'=> array($publicvise,PDO::PARAM_STR),
                                               ':Description'=> array($description,PDO::PARAM_STR)));
        
    }
    
    

        
 }

?>