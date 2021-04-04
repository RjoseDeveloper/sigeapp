-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.7.24 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for pautas_fe
CREATE DATABASE IF NOT EXISTS `pautas_fe` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `pautas_fe`;

-- Dumping structure for table pautas_fe.actividade
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

-- Dumping data for table pautas_fe.actividade: ~0 rows (approximately)
DELETE FROM `actividade`;
/*!40000 ALTER TABLE `actividade` DISABLE KEYS */;
INSERT INTO `actividade` (`idactividade`, `descricao`, `data_inicio`, `data_fim`, `idutilizador`, `idcurso`, `data_added`) VALUES
	(1, 'Teste 1', '2019-09-02', '2019-10-30', 105, 1, '2019-10-02');
/*!40000 ALTER TABLE `actividade` ENABLE KEYS */;

-- Dumping structure for table pautas_fe.curso
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

-- Dumping data for table pautas_fe.curso: ~5 rows (approximately)
DELETE FROM `curso`;
/*!40000 ALTER TABLE `curso` DISABLE KEYS */;
INSERT INTO `curso` (`descricao`, `codigo`, `data_registo`, `idcurso`, `qtd_turmas`, `taxa_matricula`, `idperiodo`, `coordenador`, `details`) VALUES
	('8ª Classe', '2001', '2019-02-15', 1, 4, 600, 1, 136, ''),
	('9ª Classe', '2002', '2019-02-15', 2, 4, 600, 1, 74, ''),
	('10ª Classe', '2003', '2019-02-15', 3, 4, 600, 1, 75, ''),
	('11ª Classe', '2004', '2019-02-15', 4, 4, 700, 1, 70, ''),
	('12ª Classe', '2018', '2019-09-05', 5, 2, 700, 1, 135, NULL);
/*!40000 ALTER TABLE `curso` ENABLE KEYS */;

-- Dumping structure for table pautas_fe.despesa
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

-- Dumping data for table pautas_fe.despesa: ~0 rows (approximately)
DELETE FROM `despesa`;
/*!40000 ALTER TABLE `despesa` DISABLE KEYS */;
INSERT INTO `despesa` (`iddespesa`, `details`, `data_reg`, `valor`, `idorcamento`, `idutilizador`) VALUES
	(3, 'sdsd', '2021-03-26', 213213, 2, 74);
/*!40000 ALTER TABLE `despesa` ENABLE KEYS */;

-- Dumping structure for table pautas_fe.disciplina
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

