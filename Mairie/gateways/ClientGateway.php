<?php


class ClientGateway {
    
     private $con;
     public function __construct(Connection $con) {
        $this->con = $con;
    }

    public function Inscription($nom, $prenom, $sexe, $numerodetelephone, $email, $motdepasse, $quest, $reponse){
         $query = 'INSERT INTO client VALUES (NULL, :nom, :prenom, :sexe, :num, :email, :motdepasse, :quest, :reponse)';
         $mdp = password_hash($motdepasse, PASSWORD_DEFAULT);
         $rep = password_hash($reponse, PASSWORD_DEFAULT);
         if($this->con->executeQuery($query, array(':nom' => array($nom, PDO::PARAM_STR),
                                                    ':prenom' => array($prenom, PDO::PARAM_STR),
                                                    ':sexe' => array($sexe, PDO::PARAM_STR),
                                                    ':num' => array($numerodetelephone, PDO::PARAM_STR),
                                                    ':email' => array($email, PDO::PARAM_STR),
                                                    ':motdepasse' => array($mdp, PDO::PARAM_STR),
                                                    ':quest' => array($quest, PDO::PARAM_STR),
                                                    ':reponse' => array($rep, PDO::PARAM_STR)))){
             return true;
         }
         else{
             return false;
         }
    }

    public function getPass($email){
        $query = 'SELECT MotDePasse FROM client WHERE Email=:email';
        $this->con->executeQuery($query, array(
            ':email' => array($email, PDO::PARAM_STR)
        ));
        $result=$this->con->getResults();
        if($result != array()){
            return $result[0]['MotDePasse'];
        }
        return null;
    }


    public function VerifEmail($email){
        $query = 'SELECT Email FROM client WHERE Email = :email';
        $mail = $this->con->executeQuery($query, array(':email' => array($email, PDO::PARAM_STR)));
        if($mail == null){
            return false;
        }
        else{
            return true;
        }
    }

    public function getQuestionEmail($email){
        $query = 'SELECT Question FROM client WHERE Email = :email';
        $this->con->executeQuery($query, array(':email' => array($email, PDO::PARAM_STR)));
        $quest = $this->con->getResults();
        return $quest;
    }

    public function getReponse($email){
        $query = 'SELECT Reponse FROM client WHERE Email = :email';
        $this->con->executeQuery($query, array(':email' => array($email, PDO::PARAM_STR)));
        $result=$this->con->getResults();
        if($result != array()){
            return $result[0]['Reponse'];
        }
        return null;
    }

    public function ChangementMdp($email, $mdp){
        $query = 'UPDATE client SET MotDePasse = :mdp WHERE Email = :email';
        $hash_mdp = password_hash($mdp, PASSWORD_DEFAULT);
        if($this->con->executeQuery($query, array(':mdp' => array($hash_mdp, PDO::PARAM_STR),
            ':email' => array($email, PDO::PARAM_STR)))){
            return true;
        }
        else{
            return false;
        }
    }


    public function ConnexionClient($pseudo,$motdepasse){
        
        $query= "Select * from client where Pseudo = '$pseudo' and Motdepasse=md5('$motdepasse')";
        $this->con->executeQuery($query);
        $result=$this->con->getResults();
        if(empty($result)){
            return NULL;
        }
        else{
            foreach ($result as $row){
                 $Client[] = new Client($row['ID'],$row['Pseudo'],$row['Motdepasse'],$row['Nom'],$row['Prenom'],$row['NumeroDeTelephone']);
            }
        return $Client; 
        }
    }
    
    public function verifUtilisateur($pseudo){
        $query="Select * from client where Pseudo = '$pseudo'";
        $this->con->executeQuery($query);
        $result=$this->con->getResults();
        if(empty($result)){
            return NULL;
        }
        else{
            foreach ($result as $row){
                $Client[] = new Client($row['ID'],$row['Pseudo'],$row['Motdepasse'],$row['Nom'],$row['Prenom'],$row['NumeroDeTelephone']);
            }
        return $Client; 
        }
        
    }

    public function ChercherEmail($email){
         $query="SELECT * from client where Email='$email'";
         $this->con->executeQuery($query);
         $result=$this->con->getResults();
         $Client=[];

             foreach ($result as $row){
                 $Client[] = new Client($row['ID'],$row['Nom'],$row['Prenom'],$row['Sexe'],$row['NumeroTel'],$row['Email'],$row['MotDePasse'],$row['Question'],$row['Reponse']);

             }
               return $Client;

    }
     /*
    public function Inscription($pseudo,$motdepasse,$nom,$prenom,$numerodetelephone){
        $query="INSERT INTO client VALUES (NULL,:Pseudo,:Motdepasse,:Prenom,:Nom,:NumeroDeTelephone)";
        $motdepasse=md5($motdepasse);
        $this->con->executeQuery($query, array(':Pseudo'=> array($pseudo,PDO::PARAM_STR),
                                               ':Motdepasse'=> array($motdepasse,PDO::PARAM_STR),
                                               ':Nom'=> array($motdepasse,PDO::PARAM_STR),
                                               ':Prenom'=> array($motdepasse,PDO::PARAM_STR),
                                               ':NumeroDeTelephone'=> array($motdepasse,PDO::PARAM_STR)));
    }
    */
    public function chercherTousLesUtilisateurs(){
        $query="SELECT * from client";
        $this->con->executeQuery($query);
        $result=$this->con->getResults();
        $Client=[];
   
       

        foreach ($result as $row){
              $Client[] = new Client($row['ID'],$row['Nom'],$row['Prenom'],$row['Sexe'],$row['NumeroTel'],$row['Email'],$row['MotDePasse'],$row['Question'],$row['Reponse']);
        }
        return $Client;
    }

    public function chercherUnUtilisateur($ID){
        $query="SELECT * from client where ID='$ID'";
        $this->con->executeQuery($query);
        $result=$this->con->getResults();
        $Client=[];



        foreach ($result as $row){
            $Client[] = new Client($row['ID'],$row['Nom'],$row['Prenom'],$row['Sexe'],$row['NumeroTel'],$row['Email'],$row['MotDePasse'],$row['Question'],$row['Reponse']);
        }
        return $Client;
    }

    
    public function supprimerUnUtilisateur($ID){
        $query="DELETE from client where ID='$ID'";
        $this->con->executeQuery($query);
    }
    
     
    
 
    
}