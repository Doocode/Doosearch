-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  sam. 03 nov. 2018 à 13:35
-- Version du serveur :  5.7.21
-- Version de PHP :  7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
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
-- Structure de la table `dsearch_board`
--

DROP TABLE IF EXISTS `dsearch_board`;
CREATE TABLE IF NOT EXISTS `dsearch_board` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `url` text NOT NULL,
  `icon` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `dsearch_board`
--

INSERT INTO `dsearch_board` (`id`, `name`, `url`, `icon`, `type`, `enabled`) VALUES
(1, 'logout', 'logout.php', 'favicon.png', 'default', 1),
(2, 'manage_search_engines', 'admin-list-search-engine.php', 'favicon.png', 'admin', 1);

-- --------------------------------------------------------

--
-- Structure de la table `dsearch_searchengines`
--

DROP TABLE IF EXISTS `dsearch_searchengines`;
CREATE TABLE IF NOT EXISTS `dsearch_searchengines` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `icon` varchar(255) NOT NULL,
  `prefix` text NOT NULL,
  `suffix` text NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'enabled',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=107 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `dsearch_searchengines`
--

INSERT INTO `dsearch_searchengines` (`id`, `title`, `icon`, `prefix`, `suffix`, `status`) VALUES
(1, '01net', '01net.png', 'http://www.01net.com/recherche/recherche.php?searchstring=', '', 'enabled'),
(2, '750 grammes', '750g.png', 'http://www.750g.com/recettes_', '.html', 'enabled'),
(3, 'Allociné', 'allocine.png', 'http://www.allocine.fr/recherche/?q=', '', 'enabled'),
(4, 'Amazon', 'amazon.png', 'http://www.amazon.fr/s?field-keywords=', '', 'enabled'),
(5, 'Bing', 'bing.png', 'http://www.bing.com/search?q=', '', 'enabled'),
(6, 'Boulanger', 'boulanger.jpg', 'http://www.boulanger.com/resultats?tr=', '', 'enabled'),
(7, 'Comment ça marche', 'ccm.png', 'http://www.commentcamarche.net/s/', '', 'enabled'),
(8, 'Dailymotion', 'dailymotion.png', 'http://dailymotion.com/relevance/search/', '', 'enabled'),
(9, 'DeviantArt', 'deviantart.png', 'http://browse.deviantart.com/?q=', '', 'enabled'),
(10, 'Dropbox', 'dropbox.png', 'https://www.dropbox.com/search/personal?query_unnormalized=', '&last_fq_path=', 'enabled'),
(11, 'DuckDuckGo', 'duckduckgo.png', 'https://duckduckgo.com/?q=', '', 'enabled'),
(12, 'Facebook', 'facebook.png', 'http://www.facebook.com/search/results?q=', '', 'enabled'),
(13, 'Flickr', 'flickr.png', 'https://www.flickr.com/search/?text=', '', 'enabled'),
(14, 'GitHub', 'github.png', 'https://github.com/search?q=', '', 'enabled'),
(15, 'Google', 'google.jpg', 'http://www.google.fr/search?q=', '', 'enabled'),
(16, 'Google Maps', 'google-maps.png', 'https://www.google.fr/maps/search/', '', 'enabled'),
(17, 'Here WeGo', 'here.png', 'https://www.here.com/search/', '', 'enabled'),
(18, 'Journal du Geek', 'journaldugeek.png', 'http://www.journaldugeek.com/?s=', '', 'enabled'),
(19, 'Le Figaro', 'figaro.png', 'http://recherche.lefigaro.fr/recherche/recherche.php?ecrivez=', '', 'enabled'),
(20, 'Le Monde', 'lemonde.png', 'http://www.lemonde.fr/recherche/?keywords=', '', 'enabled'),
(21, 'Les Numériques', 'les-numeriques.png', 'http://www.lesnumeriques.com/recherche?q=', '', 'enabled'),
(22, 'Marmiton', 'marmiton.png', 'http://www.marmiton.org/recettes/recherche.aspx?aqt=', '', 'enabled'),
(23, 'Open Classrooms - Les cours', 'openclassrooms.png', 'https://openclassrooms.com/courses?q=', '', 'enabled'),
(24, 'Open Classrooms - Les forums', 'openclassrooms.png', 'https://openclassrooms.com/recherche/?search=', '', 'enabled'),
(25, 'OneDrive', 'onedrive.png', 'https://onedrive.live.com/?qt=search&q=', '', 'enabled'),
(26, 'Play Store', 'playstore.png', 'https://play.google.com/store/search?q=', '', 'enabled'),
(27, 'France.tv', 'francetv.png', 'https://www.france.tv/recherche/?q=', '', 'enabled'),
(28, 'Qwant', 'qwant.png', 'https://www.qwant.com/?q=', '', 'enabled'),
(29, 'SoundCloud', 'soundcloud.jpg', 'https://soundcloud.com/search?q=', '', 'enabled'),
(30, 'SourceForge', 'sourceforge.png', 'http://sourceforge.net/directory/?q=', '', 'enabled'),
(31, 'Twitter', 'twitter.png', 'https://twitter.com/search?q=', '', 'enabled'),
(32, 'Vimeo', 'vimeo.png', 'https://vimeo.com/search?q=', '', 'enabled'),
(33, 'Wikipedia', 'wikipedia.png', 'http://fr.wikipedia.org/w/index.php?search=', '', 'enabled'),
(34, 'Microsoft Store', 'ms-store.png', 'https://www.microsoft.com/fr-fr/store/search/apps?q=', '', 'enabled'),
(35, 'Yahoo', 'yahoo.png', 'http://fr.search.yahoo.com/search?p=', '', 'enabled'),
(36, 'YouTube', 'youtube.png', 'http://www.youtube.com/results?q=', '', 'enabled'),
(37, 'Zeste de Savoir', 'zestedesavoir.png', 'http://zestedesavoir.com/rechercher?q=', '', 'enabled'),
(38, 'Ecosia', 'new/ecosia.jpg', 'https://www.ecosia.org/search?q=', '', 'enabled'),
(39, 'Lilo', 'new/lilo.png', 'https://search.lilo.org/searchweb.php?q=', '', 'enabled'),
(40, 'Webtoon', 'new/webtoon.png', 'https://www.webtoons.com/search?keyword=', '', 'enabled'),
(41, 'Clubic', 'new/clubic.png', 'http://www.clubic.com/r/', '', 'enabled'),
(42, 'Deezer', 'new/deezer.png', 'http://www.deezer.com/search/', '', 'enabled'),
(43, 'digiSchool', 'new/digischool.png', 'https://www.digischool.fr/recherche.php?q=', '', 'enabled'),
(44, 'Dribbble', 'new/dribbble.png', 'https://dribbble.com/search?q=', '', 'enabled'),
(45, 'Mappy', 'new/mappy.png', 'https://fr.mappy.com/#/4/M2/TSearch/S', '', 'enabled'),
(46, 'Fnac', 'new/fnac.jpg', 'http://recherche.fnac.com/SearchResult/ResultList.aspx?Search=', '', 'enabled'),
(47, 'Larousse', 'new/larousse.jpg', 'http://www.larousse.fr/encyclopedie/rechercher?q=', '', 'enabled'),
(48, 'LDLC.com', 'new/ldlc.jpg', 'http://www.ldlc.com/navigation/', '', 'enabled'),
(49, 'L\'équipe', 'new/lequipefr.png', 'http://www.lequipe.fr/recherche/search.php?r=', '', 'enabled'),
(50, 'L\'internaute', 'new/linternaute.png', 'http://www.linternaute.com/recherche/?f_recherche=', '', 'enabled'),
(51, 'Tumblr', 'new/tumblr.png', 'https://www.tumblr.com/search/', '', 'enabled'),
(52, 'Uptodown', 'new/uptodown.jpg', 'http://fr.uptodown.com/android/search/', '', 'enabled'),
(53, 'Fotolia', 'new/fotolia.png', 'https://fr.fotolia.com/search?k=', '', 'enabled'),
(54, 'Darty', 'new/darty.png', 'https://www.darty.com/nav/recherche/', '.html', 'enabled'),
(55, 'Aptoide', 'new/aptoide.png', 'https://fr.aptoide.com/search?query=', '', 'enabled'),
(56, 'Tapas', 'new/tapas.png', 'https://tapas.io/search?q=', '', 'enabled'),
(57, 'GitLab', 'new/gitlab.png', 'https://gitlab.com/search?search=', '', 'enabled'),
(58, 'Melty', 'new/melty.png', 'https://www.melty.fr/search?q=', '', 'enabled'),
(59, 'Wish', 'new/wish.png', 'https://www.wish.com/search/usb', '', 'enabled'),
(60, 'Bing Maps', 'new/bingmaps.png', 'https://www.bing.com/maps/search?q=', '', 'enabled'),
(61, 'GIPHY', 'new/giphy.png', 'https://giphy.com/search/', '', 'enabled'),
(62, 'LinkedIn', 'new/linkedin.png', 'https://www.linkedin.com/search/results/index/?keywords=', '', 'enabled'),
(63, 'CNET France', 'new/cnet.png', 'http://www.cnetfrance.fr/rechercher/', '.htm', 'enabled'),
(64, 'OpenStreetMap', 'new/osm.png', 'https://www.openstreetmap.org/search?query=', '', 'enabled'),
(65, 'Puremedias', 'new/puremedias.png', 'http://www.ozap.com/rechercher/?q=', '', 'enabled'),
(66, '500px', 'new/500px.png', 'https://500px.com/search?q=', '', 'enabled'),
(67, 'Les Editions du Net', 'new/editionsdunet.png', 'http://www.leseditionsdunet.com/search.php?search_query=', '', 'enabled'),
(68, 'eBay', 'new/ebay.png', 'https://www.ebay.fr/sch/i.html?_nkw=', '', 'enabled'),
(69, 'Cdiscount.com', 'new/cdiscount.png', 'https://www.cdiscount.com/search/10/', '.html', 'enabled'),
(70, 'Keljob', 'new/keljob.png', 'https://www.keljob.com/recherche?q=', '', 'enabled'),
(71, 'Pickanews', 'new/pickanews.png', 'https://www.pickanews.com/find?q=', '', 'enabled'),
(72, 'Monster.fr', 'new/monster.png', 'https://www.monster.fr/emploi/recherche/?q=', '', 'enabled'),
(73, 'Stack Overflow', 'new/stackoverflow.png', 'https://stackoverflow.com/search?q=', '', 'enabled'),
(74, 'Startpage', 'new/startpage.png', 'https://www.startpage.com/do/search?q=', '', 'enabled'),
(75, 'Ask.com', 'new/ask.png', 'https://fr.ask.com/web?q=', '', 'enabled'),
(76, 'Behance', 'new/behance.png', 'https://www.behance.net/search?search=', '', 'enabled'),
(77, 'Google+', 'new/googleplus.png', 'https://plus.google.com/s/', '/top', 'enabled'),
(78, 'Shutterstock', 'new/shutterstock.png', 'https://www.shutterstock.com/search?searchterm=', '', 'enabled'),
(79, 'Imgur', 'new/imgur.png', 'https://imgur.com/search?q=', '', 'enabled'),
(80, 'Pixmania', 'new/pixmania.png', 'https://www.pixmania.fr/s?q=', '', 'enabled'),
(81, '3suisses.fr', 'new/3suisses.png', 'https://www.3suisses.fr/acheter/', '', 'enabled'),
(82, 'Franceinfo', 'new/franceinfo.png', 'http://www.francetvinfo.fr/recherche/?request=', '', 'enabled'),
(83, 'Instagram', 'new/instagram.png', 'http://instagram.com/tags/', '', 'enabled'),
(84, 'Numerama', 'new/numerama.png', 'https://www.numerama.com/?s=', '', 'enabled'),
(85, 'La Redoute', 'new/laredoute.png', 'https://www.laredoute.fr/psrch/psrch.aspx?kwrd=', '', 'enabled'),
(86, 'wikiHow', 'new/wikihow.png', 'https://fr.wikihow.com/wikiHowTo?search=', '', 'enabled'),
(87, 'Gmail', 'new/gmail.png', 'https://mail.google.com/mail/u/0/#search/', '', 'enabled'),
(88, 'Trello', 'new/trello.png', 'https://trello.com/search?q=', '', 'enabled'),
(89, 'Pinterest', 'new/pinterest.png', 'https://www.pinterest.fr/search/pins/?q=', '', 'enabled'),
(90, 'Google Keep', 'new/gkeep.png', 'https://keep.google.com/u/0/#search/text%253D', '', 'enabled'),
(91, 'Google Drive', 'new/gdrive.png', 'https://drive.google.com/drive/u/0/search?q=', '', 'enabled'),
(92, 'Google Docs', 'new/gdocs.png', 'https://docs.google.com/document/u/0/?q=', '', 'enabled'),
(93, 'Google Photos', 'new/gphotos.png', 'https://photos.google.com/search/', '', 'enabled'),
(94, 'Google Contacts', 'new/gcontacts.png', 'https://contacts.google.com/search/', '', 'enabled'),
(95, 'Google Actualités', 'new/gnews.png', 'https://news.google.com/search?q=', '', 'enabled'),
(96, 'YouTube Gaming', 'new/ytbegaming.png', 'https://gaming.youtube.com/results?search_query=', '', 'enabled'),
(97, 'Rakuten Priceminister', 'new/rakuten.png', 'https://www.priceminister.com/s/', '', 'enabled'),
(98, 'L\'Annuaire de La Poste', 'new/laposteannuaire.png', 'https://annuaire.laposte.fr/r/', '', 'enabled'),
(99, 'Sarenza', 'new/sarenza.png', 'http://www.sarenza.com/store/product/search/list/view?search=', '', 'enabled'),
(100, 'Aliexpress', 'new/aliexpress.png', 'https://fr.aliexpress.com/wholesale?SearchText=', '', 'enabled'),
(101, 'Exalead', 'new/exalead.png', 'http://www.exalead.fr/search/web/results/?q=', '', 'enabled'),
(102, 'Tenor', 'new/tenor.png', 'https://tenor.com/search/', '-gifs', 'enabled'),
(103, 'Pixabay', 'new/pixabay.png', 'https://pixabay.com/fr/photos/?q=', '', 'enabled'),
(104, 'Foter', 'new/foter.png', 'https://foter.com/search/instant/?q=', '', 'enabled'),
(105, 'Apple', 'new/apple.png', 'www.apple.com/fr/search/', '', 'enabled'),
(106, 'Pexels', 'new/pexels.png', 'https://www.pexels.com/search/', '', 'enabled');

-- --------------------------------------------------------

--
-- Structure de la table `dsearch_users`
--

DROP TABLE IF EXISTS `dsearch_users`;
CREATE TABLE IF NOT EXISTS `dsearch_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` text NOT NULL,
  `type` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `creation_date` date NOT NULL,
  `creation_time` time NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `dsearch_users`
--

INSERT INTO `dsearch_users` (`id`, `pseudo`, `email`, `password`, `type`, `status`, `creation_date`, `creation_time`) VALUES
(1, 'admin', 'admin@domain.com', '$2y$10$MCG7NT2gQYBm2QVQgBWmAukgLMylvps9vmS8MCqJ3JJBaEFaGFohG', 'admin', 'enabled', '2018-09-25', '17:54:36');

-- --------------------------------------------------------

--
-- Structure de la table `dsearch_users_connexions`
--

DROP TABLE IF EXISTS `dsearch_users_connexions`;
CREATE TABLE IF NOT EXISTS `dsearch_users_connexions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` int(11) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `ip` varchar(255) NOT NULL,
  `user_agent` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
