-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Client :  127.0.0.1
-- Généré le :  Jeu 13 Juillet 2017 à 09:05
-- Version du serveur :  10.1.21-MariaDB
-- Version de PHP :  7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `laplanche`
--

-- --------------------------------------------------------

--
-- Structure de la table `chat`
--

CREATE TABLE `chat` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `username` varchar(250) NOT NULL,
  `message` text NOT NULL,
  `date_publi` date NOT NULL,
  `game_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Contenu de la table `chat`
--

INSERT INTO `chat` (`id`, `user_id`, `username`, `message`, `date_publi`, `game_id`) VALUES
(1, 22, 'Hibou', 'coucou', '2017-07-06', 1);

-- --------------------------------------------------------

--
-- Structure de la table `courts`
--

CREATE TABLE `courts` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `address` varchar(250) NOT NULL,
  `postal_code` int(11) NOT NULL,
  `city` varchar(250) NOT NULL,
  `picture` varchar(250) NOT NULL,
  `description` text NOT NULL,
  `net` varchar(3) NOT NULL,
  `court_state` varchar(250) NOT NULL,
  `opening_hours` text NOT NULL,
  `admin_validation` tinyint(1) NOT NULL,
  `parking` varchar(3) NOT NULL,
  `latitude` varchar(250) NOT NULL,
  `longitude` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `courts`
--

INSERT INTO `courts` (`id`, `name`, `address`, `postal_code`, `city`, `picture`, `description`, `net`, `court_state`, `opening_hours`, `admin_validation`, `parking`, `latitude`, `longitude`) VALUES
(1, 'City Stade Brun', '63 Rue Brun', 33000, 'Bordeaux', 'brun_1.jpg', '1 terrain multisports handball et basket-ball (Equipement de plein air)', 'yes', 'medium', '7 jours/7 de 8h00 à 22h00', 1, 'no', '44.8174403', '-0.5750807'),
(2, 'City stade Carle Vernet', 'Rue Oscar et Jean Auriac', 33800, 'Bordeaux', 'vernet_1.png', '1 terrain de Basket Ball\r\n1 panier d\'échauffement sur sol enrobé', 'no', 'good', '7 jours/7 de 8h00 à 22h00', 1, 'no', '44.8151865', '-0.555181\n'),
(3, 'City stade Chantecrit', 'Rue Cité Chantecrit', 33300, 'Bordeaux', 'chantecrit_1.png', '1 terrain Multisports en gazon synthétique', 'no', 'medium', '7 jours/7 de 8h00 à 22h00', 1, 'no', '44.8625966', '-0.5636386'),
(4, 'City Stade Grand Parc', 'Rue Pierre Trébod', 33000, 'Bordeaux', 'citystadegrandparc_1.png', '1 terrain multisports', 'no', 'bad', '7 jours/7 de 8h00 à 22h00', 1, 'no', '44.8587295', '-0.584764'),
(6, 'City stade le Lauzun', 'Rue des Genêts', 33000, 'Bordeaux', 'citystadelauzun_1.png', '1 aire multi-sports en gazon synthétique', 'no', 'medium', '7 jours/7 de 8h00 à 22h00', 1, 'yes', '44.8752777\n', '-0.5728787'),
(7, 'City stade le Tauzin', '50 Rue du Tauzin', 33000, 'Bordeaux', 'tauzin_1.jpg', '1 terrain multisports', 'yes', 'very_good', '7 jours/7 de 8h00 à 22h00', 1, 'no', '44.8752777', '-0.5728787'),
(8, 'City Stade Parc aux Angéliques', 'Quai des Queyries', 33100, 'Bordeaux', '', 'Aire multisports en synthétique 30m X 16m', 'no', 'good', '7 jours/7 de 8h00 à 22h00', 1, 'no', '44.8456951', '-0.5646427'),
(9, 'City stade Petit Cardinal', 'Rue du Petit Cardinal', 33100, 'Bordeaux', '', '1 terrain multisports en gazon synthétique', 'no', 'good', '7 jours/7 de 8h00 à 22h00', 1, 'no', '44.8467274', '-0.5438741'),
(10, 'City stade Port de la Lune', 'Rue du Cardinal Feltin', 33300, 'Bordeaux', '', '1 terrain Multisports en gazon synthétique\r\n1 mini terrain de Football en sol stabilisé', 'no', 'very_good', '7 jours/7 de 8h00 à 22h00', 1, 'no', '44.877927', '-0.5422788'),
(11, 'City stade Reignier', 'Rue Reignier', 33100, 'Bordeaux', '', '1 terrain multisports en synthétique', 'yes', 'good', '7 jours/7 de 8h00 à 22h00', 1, 'yes', '44.847043', '-0.5603757'),
(12, 'Parc des sports Saint-Michel', 'Quais des Salinières, de la Monnaie, Ste Croix', 33000, 'Bordeaux', '', 'Une aire de basket ball en revêtement béton bitumeux', 'yes', 'good', 'De 8h00 à 22h00', 1, 'yes', '44.8360418', '-0.5653346'),
(17, 'City stade Les aubiers', 'rue du Petit Miot', 33300, 'Bordeaux', '', '1 plateau de basket-ball - terrain et aire de street ball.', 'yes', 'medium', '7 jours/7 de 8h à 22h', 1, 'no', '44.873482', '-0.569243'),
(18, 'Gymnase du Grand Parc I', 'Rue Condorcet', 33000, 'Bordeaux', '', '3 terrains de jeux de basket-ball, handball, volley-ball', 'yes', 'good', '7j/7 de 8h00 à 22h00', 1, 'no', '44.8576031', '-0.5775191'),
(19, 'Gymnase Grand Parc II', 'Rue Jean Artus', 33300, 'Bordeaux', '', '1 salle de sports collectifs sol en linoliège avec aire de jeu de 40m par 22m : Handball, Basket Ball, Volley Ball', 'no', '', '7j/7 de 8h00 à 22h00', 1, 'no', '44.8620855', '-0.582796'),
(20, 'Gymnase Grand Parc III', 'Rue Pierre Trébod', 33300, 'Bordeaux', '', '2 terrains Basket ball en enrobé', 'yes', 'bad', '7j/7 de 8h00 à 22h00', 1, 'yes', '44.8587295', '-0.584764'),
(21, 'Stade Alfred Daney', '100 Boulevard Alfred Daney', 33300, 'Bordeaux', '', '6 terrains de jeux de basket ball, handball, volley ball', 'yes', 'very_good', 'Du lundi au vendredi de 8h00 à 18h00', 1, 'yes', '44.8683989', '-0.5701413\n'),
(24, 'City du stade', '20 rue du stade', 86240, 'fontaine-le-comte', '74ff4b403ef095075793e446819d1611.jpg', 'Terrain bitum\r\nCity stade (foot et basket)', 'yes', 'good', '7j/7', 1, 'yes', '46.5335542', '0.2663762'),
(25, 'City Croutelle', '8 rue du Télégraphe', 86240, 'Croutelle', 'afd521c8941f7c1a32ac9da922433135.jpg', 'City stade (foot et basket)', 'yes', '', '7j/7', 1, 'no', '46.5428598', '0.289873'),
(27, 'Plateau', '1 Rue Saint Vincent de Paul', 57155, 'Marly', '11a33c8f8d5199fa8f5e94a9ee7584d5.jpg', 'Deux city stades foot et basket. Skatepark à proximité.', 'yes', '', '07h00 - 22h00', 1, 'yes', '49.0601235', '6.1679853'),
(28, 'City Dulaurier', '8 rue Dulaurier', 31000, 'Toulouse', '344fb1ba97633392a98ed07ab8b9fcac.jpg', '1 city stade (foot et basket)', 'yes', 'good', '7j/7', 1, 'no', '43.6123824', '1.4408011'),
(29, 'City Mespoul', '3 rue Mespoul', 31000, 'Toulouse', 'cfc9880a10d019855f4d86b251cba13e.jpg', '2 terrains revêtement bitume', 'no', 'good', '7j/7', 0, 'yes', '43.5904333', '1.4428763');

-- --------------------------------------------------------

--
-- Structure de la table `games`
--

CREATE TABLE `games` (
  `id` int(11) NOT NULL,
  `court_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `starting_time` text NOT NULL,
  `finishing_time` text NOT NULL,
  `number_players` int(11) NOT NULL,
  `team_name` varchar(250) NOT NULL,
  `team_level` text NOT NULL,
  `message` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `accepted` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `games`
