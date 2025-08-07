# Host: localhost  (Version 5.7.14)
# Date: 2017-11-18 23:40:25
# Generator: MySQL-Front 6.0  (Build 2.20)


#
# Structure for table "temas"
#

DROP TABLE IF EXISTS `temas`;
CREATE TABLE `temas` (
  `idTema` int(11) NOT NULL AUTO_INCREMENT,
  `nomeTema` varchar(255) DEFAULT NULL,
  `dataTema` datetime DEFAULT NULL,
  `criado` datetime DEFAULT NULL,
  `modificado` datetime DEFAULT NULL,
  PRIMARY KEY (`idTema`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

#
# Data for table "temas"
#

INSERT INTO `temas` VALUES (2,'BRUNO','2017-11-18 00:00:00','2017-11-18 23:13:52',NULL),(3,'CRISTO SALVA TODOS','2017-11-18 00:00:00','2017-11-18 23:23:43','2017-11-18 23:24:43'),(4,'DEUS Ã‰ AMOR','2017-11-19 00:00:00','2017-11-18 23:30:52',NULL);
