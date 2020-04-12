<?php

//gen
$rep=__DIR__.'/../';

// liste des modules à inclure

//$dConfig['includes']= array('controleur/Validation.php');



//BD

/*
$base="mysql:host=cfaifrnfzyg3.mysql.db;dbname=cfaifrnfzyg3";
$login="cfaifrnfzyg3";
$mdp="Aiut2020";
*/


$base="mysql:host=localhost;dbname=dbsalleformation2";
$login="root";
$mdp="";


//Vues
$vues['vueContact']='vues/vueContact.php';
$vues['vueChat']='vues/vueChat.php';
$vues['vueBlog']='vues/vueBlog.php';
$vues['vueAjoutArticle']='vues/vueAjoutArticle.php';
$vues['vueArticle']='vues/vueArticle.php';
$vues['vueBlogArticlesParDate']='vues/vueBlogArticlesParDate.php';
$vues['vuePlanning']='vues/vuePlanning.php';
$vues['vueReserverLaSalle']='vues/vueReserverLaSalle.php';
$vues['vueGestionMateriel']='vues/vueGestionMateriel.php';
$vues['vuePrincipale']='vues/vuePrincipale.php';
$vues['vueFormation']='vues/vueFormation.php';
$vues['vueReservationSalle']='vues/vueReservationSalle.php';
$vues['erreur']='vues/erreur.php';
$vues['vueConnexion']='vues/vueConnexion.php';
$vues['vueAjoutFormation']='vues/vueAjoutFormation.php';
$vues['vueInscription']='vues/vueInscription.php';
$vues['vueGestionUtilisateurs']='vues/vueGestionUtilisateurs.php';
$vues['vueUtilisateur']='vues/vueUtilisateur.php';
$vues['vueVerifEmail']='vues/vueVerifEmail.php';
$vues['vueVerifQuestion']='vues/vueVerifQuestion.php';
$vues['vueChangeMdp']='vues/vueChangeMdp.php';


?>