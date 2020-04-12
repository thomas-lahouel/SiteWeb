<?php

class ControllerUser
{

    
    public function __construct() {
        global $rep,$vues;
        
     try{
        $action=$_REQUEST['action'];

        switch($action){

        case NULL:
                $this->AfficherToutesLesFormations();
                break;
        case "AfficherToutesLesFormations":
                $this->AfficherToutesLesFormations();
                break;
        case "AfficherUneFormation":
                $this->AfficherUneFormation();
                break;
        case "SeConnecter":
                $this->SeConnecter();
                break;
   
        case "AppelPageConnexion":
                $this->AppelPageConnexion();
                break;
      
      
        case "Inscription":
                $this->Inscription();
                break;
        case "ouvrirPageInscription":
                $this->ouvrirPageInscription();
                break;
        case "AppelPageVerifEmail":
                $this->AppelPageVerifEmail();
                break;
        case "VerifierEmail":
                $this->VerifierEmail();
                break;
        case "VerifQuestion":
                $this->VerifQuestion();
                break;
        case "ChangerMdp":
                $this->ChangerMdp();
                break;
            case "OuvrirLePlanning":
                $this->OuvrirLePlanning();
                break;
            case "OuvrirLeBlog":
                $this->OuvrirLeBlog();
                break;
            case"RechercherArticlesParDate":
                $this->RechercherArticlesParDate();
                break;
            case "AfficherUnArticle":
                $this->AfficherUnArticle();
                break;
            case "OuvrirLaPageContact":
                $this->OuvrirLaPageContact();
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
    
    public function AfficherToutesLesFormations()
    {
        global $rep,$vues;
        if(isset($_SESSION ['EmailClient']))
            $EmailClient=$_SESSION ['EmailClient'];
        if(isset($_SESSION ['EmailAdmin']))
            $EmailAdmin=$_SESSION ['EmailAdmin'];
        $model = new MdlUser();
        $tabFormations=$model->TrouverToutesLesFormations();
        require ($rep.$vues['vuePrincipale']);
      
    }
    
    public function AfficherUneFormation()
    {
        global $rep,$vues;
        if(isset($_SESSION ['EmailClient']))
            $EmailClient=$_SESSION ['EmailClient'];
        if(isset($_SESSION ['EmailAdmin']))
            $EmailAdmin=$_SESSION ['EmailAdmin'];
        $ID=$_GET['id'];
        $model = new MdlUser();
        $modeladmin = new MdlAdmin();
        $tabFormation=$model->TrouverUneFormationParID($ID);
        $tabMateriel=$modeladmin->TrouverToutleMateriel();
        require ($rep.$vues['vueFormation']);
    }
    
    public function SeConnecter(){
        global $rep,$vues;
        $dVueEreur[] = "";
        $email= $_POST['Email'];
        $motdepasse= $_POST['motdepasse'];
        $model = new MdlUser();
        $verifConnexion=$model->Connexion($email, $motdepasse);
        if($verifConnexion==true){
            $this->AfficherToutesLesFormations();
        }
        else{
            require($rep.$vues['vueConnexion']);
        }
            
    }
    
   
    public function AppelPageConnexion(){
        global $rep,$vues;
        require ($rep.$vues['vueConnexion']);
    }

    public function AfficherUnArticle(){
        global $rep,$vues;
        if(isset($_SESSION ['EmailClient']))
            $EmailClient=$_SESSION ['EmailClient'];
        if(isset($_SESSION ['EmailAdmin']))
            $EmailAdmin=$_SESSION ['EmailAdmin'];
        $ID=$_GET['id'];
            $model = new MdlUser();
            $tabNews=$model->SelectUnArticle($ID);
            $tabCommentaires=$model->SelectionnerTousLesCommentaires($ID);
            require ($rep.$vues['vueArticle']);


    }

    public function OuvrirLaPageContact(){
        global $rep,$vues;
        if(isset($_SESSION ['EmailClient']))
            $EmailClient=$_SESSION ['EmailClient'];
        if(isset($_SESSION ['EmailAdmin']))
            $EmailAdmin=$_SESSION ['EmailAdmin'];
        require ($rep.$vues['vueContact']);
    }

    public function OuvrirLePlanning(){
        global $rep,$vues;
        if(isset($_SESSION ['EmailClient']))
            $EmailClient=$_SESSION ['EmailClient'];
        if(isset($_SESSION ['EmailAdmin']))
            $EmailAdmin=$_SESSION ['EmailAdmin'];

        $tabDatesPrises=[];
        $model = new MdlUser();
        $tabReservations = $model->ChercherToutesLesReservations();
        $tabFormations = $model->TrouverToutesLesFormations();
        foreach($tabReservations as $r){
            $dateDebut=$r->getDateDebut();
            $dateFin=$r->getDateFin();
            $period = new DatePeriod(
                new DateTime($dateDebut),
                new DateInterval('P1D'),
                new DateTime($dateFin)

            );
            foreach ($period as $value){
                array_push($tabDatesPrises, $value->format('Y-m-d'));
            }
        }


        foreach($tabFormations as $f){
            $dateDebut=$f->getDateDebut();
            $dateFin=$f->getDateFin();
            $period = new DatePeriod(
                new DateTime($dateDebut),
                new DateInterval('P1D'),
                new DateTime($dateFin)

            );
            foreach ($period as $value){
                array_push($tabDatesPrises, $value->format('Y-m-d'));
            }
        }



        $month=$_GET['month'];
        $year=$_GET['year'];

        $daysOfWeek = array('Dimanche','Lundi','Mardi','Mercredi','Jeudi','Vendredi','Samedi');
        $firstDayOfMonth=mktime(0,0,0,$month,1,$year);
        $numberOfDays = date('t',$firstDayOfMonth);
        $dateComponents = getdate($firstDayOfMonth);
        $monthName = $dateComponents['month'];
        $dayOfWeek = $dateComponents['wday'];
        $dateToday= date('Y-m-d');
        $calendar="<table class='table table-bordered'>";
        $calendar.= "<center><h2>$monthName $year</h2>";
        $calendar.= "<a class='btn btn-xs btn-primary' href='?action=OuvrirLePlanning&month=".date('m',mktime(0,0,0,$month-1,1,$year))."&year=".date('Y',mktime(0,0,0,$month-1,1,$year))."'>Mois précédent</a>";
        $calendar.= "<a class='btn btn-xs btn-primary' href='?action=OuvrirLePlanning&month=".date('m')."&year=".date('Y')."'>Mois courant</a>";
        $calendar.= "<a class='btn btn-xs btn-primary' href='?action=OuvrirLePlanning&month=".date('m',mktime(0,0,0,$month+1,1,$year))."&year=".date('Y',mktime(0,0,0,$month+1,1,$year))."'>Mois suivant</a></center><br>";
        $calendar.="<tr>";
        foreach($daysOfWeek as $day){
            $calendar.="<th class='header'>$day</th>";
        }
        $calendar.= "</tr><tr>";

        if($dayOfWeek > 0){
            for($k=0;$k<$dayOfWeek;$k++){
                $calendar.="<td></td>";
            }
        }

        $currentDay = 1;
        $month=str_pad($month,2,"0",STR_PAD_LEFT);

        while($currentDay <= $numberOfDays){

            if($dayOfWeek==7){
                $dayOfWeek=0;
                $calendar.="</tr><tr>";
            }

            $currentDayRel = str_pad($currentDay,2,"0",STR_PAD_LEFT);
            $date = "$year-$month-$currentDayRel";
            $dayname = strtolower(date('I',strtotime($date)));
            $eventNum=0;
            $today=$date==date('Y-m-d')?"today":"";

            if($date<date('Y-m-d')){
                $calendar.="<td><h4>$currentDay</h4><button class='btn btn-danger btn-xs'>Jour passé</button>";
            }
            
            elseif(in_array($date,$tabDatesPrises)){
                $calendar.="<td><h4>$currentDay</h4><p class='btn btn-warning btn-xs'>Deja pris !</p>";
            }

            else{
                $calendar.="<td class'$today'><h4>$currentDay</h4><p class='btn btn-success btn-xs'>Libre</p>";
            }

            //$calendar.="<td><h4>$currentDay</h4>";
            $calendar.="</td>";
            $currentDay++;
            $dayOfWeek++;
        }

        if($dayOfWeek!=7){
            $remainingDays = 7-$dayOfWeek;
            for($i=0;$i<$remainingDays;$i++){
                $calendar.="<td></td>";
            }
        }

        $calendar.="</tr>";
        $calendar.="</table>";

        require ($rep.$vues['vuePlanning']);
        echo $calendar;

    }
    
  
  public function OuvrirLeBlog(){
      global $rep,$vues;
      if(isset($_SESSION ['EmailClient']))
          $EmailClient=$_SESSION ['EmailClient'];
      if(isset($_SESSION ['EmailAdmin']))
          $EmailAdmin=$_SESSION ['EmailAdmin'];
      $model = new MdlUser();
      $articlesParPage = 5;
      $articlesTotals=$model->ArticlesTotals();
      $pagesTotales = ceil($articlesTotals/$articlesParPage);
      if(isset($_GET['page']) AND !empty($_GET['page']) AND $_GET['page'] > 0 AND $_GET['page'] <= $pagesTotales) {
          $pageCourante = $_GET['page'];
      } else {
          $pageCourante = 1;
      }
      $depart = ($pageCourante-1)*$articlesParPage;
      $tabNews=$model->SelectAll($depart,$articlesParPage);
      $nbrmessages=$model->TrouverNombreDeMessages();
      require ($rep.$vues['vueBlog']);
  }

    public function RechercherArticlesParDate()
    {
        global $rep,$vues;
        if(isset($_SESSION ['EmailClient']))
            $EmailClient=$_SESSION ['EmailClient'];
        if(isset($_SESSION ['EmailAdmin']))
            $EmailAdmin=$_SESSION ['EmailAdmin'];
        $date=$_POST['date'];


        $dVueEreur[] = "";
            $date = date_create($date);
            //$date=$date." 00:00:00";
            $model = new MdlUser();
            $tabNewsD=$model->RechercherArticlesParDate($date);
            require ($rep.$vues['vueBlogArticlesParDate']);




    }
    
        
    
    public function ouvrirPageInscription(){
        /*
        global $rep,$vues;
        //$val = new Validation();
        //$verifMail=$val->verifMail($_POST['Email']);

        $verifMail = $_POST['Email'];
        if($verifMail==false){
            require($rep.$vues['vueConnexion']);
        }
        else{
            $_SESSION['mail'] = $_POST['Email'];
            $mail=$_SESSION['mail'];
            require($rep.$vues['vueInscription']);
        }
      */
        global $rep,$vues;
        $email = filter_var($_POST['Email'], FILTER_VALIDATE_EMAIL);
        $model = new MdlUser();
        $emailDejaExistant = $model->ChercherEmail($email);
        if($email != false && $emailDejaExistant==false){
            $mdl=new MdlUser();
            $tabQuestions=$mdl->getQuestions();
            require $rep.$vues['vueInscription'];
        }
        else{
            require $rep.$vues['vueConnexion'];
        }

       
    }
        
        
        
    
    
    public function Inscription()
    {
        global $rep, $vues;
        $inscription = true;

        $dVueEreur[] = "";
        $nom = $_POST['Nom'];
        $prenom = $_POST['Prenom'];
        $sexe = $_POST['Sexe'];
        $numerodetelephone = $_POST['numerodetelephone'];
        $email = filter_var($_POST['Email'], FILTER_VALIDATE_EMAIL) ;
        $motdepasse = $_POST['motdepasse'];
        $confirmotdepasse = $_POST['confirmotdepasse'];
        $quest = $_POST['Quest'];
        $reponse = $_POST['Reponse'];
        $mdl=new MdlUser();
        $tabQuestions=$mdl->getQuestions();
        $emailDejaExistant = $mdl->ChercherEmail($email);

        if($email == false){
            require($rep.$vues['vueInscription']);
        }
        elseif($emailDejaExistant==true){
            require($rep.$vues['vueInscription']);
        }

        else if(empty($motdepasse)){
            $verifMotDePasse=false;
            require($rep.$vues['vueInscription']);
        }
        else if($motdepasse!=$confirmotdepasse){
            $verifMotsDePasseEgaux=false;
            require ($rep.$vues['vueInscription']);
        }
        else if(empty($confirmotdepasse)){
            $verifConfirmeMotDePasse=false;
            require($rep.$vues['vueInscription']);
        }
        else if(empty($numerodetelephone) || empty($nom) || empty($prenom) || empty($sexe) || empty($quest) || empty($reponse)){
            $champsRemplis=false;
            require($rep.$vues['vueInscription']);
        }
        else{
            $model = new MdlUser();
            $inscription=$model->Inscription($nom, $prenom, $sexe, $numerodetelephone, $email, $motdepasse, $quest, $reponse);
            if ($inscription==true){
                require($rep.$vues['vueConnexion']);
            }
            else{
                require($rep.$vues['vueInscription']);
            }
        }
    }


    public function AppelPageVerifEmail(){
        global $rep, $vues;
        require $rep.$vues['vueVerifEmail'];
    }

    public function VerifierEmail(){
        global $rep, $vues;

        $_SESSION['email'] = $_POST['Email'];
        $email = $_SESSION['email'];

        if(filter_var($email,FILTER_VALIDATE_EMAIL)){
            $mdl = new MdlUser();
            if($mdl->VerifEmail($email)){
                $_SESSION['question'] = $mdl->getQuestionEmail($email);
                $question = $_SESSION['question'];

                require $rep.$vues['vueVerifQuestion'];
            }
            else{
                $echecEmail = true;
                require $rep.$vues['vueConnexion'];
            }
        }
        else{
            $echecEmail = true;
            require $rep.$vues['vueConnexion'];
        }
    }


    public function VerifQuestion(){
        global $rep, $vues;
        $la_rep = $_POST['LaReponse'];
        if(isset($_SESSION['question'])){
            $mdl = new MdlUser();
            if($mdl->VerifQuestion($_SESSION['email'], $la_rep)){
                require $rep.$vues['vueChangeMdp'];
            }
            else{
                $echecQuestion = true;
                require $rep.$vues['vueConnexion'];
            }
        }
    }

    public function ChangerMdp(){
        global $rep, $vues;
        $nvxMdp = $_POST['nvxMdp'];
        $nvxMdp2 = $_POST['nvxMdp2'];

        $mdl = new MdlUser();
        if($mdl->ChangementMdp($_SESSION['email'] ,$nvxMdp, $nvxMdp2)){
            $passwordChanged = true;
            require $rep.$vues['vueConnexion'];
        }
        else{
            $passwordChanged = false;
            require $rep.$vues['vueChangeMdp'];
        }
    }
    
    
    
    
    
 
    
    
    
    
    
    
    
    
}