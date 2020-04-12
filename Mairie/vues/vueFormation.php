<html>
<head>
    <title>Bienvenue</title>
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

<div class="d-flex align-items-center justify-content-center">
    <div class="jumbotron bg-info">
        <h1 class="display-4">Réservez la salle pour cette formation</h1>
        <hr class="bg-dark">
        <?php

        if(isset($tabFormation)){
            foreach($tabFormation as $f){
                echo "<center><label>Intitulé de la formation : <strong>".$f->getIntitule()."</strong></label></center>";
                echo "<center><label>Description de la formation : <strong>".$f->getDescription()."</strong></label></center>";
                echo "<center><label>Type de la formation : <strong>".$f->getType()."</strong></label></center>";
                echo "<center><label>Date de début de la formation : <strong>".$f->getDateDebut()."</strong></label></center>";
                echo "<center><label>Date de fin de la formation : <strong>".$f->getDateFin()."</strong></label></center>";
                echo "<center><label>Public visé pour cette formation : <strong>".$f->getPublicVise()."</strong></label></center>";
            }
        }
        ?>
            <form  method="post" action="" class="form-example">
                <div>
                    <center>
                    <label for='NombrePersonnes'>Nombre de personnes prévu : </label>
                    <?php
                    if(isset($pseudocommentaireS)){
                        echo "<input name='pseudo' value=".$pseudocommentaireS." type='text' size='20'>";
                    }
                    else{
                        echo "<input name='nombrePersonnes' type='text' size='20' required>";
                    }
                    echo "<br>";

                    echo"Voici tout le matériel disponible. Veuillez renseigner les quantités désirées pour votre formation : <br>";


                    if(isset($tabMateriel) && !empty($tabMateriel)){
                        foreach($tabMateriel as $m){
                            echo"Il y a ".$m->getQuantite()." ";
                            echo $m->getDesignation();
                            if($m->getQuantite() > 1){
                                echo"s";
                            }

                            echo "<br>";
                            echo "<input name='quantite".$m->getDesignation()."' placeholder='Quantite désirée' type='text' size='20' required>";
                            echo"<br>";
                        }
                    }
                    echo "<br>";
                    ?>
                    </center>
                </div>
                <div class="d-flex align-items-center justify-content-center">
                    <input class="btn btn-dark" type="submit" name='action' value="ReserverLaSalle">
                </div>
            </form>
    </div>
</div>


    </body>
</html>