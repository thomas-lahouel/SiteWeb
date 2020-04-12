<html>
<head>
    <title>Vos réservations</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body class="bg-dark">
<nav class="navbar navbar-expand-lg navbar-light bg-dark">
    <div class="collapse navbar-collapse" id="navbarNavDropdown1">
        <ul class="navbar-nav ml-auto">
            <?php
            if(isset($EmailClient) && !(isset($EmailAdmin))) {
                echo "<p class='nav-link text-primary'>" . $EmailClient . "</p>";
                echo "<li class='nav-item'>
                <a class='nav-link d-flex align-items-center text-danger' href='?action=SeDeconnecter'><span>Se deconnecter</span></a>
              </li>";
            }
            else{
                if(isset($EmailAdmin)) {
                    echo "<p class='nav-link text-primary'>" . $EmailAdmin . "</p>";
                }
            }?>
            <li class="nav-item active">
                <a class="nav-link d-flex align-items-center text-primary" href="?action=AfficherToutesLesFormations"><span>Accueil</span></a>
            </li>
            <li class="nav-item ">
                <a class="nav-link d-flex align-items-center text-primary" href="?action=OuvrirLeBlog"><span>Blog</span></a>
            </li>
            <li class="nav-item ">
                <a class="nav-link d-flex align-items-center text-primary" href="?action=OuvrirPageChat"><span>Chat</span></a>
            </li>
            <li class="nav-item ">
                <a class="nav-link d-flex align-items-center text-primary" href="?action=OuvrirLaPageContact"><span>Contact</span></a>
            </li>

            <li class="nav-item ">
                <?php
                $dateComponents=getdate();
                $year = $dateComponents['year'];
                $month = $dateComponents['mon'];
                echo"<a class='nav-link d-flex align-items-center text-primary' href='?action=OuvrirLePlanning&month=".$month."&year=".$year."'>Planning</a>";
                ?>
            </li>
            <li class="nav-item">
                <?php
                echo"<li class='nav-item'>
                <a class='nav-link d-flex align-items-center text-primary' href='?action=OuvrirPageReservationSalle'><span>Réserver la salle</span></a>
              </li>";

                if(isset($EmailAdmin)){
                    echo"<li class='nav-item'>
                <a class='nav-link d-flex align-items-center text-danger' href='?action=SeDeconnecterA'><span>Se deconnecter</span></a>
              </li>";
                    echo"<li class='nav-item'>
                <a class='nav-link d-flex align-items-center text-primary' href='?action=OuvrirPageAjoutFormation'><span>Ajouter une formation</span></a>
              </li>";
                    echo"<li class='nav-item'>
                <a class='nav-link d-flex align-items-center text-primary' href='?action=OuvrirPageGererUtilisateurs'><span>Gérer les utilisateurs</span></a>
              </li>";
                    echo"<li class='nav-item'>
                <a class='nav-link d-flex align-items-center text-primary' href='?action=OuvrirPageGererMateriel'><span>Gérer le matériel</span></a>
              </li>";
                    echo"<li class='nav-item'>
                <a class='nav-link d-flex align-items-center text-primary' href='?action=OuvrirPageAjoutArticle'><span>Ajouter un article</span></a>
              </li>";
                }
                else {
                    if (!isset($EmailClient)) {
                        echo "<a class='nav-link d-flex align-items-center text-primary' href='?action=AppelPageConnexion'>S'identifier</a>
                        
                        </li>";

                    }
                }
                ?>
            </li>
            <li class="nav-item">
                <?php
                if(isset($EmailClient)){
                    echo"<a class='nav-link d-flex align-items-center text-primary' href='?action=VoirSesFormationsReservees'><span>Mes réservations</span></a>";
                }
                ?>
            </li>
        </ul>
    </div>
</nav>

<h1 class="d-flex align-items-center justify-content-center text-info">Consultez ici vos réservations</h1>
<hr class="bg-light">

<?php


        if(!empty($tabReserv)){
            foreach($tabReserv as $r){
            echo "<div class='jumbotron bg-info'>
                        <h2 class='display-4'>La formation a pour nom : '<strong>".$r->getIntitule()."</strong>'</h2>
                        <h3>Sont attendues ".$r->getNbrPersonnes()." personnes.</h3>
                        <a class='btn btn-dark' href='?action=SupprimerLaReservation&id=".$r->getID()."'<span>Supprimer cette reservation</span></a>
                    </div>";
            }
        }
        else{
            echo "<div class='alert alert-warning' role='alert'>Aucune reservation pour cet utilisateur...</div>";
        }
        
?>

    </body>
</html>