<?php



class MdlAdmin {
    
     public function isAdmin(){
        if(isset($_SESSION ['EmailAdmin'])){
            $login = $_SESSION['EmailAdmin'];
            return $login;
        }
        else
            return NULL;
    }
    
    public function AjouterUneFormation($intitule,$type,$datedebut,$datefin,$publicvise,$description){
        global $base,$login,$mdp;
        $gw=new FormationGateway(new Connection($base, $login, $mdp));
        $gw->AjouterUneFormation($intitule,$type,$datedebut,$datefin,$publicvise,$description);
    }

    public function AjouterLeMateriel ($intitutle,$quantite){
         global $base,$login,$mdp;
         $gw = new MaterielGateway(new Connection($base,$login,$mdp));
         $gw->AjouterUnMateriel($intitutle,$quantite);
    }

    public function TrouverToutleMateriel(): array{
        global $base,$login,$mdp;
        $gw = new MaterielGateway(new Connection($base,$login,$mdp));
        $tabMateriel=$gw -> TrouverToutleMateriel();
        return $tabMateriel;

    }

    public function MettreAJourDuMateriel ($intitule,$quantite){
         global $base,$login,$mdp;
         $gw = new MaterielGateway(new Connection($base,$login,$mdp));
         $gw->MettreAJourUnMateriel($intitule,$quantite);


    }
    
    public function SupprimerUneFormation($ID){
        global $base,$login,$mdp;
        $gw=new FormationGateway(new Connection($base, $login, $mdp));
        $gw->SupprimerFormation($ID);
    }

    public function SupprimerUnMateriel($ID){
         global $base,$login,$mdp;
         $gw=new MaterielGateway(new Connection($base,$login,$mdp));
         $gw->SupprimerUnMateriel($ID);
    }
    
    public function chercherTousLesUtilisateurs(){
        global $base,$login,$mdp;
        $gw=new ClientGateway(new Connection($base, $login, $mdp));
        $tabUtilisateurs=$gw->chercherTousLesUtilisateurs();
        return $tabUtilisateurs;
    }
    
    public function supprimerUnUtilisateur($ID){
        global $base,$login,$mdp;
        $gw=new ClientGateway(new Connection($base, $login, $mdp));
        $gw->supprimerUnUtilisateur($ID);
    }

    public function chercherUnUtilisateur($ID): array{
         global $base,$login,$mdp;
         $gw= new ClientGateway(new Connection($base,$login,$mdp));
         $utilisateur=$gw->chercherUnUtilisateur($ID);
         return $utilisateur;
    }
    
    public function TrouverTousLesPublics(): array{
         global $base,$login,$mdp;
        $instpublicvisegw=new PublicViseGateway(new Connection($base, $login, $mdp));
        $tabPublics=$instpublicvisegw->TrouverTousLesPublics();
        return $tabPublics;
    }
    
    public function TrouverTousLesTypesDeFormation(): array{
         global $base,$login,$mdp;
        $insttypeformationgw=new TypeFormationGateway(new Connection($base, $login, $mdp));
        $tabTypesFormation=$insttypeformationgw->TrouverTousLesTypesDeFormations();
        return $tabTypesFormation;
    }


    public function AjouterUnArticle(string $titre,string $contenu)
    {
        global $base,$login,$mdp;
        $instarticlegw=new ArticleGateway(new Connection($base,$login,$mdp));
        $ArticleAAjouter=$instarticlegw->AjouterArticle($titre,$contenu);
    }

    public function SupprimerUnArticle($ID){
         global $base,$login,$mdp;
        $instarticlegw=new ArticleGateway(new Connection($base,$login,$mdp));
        $ArticleASupprimer=$instarticlegw->SupprimerArticle($ID);
    }
    
    
}
