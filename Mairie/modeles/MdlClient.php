<?php

class MdlClient {
      
    
    public function isClient(){
        if(isset($_SESSION ['EmailClient'])){
            $login = $_SESSION['EmailClient'];
            return $login;
        }
        else
            return NULL;
    }
    
    
     public function SupprimerFormation($id){
         global $base,$login,$mdp;
        $instarticlegw=new FormationGateway(new Connection($base, $login, $mdp));
        $instarticlegw->SupprimerFormation($id);
    }
    
    public function InsererFormationReservee($ID,$nbrPersonnes,$pseudo){
        global $base,$login,$mdp;
       /* foreach($tabFormation as $f){
            $ID=$F->getID();
            $Intitule=$F->getIntitule();
            $Type=$F->getType();
            $DateDebut=$F->getDateDebut();
            $DateFin=$F->getDateFin();
            $PublicVise=$F->getPublicVise();   
        }
        
        */
        $instarticlegw=new FormationGateway(new Connection($base, $login, $mdp));
        $instarticlegw->InsererReservation($ID,$nbrPersonnes,$pseudo);
    }

    public function InsererMaterielReservation($ID,$designation,$quantite){
        global $base,$login,$mdp;
        $instmaterielreservationgw = new MaterielReservationGateway(new Connection($base,$login,$mdp));
        $instmaterielreservationgw->InsererMaterielReservation($ID,$designation,$quantite);
    }
    
    public function ChercherReservations($pseudo): array{
        global $base,$login,$mdp;
        $instformationgw= new ReservationGateway(new Connection($base, $login, $mdp));
        $tabReserv=$instformationgw->TrouverToutesLesReservations($pseudo);
        return $tabReserv;
    }

    public function SupprimerLaReservation($ID){
        global $base,$login,$mdp;
        $instreservationgw= new ReservationGateway(new Connection($base,$login,$mdp));
        $instreservationgw->SupprimerLaReservation($ID);
    }


    public function TrouverReservation($intitule,$type,$dateDebut,$dateFin,$publicVise,$EmailClient,$nbrPersonnes): array{
        global $base,$login,$mdp;
        $instformationgw= new ReservationGateway(new Connection($base, $login, $mdp));
        $tabReserv=$instformationgw->TrouverReservation($intitule,$type,$dateDebut,$dateFin,$publicVise,$EmailClient,$nbrPersonnes);
        return $tabReserv;
    }
    public function CreerUneReservationPersonelle($intitule,$type,$dateDebut,$dateFin,$publicVise,$EmailClient,$nbrPersonnes){
        global $base,$login,$mdp;
        $instreservationgw=new ReservationGateway(new Connection($base, $login, $mdp));
        $instreservationgw->CreerUneReservationPersonelle($intitule,$type,$dateDebut,$dateFin,$publicVise,$EmailClient,$nbrPersonnes);
    }

    public function AjouterUnCommentaire($pseudo,$commentaire,$articleID){
        global $base,$login,$mdp;
        $instcommentairegw=new CommentaireGateway(new Connection($base, $login, $mdp));
        $CommentaireAAjouter=$instcommentairegw->AjouterUnCommentaire($pseudo,$commentaire,$articleID);
    }

    public function AjouterUnMessage($pseudo,$message){
        global $base,$login,$mdp;
        $instcommentairegw=new MessageChatGateway(new Connection($base, $login, $mdp));
        $instcommentairegw->AjouterUnMessage($pseudo,$message);
    }

    public function SelectionnerTousLesMessages(){
        global $base,$login,$mdp;
        $instmessagegw= new MessageChatGateway(new Connection($base,$login,$mdp));
        $tabMessages=$instmessagegw->SelectionnerTousLesMessages();
        return $tabMessages;
    }

    
}
