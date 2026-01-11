-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mar. 04 sep. 2018 à 05:06
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
-- Structure de la table `dsearch_searchengines`
--

DROP TABLE IF EXISTS `dsearch_searchengines`;
CREATE TABLE IF NOT EXISTS `dsearch_searchengines` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `icon` varchar(255) NOT NULL,
  `prefix` text NOT NULL,
  `suffix` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=107 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `dsearch_searchengines`
--

INSERT INTO `dsearch_searchengines` (`id`, `title`, `icon`, `prefix`, `suffix`) VALUES
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
(23, 'Open Classrooms - Les cours', 'openclassrooms.png', 'https://openclassrooms.com/courses?q=', ''),
(24, 'Open Classrooms - Les forums', 'openclassrooms.png', 'https://openclassrooms.com/recherche/?search=', ''),
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
(38, 'Ecosia', 'new/ecosia.jpg', 'https://www.ecosia.org/search?q=', ''),
(39, 'Lilo', 'new/lilo.png', 'https://search.lilo.org/searchweb.php?q=', ''),
(40, 'Webtoon', 'new/webtoon.png', 'https://www.webtoons.com/search?keyword=', ''),
(41, 'Clubic', 'new/clubic.png', 'http://www.clubic.com/r/', ''),
(42, 'Deezer', 'new/deezer.png', 'http://www.deezer.com/search/', ''),
(43, 'digiSchool', 'new/digischool.png', 'https://www.digischool.fr/recherche.php?q=', ''),
(44, 'Dribbble', 'new/dribbble.png', 'https://dribbble.com/search?q=', ''),
(45, 'Mappy', 'new/mappy.png', 'https://fr.mappy.com/#/4/M2/TSearch/S', ''),
(46, 'Fnac', 'new/fnac.jpg', 'http://recherche.fnac.com/SearchResult/ResultList.aspx?Search=', ''),
(47, 'Larousse', 'new/larousse.jpg', 'http://www.larousse.fr/encyclopedie/rechercher?q=', ''),
(48, 'LDLC.com', 'new/ldlc.jpg', 'http://www.ldlc.com/navigation/', ''),
(49, 'L\'équipe', 'new/lequipefr.png', 'http://www.lequipe.fr/recherche/search.php?r=', ''),
(50, 'L\'internaute', 'new/linternaute.png', 'http://www.linternaute.com/recherche/?f_recherche=', ''),
(51, 'Tumblr', 'new/tumblr.png', 'https://www.tumblr.com/search/', ''),
(52, 'Uptodown', 'new/uptodown.jpg', 'http://fr.uptodown.com/android/search/', ''),
(53, 'Fotolia', 'new/fotolia.png', 'https://fr.fotolia.com/search?k=', ''),
(54, 'Darty', 'new/darty.png', 'https://www.darty.com/nav/recherche/', '.html'),
(55, 'Aptoide', 'new/aptoide.png', 'https://fr.aptoide.com/search?query=', ''),
(56, 'Tapas', 'new/tapas.png', 'https://tapas.io/search?q=', ''),
(57, 'GitLab', 'new/gitlab.png', 'https://gitlab.com/search?search=', ''),
(58, 'Melty', 'new/melty.png', 'https://www.melty.fr/search?q=', ''),
(59, 'Wish', 'new/wish.png', 'https://www.wish.com/search/usb', ''),
(60, 'Bing Maps', 'new/bingmaps.png', 'https://www.bing.com/maps/search?q=', ''),
(61, 'GIPHY', 'new/giphy.png', 'https://giphy.com/search/', ''),
(62, 'LinkedIn', 'new/linkedin.png', 'https://www.linkedin.com/search/results/index/?keywords=', ''),
(63, 'CNET France', 'new/cnet.png', 'http://www.cnetfrance.fr/rechercher/', '.htm'),
(64, 'OpenStreetMap', 'new/osm.png', 'https://www.openstreetmap.org/search?query=', ''),
(65, 'Puremedias', 'new/puremedias.png', 'http://www.ozap.com/rechercher/?q=', ''),
(66, '500px', 'new/500px.png', 'https://500px.com/search?q=', ''),
(67, 'Les Editions du Net', 'new/editionsdunet.png', 'http://www.leseditionsdunet.com/search.php?search_query=', ''),
(68, 'eBay', 'new/ebay.png', 'https://www.ebay.fr/sch/i.html?_nkw=', ''),
(69, 'Cdiscount.com', 'new/cdiscount.png', 'https://www.cdiscount.com/search/10/', '.html'),
(70, 'Keljob', 'new/keljob.png', 'https://www.keljob.com/recherche?q=', ''),
(71, 'Pickanews', 'new/pickanews.png', 'https://www.pickanews.com/find?q=', ''),
(72, 'Monster.fr', 'new/monster.png', 'https://www.monster.fr/emploi/recherche/?q=', ''),
(73, 'Stack Overflow', 'new/stackoverflow.png', 'https://stackoverflow.com/search?q=', ''),
(74, 'Startpage', 'new/startpage.png', 'https://www.startpage.com/do/search?q=', ''),
(75, 'Ask.com', 'new/ask.png', 'https://fr.ask.com/web?q=', ''),
(76, 'Behance', 'new/behance.png', 'https://www.behance.net/search?search=', ''),
(77, 'Google+', 'new/googleplus.png', 'https://plus.google.com/s/', '/top'),
(78, 'Shutterstock', 'new/shutterstock.png', 'https://www.shutterstock.com/search?searchterm=', ''),
(79, 'Imgur', 'new/imgur.png', 'https://imgur.com/search?q=', ''),
(80, 'Pixmania', 'new/pixmania.png', 'https://www.pixmania.fr/s?q=', ''),
(81, '3suisses.fr', 'new/3suisses.png', 'https://www.3suisses.fr/acheter/', ''),
(82, 'Franceinfo', 'new/franceinfo.png', 'http://www.francetvinfo.fr/recherche/?request=', ''),
(83, 'Instagram', 'new/instagram.png', 'http://instagram.com/tags/', ''),
(84, 'Numerama', 'new/numerama.png', 'https://www.numerama.com/?s=', ''),
(85, 'La Redoute', 'new/laredoute.png', 'https://www.laredoute.fr/psrch/psrch.aspx?kwrd=', ''),
(86, 'wikiHow', 'new/wikihow.png', 'https://fr.wikihow.com/wikiHowTo?search=', ''),
(87, 'Gmail', 'new/gmail.png', 'https://mail.google.com/mail/u/0/#search/', ''),
(88, 'Trello', 'new/trello.png', 'https://trello.com/search?q=', ''),
(89, 'Pinterest', 'new/pinterest.png', 'https://www.pinterest.fr/search/pins/?q=', ''),
(90, 'Google Keep', 'new/gkeep.png', 'https://keep.google.com/u/0/#search/text%253D', ''),
(91, 'Google Drive', 'new/gdrive.png', 'https://drive.google.com/drive/u/0/search?q=', ''),
(92, 'Google Docs', 'new/gdocs.png', 'https://docs.google.com/document/u/0/?q=', ''),
(93, 'Google Photos', 'new/gphotos.png', 'https://photos.google.com/search/', ''),
(94, 'Google Contacts', 'new/gcontacts.png', 'https://contacts.google.com/search/', ''),
(95, 'Google Actualités', 'new/gnews.png', 'https://news.google.com/search?q=', ''),
(96, 'YouTube Gaming', 'new/ytbegaming.png', 'https://gaming.youtube.com/results?search_query=', ''),
(97, 'Rakuten Priceminister', 'new/rakuten.png', 'https://www.priceminister.com/s/', ''),
(98, 'L\'Annuaire de La Poste', 'new/laposteannuaire.png', 'https://annuaire.laposte.fr/r/', ''),
(99, 'Sarenza', 'new/sarenza.png', 'http://www.sarenza.com/store/product/search/list/view?search=', ''),
(100, 'Aliexpress', 'new/aliexpress.png', 'https://fr.aliexpress.com/wholesale?SearchText=', ''),
(101, 'Exalead', 'new/exalead.png', 'http://www.exalead.fr/search/web/results/?q=', ''),
(102, 'Tenor', 'new/tenor.png', 'https://tenor.com/search/', '-gifs'),
(103, 'Pixabay', 'new/pixabay.png', 'https://pixabay.com/fr/photos/?q=', ''),
(104, 'Foter', 'new/foter.png', 'https://foter.com/search/instant/?q=', ''),
(105, 'Apple', 'new/apple.png', 'www.apple.com/fr/search/', ''),
(106, 'Pexels', 'new/pexels.png', 'https://www.pexels.com/search/', '');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
