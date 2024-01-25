-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           10.11.3-MariaDB-log - mariadb.org binary distribution
-- OS do Servidor:               Win64
-- HeidiSQL Versão:              9.5.0.5196
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Copiando estrutura para tabela radioclubesoftware.eventos
DROP TABLE IF EXISTS `eventos`;
CREATE TABLE IF NOT EXISTS `eventos` (
  `_created` timestamp NULL DEFAULT NULL,
  `_updated` timestamp NULL DEFAULT NULL,
  `_deleted` timestamp NULL DEFAULT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(255) NOT NULL,
  `data` date NOT NULL,
  `ativo` enum('Y','N') NOT NULL DEFAULT 'Y',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- Copiando dados para a tabela radioclubesoftware.eventos: ~5 rows (aproximadamente)
DELETE FROM `eventos`;
/*!40000 ALTER TABLE `eventos` DISABLE KEYS */;
/*!40000 ALTER TABLE `eventos` ENABLE KEYS */;

-- Copiando estrutura para tabela radioclubesoftware.eventos-participantes
DROP TABLE IF EXISTS `eventos-participantes`;
CREATE TABLE IF NOT EXISTS `eventos-participantes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idEvento` int(11) NOT NULL,
  `idSocio` int(11) NOT NULL DEFAULT 0,
  `nome` varchar(255) NOT NULL,
  `indicativo` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=89 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- Copiando dados para a tabela radioclubesoftware.eventos-participantes: ~62 rows (aproximadamente)
DELETE FROM `eventos-participantes`;
/*!40000 ALTER TABLE `eventos-participantes` DISABLE KEYS */;
/*!40000 ALTER TABLE `eventos-participantes` ENABLE KEYS */;

-- Copiando estrutura para tabela radioclubesoftware.migrations
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- Copiando dados para a tabela radioclubesoftware.migrations: ~6 rows (aproximadamente)
DELETE FROM `migrations`;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
	(1, '20230213000000', 'App\\Database\\Migrations\\dbv1', 'default', 'App', 1676716692, 1),
	(2, '20230215000000', 'App\\Database\\Migrations\\dbv2', 'default', 'App', 1676716692, 1),
	(3, '20230217000000', 'App\\Database\\Migrations\\dbv3', 'default', 'App', 1676716692, 1),
	(5, '20230218000000', 'App\\Database\\Migrations\\dbv4', 'default', 'App', 1677247127, 2),
	(6, '20230302180000', 'App\\Database\\Migrations\\dbv5', 'default', 'App', 1677793584, 3),
	(7, '20230314000000', 'App\\Database\\Migrations\\dbv6', 'default', 'App', 1678851605, 4);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

-- Copiando estrutura para tabela radioclubesoftware.recuperacao-senha
DROP TABLE IF EXISTS `recuperacao-senha`;
CREATE TABLE IF NOT EXISTS `recuperacao-senha` (
  `idSocio` int(11) NOT NULL,
  `hash` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- Copiando dados para a tabela radioclubesoftware.recuperacao-senha: ~0 rows (aproximadamente)
DELETE FROM `recuperacao-senha`;
/*!40000 ALTER TABLE `recuperacao-senha` DISABLE KEYS */;
/*!40000 ALTER TABLE `recuperacao-senha` ENABLE KEYS */;

-- Copiando estrutura para tabela radioclubesoftware.socios
DROP TABLE IF EXISTS `socios`;
CREATE TABLE IF NOT EXISTS `socios` (
  `_created` timestamp NULL DEFAULT NULL,
  `_updated` timestamp NULL DEFAULT NULL,
  `_deleted` timestamp NULL DEFAULT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `telefone` varchar(15) DEFAULT NULL,
  `cpf` varchar(14) NOT NULL,
  `dataNascimento` date NOT NULL,
  `ativo` enum('Y','N') NOT NULL DEFAULT 'Y',
  `aprovado` enum('Y','N') NOT NULL DEFAULT 'N',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `cpf` (`cpf`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- Copiando dados para a tabela radioclubesoftware.socios: ~16 rows (aproximadamente)
DELETE FROM `socios`;
/*!40000 ALTER TABLE `socios` DISABLE KEYS */;
INSERT INTO `socios` (`_created`, `_updated`, `_deleted`, `id`, `email`, `senha`, `nome`, `telefone`, `cpf`, `dataNascimento`, `ativo`, `aprovado`) VALUES
	('2023-03-02 20:17:29', '2023-10-31 13:40:03', NULL, 1, 'nataniel@kegles.com.br', '$2y$10$4F96xbejI7Tf4Rfsuh0GQu/Z8jkELKY1wwLuJmJelZEhj5Kc1DsCO', 'Nataniel Kegles', '(53) 99121-5315', '000.000.000-00', '1987-05-07', 'Y', 'Y');
/*!40000 ALTER TABLE `socios` ENABLE KEYS */;

-- Copiando estrutura para tabela radioclubesoftware.socios-licencas
DROP TABLE IF EXISTS `socios-licencas`;
CREATE TABLE IF NOT EXISTS `socios-licencas` (
  `idSocio` int(11) NOT NULL,
  `indicativo` varchar(8) NOT NULL,
  `tipo` enum('CA','CB','CC','PX','EE','ER') NOT NULL,
  PRIMARY KEY (`idSocio`,`indicativo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- Copiando dados para a tabela radioclubesoftware.socios-licencas: ~18 rows (aproximadamente)
DELETE FROM `socios-licencas`;
/*!40000 ALTER TABLE `socios-licencas` DISABLE KEYS */;
INSERT INTO `socios-licencas` (`idSocio`, `indicativo`, `tipo`) VALUES
	(1, 'PY3NT ', 'CA');
/*!40000 ALTER TABLE `socios-licencas` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
