<!DOCTYPE html>
<html>
    <head>
        <?php include("res/php/head.php"); ?>
        <link rel="stylesheet" href="res/css/page.css" />
        <link rel="stylesheet" href="res/css/index.css" />
		<meta name="keywords" content="doocode, doosearch" />
		<meta name="description" content="Doosearch est une page d'accueil qui permet de lancer une recherche sur plusieurs sites web" />
		<title>Doosearch de Doocode</title>
        <script src="res/js/index.js"></script>
    </head>

    <body>
        <?php include("res/php/header.php"); ?>
		
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
                    <a href="search.php#speedDial">
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
            
            <div style="margin-right: -50px;">
                <div style="vertical-align: bottom; width: 530px; display: inline-block">
                    <h2>Qu'est-ce que Doosearch ?</h2>
                    <p>Doosearch est une page web propose en une page d'accueil un formulaire de recherche avec la possibilité de lancer une recherche vers plus de 30 sites web différents (dont Google, Bing, DuckDuckGo et Qwant).</p>
                </div>
                <img src="res/img/multi-engines.png" style="float: right;  height: 250px;" />
            </div>
            
            <h2>Plus de 30 moteurs de recherche</h2>
            <p>Oui, vous avez bien lu, il y en a pour tous les goûts. Il y a des moteurs spécialisés dans le commerce, la cuisine et même dans la technologie. Vous pouvez également rechercher une personne de votre famille sur les différents réseaux sociaux que vous connaissez. Malheureusement, n’espérez pas de retrouver la clé de voiture que vous avez égaré.</p>
            <ul id="searchEngines">
                <?php
                    include('res/php/db.inc'); // On se connecte à la BDD
                    $sql = "SELECT * FROM `searchengine` ORDER BY `title` ASC";
                    $requete = $bdd->prepare($sql);
                    $requete->execute();
                    while ($donnees = $requete->fetch())
                    { 
                        ?>
                            <li><img src="res/img/motors/<?= $donnees['icon']; ?>" /></li>
                        <?php
                    }
                ?>
            </ul>
            
            <h2>Epinglez vos moteurs de recherche préférés</h2>
            <p>Bien évidemment, si vous utilisez plus fréquemment plusieurs moteurs de recherche différents, Doosearch a pensé à vous. Avec cette nouvelle version, vous pouvez épingler autant de moteurs que vous voulez.</p>
            <button onclick="alert('Bientôt');">En savoir plus</button>
            <!-- motors épinglé + btn video cmt epingler -->
            
            <!--<h2>Et vos sites web favoris</h2>
            <p>Lorem ipsum dolor sit amet</p>-->
            
            <div>
                <img src="res/img/customize.gif" style="float: left;  height: 190px; margin-right: 50px;" />
                <div>
                    <h2>Doosearch à votre image</h2>
                    <p>Marre du fond blanc de Google ? Vous avez bien fait de venir ici. Sur Doosearch, vous êtes libre de changer la couleur du fond. Et pourquoi ne pas mettre une image en fond d'écran, c'est carrément plus stylé, non ?</p>
                    <button onclick="alert('Bientôt');">En savoir plus</button>
                </div>
            </div>
            <!-- gif modif fond -->
            
            <div>
                <img src="res/img/responsive-version.png" style="float: right;  height: 210px; margin-left: 50px;" />
                <div>
                    <h2>Utilisable sur PC, tablette et smartphone</h2>
                    <p>Partout avec vous (slogan de pub). C'est pourtant vrai avec Doosearch. Vous pouvez l'utiliser sur votre ordinateur, tablette et smartphone, car il a été pensé pour. Une seule et même adresse URL suffit pour tous vos appareils.</p>
                    <button onclick="alert('Bientôt');">En savoir plus</button>
                </div>
            </div>
            <!-- btn lien qrcode et lien pc -->
            
            <h2>Français et Open-source</h2>
            <p>Vous ne trouvez pas que ça sent la baguette ? Doosearch a été développé par des Français et est hébergé par un hébergeur français. Vous pouvez même voir les entrailles du site, si vous avez des capacités en développement puisque le site est open-source.</p>
            <p>Il existe même <a href="https://doosearch.sielo.app/fr/home.php">une version dérivé</a> de Doosearch, celui de <a href="https://feldrise.com">Feldrise</a> qui est adaptée pour le navigateur web <a href="https://sielo.app/">Sielo</a>.</p>
            <a href="https://doosearch.sielo.app/fr/home.php"><button>Version dérivé</button></a>
		</div>
    </body>
</html>