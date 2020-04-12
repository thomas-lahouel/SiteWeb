<html>
<head>
    <title>Connectez-vous</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
    <body class="bg-dark">

    <nav class="navbar navbar-expand-lg navbar-light bg-dark">
        <div class="collapse navbar-collapse justify-content-end" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <a class="nav-link text-primary" href="?action=AfficherToutesLesFormations"><span>Accueil</span></a>
            </div>
        </div>
    </nav>

    <?php

    if(isset($verifConnexion)&& $verifConnexion==false){
        echo "<div class='alert alert-danger d-flex justify-content-center' role='alert'>L'IDENTIFIANT OU LE MOT DE PASSE EST INCORRECT !!!</div>";
    }

    if(isset($email) && $email==false){

        echo "<div class='alert alert-danger d-flex justify-content-center' role='alert'>VEUILLEZ ENTRER UNE VERITABLE ADRESSE MAIL !!!</div>";

    }

    if(isset($emailDejaExistant) && $emailDejaExistant==true){

        echo "<div class='alert alert-danger d-flex justify-content-center' role='alert'>CET UTILISATEUR EXISTE DEJA, ESSAYEZ DE VOUS CONNECTER !!!</div>";

    }

    if(isset($inscription) && $inscription==true){
        echo "<div class='alert alert-success d-flex justify-content-center' role='alert'>Vous pouvez maintenant vous connecter !</div>";
    }

    if(isset($passwordChanged) && $passwordChanged==true){
        echo "<div class='alert alert-success d-flex justify-content-center' role='alert'>VOTRE MOT DE PASSE A BIEN ETAIT CHANGE !</div>";
    }

    if (isset($echecEmail)) {
        echo "<div class='alert alert-danger d-flex justify-content-center' role='alert'>CET EMAIL N'EXISTE PAS !</div>";
    }

    if (isset($echecQuestion)){
        echo "<div class='alert alert-danger d-flex justify-content-center' role='alert'>VOUS N'AVEZ PAS SU REPONDRE A LA QUESTION !</div>";
    }

    ?>

    <div class="jumbotron bg-info">
        <h1 class="display-4">J'ai un compte :</h1>
        <hr class="my-4">
        <form method="post" action="?action=SeConnecter">
            <div class="bg-dark p-4 mb-4">
                <div class="form-group">
                    <label for="Email" class="ml-2 text-info">Email</label>
                    <input name="Email" type="text" class="form-control m-1 form-pill" placeholder="Email" >
                </div>
                <div class="form-group">
                    <label for="motdepasse" class="ml-2 text-info">Mot de passe</label>
                    <input name="motdepasse" type="password" class="form-control m-1 form-pill" placeholder="Mot de passe" id="motdepasse">
                </div>
                <input type="submit" name='action'  value="SeConnecter" class="btn btn-info">
                <br>
                <a href="?action=AppelPageVerifEmail"><span class="text-info">Mot de passe oublié?</span></a>
            </div>
        </form>
    </div>

    <div class="jumbotron bg-info">
        <h1 class="display-4">Je n'ai pas de compte :</h1>
        <hr class="my-4">
        <p>Veuillez insérer votre adresse mail afin d'être redirigé vers la page d'inscription</p>
        <form method="post" action="?action=ouvrirPageInscription">
            <div class="bg-dark p-4 mb-4">
                <div class="form-group">
                    <label for="Email" class="ml-2 text-info">Email</label>
                    <input name="Email" id="Email" type="text" class="form-control m-1 form-pill" placeholder="Email" >
                </div>
                <input type="submit" name='action'  value="ouvrirPageInscription" class="btn btn-info">
            </div>
        </form>
    </div>

    </body>
</html>


