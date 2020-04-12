<html>
<head>
    <title>Verification question</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body class="bg-dark d-flex align-items-center justify-content-center">
<div class="jumbotron bg-info">
    <h1 class="display-4">Nous vérifions votre identité :</h1>
    <hr class="my-4">
    <form method="post" action="?action=VerifierEmail">
        <?php
        if(!empty($email)){
            echo "<p>Votre email est le suivant : <b>$email</b></p>";
        }
        ?>
        <?php
        if(!empty($question)){
            echo "<label for='Question'><b>".$question[0]['Question']."</b></label>";
        }
        ?>
    </form>
    <form method="post" action="?action=VerifQuestion">
        <div class="bg-dark p-4 mb-4">
            <p class="text-info">Merci de répondre ci-dessous</p>
            <input name="LaReponse" type="text" class="form-control m-1 form-pill" id="LaReponse">
            <button type="submit" class="btn btn-info" >Suivant</button>
        </div>
    </form>
</div>
<div>

</div>




</body>
</html>






<?php
?>