-- Dumping data for table pautas_fe.disciplina: ~192 rows (approximately)
DELETE FROM `disciplina`;
/*!40000 ALTER TABLE `disciplina` DISABLE KEYS */;
INSERT INTO `disciplina` (`idDisciplina`, `creditos`, `descricao`, `codigo`, `data_registo`, `natureza`, `anolectivo`, `idcurso`) VALUES
	(1, 4, 'Metodologias de Estudo Científico', 2021104, '2019-08-30', '2013', 1, 2),
	(6, 4, 'Introdução à Informática para Engenharia', 2131103, '2019-08-30', '2018', 1, 2),
	(291, 4, 'Introdução à Informática para Engenharia', 2061105, '2019-08-30', '2018', 1, 1),
	(292, 3, 'Técnicas de Expressão e Comunicação', 2011101, '2019-08-30', '2013', 1, 1),
	(293, 3, 'Inglês I', 2061102, '2019-08-30', '2018', 1, 1),
	(294, 4, 'Técnicas de Expressão e Comunicação', 2061101, '2019-08-30', '2018', 1, 1),
	(295, 6, 'Calculo I', 2011105, '2019-08-30', '2013', 1, 1),
	(296, 5, 'Física I', 2061106, '2019-08-30', '2018', 1, 1),
	(297, 5, 'Aplicacionais para Ciências e Engenharia', 2011106, '2019-08-30', '2013', 1, 1),
	(298, 5, 'Álgebra Linear e Geometria Analítica', 2011103, '2019-08-30', '2013', 1, 1),
	(299, 4, 'Mecânica e Ondas', 2011107, '2019-08-30', '2013', 1, 1),
	(300, 6, 'Cálculo I', 2061104, '2019-08-30', '2018', 1, 1),
	(301, 6, 'Calculo II', 2011212, '2019-08-30', '2013', 1, 1),
	(302, 6, 'Introdução à Organização dos Computadores', 2011213, '2019-08-30', '2013', 1, 1),
	(303, 5, 'Fundamentos da Programação', 2061207, '2019-08-30', '2018', 1, 1),
	(304, 4, 'Electricidade e Magnetismo', 2011211, '2019-08-30', '2013', 1, 1),
	(305, 4, 'Inglês Específico para Engenharia Informática', 2011210, '2019-08-30', '2013', 1, 1),
	(306, 6, 'Fundamentos da Programação', 2011208, '2019-08-30', '2013', 1, 1),
	(307, 5, 'Álgebra Linear e Geometria Analítica', 2061212, '2019-08-30', '2018', 1, 1),
	(308, 6, 'Cálculo II', 2061211, '2019-08-30', '2018', 1, 1),
	(309, 5, 'Física II', 2061210, '2019-08-30', '2018', 1, 1),
	(310, 4, 'Inglês II', 2061209, '2019-08-30', '2018', 1, 1),
	(311, 5, 'Arquitectura de Computadores', 2061208, '2019-08-30', '2018', 1, 1),
	(312, 6, 'Cálculo III', 2062117, '2019-08-30', '2018', 2, 1),
	(313, 5, 'Programação', 2012114, '2019-08-30', '2013', 2, 1),
	(314, 3, 'Desenvolvimento Comunitário Aplicado à Engenharia I', 2012115, '2019-08-30', '2013', 2, 1),
	(318, 6, 'Arquitectura de Computadores', 2012119, '2019-08-30', '2013', 2, 1),
	(319, 4, 'Probabilidade e Métodos Estatísticos', 2062114, '2019-08-30', '2018', 2, 1),
	(320, 5, 'Introdução a Base de Dados', 2062116, '2019-08-30', '2018', 2, 1),
	(321, 4, 'Sistemas e Tecnologias de Informação', 2062118, '2019-08-30', '2018', 2, 1),
	(322, 5, 'Redes de Computadores I', 2062115, '2019-08-30', '2018', 2, 1),
	(323, 6, 'Programação', 2062113, '2019-08-30', '2018', 2, 1),
	(324, 3, 'Desenvolvimento Comunitário Aplicado à Engenharia II', 2012221, '2019-08-30', '2013', 2, 1),
	(325, 6, 'Programação Orientada por Objectos', 2012220, '2019-08-30', '2013', 2, 1),
	(326, 4, 'Métodos Numéricos', 2062220, '2019-08-30', '2018', 2, 1),
	(327, 6, 'Programação Orientada por Objectos', 2062219, '2019-08-30', '2018', 2, 1),
	(328, 5, 'Sistemas de Base de Dados', 2062223, '2019-08-30', '2018', 2, 1),
	(329, 5, 'Microprocessadores e Computadores Pessoais', 2062224, '2019-08-30', '2018', 2, 1),
	(330, 6, 'Redes de Computadores II', 2062221, '2019-08-30', '2018', 2, 1),
	(331, 4, 'Interacção Humano-Computador', 2062222, '2019-08-30', '2018', 2, 1),
	(332, 5, 'Microprocessadores e Computadores Pessoais', 2012225, '2019-08-30', '2013', 2, 1),
	(333, 6, 'Introdução as Base de Dados', 2012224, '2019-08-30', '2013', 2, 1),
	(334, 5, 'Sistemas e Tecnologias de Informação', 2012223, '2019-08-30', '2013', 2, 1),
	(335, 5, 'Redes de Computadores', 2012222, '2019-08-30', '2013', 2, 1),
	(336, 5, 'Laboratório de Redes de Computadores', 2013127, '2019-08-30', '2013', 3, 1),
	(337, 4, 'Laboratório de Computadores', 2013131, '2019-08-30', '2013', 3, 1),
	(338, 6, 'Engenharia de Software I', 2013129, '2019-08-30', '2013', 3, 1),
	(339, 5, 'Algoritmos de Programação e Estrutura de Dados', 2013126, '2019-08-30', '2013', 3, 1),
	(340, 5, 'Algoritmos de Programação e Estrutura de Dados', 2063125, '2019-08-30', '2018', 3, 1),
	(341, 6, 'Laboratório de Redes de Computadores', 2063126, '2019-08-30', '2018', 3, 1),
	(342, 5, 'Sistemas Distribuídos', 2063127, '2019-08-30', '2018', 3, 1),
	(343, 4, 'Engenharia de Software I', 2063128, '2019-08-30', '2018', 3, 1),
	(344, 6, 'Laboratório de Base de Dados', 2063129, '2019-08-30', '2018', 3, 1),
	(345, 4, 'Electrónica Aplicada', 2063130, '2019-08-30', '2018', 3, 1),
	(346, 6, 'Laboratório de Computadores', 2063234, '2019-08-30', '2018', 3, 1),
	(347, 6, 'Segurança Informática e de Redes de Computadores', 2063235, '2019-08-30', '2018', 3, 1),
	(348, 6, 'Sistemas de Base de Dados', 2013130, '2019-08-30', '2013', 3, 1),
	(354, 6, 'Programação Web', 2063231, '2019-08-30', '2018', 3, 1),
	(355, 6, 'Sistemas Operativos', 2063232, '2019-08-30', '2018', 3, 1),
	(356, 6, 'Engenharia de Software II', 2013235, '2019-08-30', '2013', 3, 1),
	(357, 6, 'Engenharia de Software II', 2063233, '2019-08-30', '2018', 3, 1),
	(358, 6, 'Projecto de Licenciatura', 2014141, '2019-08-30', '2013', 4, 1),
	(359, 6, 'Sistemas Distribuídos', 2014137, '2019-08-30', '2013', 4, 1),
	(360, 6, 'Investigação Operacional', 2014138, '2019-08-30', '2013', 4, 1),
	(361, 6, 'Gestão de Projectos Informáticos', 2014139, '2019-08-30', '2013', 4, 1),
	(362, 6, 'Laboratório de Engenharia de Software', 2014140, '2019-08-30', '2013', 4, 1),
	(363, 4, 'Noções de Gestão e Empreendedorismo', 2064136, '2019-08-30', '2018', 4, 1),
	(364, 4, 'Investigação Operacional', 2064137, '2019-08-30', '2018', 4, 1),
	(365, 6, 'Gestão de Projectos Informáticos', 2064138, '2019-08-30', '2018', 4, 1),
	(366, 6, 'Laboratório de Engenharia de Software', 2064139, '2019-08-30', '2018', 4, 1),
	(367, 4, 'Desenvolvimento Comunitário Aplicado à Engenharia I', 2064140, '2019-08-30', '2018', 4, 1),
	(368, 6, 'Inteligência Artificial', 2064141, '2019-08-30', '2018', 4, 1),
	(369, 4, 'Aspectos Profissionais e Sociais da Computação', 2064244, '2019-08-30', '2018', 4, 1),
	(370, 5, 'Higiene e Segurança no Trabalho', 2064242, '2019-08-30', '2018', 4, 1),
	(371, 3, 'Metodologia de Investigação Científica', 2064246, '2019-08-30', '2018', 4, 1),
	(372, 6, 'Sistemas Multimédia', 2064243, '2019-08-30', '2018', 4, 1),
	(373, 12, 'Desenvolvimento Comunitário Aplicado à Engenharia II', 2064245, '2019-08-30', '2018', 4, 1),
	(374, 30, 'TCC: Revisão Bibliográfica, Projecto de Investigação e Inovação, Estágio Profissional', 2014242, '2019-08-30', '2013', 4, 1),
	(375, 30, 'Trabalho de Conclusão do Curso: Monografia /Projecto / Estágio.', 2065147, '2019-08-30', '2018', 5, 1),
	(376, 5, 'Física I', 2141107, '2019-08-30', '2018', 1, 3),
	(377, 4, 'Metodologia de Estudo Científico', 2031104, '2019-08-30', '2013', 1, 3),
	(378, 6, 'Cálculo I', 2141105, '2019-08-30', '2018', 1, 3),
	(379, 4, 'Introdução a Informática para Engenharia', 2141106, '2019-08-30', '2018', 1, 3),
	(380, 4, 'Química geral', 2141104, '2019-08-30', '2018', 1, 3),
	(381, 3, 'Inglês I', 2031102, '2019-08-30', '2013', 1, 3),
	(382, 3, 'Técnicas de Expressão e Comunicação', 2031101, '2019-08-30', '2013', 1, 3),
	(383, 5, 'Desenho de Construções Mecânicas', 2141103, '2019-08-30', '2018', 1, 3),
	(384, 4, 'Técnicas de Expressão e Comunicação', 2141101, '2019-08-30', '2018', 1, 3),
	(385, 3, 'Inglês I', 2141102, '2019-08-30', '2018', 1, 3),
	(386, 5, 'Aplicacionais para Ciências e Engenharia', 2031106, '2019-08-30', '2013', 1, 3),
	(387, 5, 'Álgebra Linear e Geometria Analítica', 2031103, '2019-08-30', '2013', 1, 3),
	(388, 4, 'Física Geral', 2031107, '2019-08-30', '2013', 1, 3),
	(389, 6, 'Cálculo I', 2031105, '2019-08-30', '2013', 1, 3),
	(390, 4, 'Desenho de Construções Mecânicas', 2032116, '2019-08-30', '2013', 1, 3),
	(391, 3, 'Eletrotecnia e Electrónica', 2031214, '2019-08-30', '2013', 1, 3),
	(392, 5, 'Ciência e Tecnologia dos Materiais', 2031208, '2019-08-30', '2013', 1, 3),
	(393, 6, 'Cálculo II', 2031212, '2019-08-30', '2013', 1, 3),
	(394, 5, 'Mecânica Geral', 2031211, '2019-08-30', '2013', 1, 3),
	(395, 3, 'Métodos Numéricos em Engenharia', 2031209, '2019-08-30', '2013', 1, 3),
	(396, 6, 'Cálculo II', 2031212, '2019-08-30', '2013', 1, 3),
	(397, 3, 'Eletrotecnia e Electrónica', 2031214, '2019-08-30', '2013', 1, 3),
	(398, 3, 'Inglês II', 2141214, '2019-08-30', '2018', 1, 3),
	(399, 4, 'Desenho Assistido por Computador', 2141213, '2019-08-30', '2018', 1, 3),
	(400, 6, 'Cálculo II', 2141212, '2019-08-30', '2018', 1, 3),
	(401, 5, 'Física II', 2141211, '2019-08-30', '2018', 1, 3),
	(402, 4, 'Mecânica dos Sólidos', 2141210, '2019-08-30', '2018', 1, 3),
	(403, 5, 'Álgebra Linear e Geometria Analítica', 2141209, '2019-08-30', '2018', 1, 3),
	(404, 4, 'Desenho e Métodos Gráficos', 2031213, '2019-08-30', '2013', 2, 3),
	(405, 6, 'Cálculo III', 2032115, '2019-08-30', '2013', 2, 3),
	(406, 4, 'Termodinâmica', 2032117, '2019-08-30', '2013', 2, 3),
	(407, 4, 'Automação Industrial', 2032118, '2019-08-30', '2013', 2, 3),
	(408, 5, 'Mecânica dos Materiais I', 2032119, '2019-08-30', '2013', 2, 3),
	(409, 4, 'Metalurgia Mecânica', 2032120, '2019-08-30', '2013', 2, 3),
	(410, 3, 'Desenvolvimento Comunitário Aplicado à Engenharia I', 2032121, '2019-08-30', '2013', 2, 3),
	(411, 6, 'Cálculo III', 2142115, '2019-08-30', '2018', 2, 3),
	(412, 3, 'Probabilidade e Métodos Estatísticos', 2142116, '2019-08-30', '2018', 2, 3),
	(413, 4, 'Termodinâmica', 2142117, '2019-08-30', '2018', 2, 3),
	(414, 5, 'Mecânica dos Fluidos e Máquinas Hidráulicas', 2142118, '2019-08-30', '2018', 2, 3),
	(415, 5, 'Resistências dos Materiais I', 2142119, '2019-08-30', '2018', 2, 3),
	(416, 4, 'Ciência e Tecnologia dos Materiais', 2142120, '2019-08-30', '2018', 2, 3),
	(417, 4, 'Higiene e Segurança no Trabalho', 2142121, '2019-08-30', '2018', 2, 3),
	(418, 4, 'Métodos Numéricos', 2142223, '2019-08-30', '2018', 2, 3),
	(419, 5, 'Resistências dos Materiais II', 2142225, '2019-08-30', '2018', 2, 3),
	(420, 5, 'Oficinas Mecânicas', 2142227, '2019-08-30', '2018', 2, 3),
	(421, 5, 'Mecânica dos Fluidos', 2032223, '2019-08-30', '2013', 2, 3),
	(422, 4, 'Transferência de Calor', 2032226, '2019-08-30', '2013', 2, 3),
	(423, 5, 'Mecânica dos Materiais II', 2032225, '2019-08-30', '2013', 2, 3),
	(424, 4, 'Mecânica Computacional', 2032222, '2019-08-30', '2013', 2, 3),
	(425, 4, 'Tratamentos Térmicos', 2032227, '2019-08-30', '2013', 2, 3),
	(426, 5, 'Oleoidáulica', 2032224, '2019-08-30', '2013', 2, 3),
	(427, 5, 'Metalurgia Mecânica', 2142222, '2019-08-30', '2018', 2, 3),
	(428, 5, 'Transferência de Calor', 2142226, '2019-08-30', '2018', 2, 3),
	(429, 3, 'Desenvolvimento Comunitário Aplicado à Engenharia II', 2032228, '2019-08-30', '2013', 2, 3),
	(430, 5, 'Sistemas Hidráulicos e Pneumáticos', 2142224, '2019-08-30', '2018', 2, 3),
	(431, 3, 'Análise de Circuitos Eléctricos', 2143133, '2019-08-30', '2018', 3, 3),
	(432, 6, 'Órgão de Máquinas I', 2143132, '2019-08-30', '2018', 3, 3),
	(433, 4, 'Controlo de Processos', 2143131, '2019-08-30', '2018', 3, 3),
	(434, 4, 'Máquinas e Mecanismos', 2143128, '2019-08-30', '2018', 3, 3),
	(435, 5, 'Conformação Plástica dos Metais e Fundição', 2143130, '2019-08-30', '2018', 3, 3),
	(436, 5, 'Metrologia Industrial', 2033134, '2019-08-30', '2013', 3, 3),
	(437, 5, 'Tribologia e Manutenção Industrial', 2033133, '2019-08-30', '2013', 3, 3),
	(438, 5, 'Tecnologia do Fabrico I', 2033132, '2019-08-30', '2013', 3, 3),
	(439, 5, 'Tecnologia da Fundição', 2033131, '2019-08-30', '2013', 3, 3),
	(440, 5, 'Controlo de Processos', 2033130, '2019-08-30', '2013', 3, 3),
	(441, 5, 'Mecânica dos Matérias III', 2033129, '2019-08-30', '2013', 3, 3),
	(442, 3, 'Desenvolvimento Comunitário I', 2143134, '2019-08-30', '2018', 3, 3),
	(443, 5, 'Máquinas Térmicas', 2143129, '2019-08-30', '2018', 3, 3),
	(444, 4, 'Automação Industrial', 2143235, '2019-08-30', '2018', 3, 3),
	(445, 5, 'Máquinas Térmicas e de Fluidos', 2033236, '2019-08-30', '2013', 3, 3),
	(446, 5, 'Energética Industrial', 2033235, '2019-08-30', '2013', 3, 3),
	(447, 5, 'Tecnologia do Fabrico II', 2033238, '2019-08-30', '2013', 3, 3),
	(448, 5, 'Motores Alternativos', 2143236, '2019-08-30', '2018', 3, 3),
	(449, 4, 'Maquinas Eléctricas', 2143237, '2019-08-30', '2018', 3, 3),
	(450, 5, 'Usinagem e Tratamentos Térmicos', 2143238, '2019-08-30', '2018', 3, 3),
	(451, 6, 'Órgão de Máquinas II', 2143239, '2019-08-30', '2018', 3, 3),
	(452, 4, 'Manutenção Industrial', 2143240, '2019-08-30', '2018', 3, 3),
	(453, 3, 'Desenvolvimento Comunitário II', 2143241, '2019-08-30', '2018', 3, 3),
	(454, 5, 'Tecnologia da Soldadura', 2033237, '2019-08-30', '2013', 3, 3),
	(455, 6, 'Órgãos de Máquinas I', 2033239, '2019-08-30', '2013', 3, 3),
	(456, 4, 'Análise de Custos Industriais', 2033240, '2019-08-30', '2013', 3, 3),
	(457, 5, 'Projeto de Redes de Fluidos', 2034143, '2019-08-30', '2013', 4, 3),
	(458, 5, 'Projecto Mecânico', 2034144, '2019-08-30', '2013', 4, 3),
	(459, 6, 'Projecto Mecânico', 2144142, '2019-08-30', '2018', 4, 3),
	(460, 5, 'Estruturas Metálicas', 2144143, '2019-08-30', '2018', 4, 3),
	(461, 6, 'Projeto de Redes de Fluidos', 2144144, '2019-08-30', '2018', 4, 3),
	(462, 4, 'Investigação Operacional ', 2144145, '2019-08-30', '2018', 4, 3),
	(463, 5, 'Energias Renováveis', 2144146, '2019-08-30', '2018', 4, 3),
	(464, 4, 'Electrónica Industrial', 2144147, '2019-08-30', '2018', 4, 3),
	(465, 5, 'Estruturas Metálicas', 2034142, '2019-08-30', '2013', 4, 3),
	(466, 4, 'Organização e Gestão da Produção', 2034146, '2019-08-30', '2013', 4, 3),
	(467, 5, 'Energia e Ambiente', 2034145, '2019-08-30', '2013', 4, 3),
	(468, 6, 'Órgãos de Máquinas II', 2034141, '2019-08-30', '2013', 4, 3),
	(469, 4, 'Metodologia de Investigação Cientifica', 2144248, '2019-08-30', '2018', 4, 3),
	(470, 4, 'Engenharia e sociedade', 2144249, '2019-08-30', '2018', 4, 3),
	(471, 30, 'TCC: Revisão Bibliográfica, Projecto de Investigação e Inovação, Estágio Profissional', 2034247, '2019-08-30', '2013', 4, 3),
	(472, 5, 'Actividades Industriais e Ambiente', 2144253, '2019-08-30', '2018', 4, 3),
	(473, 4, 'Noções de Gestão e Empreendedorismo', 2144252, '2019-08-30', '2018', 4, 3),
	(474, 5, 'Metrologia industrial', 2144251, '2019-08-30', '2018', 4, 3),
	(475, 5, 'Organização e Gestão de Produção', 2144250, '2019-08-30', '2018', 4, 3),
	(476, 30, 'Trabalho de Conclusão do Curso: Monografia / Projecto / Estágio.', 2145154, '2019-08-30', '2018', 5, 3),
	(477, 3, 'MCV', 2019, '2019-09-05', 'Teorico/Pratico', 1, 5),
	(478, 5, 'Cristalografia e Mineralogia', 2018, '2019-10-02', 'Teorico/Pratico', 1, 4),
	(479, 5, 'Programação', 2018, '2019-10-09', '', 1, 3),
	(480, 3, 'InfoTeste', 2018, '2019-11-19', 'Laboratorio', 2, 3);
