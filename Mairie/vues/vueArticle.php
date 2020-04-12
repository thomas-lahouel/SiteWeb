<!DOCTYPE html>
<html lang="en">

<head>
    <title>Consultez cet article</title>
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

<header class="masthead bg-info">
    <div class="overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">
                <div class="post-heading">
                    <?php
                    if(isset($tabNews)){
                        foreach($tabNews as $n){
                            echo "<center><h1>".$n->getTitre()."</h1></center>";
                        }
                    }
                    ?>

                </div>
            </div>
        </div>
    </div>
    <hr class="bg-dark">
    <article class="bg-info">
        <div class="container d-flex align-items-center justify-content-center">
            <div class="row">
                <div>
                    <?php
                    if(isset($tabNews)){
                        foreach($tabNews as $n){
                            echo "<h3>".$n->getContenu()."</h3>";
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </article>
</header>


<hr class="bg-light">

<?php
if(isset($tabCommentaires)){
    foreach($tabCommentaires as $c){
        echo "<div class='jumbotron bg-info'>
                    <h2>Auteur : ".$c->getAuteur()."</h2>
                    <time>Heure : ".$c->getDate()."</time>"."<br>
                    <label>Commentaire : ".$c->getCommentaire()."</label>
            </div>";


    }
}
else echo "<label class='text-danger'> Aucun commentaire, soyez le premier à en ajouter un !</label>";
?>

<br>
<footer>
    <div class="d-flex align-items-center justify-content-center">
        <div class="jumbotron bg-info">
            <h3>Ajoutez votre commentaire</h3>
            <form method="post" action="" class="form-example">
                <div>
                    <label for='Pseudo'>Pseudo :  </label>
                    <?php

                    if(isset($EmailClient))
                        echo "<input name='pseudo' value=".$EmailClient." type='text' size='20'>";
                    elseif(isset($EmailAdmin))
                        echo "<input name='pseudo' value=".$EmailAdmin." type='text' size='20'>";
                    else{
                        echo "<input name='pseudo' type='text' size='20'>";
                    }?>

                </div>
                <div>
                    <label for="Commentaire">Commentaire :  </label>
                    <input name="commentaire" type="text" size="20">
                </div>
                <div>
                    <input class="btn btn-dark" type="submit" name='action' value="AjouterUnCommentaire">
                </div>
            </form>
        </div>
    </div>
</body>

</html>