-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 18, 2021 at 02:22 PM
-- Server version: 5.7.24
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecommerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `booking_id` int(11) NOT NULL,
  `booking_date` datetime NOT NULL,
  `booking_couverts` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`booking_id`, `booking_date`, `booking_couverts`) VALUES
(1, '2021-01-01 16:59:00', 1),
(2, '2021-07-03 15:58:00', 1),
(3, '2022-06-06 12:00:00', 5),
(4, '2021-05-06 15:02:00', 1),
(5, '2021-05-23 17:15:00', 6);

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

CREATE TABLE `client` (
  `client_Id_Client` int(11) NOT NULL,
  `client_admin` int(11) DEFAULT '0',
  `client_Nom` text NOT NULL,
  `client_Prenom` text NOT NULL,
  `client_Date` date NOT NULL,
  `client_Adresse` varchar(255) NOT NULL,
  `client_Ville` text NOT NULL,
  `client_Code_Postal` int(255) NOT NULL,
  `client_Pays` text NOT NULL,
  `client_Telephone` varchar(255) NOT NULL,
  `client_Email` varchar(255) NOT NULL,
  `client_Mot_de_passe` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`client_Id_Client`, `client_admin`, `client_Nom`, `client_Prenom`, `client_Date`, `client_Adresse`, `client_Ville`, `client_Code_Postal`, `client_Pays`, `client_Telephone`, `client_Email`, `client_Mot_de_passe`) VALUES
(7, 1, 'Yoann', 'Destras', '2020-12-08', '41 Avenue de verdun', 'Lille', 59000, 'France', '0685612097', 'admin@gmail.com', '21232f297a57a5a743894a0e4a801fc3'),
(12, 1, 'Destras', 'Yoann', '1931-03-03', '41 Avenue de verdun', 'Saint-André-Lez-Lille', 59350, 'aaa', '0685612097', 'yoann@gmail.com', '3f4792d772b7147062e148fa9f8c49db'),
(13, 0, 'Destras', 'Yoann', '1931-01-01', '41 Avenue de verdun', 'Saint-André-Lez-Lille', 59350, 'Hongrie', '0685612097', 'yoann@bouze.com', '3f4792d772b7147062e148fa9f8c49db'),
(14, 0, 'Dhaene', 'Boris', '1996-10-19', '41 Avenue de verdun', 'Saint-André-Lez-Lille', 59350, 'France', '0685612097', 'boris@gmail.com', '21232f297a57a5a743894a0e4a801fc3'),
(15, 0, 'Destras', 'Yoann', '1931-01-04', '41 Avenue de verdun', 'Saint-André-Lez-Lille', 59350, 'France', '0685612097', 'destras@gmail.com', '3f4792d772b7147062e148fa9f8c49db'),
(16, 0, 'Destras', 'Yoann', '1931-01-01', '41 Avenue de verdun', 'Saint-André-Lez-Lille', 59350, 'France', '0685612097', 'toto@gmail.com', '5f4dcc3b5aa765d61d8327deb882cf99'),
(17, 1, 'Destras', 'Yoann', '1931-01-01', '41 Avenue de verdun', 'Saint-André-Lez-Lille', 59350, 'france', '0685612097', 'yoannnn@gmail.com', '3f4792d772b7147062e148fa9f8c49db'),
(18, 0, 'Boudart', 'Antoine', '1997-03-09', '59 Rue des marmitons', 'Quesnoy sur Deûle', 59190, 'France', '068600817', 'boudart.antoine@hotmail.com', '5f4dcc3b5aa765d61d8327deb882cf99'),
(19, 1, 'Dhaene', 'Boris', '1931-01-01', '10 Résidences Le Clos des Aulnes', 'Oignies', 62590, 'France', '0659014641', 'dhaene.boris@gmail.com', '5f4dcc3b5aa765d61d8327deb882cf99'),
(20, 0, 'Bidoyen', 'Mathieu', '1986-10-15', '41 Avenue de verdun', 'Saint-André-Lez-Lille', 59350, 'France', '0685612097', 'bidoyen@gmail.com', '5f4dcc3b5aa765d61d8327deb882cf99'),
(21, 0, 'Destras', 'Odessa', '2004-09-18', '41 Avenue de verdun', 'Saint-André-Lez-Lille', 59350, 'France', '068452178', 'odessa@gmail.com', '5f4dcc3b5aa765d61d8327deb882cf99');

