-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 13-Nov-2024 às 03:01
-- Versão do servidor: 10.4.32-MariaDB
-- versão do PHP: 8.2.12
CREATE DATABASE iris;
use iris;

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `iris`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `post`
--

CREATE TABLE `post` (
  `id` int(11) NOT NULL,
  `post_title` varchar(255) NOT NULL,
  `post_category` varchar(100) NOT NULL,
  `post_author` varchar(255) NOT NULL,
  `post_description` varchar(355) NOT NULL,
  `post_body` varchar(1000) NOT NULL,
  `startup_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `pwdreset`
--

CREATE TABLE `pwdreset` (
  `pwdResetId` int(11) NOT NULL,
  `pwdResetEmail` text NOT NULL,
  `pwdResetSelector` text NOT NULL,
  `pwdResetToken` longtext NOT NULL,
  `pwdResetExpires` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `pwdreset`
--

INSERT INTO `pwdreset` (`pwdResetId`, `pwdResetEmail`, `pwdResetSelector`, `pwdResetToken`, `pwdResetExpires`) VALUES
(59, 'frndssilva24@gmail.com', '06dca929f03517a7', '$2y$10$yv.4mQyMZfJHxUobeEhqGOowR/H8KYb8YAGPUXsG6bTwQ/ajcB33y', '2024-06-24 23:53:45');

-- --------------------------------------------------------

--
-- Estrutura da tabela `startups`
--

CREATE TABLE `startups` (
  `id` int(11) NOT NULL,
  `nomeStartup` varchar(255) NOT NULL,
  `descricao` varchar(355) NOT NULL,
  `fundador` varchar(255) NOT NULL,
  `setor` varchar(255) NOT NULL,
  `endereco` varchar(255) NOT NULL,
  `contato` varchar(255) NOT NULL,
  `website` varchar(255) NOT NULL,
  `emailStartup` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `startups`
--

INSERT INTO `startups` (`id`, `nomeStartup`, `descricao`, `fundador`, `setor`, `endereco`, `contato`, `website`, `emailStartup`, `password`) VALUES
(1, 'Rouipas da Soso', 'Vendo roupas', 'Sofia Silva', 'Vestuario', 'Rua dos Morango, 549, Floresta', '31 996442401', 'https://www.youtube.com/feed/history', 'sofia@gmail.com.br', '$2y$10$veEfTpzdSmNSPYKaycRuHe8PNS5ZL7vu.2DyMPnWJp63eoFt.Z6ty'),
(2, 'a', 'a', 'a', 'a', 'a', 'a', 'https://chatgpt.com/', 'teste3@gmail.com', '$2y$10$ueQUa/D08i57nxt79u2XvukGpFbTmApzuFicK4KkycD4mHb/DRE.q'),
(5, 'wevinc', 'empresa que a soso trabalha', 'marco antonio', 'Tecnologia', 'Rua Maria 123', '12345678900', 'https://cotemig.qmagico.com.br/perfil', 'weeeee@gmail.com', '$2y$10$Lie6u4lP55R.kX.YdiZG9OFD0683E5EI6CtuAFFFEDinUk0aMBts.'),
(6, 'Startup', 'Essa é a descrição de uma startup.', 'Criador(es) da Startup', 'Área de Atuação', 'Endereço da startup', '31999999999', 'https://www.startup.com', 'startup@gmail.com', '$2y$10$IhlSLAxGQc6ec4vJX5U/de7.fk1Bq6oa.jEfMlRObvSISBLgvGpZK'),
(9, 'Rebeca Teste Email', 'Teste para Email', 'Teste da Rebeca', 'Teste', 'Rua Teste 394', '31912345678', 'https://www.teste.com.br', '22201653@aluno.cotemig.com.br', '$2y$10$4RUh4lKa4s9cEe4EujgX3OHkXQCaioNVIDLg1wp2xnqJw9PGSOl92');

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `full_name` varchar(128) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `full_name`, `email`, `password`) VALUES
(2, 'Marco  Silva', 'marco.ferreira@culturinvest.com.br', '$2y$10$JJbyGfM7VHgn658hMT3xWe6CWhaMis0C4QP74tFp2fV3GofOvweZy'),
(4, 'Rebeca Nogueira', 'beca@gmail.com', '$2y$10$8S5jqG.CXr/8bU.6G17d7O8E52UPa3Xya.Ulfo4tVGxDPQwLTyG8K'),
(5, 'olavo', 'olavo@gmail.com', '$2y$10$ongmJGi6SGanYIq4hpg/1uxjlYjiIW9GU1H/Me1UtMyO4YJlewhq.'),
(6, 'amanda', 'amanda@gmail.com', '$2y$10$Tsdn0rPnlHh90qeNHUhsQ.4MWC7PH.8fpZpGoowc28QHl1U74rEdO'),
(7, 'maria', 'maria@gmail.com', '$2y$10$P4nXUKdfziCuS2AuPvCxzuUG72vGOnJGmW4ZG747Xk.6yikBGTNzG'),
(8, 'Nicollas Pereira', 'perera@gmail.com', '$2y$10$3IAcXjx3CJjqrJaMYJofSOuvQeL1/pccp/iZAS8ZEtWBGWW3ZLXlO'),
(9, 'gleison', 'gleison@gmail.com', '$2y$10$gdxxaC1f1K1vFzF.X01o5eBj0GGRI8d12cBSERu7LTUgUppNGRMJa'),
(14, 'Joao da Silva', 'joao@gmail.com', '$2y$10$Bs9kU3RFTh5JzBkohQIVBOo6DEBeHpexwoL/ZNxtBJRguqo1VsDWG'),
(15, 'julia da silva', 'julia@gmail.com', '$2y$10$sYP5fKfws9Qb2rYllmM4NuyoxmhPA57EIDYqvo8/daBBAD2Y6CeFm'),
(16, 'claudio ferreira', 'claudio@gmail.com', '$2y$10$RAPpaD7DqLEWDFFKfecZl.XckEoojra/3jw2ycbjiFvcq6Y/IbY5K'),
(17, 'roberta', 'roberta@gmail.com', '$2y$10$OhYx0KozrzBjOevd7XEcZe5fjZuPBTvhSSf21TyDaOOcMkurDbjjW'),
(18, 'teste', 'teste@gmail.com', '$2y$10$bifpWYwTtnsgNfZaGkCw3.KeHTDoUpLd9fs7DWZRaLBu/Xs2k319y'),
(21, 'Claudete Souza', 'claudete@gmail.com', '$2y$10$dMWQzGZYBE6SOE2BZ3IajO5OiNNCFqSok/T1zYQ3G.M6R.Pxot75.'),
(22, 'Investidor', 'investidor@gmail.com', '$2y$10$M3KvNA/NxVIp1gLmlmZ/meyMKakJEt47LNmdIVInf2urtUQpFknyW');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `pwdreset`
--
ALTER TABLE `pwdreset`
  ADD PRIMARY KEY (`pwdResetId`);

--
-- Índices para tabela `startups`
--
ALTER TABLE `startups`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `post`
--
ALTER TABLE `post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de tabela `pwdreset`
--
ALTER TABLE `pwdreset`
  MODIFY `pwdResetId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT de tabela `startups`
--
ALTER TABLE `startups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
