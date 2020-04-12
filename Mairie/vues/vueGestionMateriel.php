<html>
<head>
    <title>Gestion du matériel</title>
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

    <div class="row row-cols-3 jumbotron bg-info">
        <div class="jumbotron bg-dark col">
            <h2 class="text-info">Supprimer du matériel</h2>
            <hr class="bg-light">
            <?php
            if(isset($tabMateriel) && !empty($tabMateriel)){
                foreach($tabMateriel as $m){
                    echo "<div class='bg-info'>
                            Il y a ".$m->getQuantite()." ".$m->getDesignation()." <br>
                            <a class='text-danger' href='?action=SupprimerUnMateriel&id=".$m->getID()."'><span>Supprimer le materiel</span></a>
                        </div>";
                    /*
                    if($m->getQuantite() > 1){
                        echo"s";
                    }
                    */
                    echo"";
                    echo "<br>";
                }
            }
            ?>
        </div>

        <div class="jumbotron bg-dark col">
            <h2 class="text-info">Modifier les quantités déjà existantes</h2>
            <hr class="bg-light">
            <form method="post" action="?action=vueConnexion.php">
                <div class="bg-info p-4 mb-4">

                    <?php
                    if(isset($tabMateriel) && !empty($tabMateriel)){
                        echo"<div class='form-group'>
                    <label for='type' class='ml-2'>Intitule</label>
                     <select name ='Intitule' id = 'intitule' class='form-control m-1 form-pill'>";

                        foreach($tabMateriel as $m){
                            echo "<option value = ".$m->getDesignation().">".$m->getDesignation()."</option>";

                        }
                        echo"</select></div>";

                    }
                    else{
                        echo "<div class='alert alert-danger' role='alert'>Il n'y aucun matériel crée, veuillez en créer s'il vous plaît...</div>";
                    }

                    ?>
                    <div class="form-group">
                        <label for="Quantite" class="ml-2">Nouvelle quantité</label>
                        <input name="Quantite" type="text" class="form-control m-1 form-pill" placeholder="Veuillez entrer la nouvelle quantité pour le matériel choisi" id="quantite">
                    </div>
                    <div>
                        <input class="btn btn-dark" type='submit' name='action'  value='MettreAJourDuMateriel'>
                    </div>
            </form>
        </div>
    </div>
<div class="jumbotron bg-dark col">
    <h2 class="text-info">Ajouter du matériel</h2>
    <hr class="bg-light">
    <form method="post" action="?action=vueConnexion.php">
        <div class="bg-info p-4 mb-4">
            <div class="form-group">
                <label for="Intitule" class="ml-2">Intitule</label>
                <input name="Intitule" type="text" class="form-control m-1 form-pill" placeholder="Intitule" id="intitule" required>
            </div>
            <div class="form-group">
                <label for="Quantite" class="ml-2">Description</label>
                <input name="Quantite" type="number" class="form-control m-1 form-pill" placeholder="Quantite pour le matériel" id="quantite" required>
            </div>
            <div>
                <input class="btn btn-dark" type='submit' name='action'  value='AjouterLeMateriel'>
            </div>
    </form>
</div>



</body>
</html>