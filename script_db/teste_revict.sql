# Host: localhost  (Version 5.5.5-10.1.30-MariaDB)
# Date: 2018-11-19 02:39:45
# Generator: MySQL-Front 6.1  (Build 1.26)


#
# Structure for table "status"
#

CREATE DATABASE teste_revict;

CREATE TABLE `status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(30) NOT NULL DEFAULT '',
  `tabela` varchar(30) NOT NULL DEFAULT '',
  `criado_em` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

#
# Data for table "status"
#

INSERT INTO `status` VALUES (1,'Ativo','clientes','2018-11-15 17:05:16'),(2,'Inativo','clientes','2018-11-18 13:03:31'),(3,'Deletado','clientes','2018-11-18 22:20:41'),(4,'Ativa','dividas','2018-11-18 23:13:17'),(5,'Deletada','dividas','2018-11-18 23:13:37'),(6,'Inativa','dividas','2018-11-18 23:31:49');

#
# Structure for table "clientes"
#

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(60) NOT NULL DEFAULT '',
  `data_nascimento` date NOT NULL DEFAULT '0000-00-00',
  `sexo` varchar(9) NOT NULL DEFAULT '',
  `documento` varchar(11) NOT NULL DEFAULT '0',
  `email` varchar(60) NOT NULL DEFAULT '',
  `cep` varchar(8) NOT NULL DEFAULT '0',
  `logradouro` varchar(60) NOT NULL DEFAULT '',
  `numero` int(7) NOT NULL DEFAULT '0',
  `complemento` varchar(30) DEFAULT '',
  `estado` varchar(60) NOT NULL DEFAULT '',
  `cidade` varchar(60) NOT NULL DEFAULT '',
  `bairro` varchar(30) NOT NULL DEFAULT '',
  `status` int(11) NOT NULL DEFAULT '0',
  `criado_em` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `atualizado_em` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `status` (`status`),
  CONSTRAINT `clientes_ibfk_1` FOREIGN KEY (`status`) REFERENCES `status` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

#
# Data for table "clientes"
#

INSERT INTO `clientes` VALUES (11,'Lucas Teste','1995-07-20','masculino','45110366837','sysoutlucas@gmail.com.br','08411230','Rua Gil de Siqueira',51,'Casa 2','SP','São Paulo','Vila Aurea',3,'2018-11-15 21:03:44','2018-11-18 22:21:59'),(13,'Lucas Pereira','1970-01-01','masculino','45110366837','sysoutlucas@gmail.com','08411230','Rua Gil de Siqueira',51,'Casa 2','SP','São Paulo','Vila Aurea',2,'2018-11-17 18:08:10','2018-11-19 01:36:53'),(14,'Maria silveira','1994-08-20','masculino','45110366837','maria@gmail.com','08411230','Rua Gil de Siqueira',51,'Casa 2','SP','São Paulo','Vila Aurea',1,'2018-11-17 18:10:08','2018-11-19 01:37:31'),(17,'Joaquim Barbosa','1985-09-17','masculino','45110366837','Joaquin@gmail.com','08411230','Rua Gil de Siqueira',51,'Casa 27','SP','São Paulo','Vila Aurea',1,'2018-11-18 11:31:35','2018-11-19 01:38:11'),(18,'Jair Blsonaro','1982-07-20','masculino','45110366837','jair.messias@gmail.com','08411230','Rua Gil de Siqueira',51,'Casa 4','SP','São Paulo','Vila Aurea',1,'2018-11-18 16:29:18','2018-11-19 01:38:50'),(19,'Flávio Mendes','1995-07-20','masculino','45110366837','mendes.flavio@gmail.com','08411230','Rua Gil de Siqueira',51,'Casa 2','SP','São Paulo','Vila Aurea',1,'2018-11-18 16:34:49','2018-11-19 01:39:50'),(20,'Estevam Tavares','1995-07-20','masculino','45110366837','tavares01@gmail.com','08411230','Rua Gil de Siqueira',51,'','SP','São Paulo','Vila Aurea',1,'2018-11-18 16:46:11','2018-11-19 01:40:12'),(21,'ALterei','1995-07-20','masculino','45110366837','sysoutlucas@gmail.com','08411230','Rua Gil de Siqueira',51,'Casa 2','SP','São Paulo','Vila Aurea',3,'2018-11-18 20:37:35','2018-11-18 22:22:42');

#
# Structure for table "dividas"
#

CREATE TABLE `dividas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cliente_id` int(11) NOT NULL DEFAULT '0',
  `descricao` varchar(100) NOT NULL DEFAULT '',
  `valor` float NOT NULL DEFAULT '0',
  `vencimento` date NOT NULL DEFAULT '0000-00-00',
  `status` int(11) NOT NULL DEFAULT '0',
  `criado_em` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `atualizado_em` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `status` (`status`),
  KEY `dividas_ibfk_2` (`cliente_id`),
  CONSTRAINT `dividas_ibfk_1` FOREIGN KEY (`status`) REFERENCES `status` (`id`),
  CONSTRAINT `dividas_ibfk_2` FOREIGN KEY (`cliente_id`) REFERENCES `clientes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

#
# Data for table "dividas"
#

INSERT INTO `dividas` VALUES (1,13,'Emprestimo',1.5,'2019-07-20',4,'0000-00-00 00:00:00','2018-11-19 02:29:33'),(2,13,'Concerto',100,'2019-07-20',4,'0000-00-00 00:00:00','2018-11-19 02:29:44'),(3,19,'Reforma',1000,'2019-07-20',4,'2018-11-19 01:17:24','2018-11-19 01:17:24');
