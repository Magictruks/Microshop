-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mar. 05 mai 2020 à 11:53
-- Version du serveur :  10.4.10-MariaDB
-- Version de PHP :  7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `microshop`
--

-- --------------------------------------------------------

--
-- Structure de la table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(11, 'Chat'),
(13, 'Top Vente'),
(14, 'Chien');

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

DROP TABLE IF EXISTS `commande`;
CREATE TABLE IF NOT EXISTS `commande` (
  `id` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `id_user` smallint(6) NOT NULL,
  `validate` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_user` (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `commande`
--

INSERT INTO `commande` (`id`, `created_at`, `id_user`, `validate`) VALUES
('5eaae11485bbc', '2020-04-30 16:30:44', 1, 1),
('5eaae19cca184', '2020-04-30 16:33:00', 1, 1),
('5eaaf9e450b48', '2020-04-30 18:16:36', 1, 1),
('5eac1b67417ce', '2020-05-01 14:51:51', 1, 1),
('5eafeae990440', '2020-05-04 12:14:01', 1, 1),
('5eb1523f2e959', '2020-05-05 13:47:11', 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `product`
--

DROP TABLE IF EXISTS `product`;
CREATE TABLE IF NOT EXISTS `product` (
  `id` varchar(255) NOT NULL,
  `label` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `imageUrl` varchar(255) NOT NULL,
  `prix` float NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `product`
--

INSERT INTO `product` (`id`, `label`, `description`, `imageUrl`, `prix`, `created_at`) VALUES
('5ea83cd8b9988', 'Chien Alsacien', 'Adore faire de bonnes saucisses Alsaciennes ! Ne lui dite pas qu\'il est Français', 'https://i.redd.it/3bc0bflke1a31.jpg', 30, '2020-04-28 16:25:28'),
('5ea8532bc567c', 'Chat Roux', '5ème roue du carrosse ', 'https://cdn.pixabay.com/photo/2015/12/03/10/43/cat-1074657_960_720.jpg', 100, '2020-04-28 18:00:43'),
('5ea93e9de87b6', 'Chat Poilu', 'Vendu avec un peigne', 'http://2.bp.blogspot.com/-o_DFLk2oLLM/UDkRZ4UaD3I/AAAAAAAABEo/tils0p1nS4Y/s1600/Sweeson%27s+Vanir_9.jpg', 200, '2020-04-29 10:45:17'),
('5ea93ec50b298', 'Chien Japonais', 'Adore le japon et la gendarmerie française', 'https://3.bp.blogspot.com/-yKougkNVVTg/Wna-gkz97aI/AAAAAAABdC0/nWMFVMiY_-Ev3ozwNaGAoErVsUcWGq5zACLcBGAs/s1600/3-306113-4041-full-13118833.jpg', 350, '2020-04-29 10:45:57'),
('5ea93ed9ee79d', 'Chien pas ouf', 'Pas ouf mais attendrissant', 'https://upload.wikimedia.org/wikipedia/commons/thumb/7/73/Box07.jpg/1200px-Box07.jpg', 60, '2020-04-29 10:46:17'),
('5ea93fa26e8c4', 'Chien Nazi', 'Un chien allemand, qui aime les moustaches. Susceptible d\'avoir des gaz', 'http://i.huffpost.com/gen/1482958/thumbs/o-HITLER-PUPPY-570.jpg?6', 55, '2020-04-29 10:49:38'),
('5ea93fdadc0d2', 'Chat Instagram', 'Vendu avec son profil Instagram perso (10 000 followers)', 'https://cdnfr2.img.sputniknews.com/images/102281/59/1022815949.jpg', 600, '2020-04-29 10:50:34'),
('5ea9415abcdd7', 'Chien victime', 'Parfait pour remplacer le ballon crevé de vos enfants', 'https://tse2.mm.bing.net/th?id=OIP.FANPDwCbU2swkN2BeCJZoAHaHY&pid=Api', 1, '2020-04-29 10:56:58'),
('5ea9417bbe3ff', 'Chien langue', 'Lave votre table et votre vaisselle', 'https://static.boredpanda.com/blog/wp-content/uploads/2017/06/85a7f5cee4c93cb3995d1b51e3a0289f-stupid-dogs-crazy-stupid-5949caddb4d8d__605.jpg', 100, '2020-04-29 10:57:31'),
('5ea94191c9315', 'Chien cwoissant', 'Le wendez-vu à la Fwançaise', 'https://thumbs.gfycat.com/FriendlyRemarkableCaterpillar-mobile.jpg', 30, '2020-04-29 10:57:53'),
('5ea941c29a81a', 'Chat roux 2', 'Encore plus mignon que le chat roux 1', 'https://2.bp.blogspot.com/-G_xeFidUos0/VufnILB8mwI/AAAAAAAABiA/kCo8LTKMiVg3XZ2rhsK5JSKNXtNuWcljA/s1600/magnifique%2Bchaton%2Broux%2Baux%2Byeux%2Bbleus.jpg', 200, '2020-04-29 10:58:42'),
('5ea941db79365', 'Isis', 'L\'incontournable, parce qu\'on ne peut pas la contourner', 'https://s-media-cache-ak0.pinimg.com/736x/0d/f0/8b/0df08b2675863c1cc1f6d7754789b2f3.jpg', 1000, '2020-04-29 10:59:07'),
('5ea941ec60923', 'Chat Alien', 'Trouvé au bord de la zone 51', 'https://twistedsifter.files.wordpress.com/2015/06/cat-with-huge-eyes-alien-cat-matilda-13.jpg?w=640&h=640', 5100, '2020-04-29 10:59:24'),
('5eaa9b94e93fd', 'Chien chaud', 'Hot Dog sans frites', 'https://i.pinimg.com/originals/95/cf/52/95cf52aa7733de95bd8ddc431ae0e9c5.jpg', 5, '2020-04-30 11:34:12'),
('5eaa9bbbe0df6', 'Garfield', 'Gros chat roux', 'http://i.dailymail.co.uk/i/pix/2013/03/09/article-2290612-1887B24C000005DC-515_634x286.jpg', 350, '2020-04-30 11:34:51'),
('5eaabed835e0a', 'Chien Tapis', 'Un arrière gout de mamie', 'https://i.ytimg.com/vi/aACnpK0_b8Y/maxresdefault.jpg', 25, '2020-04-30 14:04:40'),
('5eac16d3461e4', 'Chat Trisomique', 'Un chat un peu bizarre, mais gentil', 'https://zonepost.files.wordpress.com/2013/10/d4e07-1018.jpg', 21, '2020-05-01 14:32:19'),
('5eac16fcd1ee8', 'Chat de rue', 'Idéal pour récolter plein d\'argent dans la rue', 'http://www.pattesetmoustaches.com/wp-content/uploads/2016/06/photo-petit-chaton-mignon.jpg', 30, '2020-05-01 14:33:00');

-- --------------------------------------------------------

--
-- Structure de la table `product_category`
--

DROP TABLE IF EXISTS `product_category`;
CREATE TABLE IF NOT EXISTS `product_category` (
  `id_category` int(11) NOT NULL,
  `id_product` varchar(255) NOT NULL,
  KEY `id_category` (`id_category`),
  KEY `id_product` (`id_product`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `product_category`
--

INSERT INTO `product_category` (`id_category`, `id_product`) VALUES
(13, '5ea83cd8b9988'),
(14, '5ea83cd8b9988'),
(11, '5ea8532bc567c'),
(13, '5ea8532bc567c'),
(11, '5ea93e9de87b6'),
(13, '5ea93e9de87b6'),
(13, '5ea93ec50b298'),
(14, '5ea93ec50b298'),
(13, '5ea93ed9ee79d'),
(14, '5ea93ed9ee79d'),
(13, '5ea93fa26e8c4'),
(14, '5ea93fa26e8c4'),
(11, '5ea93fdadc0d2'),
(13, '5ea93fdadc0d2'),
(14, '5ea9415abcdd7'),
(14, '5ea9417bbe3ff'),
(14, '5ea94191c9315'),
(11, '5ea941c29a81a'),
(11, '5ea941db79365'),
(11, '5ea941ec60923'),
(14, '5eaa9b94e93fd'),
(11, '5eaa9bbbe0df6'),
(14, '5eaabed835e0a'),
(11, '5eac16d3461e4'),
(13, '5eac16d3461e4'),
(11, '5eac16fcd1ee8'),
(13, '5eac16fcd1ee8');

-- --------------------------------------------------------

--
-- Structure de la table `product_commande`
--

DROP TABLE IF EXISTS `product_commande`;
CREATE TABLE IF NOT EXISTS `product_commande` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_product` varchar(255) NOT NULL,
  `id_commande` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_product` (`id_product`),
  KEY `id_commande` (`id_commande`),
  KEY `quantity` (`quantity`)
) ENGINE=InnoDB AUTO_INCREMENT=155 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `product_commande`
--

INSERT INTO `product_commande` (`id`, `id_product`, `id_commande`, `quantity`) VALUES
(146, '5ea93e9de87b6', '5eaae11485bbc', 1),
(147, '5ea93e9de87b6', '5eaae19cca184', 1),
(148, '5ea941db79365', '5eaaf9e450b48', 2),
(149, '5ea93fa26e8c4', '5eac1b67417ce', 1),
(150, '5ea93ed9ee79d', '5eac1b67417ce', 1),
(151, '5ea93fdadc0d2', '5eafeae990440', 1),
(152, '5ea8532bc567c', '5eafeae990440', 6),
(153, '5ea83cd8b9988', '5eafeae990440', 4),
(154, '5ea93fa26e8c4', '5eb1523f2e959', 1);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` smallint(6) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `userpwd` varchar(255) NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `roleUser` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `userpwd`, `firstName`, `lastName`, `roleUser`) VALUES
(1, 'Cakalorange', 'turchini.axel@gmail.com', '$2y$10$B8c65UkHb.LcieJixpOvveo3Pl5J9sUBd3TXrT4.IGpI5Z2DCia9G', 'Axel', 'Turchini', 'admin'),
(4, 'axelturchini', 'test@gmail.com', '$2y$10$N9AWxvONaF1oww1ylRj3leBcp3SX0rktEL4Vr3UHyiPmAuE9aDepm', 'Axel', 'Turchini', 'user'),
(6, 'Lisa', 'lisa-la-bg-du-57@gmail.com', '$2y$10$QE.fqSv9Id2Z5kQ5jgUwxOZfK5Nw55ZYJ8KtFDUi/uh/3SYzG7dbe', 'Lisa', 'Chat', 'user');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `commande`
--
ALTER TABLE `commande`
  ADD CONSTRAINT `commande_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Contraintes pour la table `product_category`
--
ALTER TABLE `product_category`
  ADD CONSTRAINT `product_category_ibfk_1` FOREIGN KEY (`id_category`) REFERENCES `category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_category_ibfk_2` FOREIGN KEY (`id_product`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `product_commande`
--
ALTER TABLE `product_commande`
  ADD CONSTRAINT `product_commande_ibfk_2` FOREIGN KEY (`id_product`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_commande_ibfk_3` FOREIGN KEY (`id_commande`) REFERENCES `commande` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
