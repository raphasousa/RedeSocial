-- phpMyAdmin SQL Dump
-- version 4.5.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 28/09/2016 às 01:41
-- Versão do servidor: 5.6.29
-- Versão do PHP: 7.0.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `db_redesocial`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `amizades`
--

CREATE TABLE `amizades` (
  `id` int(11) NOT NULL,
  `de` varchar(100) NOT NULL,
  `para` varchar(100) NOT NULL,
  `aceite` varchar(3) NOT NULL DEFAULT 'nao',
  `data` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Fazendo dump de dados para tabela `amizades`
--

INSERT INTO `amizades` (`id`, `de`, `para`, `aceite`, `data`) VALUES
(10, 'gi@gmail.com', 'raphasousa.jau@gmail.com', 'sim', '2016-07-25'),
(11, 'raphasousa.jau@gmail.com', 'caio@gmail.com', 'sim', '2016-07-28'),
(12, 'matheus@gmail.com', 'raphasousa.jau@gmail.com', 'sim', '2016-08-25'),
(13, 'raphasousa.jau@gmail.com', 'victor@email.com', 'nao', '2016-08-25'),
(14, 'asdf@asdf.com', 'raphasousa.jau@gmail.com', 'sim', '2016-08-31'),
(15, 'sacoman@unesp.br', 'raphasousa.jau@gmail.com', 'sim', '2016-09-28');

-- --------------------------------------------------------

--
-- Estrutura para tabela `loves`
--

CREATE TABLE `loves` (
  `id` int(11) NOT NULL,
  `user` varchar(100) NOT NULL,
  `pub` int(11) NOT NULL,
  `data` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Fazendo dump de dados para tabela `loves`
--

INSERT INTO `loves` (`id`, `user`, `pub`, `data`) VALUES
(3, 'raphasousa.jau@gmail.com', 15, '2016-07-28'),
(4, 'raphasousa.jau@gmail.com', 17, '2016-07-28'),
(8, 'raphasousa.jau@gmail.com', 18, '2016-07-29'),
(9, 'gi@gmail.com', 1, '2016-07-29'),
(10, 'gi@gmail.com', 18, '2016-07-29'),
(11, 'caio@gmail.com', 18, '2016-08-03'),
(12, 'caio@gmail.com', 1, '2016-08-03'),
(13, 'raphasousa.jau@gmail.com', 19, '2016-08-25'),
(15, 'raphasousa.jau@gmail.com', 21, '2016-09-27'),
(16, 'asdf@asdf.com', 18, '2016-09-27'),
(17, 'sacoman@unesp.br', 22, '2016-09-28'),
(18, 'raphasousa.jau@gmail.com', 22, '2016-09-28');

-- --------------------------------------------------------

--
-- Estrutura para tabela `mensagens`
--

CREATE TABLE `mensagens` (
  `id` int(11) NOT NULL,
  `de` varchar(100) NOT NULL,
  `para` varchar(100) NOT NULL,
  `texto` text NOT NULL,
  `imagem` text NOT NULL,
  `data` date NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Fazendo dump de dados para tabela `mensagens`
--

INSERT INTO `mensagens` (`id`, `de`, `para`, `texto`, `imagem`, `data`, `status`) VALUES
(1, 'gi@gmail.com', 'raphasousa.jau@gmail.com', 'oi', '', '2016-08-01', 1),
(2, 'caio@gmail.com', 'raphasousa.jau@gmail.com', 'beleza', '', '2016-08-01', 1),
(3, 'gi@gmail.com', 'raphasousa.jau@gmail.com', 'tudo bom?', '', '2016-08-01', 1),
(4, 'raphasousa.jau@gmail.com', 'gi@gmail.com', 'ola', '', '2016-08-02', 1),
(5, 'raphasousa.jau@gmail.com', 'caio@gmail.com', 'beleza e ai?', '', '2016-08-02', 1),
(7, 'raphasousa.jau@gmail.com', 'caio@gmail.com', 'meu time no cartola', '6597290cartola.jpg', '2016-08-02', 1),
(9, 'caio@gmail.com', 'raphasousa.jau@gmail.com', 'boa, vai moer!', '', '2016-08-02', 1),
(10, 'caio@gmail.com', 'raphasousa.jau@gmail.com', 'eu queria ter escalado o rogerio ceni, mas ele já se aposentou, entou to pensando em colocar o denis mesmo', '', '2016-08-02', 1),
(11, 'raphasousa.jau@gmail.com', 'gi@gmail.com', 'tudo otimo meu amor!', '', '2016-08-02', 1),
(12, 'gi@gmail.com', 'caio@gmail.com', 'oi', '', '2016-08-03', 1),
(13, 'victor@email.com', 'raphasousa.jau@gmail.com', 'oi', '', '2016-08-25', 1),
(14, 'raphasousa.jau@gmail.com', 'victor@email.com', 'blz', '', '2016-08-25', 0),
(15, 'matheus@gmail.com', 'raphasousa.jau@gmail.com', 'oi', '', '2016-08-25', 1),
(16, 'asdf@asdf.com', 'raphasousa.jau@gmail.com', 'Olá!', '', '2016-08-31', 1),
(17, 'raphasousa.jau@gmail.com', 'asdf@asdf.com', 'beleeza', '', '2016-08-31', 0),
(18, 'raphasousa.jau@gmail.com', 'asdf@asdf.com', 'hahah', '', '2016-08-31', 0),
(19, 'raphasousa.jau@gmail.com', 'asdf@asdf.com', 'ola', '', '2016-08-31', 0),
(20, 'raphasousa.jau@gmail.com', 'asdf@asdf.com', 'me responde', '', '2016-08-31', 0),
(21, 'raphasousa.jau@gmail.com', 'matheus@gmail.com', 'ola', '', '2016-08-31', 0),
(23, 'raphasousa.jau@gmail.com', 'asdf@asdf.com', '', '3556213123123raphael.jpg', '2016-08-31', 0),
(24, 'raphasousa.jau@gmail.com', 'asdf@asdf.com', 'jajdnas', '', '2016-08-31', 0),
(25, 'raphasousa.jau@gmail.com', 'asdf@asdf.com', 'eu', '8811341123123raphael.jpg', '2016-08-31', 0),
(26, 'caio@gmail.com', 'raphasousa.jau@gmail.com', '', '36453252492065cartola.jpg', '2016-08-31', 1),
(27, 'caio@gmail.com', 'raphasousa.jau@gmail.com', 'meu time', '', '2016-08-31', 1),
(28, 'raphasousa.jau@gmail.com', 'victor@email.com', '', '904724236453252492065cartola.jpg', '2016-08-31', 0),
(29, 'sacoman@unesp.br', 'raphasousa.jau@gmail.com', 'ola', '', '2016-09-28', 1),
(30, 'sacoman@unesp.br', 'raphasousa.jau@gmail.com', 'sua media final é 10', '', '2016-09-28', 1),
(31, 'sacoman@unesp.br', 'raphasousa.jau@gmail.com', '', '7419129sacoman.jpg', '2016-09-28', 1),
(32, 'raphasousa.jau@gmail.com', 'sacoman@unesp.br', 'muito obrigado', '', '2016-09-28', 1),
(33, 'sacoman@unesp.br', 'raphasousa.jau@gmail.com', 'ola', '', '2016-09-28', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `post`
--

CREATE TABLE `post` (
  `codigo` int(11) NOT NULL,
  `user` varchar(100) NOT NULL,
  `texto` text,
  `imagem` text,
  `data` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Fazendo dump de dados para tabela `post`
--

INSERT INTO `post` (`codigo`, `user`, `texto`, `imagem`, `data`) VALUES
(1, 'raphasousa.jau@gmail.com', 'Breaking Bad é muito daora!', '705963breaking_bad_wallz_by_sahinduezguen-d6o7k4z.jpg', '2016-07-18'),
(15, 'gi@gmail.com', 'golf', '3865662013-03-22_17-04-15_267.jpg', '2016-07-19'),
(17, 'caio@gmail.com', 'Ola queridos', NULL, '2016-07-27'),
(18, 'raphasousa.jau@gmail.com', 'O cara mais lindo dessa rede social!!', '18966611224370_871566066265391_8505573130328035088_n.jpg', '2016-07-29'),
(19, 'matheus@gmail.com', 'boa tarde', NULL, '2016-08-25'),
(20, 'victor@email.com', 'fala galera', NULL, '2016-08-25'),
(21, 'asdf@asdf.com', 'Olá mundo!', NULL, '2016-08-31'),
(22, 'sacoman@unesp.br', 'aquarela', '715363sacoman_post.jpg', '2016-09-28');

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuario`
--

CREATE TABLE `usuario` (
  `codigo` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(30) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `data_nascimento` date DEFAULT NULL,
  `foto` text,
  `descricao` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Fazendo dump de dados para tabela `usuario`
--

INSERT INTO `usuario` (`codigo`, `email`, `senha`, `nome`, `data_nascimento`, `foto`, `descricao`) VALUES
(1, 'raphasousa.jau@gmail.com', '12345', 'Raphael Sousa', '1995-10-23', '123123raphael.jpg', 'Eu sou um cara muito lindo, criativo, inteligente, com corpo atlético, que gosta de cachorros, adora futebol e também amo minha namorada. Hoje eu moro em Bauru, mas nasci em Jau. Estudo Ciência da Computação na UNESP Bauru.'),
(2, 'gi@gmail.com', '12345', 'Giovana Lopes', '1995-07-28', '47637901c4728dabd1d538b6847c85482252316798680747.jpg', '=D'),
(3, 'caio@gmail.com', '12345', 'Caio Racy', '1995-02-01', NULL, NULL),
(4, 'victor@email.com', 'kkk', 'Victor', '1982-07-30', NULL, ''),
(5, 'matheus@gmail.com', '123', 'Matheus', '1996-08-24', NULL, NULL),
(6, 'asdf@asdf.com', 'asdf', 'Luan', '1996-09-04', NULL, NULL),
(7, 'sacoman@unesp.br', '1234', 'sacoman', '1966-04-09', '7106323sacoman.jpg', 'professor na unesp');

--
-- Índices de tabelas apagadas
--

--
-- Índices de tabela `amizades`
--
ALTER TABLE `amizades`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `loves`
--
ALTER TABLE `loves`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `mensagens`
--
ALTER TABLE `mensagens`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`codigo`);

--
-- Índices de tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`codigo`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de tabelas apagadas
--

--
-- AUTO_INCREMENT de tabela `amizades`
--
ALTER TABLE `amizades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT de tabela `loves`
--
ALTER TABLE `loves`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT de tabela `mensagens`
--
ALTER TABLE `mensagens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT de tabela `post`
--
ALTER TABLE `post`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
