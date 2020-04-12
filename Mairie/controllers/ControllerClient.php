<?php

class ControllerClient extends ControllerUser
{


    public function __construct()
    {
        global $rep, $vues;

        try {
            $action = $_REQUEST['action'];

            switch ($action) {
                case "ReserverLaSalle":
                    $this->ReserverLaSalle();
                    break;
                case "ReserverLaSallePerso":
                    $this->ReserverLaSallePerso();
                    break;
                case "SeDeconnecter":
                    $this->SeDeconnecter();
                    break;
                case "VoirSesFormationsReservees":
                    $this->VoirSesFormationsReservees();
                    break;
                case "OuvrirPageReservationSalle":
                    $this->OuvrirPageReservationSalle();
                    break;
                case "AjouterUnCommentaire":
                    $this->AjouterUnCommentaire();
                    break;
                case "OuvrirPageChat":
                    $this->OuvrirPageChat();
                    break;
                case "AjouterUnMessage":
                    $this->AjouterUnMessage();
                    break;
                case "OuvrirPageChat":
                    $this->OuvrirPageChat();
                    break;
                case "SupprimerLaReservation":
                    $this->SupprimerLaReservation();
                    break;
                default:
                    $dVueEreur[] = "Erreur d'appel php";
                    require($rep . $vues['erreur']);
                    break;


            }

        } catch (PDOException $e) {
            echo $e->getMessage();
            $dVueEreur[] = "Erreur inattendue PDO!!! ";
            require($rep . $vues['erreur']);

        } catch (Exception $e2) {
            $dVueEreur[] = "Erreur inattendue!!! ";
            require($rep . $vues['erreur']);
        }
    }


    public function SeDeconnecter()
    {
        session_destroy();
        header("Refresh:0; url=index.php");
        $this->AfficherToutesLesFormations();
    }

    public function SupprimerLaReservation(){
        $ID=$_GET['id'];
        $model = new MdlClient();
        $model->SupprimerLaReservation($ID);
        $this->VoirSesFormationsReservees();
    }



    public function OuvrirPageReservationSalle()
    {
        global $rep,$vues;
        if(isset($_SESSION ['EmailClient']))
            $EmailClient=$_SESSION ['EmailClient'];
        if(isset($_SESSION ['EmailAdmin']))
            $EmailAdmin=$_SESSION ['EmailAdmin'];
        $model = new MdlAdmin();
        $tabPublics = $model->TrouverTousLesPublics();
        $tabTypesFormation = $model->TrouverTousLesTypesDeFormation();
        $tabMateriel = $model->TrouverToutleMateriel();
        require($rep . $vues['vueReserverLaSalle']);
    }

    public function OuvrirPageChat(){
        global $rep,$vues;
        if(isset($_SESSION ['EmailClient']))
            $EmailClient=$_SESSION ['EmailClient'];
        if(isset($_SESSION ['EmailAdmin']))
            $EmailAdmin=$_SESSION ['EmailAdmin'];
        $model = new MdlClient();
        $tabTousLesMessagesChat = $model->SelectionnerTousLesMessages();
        require($rep.$vues['vueChat']);

    }
    public function AjouterUnMessage(){
        $pseudo = $_POST['Pseudo'];
        $message = $_POST['Message'];
        $model = new MdlClient();
        $model->AjouterUnMessage($pseudo,$message);
        $this->OuvrirPageChat();

    }

    public function ReserverLaSallePerso()
    {
        global $rep, $vues;
        $model = new MdlClient();
        $modelAdmin = new MdlAdmin();
        $tabMateriel = $modelAdmin->TrouverToutleMateriel();
        $tabPublics = $modelAdmin->TrouverTousLesPublics();
        $tabTypesFormation = $modelAdmin->TrouverTousLesTypesDeFormation();
        if(isset($_SESSION ['EmailClient']))
            $EmailClient=$_SESSION ['EmailClient'];
        if(isset($_SESSION ['EmailAdmin']))
            $EmailAdmin=$_SESSION ['EmailAdmin'];
        $nbrPersonnes = $_POST['nombrePersonnes'];
        $intitule = $_POST['Intitule'];
        $type = $_POST['Type'];
        $dateDebut = $_POST['DateDebut'];
        $dateFin = $_POST['DateFin'];
        $publicVise = $_POST['PublicVise'];
        $dateAuj = new DateTime("now");
        $dateDebut2 = date_create($dateDebut);
        $dateFin2 = date_create($dateFin);




        if($dateDebut2 > $dateFin2){
            $dateDebutSuperieure=true;
            require($rep.$vues['vueReserverLaSalle']);
            exit();
        }

        if($dateDebut2<$dateAuj){
            $dateDebutInferieurADateActuelle=true;
            require($rep.$vues['vueReserverLaSalle']);
            exit();
        }


        if(empty($nbrPersonnes) || empty($intitule) || empty($dateDebut) || empty($dateFin)){
            $champsVides=true;
            require($rep.$vues['vueReserverLaSalle']);
            exit();

        }

        if($nbrPersonnes<0){
            $nbrPersonnesZero=true;
            require($rep.$vues['vueReserverLaSalle']);
            exit();
        }


        $model->CreerUneReservationPersonelle($intitule, $type, $dateDebut, $dateFin, $publicVise, $EmailClient, $nbrPersonnes);
        $tabReservation = $model->TrouverReservation($intitule, $type, $dateDebut, $dateFin, $publicVise, $EmailClient, $nbrPersonnes);
        foreach ($tabReservation as $r) {
            $ID = $r->getID();
        }
        $tabMateriel = $modelAdmin->TrouverToutleMateriel();
        foreach ($tabMateriel as $m) {
            $designation = $m->getDesignation();
            $quantite = $_POST['quantite' . $m->getDesignation()];
            if(empty($quantite)){
                $champsVides=true;
                require($rep.$vues['vueReserverLaSalle']);
                exit();
            }
            if($quantite<0){
                $quantiteZero=true;
                require($rep.$vues['vueReserverLaSalle']);
                exit();
            }
            if($quantite>$m->getQuantite()){
                $quantiteTropGrande=true;
                require($rep.$vues['vueReserverLaSalle']);
                exit();

            }
            $model->InsererMaterielReservation($ID, $designation, $quantite);
        }
        $this->AfficherToutesLesFormations();

    }

