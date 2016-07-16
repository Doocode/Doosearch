<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, minimum-scale=1.0, initial-scale=1.0">
        <link rel="stylesheet" href="res/css/animate.css" />
        <link rel="stylesheet" href="res/css/main.css" />
        <link rel="stylesheet" href="res/css/header.css" />
        <link rel="stylesheet" href="res/css/index.css" />
        <link rel="stylesheet" href="res/css/contact.css" />
		<link rel="icon" type="image/png" href="res/img/favicon.png" />
        <title>Doosearch > Nous contacter</title>
    </head>

    <body>
        <?php include("res/php/header.php"); ?>
		
		<div class="presentation" style="background-image: url(res/img/contact.png);">
			<h1>Nous contacter</h1>
		</div>
		
		<div class="page">
			<?php
				if(!isset($_POST['subject']) AND !isset($_POST['content']))
				{
			?>
			<form method="post" action="contact.php">
				<p><label for="title">Titre du message</label><input type="text" name="subject" id="title" placeholder="Titre du message" /></p>
				<p><label for="mail">Votre adresse mail</label><input type="text" name="userMail" id="mail" placeholder="Votre adresse mail (optionnel) au cas où vous attendez un retour" /></p>
				<p><label for="text">Votre message</label><textarea name="content" id="text" placeholder="Écrire ici votre message"></textarea></p>
				<p><label for="send">Valider</label><input type="submit" id="send" value="Envoyer le message"></p>
			</form>
			<?php
				}
				else if(isset($_POST['subject']) AND isset($_POST['content'])) // Si on a le sujet et le msg
				{
					$from    = 'webmaster@doosearch.esy.es';
					$reply    = 'webmaster@doosearch.esy.es';
					$to      = 'doocode@outlook.com';
					$subject = 'Aucun sujet';
					$message = 'Message vide';
					
					if($_POST['userMail'] != '')
					{
						$from = $_POST['userMail'];
						$reply = $_POST['userMail'];
					}
					if($_POST['subject'] != '')
						$subject = $_POST['subject'];
					if($_POST['content'] != '')
						$message = $_POST['content'];
					
					$headers = 'From: ' . $from . "\r\n" .
							   'Reply-To: ' . $reply . "\r\n" .
							   'X-Mailer: PHP/' . phpversion();

					mail($to, $subject, $message, $headers);
					
					?>
					<p>Votre a bien été envoyé, merci beaucoup de votre attention.</p>
					<?php
				}
			?>
		</div>
    </body>
</html>