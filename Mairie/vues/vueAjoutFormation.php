<html>
<head>
    <title>Ajouter une formation</title>
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
        <h1>Proposez une nouvelle formation</h1>
        <hr class="my-4">
        <form method="post" action="?action=vueConnexion.php">
            <?php
            if(isset($dateDebutInferieurADateActuelle) && $dateDebutInferieurADateActuelle==true){
                echo "<div class='alert alert-danger d-flex justify-content-center' role='alert'>
                LA DATE DE DEBUT DE LA FORMATION NE PEUT PAS ETRE INFERIEURE A LA DATE D'AUJOURD'HUI !!!
            </div>";
            }
            elseif(isset($dateDebutSuperieure) && $dateDebutSuperieure==true){
                echo "<div class='alert alert-danger d-flex justify-content-center' role='alert'>
                             LA DATE DE DEBUT NE PEUT PAS ETRE SUPERIEURE A CELLE DE FIN !!!
                        </div>";
            }
            elseif(isset($champsVides) && $champsVides==true){
                echo "<div class='alert alert-danger d-flex justify-content-center' role='alert'>
                                     CERTAINS CHAMPS SONT VIDES !!!
                      </div>";
            }
            ?>
            <div class="jumbotron bg-dark p-4 mb-4">
                <div class="form-group">
                    <label for="Intitule" class="ml-2 text-info">Intitule</label>
                    <input name="Intitule" type="text" class="form-control m-1 form-pill" placeholder="Intitule" id="intitule">
                </div>
                <div class="form-group">
                    <label for="Description" class="ml-2 text-info">Description</label>
                    <input name="Description" type="text" class="form-control m-1 form-pill" placeholder="Description" id="description">
                </div>
                <?php
                if(isset($tabTypesFormation) && !empty($tabTypesFormation)){
                    echo"<div class='form-group'>
                    <label for='type' class='ml-2 text-info'>Type de formation</label>
                     <select name ='Type' id = 'type' class='form-control m-1 form-pill'>";

                    foreach($tabTypesFormation as $type){
                        echo "<option value = ".$type->getDesignation().">".$type->getDesignation()."</option>";
                    }
                    echo"</select></div>";

                }
                else{
                    echo "<div class='alert alert-danger' role='alert'>Il n'y aucun type de formation crée, veuillez en créer un s'il vous plaît...</div> ";
                }



                ?>
                <div class="form-group">
                    <label for="DateDebut" class="ml-2 text-info">Date de début</label>
                    <input name="DateDebut" type="date" class="form-control m-1 form-pill" placeholder="Date de début : AAAA-MM-JJ HH:MM:SS" id="datedebut">
                </div>
                <div class="form-group">
                    <label for="DateFin" class="ml-2 text-info">Date de fin</label>
                    <input name="DateFin" type="date" class="form-control m-1 form-pill" placeholder="Date de fin : AAAA-MM-JJ HH:MM:SS" id="datefin">
                </div>

                <?php
                if(isset($tabPublics) && !empty($tabPublics)){
                    echo"<div class='form-group'>
                    <label for='PublicVise' class='ml-2 text-info'>PublicVise</label>
                     <select name ='PublicVise' id = 'publicvise' class='form-control m-1 form-pill'>";

                    foreach($tabPublics as $public){
                        echo "<option value = ".$public->getDesignation().">".$public->getDesignation()."</option>";
                    }
                    echo"</select></div>";
                    echo"<div>
                             <input class='btn btn-info' type='submit' name='action'  value='AjouterUneFormation'>
                            </div>";
                }
                else{
                    echo "<div class='alert alert-danger' role='alert'>Aucun public n'est proposé, veuillez en créer un s'il vous plaît...</div>";
                }



                ?>
            </div>
        </form>
    </div>
</div>
</body>
</html>