--

INSERT INTO `games` (`id`, `court_id`, `date`, `starting_time`, `finishing_time`, `number_players`, `team_name`, `team_level`, `message`, `user_id`, `accepted`) VALUES
(1, 1, '2017-07-20', '15h00', '16h00', 6, 'coucou hibou', '5', 'On est les meilleurs cherchez pas ! ', 2, 1),
(2, 1, '2017-07-29', '18h00', '19h00', 4, 'Chatons sauvages', '1', 'On débute ayez pitié! ', 3, 0);

-- --------------------------------------------------------

--
-- Structure de la table `message`
--

CREATE TABLE `message` (
  `id` int(11) NOT NULL,
  `message` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `message`
--

INSERT INTO `message` (`id`, `message`, `status`) VALUES
(1, '', ''),
(2, '04c5411c547ed04ea6679dc549bbe4cd.jpg', 'show');

-- --------------------------------------------------------

--
-- Structure de la table `tokens`
--

CREATE TABLE `tokens` (
  `id` int(11) NOT NULL,
  `token` varchar(250) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(250) NOT NULL,
  `level` varchar(250) NOT NULL,
  `firstname` varchar(250) NOT NULL,
  `lastname` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `address` varchar(250) NOT NULL,
  `postal_code` int(11) NOT NULL,
  `city` varchar(250) NOT NULL,
  `phone` int(11) NOT NULL,
  `password` varchar(250) NOT NULL,
  `role` varchar(250) NOT NULL,
  `blacklist` varchar(255) DEFAULT 'autorisé'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `username`, `level`, `firstname`, `lastname`, `email`, `address`, `postal_code`, `city`, `phone`, `password`, `role`, `blacklist`) VALUES
(29, 'fabrice3332', '1', 'Fabrice', 'Aymonino', 'faymonino@hotmail.com', 'Lilas', 33320, 'Eysines', 0, '$2y$10$uyj16qyVnBaW2gGDAQWZv.Gv.oTMGqZaIb9Eu9D7cp1ilHwbtOLbS', 'admin', 'autorisé'),
(30, 'lise', '5', 'Lise', 'Nusbaum', 'lise.n@hotmail.fr', 'Rue Michel Ange', 57155, 'Marly', 0, '$2y$10$L8CR6dDndRauS90Om4cle./QiGBDC02B8PzvXxx5koNC8ZjBicyzu', 'admin', 'autorisé'),
(31, 'etienne', '5', 'Etienne', 'Braud', 'anjevile@yandex.com', 'Rue Sainte Luce', 33000, 'Bordeaux', 0, '$2y$10$uHaxSn23F9NaXVWXIINJde4.vFbFiAqFamQXaP4o8lsoFYQbs4oYi', 'admin', 'autorisé'),
(32, 'Nico', '0', 'Nicolas', 'Logeais', 'logeaisnicolas@yahoo.fr', '105 Avenue Du Docteur Nancel Pénard', 33600, 'PESSAC', 0, '$2y$10$dc5xUEiQcKxT4pDcFRyZOela6U5bNLJL5EdNMgEAqyuBx8IECMXji', 'admin', 'autorisé'),
(33, 'riton86', '5', 'Henri', 'Sculfort', 'henri.sculfort@gmail.com', '2 Rue De Neptune', 86240, 'Fontaine-le-comte', 0, '$2y$10$iiVdfmJHkd.aOOOncuTus.23NJHUtwnHk01Rb5ab7x0dL3ktwGG.W', 'admin', 'autorisé'),
(36, 'henri', '5', 'Henri', 'Sculfort', 'henri.86240@hotmail.fr', '2 Rue De Neptune', 86240, 'Fontaine-le-comte', 0, '$2y$10$TsnH8EJY2TPcZbckUJBbku/qKnip9jqohFtFYbzwsuw2Aa3i1ElwO', 'user', 'autorisé');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `courts`
--
ALTER TABLE `courts`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `games`
--
ALTER TABLE `games`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `tokens`
--
ALTER TABLE `tokens`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `chat`
--
ALTER TABLE `chat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `courts`
--
ALTER TABLE `courts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT pour la table `games`
--
ALTER TABLE `games`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `tokens`
--
ALTER TABLE `tokens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
