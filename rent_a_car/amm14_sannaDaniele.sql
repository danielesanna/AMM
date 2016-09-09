-- phpMyAdmin SQL Dump
-- version 3.4.11.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generato il: Ago 23, 2016 alle 10:35
-- Versione del server: 5.5.35
-- Versione PHP: 5.4.6-1ubuntu1.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `amm14_sannaDaniele`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `clienti`
--

CREATE TABLE IF NOT EXISTS `clienti` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(128) DEFAULT NULL,
  `cognome` varchar(128) DEFAULT NULL,
  `email` varchar(128) DEFAULT NULL,
  `numerotel` varchar(128) DEFAULT NULL,
  `via` varchar(128) DEFAULT NULL,
  `numero_civico` int(128) DEFAULT NULL,
  `citta` varchar(128) DEFAULT NULL,
  `username` varchar(128) DEFAULT NULL,
  `password` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `costruttori`
--

CREATE TABLE IF NOT EXISTS `costruttori` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nomecostruttore` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dump dei dati per la tabella `costruttori`
--

INSERT INTO `costruttori` (`id`, `nomecostruttore`) VALUES
(1, 'Volkswagen'),
(2, 'Ford');

-- --------------------------------------------------------

--
-- Struttura della tabella `dipendenti`
--

CREATE TABLE IF NOT EXISTS `dipendenti` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(128) DEFAULT NULL,
  `cognome` varchar(128) DEFAULT NULL,
  `email` varchar(128) DEFAULT NULL,
  `numerotel` varchar(128) DEFAULT NULL,
  `via` varchar(128) DEFAULT NULL,
  `numero_civico` int(128) DEFAULT NULL,
  `citta` varchar(128) DEFAULT NULL,
  `username` varchar(128) DEFAULT NULL,
  `password` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `modelli`
--

CREATE TABLE IF NOT EXISTS `modelli` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nomemodello` varchar(45) DEFAULT NULL,
  `idcostruttore` int(11) DEFAULT NULL,
  `cilindrata` int(11) DEFAULT NULL,
  `potenza` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `costruttori_fk` (`idcostruttore`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dump dei dati per la tabella `modelli`
--

INSERT INTO `modelli` (`id`, `nomemodello`, `idcostruttore`, `cilindrata`, `potenza`) VALUES
(1, 'Golf', 1, 1600, 90),
(2, 'Polo', 1, 1400, 75),
(3, 'Fiesta', 2, 1200, 60),
(4, 'Focus', 2, 1600, 120);

-- --------------------------------------------------------

--
-- Struttura della tabella `noleggi`
--

CREATE TABLE IF NOT EXISTS `noleggi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idauto` int(11) DEFAULT NULL,
  `idcliente` int(11) DEFAULT NULL,
  `datainizio` datetime DEFAULT NULL,
  `datafine` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `auto_fk` (`idauto`),
  KEY `cliente_fk` (`idcliente`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `veicoli`
--

CREATE TABLE IF NOT EXISTS `veicoli` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idmodello` int(11) DEFAULT NULL,
  `anno` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `modello_fk` (`idmodello`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dump dei dati per la tabella `veicoli`
--

INSERT INTO `veicoli` (`id`, `idmodello`, `anno`) VALUES
(1, 1, 2016),
(2, 1, 2016),
(3, 2, 2016),
(4, 3, 2016),
(5, 4, 2016),
(6, 3, 2016),
(7, 3, 2016);

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `modelli`
--
ALTER TABLE `modelli`
  ADD CONSTRAINT `costruttori_fk` FOREIGN KEY (`idcostruttore`) REFERENCES `costruttori` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Limiti per la tabella `noleggi`
--
ALTER TABLE `noleggi`
  ADD CONSTRAINT `auto_fk` FOREIGN KEY (`idauto`) REFERENCES `veicoli` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cliente_fk` FOREIGN KEY (`idcliente`) REFERENCES `clienti` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `veicoli`
--
ALTER TABLE `veicoli`
  ADD CONSTRAINT `modello_fk` FOREIGN KEY (`idmodello`) REFERENCES `modelli` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