/*!40000 ALTER TABLE `disciplina` ENABLE KEYS */;

-- Dumping structure for table pautas_fe.distrito
CREATE TABLE IF NOT EXISTS `distrito` (
  `iddistrito` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(255) NOT NULL,
  `idprovincia` int(11) NOT NULL,
  PRIMARY KEY (`iddistrito`),
  KEY `idprovincia` (`idprovincia`),
  CONSTRAINT `distrito_ibfk_1` FOREIGN KEY (`idprovincia`) REFERENCES `provincia` (`idprovincia`)
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=latin1;

-- Dumping data for table pautas_fe.distrito: ~44 rows (approximately)
DELETE FROM `distrito`;
/*!40000 ALTER TABLE `distrito` DISABLE KEYS */;
INSERT INTO `distrito` (`iddistrito`, `descricao`, `idprovincia`) VALUES
	(1, '', 1),
	(2, '', 1),
	(3, '', 1),
	(4, '', 1),
	(5, '', 3),
	(6, '', 3),
	(7, '', 1),
	(8, '', 1),
	(9, '', 1),
	(10, '', 1),
	(11, '', 1),
	(12, '', 1),
	(13, '', 1),
	(14, '', 1),
	(15, '', 1),
	(16, '', 3),
	(17, '', 3),
	(18, '', 3),
	(19, '', 3),
	(20, '', 3),
	(21, '', 3),
	(22, '', 3),
	(23, '', 3),
	(24, '', 3),
	(25, '', 3),
	(26, '', 3),
	(27, '', 3),
	(28, '', 3),
	(29, '', 3),
	(30, '', 3),
	(31, '', 3),
	(32, '', 3),
	(33, '', 3),
	(34, '', 3),
	(35, '', 3),
	(36, '', 2),
	(37, '', 2),
	(38, '', 2),
	(39, '', 2),
	(40, '', 2),
	(41, '', 2),
	(42, '', 2),
	(43, '', 2),
	(44, '', 2),
	(45, '', 2),
	(46, '', 2),
	(47, '', 2),
	(48, '', 2);
/*!40000 ALTER TABLE `distrito` ENABLE KEYS */;

-- Dumping structure for table pautas_fe.encarregado
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

-- Dumping data for table pautas_fe.encarregado: ~0 rows (approximately)
DELETE FROM `encarregado`;
/*!40000 ALTER TABLE `encarregado` DISABLE KEYS */;
/*!40000 ALTER TABLE `encarregado` ENABLE KEYS */;

-- Dumping structure for table pautas_fe.inscricao
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
) ENGINE=InnoDB AUTO_INCREMENT=132 DEFAULT CHARSET=latin1;

