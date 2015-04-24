-- MySQL dump 10.13  Distrib 5.6.17, for Win64 (x86_64)
--
-- Host: localhost    Database: ammdatabase
-- ------------------------------------------------------
-- Server version	5.6.22-log

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `bonifico`
--

DROP TABLE IF EXISTS `bonifico`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bonifico` (
  `IBAN_Ordinante` varchar(27) NOT NULL,
  `nomeOrdinante` varchar(24) NOT NULL,
  `cognomeOrdinante` varchar(24) NOT NULL,
  `IBAN_Beneficiario` varchar(27) NOT NULL DEFAULT 'IT11X0326810001100000000000',
  `nomeBeneficiario` varchar(24) NOT NULL DEFAULT 'IkStudiosPhothography',
  `causale` varchar(64) DEFAULT 'Pagamento ordine online presso IKStudios.com',
  PRIMARY KEY (`IBAN_Ordinante`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bonifico`
--

LOCK TABLES `bonifico` WRITE;
/*!40000 ALTER TABLE `bonifico` DISABLE KEYS */;
INSERT INTO `bonifico` VALUES ('IT96R0123454321000000012345','Marco','Melis','IT11X0326810001100000000000','IkStudiosPhothography','Pagamento online presso IKStudios.com');
/*!40000 ALTER TABLE `bonifico` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `creditcard`
--

DROP TABLE IF EXISTS `creditcard`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `creditcard` (
  `numeroCarta` char(19) NOT NULL DEFAULT '',
  `CVV2` char(3) NOT NULL,
  `dataScadenza` date NOT NULL,
  `nomeIntestatario` varchar(24) DEFAULT NULL,
  `cognomeIntestatario` varchar(24) DEFAULT NULL,
  PRIMARY KEY (`numeroCarta`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `creditcard`
--

LOCK TABLES `creditcard` WRITE;
/*!40000 ALTER TABLE `creditcard` DISABLE KEYS */;
INSERT INTO `creditcard` VALUES ('5338 9582 8764 3458','782','2017-02-05','Marco','Melis');
/*!40000 ALTER TABLE `creditcard` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `immagine`
--

DROP TABLE IF EXISTS `immagine`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `immagine` (
  `IDimg` varchar(8) NOT NULL,
  `autore` varchar(24) NOT NULL,
  `titolo` varchar(24) DEFAULT NULL,
  `descrizione` varchar(1000) DEFAULT NULL,
  `fOnline` tinyint(1) DEFAULT '1',
  `fGalleria1` tinyint(1) DEFAULT '0',
  `fGalleria2` tinyint(1) DEFAULT '0',
  `ultimaModifica` date NOT NULL,
  `visibile` tinyint(1) NOT NULL DEFAULT '0',
  `preview250` varchar(250) DEFAULT NULL,
  `preview850` varchar(250) DEFAULT NULL,
  `prezzo` float DEFAULT '0',
  PRIMARY KEY (`IDimg`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `immagine`
--

LOCK TABLES `immagine` WRITE;
/*!40000 ALTER TABLE `immagine` DISABLE KEYS */;
INSERT INTO `immagine` VALUES ('00000001','Elena Kalis','Underwather','Un ragazzo e una ragazza immersi nei primordi della loro esperienza',1,0,0,'2015-03-09',1,'images/preview250/Underwather.jpg','images/Underwather.jpg',2650),('00000002','Jade Karren','aBus','La realtà si trasmette attraverso questa prospettiva, che potrebbe facilmente includere ognuno di noi. L\'uomo è messo a confronto con la sua condizione transitoria, economicamente parlando, di fronte all\'era postmoderna',1,1,1,'2015-03-09',1,'images/preview250/bus.jpg','images/bus.jpg',1290),('00000003','MustafaDedeogLu','Watch','Il mondo sotto un altro punto di vista... più semplice. La stessa semplicità rimarcata dai soggetti della foto, che invita a pensare sui significati delle piccole cose, in relazione alla vastità.',1,4,4,'2015-03-09',1,'images/preview250/watch.jpg','images/watch.jpg',788),('00000004','Ariel Keiths','Farmland Outpost','Guardare, fissare, senza possibilità alcuna di movimento. La foto vuole rimarcare l\'immobilismo, l\'attesa; forse, la falsa speranza.',1,2,2,'2015-03-09',1,'images/preview250/woman.jpg','images/woman.jpg',2300),('00000005','Fake coke','Halohid','Un progetto di gruppo realizzato sotto la supervisione del fotografo Halohid che descrive la spensieratezza, gli eccessi e la voglia di vita, colmata in parte anche dalle droghe, di questa nuova gioventù.',1,2,3,'2015-03-09',1,'images/preview250/teens.jpg','images/teens.jpg',1200),('00000006','Life in Salalah Beach','Tenetsi','Un ritratto di vita, nelle spiagge brasiliane, in cui è sempre forte la nota di contrasto tra felicità e incertezza della condizione all\"interno della società.',1,3,3,'2015-03-09',1,'images/preview250/tothebeach.jpg','images/morale.jpg',690);
/*!40000 ALTER TABLE `immagine` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `loggeduser`
--

DROP TABLE IF EXISTS `loggeduser`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `loggeduser` (
  `userID` varchar(8) NOT NULL,
  `passwd` char(64) NOT NULL,
  `email` varchar(120) NOT NULL,
  `nome` varchar(24) NOT NULL,
  `cognome` varchar(24) NOT NULL,
  `dataDiNascita` date NOT NULL,
  `città` varchar(24) NOT NULL,
  `cap` varchar(5) NOT NULL DEFAULT '0',
  `indirizzo` varchar(120) NOT NULL DEFAULT 'non specificato',
  `cellulare` varchar(16) DEFAULT NULL,
  `ruolo` char(6) DEFAULT 'user',
  `cartaDiCredito` char(19) DEFAULT '0000 0000 0000 0000',
  `IBAN` varchar(27) DEFAULT '000000000000000000000000000',
  PRIMARY KEY (`userID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `loggeduser`
--

LOCK TABLES `loggeduser` WRITE;
/*!40000 ALTER TABLE `loggeduser` DISABLE KEYS */;
INSERT INTO `loggeduser` VALUES ('Admin','webadmin','admin@ikstudios.com','Andrea','Silvani','1988-02-10','Oristano','00000','non specificato','0039 333 4851311','admin','0000 0000 0000 0000','0'),('user001','pass1234','user001@email.it','Marco','Melis','1989-01-20','Cagliari','09120','Via Ospedale 49','0039 349 7273843','user','5338 9582 8764 3458','IT96R0123454321000000012345');
/*!40000 ALTER TABLE `loggeduser` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ordine`
--

DROP TABLE IF EXISTS `ordine`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ordine` (
  `IDordine` char(32) NOT NULL,
  `IDarticolo` varchar(8) NOT NULL,
  `IDutente` varchar(16) NOT NULL,
  `numeroCarta` varchar(19) NOT NULL,
  `IBAN` varchar(27) NOT NULL,
  `dataPagamento` date NOT NULL,
  `importo` double NOT NULL,
  `statoOrdine` varchar(160) DEFAULT NULL,
  `fOnline` tinyint(1) DEFAULT '0',
  `fGalleria1` tinyint(1) DEFAULT '0',
  `fGalleria2` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`IDordine`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ordine`
--

LOCK TABLES `ordine` WRITE;
/*!40000 ALTER TABLE `ordine` DISABLE KEYS */;
INSERT INTO `ordine` VALUES ('00757365723030310000010a3cfb38AA','00000001','user001','5338 7500 8764 3458','000000000000000000000000000','2015-03-24',2630,'Pagamento ricevuto',1,1,0),('00757365723030310000010a7d6085AA','00000001','user001','5338 9582 8764 3458','000000000000000000000000000','2015-04-24',2685,'Pagamento ricevuto',1,1,0),('00757365723030310000010a7dc488AA','00000001','user001','5338 9582 8764 3458','000000000000000000000000000','2015-04-24',2685,'Pagamento ricevuto',1,1,0);
/*!40000 ALTER TABLE `ordine` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `webadmin`
--

DROP TABLE IF EXISTS `webadmin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `webadmin` (
  `userID` varchar(16) NOT NULL,
  `passwd` char(64) NOT NULL,
  `email` varchar(120) NOT NULL,
  `nome` varchar(24) NOT NULL,
  `cognome` varchar(24) NOT NULL,
  `ruolo` char(6) DEFAULT 'Admin',
  PRIMARY KEY (`userID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `webadmin`
--

LOCK TABLES `webadmin` WRITE;
/*!40000 ALTER TABLE `webadmin` DISABLE KEYS */;
/*!40000 ALTER TABLE `webadmin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'ammdatabase'
--

--
-- Dumping routines for database 'ammdatabase'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-04-24 16:12:37
