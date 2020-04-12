<?php


class MaterielGateway
{
    private $con;
    public function __construct(Connection $con) {
        $this->con = $con;
    }

    public function TrouverToutleMateriel() : Array {
        $query='SELECT * from materiel';

        $this->con->executeQuery($query);
        $result=$this->con->getResults();
        $Materiel=[];



        foreach ($result as $row){
            $Materiel[]=new Materiel($row['ID'],$row['Designation'],$row['Quantite']);
        }
        return $Materiel;
    }

    public function AjouterUnMateriel($intitule,$quantite){
        $query="INSERT INTO materiel VALUES (NULL,:Intitule,:Quantite)";
        $this->con->executeQuery($query, array(':Intitule'=> array($intitule,PDO::PARAM_STR),
            ':Quantite'=> array($quantite,PDO::PARAM_INT)));
    }

    public function MettreAJourUnMateriel($intitule,$quantite){

        $query2= "Update materiel SET Quantite=$quantite where Designation='$intitule'";
        $this->con->executeQuery($query2);
    }

    public function SupprimerUnMateriel($id){
        $query="DELETE from materiel where ID='$id'";
        $this->con->executeQuery($query);
    }

}