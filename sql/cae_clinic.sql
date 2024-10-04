-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 04 oct. 2024 à 14:02
-- Version du serveur : 10.4.28-MariaDB
-- Version de PHP : 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `cae_clinic`
--

-- --------------------------------------------------------

--
-- Structure de la table `appointment`
--

CREATE TABLE `appointment` (
  `a_id` int(11) NOT NULL,
  `pat_id` int(11) NOT NULL,
  `patient` varchar(30) NOT NULL,
  `tel` varchar(20) NOT NULL,
  `nom` varchar(30) NOT NULL,
  `raison` varchar(35) NOT NULL,
  `date` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `appointment`
--

INSERT INTO `appointment` (`a_id`, `pat_id`, `patient`, `tel`, `nom`, `raison`, `date`) VALUES
(15, 34, 'tagne', '650212440', 'Wando', 'suivis/checkup/grossesse, etc, etc', '2024-07-06'),
(17, 51, 'Howard Shaw', '+1 (594) 565-6327', 'Johnson', 'kjhbkbnj\r\n', '2024-07-12'),
(18, 48, 'aareem Chavez', '+1 (112) 259-5877', 'Epoh', 'Eaque qui aut dolor ', '2030-12-07'),
(19, 48, 'aareem Chavez', '+1 (112) 259-5877', 'DJONKEN', 'Okay', '2024-07-18');

-- --------------------------------------------------------

--
-- Structure de la table `consultations`
--

CREATE TABLE `consultations` (
  `cons_id` int(11) NOT NULL,
  `p_id` int(11) NOT NULL,
  `doc_name` varchar(20) NOT NULL,
  `motif` varchar(100) NOT NULL,
  `histoire` varchar(100) NOT NULL,
  `AM` varchar(100) NOT NULL,
  `AI` varchar(100) NOT NULL,
  `AT` varchar(100) NOT NULL,
  `AO` varchar(100) NOT NULL,
  `AE` varchar(100) NOT NULL,
  `AP` varchar(100) NOT NULL,
  `AF` varchar(100) NOT NULL,
  `enquete` varchar(100) NOT NULL,
  `EP` varchar(100) NOT NULL,
  `diag` varchar(100) NOT NULL,
  `bilan` varchar(100) NOT NULL,
  `traitement` varchar(100) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `heure` time NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `consultations`
--

INSERT INTO `consultations` (`cons_id`, `p_id`, `doc_name`, `motif`, `histoire`, `AM`, `AI`, `AT`, `AO`, `AE`, `AP`, `AF`, `enquete`, `EP`, `diag`, `bilan`, `traitement`, `date`, `heure`) VALUES
(5, 31, 'Johnson', 'Est debitis assumen', 'Amet voluptate alia', 'Voluptas tempore cu', 'Cillum elit consequ', 'Dignissimos et exerc', 'Cupiditate dolore po', 'Laboris deserunt sed', 'Culpa dolorum laboru', 'Laboris dolorem cons', 'Autem et velit sit c', 'Eligendi quasi in ve', 'Veniam qui cupidata', 'Ut et quisquam ex co', 'Est cupiditate velit', '2024-06-12', '13:23:30'),
(7, 31, 'foulefack', 'Exercitation esse ma', 'Qui inventore non la', 'Commodo velit repreh', 'Nihil dignissimos ve', 'Qui laudantium magn', 'Explicabo Nisi sunt', 'Excepteur beatae ea ', 'Exercitationem tempo', 'Eos a est ex est', 'Velit tempora nihil ', 'Nobis atque necessit', 'Dolore et non earum ', 'A beatae eos in quo ', 'Veniam qui quia con', '2024-06-12', '14:32:00'),
(8, 31, 'DJONKEN', 'CHECKUP', '- a pris des somniferes\r\n- a pris des paracetamoles', 'tick du nez\r\ngale aux bras', 'RAS', 'RAS', 'RAS', 'RAS', 'RAS', '- Diabete', 'RAS', 'RAS', 'Paludisme leger', '- scannere estomach', '- Quarteme 700/80 \r\n- matin - midi - soir', '2024-06-13', '15:11:20'),
(9, 33, 'Wando', 'cntraction de la grossesse', 'RAS', 'palue leger', 'RAS', 'fume', 'RAS', 'flaque deau salle a cote de la maison', 'axces  de collere', '- diabete\r\n- hyper tension\r\n- cancer', 'RAS', 'se porte bien', 'patient et foeutus bien portatnt', 'echographie du ventre', 'repos', '2024-06-13', '16:17:16'),
(14, 34, 'soumeya', 'Aspernatur quisquam ', 'Quidem quam minim il', 'Similique assumenda ', 'Excepteur sint faci', 'Nesciunt ipsa quis', 'Quis itaque labore p', 'Lorem ad esse lauda', 'In voluptate quod cu', 'Tenetur laudantium ', 'Laudantium doloribu', 'Ullamco eos beatae ', 'Quam minim hic sunt', 'Sint rerum minim in', 'Earum ipsum invento', '2024-07-03', '12:21:11'),
(15, 35, 'Epoh', 'Officiis aliquid non', 'Qui do similique in ', 'Reprehenderit est u', 'Dolor quis nulla aut', 'Laboriosam alias ev', 'Et totam aut in et m', 'Ullam accusamus aliq', 'Molestias animi qua', 'Vitae voluptas qui n', 'Iste commodi beatae ', 'Qui aut reprehenderi', 'Dolorem commodi magn', 'Ullamco quo nisi sun', 'Consequatur Nihil i', '2024-07-05', '16:01:34');

-- --------------------------------------------------------

--
-- Structure de la table `cpn`
--

CREATE TABLE `cpn` (
  `cpn_id` int(11) NOT NULL,
  `p_id` int(11) NOT NULL,
  `doc_name` varchar(50) NOT NULL,
  `EG` varchar(50) NOT NULL,
  `conj` varchar(50) NOT NULL,
  `ES` varchar(50) NOT NULL,
  `abdomen` varchar(50) NOT NULL,
  `HU` varchar(50) NOT NULL,
  `CA` varchar(50) NOT NULL,
  `MAF` varchar(50) NOT NULL,
  `BDCF` varchar(50) NOT NULL,
  `plaintes` varchar(50) NOT NULL,
  `TV` varchar(50) NOT NULL,
  `RE` varchar(50) NOT NULL,
  `conclusion` varchar(50) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `heure` time NOT NULL DEFAULT current_timestamp(),
  `oedem` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `cpn`
--

INSERT INTO `cpn` (`cpn_id`, `p_id`, `doc_name`, `EG`, `conj`, `ES`, `abdomen`, `HU`, `CA`, `MAF`, `BDCF`, `plaintes`, `TV`, `RE`, `conclusion`, `date`, `heure`, `oedem`) VALUES
(2, 48, 'Epoh', 'bien', 'non', 'bien', 'bien', '50', '20', '6', '80', 'ras', 'okay', 'bien', 'okay', '2024-07-18', '16:20:25', 'oui'),
(3, 48, 'foulefack', 'passable', 'non', 'normal', 'bien', '23', '36', '24', '65', 'douleur', 'bien', 'RAS\r\ntout beign', 'good', '2024-07-18', '16:35:21', 'non'),
(5, 51, 'foulefack', 'Quia dicta id qui ve', 'Ut pariatur Nostrud', 'Illum elit numquam', 'Et corrupti quas re', 'Ullamco excepteur ip', 'Dolores harum quia r', 'Explicabo Sunt fugi', 'Qui aliqua Ut et si', 'Eu eos quo omnis du', 'Beatae quasi maxime AXAaXAx', 'Expedita hic velit ', 'Magna laudantium se', '2024-07-19', '10:16:06', 'oui'),
(6, 51, 'soumeya', 'Quos et quidem eaque', 'Et est nesciunt in', 'Aut minima autem dol', 'Exercitationem a rep\r\nsaxasx', 'Tempor reiciendis re\r\nAXSX', 'Praesentium non offi', 'Debitis excepteur qu', 'Labore dicta nisi te', 'Veritatis aut et off', 'Exercitationem in se', 'Libero quis sint fug', 'Facere velit ut tota', '2024-07-19', '10:16:45', 'oui');

-- --------------------------------------------------------

--
-- Structure de la table `dispo`
--

CREATE TABLE `dispo` (
  `id` int(11) NOT NULL,
  `doc_name` varchar(30) NOT NULL,
  `lundi` int(11) NOT NULL,
  `mardi` int(11) NOT NULL,
  `mercredi` int(11) NOT NULL,
  `jeudi` int(11) NOT NULL,
  `vendredi` int(11) NOT NULL,
  `samedi` int(11) NOT NULL,
  `dimanche` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `dispo`
--

INSERT INTO `dispo` (`id`, `doc_name`, `lundi`, `mardi`, `mercredi`, `jeudi`, `vendredi`, `samedi`, `dimanche`) VALUES
(1, 'Wando', 1, 0, 0, 1, 0, 1, 0),
(4, 'Epoh', 1, 0, 1, 1, 0, 1, 1),
(5, 'DJONKEN', 0, 0, 1, 1, 1, 1, 0),
(6, 'foulefack', 0, 1, 0, 1, 0, 1, 1),
(7, 'soumeya', 1, 1, 0, 0, 1, 1, 0),
(8, 'Johnson', 1, 1, 0, 1, 1, 0, 1);

-- --------------------------------------------------------

--
-- Structure de la table `docteurs`
--

CREATE TABLE `docteurs` (
  `id` int(11) NOT NULL,
  `nom` varchar(30) NOT NULL,
  `prenom` varchar(30) NOT NULL,
  `tel` varchar(15) NOT NULL,
  `specialite` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `docteurs`
--

INSERT INTO `docteurs` (`id`, `nom`, `prenom`, `tel`, `specialite`) VALUES
(1, 'Wando', 'Ben J.', '620730137', 'Pediatre'),
(2, 'Epoh', 'Tousaint', '633003300', 'Generalist'),
(3, 'DJONKEN', 'emile laure', '620730137', 'generaliste'),
(4, 'foulefack', 'raissa', '633003300', 'cardiologue'),
(5, 'soumeya', ' samella', '620730137', 'pneumologue'),
(6, 'Johnson', 'djimmy', '633003300', 'autorhino');

-- --------------------------------------------------------

--
-- Structure de la table `historique`
--

CREATE TABLE `historique` (
  `a_id` int(11) NOT NULL,
  `patient` varchar(30) NOT NULL,
  `tel` varchar(20) NOT NULL,
  `nom` varchar(30) NOT NULL,
  `raison` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `historique`
--

INSERT INTO `historique` (`a_id`, `patient`, `tel`, `nom`, `raison`, `date`, `status`) VALUES
(1, 'ben wando', 'ben wando', 'Epoh', 'ben wando', '0000-00-00', 'Annule'),
(2, 'ben wando', 'ben wando', 'Epoh', 'ben wando', '0000-00-00', 'Annule'),
(3, 'ben wando', 'ben wando', 'Epoh', 'ben wando', '0000-00-00', 'Okay'),
(4, 'ben wando', 'ben wando', 'Epoh', 'ben wando', '0000-00-00', 'Annule'),
(5, 'ben wando', 'ben wando', 'Epoh', 'ben wando', '0000-00-00', 'Okay'),
(6, 'ben wando', 'ben wando', 'Johnson', 'ben wando', '2024-07-02', 'Okay'),
(7, 'ben wando', '620 73 01 37', 'Epoh', 'ben wando', '2024-07-02', 'Okay'),
(8, 'tagne', '650212440', 'Johnson', 'tagne', '2024-07-05', 'Okay');

-- --------------------------------------------------------

--
-- Structure de la table `parametre`
--

CREATE TABLE `parametre` (
  `par_id` int(11) NOT NULL,
  `p_id` int(11) NOT NULL,
  `temperature` varchar(10) NOT NULL,
  `tension_arteriel` varchar(15) NOT NULL,
  `poids` varchar(10) NOT NULL,
  `pouls` varchar(15) NOT NULL,
  `SP` varchar(20) NOT NULL,
  `FR` varchar(20) NOT NULL,
  `raison` varchar(100) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `heure` time NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `parametre`
--

INSERT INTO `parametre` (`par_id`, `p_id`, `temperature`, `tension_arteriel`, `poids`, `pouls`, `SP`, `FR`, `raison`, `date`, `heure`) VALUES
(1, 0, '27', '30.5', '75', '15', '', '', 'visite medicale', '2024-05-21', '12:38:34'),
(3, 0, '10', '25', '100', '23', '', '', 'test', '2024-05-21', '12:38:34'),
(8, 22, '10', '25', '100', '23', '', '', ' tvdf', '2024-05-21', '12:38:34'),
(9, 17, '29', '45', '85', '25', '', '', 'ibkjn', '2024-05-21', '12:38:34'),
(11, 23, '28', '12', '78', '21', '', '', 'checkup', '2024-05-22', '10:21:41'),
(12, 23, '29', '12', '95', '10', '', '', 'checkup', '2024-05-22', '10:31:17'),
(13, 23, '37', '16', '45', '16', '', '', 'visite medicale', '2024-05-22', '10:32:12'),
(18, 27, '37', '12', '82', '13', '20', '30', 'oh-ohk!', '2024-06-06', '13:52:36'),
(19, 27, '38', '32', '79', '32', '68', '32', 'ah', '2024-06-06', '13:55:12'),
(21, 29, '37', '25', '95', '230', '524', '32', 'diarhee aigue', '2024-06-07', '14:20:22'),
(22, 29, '38', '17', '86', '42', '68', '72', 'convalescence', '2024-06-07', '14:22:22'),
(26, 27, '37', '25', '95', '32', '45', '514', 'okay', '2024-06-10', '09:00:21'),
(28, 27, '29', '25', '95', '10', '20', '30', 'yooooo', '2024-06-10', '09:04:09'),
(29, 31, '37', '12', '95', '12', '25', '561', 'checkup', '2024-06-10', '10:44:22'),
(30, 33, '37', '100', '78', '25', '150', '369', 'grosesse', '2024-06-13', '16:11:45'),
(31, 34, '37', '25', '78', '41', '20', '320', 'chechupp', '2024-07-03', '12:13:05'),
(32, 35, '37', '120/80', '95', '90', '98', '20', 'check-up', '2024-07-12', '12:34:17'),
(33, 51, 'Enim minim', 'Sunt laudantium', 'Atque aliq', 'Non cum exercit', 'Et labore labore sin', 'Architecto ipsum pos', 'Cumque omnis non pos', '2024-07-22', '20:47:29');

-- --------------------------------------------------------

--
-- Structure de la table `patient`
--

CREATE TABLE `patient` (
  `p_id` int(11) NOT NULL,
  `nom` varchar(30) NOT NULL,
  `prenom` varchar(30) NOT NULL,
  `sex` varchar(10) NOT NULL,
  `quartier` varchar(30) NOT NULL,
  `profession` varchar(30) NOT NULL,
  `tel` varchar(20) NOT NULL,
  `SM` varchar(30) NOT NULL,
  `religion` varchar(30) NOT NULL,
  `DOB` varchar(20) NOT NULL,
  `POB` varchar(100) NOT NULL,
  `age` varchar(10) NOT NULL,
  `assurance` varchar(100) NOT NULL,
  `code` varchar(8) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `heure` time NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `patient`
--

INSERT INTO `patient` (`p_id`, `nom`, `prenom`, `sex`, `quartier`, `profession`, `tel`, `SM`, `religion`, `DOB`, `POB`, `age`, `assurance`, `code`, `date`, `heure`) VALUES
(24, 'Ben', 'Angelica Walker', 'F', 'newyork', 'cycliste', '+1 (428) 542-7175', 'fiancee', 'aucun', '2000-02-06', 'chicago', '15', '', '', '2024-01-08', '11:24:20'),
(27, 'ben wando', 'jeffrey', 'M', 'bonamoussadi - bangue', 'Developpeur mobile', '620 73 01 37', 'Celibataire', ' chretien', '2002-05-29', 'DLA', '22', '', '', '2024-01-08', '11:27:38'),
(29, 'djodjocks', 'jules bertrand', 'M', 'akwa nord', 'Etudiant', '690189744', 'Celibataire', 'chretien', '2001-06-04', 'yaounde', '23', '', '', '2024-03-10', '11:03:04'),
(30, 'ben wando', 'jeffrey', 'M', 'bonamoussadi - bangue', 'Developpeur Web', '620 73 01 37', 'Celibataire', ' chretien', '2002-05-29', 'douala', '22', '', '', '2024-04-08', '09:31:02'),
(31, 'ben', 'jeffrey', 'M', 'deido', 'dev', '620320102', 'celibataire', 'chretien', '2024-06-12', 'douala', '15', '', '', '2024-05-10', '10:43:18'),
(33, 'becken', 'brunelle', 'F', 'dogbon', 'enseignante', '652120114', 'mariee', 'chretienne', '2001-02-05', 'bamenda', '23', '', '', '2024-05-13', '16:10:00'),
(34, 'tagne', 'steph', 'M', 'deido', 'boulanger', '650212440', 'celibatair', 'chretien', '2005-05-05', 'douala', '19', '', '', '2024-05-03', '12:06:26'),
(35, 'tatiana', 'tatiana', 'F', 'Minim qui aperiam au', 'Adipisicing quia per', '+1 (728) 725-8657', 'Error id odit velit', 'Vero voluptas cupida', '2023-05-01', 'Esse dolor laboriosa', '12', '', '', '2024-05-05', '15:41:02'),
(48, 'aareem Chavez', 'ouby Carter', 'Nam unde r', 'Consequuntur rerum n', 'Facilis minim reicie', '+1 (112) 259-5877', 'Porro ut beatae repr', 'Facilis illum sunt ', '1983-11-03', 'Eiusmod et ea magni ', 'Facere eos', 'okayassurance.com', 'A031183O', '2024-06-12', '12:47:02'),
(49, 'Tance Hinton', 'oashya Rowe', 'Do corrupt', 'Ea maiores veritatis', 'Aut similique volupt', '+1 (203) 817-3312', 'Reiciendis accusamus', 'Sed sed velit cupidi', '1994-06-07', 'Aute ut voluptas ame', 'Ut consequ', '', 'T0706O', '2024-07-11', '13:36:29'),
(50, 'Shafira Riddle', 'Sawyer Crosby', 'Suscipit s', 'Similique adipisci q', 'Eaque tempor qui ea ', '+1 (711) 759-1688', 'Officiis veniam est', 'Quod mollitia aliqua', '1971-11-24', 'Quo tempore sit ut ', 'Excepturi ', '', 'S2411S', '2024-07-12', '09:25:51');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `password`) VALUES
(1, 'acceuil@cae.com', 'acceuil2024!'),
(2, 'visite@cae.com', 'visite2024!');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`a_id`);

--
-- Index pour la table `consultations`
--
ALTER TABLE `consultations`
  ADD PRIMARY KEY (`cons_id`);

--
-- Index pour la table `cpn`
--
ALTER TABLE `cpn`
  ADD PRIMARY KEY (`cpn_id`);

--
-- Index pour la table `dispo`
--
ALTER TABLE `dispo`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `docteurs`
--
ALTER TABLE `docteurs`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `historique`
--
ALTER TABLE `historique`
  ADD PRIMARY KEY (`a_id`);

--
-- Index pour la table `parametre`
--
ALTER TABLE `parametre`
  ADD PRIMARY KEY (`par_id`);

--
-- Index pour la table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`p_id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `appointment`
--
ALTER TABLE `appointment`
  MODIFY `a_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT pour la table `consultations`
--
ALTER TABLE `consultations`
  MODIFY `cons_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT pour la table `cpn`
--
ALTER TABLE `cpn`
  MODIFY `cpn_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `dispo`
--
ALTER TABLE `dispo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `docteurs`
--
ALTER TABLE `docteurs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `historique`
--
ALTER TABLE `historique`
  MODIFY `a_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `parametre`
--
ALTER TABLE `parametre`
  MODIFY `par_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT pour la table `patient`
--
ALTER TABLE `patient`
  MODIFY `p_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
