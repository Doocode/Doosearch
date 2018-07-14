<!DOCTYPE html>
<html>
    <head>
        <?php include("res/php/head.php"); ?>
        <link rel="stylesheet" href="res/css/page.css" />
        <title>Doosearch > Télécharger</title>
    </head>

    <body>
        <?php include("res/php/header.php"); ?>
        <script>setCurrentPage('#downloadPage');</script>
		
		<div class="presentation" style="background-image: url(res/img/download.png);">
			<h1>Télécharger</h1>
		</div>
		
		<div class="page">
			<h1>Télécharger Doosearch 1.3 Beta B</h1>
			<p>Tout d'abord, pour télécharger Doosearch, il faut savoir plusieurs choses :</p>
			<ul>
				<li>le fichier que vous allez télécharger n'est pas un programme, mais une archive ZIP contenant du code source<!--, par conséquent, il est destiné aux développeurs et/ou webmaster par exemple-->;</li>
				<li>le fichier est placé sous licence GPL v3, donc vous devez l'avoir lu et accepté les conditions de la licence pour utiliser le fichier téléchargé.</li>
			</ul>
			
			<input type="submit" value="Lire la licence GPL v3 (en anglais)" onclick="window.open('http://www.gnu.org/licenses/gpl.html', '_blank');" />
			<input type="submit" value="Télécharger Doosearch" onclick="window.open('res/doosearch_1_3_beta_b_src.zip', '_blank');" />
			<input type="submit" value="GitHub de Doosearch" onclick="window.open('https://github.com/Doocode/Doosearch', '_blank');" />
		</div>
    </body>
</html>