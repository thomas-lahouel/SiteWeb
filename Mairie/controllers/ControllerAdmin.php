<?php

class ControllerAdmin extends ControllerUser {
    
        
    public function __construct() {
        global $rep,$vues;
        
     try{
        $action=$_REQUEST['action'];
        switch($action){
        case "SeDeconnecterA":
            $this->SeDeconnecterA();
            break;
        case "AjouterUneFormation":
            $this->AjouterUneFormation();
            break;
        case "SupprimerUneFormationA":
            $this->SupprimerUneFormationA();
            break;
        case "OuvrirPageGererUtilisateurs":
            $this->OuvrirPageGererUtilisateurs();
            break;
        case "supprimerUnUtilisateur":
            $this->supprimerUnUtilisateur();
            break;
        case "OuvrirPageAjoutFormation":
            $this->OuvrirPageAjoutFormation();
            break;
            case "OuvrirPageAjoutArticle":
                $this->OuvrirPageAjoutArticle();
                break;
            case "voirInformationsDUnUtilisateur":
                $this->voirInformationsDUnUtilisateur();
                break;
            case "OuvrirPageGererMateriel":
                $this->OuvrirPageGererMateriel();
                break;
            case "AjouterLeMateriel":
                $this->AjouterLeMateriel();
                break;
            case "AjouterUnArticle":
                $this->AjouterUnArticle();
                break;
            case "MettreAJourDuMateriel":
                $this->MettreAJourDuMateriel();
                break;
                case "SupprimerUnMateriel":
            $this->SupprimerUnMateriel();
            break;


        default:
        $dVueEreur[] =	"Erreur d'appel php";
        require ($rep.$vues['erreur']);
        break;
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
   
   
    
    public function SeDeconnecterA(){
        session_destroy();
        header("Refresh:0; url=index.php");
        $this->AfficherToutesLesFormations();
    }
    
    public function AjouterUneFormation(){
        global $rep,$vues;
        if(isset($_SESSION ['EmailClient']))
            $EmailClient=$_SESSION ['EmailClient'];
        if(isset($_SESSION ['EmailAdmin']))
            $EmailAdmin=$_SESSION ['EmailAdmin'];
        $dVueEreur[]="";
        $intitule = $_POST['Intitule'];
        $type = $_POST['Type'];
        $dateDebut = $_POST['DateDebut'];
        $dateFin = $_POST['DateFin'];
        $publicVise = $_POST['PublicVise'];
        $description = $_POST['Description'];
        $dateAuj = new DateTime("now");
        $dateDebut2 = date_create($dateDebut);
        $dateFin2 = date_create($dateFin);
        $model = new MdlAdmin();
        $tabPublics = $model->TrouverTousLesPublics();
        $tabTypesFormation = $model->TrouverTousLesTypesDeFormation();
        if(empty($intitule) || empty($description) || empty($dateDebut) || empty($dateFin)){
            $champsVides=true;
            require($rep.$vues['vueAjoutFormation']);
            exit;
        }
        if($dateDebut2 > $dateFin2){
            $dateDebutSuperieure=true;
            require($rep.$vues['vueAjoutFormation']);
            exit();
        }

        if($dateDebut2<$dateAuj){
            $dateDebutInferieurADateActuelle=true;
            require($rep.$vues['vueAjoutFormation']);
            exit();
        }
        $model->AjouterUneFormation($intitule,$type,$dateDebut,$dateFin,$publicVise,$description);
        $this->AfficherToutesLesFormations();
    }

    public function AjouterUnArticle()
    {
        global $rep,$vues;
        $dVueEreur[] = "";
        $titre = $_POST['titre'];
        $contenu=  $_POST['contenu'];
        $model = new MdlAdmin();
        $model->AjouterUnArticle($titre,$contenu);
        $this->OuvrirLeBlog();

    }

    public function AjouterLeMateriel(){
        global $rep,$vues;
        $intitule = $_POST['Intitule'];
        $quantite = $_POST['Quantite'];
        $model = new MdlAdmin();
        $model->AjouterLeMateriel($intitule,$quantite);
        $this->OuvrirPageGererMateriel();
    }

    public function MettreAJourDuMateriel(){
        global $rep,$vues;
        $intitule = $_POST['Intitule'];
        $quantite = $_POST['Quantite'];
        $model = new MdlAdmin();
        $model->MettreAJourDuMateriel($intitule,$quantite);
        $this->OuvrirPageGererMateriel();
    }
    
    
    
    public function SupprimerUneFormationA()
    {
     global $rep,$vues;
     $ID=$_GET['id'];
     $model=new MdlAdmin();
     $model->SupprimerUneFormation($ID);
     $this->AfficherToutesLesFormations();
    }

    public function SupprimerUnMateriel(){
        $ID=$_GET['id'];
        $model=new MdlAdmin();
        $model->SupprimerUnMateriel($ID);
        $this->OuvrirPageGererMateriel();
    }
    
    public function OuvrirPageGererUtilisateurs()
    {
        global $rep,$vues;
        global $suppressionUser;
        if(isset($_SESSION ['EmailAdmin']))
            $EmailAdmin=$_SESSION ['EmailAdmin'];
        $model = new MdlAdmin();
        $tabUtilisateurs=$model->chercherTousLesUtilisateurs();
        require($rep.$vues['vueGestionUtilisateurs']);
        

    }

    public function OuvrirPageGererMateriel(){
        global $rep,$vues;
        if(isset($_SESSION['EmailAdmin']))
            $EmailAdmin=$_SESSION['EmailAdmin'];
        $model = new MdlAdmin();
        $tabMateriel=$model->TrouverToutleMateriel();
        require($rep.$vues['vueGestionMateriel']);

    }
    
    public function supprimerUnUtilisateur(){
        global $rep,$vues;
        $ID=$_GET['id'];
        global $suppressionUser;
        $model= new MdlAdmin();
        $model->supprimerUnUtilisateur($ID);
        $suppressionUser=true;
        $this->OuvrirPageGererUtilisateurs();
    }

    public function OuvrirPageAjoutArticle(){
        global $rep,$vues;
        if(isset($_SESSION ['EmailAdmin']))
            $EmailAdmin=$_SESSION ['EmailAdmin'];
        require($rep.$vues['vueAjoutArticle']);

    }
    

    
    public function OuvrirPageAjoutFormation(){
        global $rep,$vues;
        if(isset($_SESSION ['EmailAdmin']))
            $EmailAdmin=$_SESSION ['EmailAdmin'];
        $model = new MdlAdmin();
        $tabPublics=$model->TrouverTousLesPublics();
        $tabTypesFormation=$model->TrouverTousLesTypesDeFormation();
        require($rep.$vues['vueAjoutFormation']);
    }

    public function voirInformationsDUnUtilisateur(){
        global $rep,$vues;
        if(isset($_SESSION ['EmailAdmin']))
            $EmailAdmin=$_SESSION ['EmailAdmin'];
        $ID=$_GET['id'];
        $model = new MdlAdmin();
        $utilisateur=$model->chercherUnUtilisateur($ID);
        require($rep.$vues['vueUtilisateur']);
    }


}

?>