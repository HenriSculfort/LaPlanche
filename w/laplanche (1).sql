-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Client :  127.0.0.1
-- Généré le :  Ven 07 Juillet 2017 à 15:22
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `net` tinyint(1) NOT NULL,
  `court_state` varchar(250) NOT NULL,
  `opening_hours` text NOT NULL,
  `admin_validation` tinyint(1) NOT NULL,
  `parking` tinyint(1) NOT NULL,
  `latitude` varchar(250) NOT NULL,
  `longitude` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `courts`
--

INSERT INTO `courts` (`id`, `name`, `address`, `postal_code`, `city`, `picture`, `description`, `net`, `court_state`, `opening_hours`, `admin_validation`, `parking`, `latitude`, `longitude`) VALUES
(1, 'City Stade Brun', '63 Rue Brun ', 33000, 'Bordeaux', 'brun_1.jpg', '1 terrain multisports handball et basket-ball (Equipement de plein air)', 0, '', '7 jours/7 de 8h00 à 22h00', 1, 0, '44.8174403', '-0.5750807'),
(2, 'City stade Carle Vernet', 'Rue Oscar et Jean Auriac', 33800, 'Bordeaux', 'vernet_1.png', '1 terrain multisports stabilisé\r\n1 terrain de Basket Ball\r\n1 panier d\'échauffement sur sol enrobé\r\n', 0, '', '7 jours/7 de 8h00 à 22h00\r\n', 1, 0, '44.8151865', '-0.555181\n'),
(3, 'City stade Chantecrit', 'Rue Cité Chantecrit', 33300, 'Bordeaux', 'chantecrit_1.png', '1 terrain Multisports en gazon synthétique', 0, '', '7 jours/7 de 8h00 à 22h00', 1, 0, '44.8625966', '-0.5636386'),
(4, 'City Stade Grand Parc', 'Rue Pierre Trébod', 33000, 'Bordeaux', 'citystadegrandparc_1.png', '1 terrain multisports', 0, '', '7 jours/7 de 8h00 à 22h00', 1, 0, '44.8587295', '-0.584764'),
(5, 'City stade Labarde', '156 Avenue de Labarde', 33000, 'Bordeaux', 'citystadelabarde_1.png', '2 terrains de handball transformable en terrains de tennis', 0, '', '7 jours/7 de 8h00 à 22h00', 1, 0, '44.8820058', '-0.5511352'),
(6, 'City stade le Lauzun', 'Rue des Genêts', 33000, 'Bordeaux', 'citystadelauzun_1.png', '1 aire multi-sports en gazon synthétique', 0, '', '7 jours/7 de 8h00 à 22h00', 1, 0, '44.8752777\n', '-0.5728787'),
(7, 'City stade le Tauzin', '50 Rue du Tauzin', 33000, 'Bordeaux', 'tauzin_1.jpg', '1 terrain multisports\r\n2 courts de tennis ', 0, '', '7 jours/7 de 8h00 à 22h00', 1, 0, '44.8752777', '-0.5728787'),
(8, 'City Stade Parc aux Angéliques', 'Quai des Queyries', 33100, 'Bordeaux', '', 'Aire multisports en synthétique 30m X 16m', 0, '', '7 jours/7 de 8h00 à 22h00', 0, 0, '44.8456951', '-0.5646427'),
(9, 'City stade Petit Cardinal', 'Rue du Petit Cardinal', 33100, 'Bordeaux', '', '1 terrain multisports en gazon synthétique', 0, '', '7 jours/7 de 8h00 à 22h00', 0, 0, '44.8467274', '-0.5438741'),
(10, 'City stade Port de la Lune', 'Rue du Cardinal Feltin', 33300, 'Bordeaux', '', '1 terrain Multisports en gazon synthétique\r\n1 mini terrain de Football en sol stabilisé', 0, '', '7 jours/7 de 8h00 à 22h00', 0, 0, '44.877927', '-0.5422788'),
(11, 'City stade Reignier', 'Rue Reignier', 33100, 'Bordeaux', '', '1 terrain multisports en synthétique', 0, '', '7 jours/7 de 8h00 à 22h00', 0, 0, '44.847043', '-0.5603757'),
(12, 'Parc des sports Saint-Michel', 'Quais des Salinières, de la Monnaie, Ste Croix', 33000, 'Bordeaux', '', 'un fronton avec une surface de jeu de 10m par 16m et un terrain de 47m de long pour la pratique de type Pelote Basque entouré de protection grillagée\r\nune aire de rink hockey de 42m par 18m en béton lisse.\r\nune aire de basket ball de 18m par 11m en revêtement béton bitumeux\r\nun terrain de football urbain en gazon synthétique de 32m par 16m\r\nune aire en sable de beach volley de 40m par 18m transformable en 1 terrain central ou 3 mini terrains\r\nun espace sportif d’orientation', 0, '', 'Des agents municipaux sont présents sur le site en permanence\r\nDu 16 octobre au 31 mars : de 8h00 à 18h00\r\nDu 1er avril au 15 juin : de 8h00 à 20h00\r\nDu 16 juin au 15 septembre : de 8h30 à 21h00\r\nDu 16 septembre au 15 octobre : de 8h00 à 20h00\r\nLe site est éclairé chaque soir jusqu’à 22h.', 0, 0, '44.8360418', '-0.5653346'),
(13, 'Plaine des sports Colette Besson', '6 Cours Jules Ladoumegue', 33000, 'Bordeaux', '', '14 terrains de grand jeu : 11 terrains en herbe, 3 terrains en synthétique, 10 éclairés\r\n2 pistes athlétisme en cendrée : 1 piste elliptique 400m , 1 piste de vitesse 135m, 2 sautoirs en longueur, 3 aires de lancer de poids\r\n1 boulodrome\r\n12 courts de tennis en béton poreux\r\n1 fronton mur gauche\r\n10 terrains de jeux : Basket ball, Volley ball, Handball\r\n1 espace sportif d’orientation', 0, '', 'Du 1er janvier au 30 juin et du 1er septembre au 31 décembre\r\nDu lundi au vendredi de 8h00 à 22h30\r\nSamedi de 8h00 à 21h00\r\nDimanche de 8h00 à 18h00\r\nDu 1er juillet au 31 août\r\nDu lundi au samedi de 8h00 à 21h00\r\nDimanche de 8h00 à 18h00', 0, 0, '44.8992418', '-0.5657423'),
(14, 'Espace sportif Chauffour', '15 Rue Chauffour', 33000, 'Bordeaux', '', '1 piste d’ Athlétisme 250m (4 couloirs) en matériau synthétique éclairée avec ligne droite de vitesse de 107m (7 couloirs)\r\n2 aires de saut en longueur\r\n1 aire de saut en hauteur\r\n1 aire de lancer de poids\r\n1 sautoir à la perche\r\n4 terrains de petit jeu en enrobé éclairés dont 2 terrains permettant de jouer au Tennis et Handball et 2 terrains au Tennis / Basket Ball et Volley Ball.\r\n1 espace sportif d’orientation', 0, '', 'Du 1er janvier au 30 juin et du 1er septembre au 31 décembre\r\nDu lundi au vendredi de 8h00 à 22h30\r\nSamedi de 8h00 à 21h00\r\nDimanche de 8h00 à 18h00\r\nDu 1er juillet au 31 août\r\nDu lundi au samedi de 8h00 à 21h00\r\nDimanche de 8h00 à 18h00', 0, 0, '44.8399683', '-0.5902352'),
(15, 'Espace sportif du Parc Lescure', 'Place Johnston', 33000, 'Bordeaux', '', '1 piste d\'athlétisme elliptique 400m avec ligne droite de vitesse éclairée\r\n1 sautoir en longueur\r\n1 sautoir en hauteur\r\n1 aire de lancer du poids\r\n3 courts de tennis éclairés\r\n5 terrains de basket ball, handball, volley ball\r\n2 frontons convertibles en 2 terrains de handball\r\n1 espace sportif d\'orientation\r\nAccès libre et gratuit (Hors entrainements des clubs sportifs et des scolaires) :\r\nCourse à pied, basket ball, handball, pelote', 0, '', 'Du 1er janvier au 30 juin et du 1er septembre au 31 décembre\r\nDu lundi au vendredi de 8h00 à 22h30\r\nSamedi de 8h00 à 21h00\r\nDimanche de 8h00 à 18h00\r\nDu 1er juillet au 31 août\r\nDu lundi au samedi de 8h00 à 21h00\r\nDimanche de 8h00 à 18h00', 0, 0, '44.8290487', '-0.6002495'),
(16, 'Espace sportif Stéhélin', 'Avenue Maréchal de Lattre de Tassigny', 33200, 'Bordeaux', '', '1 piste athlétisme de 400 m avec ligne droite de vitesse de 147m, 8 couloirs, en matériau synthétique, éclairée\r\n2 aires de saut en longueur\r\n2 aires de saut en hauteur\r\n2 aire de saut à la perche\r\n2 aires de lancer du poids\r\n2 aires de lancer du disque\r\n1 aire de lancer du marteau et du javelot\r\n1 terrain en herbe de football de 100m par 66m éclairé.\r\n1 terrain en herbe de football / Rugby de 100m par 66m éclairé.\r\n1 terrain de football sol synthétique 80m par 40m.\r\n3 courts de tennis, en béton poreux, dont 2 éclairés\r\n4 terrains de jeux de basket-ball, handball, volley-ball\r\n1 skate parc de 600 m2. Mise en service été 2014.\r\n1 Club house tennis\r\n1 espace sportif d\'orientation\r\nUn gradin de 600 places pour l\'athlétisme et jeux de balle.\r\nAccès libre et gratuit (Hors entraînements des clubs sportifs et des scolaires) :\r\nCourse à pied, Basket Ball, Hand Ball, espace sportif d\'orientation.', 0, '', 'Du 1er janvier au 30 juin et du 1er septembre au 31 décembre\r\nDu lundi au vendredi de 8h00 à 22h30\r\nSamedi de 8h00 à 21h00\r\nDimanche de 8h00 à 18h00\r\nDu 1er juillet au 31 août\r\nDu lundi au samedi de 8h00 à 21h00\r\nDimanche de 8h00 à 18h00', 0, 0, '44.8586219', '-0.6260672'),
(17, 'City stade Les aubiers / Espace sportif du Petit Miot', 'rue du Petit Miot', 33300, 'Bordeaux', '', '1 terrain de football en gazon synthétique à 7, utilisable à 5 et en futsal\r\nDimensions: 60mx45m\r\n1 plateau de basket-ball - terrain et aire de street ball.\r\nDimensions: 41mx18m\r\nPanier d’échauffement de basket-ball', 0, '', '7 jours/7 de 8h à 22h', 0, 0, '44.873482', '-0.569243'),
(18, 'Gymnase du Grand Parc I', 'Rue Condorcet', 33000, 'Bordeaux', '', 'Equipements de plein air\r\nAccès libre et gratuit (Hors entrainements des clubs sportifs et des scolaires) :\r\n3 terrains de jeux de basket-ball, handball, volley-ball\r\n1 piste d\'athlétisme\r\nEquipement Couvert\r\n1 salle de sports collectifs sol en bois avec aire de jeu de 40m par 20m : Handball, Basket Ball, Badminton', 0, '', '7j/7 de 8h00 à 22h00', 0, 0, '44.8576031', '-0.5775191'),
(19, 'Gymnase Grand Parc II', 'Rue Jean Artus', 33300, 'Bordeaux', '', '1 salle de sports collectifs sol en linoliège avec aire de jeu de 40m par 22m : Handball, Basket Ball, Volley Ball', 0, '', '7j/7 de 8h00 à 22h00', 0, 0, '44.8620855', '-0.582796'),
(20, 'Gymnase Grand Parc III', 'Rue Pierre Trébod', 33300, 'Bordeaux', '', 'Equipement Couvert\r\n1 salle de sports collectifs avec aire de jeu de 40m par 20m : Handball, Basket ball, Volley ball\r\nEquipements de plein air\r\n2 terrains Basket ball en enrobé\r\n2 terrains Handball en enrobé\r\n1 piste d’Athlétisme de 250m, 4 couloirs, avec ligne droite de vitesse de 10m, 6 couloirs\r\n1 sautoir en Longueur\r\n1 sautoir en Hauteur\r\n1 aire de Lancer du poids\r\n1 espace sportif d’orientatio', 0, '', '7j/7 de 8h00 à 22h00', 0, 0, '44.8587295', '-0.584764'),
(21, 'Stade Alfred Daney', '100 Boulevard Alfred Daney', 33300, 'Bordeaux', '', 'Equipements de plein air\r\n1 terrain en herbe football / rugby de 100m par 66m\r\n6 terrains de jeux de basket ball, handball, volley ball\r\n1 piste d\'athlétisme elliptique 400 m avec ligne droite de vitesse de 130 m\r\n2 sautoirs en Longueur\r\n1 aire de lancer du marteau, du disque et du javelot\r\n1 Boulodrome\r\n1 espace sportif d\'orientation', 0, '', 'Du lundi au vendredi de 8h00 à 18h00', 0, 0, '44.8683989', '-0.5701413\n'),
(22, 'Stade Charles Martin', 'Rue Charles Martin', 33300, 'Bordeaux', '', 'Equipements de plein air\r\nTerrain Ferdinand Moreau avec gradin de 200 places : terrain de football et de football américain sur gazon synthétique éclairé\r\n4 terrains de petit jeu en enrobé :\r\n2 terrains de Handball\r\n1 terrain de Volley Ball\r\n1 terrain de Basket Ball\r\n2 courts de Tennis en enrobé,\r\n1 piste d\'athlétisme en cendrée de 250 m avec ligne de vitesse de 115 m, 4 couloirs\r\n1 espace sportif d\'orientation\r\n\r\nAccès libre : Course à pied, Basket Ball, Hand Ball\r\nAutres équipements\r\n1 salle de gymnastique / arts martiaux', 0, '', 'Du 1er janvier au 30 juin et du 1er septembre au 31 décembre\r\nDu lundi au vendredi de 8h00 à 22h30\r\nSamedi de 8h00 à 21h00\r\nDimanche de 8h00 à 18h00\r\nDu 1er juillet au 31 août\r\nDu lundi au samedi de 8h00 à 21h00\r\nDimanche de 8h00 à 18h00', 0, 0, '44.8738249', '-0.5502957'),
(23, 'Stade Promis', '35 Rue de Cenac', 33100, 'Bordeaux', '', 'Equipements de plein air\r\n1 terrain de Football en herbe / Rugby 119m par 68m, éclairé\r\n1 terrain de Football synthétique 56m par 37m, éclairé\r\n1 piste de vitesse, en cendrée de 100m , 4 couloirs\r\n2 courts de Tennis en béton poreux, éclairés\r\n1 terrain de Basket Ball en enrobé\r\n1 terrain de Volley ball et mini tennis en enrobé,\r\n1 terrain de Handball en enrobé\r\n1 espace sportif d\'orientation\r\nAccès libre et gratuit (Hors entrainements des clubs sportifs et des scolaires) :\r\nCourse à pied, Basket Ball, Hand Ball, espace sportif d\'orientation\r\nEquipement couvert\r\n1 salle de sports collectifs de 40m par 20m, sol en bois, 200 places assises en gradins', 0, '', 'Du 1er janvier au 30 juin et du 1er septembre au 31 décembre\r\nDu lundi au vendredi de 8h00 à 22h30\r\nSamedi de 8h00 à 21h00\r\nDimanche de 8h00 à 18h00\r\nDu 1er juillet au 31 août\r\nDu lundi au samedi de 8h00 à 21h00\r\nDimanche de 8h00 à 18h00', 0, 0, '44.8395444', '-0.5534048');

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
-- Structure de la table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `sending_user_id` int(11) NOT NULL,
  `receiving_user_id` int(11) NOT NULL,
  `game_id` int(11) NOT NULL,
  `message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `role` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `username`, `level`, `firstname`, `lastname`, `email`, `address`, `postal_code`, `city`, `phone`, `password`, `role`) VALUES
(28, 'riton86240', '5', 'Henri', 'Sculfort', 'henri.sculfort@gmail.com', '2 Rue De Neptune', 86240, 'Fontaine le comte', 0, '$2y$10$JInB9ZYPDscQ6LwtycrrK.fm/Te.SwGjrmsD0aCl3hFoP7klwO4v6', 'user'),
(29, 'fabrice3332', '1', 'Fabrice', 'Aymonino', 'faymonino@hotmail.com', 'Lilas', 33320, 'Eysines', 0, '$2y$10$uyj16qyVnBaW2gGDAQWZv.Gv.oTMGqZaIb9Eu9D7cp1ilHwbtOLbS', 'user');

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
-- Index pour la table `messages`
--
ALTER TABLE `messages`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT pour la table `games`
--
ALTER TABLE `games`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT pour la table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `tokens`
--
ALTER TABLE `tokens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;
--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
