-- MySQL dump 10.13  Distrib 8.0.36, for Win64 (x86_64)
--
-- Host: localhost    Database: doosearch
-- ------------------------------------------------------
-- Server version	8.3.0

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `dsearch_searchengines`
--

DROP TABLE IF EXISTS `dsearch_searchengines`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `dsearch_searchengines` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `icon` varchar(255) NOT NULL,
  `prefix` text NOT NULL,
  `suffix` text NOT NULL,
  `public` tinyint NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=107 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dsearch_searchengines`
--

LOCK TABLES `dsearch_searchengines` WRITE;
/*!40000 ALTER TABLE `dsearch_searchengines` DISABLE KEYS */;
INSERT INTO `dsearch_searchengines` VALUES (1,'01net','01net.png','http://www.01net.com/recherche/recherche.php?searchstring=','',1),(2,'750 grammes','750g.png','http://www.750g.com/recettes_','.html',1),(3,'Allociné','allocine.png','http://www.allocine.fr/recherche/?q=','',1),(4,'Amazon','amazon.png','http://www.amazon.fr/s?field-keywords=','',1),(5,'Bing','bing.png','http://www.bing.com/search?q=','',1),(6,'Boulanger','boulanger.jpg','http://www.boulanger.com/resultats?tr=','',1),(7,'Comment ça marche','ccm.png','http://www.commentcamarche.net/s/','',1),(8,'Dailymotion','dailymotion.png','http://dailymotion.com/relevance/search/','',1),(9,'DeviantArt','deviantart.png','http://browse.deviantart.com/?q=','',1),(10,'Dropbox','dropbox.png','https://www.dropbox.com/search/personal?query_unnormalized=','&last_fq_path=',1),(11,'DuckDuckGo','duckduckgo.png','https://duckduckgo.com/?q=','',1),(12,'Facebook','facebook.png','http://www.facebook.com/search/results?q=','',1),(13,'Flickr','flickr.png','https://www.flickr.com/search/?text=','',1),(14,'GitHub','github.png','https://github.com/search?q=','',1),(15,'Google','google.jpg','http://www.google.fr/search?q=','',1),(16,'Google Maps','google-maps.png','https://www.google.fr/maps/search/','',1),(17,'Here WeGo','here.png','https://www.here.com/search/','',1),(18,'Journal du Geek','journaldugeek.png','http://www.journaldugeek.com/?s=','',1),(19,'Le Figaro','figaro.png','http://recherche.lefigaro.fr/recherche/recherche.php?ecrivez=','',1),(20,'Le Monde','lemonde.png','http://www.lemonde.fr/recherche/?keywords=','',1),(21,'Les Numériques','les-numeriques.png','http://www.lesnumeriques.com/recherche?q=','',1),(22,'Marmiton','marmiton.png','http://www.marmiton.org/recettes/recherche.aspx?aqt=','',1),(23,'Open Classrooms - Les cours','openclassrooms.png','https://openclassrooms.com/courses?q=','',1),(24,'Open Classrooms - Les forums','openclassrooms.png','https://openclassrooms.com/recherche/?search=','',1),(25,'OneDrive','onedrive.png','https://onedrive.live.com/?qt=search&q=','',1),(26,'Play Store','playstore.png','https://play.google.com/store/search?q=','',1),(27,'France.tv','francetv.png','https://www.france.tv/recherche/?q=','',1),(28,'Qwant','qwant.png','https://www.qwant.com/?q=','',1),(29,'SoundCloud','soundcloud.jpg','https://soundcloud.com/search?q=','',1),(30,'SourceForge','sourceforge.png','http://sourceforge.net/directory/?q=','',1),(31,'Twitter','twitter.png','https://twitter.com/search?q=','',1),(32,'Vimeo','vimeo.png','https://vimeo.com/search?q=','',1),(33,'Wikipedia','wikipedia.png','http://fr.wikipedia.org/w/index.php?search=','',1),(34,'Microsoft Store','ms-store.png','https://www.microsoft.com/fr-fr/store/search/apps?q=','',1),(35,'Yahoo','yahoo.png','http://fr.search.yahoo.com/search?p=','',1),(36,'YouTube','youtube.png','http://www.youtube.com/results?q=','',1),(37,'Zeste de Savoir','zestedesavoir.png','http://zestedesavoir.com/rechercher?q=','',1),(38,'Ecosia','new/ecosia.jpg','https://www.ecosia.org/search?q=','',1),(39,'Lilo','new/lilo.png','https://search.lilo.org/searchweb.php?q=','',1),(40,'Webtoon','new/webtoon.png','https://www.webtoons.com/search?keyword=','',1),(41,'Clubic','new/clubic.png','http://www.clubic.com/r/','',1),(42,'Deezer','new/deezer.png','http://www.deezer.com/search/','',1),(43,'digiSchool','new/digischool.png','https://www.digischool.fr/recherche.php?q=','',1),(44,'Dribbble','new/dribbble.png','https://dribbble.com/search?q=','',1),(45,'Mappy','new/mappy.png','https://fr.mappy.com/#/4/M2/TSearch/S','',1),(46,'Fnac','new/fnac.jpg','http://recherche.fnac.com/SearchResult/ResultList.aspx?Search=','',1),(47,'Larousse','new/larousse.jpg','http://www.larousse.fr/encyclopedie/rechercher?q=','',1),(48,'LDLC.com','new/ldlc.jpg','http://www.ldlc.com/navigation/','',1),(49,'L\'équipe','new/lequipefr.png','http://www.lequipe.fr/recherche/search.php?r=','',1),(50,'L\'internaute','new/linternaute.png','http://www.linternaute.com/recherche/?f_recherche=','',1),(51,'Tumblr','new/tumblr.png','https://www.tumblr.com/search/','',1),(52,'Uptodown','new/uptodown.jpg','http://fr.uptodown.com/android/search/','',1),(53,'Fotolia','new/fotolia.png','https://fr.fotolia.com/search?k=','',1),(54,'Darty','new/darty.png','https://www.darty.com/nav/recherche/','.html',1),(55,'Aptoide','new/aptoide.png','https://fr.aptoide.com/search?query=','',1),(56,'Tapas','new/tapas.png','https://tapas.io/search?q=','',1),(57,'GitLab','new/gitlab.png','https://gitlab.com/search?search=','',1),(58,'Melty','new/melty.png','https://www.melty.fr/search?q=','',1),(59,'Wish','new/wish.png','https://www.wish.com/search/usb','',1),(60,'Bing Maps','new/bingmaps.png','https://www.bing.com/maps/search?q=','',1),(61,'GIPHY','new/giphy.png','https://giphy.com/search/','',1),(62,'LinkedIn','new/linkedin.png','https://www.linkedin.com/search/results/index/?keywords=','',1),(63,'CNET France','new/cnet.png','http://www.cnetfrance.fr/rechercher/','.htm',1),(64,'OpenStreetMap','new/osm.png','https://www.openstreetmap.org/search?query=','',1),(65,'Puremedias','new/puremedias.png','http://www.ozap.com/rechercher/?q=','',1),(66,'500px','new/500px.png','https://500px.com/search?q=','',1),(67,'Les Editions du Net','new/editionsdunet.png','http://www.leseditionsdunet.com/search.php?search_query=','',1),(68,'eBay','new/ebay.png','https://www.ebay.fr/sch/i.html?_nkw=','',1),(69,'Cdiscount.com','new/cdiscount.png','https://www.cdiscount.com/search/10/','.html',1),(70,'Keljob','new/keljob.png','https://www.keljob.com/recherche?q=','',1),(71,'Pickanews','new/pickanews.png','https://www.pickanews.com/find?q=','',1),(72,'Monster.fr','new/monster.png','https://www.monster.fr/emploi/recherche/?q=','',1),(73,'Stack Overflow','new/stackoverflow.png','https://stackoverflow.com/search?q=','',1),(74,'Startpage','new/startpage.png','https://www.startpage.com/do/search?q=','',1),(75,'Ask.com','new/ask.png','https://fr.ask.com/web?q=','',1),(76,'Behance','new/behance.png','https://www.behance.net/search?search=','',1),(77,'Google+','new/googleplus.png','https://plus.google.com/s/','/top',1),(78,'Shutterstock','new/shutterstock.png','https://www.shutterstock.com/search?searchterm=','',1),(79,'Imgur','new/imgur.png','https://imgur.com/search?q=','',1),(80,'Pixmania','new/pixmania.png','https://www.pixmania.fr/s?q=','',1),(81,'3suisses.fr','new/3suisses.png','https://www.3suisses.fr/acheter/','',1),(82,'Franceinfo','new/franceinfo.png','http://www.francetvinfo.fr/recherche/?request=','',1),(83,'Instagram','new/instagram.png','http://instagram.com/tags/','',1),(84,'Numerama','new/numerama.png','https://www.numerama.com/?s=','',1),(85,'La Redoute','new/laredoute.png','https://www.laredoute.fr/psrch/psrch.aspx?kwrd=','',1),(86,'wikiHow','new/wikihow.png','https://fr.wikihow.com/wikiHowTo?search=','',1),(87,'Gmail','new/gmail.png','https://mail.google.com/mail/u/0/#search/','',1),(88,'Trello','new/trello.png','https://trello.com/search?q=','',1),(89,'Pinterest','new/pinterest.png','https://www.pinterest.fr/search/pins/?q=','',1),(90,'Google Keep','new/gkeep.png','https://keep.google.com/u/0/#search/text%253D','',1),(91,'Google Drive','new/gdrive.png','https://drive.google.com/drive/u/0/search?q=','',1),(92,'Google Docs','new/gdocs.png','https://docs.google.com/document/u/0/?q=','',1),(93,'Google Photos','new/gphotos.png','https://photos.google.com/search/','',1),(94,'Google Contacts','new/gcontacts.png','https://contacts.google.com/search/','',1),(95,'Google Actualités','new/gnews.png','https://news.google.com/search?q=','',1),(96,'YouTube Gaming','new/ytbegaming.png','https://gaming.youtube.com/results?search_query=','',1),(97,'Rakuten Priceminister','new/rakuten.png','https://www.priceminister.com/s/','',1),(98,'L\'Annuaire de La Poste','new/laposteannuaire.png','https://annuaire.laposte.fr/r/','',1),(99,'Sarenza','new/sarenza.png','http://www.sarenza.com/store/product/search/list/view?search=','',1),(100,'Aliexpress','new/aliexpress.png','https://fr.aliexpress.com/wholesale?SearchText=','',1),(101,'Exalead','new/exalead.png','http://www.exalead.fr/search/web/results/?q=','',1),(102,'Tenor','new/tenor.png','https://tenor.com/search/','-gifs',1),(103,'Pixabay','new/pixabay.png','https://pixabay.com/fr/photos/?q=','',1),(104,'Foter','new/foter.png','https://foter.com/search/instant/?q=','',1),(105,'Apple','new/apple.png','www.apple.com/fr/search/','',1),(106,'Pexels','new/pexels.png','https://www.pexels.com/search/','',1);
/*!40000 ALTER TABLE `dsearch_searchengines` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-01-11 22:21:39
