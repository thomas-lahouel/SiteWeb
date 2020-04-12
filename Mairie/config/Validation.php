<?php

class Validation {

    public static function validate_inscription($nom, $prenom, $numerodetelephone, $motdepasse, $reponse){
        if(!isset($nom) || $nom=""){
            return false;
        }
        if(!isset($prenom) || $prenom=""){
            return false;
        }
        if(!isset($numerodetelephone) || $numerodetelephone=""){
            return false;
        }
        if(!isset($motdepasse) || $motdepasse=""){
            return false;
        }
        if(!isset($reponse) || $reponse=""){
            return false;
        }
        return true;
    }



    static function verifconnexion(string $pseudo,string $motdepasse, array &$dVueEreur) : bool {

        if (!isset($pseudo)||$pseudo=="") {
            $dVueEreur[] =	"Aucun pseudo entré...";
            $pseudo="";
            return false;
        }

        else if ($pseudo != filter_var($pseudo, FILTER_SANITIZE_STRING))
        {
            $dVueEreur[] =	"Hop hop hop, ceci n'est pas un pseudo !!!";
            $pseudo="";
            return false;

        }
        else
            return true;
    }
    
  
    static function verifDate(string $date, array &$dVueEreur) : bool{
        if ( preg_match ( "/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/" , $date ) ){
            return true;
        }
        else{
            $dVueEreur[] =	"Hop hop hop, ceci n'est pas une date valide, entrez une date de la forme : AAAA-MM-JJ !!!";
            return false;
        }
    }
    
    static function verifMail(string $mail) : bool{
        if ( preg_match ( "/^([\w-\.]+)@((?:[\w]+\.)+)([a-zA-Z]{2,4})/i" , $mail) ){
            return true;
        }
        else{
            return false;
        }
    }
    
    
    
}
?>

        