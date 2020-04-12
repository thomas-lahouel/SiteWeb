<html lang="en">
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


      <div class="jumbotron" style="background-image: url('images/brioude.jpg'); height: 700px;">
          <h1 class="display-4 nav justify-content-center">Salle de formation de la mairie de Brioude</h1>
          <p class="lead nav justify-content-center">Bienvenue sur le site de la salle de formation de la mairie de Brioude.</p>
          <?php
          if(isset($EmailAdmin)){
              echo"<p class='nav justify-content-center'><a class='btn btn-info px-4 py-3' href='?action=OuvrirPageAjoutFormation'>Ajoutez une formation !</a></p>";
          }
          else if(isset($EmailClient)){
              echo"<p class='nav justify-content-center'><a class='btn btn-info px-4 py-3' href='?action=OuvrirPageReservationSalle'>Reservez la salle dès maintenant !</a></p>";
          }
          else{
              echo"<p class='nav justify-content-center'><a href='?action=AppelPageConnexion' class='btn btn-info px-4 py-3'>S'identifier</a></p>";
          }
          ?>
      </div>


      <?php
        if(!empty($tabFormations)){
            foreach($tabFormations as $form){
            echo "<div class='jumbotron bg-info'>
                        <h4 class='display-4'>".$form->getIntitule()."</h4>
                        <hr class='my-4'>
                        <div class='bg-dark p-4 mb-4'>
                            <p class='ml-2 text-light'>".$form->getDescription()."</p>
                            <a class='text-info' href=?action=AfficherUneFormation&id=".$form->getID().">En savoir plus</a>
                        </div>
                   </div>";
            }
        }
        else{
            echo "<p class='ml-2 text-light'>Aucune formation proposée...</p>";
        }
      ?>
      
  </body>
</html>
