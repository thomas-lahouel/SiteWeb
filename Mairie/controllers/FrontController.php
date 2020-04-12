<?php

class FrontController{
    
    public function __construct() {
       global $vues,$rep;
       session_start();
       $listeAction_Client = array('SupprimerLaReservation','AjouterUnMessage','OuvrirPageChat','AjouterUnCommentaire','OuvrirPageReservationSalle','SeDeconnecter','ReserverLaSalle','VoirSesFormationsReservees','ReserverLaSallePerso');
       $listeAction_Admin = array('OuvrirPageAjoutArticle','SupprimerUnArticle','AjouterUnArticle','SupprimerUnMateriel','MettreAJourDuMateriel','AjouterLeMateriel','SeDeconnecterA','SupprimerUneFormationA','AjouterUneFormation','OuvrirPageGererUtilisateurs','supprimerUnUtilisateur','OuvrirPageAjoutFormation','voirInformationsDUnUtilisateur','OuvrirPageGererMateriel');


                        
    try{
        $mdlClient= new MdlClient();
        $mdlAdmin= new MdlAdmin();
        $admin=$mdlAdmin->isAdmin();
        $client=$mdlClient->isClient();
        $action=$_REQUEST['action'];

        if(in_array($action,$listeAction_Admin)){
            if($admin==NULL){
                require($rep.$vues['vueConnexion']);
            }
            else{
                $adminctrl= new ControllerAdmin();
            }
        }
        elseif(in_array($action, $listeAction_Client)){
            if($client==NULL){
                require($rep.$vues['vueConnexion']);
  
            }
            else{
                $clientctrl= new ControllerClient();
            }
        }

        else{
            $userctrl= new ControllerUser();
        }
    } catch (PDOException $e)
        {
                echo $e->getMessage();
                $dVueEreur[] =	"Erreur inattendue PDO!!! ";
                require ($rep.$vues['erreur']);

        }
        catch (Exception $e2)
                {
                $dVueEreur[] =	"Erreur inattendue!!! ";
                require ($rep.$vues['erreur']);
                }
    }
}

