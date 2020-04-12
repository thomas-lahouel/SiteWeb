<html>
<head>
    <title>Inscription</title>
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

<div class="jumbotron bg-info">
    <?php
    if(isset($verifMotsDePasseEgaux) && $verifMotsDePasseEgaux==false){
        echo "<div class='alert alert-danger d-flex justify-content-center' role='alert'>
                         LES MOTS DE PASSE NE SONT PAS EGAUX !!!
                    </div>";
    }
    else if(isset($verifConfirmeMotDePasse) && $verifConfirmeMotDePasse==false){
        echo "<div class='alert alert-danger d-flex justify-content-center' role='alert'>
                         VEUILLEZ CONFIRMER LE MOT DE PASSE !!!
                    </div>";
    }
    else if(isset($verifMotDePasse) && $verifMotDePasse==false){
        echo "<div class='alert alert-danger d-flex justify-content-center' role='alert'>
                         VEUILLEZ ENTRER UN MOT DE PASSE !!!
                    </div>";
    }
    else if(isset($emailDejaExistant) && $emailDejaExistant==true){
        echo "<div class='alert alert-danger d-flex justify-content-center' role='alert'>
                         CETTE ADRESSE MAIL EST DEJA UTILISEE !!!
                    </div>";
    }
    else if(isset($email) && $email==false){
        echo "<div class='alert alert-danger d-flex justify-content-center' role='alert'>
                         VEUILLEZ ENTRER UNE VERITABLE ADRESSE MAIL !!!
                    </div>";
    }
    else if(isset($champsRemplis) && $champsRemplis==false){
        echo "<div class='alert alert-danger d-flex justify-content-center' role='alert'>
                         UN OU PLUSIEURS CHAMPS SONT VIDES !!!
                    </div>";
    }

    ?>

    <form method="post" action="?action=Inscription">
        <div class="bg-dark p-4 mb-4">
            <div class="form-group">
                <label for="Nom" class="ml-2 text-info">Nom</label>
                <input name="Nom" type="text" class="form-control m-1 form-pill" placeholder="Nom" id="Nom">
            </div>
            <div class="form-group">
                <label for="Prenom" class="ml-2 text-info">Prenom</label>
                <input name="Prenom" type="text" class="form-control m-1 form-pill" placeholder="Prenom" id="Prenom">
            </div>
            <div>
                <label for="Sexe" class="ml-2 text-info">Sexe</label>
                <select id="Sexe" name="Sexe">
                    <option value="NonRenseigne" id="NonRenseigne">NonRenseigne</option>
                    <option value="Homme" id="Homme">Homme</option>
                    <option value="Femme" id="Femme">Femme</option>
                </select>
            </div>
            <div class="form-group">
                <label for="numerodetelephone" class="ml-2 text-info">Numéro de téléphone</label>
                <input name="numerodetelephone" type="text" class="form-control m-1 form-pill" placeholder="Numéro de téléphone" id="numerodetelephone">
            </div>
            <div class="form-group">
                <label for="mail" class="ml-2 text-info">Email</label>
                <?php
                if(isset($email)){
                    echo "<input name='Email' value=".$email." type='text' class='form-control m-1 form-pill'>";
                }
                else{
                    echo "<input name='Email' type='text' placeholder='Pseudo' class='form-control m-1 form-pill'>";
                }?>
            </div>
            <div class="form-group">
                <label for="motdepasse" class="ml-2 text-info">Mot de passe</label>
                <input name="motdepasse" type="password" class="form-control m-1 form-pill" placeholder="Mot de passe" id="motdepasse">
            </div>
            <div class="form-group">
                <label for="confirmotdepasse" class="ml-2  text-info">Confirmer le mot de passe</label>
                <input name="confirmotdepasse" type="password" class="form-control m-1 form-pill" placeholder="Mot de passe" id="confirmotdepasse">
            </div>
            <div class="form-group">
                <label for="Questions" class="ml-2  text-info">Veuillez choisir une question. Elle nous sera utile si vous venez à perdre votre mot de passe</label>
                <select id="Quest" name="Quest">
                    <?php
                    if(!empty($tabQuestions)){
                        foreach ($tabQuestions as $question){
                            echo "<option id='".$question->getID()."'>".$question->getQuest()."</option>";
                        }
                    }
                    ?>
                </select>
                <div class="form-group">
                    <label for="Reponse" class="ml-2 text-info">Répondez à la question sélectionnée ici</label>
                    <input name="Reponse" type="text" class="form-control m-1 form-pill" placeholder="Reponse" id="Reponse">
                </div>
            </div>


            <input type="submit" name='action' class="btn btn-info"  value="Inscription">
        </div>
    </form>
</div>
        

  
        
         <div class="col-md-6 ">
           
            

          </div>

        
       
    </body>
</html>