-- Dumping data for table pautas_fe.inscricao: ~94 rows (approximately)
DELETE FROM `inscricao`;
/*!40000 ALTER TABLE `inscricao` DISABLE KEYS */;
INSERT INTO `inscricao` (`idinscricao`, `idturma`, `iddisciplina`, `idutilizador`, `data_registo`, `idturno`, `status`) VALUES
	(38, 8, 379, 123, '2019-08-30', 1, NULL),
	(39, 6, 291, 124, '2019-09-02', 1, NULL),
	(40, 6, 291, 129, '2019-09-02', 1, NULL),
	(47, 6, 291, 130, '2019-09-03', 1, NULL),
	(48, 6, 291, 130, '2019-09-03', 1, NULL),
	(49, 6, 291, 134, '2019-10-02', 1, NULL),
	(50, 7, 6, 126, '2019-10-02', 1, NULL),
	(51, 6, 291, 183, '2019-10-03', 1, NULL),
	(52, 6, 354, 141, '2019-10-09', 1, NULL),
	(53, 6, 354, 142, '2019-10-09', 1, NULL),
	(54, 6, 354, 140, '2019-10-09', 1, NULL),
	(55, 6, 354, 143, '2019-10-09', 1, NULL),
	(56, 6, 354, 139, '2019-10-09', 1, NULL),
	(57, 8, 479, 280, '2019-10-09', 1, NULL),
	(58, 8, 479, 173, '2019-10-09', 1, NULL),
	(59, 8, 479, 285, '2019-10-09', 1, NULL),
	(60, 8, 479, 297, '2019-10-09', 1, NULL),
	(61, 8, 479, 244, '2019-10-09', 1, NULL),
	(62, 8, 479, 201, '2019-10-09', 1, NULL),
	(63, 8, 479, 262, '2019-10-09', 1, NULL),
	(64, 8, 479, 208, '2019-10-09', 1, NULL),
	(65, 8, 479, 331, '2019-10-09', 1, NULL),
	(66, 8, 479, 251, '2019-10-09', 1, NULL),
	(67, 8, 479, 348, '2019-10-09', 1, NULL),
	(68, 8, 479, 215, '2019-10-09', 1, NULL),
	(69, 8, 479, 319, '2019-10-09', 1, NULL),
	(70, 6, 354, 389, '2019-10-10', 1, NULL),
	(71, 6, 354, 138, '2019-10-10', 1, NULL),
	(72, 6, 354, 390, '2019-10-10', 1, NULL),
	(73, 6, 327, 156, '2019-10-22', 1, NULL),
	(74, 6, 327, 311, '2019-10-22', 1, NULL),
	(75, 6, 318, 160, '2019-10-24', 1, NULL),
	(76, 6, 318, 164, '2019-10-24', 1, NULL),
	(77, 6, 318, 232, '2019-10-24', 1, NULL),
	(78, 6, 318, 171, '2019-10-24', 1, NULL),
	(79, 6, 318, 196, '2019-10-24', 1, NULL),
	(80, 6, 318, 165, '2019-10-24', 1, NULL),
	(81, 6, 318, 425, '2019-10-24', 1, NULL),
	(82, 6, 318, 453, '2019-10-24', 1, NULL),
	(83, 6, 318, 242, '2019-10-24', 1, NULL),
	(84, 6, 318, 439, '2019-10-24', 1, NULL),
	(85, 6, 318, 163, '2019-10-24', 1, NULL),
	(86, 6, 318, 278, '2019-10-24', 1, NULL),
	(87, 6, 318, 205, '2019-10-24', 1, NULL),
	(88, 6, 318, 198, '2019-10-24', 1, NULL),
	(89, 6, 318, 236, '2019-10-24', 1, NULL),
	(90, 6, 318, 194, '2019-10-31', 1, NULL),
	(91, 8, 479, 417, '2019-10-31', 1, NULL),
	(92, 8, 479, 403, '2019-10-31', 1, NULL),
	(93, 8, 479, 401, '2019-10-31', 1, NULL),
	(94, 8, 479, 395, '2019-10-31', 1, NULL),
	(95, 8, 479, 462, '2019-10-31', 1, NULL),
	(96, 8, 479, 400, '2019-10-31', 1, NULL),
	(97, 8, 479, 402, '2019-10-31', 1, NULL),
	(98, 8, 479, 405, '2019-10-31', 1, NULL),
	(99, 8, 479, 154, '2019-10-31', 1, NULL),
	(100, 8, 479, 459, '2019-10-31', 1, NULL),
	(101, 8, 479, 464, '2019-10-31', 1, NULL),
	(102, 8, 479, 452, '2019-10-31', 1, NULL),
	(103, 6, 325, 235, '2019-11-08', 1, NULL),
	(104, 6, 325, 304, '2019-11-08', 1, NULL),
	(105, 6, 325, 193, '2019-11-08', 1, NULL),
	(106, 6, 325, 153, '2019-11-08', 1, NULL),
	(107, 6, 325, 156, '2019-11-08', 1, NULL),
	(108, 6, 325, 197, '2019-11-08', 1, NULL),
	(109, 6, 325, 179, '2019-11-08', 1, NULL),
	(110, 6, 325, 260, '2019-11-08', 1, NULL),
	(111, 8, 480, 123, '2019-11-19', 1, NULL),
	(112, 8, 480, 125, '2019-11-19', 1, NULL),
	(113, 8, 480, 124, '2019-11-19', 1, NULL),
	(114, 8, 480, 126, '2019-11-19', 1, NULL),
	(115, 8, 480, 139, '2019-11-19', 1, NULL),
	(116, 6, 327, 468, '2019-11-19', 1, NULL),
	(117, 6, 327, 477, '2019-11-19', 1, NULL),
	(118, 6, 327, 478, '2019-11-19', 1, NULL),
	(119, 6, 327, 491, '2019-11-19', 1, NULL),
	(120, 6, 327, 304, '2019-11-19', 1, NULL),
	(121, 6, 327, 193, '2019-11-19', 1, NULL),
	(122, 6, 327, 479, '2019-11-19', 1, NULL),
	(123, 6, 327, 260, '2019-11-19', 1, NULL),
	(124, 6, 327, 482, '2019-11-19', 1, NULL),
	(125, 6, 327, 480, '2019-11-19', 1, NULL),
	(126, 6, 327, 307, '2019-11-19', 1, NULL),
	(127, 6, 327, 457, '2019-11-19', 1, NULL),
	(128, 6, 327, 484, '2019-11-19', 1, NULL),
	(129, 6, 327, 206, '2019-11-19', 1, NULL),
	(130, 6, 327, 153, '2019-11-19', 1, NULL),
	(131, 6, 327, 487, '2019-11-19', 1, NULL);
