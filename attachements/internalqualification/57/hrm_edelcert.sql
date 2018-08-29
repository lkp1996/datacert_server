-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Client :  localhost
-- Généré le :  Jeu 31 Mai 2018 à 10:24
-- Version du serveur :  5.6.35
-- Version de PHP :  7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de données :  `hrm_edelcert`
--

-- --------------------------------------------------------

--
-- Structure de la table `auditexperience`
--

CREATE TABLE `auditexperience` (
  `pk_auditExperience` int(11) NOT NULL,
  `organizationName` varchar(100) NOT NULL,
  `organizationActivity` varchar(100) NOT NULL,
  `fk_NMSStandard` int(11) NOT NULL,
  `EAScope` varchar(100) NOT NULL,
  `oc` varchar(100) NOT NULL,
  `year` varchar(100) NOT NULL,
  `fees` double DEFAULT NULL,
  `mandatesheet` longtext,
  `fk_employee` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `auditexperience`
--

INSERT INTO `auditexperience` (`pk_auditExperience`, `organizationName`, `organizationActivity`, `fk_NMSStandard`, `EAScope`, `oc`, `year`, `fees`, `mandatesheet`, `fk_employee`) VALUES
(1, 'test1', 'test1', 6, '5', 'test1', '2017', 12.5, 'edelcert.png', 1),
(6, 'test1', 'test1', 1, '1', 'test1', '2001', NULL, NULL, 2),
(7, 'test2', 'test2', 2, '2', 'test2', '2002', NULL, NULL, 2),
(8, 'test2', 'test2', 4, '2', 'test2', '2018', 100, 'modification HRM 2.pptx', 1);

-- --------------------------------------------------------

--
-- Structure de la table `auditobservation`
--

CREATE TABLE `auditobservation` (
  `pk_auditObservation` int(11) NOT NULL,
  `organization` varchar(100) NOT NULL,
  `observer` varchar(100) NOT NULL,
  `attachement` longtext,
  `EAScope` int(11) NOT NULL,
  `comment` longtext NOT NULL,
  `date` bigint(11) NOT NULL,
  `fk_employee` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `auditobservation`
--

INSERT INTO `auditobservation` (`pk_auditObservation`, `organization`, `observer`, `attachement`, `EAScope`, `comment`, `date`, `fk_employee`) VALUES
(5, 'test1', 'test1', 'heures_hrm.xlsx', 1, 'test1dasasdf', 1504303200000, 1),
(6, 'test2', 'test2', 'deplacement_de_cr.docx', 2, 'test2dsg', 1504303200000, 1),
(7, 'test3', 'test3', 'heures_hrm.xlsx', 3, 'test3sddbcvcvcvxcxv dfggsdg', 1504389600000, 1),
(9, 'test', 'test', 'bryan_cranston_0095.jpg', 1, 'testtsetesa', 1505080800000, 2);

-- --------------------------------------------------------

--
-- Structure de la table `consultingexperience`
--

CREATE TABLE `consultingexperience` (
  `pk_consultingExperience` int(11) NOT NULL,
  `organizationName` varchar(100) NOT NULL,
  `organizationActivity` varchar(100) NOT NULL,
  `fk_NMSStandard` int(11) NOT NULL,
  `EAScope` int(11) NOT NULL,
  `organization` varchar(100) NOT NULL,
  `year` varchar(100) NOT NULL,
  `fk_employee` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `consultingexperience`
--

INSERT INTO `consultingexperience` (`pk_consultingExperience`, `organizationName`, `organizationActivity`, `fk_NMSStandard`, `EAScope`, `organization`, `year`, `fk_employee`) VALUES
(1, 'test1', 'test1', 1, 1, 'test1', '2017', 1),
(3, 'test3', 'test3', 5, 3, 'test3', '2018', 1),
(14, 'test1', 'test1', 1, 1, 'test1', '2011', 2);

-- --------------------------------------------------------

--
-- Structure de la table `employee`
--

CREATE TABLE `employee` (
  `pk_employee` int(11) NOT NULL,
  `lastName` varchar(100) NOT NULL,
  `firstName` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `isAdmin` tinyint(4) NOT NULL DEFAULT '0',
  `birthDate` bigint(11) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `postCode` varchar(100) DEFAULT NULL,
  `location` varchar(100) DEFAULT NULL,
  `avs` varchar(100) DEFAULT NULL,
  `phone` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `picture` longtext,
  `currentTitle` varchar(100) DEFAULT NULL,
  `comingToOfficeDate` bigint(11) DEFAULT NULL,
  `currentHourlyWage` double DEFAULT NULL,
  `cv` longtext,
  `criminalRecord` longtext
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `employee`
--

INSERT INTO `employee` (`pk_employee`, `lastName`, `firstName`, `username`, `password`, `isAdmin`, `birthDate`, `address`, `postCode`, `location`, `avs`, `phone`, `email`, `picture`, `currentTitle`, `comingToOfficeDate`, `currentHourlyWage`, `cv`, `criminalRecord`) VALUES
(1, 'Perrottet', 'Luke', 'lukeperrottet', '24605ba2173d61e1e8d5d32632f9acae', 1, 829008000000, 'En Palud 26', '1643', 'Gumefens', '75601812096', '0787716628', 'lukeperrottet@gmail.com', 'portrait.jpeg', 'Informaticien', 1488927600000, 50, 'e1.c', 'deplacement_de_cr.docx'),
(2, 'Jules', 'Tartampion', 'julestartampion', '912ec803b2ce49e4a541068d495ab570', 0, 631148400000, 'Grande Rue', '1631', 'Bulle', '7560011232410', '0791111111', 'julestartampion@gmail.com', 'jules_tartampion.jpg', 'Professeur', 1300921200000, 20, 'edelcert.png', 'MATU.JPG'),
(19, 'Perrottet', 'Stéphane', 'stephaneperrottet', '098f6bcd4621d373cade4e832627b4f6', 1, -216694800000, 'En Palud 26', '1643', 'Gumefens', '756', '0796173361', 'direction@edelcert.ch', 'stephaneperrottet.jpeg', 'Directeur', 1325372400000, 150, '', ''),
(51, 'Perrottet', 'Allan', '', '', 0, 677628000000, 'En Palud 26', '1643', 'Gumefens', '', '0797918874', 'a.perrottet@edelcert.ch', 'allan-300x300.jpg', 'Auditeur', 1483225200000, 150, 'Formulaire armée - Luke Perrottet.pdf', 'billet_damso_estival2017.pdf'),
(52, 'asdf', 'asdf', 'asdfasdf', '78692dde78bdc841782acf0cfc6e06d4', 0, 1521586800000, 'En Palud', 'asdf', '', '', '0787716628', 'lukeperrottet@gmail.com', '', '', 1521586800000, 0, '', ''),
(53, 'test', 'test', 'testtest', 'eba6a15621446abafd012d2f63aee7c0', 0, 1522188000000, 'En Palud', '', '', '', '0787716628', 'lukeperrottet@gmail.com', '', '', 1522188000000, 0, '', ''),
(54, 'test2', 'test2', 'test2test2', '640aca1e49e0613a6d071094e508895b', 0, 1522188000000, 'En Palud', '', '', '', '0787716628', 'lukeperrottet@gmail.com', '', '', 1522188000000, 0, '', ''),
(55, 'ouais', 'ouais', 'ouaisouais', '5b54a2e9300b7b199618b2dae3ca9ca6', 0, 1524952800000, 'En Palud', '', '', '', '0787716628', 'lukeperrottet@gmail.com', '', '', 1524952800000, 0, '', ''),
(57, 'ah2', 'ah', 'ahah2', 'fcc191d3c681b96cab07e18cbc077648', 0, 1524952800000, 'En Palud', '', '', '', '0787716628', 'lukeperrottet@gmail.com', '', '', 1524952800000, 0, '', '');

-- --------------------------------------------------------

--
-- Structure de la table `formation`
--

CREATE TABLE `formation` (
  `pk_formation` int(11) NOT NULL,
  `formativeOrganization` varchar(100) NOT NULL,
  `fk_formationType` int(11) NOT NULL,
  `EAScope` int(11) NOT NULL,
  `fromDate` bigint(11) NOT NULL,
  `toDate` bigint(11) NOT NULL,
  `attachement` longtext,
  `fk_employee` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `formation`
--

INSERT INTO `formation` (`pk_formation`, `formativeOrganization`, `fk_formationType`, `EAScope`, `fromDate`, `toDate`, `attachement`, `fk_employee`) VALUES
(1, 'Ecole des Métiers', 1, 2, 1499775487000, 1505218687000, 'emf.pdf', 1),
(2, 'HEIA-FR', 3, 2, 1499861887000, 1499861887000, '', 1),
(23, 'test2', 1, 25, 1483225200000, 1507586400000, 'deplacement_de_cr.docx', 1),
(24, 'testasfas', 4, 34, 1298415600000, 1386630000000, '', 1),
(36, 'test1', 1, 1, 1504216800000, 1504216800000, '!gedreports.pdf', 2),
(40, 'a', 1, 1, 1518994800000, 1518994800000, '', 19);

-- --------------------------------------------------------

--
-- Structure de la table `formationtype`
--

CREATE TABLE `formationtype` (
  `pk_formationType` int(11) NOT NULL,
  `formation` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `formationtype`
--

INSERT INTO `formationtype` (`pk_formationType`, `formation`) VALUES
(1, 'CFC'),
(2, 'ES'),
(3, 'HES'),
(4, 'CAS'),
(5, 'DAS'),
(6, 'MAS'),
(7, 'Attestation FC');

-- --------------------------------------------------------

--
-- Structure de la table `internalqualification`
--

CREATE TABLE `internalqualification` (
  `pk_internalQualifications` int(11) NOT NULL,
  `process` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `internalqualification`
--

INSERT INTO `internalqualification` (`pk_internalQualifications`, `process`) VALUES
(1, 'Les enregistrements, retours d\'informations, entretiens, observations, examens sont-ils suffisants ?'),
(2, 'Pour quels scopes le candidat pourra-t-il être qualifié ?'),
(3, 'Le candidat a-t-il démontré un niveau de connaissance  suffisant de l’ISO 9001 : 2015 lors de la réalisation de l’auto-évaluation ?'),
(4, 'Le candidat a-t-il besoin d’un programme de formation/tutorat pour rejoindre l’équipe d’audit ?'),
(5, 'Le candidat auditeur doit-il participer à un (ou plusieurs) audit(s) en tant qu\'observateur ? Si non donner une exlication.'),
(6, 'Le candidat auditeur a-t-il déjà participé à un ou plusieurs audits sous la surveillance d\'un observateur désigné par la direction et contribue à la rédaction du rapport ?'),
(7, 'L’évaluation de la performance du travail du candidat est-elle suffisante ?'),
(8, 'La validation de la qualification en tant qu’auditeur peut-elle être prononcée ? Et pour quels scopes ?'),
(9, 'La validation de la qualification en tant que responsable d’audit peut-elle être prononcée ? Et pour quels scopes ?'),
(10, 'Les concepts fondamentaux et les principes du management de la qualité et leur application ?'),
(11, 'Le termes et aux définitions relatifs au management de la qualité ?'),
(12, 'L’approche processus (tortue de Crosby) et les moyens de contrôle et de mesure de la performance ?'),
(13, 'Le rôle de leadership au sein d’un organisme et son impact sur le SMQ ?'),
(14, 'La mise en application d’une approche basée sur les risques y compris la détermination des risques et des opportunités ?'),
(15, 'L’analyse du contexte (enjeux internes et externes)  et l’importance stratégique des parties intéressées ?'),
(16, 'Les périmètres d’application et leur application dans le SMQ de l’organisme ?'),
(17, 'La mise en oeuvre du cycle PDCA (Planifier, Réaliser, Vérifier, Agir) ?'),
(18, 'Les structures et interactions des informations documentées spécifiques au management de la qualité ?'),
(19, 'Les outils, les méthodes, les techniques de management de la qualité et leur mise en œuvre ?'),
(20, 'La validation des compétences en SM peut-elle être prononcée ?\n');

-- --------------------------------------------------------

--
-- Structure de la table `internalqualification_employee`
--

CREATE TABLE `internalqualification_employee` (
  `fk_internalQualification` int(11) NOT NULL,
  `fk_employee` int(11) NOT NULL,
  `yesno` tinyint(4) NOT NULL,
  `result` varchar(100) NOT NULL,
  `validationDate` bigint(11) DEFAULT NULL,
  `attachement` longtext
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `internalqualification_employee`
--

INSERT INTO `internalqualification_employee` (`fk_internalQualification`, `fk_employee`, `yesno`, `result`, `validationDate`, `attachement`) VALUES
(1, 1, 1, 'test1123', 1505242310000, 'test1.pdf'),
(1, 2, 1, 'test', 1518652800000, ''),
(1, 19, 0, '', NULL, NULL),
(1, 51, 0, '', NULL, NULL),
(1, 52, 0, '', NULL, NULL),
(1, 53, 0, '', NULL, NULL),
(1, 54, 0, 'test', 0, 'rev_te1(1).pdf'),
(1, 55, 0, '', NULL, NULL),
(1, 57, 0, '', 0, ''),
(2, 1, 0, 'test2', 1499885510000, ''),
(2, 2, 0, 'test1', 1517875200000, 'Capture d’écran 2018-02-01 à 16.05.00.png'),
(2, 19, 0, '', NULL, NULL),
(2, 51, 0, '', NULL, NULL),
(2, 52, 0, '', NULL, NULL),
(2, 53, 0, '', NULL, NULL),
(2, 54, 0, '', 0, ''),
(2, 55, 0, '', NULL, NULL),
(2, 57, 0, '', 0, ''),
(3, 1, 1, 'test3', 1499885510000, 'report.pdf'),
(3, 2, 0, 'fdsa', 1518652800000, ''),
(3, 19, 0, '', NULL, NULL),
(3, 51, 0, '', NULL, NULL),
(3, 52, 0, '', NULL, NULL),
(3, 53, 0, '', NULL, NULL),
(3, 54, 1, '', 1523401200000, ''),
(3, 55, 0, '', NULL, NULL),
(3, 57, 0, '', 0, ''),
(4, 1, 1, 'test4', 1499885510000, ''),
(4, 2, 0, '', 1518652800000, ''),
(4, 19, 0, '', NULL, NULL),
(4, 51, 0, '', NULL, NULL),
(4, 52, 0, '', NULL, NULL),
(4, 53, 0, '', NULL, NULL),
(4, 54, 0, '', 0, ''),
(4, 55, 0, '', NULL, NULL),
(4, 57, 0, '', 0, ''),
(5, 1, 0, 'test5', 1499885510000, ''),
(5, 2, 1, 'a', 0, ''),
(5, 19, 0, '', NULL, NULL),
(5, 51, 0, '', NULL, NULL),
(5, 52, 0, '', NULL, NULL),
(5, 53, 0, '', NULL, NULL),
(5, 54, 0, '', 0, ''),
(5, 55, 0, '', NULL, NULL),
(5, 57, 0, '', 0, ''),
(6, 1, 0, 'test6', 1499885510000, ''),
(6, 2, 1, '', 0, ''),
(6, 19, 0, '', NULL, NULL),
(6, 51, 0, '', NULL, NULL),
(6, 52, 0, '', NULL, NULL),
(6, 53, 0, '', NULL, NULL),
(6, 54, 1, 'test', 0, 'rev_te1.pdf'),
(6, 55, 0, '', NULL, NULL),
(6, 57, 0, '', 0, ''),
(7, 1, 1, 'test7', 1499885510000, 'bryan_cranston_0095.jpg'),
(7, 2, 1, '', 0, ''),
(7, 19, 0, '', NULL, NULL),
(7, 51, 0, '', NULL, NULL),
(7, 52, 0, '', NULL, NULL),
(7, 53, 0, '', NULL, NULL),
(7, 54, 0, '', 0, ''),
(7, 55, 0, '', NULL, NULL),
(7, 57, 0, '', 0, ''),
(8, 1, 0, 'test89', 1499885510000, ''),
(8, 2, 0, '', 0, ''),
(8, 19, 0, '', NULL, NULL),
(8, 51, 0, '', NULL, NULL),
(8, 52, 0, '', NULL, NULL),
(8, 53, 0, '', NULL, NULL),
(8, 54, 0, '', 0, ''),
(8, 55, 0, '', NULL, NULL),
(8, 57, 0, '', 0, ''),
(9, 1, 1, 'test9', 1499885510000, ''),
(9, 2, 0, '', 0, ''),
(9, 19, 0, '', NULL, NULL),
(9, 51, 0, '', NULL, NULL),
(9, 52, 0, '', NULL, NULL),
(9, 53, 0, '', NULL, NULL),
(9, 54, 0, '', 0, 's07.docx'),
(9, 55, 0, '', NULL, NULL),
(9, 57, 0, '', 0, ''),
(10, 1, 1, '', 0, ''),
(10, 54, 1, '', 0, 's07.docx'),
(10, 57, 1, 'ah', 1524956400000, ''),
(11, 1, 1, '', 1523401200000, ''),
(11, 54, 1, '', 0, ''),
(11, 57, 0, '', 0, ''),
(12, 1, 0, '', 0, 'Capture d’écran 2018-04-10 à 12.58.54.png'),
(12, 54, 0, '', 0, ''),
(12, 57, 0, '', 0, ''),
(13, 1, 0, '', 0, ''),
(13, 54, 0, 'asdfadsfasdf', 1523401200000, ''),
(13, 57, 0, '', 0, ''),
(14, 1, 0, '', 0, ''),
(14, 54, 0, '', 0, ''),
(14, 57, 0, '', 0, ''),
(15, 1, 0, '', 0, ''),
(15, 54, 0, '', 0, ''),
(15, 57, 0, '', 0, ''),
(16, 1, 0, '', 0, ''),
(16, 54, 0, '', 0, ''),
(16, 57, 0, '', 0, ''),
(17, 1, 0, '', 0, ''),
(17, 54, 1, 'asdf', 0, ''),
(17, 57, 0, '', 0, ''),
(18, 1, 0, '', 0, ''),
(18, 54, 0, '', 1523401200000, ''),
(18, 57, 0, '', 0, ''),
(19, 1, 0, '', 0, ''),
(19, 54, 0, '', 0, ''),
(19, 57, 0, '', 0, ''),
(20, 1, 0, '', 0, ''),
(20, 54, 0, '', 0, ''),
(20, 57, 0, '', 0, '');

-- --------------------------------------------------------

--
-- Structure de la table `mandatesheet`
--

CREATE TABLE `mandatesheet` (
  `pk_mandateSheet` int(11) NOT NULL,
  `organization` varchar(100) NOT NULL,
  `EAScope` int(11) NOT NULL,
  `date` bigint(11) NOT NULL,
  `fees` double DEFAULT NULL,
  `attachement` longtext,
  `fk_employee` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `mandatesheet`
--

INSERT INTO `mandatesheet` (`pk_mandateSheet`, `organization`, `EAScope`, `date`, `fees`, `attachement`, `fk_employee`) VALUES
(5, 'test1', 2, 1499775487000, 12, 'test1.pdf', 1),
(6, 'test2', 3, 1499861887000, 15, '', 1),
(7, 'test3', 2, 1499861887000, 222, '', 1),
(8, 'test12', 4, 1499861887000, 755, '', 1),
(9, 'test1', 2, 1499861887000, 44, '', 1),
(10, 'test2', 3, 1499861887000, 77, '', 1),
(12, 'asdf', 12, 1518649200000, 123, 'Projet HRM.pptx', 2),
(13, 'fdsa', 21, 1518649200000, 123, 'qcm.rat', 2);

-- --------------------------------------------------------

--
-- Structure de la table `nmsstandard`
--

CREATE TABLE `nmsstandard` (
  `pk_NMSStandard` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `nmsstandard`
--

INSERT INTO `nmsstandard` (`pk_NMSStandard`, `name`) VALUES
(1, 'ISO 9001'),
(2, 'ISO 14001'),
(3, 'Entreprise Citoyenne'),
(4, 'Swiss School Impulse'),
(5, 'PRP Bientraitance'),
(6, 'Label Soins Palliatifs ASQP');

-- --------------------------------------------------------

--
-- Structure de la table `objective`
--

CREATE TABLE `objective` (
  `pk_objective` int(11) NOT NULL,
  `mediumLongTermObjectives` varchar(100) NOT NULL,
  `auditorStrategy` varchar(100) NOT NULL,
  `date` bigint(11) NOT NULL,
  `validate` tinyint(4) NOT NULL,
  `fk_employee` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `objective`
--

INSERT INTO `objective` (`pk_objective`, `mediumLongTermObjectives`, `auditorStrategy`, `date`, `validate`, `fk_employee`) VALUES
(6, 'test11', 'test', 1504994400000, 0, 1),
(8, 'test3', 'test3', 1504389600000, 1, 1),
(9, 'test4', 'test4', 1508709600000, 0, 1);

-- --------------------------------------------------------

--
-- Structure de la table `professionnalexperience`
--

CREATE TABLE `professionnalexperience` (
  `pk_professionnalExperience` int(11) NOT NULL,
  `organizationName` varchar(100) NOT NULL,
  `organizationActivity` varchar(100) NOT NULL,
  `fonction` varchar(100) NOT NULL,
  `EAScope` int(11) NOT NULL,
  `fromDate` bigint(11) NOT NULL,
  `toDate` bigint(11) NOT NULL,
  `attachement` longtext,
  `fk_employee` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `professionnalexperience`
--

INSERT INTO `professionnalexperience` (`pk_professionnalExperience`, `organizationName`, `organizationActivity`, `fonction`, `EAScope`, `fromDate`, `toDate`, `attachement`, `fk_employee`) VALUES
(1, 'test1', 'test1', 'test1', 1, 1499861887000, 1525004287000, 'test1.pdf', 1),
(2, 'test2', 'test2', 'test2', 2, 1491221887000, 1525090687000, '', 1),
(35, 'tes1', 'test1', 'test1', 1, 1504216800000, 1504216800000, 'todo_hrm_edelcert.txt', 2),
(36, 'test', 'test', 'test', 12, 1518994800000, 1518994800000, '', 19),
(37, 'cT7kNjcv', 'cT7kNjcv', 'cT7kNjcv', 12, 1524952800000, 1524952800000, 'modification HRM 2.pptx', 55);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `auditexperience`
--
ALTER TABLE `auditexperience`
  ADD PRIMARY KEY (`pk_auditExperience`),
  ADD KEY `fk_auditExperience_NMSStandard1_idx` (`fk_NMSStandard`),
  ADD KEY `fk_auditExperience_employee1_idx` (`fk_employee`);

--
-- Index pour la table `auditobservation`
--
ALTER TABLE `auditobservation`
  ADD PRIMARY KEY (`pk_auditObservation`),
  ADD KEY `fk_auditObservation_employee1_idx` (`fk_employee`);

--
-- Index pour la table `consultingexperience`
--
ALTER TABLE `consultingexperience`
  ADD PRIMARY KEY (`pk_consultingExperience`),
  ADD KEY `fk_consultingExperience_NMSStandard1_idx` (`fk_NMSStandard`),
  ADD KEY `fk_consultingExperience_employee1_idx` (`fk_employee`);

--
-- Index pour la table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`pk_employee`);

--
-- Index pour la table `formation`
--
ALTER TABLE `formation`
  ADD PRIMARY KEY (`pk_formation`),
  ADD KEY `fk_formation_formationType_idx` (`fk_formationType`),
  ADD KEY `fk_formation_employee1_idx` (`fk_employee`);

--
-- Index pour la table `formationtype`
--
ALTER TABLE `formationtype`
  ADD PRIMARY KEY (`pk_formationType`);

--
-- Index pour la table `internalqualification`
--
ALTER TABLE `internalqualification`
  ADD PRIMARY KEY (`pk_internalQualifications`);

--
-- Index pour la table `internalqualification_employee`
--
ALTER TABLE `internalqualification_employee`
  ADD PRIMARY KEY (`fk_internalQualification`,`fk_employee`),
  ADD KEY `fk_internalQualification_has_employee_employee1_idx` (`fk_employee`),
  ADD KEY `fk_internalQualification_has_employee_internalQualification_idx` (`fk_internalQualification`);

--
-- Index pour la table `mandatesheet`
--
ALTER TABLE `mandatesheet`
  ADD PRIMARY KEY (`pk_mandateSheet`),
  ADD KEY `fk_mandateSheet_employee1_idx` (`fk_employee`);

--
-- Index pour la table `nmsstandard`
--
ALTER TABLE `nmsstandard`
  ADD PRIMARY KEY (`pk_NMSStandard`);

--
-- Index pour la table `objective`
--
ALTER TABLE `objective`
  ADD PRIMARY KEY (`pk_objective`),
  ADD KEY `fk_objective_employee1_idx` (`fk_employee`);

--
-- Index pour la table `professionnalexperience`
--
ALTER TABLE `professionnalexperience`
  ADD PRIMARY KEY (`pk_professionnalExperience`),
  ADD KEY `fk_professionnalExperience_employee1_idx` (`fk_employee`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `auditexperience`
--
ALTER TABLE `auditexperience`
  MODIFY `pk_auditExperience` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT pour la table `auditobservation`
--
ALTER TABLE `auditobservation`
  MODIFY `pk_auditObservation` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT pour la table `consultingexperience`
--
ALTER TABLE `consultingexperience`
  MODIFY `pk_consultingExperience` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT pour la table `employee`
--
ALTER TABLE `employee`
  MODIFY `pk_employee` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;
--
-- AUTO_INCREMENT pour la table `formation`
--
ALTER TABLE `formation`
  MODIFY `pk_formation` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
--
-- AUTO_INCREMENT pour la table `formationtype`
--
ALTER TABLE `formationtype`
  MODIFY `pk_formationType` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT pour la table `internalqualification`
--
ALTER TABLE `internalqualification`
  MODIFY `pk_internalQualifications` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT pour la table `mandatesheet`
--
ALTER TABLE `mandatesheet`
  MODIFY `pk_mandateSheet` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT pour la table `nmsstandard`
--
ALTER TABLE `nmsstandard`
  MODIFY `pk_NMSStandard` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT pour la table `objective`
--
ALTER TABLE `objective`
  MODIFY `pk_objective` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT pour la table `professionnalexperience`
--
ALTER TABLE `professionnalexperience`
  MODIFY `pk_professionnalExperience` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `auditexperience`
--
ALTER TABLE `auditexperience`
  ADD CONSTRAINT `fk_auditExperience_employee1` FOREIGN KEY (`fk_employee`) REFERENCES `employee` (`pk_employee`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `auditobservation`
--
ALTER TABLE `auditobservation`
  ADD CONSTRAINT `fk_auditObservation_employee1` FOREIGN KEY (`fk_employee`) REFERENCES `employee` (`pk_employee`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `consultingexperience`
--
ALTER TABLE `consultingexperience`
  ADD CONSTRAINT `fk_consultingExperience_employee1` FOREIGN KEY (`fk_employee`) REFERENCES `employee` (`pk_employee`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `formation`
--
ALTER TABLE `formation`
  ADD CONSTRAINT `fk_formation_employee1` FOREIGN KEY (`fk_employee`) REFERENCES `employee` (`pk_employee`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `internalqualification_employee`
--
ALTER TABLE `internalqualification_employee`
  ADD CONSTRAINT `fk_internalQualification_has_employee_employee1` FOREIGN KEY (`fk_employee`) REFERENCES `employee` (`pk_employee`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_internalQualification_has_employee_internalQualification1` FOREIGN KEY (`fk_internalQualification`) REFERENCES `internalQualification` (`pk_internalQualifications`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `mandatesheet`
--
ALTER TABLE `mandatesheet`
  ADD CONSTRAINT `fk_mandateSheet_employee1` FOREIGN KEY (`fk_employee`) REFERENCES `employee` (`pk_employee`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `objective`
--
ALTER TABLE `objective`
  ADD CONSTRAINT `fk_objective_employee1` FOREIGN KEY (`fk_employee`) REFERENCES `employee` (`pk_employee`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `professionnalexperience`
--
ALTER TABLE `professionnalexperience`
  ADD CONSTRAINT `fk_professionnalExperience_employee1` FOREIGN KEY (`fk_employee`) REFERENCES `employee` (`pk_employee`) ON DELETE CASCADE ON UPDATE CASCADE;
