-- --------------------------------------------------------
-- Anfitrião:                    localhost
-- Versão do servidor:           5.7.24 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Versão:              10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for sigairis
CREATE DATABASE IF NOT EXISTS `sigairis` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `sigairis`;

-- Dumping structure for table sigairis.actividade
CREATE TABLE IF NOT EXISTS `actividade` (
  `idactividade` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(255) DEFAULT NULL,
  `data_inicio` date DEFAULT NULL,
  `data_fim` date DEFAULT NULL,
  `idutilizador` int(11) DEFAULT NULL,
  `idcurso` int(11) NOT NULL,
  `data_added` date DEFAULT NULL,
  PRIMARY KEY (`idactividade`,`idcurso`),
  KEY `idutilizador` (`idutilizador`),
  KEY `idcurso` (`idcurso`),
  CONSTRAINT `actividade_ibfk_1` FOREIGN KEY (`idutilizador`) REFERENCES `utilizador` (`id`),
  CONSTRAINT `actividade_ibfk_2` FOREIGN KEY (`idcurso`) REFERENCES `curso` (`idcurso`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.

-- Dumping structure for table sigairis.curso
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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.

-- Dumping structure for table sigairis.despesa
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

-- Data exporting was unselected.

-- Dumping structure for table sigairis.disciplina
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
) ENGINE=InnoDB AUTO_INCREMENT=481 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.

-- Dumping structure for table sigairis.distrito
CREATE TABLE IF NOT EXISTS `distrito` (
  `iddistrito` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(255) NOT NULL,
  `idprovincia` int(11) NOT NULL,
  PRIMARY KEY (`iddistrito`),
  KEY `idprovincia` (`idprovincia`),
  CONSTRAINT `distrito_ibfk_1` FOREIGN KEY (`idprovincia`) REFERENCES `provincia` (`idprovincia`)
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.

-- Dumping structure for table sigairis.encarregado
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

-- Data exporting was unselected.

-- Dumping structure for table sigairis.inscricao
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

-- Data exporting was unselected.

-- Dumping structure for table sigairis.juro
CREATE TABLE IF NOT EXISTS `juro` (
  `idjuro` int(11) NOT NULL AUTO_INCREMENT,
  `juro` double DEFAULT NULL,
  PRIMARY KEY (`idjuro`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.

-- Dumping structure for table sigairis.notafinal
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

-- Data exporting was unselected.

-- Dumping structure for table sigairis.perfil
CREATE TABLE IF NOT EXISTS `perfil` (
  `idperfil` int(11) NOT NULL AUTO_INCREMENT,
  `diretor` varchar(255) DEFAULT NULL,
  `nome_instituicao` varchar(255) DEFAULT NULL,
  `data_registo` date DEFAULT NULL,
  `idendereco` int(11) DEFAULT NULL,
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
  KEY `idutilizador_resp` (`diretor`),
  KEY `idendereco` (`idendereco`),
  CONSTRAINT `perfil_ibfk_2` FOREIGN KEY (`idendereco`) REFERENCES `endereco` (`idendereco`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.

-- Dumping structure for table sigairis.periodo
CREATE TABLE IF NOT EXISTS `periodo` (
  `idperiodo` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`idperiodo`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.

-- Dumping structure for table sigairis.prestacao
CREATE TABLE IF NOT EXISTS `prestacao` (
  `valor` double DEFAULT NULL,
  `datapay` date DEFAULT NULL,
  `idjuro` int(11) NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL,
  `modepay` varchar(255) DEFAULT NULL,
  `idfinalidade` int(11) NOT NULL,
  `idcurso` int(11) NOT NULL,
  `idaluno` int(11) NOT NULL,
  `user_session_id` int(11) NOT NULL,
  PRIMARY KEY (`idjuro`,`status`,`idfinalidade`,`idcurso`,`idaluno`),
  KEY `idpagamento` (`idjuro`),
  KEY `idfinalidade` (`idfinalidade`),
  KEY `idcurso` (`idcurso`),
  KEY `idaluno` (`idaluno`),
  KEY `user_session_id` (`user_session_id`),
  KEY `status` (`status`),
  CONSTRAINT `prestacao_ibfk_2` FOREIGN KEY (`idjuro`) REFERENCES `juro` (`idjuro`),
  CONSTRAINT `prestacao_ibfk_4` FOREIGN KEY (`idfinalidade`) REFERENCES `pay_finality` (`idfinalidade`),
  CONSTRAINT `prestacao_ibfk_5` FOREIGN KEY (`idcurso`) REFERENCES `curso` (`idcurso`),
  CONSTRAINT `prestacao_ibfk_6` FOREIGN KEY (`idaluno`) REFERENCES `aluno` (`idaluno`),
  CONSTRAINT `prestacao_ibfk_7` FOREIGN KEY (`user_session_id`) REFERENCES `utilizador` (`id`),
  CONSTRAINT `prestacao_ibfk_8` FOREIGN KEY (`status`) REFERENCES `status` (`idstatus`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.

-- Dumping structure for table sigairis.previlegio
CREATE TABLE IF NOT EXISTS `previlegio` (
  `idprevilegio` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(255) DEFAULT NULL,
  `tipo` varchar(255) NOT NULL,
  PRIMARY KEY (`idprevilegio`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.

-- Dumping structure for table sigairis.provincia
CREATE TABLE IF NOT EXISTS `provincia` (
  `idprovincia` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`idprovincia`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.

-- Dumping structure for table sigairis.status
CREATE TABLE IF NOT EXISTS `status` (
  `idstatus` int(11) NOT NULL AUTO_INCREMENT,
  `value` int(11) NOT NULL,
  `descricao` varchar(255) NOT NULL,
  PRIMARY KEY (`idstatus`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.

-- Dumping structure for table sigairis.turma
CREATE TABLE IF NOT EXISTS `turma` (
  `idturma` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(255) NOT NULL,
  `idcurso` int(11) DEFAULT NULL,
  PRIMARY KEY (`idturma`),
  KEY `idcurso` (`idcurso`),
  CONSTRAINT `turma_ibfk_1` FOREIGN KEY (`idcurso`) REFERENCES `curso` (`idcurso`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.

-- Dumping structure for table sigairis.turno
CREATE TABLE IF NOT EXISTS `turno` (
  `idturno` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(255) NOT NULL,
  PRIMARY KEY (`idturno`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.

-- Dumping structure for table sigairis.utilizador
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
  PRIMARY KEY (`id`),
  KEY `idprevilegio` (`idprevilegio`),
  KEY `FK_utilizador_distrito` (`iddistrito`),
  CONSTRAINT `FK_utilizador_distrito` FOREIGN KEY (`iddistrito`) REFERENCES `distrito` (`iddistrito`),
  CONSTRAINT `utilizador_ibfk_2` FOREIGN KEY (`idprevilegio`) REFERENCES `previlegio` (`idprevilegio`)
) ENGINE=InnoDB AUTO_INCREMENT=127 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
