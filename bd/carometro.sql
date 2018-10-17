-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 30-Maio-2018 às 18:28
-- Versão do servidor: 10.1.30-MariaDB
-- PHP Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `carometro`
--
CREATE DATABASE IF NOT EXISTS `carometro` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `carometro`;

DELIMITER $$
--
-- Procedures
--
DROP PROCEDURE IF EXISTS `p_cadastrodealuno`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `p_cadastrodealuno` (IN `_rm` INT(5), IN `_nome` VARCHAR(64), IN `_turma` INT(1), IN `_foto` VARCHAR(128))  NO SQL
insert into alunos
(rm, nome, turma, foto)
values
(_rm, _nome, _turma, _foto)$$

DROP PROCEDURE IF EXISTS `p_consultaalunoRM`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `p_consultaalunoRM` (IN `_rm` INT(5))  NO SQL
SELECT * FROM alunos WHERE rm = _rm$$

DROP PROCEDURE IF EXISTS `p_consultaralunosturma`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `p_consultaralunosturma` (IN `_turma` INT(1))  NO SQL
select * from alunos where turma = _turma order by nome$$

DROP PROCEDURE IF EXISTS `p_deletaaluno`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `p_deletaaluno` (IN `_rm` INT(5))  NO SQL
DELETE FROM alunos
WHERE rm = _rm$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `alunos`
--

DROP TABLE IF EXISTS `alunos`;
CREATE TABLE `alunos` (
  `id_aluno` int(11) NOT NULL,
  `nome` varchar(64) NOT NULL,
  `rm` int(5) NOT NULL,
  `turma` int(1) NOT NULL,
  `foto` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `alunos`
--

INSERT INTO `alunos` (`id_aluno`, `nome`, `rm`, `turma`, `foto`) VALUES
(1, 'Alexsander', 11111, 1, '11111_alex.jpg'),
(2, 'Bryan', 22222, 1, '22222_bryan.jpg'),
(3, 'Caio', 17170, 1, '17170_caio.jpg'),
(4, 'Carlos', 10100, 1, '10100_carlos.jpg'),
(5, 'Claudio', 55555, 1, 'claudio.jpg'),
(6, 'Daniel', 16107, 1, '16107_daniel.jpg'),
(7, 'Eloí­sa', 16106, 1, '16106_eloisa.jpg'),
(8, 'Enrique', 88888, 1, '88888_enrique.jpg'),
(9, 'Érica', 12345, 2, '12345_erica.jpg'),
(10, 'Guilherme (Igão)', 54321, 2, '54321_guilherme.jpg'),
(11, 'Gustavo', 12121, 2, '12121_gustavo.jpg'),
(12, 'João Pedro Batista', 12122, 2, '12122_jBatista.jpg'),
(13, 'João Pedro Monteiro', 16279, 2, '16279_jMonteiro.jpg'),
(14, 'João Pedro Rodrigues', 14147, 2, '14147_jRodrigues.jpg'),
(15, 'João Victor', 15155, 2, '15155_jVictor.jpg'),
(16, 'Leonardo Andrelo', 16166, 2, '16166_lAndrelo.jpg'),
(17, 'Leonardo Vinícius', 17177, 2, '17177_lVincius.jpg'),
(18, 'Letí­cia', 18188, 3, '18188_leticia.jpg'),
(19, 'Paulo', 19199, 3, '19199_paulo.jpg'),
(20, 'Rafael', 20200, 3, '20200_rafael.jpg'),
(21, 'Rodrigo', 21211, 3, '21211_rodrigo.jpg'),
(22, 'Thiago', 22212, 3, '22212_thiago.jpg'),
(23, 'Wanderson', 16278, 3, '16278_wanderson.jpg'),
(24, 'Yago', 24244, 3, '24244_yago.jpg'),
(27, 'Teste', 10101, 1, '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alunos`
--
ALTER TABLE `alunos`
  ADD PRIMARY KEY (`id_aluno`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `alunos`
--
ALTER TABLE `alunos`
  MODIFY `id_aluno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
