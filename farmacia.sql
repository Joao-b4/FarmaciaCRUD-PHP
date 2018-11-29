-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Tempo de geração: 29/11/2018 às 18:39
-- Versão do servidor: 10.1.34-MariaDB
-- Versão do PHP: 7.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `farmacia`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `fornecedores`
--

CREATE TABLE `fornecedores` (
  `idForn` int(11) NOT NULL,
  `nomeForn` varchar(50) CHARACTER SET latin1 NOT NULL,
  `emailForn` varchar(50) CHARACTER SET latin1 NOT NULL,
  `telForn` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Fazendo dump de dados para tabela `fornecedores`
--

INSERT INTO `fornecedores` (`idForn`, `nomeForn`, `emailForn`, `telForn`) VALUES
(6, 'Petrobras', 'marcelo@petrobras.com.br', '5551998988282');

-- --------------------------------------------------------

--
-- Estrutura para tabela `funcionarios`
--

CREATE TABLE `funcionarios` (
  `idFunc` int(11) NOT NULL,
  `nomeFunc` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `enderecoFunc` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `rgFunc` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `entradaFunc` date NOT NULL,
  `funcaoFunc` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `emailFunc` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Fazendo dump de dados para tabela `funcionarios`
--

INSERT INTO `funcionarios` (`idFunc`, `nomeFunc`, `enderecoFunc`, `rgFunc`, `entradaFunc`, `funcaoFunc`, `emailFunc`) VALUES
(5, 'joao', 'pesquerio', '929292929', '2220-02-22', 'caixa', 'joaosfontoura555@gmail.com');

-- --------------------------------------------------------

--
-- Estrutura para tabela `produtos`
--

CREATE TABLE `produtos` (
  `idProd` int(11) NOT NULL,
  `nomeProd` varchar(50) CHARACTER SET latin1 NOT NULL,
  `precoProd` float NOT NULL,
  `fabricante` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `tipoProd` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `dataFabri` date NOT NULL,
  `dataVali` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Fazendo dump de dados para tabela `produtos`
--

INSERT INTO `produtos` (`idProd`, `nomeProd`, `precoProd`, `fabricante`, `tipoProd`, `dataFabri`, `dataVali`) VALUES
(1, 'Amoxicilina 500 mg', 15.75, 'NeoQuimica', 'Medicamento', '2018-11-01', '2019-03-20');

--
-- Índices de tabelas apagadas
--

--
-- Índices de tabela `fornecedores`
--
ALTER TABLE `fornecedores`
  ADD PRIMARY KEY (`idForn`);

--
-- Índices de tabela `funcionarios`
--
ALTER TABLE `funcionarios`
  ADD PRIMARY KEY (`idFunc`);

--
-- Índices de tabela `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`idProd`);

--
-- AUTO_INCREMENT de tabelas apagadas
--

--
-- AUTO_INCREMENT de tabela `fornecedores`
--
ALTER TABLE `fornecedores`
  MODIFY `idForn` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `funcionarios`
--
ALTER TABLE `funcionarios`
  MODIFY `idFunc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `produtos`
--
ALTER TABLE `produtos`
  MODIFY `idProd` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
