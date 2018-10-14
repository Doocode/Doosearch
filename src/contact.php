<?php 
include("res/php/core.php"); 
use Language\Lang;
Lang::setSection('contact');
?>

<!DOCTYPE html>
<html>
    <head>
        <?php include("res/php/head.php"); ?>
        <?php Lang::setSection('contact'); ?>
        <link rel="stylesheet" href="res/css/page.css" />
        <link rel="stylesheet" href="res/css/contact.css" />
        <title><?= $_APP['app_name'] .' > '. Lang::getKey('contact_me'); ?></title>
    </head>

    <body>
        <?php include("res/php/header.php"); ?>
        <?php Lang::setSection('contact'); ?>
        <script>setCurrentPage('#contactPage');</script>
		
		<div class="presentation" style="background-image: url(res/img/contact.png);">
			<h1><?= Lang::getKey('contact_me'); ?></h1>
		</div>
		
		<div class="page">
			<?php
				if(!isset($_POST['subject']) AND !isset($_POST['content']))
				{
                    ?>
                    <h1><?= Lang::getKey('send_a_message'); ?></h1>
                    <form method="post" action="contact.php">
                        <p>
                            <label for="title"><?= Lang::getKey('message_title'); ?></label>
                            <input type="text" name="subject" id="title" placeholder="<?= Lang::getKey('message_title'); ?>" />
                        </p>
                        <p>
                            <label for="mail"><?= Lang::getKey('your_email'); ?></label>
                            <input type="text" name="userMail" id="mail" placeholder="<?= Lang::getKey('your_email_placeholder'); ?>" />
                        </p>
                        <p>
                            <label for="text"><?= Lang::getKey('your_message'); ?></label>
                            <textarea name="content" id="text" placeholder="<?= Lang::getKey('your_message_placeholder'); ?>"></textarea>
                        </p>
                        <p>
                            <label for="send"> </label>
                            <input type="submit" id="send" value="<?= Lang::getKey('send_the_message'); ?>">
                        </p>
                    </form>
                    <?php
				}
				else if(isset($_POST['subject']) AND isset($_POST['content'])) // Si on a le sujet et le msg
				{
					$from    = 'webmaster@doocode.xyz';
					$reply    = 'webmaster@doocode.xyz';
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
					<p><?= Lang::getKey('message_sent'); ?></p>
					<?php
				}
			?>
		</div>
    </body>
</html>