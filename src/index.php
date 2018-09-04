<!DOCTYPE html>
<html>
    <head>
        <?php include("res/php/head.php"); ?>
        <link rel="stylesheet" href="res/css/page.css" />
        <link rel="stylesheet" href="res/css/index.css" />
        <link rel="stylesheet" href="res/css/windows.css" />
		<meta name="keywords" content="doocode, doosearch" />
		<meta name="description" content="Doosearch est une page d'accueil qui permet de lancer une recherche sur plusieurs sites web" />
		<title>Doosearch de Doocode</title>
        <script src="res/js/index.js"></script>
        <script src="res/js/windows.js"></script>
    </head>

    <body>
        <?php include("res/php/header.php"); ?>
        <script>setCurrentPage('#homePage');</script>
		
		<div class="presentation" style="background-image: url(res/img/index.png);">
			<h1>Accueil</h1>
		</div>
		
		<div class="page">
            <h1>Bienvenue sur Doosearch</h1>
            <ul id="actions">
                <li id="btnSetup">
                    <a href="setup.php">
                        <img src="res/img/start.png" />
                        <p>Premiers par vers Doosearch</p>
                    </a>
                </li>
                <li id="btnSearch">
                    <a href="search.php">
                        <img src="res/img/find.png" />
                        <p>Lancer une recherche</p>
                    </a>
                </li>
                <li id="btnQuickAccess">
                    <a href="quickaccess.php">
                        <img src="res/img/bookmarks.png" />
                        <p>Accès rapide</p>
                    </a>
                </li>
                <li id="btnConfig">
                    <a href="configuration.php">
                        <img src="res/img/config-icon.png" />
                        <p>Configurer Doosearch</p>
                    </a>
                </li>
                <li id="btnLogin">
                    <a href="#">
                        <img src="res/img/user.png" />
                        <p>S'inscrire ou se connecter</p>
                    </a>
                </li>
            </ul>
            
            <div id="whatIsThis">
                <div>
                    <h2>Qu'est-ce que Doosearch ?</h2>
                    <p>Doosearch est une page web qui propose en une page d'accueil un formulaire de recherche avec la possibilité de lancer une recherche vers plus de 100 sites web différents (dont Google, Bing, DuckDuckGo et Qwant).</p>
                    <button onclick="window.open('https://doocode.xyz/about-doosearch.html', '_blank');">En savoir plus</button>
                </div>
                <img src="res/img/multi-engines.png" />
            </div>
            
            <h2>Plus de 100 moteurs de recherche</h2>
            <p>Oui, vous avez bien lu, il y en a pour tous les goûts. Il y a des moteurs spécialisés dans la technologie, le commerce et même pour la cuisine. Vous pouvez également rechercher une personne de votre famille sur les différents réseaux sociaux que vous connaissez. Malheureusement, n’espérez pas de retrouver la clé de voiture que vous avez égaré.</p>
            <ul id="searchEngines">
                <?php
                    include('res/php/db.php'); // On se connecte à la BDD
                    $sql = "SELECT * FROM `dsearch_searchengines` ORDER BY `title` ASC";
                    $requete = $bdd->prepare($sql);
                    $requete->execute();
                    while ($donnees = $requete->fetch())
                    { 
                        ?><li><img src="res/img/motors/<?= $donnees['icon']; ?>" /></li><?php
                    }
                ?>
            </ul>
            
            <h2>Epinglez vos moteurs de recherche préférés</h2>
            <p>Bien évidemment, si vous utilisez plus fréquemment plusieurs moteurs de recherche différents, Doosearch a pensé à vous. Avec cette nouvelle version, vous pouvez épingler autant de moteurs que vous voulez.</p>
            <button onclick="openWindow('#pinEngine');">En savoir plus</button>
            
            <div id="customize">
                <img src="res/img/customize.gif" />
                <div>
                    <h2>Doosearch à votre image</h2>
                    <p>Marre du fond blanc de Google ? Vous avez bien fait de venir ici. Sur Doosearch, vous êtes libre de changer la couleur du fond. Et pourquoi ne pas mettre une image en fond d'écran, c'est carrément plus stylé, non ?</p>
                    <!--button onclick="alert('Bientôt');">En savoir plus</button-->
                </div>
            </div>
            
            <div id="responsive">
                <img src="res/img/responsive-version.png" />
                <div>
                    <h2>Utilisable sur PC, tablette et smartphone</h2>
                    <p>Partout avec vous (slogan de pub). C'est pourtant vrai avec Doosearch. Vous pouvez l'utiliser sur votre ordinateur, tablette et smartphone, car il a été pensé pour. Une seule et même adresse URL suffit pour tous vos appareils.</p>
                    <button onclick="openWindow('#qrCode');">QR Code</button>
                </div>
            </div>
            
            <h2>Français et Open-source</h2>
            <p>Vous ne trouvez pas que ça sent la baguette ? Doosearch a été développé par des Français et est hébergé par un hébergeur français. Vous pouvez même voir les entrailles du site, si vous avez des capacités en développement puisque le site est open-source.</p>
            <p>Il existe même <a href="https://doosearch.sielo.app/fr/home.php">une version dérivé</a> de Doosearch, celui de <a href="https://feldrise.com">Feldrise</a> qui est adaptée pour le navigateur web <a href="https://sielo.app/">Sielo</a> et disponible en français et en anglais.</p>
            <a href="https://doosearch.sielo.app/fr/home.php"><button>Version dérivé</button></a>
		</div>
        
        <?php include('res/php/index.php'); ?>
    </body>
</html>