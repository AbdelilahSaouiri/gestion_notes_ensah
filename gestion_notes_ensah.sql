-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 14 mai 2024 à 20:31
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `gestion_notes_ensah`
--

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

CREATE TABLE `admin` (
  `cin` varchar(10) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `prenom` varchar(100) NOT NULL,
  `role` int(11) NOT NULL,
  `email_isntitutionnel` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `admin`
--

INSERT INTO `admin` (`cin`, `nom`, `prenom`, `role`, `email_isntitutionnel`) VALUES
('X4646', 'admin', 'admin', 0, 'a.admin@etu.uae.ac.ma');

-- --------------------------------------------------------

--
-- Structure de la table `affectation_modules_prof`
--

CREATE TABLE `affectation_modules_prof` (
  `id_module` int(11) NOT NULL,
  `cin_prof` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `affectation_prof_filiere`
--

CREATE TABLE `affectation_prof_filiere` (
  `id_filiere` int(11) NOT NULL,
  `cin_prof` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `chef_departement`
--

CREATE TABLE `chef_departement` (
  `nom` varchar(100) NOT NULL,
  `prenom` varchar(100) NOT NULL,
  `email_institutionnel` varchar(255) DEFAULT NULL,
  `cin` varchar(10) NOT NULL,
  `role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `chef_departement`
--

INSERT INTO `chef_departement` (`nom`, `prenom`, `email_institutionnel`, `cin`, `role`) VALUES
('said', 'hajouji', 'said.hajoui@etu.uae.ac.ma', 'T456788', 4),
('addam', 'mohamed', 'm.addam@etu.uae.ac.ma', 'X123456', 4);

-- --------------------------------------------------------

--
-- Structure de la table `coordinateur`
--

CREATE TABLE `coordinateur` (
  `nom` varchar(100) NOT NULL,
  `prenom` varchar(100) NOT NULL,
  `email_institutionnel` varchar(255) DEFAULT NULL,
  `cin` varchar(10) NOT NULL,
  `filiere` varchar(100) NOT NULL,
  `departement` varchar(100) NOT NULL,
  `role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `coordinateur`
--

INSERT INTO `coordinateur` (`nom`, `prenom`, `email_institutionnel`, `cin`, `filiere`, `departement`, `role`) VALUES
('ahmed', 'moussaid', 'ahmed.moussaid@etu.uae.ac.ma', 'bbbb', 'AP1', 'Mathematique et Informatique', 3),
('boujraf', 'ahmed', 'a.boujraf@etu.uae.ac.ma', 'M12356', 'AP', 'Mathematique et Informatique', 3),
('dadi', 'e.wardani', 'w.dadi@etu.uae.ac.ma', 'N123456', 'GI1', 'Mathematique et Informatique', 3);

-- --------------------------------------------------------

--
-- Structure de la table `departement`
--

CREATE TABLE `departement` (
  `id` int(11) NOT NULL,
  `id_departement` int(11) NOT NULL,
  `nom_dep` varchar(100) NOT NULL,
  `cin_prof` varchar(10) NOT NULL,
  `cin_cord` varchar(10) NOT NULL,
  `cin_chef_dep` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `departement`
--

INSERT INTO `departement` (`id`, `id_departement`, `nom_dep`, `cin_prof`, `cin_cord`, `cin_chef_dep`) VALUES
(1, 1, 'Mathematique et Informatique', 'BBBBBBBBBB', 'M12356', 'X123456'),
(2, 1, 'Mathematique et Informatique', 'DDDDDDDD', 'bbbb', 'T456788'),
(3, 1, 'Mathematique et Informatique', '', '', 'B3033'),
(4, 1, 'Mathematique et Informatique', '', 'N123456', 'X123456'),
(6, 2, 'Génie Civil Energétique et Environnement (GCEE)', '', '', '');

-- --------------------------------------------------------

--
-- Structure de la table `emploidutemps`
--

CREATE TABLE `emploidutemps` (
  `id` int(11) NOT NULL,
  `8:30->10:30` varchar(100) NOT NULL,
  `10:30->12:30` varchar(100) NOT NULL,
  `14:30->16:30` varchar(100) NOT NULL,
  `16:30->18:30` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `etudiant`
--

CREATE TABLE `etudiant` (
  `nom` varchar(100) NOT NULL,
  `prenom` varchar(100) NOT NULL,
  `cin` varchar(10) NOT NULL,
  `cne` varchar(10) NOT NULL,
  `role` int(11) NOT NULL,
  `email_institutionnel` varchar(100) NOT NULL,
  `id_filiere` int(11) NOT NULL,
  `anne_universitaire` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `etudiant`
--

INSERT INTO `etudiant` (`nom`, `prenom`, `cin`, `cne`, `role`, `email_institutionnel`, `id_filiere`, `anne_universitaire`) VALUES
('chinwi', 'noureddine', 'T889955', 'A64747', 1, 'chinwi.noureddine@etu.uae.ac.ma', 3, '2023'),
('youssef', 'ahrdane', 'F409797', 'AX45985', 1, 'youssef.ahrdane@etu.uae.ac.ma', 3, '2024'),
('salma', 'fakhir', 'S47585', 'F8569', 1, 'salma.fakhir@etu.uae.ac.ma', 4, '2024'),
('said', 'nibt', 'O46575', 'G45845', 1, 'said.nibt@etu.uae.ac.ma', 4, '2024'),
('Souiri', 'Abdelilah', 'XA141153', 'j136223137', 1, 'abdeililah.saouir@etu.uae.ac.ma', 3, '2024'),
('mohamed', 'janati', 'N345678', 'J390967', 1, 'mohamed.janati@etu.uae.ac.ma', 3, '2024'),
('wahid', 'alami', 'F45464', 'K23546', 1, 'wahib.alami@etu.uae.ac.ma', 3, '2023'),
('halim', 'hafid', 'T8848846', 'L7474742', 1, 'halim.hafid@etu.uae.ac.ma', 4, '2024'),
('ismail', 'souhaib', 'M55896', 'T567889', 1, 'souhaib.isamil@etu.uae.ac.ma', 3, '2022'),
('abdelkrime', 'oubakhayi', 'R200004', 'T748484', 1, 'abdelkrime.oubakhayi@etu.uae.ac.ma', 3, '2024'),
('houda', 'lmoukhtari', 'X335666', 'V3495678', 1, 'houda.lmoukhtari@etu.uae.ac.ma', 4, '2023'),
('salima', 'ahrdane', 'U374747', 'VX9494994', 1, 'salima.ahrdane@etu.uae.ac.ma', 4, '2024'),
('soumiya', 'hanan', 'M4556', 'Z36474', 1, 'soumiya.hana@etu.uae.ac.ma', 3, '2024');

-- --------------------------------------------------------

--
-- Structure de la table `filiere`
--

CREATE TABLE `filiere` (
  `id` int(11) NOT NULL,
  `nom_filiere` varchar(100) NOT NULL,
  `cin_prof` varchar(10) NOT NULL,
  `cin_cord` varchar(10) NOT NULL,
  `cin_chef_dep` varchar(10) NOT NULL,
  `id_dep` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `filiere`
--

INSERT INTO `filiere` (`id`, `nom_filiere`, `cin_prof`, `cin_cord`, `cin_chef_dep`, `id_dep`) VALUES
(1, 'AP1', 'M123457', 'M12356', 'X123456', 1),
(2, 'AP2', 'M123457', 'M12356', 'X123456', 1),
(3, 'GI1', 'c23344', 'N123456', 'X123456', 1),
(4, 'GI2', '', 'N123456', 'X123456', 1),
(5, 'GI3', '', 'N123456', 'X123456', 1),
(6, 'ID1', '', 'bbbb', 'X123456', 1),
(7, 'ID2', '', 'bbbb', 'X123456', 1),
(8, 'ID3', '', 'bbbb', 'X123456', 1),
(9, 'TDIA1', '', 'bbbb', 'X123456', 1),
(10, 'TDIA2', '', 'bbbb', 'X123456', 1),
(11, 'TDIA3', '', 'bbbb', 'X123456', 1);

-- --------------------------------------------------------

--
-- Structure de la table `filiere_salle`
--

CREATE TABLE `filiere_salle` (
  `id` int(11) NOT NULL,
  `salle_cours` varchar(10) NOT NULL,
  `salle_td_tp` varchar(10) NOT NULL,
  `filiere_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `filiere_salle`
--

INSERT INTO `filiere_salle` (`id`, `salle_cours`, `salle_td_tp`, `filiere_id`) VALUES
(3, '9_A', '', 3),
(4, '9_A', '', 3),
(5, '9_A', '', 3);

-- --------------------------------------------------------

--
-- Structure de la table `module`
--

CREATE TABLE `module` (
  `id` int(11) NOT NULL,
  `nom_filiere` varchar(100) NOT NULL,
  `semestre` int(2) NOT NULL,
  `nom_modules` varchar(200) NOT NULL,
  `cin_prof_cour` varchar(10) DEFAULT NULL,
  `cin_prof_td_tp` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `module`
--

INSERT INTO `module` (`id`, `nom_filiere`, `semestre`, `nom_modules`, `cin_prof_cour`, `cin_prof_td_tp`) VALUES
(1, 'AP1', 1, 'Algèbre 1 : Algèbre de base', NULL, NULL),
(2, 'AP1', 1, 'Analyse 1 : Analyse réelle', NULL, NULL),
(3, 'AP1', 1, 'Physique 1 : Electrostatique et magnétostatique', NULL, NULL),
(4, 'AP1', 1, 'Mécanique 1 : Mécanique du point', NULL, NULL),
(5, 'AP1', 1, 'Informatique 1 : Initiation à l’informatique', NULL, NULL),
(6, 'AP1', 1, 'Commuication', NULL, NULL),
(7, 'AP1', 2, 'Algèbre 2 : Algèbre linéaire', NULL, NULL),
(8, 'AP1', 2, 'Analyse 2 : Equations différentielles et séries', NULL, NULL),
(9, 'AP1', 2, 'Physique 2 : Optique', NULL, NULL),
(10, 'AP1', 2, 'Chimie 1 : Atomistique & Liaisons chimiques', NULL, NULL),
(11, 'AP1', 2, 'Géologie : Géologie générale', NULL, NULL),
(12, 'AP1', 2, 'Commuication', NULL, NULL),
(13, 'AP2', 1, 'Algèbre 3 : Algèbre quadratique', NULL, NULL),
(14, 'AP2', 1, 'Analyse 3 : Fonctions de plusieurs variables', NULL, NULL),
(15, 'AP2', 1, 'Physique 3 : Electrocinétique et Electromagnétisme', NULL, NULL),
(16, 'AP2', 1, 'Mécanique 2 : Mécanique du solides', NULL, NULL),
(17, 'AP2', 1, 'Informatique 2 : Programmation C', NULL, NULL),
(18, 'AP2', 1, 'Langues et communications 3 : TEC Français & TEC Anglais', NULL, NULL),
(19, 'AP2', 1, 'Algèbre 3 : Algèbre quadratique', NULL, NULL),
(20, 'AP2', 1, 'Analyse 3 : Fonctions de plusieurs variables', NULL, NULL),
(21, 'AP2', 1, 'Physique 3 : Electrocinétique et Electromagnétisme', NULL, NULL),
(22, 'AP2', 1, 'Mécanique 2 : Mécanique du solides', NULL, NULL),
(23, 'AP2', 1, 'Informatique 2 : Programmation C', NULL, NULL),
(24, 'AP2', 1, 'Langues et communications 3 : TEC Français & TEC Anglais', NULL, NULL),
(25, 'AP2', 2, 'Mathématiques appliquées : Probabilités et statistiques descriptives & Analyse numérique', NULL, NULL),
(26, 'AP2', 2, 'Analyse 4 : Intégrales et formes différentielles', NULL, NULL),
(27, 'AP2', 2, 'Physique 4 : Thermodynamique et Statique des fluides', NULL, NULL),
(28, 'AP2', 2, 'Electronique : Electronique analogique', NULL, NULL),
(29, 'AP2', 2, 'Informatique 3 : Outils informatique', NULL, NULL),
(30, 'AP2', 2, 'Chimie 2 : Thermochimie & Cristallochimie', NULL, NULL),
(31, 'GI1', 1, 'Langage C ', 'A4567789', 'A4567789'),
(32, 'GI1', 1, 'Architecture des ordinateurs', 'D123456', 'D123456'),
(33, 'GI1', 1, 'RO', NULL, NULL),
(34, 'GI1', 1, 'SI', NULL, NULL),
(35, 'GI1', 1, 'Réseaux informatiques', 'T23456799', 'T23456799'),
(36, 'GI1', 1, 'Commuication', NULL, NULL),
(37, 'GI1', 2, 'Architecture Logicielle et UML', 'Z123456', 'Z123456'),
(38, 'GI1', 2, 'Web1 : Technologies de Web et PHP5', 'N123456', 'N123456'),
(39, 'GI1', 2, 'Programmation Orientée Objet C++', 'T123456', 'T123456'),
(40, 'GI1', 2, 'Théorie des langages et compilation', 'A2000', 'A2000'),
(41, 'GI1', 2, 'Algorithmique Avancée et complexité', 'N123456', 'N123456'),
(42, 'GI1', 2, 'Entreprenariat 1 & Atelier Start ups', 'X3444444', 'X3444444'),
(43, 'GI2', 3, 'Python et DS', 'N123456', 'N123456');

-- --------------------------------------------------------

--
-- Structure de la table `modules`
--

CREATE TABLE `modules` (
  `nom_module` varchar(100) NOT NULL,
  `id_module` int(11) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `notes`
--

CREATE TABLE `notes` (
  `id_note` int(11) NOT NULL,
  `note_ds` float NOT NULL,
  `note_exam` float NOT NULL,
  `note_tp_projet` float NOT NULL,
  `id_module` int(11) NOT NULL,
  `cin_etud` varchar(10) NOT NULL,
  `id_filiere` int(11) NOT NULL,
  `anne_universitaire` varchar(100) NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `notes`
--

INSERT INTO `notes` (`id_note`, `note_ds`, `note_exam`, `note_tp_projet`, `id_module`, `cin_etud`, `id_filiere`, `anne_universitaire`) VALUES
(1, 16, 15, 13, 38, 'N345678', 3, '2024'),
(3, 14, 15, 16, 38, 'R200004', 3, '2024'),
(6, 14, 15, 14, 43, 'S47585', 4, '2024'),
(7, 16, 14, 15, 43, 'O46575', 4, '2024'),
(8, 12, 10, 13, 38, 'F45464', 3, '2023'),
(9, 10, 9, 16, 38, 'T889955', 3, '2023'),
(10, 12, 12, 12, 41, 'F45464', 3, '2023'),
(11, 14, 15, 12, 41, 'XA141153', 3, '2024'),
(12, 12, 14, 12, 38, 'XA141153', 3, '2024'),
(13, 10, 5, 7, 38, 'M55896', 3, '2022');

-- --------------------------------------------------------

--
-- Structure de la table `professeur`
--

CREATE TABLE `professeur` (
  `cin` varchar(100) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `prenom` varchar(100) NOT NULL,
  `type_prof` varchar(10) NOT NULL,
  `role` int(11) NOT NULL,
  `email_isntitutionnel` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `professeur`
--

INSERT INTO `professeur` (`cin`, `nom`, `prenom`, `type_prof`, `role`, `email_isntitutionnel`) VALUES
('A12200', 'ahmed', 'moussaid', 'Titulaire', 2, 'ahmed.moussaid@etu.uae.ac.ma'),
('A2000', 'OULHADJ', 'Mohamed ', 'Vacataire', 2, 'm.oulhadj@etu.uae.ac.ma'),
('A2001', 'Ali', 'ALI Mohamed', 'Titulaire', 2, 'ahmed.moussaid@etu.uae.ac.ma'),
('A4567789', 'Abdelkhalek', 'bahri', 'Titulaire', 2, 'a.bahri@etu.uae.ac.ma'),
('D123456', 'Badi', 'Imad', 'Titulaire', 2, 'badi.imad@etu.uae.ac.ma'),
('D2024', 'Ahmed', 'moussaid', 'Titulaire', 2, 'ahmed.moussaid@etu.uae.ac.ma'),
('F45896', 'Fatima', 'BELLALI\r\n', 'Titulaire', 2, 'fatima.bellai@etu.uae.ac.ma'),
('M123457', 'nabil', 'kannouf', 'Titulaire', 2, 'n.kannouf@gmail.com'),
('N123456', 'dadi', 'e.wardani', 'Titulaire', 2, 'e.w.dadi@etu.uae.ac.ma'),
('T123456', 'Anouar', 'RAGRAGUI', 'Titulaire', 2, 'a.regragui@etu.uae.ac.ma'),
('T23456799', 'Amina', 'bengag', 'Titulaire', 2, 'A.bengag@etu.uae.ac.ma'),
('tttttt', 'Saouir', 'Abdelilah', 'Titulaire', 2, 'abdelilah.saouir@etu.uae.ac.ma'),
('V200011', 'abdessemad', 'ahmadi', 'Titulaire', 2, 'a.ahmadi@etu.uae.ac.ma'),
('X123456', 'Addam', 'Mohamed', 'Titulaire', 2, ' m.addam@etu.uae.ac.ma'),
('X3444444', 'Adnane ', 'AMGHAR', 'Titulaire', 2, 'adnan.amghar@etu.uae.ac.ma'),
('xa151666', 'Saouiri', 'Abdelilah', 'Titulaire', 2, 'abdosaouiri757@gmail.com'),
('Z123456', 'Fatima', 'RAFII ZAKANI', 'Titulaire', 2, 'f.raffi@etu.uae.ac.ma');

-- --------------------------------------------------------

--
-- Structure de la table `prof_departement`
--

CREATE TABLE `prof_departement` (
  `id` int(11) NOT NULL,
  `cin_prof` varchar(100) NOT NULL,
  `id_departement` int(11) DEFAULT NULL,
  `id_filieres` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `prof_departement`
--

INSERT INTO `prof_departement` (`id`, `cin_prof`, `id_departement`, `id_filieres`) VALUES
(1, 'M123457', 1, 0),
(2, 'D2024', 1, 0),
(3, 'tttttt', 2, 0),
(4, 'xa151666', 3, 0),
(5, 'X123456', 1, 0),
(6, 'D123456', 1, 0),
(7, 'A4567789', 1, 0),
(8, 'T23456799', 1, 0),
(9, 'A2001', 1, 0),
(10, 'A2001', 1, 1),
(11, 'A2001', 1, 2),
(12, 'A12200', 1, 0),
(13, 'A12200', 1, 1),
(14, 'A12200', 1, 2),
(15, 'Z123456', 1, 3),
(16, 'X3444444', 1, 3),
(17, 'T123456', 1, 3),
(18, 'F45896', 1, 3),
(21, 'A2000', 1, 3),
(22, 'A4567789', 1, 3),
(23, 'T23456799', 1, 3),
(24, 'M123457', 1, 3),
(29, 'N123456', 1, 3),
(30, 'D123456', 1, 3),
(33, 'N123456', 1, 4),
(34, 'V200011', 2, 0),
(35, 'V200011', 2, 0);

-- --------------------------------------------------------

--
-- Structure de la table `prof_salle`
--

CREATE TABLE `prof_salle` (
  `id` int(11) NOT NULL,
  `cin_prof` varchar(10) NOT NULL,
  `num_salle_cour` varchar(100) NOT NULL,
  `num_salle_td_tp` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `prof_salle`
--

INSERT INTO `prof_salle` (`id`, `cin_prof`, `num_salle_cour`, `num_salle_td_tp`) VALUES
(5, 'N123456', '2_B', '2_A');

-- --------------------------------------------------------

--
-- Structure de la table `suivre`
--

CREATE TABLE `suivre` (
  `cne` varchar(10) NOT NULL,
  `id_module` int(11) NOT NULL,
  `id_note` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `test`
--

CREATE TABLE `test` (
  `id` int(1) NOT NULL,
  `nom_module` varchar(100) NOT NULL,
  `prof_cour` varchar(100) NOT NULL,
  `prof_td_tp` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `nom` varchar(100) NOT NULL,
  `prenom` varchar(100) NOT NULL,
  `age` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `email_institutionnel` varchar(200) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role` int(11) NOT NULL,
  `cin` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`email_institutionnel`, `password`, `role`, `cin`) VALUES
('said.hachimi@etu.uae.ac.ma', '12345678', 2, 'xa151666'),
('a.boujraf@etu.uae.ac.ma', '20242024', 3, 'M12356'),
('w.dadi@etu.uae.ac.ma', 'dadidadi22', 4, 'N123456'),
('abdelilah.saouir@etu.uae.ac.ma', '20242024', 1, 'xa141153'),
('m.addam@etu.uae.ac.ma', 'addam1234', 2, 'X123456'),
('mohamed.sabbar@etu.uae.ac.ma', 'sabbar1234', 1, 'x123456'),
('w.dadi@etu.uae.ac.ma', 'dadi2002', 2, 'N123456'),
('w.dadi@etu.uae.ac.ma', 'dadi2001', 3, 'N123456'),
('m.addam@etu.uae.ac.ma', 'addam23456', 4, 'X123456'),
('a.admin@etu.uae.ac.ma', 'admin1234', 0, 'X4646'),
('ahmed.moussaid@etu.uae.ac.ma', 'safi1234', 3, 'bbbb'),
('w.dadi@etu.uae.ac.ma', 'dadigi2024', 2, 'N123456'),
('a.ahmadi@etu.uae.ac.ma', 'ahmadi2000', 2, 'V200011'),
('a.bahri@etu.uae.ac.ma', 'bahri1234', 2, 'A4567789'),
('a.regragui@etu.uae.ac.ma', 'anouar2024', 2, 'T123456');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`cin`);

--
-- Index pour la table `affectation_modules_prof`
--
ALTER TABLE `affectation_modules_prof`
  ADD PRIMARY KEY (`id_module`,`cin_prof`),
  ADD KEY `cin_prof` (`cin_prof`);

--
-- Index pour la table `affectation_prof_filiere`
--
ALTER TABLE `affectation_prof_filiere`
  ADD PRIMARY KEY (`id_filiere`,`cin_prof`),
  ADD KEY `cin_prof` (`cin_prof`);

--
-- Index pour la table `chef_departement`
--
ALTER TABLE `chef_departement`
  ADD PRIMARY KEY (`cin`);

--
-- Index pour la table `coordinateur`
--
ALTER TABLE `coordinateur`
  ADD UNIQUE KEY `uniq_cin` (`cin`);

--
-- Index pour la table `departement`
--
ALTER TABLE `departement`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cin_prof` (`cin_prof`),
  ADD KEY `cin_cord` (`cin_cord`),
  ADD KEY `cin_chef_dep` (`cin_chef_dep`);

--
-- Index pour la table `emploidutemps`
--
ALTER TABLE `emploidutemps`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `etudiant`
--
ALTER TABLE `etudiant`
  ADD PRIMARY KEY (`cne`),
  ADD KEY `id_fil` (`id_filiere`);

--
-- Index pour la table `filiere`
--
ALTER TABLE `filiere`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cin_cord` (`cin_cord`),
  ADD KEY `cin_chef_dep` (`cin_chef_dep`),
  ADD KEY `cin_prof_fil` (`cin_prof`);

--
-- Index pour la table `filiere_salle`
--
ALTER TABLE `filiere_salle`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `module`
--
ALTER TABLE `module`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_cin_prof_fi` (`cin_prof_td_tp`),
  ADD KEY `fk_cin_prof_cr` (`cin_prof_cour`);

--
-- Index pour la table `modules`
--
ALTER TABLE `modules`
  ADD PRIMARY KEY (`id_module`);

--
-- Index pour la table `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`id_note`),
  ADD KEY `id_filiere` (`id_filiere`),
  ADD KEY `fik_id_module` (`id_module`);

--
-- Index pour la table `professeur`
--
ALTER TABLE `professeur`
  ADD PRIMARY KEY (`cin`);

--
-- Index pour la table `prof_departement`
--
ALTER TABLE `prof_departement`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cin_prof` (`cin_prof`);

--
-- Index pour la table `prof_salle`
--
ALTER TABLE `prof_salle`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `suivre`
--
ALTER TABLE `suivre`
  ADD KEY `cne` (`cne`),
  ADD KEY `id_module` (`id_module`),
  ADD KEY `id_note` (`id_note`);

--
-- Index pour la table `test`
--
ALTER TABLE `test`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `departement`
--
ALTER TABLE `departement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `emploidutemps`
--
ALTER TABLE `emploidutemps`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `filiere`
--
ALTER TABLE `filiere`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `filiere_salle`
--
ALTER TABLE `filiere_salle`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `module`
--
ALTER TABLE `module`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT pour la table `notes`
--
ALTER TABLE `notes`
  MODIFY `id_note` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT pour la table `prof_departement`
--
ALTER TABLE `prof_departement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT pour la table `prof_salle`
--
ALTER TABLE `prof_salle`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `test`
--
ALTER TABLE `test`
  MODIFY `id` int(1) NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `affectation_prof_filiere`
--
ALTER TABLE `affectation_prof_filiere`
  ADD CONSTRAINT `affectation_prof_filiere_ibfk_1` FOREIGN KEY (`id_filiere`) REFERENCES `filiere` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `affectation_prof_filiere_ibfk_2` FOREIGN KEY (`cin_prof`) REFERENCES `professeur` (`cin`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `etudiant`
--
ALTER TABLE `etudiant`
  ADD CONSTRAINT `id_fil` FOREIGN KEY (`id_filiere`) REFERENCES `filiere` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `filiere`
--
ALTER TABLE `filiere`
  ADD CONSTRAINT `filiere_ibfk_1` FOREIGN KEY (`cin_cord`) REFERENCES `coordinateur` (`cin`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `filiere_ibfk_2` FOREIGN KEY (`cin_chef_dep`) REFERENCES `chef_departement` (`cin`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `module`
--
ALTER TABLE `module`
  ADD CONSTRAINT `fk_cin_prof_cr` FOREIGN KEY (`cin_prof_cour`) REFERENCES `professeur` (`cin`),
  ADD CONSTRAINT `fk_cin_prof_fi` FOREIGN KEY (`cin_prof_td_tp`) REFERENCES `professeur` (`cin`);

--
-- Contraintes pour la table `notes`
--
ALTER TABLE `notes`
  ADD CONSTRAINT `fik_id_module` FOREIGN KEY (`id_module`) REFERENCES `module` (`id`),
  ADD CONSTRAINT `fk_id_filiere` FOREIGN KEY (`id_filiere`) REFERENCES `filiere` (`id`);

--
-- Contraintes pour la table `prof_departement`
--
ALTER TABLE `prof_departement`
  ADD CONSTRAINT `prof_departement_ibfk_1` FOREIGN KEY (`cin_prof`) REFERENCES `professeur` (`cin`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `suivre`
--
ALTER TABLE `suivre`
  ADD CONSTRAINT `suivre_ibfk_1` FOREIGN KEY (`cne`) REFERENCES `etudiant` (`cne`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `suivre_ibfk_2` FOREIGN KEY (`id_module`) REFERENCES `modules` (`id_module`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `suivre_ibfk_3` FOREIGN KEY (`id_note`) REFERENCES `notes` (`id_note`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