    public function ReserverLaSalle()
    {
        global $rep, $vues;
        $nbrPersonnes = $_POST['nombrePersonnes'];
        $ID = $_GET['id'];
        $model = new MdlClient();
        $model2 = new MdlUser();
        $model3 = new MdlAdmin();
        $tabMateriel = $model3->TrouverToutleMateriel();
        $tabPublics = $model3->TrouverTousLesPublics();
        $tabTypesFormation = $model3->TrouverTousLesTypesDeFormation();
        if(isset($_SESSION ['EmailClient']))
            $EmailClient=$_SESSION ['EmailClient'];
        if(isset($_SESSION ['EmailAdmin']))
            $EmailAdmin=$_SESSION ['EmailAdmin'];

        if(empty($nbrPersonnes)){

            $this->AfficherUneFormation();
            echo "<div class='alert alert-danger d-flex justify-content-center' role='alert'>
                             VEUILLEZ ENTRER UN NOMBRE DE PERSONNES!!!
                        </div>";
            exit();
        }
        if($nbrPersonnes<0){
            $this->AfficherUneFormation();
            echo "<div class='alert alert-danger d-flex justify-content-center' role='alert'>
                             LE NOMBRE DE PERSONNES NE PEUT PAS ETRE NEGATIF !!!
                        </div>";
            exit();
        }


        $tabFormation = $model2->TrouverUneFormationParID($ID);

        foreach ($tabMateriel as $m) {
            $designation = $m->getDesignation();
            $quantite = $_POST['quantite' . $m->getDesignation()];
            if(empty($quantite)){
                $this->AfficherUneFormation();
                echo "<div class='alert alert-danger d-flex justify-content-center' role='alert'>
                             CERTAINS CHAMPS DE QUANTITES SONT VIDES !!!
                        </div>";
                exit;
            }
            if($quantite<0){
                $this->AfficherUneFormation();
                echo "<div class='alert alert-danger d-flex justify-content-center' role='alert'>
                             LA QUANTITE NE PEUT PAS ETRE UN CHIFFRE NEGATIF !!!
                        </div>";
                exit;
            }
            if($quantite>$m->getQuantite()){
                $this->AfficherUneFormation();
                echo "<div class='alert alert-danger d-flex justify-content-center' role='alert'>
                              LA QUANTITE DEMANDEE EST SUPERIEUR A CE QUI EST DISPONIBLE POUR CERTAINS OBJETS !!!
                        </div>";
                exit;

            }
            $model->InsererFormationReservee($ID, $nbrPersonnes, $EmailClient);
            $model->InsererMaterielReservation($ID, $designation, $quantite);
        }
        $model->SupprimerFormation($ID);

        $this->AfficherToutesLesFormations();
    }

    public function VoirSesFormationsReservees()
    {
        global $rep,$vues;
        if(isset($_SESSION ['EmailClient']))
            $EmailClient=$_SESSION ['EmailClient'];
        if(isset($_SESSION ['EmailAdmin']))
            $EmailAdmin=$_SESSION ['EmailAdmin'];
        $model = new MdlClient();
        $tabReserv = $model->ChercherReservations($EmailClient);
        require($rep . $vues['vueReservationSalle']);

    }

    public function AjouterUnCommentaire()
    {

        $pseudo = $_POST['pseudo'];
        $commentaire = $_POST['commentaire'];
        $pseudo = str_replace(' ', '', $pseudo);
        $ArticleID = $_GET['id'];


            $modelU = new MdlClient();
            $modelU->AjouterUnCommentaire($pseudo, $commentaire, $ArticleID);
            $this->AfficherUnArticle();

        }
    }

?>