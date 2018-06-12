-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Client :  127.0.0.1
-- Généré le :  Mar 12 Juin 2018 à 10:46
-- Version du serveur :  5.7.14
-- Version de PHP :  5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `doosearch`
--

-- --------------------------------------------------------

--
-- Structure de la table `searchengine`
--

CREATE TABLE `searchengine` (
  `id` int(11) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `icon` varchar(255) NOT NULL,
  `prefix` text NOT NULL,
  `suffix` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `searchengine`
--

INSERT INTO `searchengine` (`id`, `title`, `icon`, `prefix`, `suffix`) VALUES
(1, '01net', '01net.png', 'http://www.01net.com/recherche/recherche.php?searchstring=', ''),
(2, '750 grammes', '750g.png', 'http://www.750g.com/recettes_', '.html'),
(3, 'Allociné', 'allocine.png', 'http://www.allocine.fr/recherche/?q=', ''),
(4, 'Amazon', 'amazon.png', 'http://www.amazon.fr/s?field-keywords=', ''),
(5, 'Bing', 'bing.png', 'http://www.bing.com/search?q=', ''),
(6, 'Boulanger', 'boulanger.jpg', 'http://www.boulanger.com/resultats?tr=', ''),
(7, 'Comment ça marche', 'ccm.png', 'http://www.commentcamarche.net/s/', ''),
(8, 'Dailymotion', 'dailymotion.png', 'http://dailymotion.com/relevance/search/', ''),
(9, 'DeviantArt', 'deviantart.png', 'http://browse.deviantart.com/?q=', ''),
(10, 'Dropbox', 'dropbox.png', 'https://www.dropbox.com/search/personal?query_unnormalized=', '&last_fq_path='),
(11, 'DuckDuckGo', 'duckduckgo.png', 'https://duckduckgo.com/?q=', ''),
(12, 'Facebook', 'facebook.png', 'http://www.facebook.com/search/results?q=', ''),
(13, 'Flickr', 'flickr.png', 'https://www.flickr.com/search/?text=', ''),
(14, 'GitHub', 'github.png', 'https://github.com/search?q=', ''),
(15, 'Google', 'google.jpg', 'http://www.google.fr/search?q=', ''),
(16, 'Google Maps', 'google-maps.png', 'https://www.google.fr/maps/search/', ''),
(17, 'Here WeGo', 'here.png', 'https://www.here.com/search/', ''),
(18, 'Journal du Geek', 'journaldugeek.png', 'http://www.journaldugeek.com/?s=', ''),
(19, 'Le Figaro', 'figaro.png', 'http://recherche.lefigaro.fr/recherche/recherche.php?ecrivez=', ''),
(20, 'Le Monde', 'lemonde.png', 'http://www.lemonde.fr/recherche/?keywords=', ''),
(21, 'Les Numériques', 'les-numeriques.png', 'http://www.lesnumeriques.com/recherche?q=', ''),
(22, 'Marmiton', 'marmiton.png', 'http://www.marmiton.org/recettes/recherche.aspx?aqt=', ''),
(23, 'O.C. (Cours)', 'openclassrooms.png', 'https://openclassrooms.com/courses?q=', ''),
(24, 'O.C. (Forums)', 'openclassrooms.png', 'https://openclassrooms.com/recherche/?search=', ''),
(25, 'OneDrive', 'onedrive.png', 'https://onedrive.live.com/?qt=search&q=', ''),
(26, 'Play Store', 'playstore.png', 'https://play.google.com/store/search?q=', ''),
(27, 'France.tv', 'francetv.png', 'https://www.france.tv/recherche/?q=', ''),
(28, 'Qwant', 'qwant.png', 'https://www.qwant.com/?q=', ''),
(29, 'SoundCloud', 'soundcloud.jpg', 'https://soundcloud.com/search?q=', ''),
(30, 'SourceForge', 'sourceforge.png', 'http://sourceforge.net/directory/?q=', ''),
(31, 'Twitter', 'twitter.png', 'https://twitter.com/search?q=', ''),
(32, 'Vimeo', 'vimeo.png', 'https://vimeo.com/search?q=', ''),
(33, 'Wikipedia', 'wikipedia.png', 'http://fr.wikipedia.org/w/index.php?search=', ''),
(34, 'Microsoft Store', 'ms-store.png', 'https://www.microsoft.com/fr-fr/store/search/apps?q=', ''),
(35, 'Yahoo', 'yahoo.png', 'http://fr.search.yahoo.com/search?p=', ''),
(36, 'YouTube', 'youtube.png', 'http://www.youtube.com/results?q=', ''),
(37, 'Zeste de Savoir', 'zestedesavoir.png', 'http://zestedesavoir.com/rechercher?q=', ''),
(84, 'Ecosia', 'new/ecosia.jpg', 'https://www.ecosia.org/search?q=', ''),
(83, 'Lilo', 'new/lilo.png', 'https://search.lilo.org/searchweb.php?q=', '');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `searchengine`
--
ALTER TABLE `searchengine`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `searchengine`
--
ALTER TABLE `searchengine`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
