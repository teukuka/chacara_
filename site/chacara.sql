-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 05/06/2023 às 21:48
-- Versão do servidor: 10.4.28-MariaDB
-- Versão do PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `chacara`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `calendario`
--

CREATE TABLE `calendario` (
  `datas` date NOT NULL,
  `evento` varchar(50) NOT NULL,
  `reserva_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `calendario`
--

INSERT INTO `calendario` (`datas`, `evento`, `reserva_id`) VALUES
('2023-06-14', 'reserva', 7),
('2023-06-15', 'reserva', 7),
('2023-06-16', 'reserva', 7),
('2023-06-17', 'reserva', 7),
('2023-06-18', 'reserva', 7),
('2023-06-19', 'reserva', 7),
('2023-06-20', 'reserva', 7),
('2023-06-21', 'reserva', 7),
('2023-06-22', 'reserva', 7),
('2023-07-04', 'reserva', 8),
('2023-07-05', 'reserva', 8),
('2023-07-06', 'reserva', 8),
('2023-07-07', 'reserva', 8),
('2023-07-08', 'reserva', 8),
('2023-07-09', 'reserva', 8),
('2023-07-10', 'reserva', 8),
('2023-07-11', 'reserva', 8),
('2023-07-12', 'reserva', 8),
('2023-07-13', 'reserva', 8),
('2023-07-14', 'reserva', 8),
('2023-07-15', 'reserva', 8),
('2023-07-16', 'reserva', 8),
('2023-07-17', 'reserva', 8),
('2023-07-18', 'reserva', 8),
('2023-07-19', 'reserva', 8),
('2023-07-20', 'reserva', 8);

-- --------------------------------------------------------

--
-- Estrutura para tabela `dados_pessoal`
--

CREATE TABLE `dados_pessoal` (
  `usuario_id` int(11) NOT NULL,
  `Nome` varchar(80) NOT NULL,
  `CPF` varchar(15) NOT NULL,
  `Telefone` varchar(20) NOT NULL,
  `data_aniversario` date NOT NULL,
  `nacionalidade` varchar(50) NOT NULL,
  `genero` varchar(50) NOT NULL,
  `rua` varchar(80) NOT NULL,
  `numero` int(11) NOT NULL,
  `cidade` varchar(80) NOT NULL,
  `CEP` varchar(20) NOT NULL,
  `estado` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `dados_pessoal`
--

INSERT INTO `dados_pessoal` (`usuario_id`, `Nome`, `CPF`, `Telefone`, `data_aniversario`, `nacionalidade`, `genero`, `rua`, `numero`, `cidade`, `CEP`, `estado`) VALUES
(17, 'Gabriel Fernando Dos Santos Cocovilo', '494.061.218-08', '(19)98951-6625', '2001-03-02', 'Brasil', 'masculino', 'waldemar da silva costa', 245, 'Espirito santo do pinhal', '13990-005', 'SP'),
(18, 'mateus camacho', '494.061.255-08', '(19)98951-6624', '2004-03-02', 'Brasil', 'masculino', 'waldemar da silva costa5', 248, 'Espirito santo do pinhal', '13990-005', 'SPs');

-- --------------------------------------------------------

--
-- Estrutura para tabela `funcionario`
--

CREATE TABLE `funcionario` (
  `nome` varchar(80) NOT NULL,
  `CPF` varchar(15) NOT NULL,
  `Telefone` varchar(20) NOT NULL,
  `funcao` varchar(50) NOT NULL,
  `salario` double NOT NULL,
  `id_funcionario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `funcionario`
--

INSERT INTO `funcionario` (`nome`, `CPF`, `Telefone`, `funcao`, `salario`, `id_funcionario`) VALUES
('Gabriel Fernando Dos Santos Cocovilo', '494.061.218-08', '(19)98951-6625', 'seguranca', 4545, 7),
('Jorge rei', '6545', '54545', 'moço', 1500, 8);

-- --------------------------------------------------------

--
-- Estrutura para tabela `gasto`
--

CREATE TABLE `gasto` (
  `mes` varchar(55) NOT NULL,
  `valor` float NOT NULL,
  `descricao` text NOT NULL,
  `id_gasto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `gasto`
--

INSERT INTO `gasto` (`mes`, `valor`, `descricao`, `id_gasto`) VALUES
('Janeiro', 140, 'Conta de luz', 1),
('Fevereiro', 250, 'manunteção da piscinas', 2);

-- --------------------------------------------------------

--
-- Estrutura para tabela `reserva`
--

CREATE TABLE `reserva` (
  `id_reserva` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `checkin` date NOT NULL,
  `checkout` date NOT NULL,
  `cozinheiro` varchar(4) NOT NULL,
  `cafe` varchar(4) NOT NULL,
  `valor` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `reserva`
--

INSERT INTO `reserva` (`id_reserva`, `usuario_id`, `checkin`, `checkout`, `cozinheiro`, `cafe`, `valor`) VALUES
(7, 18, '2023-06-14', '2023-06-22', 'sim', 'sim', 10700),
(8, 16, '2023-07-04', '2023-07-20', 'sim', 'sim', 20700);

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL,
  `usuario` varchar(80) NOT NULL,
  `email` varchar(80) NOT NULL,
  `senha` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `usuario`, `email`, `senha`) VALUES
(1, 'AdminAmigo', 'AdminAmigo@hotmail.com', 'SenhadoAdmin123#'),
(16, 'kaze', 'gabriel_cocovilo20@outlook.com', 'Coxinha123#b'),
(17, 'kazess', 'gabriel_kazuma@outlook.com', 'Coxinha123#b'),
(18, 'Mateys', 'mateus@hotmail.com', 'Mateus123#b');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `calendario`
--
ALTER TABLE `calendario`
  ADD KEY `reserva` (`reserva_id`);

--
-- Índices de tabela `dados_pessoal`
--
ALTER TABLE `dados_pessoal`
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Índices de tabela `funcionario`
--
ALTER TABLE `funcionario`
  ADD PRIMARY KEY (`id_funcionario`);

--
-- Índices de tabela `gasto`
--
ALTER TABLE `gasto`
  ADD PRIMARY KEY (`id_gasto`);

--
-- Índices de tabela `reserva`
--
ALTER TABLE `reserva`
  ADD PRIMARY KEY (`id_reserva`),
  ADD KEY `usuario` (`usuario_id`);

--
-- Índices de tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `funcionario`
--
ALTER TABLE `funcionario`
  MODIFY `id_funcionario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `gasto`
--
ALTER TABLE `gasto`
  MODIFY `id_gasto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `reserva`
--
ALTER TABLE `reserva`
  MODIFY `id_reserva` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `calendario`
--
ALTER TABLE `calendario`
  ADD CONSTRAINT `reserva` FOREIGN KEY (`reserva_id`) REFERENCES `reserva` (`id_reserva`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `dados_pessoal`
--
ALTER TABLE `dados_pessoal`
  ADD CONSTRAINT `dados_pessoal_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE;

--
-- Restrições para tabelas `reserva`
--
ALTER TABLE `reserva`
  ADD CONSTRAINT `usuario` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
