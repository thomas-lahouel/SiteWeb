<?php



class MdlUser
{
    public function Inscription($nom, $prenom, $sexe, $numerodetelephone, $email, $motdepasse, $quest, $reponse){
        global $base, $login, $mdp;

        $nom = Nettoyer::sanitize_string($nom);
        $prenom = Nettoyer::sanitize_string($prenom);
        $numerodetelephone = Nettoyer::sanitize_string($numerodetelephone);
        $email = Nettoyer::sanitize_string($email);
        $motdepasse = Nettoyer::sanitize_string($motdepasse);
        $reponse = Nettoyer::sanitize_string($reponse);

        $gw = new ClientGateway(new Connection($base, $login, $mdp));
        if($gw->Inscription($nom, $prenom, $sexe, $numerodetelephone, $email, $motdepasse, $quest, $reponse)){
            return true;
        }
        else{
            return false;
        }
    }

    public function getQuestions(){
        global $base, $login, $mdp;
        $gw=new QuestionsGateway(new Connection($base, $login, $mdp));
        $tabDeQuestions=$gw->selectAllQuestions();
        return $tabDeQuestions;
    }

    public function Connexion(string $email,string $motdepasse){
        global $base,$login,$mdp;
        $gw=new ClientGateway(new Connection($base, $login, $mdp));

        $p2 = $gw->getPass($email);

        if (password_verify($motdepasse, $p2)) {
            $_SESSION['EmailClient'] = $email;
            $_SESSION['role'] = 'client';
            return true;
        } else {
            $gwA=new AdminGateway(new Connection($base, $login, $mdp));
            $p2=$gwA->getPass($email);
            if(password_verify($motdepasse, $p2)){
                $_SESSION['EmailAdmin'] = $email;
                $_SESSION['EmailClient'] = $email;
                $_SESSION['role'] = 'admin';
                return true;
            }
        }
        return false;
    }

    public function VerifEmail($email){
        global $base, $login, $mdp;
        $gw = new ClientGateway(new Connection($base, $login, $mdp));
        if ($gw->VerifEmail($email)){
            return true;
        }
        else{
            return false;
        }
    }

    public function ChercherToutesLesReservations(): array{
        global $base,$login,$mdp;
        $instformationgw= new ReservationGateway(new Connection($base, $login, $mdp));
        $tabReserv=$instformationgw->TrouverToutesLesReservations2();
        return $tabReserv;
    }

    public function ChercherEmail($email): bool{
        global $base,$login,$mdp;
        $instclientgw= new ClientGateway(new Connection($base, $login, $mdp));
        $tabClient=$instclientgw->ChercherEmail($email);
        if(empty($tabClient)){
            return false;
        }
        else{
            return true;
        }
    }


    public function getQuestionEmail($email){
        global $base, $login, $mdp;
        $gw = new ClientGateway(new Connection($base, $login, $mdp));
        $quest = $gw->getQuestionEmail($email);
        return $quest;
    }


    public function VerifQuestion($email, $la_rep){
        global $base, $login, $mdp;
        $gw = new ClientGateway(new Connection($base, $login, $mdp));

        $rep2 = $gw->getReponse($email);
        if(password_verify($la_rep, $rep2)){
            return true;
        }
        else{
            return false;
        }
    }

    public function ChangementMdp($email, $mdp1, $mdpVerif){
        global $base, $login, $mdp;
        $gw = new ClientGateway(new Connection($base, $login, $mdp));
        if($mdp1 == $mdpVerif){
            if($gw->ChangementMdp($email, $mdp1)){
                return true;
            }
            else{
                return false;
            }
        }
        else{
            return false;
        }
    }



    public function TrouverToutesLesFormations() : array
    {
        global $base,$login,$mdp;


        $instformationgw=new FormationGateway(new Connection($base, $login, $mdp));
        $tabFormations=$instformationgw->TrouverToutesLesFormations();
        return $tabFormations;
    
    }
    
    
    public function TrouverUneFormationParID($id) : array
    {
        global $base,$login,$mdp;

        $instarticlegw=new FormationGateway(new Connection($base, $login, $mdp));
        $tabFormation=$instarticlegw->TrouverUneFormationParID($id);
        return $tabFormation;
    }


    public function SelectAll($depart,$articlesParPage) : array
    {
        global $base,$login,$mdp;

        $instarticlegw=new ArticleGateway(new Connection($base, $login, $mdp));
        $tabNews=$instarticlegw->FindAll($depart,$articlesParPage);
        return $tabNews;

    }
    public function RechercherArticlesParDate($date){
        global $base,$login,$mdp;
        $instarticlegw = new ArticleGateway(new Connection($base, $login, $mdp));
        $tabNewsD=$instarticlegw->RechercherArticlesParDate($date);
        return $tabNewsD;
    }

    public function SelectionnerTousLesCommentaires($ArticleID){
        global $base,$login,$mdp;
        $instcommentairegw = new CommentaireGateWay(new Connection($base, $login, $mdp));
        $tabCommentaires=$instcommentairegw->SelectionnerTousLesCommentaires($ArticleID);
        return $tabCommentaires;
    }

    public function SelectUnArticle($id) : array
    {
        global $base,$login,$mdp;

        $instarticlegw=new ArticleGateway(new Connection($base, $login, $mdp));
        $tabNews=$instarticlegw->FindByID($id);
        return $tabNews;

    }

    public function TrouverNombreDeMessages(){
        global $base,$login,$mdp;
        $instcommentairegw=new CommentaireGateway(new Connection($base, $login, $mdp));
        $nbrdemessages=$instcommentairegw->TrouverNombreDeMessages();
        return $nbrdemessages;

    }

    public function ArticlesTotals(){
        global $base,$login,$mdp;
        $instartgw=new ArticleGateway(new Connection($base, $login, $mdp));
        $nbrarticles=$instartgw->ArticlesTotals();
        return $nbrarticles;
    }
    
}
    
    
    
   
    
    
?> 