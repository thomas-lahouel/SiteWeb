<?php


class PublicViseGateway {
    private $con;
    
    public function __construct(Connection $con) {
        $this->con = $con;
    }
    
     public function TrouverTousLesPublics() : Array {
        $query='SELECT * from publicvise';
       
        $this->con->executeQuery($query);
        $result=$this->con->getResults();
        $PublicVise=[];
   
       

        foreach ($result as $row){
             $PublicVise[]=new PublicVise($row['ID'],$row['Designation']);
        }
        return $PublicVise;
    }
}