-- --------------------------------------------------------

--
-- Table structure for table `meal`
--

CREATE TABLE `meal` (
  `meal_id` int(255) NOT NULL,
  `meal_state` int(11) NOT NULL DEFAULT '0',
  `meal_user` int(255) NOT NULL,
  `meal_date` datetime NOT NULL,
  `meal_tva_price` int(255) NOT NULL,
  `meal_total` int(255) NOT NULL,
  `meal_quantity` int(255) NOT NULL,
  `meal_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `meal`
--

INSERT INTO `meal` (`meal_id`, `meal_state`, `meal_user`, `meal_date`, `meal_tva_price`, `meal_total`, `meal_quantity`, `meal_name`) VALUES
(91, 1, 7, '2021-03-18 12:00:08', 26, 156, 5, 'Le crabe et les fruits de mer'),
(92, 1, 7, '2021-03-18 12:48:42', 5, 29, 2, 'Bánh xèo, les crêpes vietnamiennes'),
(93, 1, 7, '2021-03-18 12:49:52', 50, 300, 5, 'Le crabe et les fruits de mer'),
(94, 1, 7, '2021-03-18 12:49:52', 50, 300, 10, 'Bánh xèo, les crêpes vietnamiennes'),
(95, 1, 19, '2021-03-18 12:50:57', 3, 16, 1, 'Cao Lau, un plat bien de Hoi An'),
(96, 1, 19, '2021-03-18 13:00:00', 12, 72, 5, 'Bánh xèo, les crêpes vietnamiennes'),
(97, 1, 19, '2021-03-18 13:58:09', 26, 156, 5, 'Le crabe et les fruits de mer');

-- --------------------------------------------------------

--
-- Table structure for table `orderline`
--

CREATE TABLE `orderline` (
  `orderline_id` int(11) NOT NULL,
  `order_name` varchar(255) NOT NULL,
  `orderline_img` varchar(255) NOT NULL,
  `orderline_description` text NOT NULL,
  `orderline_sell_price` float NOT NULL,
  `orderline_buy_price` float NOT NULL,
  `orderline_quantity` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orderline`
--

INSERT INTO `orderline` (`orderline_id`, `order_name`, `orderline_img`, `orderline_description`, `orderline_sell_price`, `orderline_buy_price`, `orderline_quantity`) VALUES
(12, 'Les herbes, les herbes, encore les herbes!', 'upload/vietnam5.PNG', 'Bon, ce n’est pas un plat, je vous le concède, mais je retrouvais constamment un tas d’herbes fraîchement cueillies posées en bouquet au centre de la table dans les vrais bons bouis-bouis locaux. Ne sachant pas trop quoi en faire ni quelles choisir, j’épiais les habitants pour dresser mon plat, un rituel plaisant, car on ne sait jamais vraiment sur quoi on va tomber! Les plats vietnamiens sont frais, pleins de goûts et de textures différents, c’est agréable d’apprendre à intégrer les herbes fraîches plutôt que de les cuisiner.', 15, 10, 55),
(13, 'Le crabe et les fruits de mer', 'upload/vietnam2.PNG', 'Le crabe, j’en raffole et j’en ai mangé beaucoup au Cambodge par la suite, mais le meilleur plat de fruits de mer que j’ai mangé au Vietnam fut à Ho Chi Minh, le Banh canh ghe. Il était piquant, le crabe baignant dans un bouillon de chili avec des nouilles de tapioca et du porc. Le tout mangé assise sur des petits bancs de plastique typiques au milieu d’une foule dense, rajoutant à l’expérience!', 9, 5, 80),
(14, 'Bánh xèo, les crêpes vietnamiennes', 'upload/vietnam.jfif', 'Dans une crêpe de farine de riz et d’épices, on met de la viande de porc, des crevettes et des germes de soja que l’on fait cuire et qu’on plie en deux.\r\n\r\nChaque région a sa variété et je ne saurais vous le décrire toutes, mais peu importe dans quelle ville j’en ai mangé, j’ai ADORÉ, surtout après avoir trempé ce « finger food » dans la sauce poisson emblématique du pays, le nuoc-mâm. On peut aussi l’insérer dans une feuille de riz avec plein d’herbes pour compléter le plat.', 9, 6, 150),
(15, 'Banh Bao Vac ou White Roses', 'upload/vietnam3.PNG', 'L’apogée pour mes papilles fut sans hésiter Hoi An où la cuisine diffère des autres régions. On y trouve des spécialités vietnamiennes que l’on ne peut pas vraiment retrouver à Hanoi ou à Saigon/Ho Chi Minh.\r\n\r\nQuant aux White Roses, ces petites pochettes un peu gluantes et translucides ont fait partie intégrante de mon alimentation pendant plusieurs jours, j’en ai raffolé. La sauce qui les accompagne est si bonne, sans parler de la texture légère et du goût doux et malgré tout relevé qu’on y retrouve! Farcies au porc ou aux crevettes, on les appelle les roses blanches en raison de leur look qui rappelle la fleur (bof!).', 8, 4, 80),
(16, 'Cao Lau, un plat bien de Hoi An', 'upload/vietnam4.PNG', 'Dans un petit bol, vous retrouverez un petit peu de bouillon, des nouilles qui ressemblent étrangement à des nouilles udon, des morceaux de porc et des herbes, sans oublier la petite touche croustillante sous forme de craquelin ou de peau de porc frite. L’eau utilisée pour la recette vietnamienne provient toujours (si c’est la vraie recette!) d’un puits précis à l’extérieur d’Hoi An. Une fois le tout mis en semble, on obtient le cao lau, l’un de mes plats favoris de tout mon voyage!', 6, 3, 140),
(17, 'Rouleaux de printemps, incontournable de la cuisine vietnamienne', 'upload/vietnam7.PNG', 'Composés de laitue, de menthe, d’herbes fraîches, de vermicelles de riz, de pousses de soja et d’une protéine (souvent crevette ou porc) emballés dans une galette de riz, les rouleaux de printemps sont le repas frais par excellence au Vietnam, une combinaison parfaite de saveurs. Je dois avouer que j’ai eu du mal à en trouver des « vrais », pas concoctés uniquement pour les touristes, mais lorsqu’on met le grappin sur une bonne adresse, on a envie d’y retourner tous les jours!', 11, 6, 15);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `orders_id` int(11) NOT NULL,
  `orders_client_id` int(255) NOT NULL,
  `orders_name` varchar(255) NOT NULL,
  `orders_quantity` int(255) NOT NULL,
  `orders_img` varchar(255) NOT NULL,
  `orders_sell_price` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tampon`
--

CREATE TABLE `tampon` (
  `tampon_meal_id` int(11) NOT NULL,
  `tampon_user_id` int(255) NOT NULL,
  `tampon_meal_index` int(11) NOT NULL,
  `tampon_meal_quantity` int(255) NOT NULL,
  `tampon_meal_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`booking_id`);

