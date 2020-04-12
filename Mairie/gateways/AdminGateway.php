<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AdminGateway
 *
 * @author sofia
 */
class AdminGateway {
    
    private $con;
    public function __construct(Connection $con) {
        $this->con = $con;
    }

    public function getPass($email){
        $query = 'SELECT MotDePasse FROM admin WHERE Email=:email';
        $this->con->executeQuery($query, array(
            ':email' => array($email, PDO::PARAM_STR)
        ));
        $result=$this->con->getResults();
        if($result != array()){
            return $result[0]['MotDePasse'];
        }else
            return null;
    }
    
    public function ConnexionAdmin($pseudo,$motdepasse){
        
        $query= "Select * from admin where Pseudo = '$pseudo' and Motdepasse=md5('$motdepasse')";
        $this->con->executeQuery($query);
        $result=$this->con->getResults();
        if(empty($result)){
            return NULL;
        }
        else{
            foreach ($result as $row){
                $Admin[] = new Admin($row['Pseudo'],$row['Motdepasse']);
            }
        return $Admin; 
        }
    }
    
}
