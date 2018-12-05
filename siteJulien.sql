-- phpMyAdmin SQL Dump
-- version 3.3.4
-- http://www.phpmyadmin.net
--
-- Serveur: localhost
-- Généré le : Lun 30 Août 2010 à 01:12
-- Version du serveur: 5.0.90
-- Version de PHP: 5.2.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `siteJulien`
--

-- --------------------------------------------------------

--
-- Structure de la table `config`
--

CREATE TABLE IF NOT EXISTS `config` (
  `config_switch` int(11) NOT NULL,
  `config_news_par_page` int(11) NOT NULL,
  `config_commentaires_active` smallint(1) NOT NULL,
  `config_membres_par_page` smallint(200) NOT NULL,
  `repertoire_logos` varchar(255) default NULL,
  `max_height_logo` int(11) default NULL,
  `max_width_logo` int(11) default NULL,
  PRIMARY KEY  (`config_switch`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `config`
--

INSERT INTO `config` (`config_switch`, `config_news_par_page`, `config_commentaires_active`, `config_membres_par_page`, `repertoire_logos`, `max_height_logo`, `max_width_logo`) VALUES
(1, 10, 1, 10, '''/web/www/JL/images_upload''', 100, 100);

-- --------------------------------------------------------

--
-- Structure de la table `logos`
--

CREATE TABLE IF NOT EXISTS `logos` (
  `id` smallint(6) NOT NULL auto_increment,
  `path` varchar(255) NOT NULL,
  `url` varchar(255) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `logos`
--

INSERT INTO `logos` (`id`, `path`, `url`) VALUES
(2, 'logo_lip.png', 'www.google.fr'),
(3, '', NULL),
(1, 'soleil.jpg', 'www.soleil.com');

-- --------------------------------------------------------

--
-- Structure de la table `membres`
--

CREATE TABLE IF NOT EXISTS `membres` (
  `password` varchar(16) NOT NULL,
  `membres_nom` varchar(30) NOT NULL,
  `membres_prenom` varchar(20) NOT NULL,
  `login` varchar(30) NOT NULL,
  `membres_dt` datetime default NULL,
  `membres_droits_ajouter_membre` int(11) NOT NULL,
  `membres_droits_ajouter_news` int(11) NOT NULL,
  `membres_droits_controles_membre` int(11) NOT NULL,
  `membres_droits_controles_news` int(11) NOT NULL,
  `membres_droits_config` int(11) default NULL,
  PRIMARY KEY  (`login`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `membres`
--

INSERT INTO `membres` (`password`, `membres_nom`, `membres_prenom`, `login`, `membres_dt`, `membres_droits_ajouter_membre`, `membres_droits_ajouter_news`, `membres_droits_controles_membre`, `membres_droits_controles_news`, `membres_droits_config`) VALUES
('russel', 'Ruguet', 'Gaëtan', 'Ordos', NULL, 1, 0, 1, 1, NULL),
('anacoluthe', 'Didier', 'Ducrocq', 'Didier', '2010-06-19 19:46:17', 1, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `news`
--

CREATE TABLE IF NOT EXISTS `news` (
  `news_id` int(11) NOT NULL auto_increment,
  `news_titre` varchar(255) NOT NULL,
  `news_contenu` text NOT NULL,
  `news_auteur` varchar(255) NOT NULL,
  `news_dt` datetime default NULL,
  PRIMARY KEY  (`news_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=58 ;

--
-- Contenu de la table `news`
--

INSERT INTO `news` (`news_id`, `news_titre`, `news_contenu`, `news_auteur`, `news_dt`) VALUES
(47, 'test pas date ', 'sagt', 'Sulff', '2010-06-09 02:15:41'),
(44, 'Test', 'Test', 'Sulff', '2010-06-08 16:24:17'),
(50, 'EEcsd', 'EZDZ', 'Sulff', '2010-06-10 02:09:32'),
(51, 'EEcsd', 'EZDZ', 'Sulff', '2010-06-10 02:09:52'),
(57, 'test', 'test', 'Admin', '2010-07-16 15:55:40');
