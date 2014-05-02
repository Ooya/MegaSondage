-- phpMyAdmin SQL Dump
-- version 3.2.2
-- http://www.phpmyadmin.net
--
-- Serveur: venus
-- Généré le : Mar 29 Avril 2014 à 11:09
-- Version du serveur: 5.0.77
-- Version de PHP: 5.3.0

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Base de données: `sbricas`
--

-- --------------------------------------------------------

--
-- Structure de la table `commentaire`
--

DROP TABLE IF EXISTS `commentaire`;
CREATE TABLE IF NOT EXISTS `commentaire` (
  `idCommentaire` int(50) NOT NULL auto_increment,
  `contenuCommentaire` mediumtext NOT NULL,
  `idSondage` int(50) NOT NULL,
  `idParent` int(50) default NULL,
  PRIMARY KEY  (`idCommentaire`),
  UNIQUE KEY `idSondage` (`idSondage`,`idParent`),
  KEY `idParent` (`idParent`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `commentaire`
--

INSERT INTO `commentaire` (`idCommentaire`, `contenuCommentaire`, `idSondage`, `idParent`) VALUES
(1, 'Ce nom me plait bien', 4, NULL),
(2, 'Moi aussi', 4, 1),
(3, 'Un complexe sportive me parait adapté à nos besoins 6', 6, NULL),
(4, 'Avec cette option, j''éspère avoir un bon grade', 7, 1);

-- --------------------------------------------------------

--
-- Structure de la table `groupe`
--

DROP TABLE IF EXISTS `groupe`;
CREATE TABLE IF NOT EXISTS `groupe` (
  `idGroupe` int(50) NOT NULL auto_increment,
  `nomGroupe` varchar(255) NOT NULL,
  `idAdminstrateur` int(50) NOT NULL,
  `idType` int(50) NOT NULL,
  PRIMARY KEY  (`idGroupe`),
  UNIQUE KEY `idAdminstrateur` (`idAdminstrateur`),
  UNIQUE KEY `idType` (`idType`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `groupe`
--

INSERT INTO `groupe` (`idGroupe`, `nomGroupe`, `idAdminstrateur`, `idType`) VALUES
(1, 'Citoyens', 2, 2),
(2, 'Client', 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `inscrit`
--

DROP TABLE IF EXISTS `inscrit`;
CREATE TABLE IF NOT EXISTS `inscrit` (
  `idInscrit` int(50) NOT NULL auto_increment,
  `idSondage` int(50) NOT NULL,
  `idUtilisateur` int(50) NOT NULL,
  PRIMARY KEY  (`idInscrit`),
  UNIQUE KEY `idSondage` (`idSondage`,`idUtilisateur`),
  KEY `idUtilisateur` (`idUtilisateur`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Contenu de la table `inscrit`
--

INSERT INTO `inscrit` (`idInscrit`, `idSondage`, `idUtilisateur`) VALUES
(1, 3, 1),
(2, 3, 2),
(4, 5, 2),
(3, 5, 3),
(5, 6, 1),
(6, 6, 3),
(7, 7, 2);

-- --------------------------------------------------------

--
-- Structure de la table `membre`
--

DROP TABLE IF EXISTS `membre`;
CREATE TABLE IF NOT EXISTS `membre` (
  `idMembre` int(50) NOT NULL auto_increment,
  `idUtilisateur` int(50) NOT NULL,
  `idGroupe` int(50) NOT NULL,
  PRIMARY KEY  (`idMembre`),
  UNIQUE KEY `idUtilisateur` (`idUtilisateur`,`idGroupe`),
  KEY `idGroupe` (`idGroupe`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Contenu de la table `membre`
--

INSERT INTO `membre` (`idMembre`, `idUtilisateur`, `idGroupe`) VALUES
(7, 1, 1),
(1, 1, 2),
(2, 2, 1),
(3, 2, 2),
(4, 3, 1),
(8, 8, 2);

-- --------------------------------------------------------

--
-- Structure de la table `moderateur`
--

DROP TABLE IF EXISTS `moderateur`;
CREATE TABLE IF NOT EXISTS `moderateur` (
  `idModerateur` int(50) NOT NULL auto_increment,
  `idGroupe` int(50) NOT NULL,
  `idMembre` int(50) NOT NULL,
  PRIMARY KEY  (`idModerateur`),
  UNIQUE KEY `idGroupe` (`idGroupe`),
  UNIQUE KEY `idMembre` (`idMembre`),
  UNIQUE KEY `idMembre_2` (`idMembre`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `moderateur`
--

INSERT INTO `moderateur` (`idModerateur`, `idGroupe`, `idMembre`) VALUES
(1, 2, 3);

-- --------------------------------------------------------

--
-- Structure de la table `options`
--

DROP TABLE IF EXISTS `options`;
CREATE TABLE IF NOT EXISTS `options` (
  `idOption` int(50) NOT NULL auto_increment,
  `intituleOption` varchar(255) default NULL,
  `idSondage` int(50) default NULL,
  PRIMARY KEY  (`idOption`),
  KEY `idSondage` (`idSondage`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=59 ;

--
-- Contenu de la table `options`
--

INSERT INTO `options` (`idOption`, `intituleOption`, `idSondage`) VALUES
(42, 'M. Truc', 3),
(43, 'Mme. Machin', 3),
(44, 'Mlle. Bidule', 3),
(45, 'Super produit', 4),
(46, 'Produit magique', 4),
(47, 'Nom sans idee', 4),
(48, 'Tres satisfait', 5),
(49, 'Satisfait', 5),
(50, 'Moyennement satisfait', 5),
(51, 'Peu satisfait', 5),
(52, 'Pas satisfait du tout', 5),
(53, 'Restauration', 6),
(54, 'Terrains sportifs', 6),
(55, 'Salle de détente', 6),
(56, 'Delegation', 7),
(57, 'Esthetique du site', 7),
(58, 'Grade (en fonction de la participation aux sondages)', 7);

-- --------------------------------------------------------

--
-- Structure de la table `sondage`
--

DROP TABLE IF EXISTS `sondage`;
CREATE TABLE IF NOT EXISTS `sondage` (
  `idSondage` int(50) NOT NULL auto_increment,
  `titreSondage` varchar(255) NOT NULL,
  `descriptionSondage` mediumtext NOT NULL,
  `dateFinSondage` date NOT NULL,
  `idAdministrateur` int(50) NOT NULL,
  `idType` int(50) NOT NULL,
  `idGroupe` int(50) default NULL,
  PRIMARY KEY  (`idSondage`),
  UNIQUE KEY `idAdministrateur` (`idAdministrateur`,`idType`),
  UNIQUE KEY `idGroupe` (`idGroupe`),
  KEY `idType` (`idType`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Contenu de la table `sondage`
--

INSERT INTO `sondage` (`idSondage`, `titreSondage`, `descriptionSondage`, `dateFinSondage`, `idAdministrateur`, `idType`, `idGroupe`) VALUES
(3, 'Previsions elections municipales', 'Sondage sur les intentions de votes pour les elections municipales de 2014', '2014-04-23', 1, 4, 1),
(4, 'Nouveau produit', 'Vous devez selectionner le nom que vous preferez pour un nouveau produit', '2014-08-07', 2, 1, NULL),
(5, 'Satisfaction clientele', 'Etes-vous satisfait par nos services ? Dites le nous en repondant a ce sondage.', '2015-09-04', 3, 4, 2),
(6, 'Sondage choix budgetaire', 'Donnez votre avis sur les projets budgetaire pour l''annee 2015.', '2014-12-05', 2, 3, NULL),
(7, 'Satisfaction utilisateurs', 'Choisissez la prochaine amelioration qui sera apportee au site', '2014-05-20', 1, 2, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `type_groupe`
--

DROP TABLE IF EXISTS `type_groupe`;
CREATE TABLE IF NOT EXISTS `type_groupe` (
  `idTypeGroupe` int(50) NOT NULL auto_increment,
  `nomTypeGroupe` varchar(255) NOT NULL,
  PRIMARY KEY  (`idTypeGroupe`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `type_groupe`
--

INSERT INTO `type_groupe` (`idTypeGroupe`, `nomTypeGroupe`) VALUES
(1, 'public'),
(2, 'privé visible'),
(3, 'privé caché');

-- --------------------------------------------------------

--
-- Structure de la table `type_sondage`
--

DROP TABLE IF EXISTS `type_sondage`;
CREATE TABLE IF NOT EXISTS `type_sondage` (
  `idTypeSondage` int(50) NOT NULL auto_increment,
  `nomTypeSondage` varchar(255) NOT NULL,
  PRIMARY KEY  (`idTypeSondage`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `type_sondage`
--

INSERT INTO `type_sondage` (`idTypeSondage`, `nomTypeSondage`) VALUES
(1, 'public'),
(2, 'inscrit'),
(3, 'privé'),
(4, 'groupe');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `idUtilisateur` int(50) NOT NULL auto_increment,
  `pseudoUtilisateur` varchar(255) NOT NULL,
  `passUtilisateur` varchar(255) NOT NULL,
  `mailUtilisateur` varchar(255) NOT NULL,
  PRIMARY KEY  (`idUtilisateur`),
  UNIQUE KEY `mailUtilisateur` (`mailUtilisateur`),
  UNIQUE KEY `mailUtilisateur_2` (`mailUtilisateur`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Contenu de la table `utilisateur`
--

INSERT INTO `utilisateur` (`idUtilisateur`, `pseudoUtilisateur`, `passUtilisateur`, `mailUtilisateur`) VALUES
(1, 'Sam', 'b6edd10559b20cb0a3ddaeb15e5267cc', 'sambricas@hotmail.com'),
(2, 'Thibaut', '5850c4e3c1b5b0581233a1f3b3454e94', 'thibaut.castanie@gmail.com'),
(3, 'Paul', '4fe83bdbfa703391ae6ea3797f4c1924 ', 'sambricas@gmail.com'),
(4, 'Roby', 'f217245298b4bdb0a20b7943c430b9ae', 'pouet@aol.com'),
(6, 'Michou', '862752f50fa68ebf41d03f0b00bef0a8', 'jean.michel@laposte.fr'),
(8, 'Jean', 'b71985397688d6f1820685dde534981b', 'jean@gmail.com');

-- --------------------------------------------------------

--
-- Structure de la table `vote`
--

DROP TABLE IF EXISTS `vote`;
CREATE TABLE IF NOT EXISTS `vote` (
  `idVote` int(50) NOT NULL auto_increment,
  `scoreVote` int(50) NOT NULL,
  `idUtilisateur` int(50) default NULL,
  `idSondage` int(50) NOT NULL,
  `idOption` int(50) NOT NULL,
  PRIMARY KEY  (`idVote`),
  UNIQUE KEY `idUtilisateur` (`idUtilisateur`,`idSondage`,`idOption`),
  KEY `idSondage` (`idSondage`),
  KEY `idOption` (`idOption`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=106 ;

--
-- Contenu de la table `vote`
--

INSERT INTO `vote` (`idVote`, `scoreVote`, `idUtilisateur`, `idSondage`, `idOption`) VALUES
(13, 3, 1, 3, 44),
(14, 2, 1, 3, 42),
(15, 1, 1, 3, 43),
(16, 3, 2, 3, 42),
(17, 2, 2, 3, 44),
(18, 1, 2, 3, 43),
(49, 3, 1, 4, 47),
(50, 2, 1, 4, 46),
(51, 1, 1, 4, 45),
(52, 3, 2, 4, 47),
(53, 3, 2, 4, 45),
(54, 3, 2, 4, 46),
(55, 3, 3, 4, 45),
(56, 3, 3, 4, 47),
(57, 3, 3, 4, 46),
(58, 5, 2, 5, 51),
(59, 4, 2, 5, 48),
(60, 3, 2, 5, 49),
(61, 2, 2, 5, 50),
(62, 1, 2, 5, 52),
(72, 3, 1, 6, 54),
(73, 2, 1, 6, 53),
(74, 3, 1, 6, 55),
(75, 3, 3, 6, 53),
(76, 2, 3, 6, 54),
(77, 1, 3, 6, 55),
(78, 3, 2, 7, 58),
(79, 2, 2, 7, 57),
(80, 1, 2, 7, 56),
(82, 3, NULL, 4, 45),
(83, 2, NULL, 4, 46),
(84, 1, NULL, 4, 47),
(85, 3, NULL, 4, 45),
(86, 2, NULL, 4, 46),
(87, 1, NULL, 4, 47),
(88, 3, NULL, 4, 46),
(89, 2, NULL, 4, 45),
(90, 1, NULL, 4, 47),
(91, 3, NULL, 4, 45),
(92, 2, NULL, 4, 46),
(93, 1, NULL, 4, 47),
(94, 3, NULL, 4, 45),
(95, 2, NULL, 4, 46),
(96, 1, NULL, 4, 47),
(97, 3, NULL, 4, 45),
(98, 2, NULL, 4, 46),
(99, 1, NULL, 4, 47),
(100, 3, NULL, 4, 45),
(101, 2, NULL, 4, 46),
(102, 1, NULL, 4, 47),
(103, 3, NULL, 4, 45),
(104, 2, NULL, 4, 46),
(105, 1, NULL, 4, 47);

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `commentaire`
--
ALTER TABLE `commentaire`
  ADD CONSTRAINT `commentaire_ibfk_2` FOREIGN KEY (`idParent`) REFERENCES `commentaire` (`idCommentaire`),
  ADD CONSTRAINT `commentaire_ibfk_1` FOREIGN KEY (`idSondage`) REFERENCES `sondage` (`idSondage`);

--
-- Contraintes pour la table `groupe`
--
ALTER TABLE `groupe`
  ADD CONSTRAINT `groupe_ibfk_2` FOREIGN KEY (`idAdminstrateur`) REFERENCES `utilisateur` (`idUtilisateur`),
  ADD CONSTRAINT `groupe_ibfk_1` FOREIGN KEY (`idType`) REFERENCES `type_groupe` (`idTypeGroupe`);

--
-- Contraintes pour la table `inscrit`
--
ALTER TABLE `inscrit`
  ADD CONSTRAINT `inscrit_ibfk_2` FOREIGN KEY (`idUtilisateur`) REFERENCES `utilisateur` (`idUtilisateur`),
  ADD CONSTRAINT `inscrit_ibfk_1` FOREIGN KEY (`idSondage`) REFERENCES `sondage` (`idSondage`);

--
-- Contraintes pour la table `membre`
--
ALTER TABLE `membre`
  ADD CONSTRAINT `membre_ibfk_2` FOREIGN KEY (`idGroupe`) REFERENCES `groupe` (`idGroupe`),
  ADD CONSTRAINT `membre_ibfk_1` FOREIGN KEY (`idUtilisateur`) REFERENCES `utilisateur` (`idUtilisateur`);

--
-- Contraintes pour la table `moderateur`
--
ALTER TABLE `moderateur`
  ADD CONSTRAINT `moderateur_ibfk_2` FOREIGN KEY (`idMembre`) REFERENCES `membre` (`idMembre`),
  ADD CONSTRAINT `moderateur_ibfk_1` FOREIGN KEY (`idGroupe`) REFERENCES `groupe` (`idGroupe`);

--
-- Contraintes pour la table `options`
--
ALTER TABLE `options`
  ADD CONSTRAINT `options_ibfk_1` FOREIGN KEY (`idSondage`) REFERENCES `sondage` (`idSondage`);

--
-- Contraintes pour la table `sondage`
--
ALTER TABLE `sondage`
  ADD CONSTRAINT `sondage_ibfk_3` FOREIGN KEY (`idGroupe`) REFERENCES `groupe` (`idGroupe`),
  ADD CONSTRAINT `sondage_ibfk_1` FOREIGN KEY (`idAdministrateur`) REFERENCES `utilisateur` (`idUtilisateur`),
  ADD CONSTRAINT `sondage_ibfk_2` FOREIGN KEY (`idType`) REFERENCES `type_sondage` (`idTypeSondage`);

--
-- Contraintes pour la table `vote`
--
ALTER TABLE `vote`
  ADD CONSTRAINT `vote_ibfk_2` FOREIGN KEY (`idSondage`) REFERENCES `options` (`idSondage`),
  ADD CONSTRAINT `vote_ibfk_3` FOREIGN KEY (`idOption`) REFERENCES `options` (`idOption`);
