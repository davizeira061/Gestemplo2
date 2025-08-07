DROP TABLE IF EXISTS `lider`;
CREATE TABLE `lider` (
  `idLider` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) DEFAULT NULL,
  `nomePG` varchar(255) DEFAULT NULL,
  `regiao` int(11) DEFAULT NULL,
  `telefone` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `senha` varchar(32) DEFAULT NULL,
  `status` enum('Ativo','Inativo') DEFAULT 'Ativo',
  `nivelacesso` tinyint(3) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `mapa` varchar(500) DEFAULT NULL,
  `criado` datetime DEFAULT NULL,
  `modificado` datetime DEFAULT NULL,
  `logado` enum('1','2') DEFAULT '1',
  `ultimoacesso` datetime DEFAULT NULL,
  PRIMARY KEY (`idLider`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8;

INSERT INTO `lider` VALUES (1,'Micheline','Administração de PG',1,'(65) 98129-6714','admin@admin','202cb962ac59075b964b07152d234b70','Ativo',1,'img/foto.jpg','https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3842.3554359109435!2d-56.0820607851472!3d-15.626049989156032!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMTXCsDM3JzMzLjgiUyA1NsKwMDQnNDcuNSJX!5e0!3m2!1spt-BR!2sus!4v1506903183413','2017-07-20 12:57:09','2017-10-20 01:18:18','1','2017-10-20 01:03:55');

DROP TABLE IF EXISTS `regiao`;
CREATE TABLE `regiao` (
  `idRegiao` int(11) NOT NULL AUTO_INCREMENT,
  `nomeRegiao` varchar(255) DEFAULT NULL,
  `idResp` int(11) DEFAULT NULL,
  `criado` datetime DEFAULT NULL,
  `modificado` datetime DEFAULT NULL,
  PRIMARY KEY (`idRegiao`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;


INSERT INTO `regiao` VALUES (1,'Nenhuma',NULL,'2017-08-19 20:00:50',NULL);

DROP TABLE IF EXISTS `relatorio`;
CREATE TABLE `relatorio` (
  `idRelatorio` int(11) NOT NULL AUTO_INCREMENT,
  `dataReuniao` date DEFAULT NULL,
  `lider` int(11) DEFAULT NULL,
  `crenteMaior12` tinyint(3) DEFAULT NULL,
  `crenteMenores12` tinyint(3) DEFAULT NULL,
  `naoCrenteMaior12` tinyint(3) DEFAULT NULL,
  `naoCrenteMenores12` tinyint(3) DEFAULT NULL,
  `totalPessoas` tinyint(3) DEFAULT NULL,
  `obsPessoas` text,
  `obsLicao` text,
  `pedOracao` text,
  `temaReuniao` varchar(255) DEFAULT NULL,
  `criado` datetime DEFAULT NULL,
  `modificado` datetime DEFAULT NULL,
  PRIMARY KEY (`idRelatorio`),
  KEY `lider` (`lider`),
  CONSTRAINT `relatorio_ibfk_1` FOREIGN KEY (`lider`) REFERENCES `lider` (`idLider`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
