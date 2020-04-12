<html>
<head>
    <title>Changement mot de passe</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body class="bg-dark d-flex align-items-center justify-content-center">
<div class="jumbotron bg-info">
    <?php
    if(isset($passwordChanged) && $passwordChanged==false){
        echo "<div class='alert alert-danger d-flex justify-content-center' role='alert'>VEUILLEZ RENSEIGNER LE MEME MOT DE PASSE</div>";
    }
    ?>
    <h1 class="display-4">Choisissez un nouveau mot de passe :</h1>
    <hr class="my-4">
    <form method="post" action="?action=ChangerMdp">
        <div class="bg-dark p-4 mb-4">
            <div class="form-group">
                <label for="nvxMdp" class="ml-2 text-info">Nouveau mot de passe</label>
                <input name="nvxMdp" type="password" class="form-control m-1 form-pill" placeholder="Nouveau mot de passe" id="nvxMdp">
            </div>
            <div class="form-group">
                <label for="nvxMdp2" class="ml-2 text-info">Confirmez votre nouveau mot de passe</label>
                <input name="nvxMdp2" type="password" class="form-control m-1 form-pill" placeholder="Confirmer mot de passe" id="nvxMdp2">
            </div>
            <button type="submit" class="btn btn-info">Confirmer</button>
        </div>
    </form>
</div>
</body>
</html>