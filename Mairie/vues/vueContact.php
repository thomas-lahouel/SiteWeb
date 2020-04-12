<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '.\PHPMailer\src\Exception.php';  //SI LE PHPMAILER VOUS LE CHANGEZ DE POSITION VEUILLEZ METTRE LE NOM DU DOSSIER POUR LES REQUIRE
require '.\PHPMailer\src\PHPMailer.php';
require '.\PHPMailer\src\SMTP.php';




if(isset($_POST['mailform'])){
    if(!empty($_POST['nom']) && !empty($_POST['objet']) && !empty($_POST['mail']) && !empty($_POST['message'])){
        $nom = $_POST['nom'];
        $objet = $_POST['objet'];
        $email = $_POST['mail'];
        $message = $_POST['message'];

        $mail = new PHPMailer(true);

        try {
            //Server settings (serveur smtp)
            $mail->SMTPDebug = 0;                      // Enable verbose debug output
            $mail->isSMTP();                                            // Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                   // Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   // Enable SMTP authentication //mail factice d'envoi
            $mail->Username   = 'contact.mairie43@gmail.com';           // SMTP username
            $mail->Password   = 'adminroot1234';                               // SMTP password
            $mail->SMTPSecure = 'ssl';        // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged  ssl->gmail
            $mail->Port       = 465;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

            //Recipients
            $mail->setFrom('ne-pas-repondre@admin.com', 'Administrateur'); // envoyeur
            $mail->addAddress('stormixtv@gmail.com');     // Add a recipient  (destinataire) ie mail de l'ADMIN
            //$mail->addAddress('ellen@example.com');               // Name is optional

            //$mail->addReplyTo('info@example.com', 'Information');  // on recoit par mail et reponds a une autre adresse mail
            //$mail->addCC('cc@example.com');
            //$mail->addBCC('bcc@example.com');

            // Attachments // piece jointes
            //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
            //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

            // Content
            $mail->isHTML(false);                                  // Set email format to HTML
            $mail->Subject = $objet;
            //$mail->Body    = 'This is the HTML message body <b>in bold!</b>';

            $mail->Body = "Nom de l'expéditeur : ".$nom." ," ."\n".
                "Mail de l'expéditeur : ".$email."," ."\n".
                "Message de l'expéditeur : ".$message . "\n";

            $mail->send();
            echo 'Votre message a bien été envoyé !';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }

    }
    else{
        $msg = 'Tout les champs doivent être complétés ';
    }

}


?>

<html>
<head>
    <title>Contactez-nous</title>
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
        <div id="divContact">
            <form method="POST" action="">
                <h2 class="d-flex align-items-center justify-content-center">Vous souhaitez nous contacter ?</h2>
                <hr class="bg-dark">
                <div class="form-group">
                    <label class="text-dark">Veuillez renseigner votre nom :</label>
                    <input type="text" name="nom" placeholder="Votre nom" value="<?php if(isset($_POST['nom'])) echo $_POST['nom'] ?>" /><br /><br />
                </div>
                <div class="form-group">
                    <label class="text-dark">Quel est l'objet de ce mail ?</label>
                    <input type="text" name="objet" placeholder="Objet " value="<?php if(isset($_POST['objet'])) echo $_POST['objet'] ?>" /><br /><br />
                </div>
                <div class="form-group">
                    <label class="text-dark">Renseignez l'adresse à laquelle nous pourrons vons contacter :</label>
                    <input type="email" name="mail" placeholder="Votre email" value="<?php if(isset($_POST['mail'])) echo $_POST['mail'] ?>"><br /><br />
                </div>
                <div class="form-group">
                    <label class="text-dark">Nous somme à votre écoute : </label><br>
                    <textarea name="message" cols="75" rows="5" placeholder="Veuillez renserigner votre message" ></textarea>
                </div>
                <input type="submit" value="Envoyer" name="mailform" class="btn btn-dark">


                <?php
                if(isset ($msg)){
                    echo $msg;
                }
                ?>

            </form>
        </div>
    </div>
</div>




<div id="divContact">

</div>
</html>