--
-- Indexes for table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`client_Id_Client`);

--
-- Indexes for table `meal`
--
ALTER TABLE `meal`
  ADD PRIMARY KEY (`meal_id`);

--
-- Indexes for table `orderline`
--
ALTER TABLE `orderline`
  ADD PRIMARY KEY (`orderline_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`orders_id`),
  ADD KEY `orders_client_id` (`orders_client_id`);

--
-- Indexes for table `tampon`
--
ALTER TABLE `tampon`
  ADD PRIMARY KEY (`tampon_meal_id`),
  ADD KEY `tampon_user_id` (`tampon_user_id`),
  ADD KEY `tampon_ibfk_1` (`tampon_meal_index`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `client`
--
ALTER TABLE `client`
  MODIFY `client_Id_Client` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `meal`
--
ALTER TABLE `meal`
  MODIFY `meal_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;

--
-- AUTO_INCREMENT for table `orderline`
--
ALTER TABLE `orderline`
  MODIFY `orderline_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `orders_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=189;

--
-- AUTO_INCREMENT for table `tampon`
--
ALTER TABLE `tampon`
  MODIFY `tampon_meal_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=131;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tampon`
--
ALTER TABLE `tampon`
  ADD CONSTRAINT `tampon_ibfk_1` FOREIGN KEY (`tampon_meal_index`) REFERENCES `orders` (`orders_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
