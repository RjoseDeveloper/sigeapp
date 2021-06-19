-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.7.33 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             11.2.0.6213
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for sigairis
DROP DATABASE IF EXISTS `sigairis`;
CREATE DATABASE IF NOT EXISTS `sigairis` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `sigairis`;

-- Dumping structure for table sigairis.actividade
DROP TABLE IF EXISTS `actividade`;
CREATE TABLE IF NOT EXISTS `actividade` (
  `idactividade` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(255) DEFAULT NULL,
  `data_inicio` date DEFAULT NULL,
  `data_fim` date DEFAULT NULL,
  `idutilizador` int(11) DEFAULT NULL,
  `idcurso` int(11) NOT NULL,
  `data_added` date DEFAULT NULL,
  `taxa` double DEFAULT NULL,
  PRIMARY KEY (`idactividade`,`idcurso`),
  KEY `idutilizador` (`idutilizador`),
  KEY `idcurso` (`idcurso`),
  CONSTRAINT `actividade_ibfk_1` FOREIGN KEY (`idutilizador`) REFERENCES `utilizador` (`id`),
  CONSTRAINT `actividade_ibfk_2` FOREIGN KEY (`idcurso`) REFERENCES `curso` (`idcurso`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table sigairis.actividade: ~2 rows (approximately)
DELETE FROM `actividade`;
/*!40000 ALTER TABLE `actividade` DISABLE KEYS */;
INSERT INTO `actividade` (`idactividade`, `descricao`, `data_inicio`, `data_fim`, `idutilizador`, `idcurso`, `data_added`, `taxa`) VALUES
	(1, 'Matriculas', '2021-06-16', '2021-07-16', 1, 1, '2021-06-16', 1000),
	(2, 'Exame 1 Epoca', '2021-06-18', '2021-07-10', 1, 1, '2021-06-19', 200);
/*!40000 ALTER TABLE `actividade` ENABLE KEYS */;

-- Dumping structure for table sigairis.curso
DROP TABLE IF EXISTS `curso`;
CREATE TABLE IF NOT EXISTS `curso` (
  `descricao` varchar(255) NOT NULL,
  `codigo` varchar(255) DEFAULT NULL,
  `data_registo` date NOT NULL,
  `idcurso` int(11) NOT NULL AUTO_INCREMENT,
  `qtd_turmas` int(11) NOT NULL,
  `taxa_matricula` double DEFAULT NULL,
  `idperiodo` int(11) DEFAULT NULL,
  `coordenador` int(11) DEFAULT NULL,
  `details` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`idcurso`),
  KEY `idperiodo` (`idperiodo`),
  KEY `coordenador` (`coordenador`),
  CONSTRAINT `curso_ibfk_3` FOREIGN KEY (`idperiodo`) REFERENCES `periodo` (`idperiodo`),
  CONSTRAINT `curso_ibfk_4` FOREIGN KEY (`coordenador`) REFERENCES `utilizador` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table sigairis.curso: ~0 rows (approximately)
DELETE FROM `curso`;
/*!40000 ALTER TABLE `curso` DISABLE KEYS */;
INSERT INTO `curso` (`descricao`, `codigo`, `data_registo`, `idcurso`, `qtd_turmas`, `taxa_matricula`, `idperiodo`, `coordenador`, `details`) VALUES
	('8Âª Classe', '2018', '2021-06-16', 1, 5, 700, 1, 1, '8Âª Classe');
/*!40000 ALTER TABLE `curso` ENABLE KEYS */;

-- Dumping structure for table sigairis.despesa
DROP TABLE IF EXISTS `despesa`;
CREATE TABLE IF NOT EXISTS `despesa` (
  `iddespesa` int(11) NOT NULL AUTO_INCREMENT,
  `details` varchar(255) DEFAULT NULL,
  `data_reg` date DEFAULT NULL,
  `valor` double DEFAULT NULL,
  `idorcamento` int(11) NOT NULL,
  `idutilizador` int(11) NOT NULL,
  PRIMARY KEY (`iddespesa`,`idorcamento`,`idutilizador`),
  KEY `idorcamento` (`idorcamento`),
  KEY `idutilizador` (`idutilizador`),
  CONSTRAINT `despesa_ibfk_1` FOREIGN KEY (`idorcamento`) REFERENCES `orcamento` (`idorcamneto`),
  CONSTRAINT `despesa_ibfk_2` FOREIGN KEY (`idutilizador`) REFERENCES `utilizador` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table sigairis.despesa: ~0 rows (approximately)
DELETE FROM `despesa`;
/*!40000 ALTER TABLE `despesa` DISABLE KEYS */;
/*!40000 ALTER TABLE `despesa` ENABLE KEYS */;

-- Dumping structure for table sigairis.disciplina
DROP TABLE IF EXISTS `disciplina`;
CREATE TABLE IF NOT EXISTS `disciplina` (
  `idDisciplina` int(11) NOT NULL AUTO_INCREMENT,
  `creditos` int(11) NOT NULL,
  `descricao` varchar(255) NOT NULL,
  `codigo` int(11) NOT NULL,
  `data_registo` date DEFAULT NULL,
  `natureza` varchar(255) DEFAULT NULL,
  `anolectivo` int(11) DEFAULT NULL,
  `idcurso` int(11) DEFAULT NULL,
  PRIMARY KEY (`idDisciplina`),
  KEY `idDisciplina` (`idDisciplina`),
  KEY `anolectivo` (`anolectivo`),
  KEY `idcurso` (`idcurso`),
  CONSTRAINT `disciplina_ibfk_1` FOREIGN KEY (`anolectivo`) REFERENCES `anolectivo` (`idano`),
  CONSTRAINT `disciplina_ibfk_3` FOREIGN KEY (`idcurso`) REFERENCES `curso` (`idcurso`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table sigairis.disciplina: ~0 rows (approximately)
DELETE FROM `disciplina`;
/*!40000 ALTER TABLE `disciplina` DISABLE KEYS */;
INSERT INTO `disciplina` (`idDisciplina`, `creditos`, `descricao`, `codigo`, `data_registo`, `natureza`, `anolectivo`, `idcurso`) VALUES
	(1, 20, 'Matematica', 2019, '2021-06-16', 'Teorico/Pratico', NULL, 1);
/*!40000 ALTER TABLE `disciplina` ENABLE KEYS */;

-- Dumping structure for table sigairis.distrito
DROP TABLE IF EXISTS `distrito`;
CREATE TABLE IF NOT EXISTS `distrito` (
  `iddistrito` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(255) NOT NULL,
  `idprovincia` int(11) NOT NULL,
  PRIMARY KEY (`iddistrito`),
  KEY `idprovincia` (`idprovincia`),
  CONSTRAINT `distrito_ibfk_1` FOREIGN KEY (`idprovincia`) REFERENCES `provincia` (`idprovincia`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table sigairis.distrito: ~2 rows (approximately)
DELETE FROM `distrito`;
/*!40000 ALTER TABLE `distrito` DISABLE KEYS */;
INSERT INTO `distrito` (`iddistrito`, `descricao`, `idprovincia`) VALUES
	(1, 'Balama', 1),
	(2, 'Namialo', 2);
/*!40000 ALTER TABLE `distrito` ENABLE KEYS */;

-- Dumping structure for table sigairis.encarregado
DROP TABLE IF EXISTS `encarregado`;
CREATE TABLE IF NOT EXISTS `encarregado` (
  `idencarregado` int(111) NOT NULL AUTO_INCREMENT,
  `localtrablho` varchar(50) DEFAULT NULL,
  `documento` varchar(255) DEFAULT NULL,
  `nivelescolar` int(11) DEFAULT NULL,
  `celular1` varchar(255) DEFAULT NULL,
  `celular2` varchar(255) DEFAULT NULL,
  `parentesco` varchar(255) DEFAULT NULL,
  `nomecompleto` varchar(255) NOT NULL,
  PRIMARY KEY (`idencarregado`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table sigairis.encarregado: ~0 rows (approximately)
DELETE FROM `encarregado`;
/*!40000 ALTER TABLE `encarregado` DISABLE KEYS */;
/*!40000 ALTER TABLE `encarregado` ENABLE KEYS */;

-- Dumping structure for table sigairis.inscricao
DROP TABLE IF EXISTS `inscricao`;
CREATE TABLE IF NOT EXISTS `inscricao` (
  `idinscricao` int(11) NOT NULL AUTO_INCREMENT,
  `idturma` int(11) NOT NULL,
  `iddisciplina` int(11) DEFAULT NULL,
  `idutilizador` int(11) DEFAULT NULL,
  `data_registo` date DEFAULT NULL,
  `idturno` int(11) NOT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`idinscricao`,`idturma`,`idturno`),
  KEY `idcurso` (`idturma`),
  KEY `iddisciplina` (`iddisciplina`),
  KEY `idutilizador` (`idutilizador`),
  KEY `idturno` (`idturno`),
  CONSTRAINT `inscricao_ibfk_2` FOREIGN KEY (`iddisciplina`) REFERENCES `disciplina` (`idDisciplina`),
  CONSTRAINT `inscricao_ibfk_3` FOREIGN KEY (`idutilizador`) REFERENCES `utilizador` (`id`),
  CONSTRAINT `inscricao_ibfk_4` FOREIGN KEY (`idturma`) REFERENCES `turma` (`idturma`),
  CONSTRAINT `inscricao_ibfk_7` FOREIGN KEY (`idturno`) REFERENCES `turno` (`idturno`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table sigairis.inscricao: ~0 rows (approximately)
DELETE FROM `inscricao`;
/*!40000 ALTER TABLE `inscricao` DISABLE KEYS */;
/*!40000 ALTER TABLE `inscricao` ENABLE KEYS */;

-- Dumping structure for table sigairis.juro
DROP TABLE IF EXISTS `juro`;
CREATE TABLE IF NOT EXISTS `juro` (
  `idjuro` int(11) NOT NULL AUTO_INCREMENT,
  `juro` double DEFAULT NULL,
  PRIMARY KEY (`idjuro`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table sigairis.juro: ~2 rows (approximately)
DELETE FROM `juro`;
/*!40000 ALTER TABLE `juro` DISABLE KEYS */;
INSERT INTO `juro` (`idjuro`, `juro`) VALUES
	(1, 0),
	(2, 10),
	(3, 30);
/*!40000 ALTER TABLE `juro` ENABLE KEYS */;

-- Dumping structure for table sigairis.notafinal
DROP TABLE IF EXISTS `notafinal`;
CREATE TABLE IF NOT EXISTS `notafinal` (
  `idpautafrequencia` int(11) NOT NULL AUTO_INCREMENT,
  `iddisciplina` int(11) DEFAULT NULL,
  `idcurso` int(11) DEFAULT NULL,
  `idaluno` int(11) DEFAULT NULL,
  `semestre` int(11) DEFAULT NULL,
  `anolectivo` int(11) DEFAULT NULL,
  `data_added` date DEFAULT NULL,
  `notafinal` double DEFAULT NULL,
  `descricao` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`idpautafrequencia`),
  KEY `iddisciplina` (`iddisciplina`),
  KEY `idcurso` (`idcurso`),
  KEY `idaluno` (`idaluno`),
  CONSTRAINT `notafinal_ibfk_1` FOREIGN KEY (`iddisciplina`) REFERENCES `disciplina` (`idDisciplina`),
  CONSTRAINT `notafinal_ibfk_2` FOREIGN KEY (`idcurso`) REFERENCES `curso` (`idcurso`),
  CONSTRAINT `notafinal_ibfk_3` FOREIGN KEY (`idaluno`) REFERENCES `aluno` (`idaluno`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table sigairis.notafinal: ~0 rows (approximately)
DELETE FROM `notafinal`;
/*!40000 ALTER TABLE `notafinal` DISABLE KEYS */;
/*!40000 ALTER TABLE `notafinal` ENABLE KEYS */;

-- Dumping structure for table sigairis.perfil
DROP TABLE IF EXISTS `perfil`;
CREATE TABLE IF NOT EXISTS `perfil` (
  `idperfil` int(11) NOT NULL AUTO_INCREMENT,
  `diretor` varchar(255) DEFAULT NULL,
  `nome_instituicao` varchar(255) DEFAULT NULL,
  `data_registo` date DEFAULT NULL,
  `idendereco` varchar(200) DEFAULT NULL,
  `nome2instituicao` varchar(255) DEFAULT NULL,
  `contacto` varchar(255) DEFAULT NULL,
  `codigopostal` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `dirpedagogico` varchar(255) DEFAULT NULL,
  `logo_url` varchar(255) DEFAULT NULL,
  `provincia` varchar(255) DEFAULT NULL,
  `cidade` varchar(255) DEFAULT NULL,
  `nuit` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`idperfil`),
  KEY `idutilizador_resp` (`diretor`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table sigairis.perfil: ~0 rows (approximately)
DELETE FROM `perfil`;
/*!40000 ALTER TABLE `perfil` DISABLE KEYS */;
INSERT INTO `perfil` (`idperfil`, `diretor`, `nome_instituicao`, `data_registo`, `idendereco`, `nome2instituicao`, `contacto`, `codigopostal`, `email`, `dirpedagogico`, `logo_url`, `provincia`, `cidade`, `nuit`) VALUES
	(2, 'Claudio Duarte', 'Arco Iris', '2021-06-16', 'Natite', 'Escola Comunhao ', '8839992', '3200', NULL, NULL, NULL, NULL, NULL, NULL);
/*!40000 ALTER TABLE `perfil` ENABLE KEYS */;

-- Dumping structure for table sigairis.periodo
DROP TABLE IF EXISTS `periodo`;
CREATE TABLE IF NOT EXISTS `periodo` (
  `idperiodo` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`idperiodo`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table sigairis.periodo: ~2 rows (approximately)
DELETE FROM `periodo`;
/*!40000 ALTER TABLE `periodo` DISABLE KEYS */;
INSERT INTO `periodo` (`idperiodo`, `descricao`) VALUES
	(1, 'Laboral'),
	(2, 'Pos Laboral');
/*!40000 ALTER TABLE `periodo` ENABLE KEYS */;

-- Dumping structure for table sigairis.prestacao
DROP TABLE IF EXISTS `prestacao`;
CREATE TABLE IF NOT EXISTS `prestacao` (
  `valor` double DEFAULT NULL,
  `datapay` date DEFAULT NULL,
  `idjuro` int(11) NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL,
  `modepay` varchar(255) DEFAULT NULL,
  `idactividade` int(11) NOT NULL DEFAULT '0',
  `idcurso` int(11) NOT NULL,
  `iduser` int(11) DEFAULT NULL,
  `user_session_id` int(11) NOT NULL,
  KEY `idpagamento` (`idjuro`),
  KEY `idcurso` (`idcurso`),
  KEY `user_session_id` (`user_session_id`),
  KEY `status` (`status`),
  KEY `FK_prestacao_utilizador` (`iduser`),
  KEY `FK_prestacao_actividade` (`idactividade`),
  CONSTRAINT `FK_prestacao_actividade` FOREIGN KEY (`idactividade`) REFERENCES `actividade` (`idactividade`),
  CONSTRAINT `FK_prestacao_utilizador` FOREIGN KEY (`iduser`) REFERENCES `utilizador` (`id`) ON UPDATE NO ACTION,
  CONSTRAINT `prestacao_ibfk_2` FOREIGN KEY (`idjuro`) REFERENCES `juro` (`idjuro`) ON UPDATE NO ACTION,
  CONSTRAINT `prestacao_ibfk_5` FOREIGN KEY (`idcurso`) REFERENCES `curso` (`idcurso`) ON UPDATE NO ACTION,
  CONSTRAINT `prestacao_ibfk_7` FOREIGN KEY (`user_session_id`) REFERENCES `utilizador` (`id`) ON UPDATE NO ACTION,
  CONSTRAINT `prestacao_ibfk_8` FOREIGN KEY (`status`) REFERENCES `status` (`idstatus`) ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table sigairis.prestacao: ~3 rows (approximately)
DELETE FROM `prestacao`;
/*!40000 ALTER TABLE `prestacao` DISABLE KEYS */;
INSERT INTO `prestacao` (`valor`, `datapay`, `idjuro`, `status`, `modepay`, `idactividade`, `idcurso`, `iduser`, `user_session_id`) VALUES
	(202, '2021-06-19', 1, 1, 'Cash', 2, 1, 4, 1),
	(1010, '2021-06-19', 1, 1, 'Cash', 1, 1, 2, 1),
	(202, '2021-06-19', 1, 1, 'Cash', 2, 1, 2, 1);
/*!40000 ALTER TABLE `prestacao` ENABLE KEYS */;

-- Dumping structure for table sigairis.previlegio
DROP TABLE IF EXISTS `previlegio`;
CREATE TABLE IF NOT EXISTS `previlegio` (
  `idprevilegio` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(255) DEFAULT NULL,
  `tipo` varchar(255) NOT NULL,
  PRIMARY KEY (`idprevilegio`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table sigairis.previlegio: ~2 rows (approximately)
DELETE FROM `previlegio`;
/*!40000 ALTER TABLE `previlegio` DISABLE KEYS */;
INSERT INTO `previlegio` (`idprevilegio`, `descricao`, `tipo`) VALUES
	(1, 'Aluno', 'aluno'),
	(2, 'Registo Academico', 'racademico'),
	(3, 'Direccao', 'direcao');
/*!40000 ALTER TABLE `previlegio` ENABLE KEYS */;

-- Dumping structure for table sigairis.provincia
DROP TABLE IF EXISTS `provincia`;
CREATE TABLE IF NOT EXISTS `provincia` (
  `idprovincia` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`idprovincia`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table sigairis.provincia: ~2 rows (approximately)
DELETE FROM `provincia`;
/*!40000 ALTER TABLE `provincia` DISABLE KEYS */;
INSERT INTO `provincia` (`idprovincia`, `descricao`) VALUES
	(1, 'C. Delgado'),
	(2, 'Nampula');
/*!40000 ALTER TABLE `provincia` ENABLE KEYS */;

-- Dumping structure for table sigairis.status
DROP TABLE IF EXISTS `status`;
CREATE TABLE IF NOT EXISTS `status` (
  `idstatus` int(11) NOT NULL AUTO_INCREMENT,
  `value` int(11) NOT NULL,
  `descricao` varchar(255) NOT NULL,
  PRIMARY KEY (`idstatus`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Dumping data for table sigairis.status: ~5 rows (approximately)
DELETE FROM `status`;
/*!40000 ALTER TABLE `status` DISABLE KEYS */;
INSERT INTO `status` (`idstatus`, `value`, `descricao`) VALUES
	(1, 1, 'Pago'),
	(2, 2, 'Nao Pago'),
	(3, 3, 'Activo'),
	(4, 4, 'Inativo'),
	(5, 5, 'Em andamento');
/*!40000 ALTER TABLE `status` ENABLE KEYS */;

-- Dumping structure for table sigairis.turma
DROP TABLE IF EXISTS `turma`;
CREATE TABLE IF NOT EXISTS `turma` (
  `idturma` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(255) NOT NULL,
  `idcurso` int(11) DEFAULT NULL,
  PRIMARY KEY (`idturma`),
  KEY `idcurso` (`idcurso`),
  CONSTRAINT `turma_ibfk_1` FOREIGN KEY (`idcurso`) REFERENCES `curso` (`idcurso`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Dumping data for table sigairis.turma: ~5 rows (approximately)
DELETE FROM `turma`;
/*!40000 ALTER TABLE `turma` DISABLE KEYS */;
INSERT INTO `turma` (`idturma`, `descricao`, `idcurso`) VALUES
	(1, 'Turma [1]', 1),
	(2, 'Turma [2]', 1),
	(3, 'Turma [3]', 1),
	(4, 'Turma [4]', 1),
	(5, 'Turma [5]', 1);
/*!40000 ALTER TABLE `turma` ENABLE KEYS */;

-- Dumping structure for table sigairis.turno
DROP TABLE IF EXISTS `turno`;
CREATE TABLE IF NOT EXISTS `turno` (
  `idturno` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(255) NOT NULL,
  PRIMARY KEY (`idturno`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table sigairis.turno: ~0 rows (approximately)
DELETE FROM `turno`;
/*!40000 ALTER TABLE `turno` DISABLE KEYS */;
/*!40000 ALTER TABLE `turno` ENABLE KEYS */;

-- Dumping structure for table sigairis.utilizador
DROP TABLE IF EXISTS `utilizador`;
CREATE TABLE IF NOT EXISTS `utilizador` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` varchar(255) DEFAULT NULL,
  `fullname` varchar(255) DEFAULT NULL,
  `sexo` char(1) CHARACTER SET utf8 NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `documento` varchar(255) DEFAULT NULL,
  `datanasc` date DEFAULT NULL,
  `nivelescolar` int(255) DEFAULT NULL,
  `idprevilegio` int(11) DEFAULT NULL,
  `iddistrito` int(11) DEFAULT NULL,
  `estadocivil` int(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `celular1` varchar(50) DEFAULT NULL,
  `celular2` varchar(50) DEFAULT NULL,
  `endereco1` varchar(255) DEFAULT NULL,
  `endereco2` varchar(255) DEFAULT NULL,
  `data_added` date NOT NULL,
  `idcurso` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idprevilegio` (`idprevilegio`),
  KEY `FK_utilizador_distrito` (`iddistrito`),
  KEY `FK_utilizador_curso` (`idcurso`),
  CONSTRAINT `FK_utilizador_curso` FOREIGN KEY (`idcurso`) REFERENCES `curso` (`idcurso`),
  CONSTRAINT `FK_utilizador_distrito` FOREIGN KEY (`iddistrito`) REFERENCES `distrito` (`iddistrito`),
  CONSTRAINT `utilizador_ibfk_2` FOREIGN KEY (`idprevilegio`) REFERENCES `previlegio` (`idprevilegio`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Dumping data for table sigairis.utilizador: ~4 rows (approximately)
DELETE FROM `utilizador`;
/*!40000 ALTER TABLE `utilizador` DISABLE KEYS */;
INSERT INTO `utilizador` (`id`, `codigo`, `fullname`, `sexo`, `username`, `password`, `documento`, `datanasc`, `nivelescolar`, `idprevilegio`, `iddistrito`, `estadocivil`, `email`, `celular1`, `celular2`, `endereco1`, `endereco2`, `data_added`, `idcurso`) VALUES
	(1, '9762021', 'Caudencio da Silva Fernando', 'M', 'csilva', '123456', '018800291892', '2021-06-16', 1, 2, 1, 1, 'csilva@gmail.com', '8490018289', '92839200', 'Natite', 'Natite', '2021-06-16', NULL),
	(2, '992021', 'Raimundo Jose', 'M', 'rjose', '123456', '902913`132`3', '2021-06-18', 4, 1, 1, 1, 'jhraimundo3@gmail.com', '91723737723', '', 'Natite', 'Natite', '2021-06-18', 1),
	(3, '072021', 'Amelia Camilo', 'F', 'acamilo', '123456', '0192735671882', '2021-06-08', 1, 1, 1, 1, 'acamilo@gmail.com', '8590937782', '81225627281', 'Gingone', 'Gingone', '2021-06-18', 1),
	(4, '2752021', 'Ana Camilo', 'F', 'asintia', '123456', '0192735671882', '2021-06-08', 1, 1, 1, 1, 'asintia@gmail.com', '8590937782', '81225627281', 'Gingone', 'Gingone', '2021-06-18', 1),
	(5, '42021', 'Emenia Camilo', 'F', 'ecamilo', '123456', '9129139217390273', '2021-06-08', 1, 1, 2, 1, 'ecamilo@gmail.com', '892383', '22182838', 'Natite', 'Natite', '2021-06-19', 1);
/*!40000 ALTER TABLE `utilizador` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
