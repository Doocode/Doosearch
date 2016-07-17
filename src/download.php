<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, minimum-scale=1.0, initial-scale=1.0">
        <link rel="stylesheet" href="res/css/animate.css" />
        <link rel="stylesheet" href="res/css/main.css" />
        <link rel="stylesheet" href="res/css/header.css" />
        <link rel="stylesheet" href="res/css/index.css" />
		<link rel="icon" type="image/png" href="res/img/favicon.png" />
        <title>Doosearch > Télécharger</title>
    </head>

    <body>
        <?php include("res/php/header.php"); ?>
		
		<div class="presentation" style="background-image: url(res/img/download.png);">
			<h1>Télécharger Doosearch</h1>
		</div>
		
		<div class="page">
			<h1>Télécharger Doosearch 1.3 Beta B</h1>
			<p>Tout d'abord, pour télécharger Doosearch, il faut savoir plusieurs choses :</p>
			<ul>
				<li>le fichier que vous allez télécharger n'est pas un programme, mais une archive ZIP contenant du code source<!--, par conséquent, il est destiné aux développeurs et/ou webmaster par exemple-->;</li>
				<li>le fichier est placé sous licence GPL v3, donc vous devez l'avoir lu et accepter les conditions de la licence pour utiliser le fichier téléchargé.</li>
			</ul>
			
			<input type="submit" value="Lire la licence GPL v3 (en anglais)" onclick="window.open('http://www.gnu.org/licenses/gpl.html', '_blank');" />
			<input type="submit" value="Télécharger Doosearch" onclick="window.open('res/doosearch_1_3_beta_b_src.zip', '_blank');" />
			<input type="submit" value="GitHub de Doosearch" onclick="window.open('https://github.com/Doocode/Doosearch', '_blank');" />
		</div>
    </body>
</html>