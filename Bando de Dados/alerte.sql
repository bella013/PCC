-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 07-Jun-2022 às 02:52
-- Versão do servidor: 10.4.22-MariaDB
-- versão do PHP: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `alerte`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `alerta`
--

CREATE TABLE `alerta` (
  `ID` int(11) NOT NULL,
  `Titulo` varchar(40) NOT NULL,
  `value1` varchar(20) NOT NULL,
  `value2` varchar(250) NOT NULL,
  `Descricao` longtext NOT NULL,
  `Tipo` varchar(10) NOT NULL,
  `ID_usuario` int(11) DEFAULT NULL,
  `Tempo` varchar(10) NOT NULL,
  `Estatus` varchar(10) NOT NULL,
  `ID_imagens` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `imagens`
--

CREATE TABLE `imagens` (
  `ID` int(11) NOT NULL,
  `Imagem` varchar(250) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `ID` int(11) NOT NULL,
  `Nome` varchar(60) NOT NULL,
  `Sobrenome` varchar(100) NOT NULL,
  `Nome_social` varchar(60) NOT NULL,
  `Usuario` varchar(60) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Senha` varchar(250) NOT NULL,
  `Nascimento` varchar(10) NOT NULL,
  `Genero` varchar(30) NOT NULL,
  `Imagem_perfil` varchar(250) DEFAULT NULL,
  `ID_alerta` int(11) DEFAULT NULL,
  `nivel` int(11) NOT NULL,
  `CPF` char(15) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `alerta`
--
ALTER TABLE `alerta`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `fk_usuario` (`ID_usuario`),
  ADD KEY `fk_imagens` (`ID_imagens`);

--
-- Índices para tabela `imagens`
--
ALTER TABLE `imagens`
  ADD PRIMARY KEY (`ID`);

--
-- Índices para tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `fk_alerta` (`ID_alerta`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `alerta`
--
ALTER TABLE `alerta`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `imagens`
--
ALTER TABLE `imagens`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
