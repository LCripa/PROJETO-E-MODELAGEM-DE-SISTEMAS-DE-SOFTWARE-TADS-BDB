CREATE DATABASE IF NOT EXISTS `datablaster`
USE `datablaster`;


CREATE TABLE IF NOT EXISTS `avaria` (
  `placa` varchar(7) NOT NULL,
  `carga_v` bigint NOT NULL,
  `data_avaria` date NOT NULL,
  `produto` varchar(90) NOT NULL,
  `motivo` varchar(90) NOT NULL,
  `imagem` mediumblob NOT NULL,
  `img2` mediumblob,
  `img3` mediumblob,
  `img4` mediumblob,
  `id_user` int NOT NULL,
  KEY `fk_User_avaria` (`id_user`)
)


CREATE TABLE IF NOT EXISTS `cadastro_do_usuario` (
  `id_user` bigint unsigned NOT NULL AUTO_INCREMENT,
  `login` varchar(30) NOT NULL,
  `nome_u` varchar(50) NOT NULL,
  `senha` varchar(32) NOT NULL,
  `data_nascimento` date NOT NULL,
  `email` varchar(90) NOT NULL,
  `setor` varchar(30) NOT NULL,
  `cargo` varchar(90) NOT NULL,
  `cnpj` varchar(18) NOT NULL,
  PRIMARY KEY (`login`),
  UNIQUE KEY `id_user` (`id_user`)
)


CREATE TABLE IF NOT EXISTS `cadastro_empresa` (
  `cnpj` varchar(18) NOT NULL,
  `nome_e` varchar(50) NOT NULL,
  `cep` varchar(9) NOT NULL,
  `numero` int NOT NULL,
  `cidade` varchar(30) NOT NULL,
  `obs` text,
  `data_fundacao` date NOT NULL,
  `email` varchar(50) NOT NULL,
  `telefone` varchar(11) NOT NULL,
  `valido` bit(1) NOT NULL DEFAULT b'0',
  PRIMARY KEY (`cnpj`)
)


CREATE TABLE IF NOT EXISTS `c_control_exp` (
  `placa` varchar(7) NOT NULL,
  `OE` bigint NOT NULL,
  `data_expedicao` date NOT NULL,
  `produtos_exp` text NOT NULL,
  `cliente` varchar(90) NOT NULL,
  `imagem` mediumblob NOT NULL,
  `img2` mediumblob,
  `id_user` int NOT NULL,
  KEY `fk_User_exp` (`id_user`)
)


CREATE TABLE IF NOT EXISTS `c_control_rec` (
  `placa_r` varchar(7) NOT NULL,
  `carga_r` bigint NOT NULL,
  `data_recebimento` date NOT NULL,
  `produto_recebido` varchar(90) NOT NULL,
  `fabrica` varchar(90) DEFAULT NULL,
  `imagem` mediumblob NOT NULL,
  `img2` mediumblob,
  `img3` mediumblob,
  `img4` mediumblob,
  `id_user` int DEFAULT NULL,
  KEY `fk_User_rec` (`id_user`)
)


CREATE TABLE IF NOT EXISTS `rac` (
  `N_RAC` int NOT NULL AUTO_INCREMENT,
  `placa` varchar(7) NOT NULL,
  `carga_rac` varchar(90) NOT NULL,
  `data_chegada` date NOT NULL,
  `produto` varchar(90) NOT NULL,
  `motivo` varchar(90) NOT NULL,
  `id_user` int DEFAULT NULL,
  PRIMARY KEY (`N_RAC`),
  KEY `fk_User_rac` (`id_user`)
)


CREATE TABLE IF NOT EXISTS `sku` (
  `N_sku` int NOT NULL AUTO_INCREMENT,
  `N_processo` int NOT NULL,
  `nome_process` varchar(15) NOT NULL,
  `data_processo` date NOT NULL,
  `id_user` int DEFAULT NULL,
  PRIMARY KEY (`N_sku`),
  KEY `fk_User_sku` (`id_user`)
);


DELIMITER //
CREATE TRIGGER `sku_avaria` AFTER INSERT ON `avaria` FOR EACH ROW BEGIN
    INSERT INTO sku(`N_processo`, `nome_process`, `data_processo`, `id_user`)
VALUES(
    NEW.carga_v,
    'AVARIA',
    NEW.data_avaria,
    NEW.id_user);
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;


DELIMITER //
CREATE TRIGGER `sku_exp` AFTER INSERT ON `c_control_exp` FOR EACH ROW BEGIN
    INSERT INTO sku(`N_processo`, `nome_process`,`data_processo`,`id_user`)
VALUES(
    NEW.OE,
    'EXPEDIÇÃO',
    NEW.data_expedicao,
    NEW.id_user);
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;


DELIMITER //
CREATE TRIGGER `sku_rac` AFTER INSERT ON `rac` FOR EACH ROW BEGIN
    INSERT INTO sku(`N_processo`, `nome_process`,`data_processo`,`id_user`)
VALUES(
    NEW.carga_rac,
    'RECOLHA',
    NEW.data_chegada,
    NEW.id_user);
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;


DELIMITER //
CREATE TRIGGER `sku_rec` AFTER INSERT ON `c_control_rec` FOR EACH ROW BEGIN
    INSERT INTO sku(`N_processo`, `nome_process`,`data_processo`,`id_user`)
VALUES(
    NEW.carga_r,
    'RECEBIMENTO',
    NEW.data_recebimento,
    NEW.id_user);
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;