/*!40000 ALTER TABLE `inscricao` ENABLE KEYS */;

-- Dumping structure for table pautas_fe.juro
CREATE TABLE IF NOT EXISTS `juro` (
  `idjuro` int(11) NOT NULL AUTO_INCREMENT,
  `juro` double DEFAULT NULL,
  PRIMARY KEY (`idjuro`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

-- Dumping data for table pautas_fe.juro: ~10 rows (approximately)
DELETE FROM `juro`;
/*!40000 ALTER TABLE `juro` DISABLE KEYS */;
INSERT INTO `juro` (`idjuro`, `juro`) VALUES
	(1, 0),
	(2, 10),
	(3, 20),
	(4, 30),
	(5, 40),
	(6, 50),
	(7, 60),
	(8, 80),
	(9, 100),
	(10, 70);
/*!40000 ALTER TABLE `juro` ENABLE KEYS */;

-- Dumping structure for table pautas_fe.notafinal
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

-- Dumping data for table pautas_fe.notafinal: ~0 rows (approximately)
DELETE FROM `notafinal`;
/*!40000 ALTER TABLE `notafinal` DISABLE KEYS */;
/*!40000 ALTER TABLE `notafinal` ENABLE KEYS */;

-- Dumping structure for table pautas_fe.perfil
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

-- Dumping data for table pautas_fe.perfil: ~2 rows (approximately)
DELETE FROM `perfil`;
/*!40000 ALTER TABLE `perfil` DISABLE KEYS */;
INSERT INTO `perfil` (`idperfil`, `diretor`, `nome_instituicao`, `data_registo`, `idendereco`, `nome2instituicao`, `contacto`, `codigopostal`, `email`, `dirpedagogico`, `logo_url`, `provincia`, `cidade`, `nuit`) VALUES
	(1, 'Fred Charles Nelson', 'Universidade Lurio', '2008-09-25', 1, 'Faculdade de Engenharia', '8352167', '995', 'fe@unilurio.ac.mz', 'Heraclito Comia', '../fragments/img/1560033445_1560032747_unilurio.png', 'Cabo Delgado', 'Pemba', '11239405'),
	(4, 'Marcelino Inacio Caravela', 'Universidade Lurio', '2018-09-25', 2, 'Faculdade de Ciencias Naturais', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
/*!40000 ALTER TABLE `perfil` ENABLE KEYS */;

-- Dumping structure for table pautas_fe.periodo
CREATE TABLE IF NOT EXISTS `periodo` (
  `idperiodo` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`idperiodo`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Dumping data for table pautas_fe.periodo: ~5 rows (approximately)
DELETE FROM `periodo`;
/*!40000 ALTER TABLE `periodo` DISABLE KEYS */;
INSERT INTO `periodo` (`idperiodo`, `descricao`) VALUES
	(1, 'Semestral'),
	(2, 'Trimestral'),
	(3, 'Mensal'),
	(4, 'Semanal'),
	(5, 'Por Hora');
/*!40000 ALTER TABLE `periodo` ENABLE KEYS */;

-- Dumping structure for table pautas_fe.prestacao
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

-- Dumping data for table pautas_fe.prestacao: ~0 rows (approximately)
DELETE FROM `prestacao`;
/*!40000 ALTER TABLE `prestacao` DISABLE KEYS */;
/*!40000 ALTER TABLE `prestacao` ENABLE KEYS */;

-- Dumping structure for table pautas_fe.previlegio
CREATE TABLE IF NOT EXISTS `previlegio` (
  `idprevilegio` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(255) DEFAULT NULL,
  `tipo` varchar(255) NOT NULL,
  PRIMARY KEY (`idprevilegio`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- Dumping data for table pautas_fe.previlegio: ~8 rows (approximately)
DELETE FROM `previlegio`;
/*!40000 ALTER TABLE `previlegio` DISABLE KEYS */;
INSERT INTO `previlegio` (`idprevilegio`, `descricao`, `tipo`) VALUES
	(1, 'Estudante', 'estudante'),
	(2, 'Docente', 'docente'),
	(3, 'Director do Curso', 'coordenador'),
	(4, 'Registo Academico', 'racademico'),
	(5, 'Director da Faculdade', 'director'),
	(6, 'Director Adj. Pedagogico', 'dir_adjunto_pedag'),
	(7, 'Encarregado de Educacao', 'encarregado'),
	(8, 'Docente(Visitante)', 'visitante');
/*!40000 ALTER TABLE `previlegio` ENABLE KEYS */;

-- Dumping structure for table pautas_fe.provincia
CREATE TABLE IF NOT EXISTS `provincia` (
  `idprovincia` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`idprovincia`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

-- Dumping data for table pautas_fe.provincia: ~10 rows (approximately)
DELETE FROM `provincia`;
/*!40000 ALTER TABLE `provincia` DISABLE KEYS */;
INSERT INTO `provincia` (`idprovincia`, `descricao`) VALUES
	(1, ''),
	(2, ''),
	(3, ''),
	(4, ''),
	(5, ''),
	(6, ''),
	(7, ''),
	(8, ''),
	(9, ''),
	(10, '');
/*!40000 ALTER TABLE `provincia` ENABLE KEYS */;

-- Dumping structure for table pautas_fe.status
CREATE TABLE IF NOT EXISTS `status` (
  `idstatus` int(11) NOT NULL AUTO_INCREMENT,
  `value` int(11) NOT NULL,
  `descricao` varchar(255) NOT NULL,
  PRIMARY KEY (`idstatus`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Dumping data for table pautas_fe.status: ~4 rows (approximately)
DELETE FROM `status`;
/*!40000 ALTER TABLE `status` DISABLE KEYS */;
INSERT INTO `status` (`idstatus`, `value`, `descricao`) VALUES
	(1, -1, 'Dentro do Prazo'),
	(2, 1, 'Fora do Prazo'),
	(3, 2, 'Adiantado'),
	(4, 3, 'Bolseiro');
/*!40000 ALTER TABLE `status` ENABLE KEYS */;

-- Dumping structure for table pautas_fe.turma
CREATE TABLE IF NOT EXISTS `turma` (
  `idturma` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(255) NOT NULL,
  `idcurso` int(11) DEFAULT NULL,
  PRIMARY KEY (`idturma`),
  KEY `idcurso` (`idcurso`),
  CONSTRAINT `turma_ibfk_1` FOREIGN KEY (`idcurso`) REFERENCES `curso` (`idcurso`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

-- Dumping data for table pautas_fe.turma: ~6 rows (approximately)
DELETE FROM `turma`;
/*!40000 ALTER TABLE `turma` DISABLE KEYS */;
INSERT INTO `turma` (`idturma`, `descricao`, `idcurso`) VALUES
	(6, 'Turma [1]', 1),
	(7, 'Turma [1]', 2),
	(8, 'Turma [1]', 3),
	(9, 'Turma [1]', 4),
	(10, 'Turma [1]', 5),
	(11, 'Turma [2]', 5);
/*!40000 ALTER TABLE `turma` ENABLE KEYS */;

-- Dumping structure for table pautas_fe.turno
CREATE TABLE IF NOT EXISTS `turno` (
  `idturno` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(255) NOT NULL,
  PRIMARY KEY (`idturno`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table pautas_fe.turno: ~2 rows (approximately)
DELETE FROM `turno`;
/*!40000 ALTER TABLE `turno` DISABLE KEYS */;
INSERT INTO `turno` (`idturno`, `descricao`) VALUES
	(1, 'Laboral'),
	(2, 'Pos Laboral');
/*!40000 ALTER TABLE `turno` ENABLE KEYS */;

-- Dumping structure for table pautas_fe.utilizador
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

-- Dumping data for table pautas_fe.utilizador: ~8 rows (approximately)
DELETE FROM `utilizador`;
/*!40000 ALTER TABLE `utilizador` DISABLE KEYS */;
INSERT INTO `utilizador` (`id`, `codigo`, `fullname`, `sexo`, `username`, `password`, `documento`, `datanasc`, `nivelescolar`, `idprevilegio`, `iddistrito`, `estadocivil`, `email`, `celular1`, `celular2`, `endereco1`, `endereco2`, `data_added`) VALUES
	(70, NULL, 'Claudino Raul Chaquisse', 'M', 'claudino.chaquisse', '123', NULL, NULL, NULL, 3, 2, 1, 'claudino.chaquisse@unilurio.ac.mz', NULL, NULL, '111233', NULL, '2019-01-13'),
	(74, NULL, 'Gabriel Mulauzi', 'M', 'gabriel.mulauzi', '123', NULL, NULL, NULL, 3, 2, 1, 'gabriel.mulauzi@unilurio.ac.mz', NULL, NULL, '12323', NULL, '2019-02-15'),
	(75, NULL, 'Cosme Lingongo', 'M', 'cosme.lingongo', '123', NULL, NULL, NULL, 3, 3, 1, 'cosme.lingongo@unilurio.ac.mz', NULL, NULL, '2323', NULL, '2019-02-15'),
	(105, NULL, 'Abel Junior', 'M', 'abel.junior', '123', NULL, NULL, NULL, 4, 3, 1, 'mauricio.quembo@unilurio.ac.mz', NULL, NULL, '23213', NULL, '2019-08-12'),
	(123, NULL, 'Januario Pedro', 'M', 'jpedro', '123456', NULL, NULL, NULL, 1, 1, 1, 'jpedro@gmail.com', NULL, NULL, '83747899', NULL, '2019-08-30'),
	(124, NULL, 'Daniela Jamal', 'M', 'djamal', '123456', NULL, NULL, NULL, 1, 1, 1, 'djamal@gmail.com', NULL, NULL, '85949002', NULL, '2019-09-02'),
	(125, NULL, 'Jamila Jaoa', 'M', 'jjaoa', '123456', NULL, NULL, NULL, 1, 2, 1, 'jamila@gmail.com', NULL, NULL, '83233747', NULL, '2019-09-02'),
	(126, NULL, 'Nigo Sumaila', 'F', 'nsumaila', '123456', NULL, NULL, NULL, 1, 2, 1, 'nsumaila@gmail.com', NULL, NULL, '32545', NULL, '2019-09-02');
/*!40000 ALTER TABLE `utilizador` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
