<?php


class TypeFormationGateway {
       private $con;
    
    public function __construct(Connection $con) {
        $this->con = $con;
    }
    
     public function TrouverTousLesTypesDeFormations() : Array {
        $query='SELECT * from typeformation';
       
        $this->con->executeQuery($query);
        $result=$this->con->getResults();
        $TypeFormation=[];
   
       

        foreach ($result as $row){
             $TypeFormation[]=new PublicVise($row['ID'],$row['Designation']);
        }
        return $TypeFormation;
    }
}
