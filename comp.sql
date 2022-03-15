-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 08, 2021 at 09:10 PM
-- Server version: 5.7.31
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `comp`
--

-- --------------------------------------------------------

--
-- Table structure for table `tblauthor`
--

DROP TABLE IF EXISTS `tblauthor`;
CREATE TABLE IF NOT EXISTS `tblauthor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Author` varchar(200) NOT NULL,
  `email` varchar(100) NOT NULL,
  `user_id` int(11) DEFAULT '0',
  `PostingDate` timestamp NOT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblauthor`
--

INSERT INTO `tblauthor` (`id`, `Author`, `email`, `user_id`, `PostingDate`) VALUES
(1, 'David Junior', 'juniord.dj88@gmail.com', 0, '2021-01-20 15:52:03'),
(2, 'Savic Hernandez', 'dagbugba@yahoo.com', 0, '2021-01-21 12:38:32'),
(5, 'Junior Amos', 'user@user.com', 3, '2021-03-08 20:06:24');

-- --------------------------------------------------------

--
-- Table structure for table `tblcategory`
--

DROP TABLE IF EXISTS `tblcategory`;
CREATE TABLE IF NOT EXISTS `tblcategory` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `CategoryName` varchar(200) DEFAULT NULL,
  `Description` mediumtext,
  `Is_Active` int(1) DEFAULT NULL,
  `PostingDate` timestamp NOT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblcategory`
--

INSERT INTO `tblcategory` (`id`, `CategoryName`, `Description`, `Is_Active`, `PostingDate`) VALUES
(17, 'Lunch', 'Indomie', 1, '2021-01-21 13:59:55'),
(20, 'Lunch', 'Beans and Pap', 1, '2021-01-21 14:01:26');

-- --------------------------------------------------------

--
-- Table structure for table `tblmail`
--

DROP TABLE IF EXISTS `tblmail`;
CREATE TABLE IF NOT EXISTS `tblmail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(200) NOT NULL,
  `name` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `PostingDate` timestamp NOT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblmail`
--

INSERT INTO `tblmail` (`id`, `email`, `name`, `message`, `PostingDate`) VALUES
(1, 'test@gmail.com', 'David Junior', 'an email from homepage contact form', '2021-01-22 23:00:18'),
(2, 'dave@gmail.com', 'david Manny', 'i will like a tutorial on how to make pastery', '2021-01-22 23:03:54'),
(3, 'dave@gmail.com', 'david Manny', 'i will like a tutorial on how to make pastery', '2021-01-22 23:06:17');

-- --------------------------------------------------------

--
-- Table structure for table `tblrecipe`
--

DROP TABLE IF EXISTS `tblrecipe`;
CREATE TABLE IF NOT EXISTS `tblrecipe` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `RecipeName` varchar(200) NOT NULL,
  `Author` varchar(200) DEFAULT NULL,
  `RecipeDescription` longtext,
  `category` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `PostingDate` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblrecipe`
--

INSERT INTO `tblrecipe` (`id`, `RecipeName`, `Author`, `RecipeDescription`, `category`, `image`, `user_id`, `PostingDate`) VALUES
(8, 'Banana Pancakes', 'James Andrew', '<p><span style=\"color: rgba(0, 0, 0, 0.95); font-family: &quot;Source Sans Pro&quot;, Times, serif; font-size: 18px;\">Crowd pleasing banana pancakes made from scratch. A fun twist on ordinary pancakes.</span></p><p><b>Ingredients used</b></p><ul><li><span style=\"color: rgba(0, 0, 0, 0.95); font-family: &quot;Source Sans Pro&quot;, Times, serif; font-size: 18px;\">1 cup all-purpose flour</span></li><li><span style=\"color: rgba(0, 0, 0, 0.95); font-family: &quot;Source Sans Pro&quot;, Times, serif; font-size: 18px;\">1 tablespoon white sugar</span></li><li><span style=\"color: rgba(0, 0, 0, 0.95); font-family: &quot;Source Sans Pro&quot;, Times, serif; font-size: 18px;\">2 teaspoons baking powder</span></li><li><span style=\"color: rgba(0, 0, 0, 0.95); font-family: &quot;Source Sans Pro&quot;, Times, serif; font-size: 18px;\">Â¼ teaspoon salt</span></li><li><span style=\"color: rgba(0, 0, 0, 0.95); font-family: &quot;Source Sans Pro&quot;, Times, serif; font-size: 18px;\">1 egg, beaten</span></li><li><span style=\"color: rgba(0, 0, 0, 0.95); font-family: &quot;Source Sans Pro&quot;, Times, serif; font-size: 18px;\">1 cup milk</span></li><li><span style=\"color: rgba(0, 0, 0, 0.95); font-family: &quot;Source Sans Pro&quot;, Times, serif; font-size: 18px;\">2 tablespoons vegetable oil</span></li><li><span style=\"color: rgba(0, 0, 0, 0.95); font-family: &quot;Source Sans Pro&quot;, Times, serif; font-size: 18px;\">2 ripe bananas, mashed</span></li></ul><p><span style=\"color: rgba(0, 0, 0, 0.95); font-family: &quot;Source Sans Pro&quot;, Times, serif; font-size: 18px;\"><b>Directions</b></span></p><ol><li><span style=\"color: rgba(0, 0, 0, 0.95); font-family: &quot;Source Sans Pro&quot;, Times, serif; font-size: 18px;\">Combine flour, white sugar, baking powder and salt. In a separate bowl, mix together egg, milk, vegetable oil and bananas.</span></li><li><span style=\"color: rgba(0, 0, 0, 0.95); font-family: &quot;Source Sans Pro&quot;, Times, serif; font-size: 18px;\">Stir flour mixture into banana mixture; batter will be slightly lumpy.</span></li><li><span style=\"color: rgba(0, 0, 0, 0.95); font-family: &quot;Source Sans Pro&quot;, Times, serif; font-size: 18px;\">Heat a lightly oiled griddle or frying pan over medium high heat. Pour or scoop the batter onto the griddle, using approximately 1/4 cup for each pancake. Cook until pancakes are golden brown on both sides; serve hot.</span></li></ol><p><span style=\"color: rgba(0, 0, 0, 0.95); font-family: &quot;CopperPot Bold&quot;; font-size: 24px; font-weight: 600;\">Nutrition Facts</span></p><div class=\"section-label\" style=\"font-family: &quot;Source Sans Pro&quot;, Times, serif; font-size: medium; line-height: 24px; font-weight: 700; text-transform: capitalize; margin-right: 6px; display: inline; color: rgba(0, 0, 0, 0.95);\">Per Serving:</div><p><span style=\"color: rgba(0, 0, 0, 0.95); font-family: &quot;Source Sans Pro&quot;, Times, serif; font-size: medium;\">&nbsp;</span><span style=\"color: rgba(0, 0, 0, 0.95); font-family: &quot;Source Sans Pro&quot;, Times, serif; font-size: medium;\">193 calories; protein 5g; carbohydrates 29.2g; fat 6.6g; cholesterol 34.3mg; sodium 245.9mg.&nbsp;</span></p><p><span style=\"color: rgba(0, 0, 0, 0.95); font-family: &quot;CopperPot Bold&quot;; font-size: 24px; font-weight: 600;\"><br></span><span style=\"color: rgba(0, 0, 0, 0.95); font-family: &quot;Source Sans Pro&quot;, Times, serif; font-size: 18px;\"><br></span></p>', 'Breakfast', 'f09eae62fffec19fbdbd763c46f6113d.jpg', 0, '2021-01-22 21:28:20'),
(9, 'Classic Hash Browns', 'Savic Hernandez', '<p><span style=\"color: rgba(0, 0, 0, 0.95); font-family: &quot;Source Sans Pro&quot;, Times, serif; font-size: 18px;\">These classic diner-style hash browns are crispy on the outside and fluffy on the inside.</span></p><p><span style=\"color: rgba(0, 0, 0, 0.95); font-family: &quot;Source Sans Pro&quot;, Times, serif; font-size: 18px;\"><b>Ingredients used:</b></span></p><ul><li><span style=\"color: rgba(0, 0, 0, 0.95); font-family: &quot;Source Sans Pro&quot;, Times, serif; font-size: 18px;\">2 russet potatoes, peeled</span></li><li><span style=\"color: rgba(0, 0, 0, 0.95); font-family: &quot;Source Sans Pro&quot;, Times, serif; font-size: 18px;\">3 tablespoons clarified butter</span></li><li><span style=\"color: rgba(0, 0, 0, 0.95); font-family: &quot;Source Sans Pro&quot;, Times, serif; font-size: 18px;\">salt and ground black pepper to taste</span></li><li><span style=\"color: rgba(0, 0, 0, 0.95); font-family: &quot;Source Sans Pro&quot;, Times, serif; font-size: 18px;\">1 pinch cayenne pepper, or to taste</span></li><li><span style=\"color: rgba(0, 0, 0, 0.95); font-family: &quot;Source Sans Pro&quot;, Times, serif; font-size: 18px;\">1 pinch paprika, or to taste&nbsp;</span></li></ul><p><span style=\"color: rgba(0, 0, 0, 0.95); font-family: &quot;Source Sans Pro&quot;, Times, serif; font-size: 18px;\">Directions</span></p><ol><li><span style=\"color: rgba(0, 0, 0, 0.95); font-family: &quot;Source Sans Pro&quot;, Times, serif; font-size: 18px;\">Shred potatoes into a large bowl filled with cold water. Stir until water is cloudy, drain, and cover potatoes again with fresh cold water. Stir again to dissolve excess starch. Drain potatoes well, pat dry with paper towels, and squeeze out any excess moisture.</span></li><li><span style=\"color: rgba(0, 0, 0, 0.95); font-family: &quot;Source Sans Pro&quot;, Times, serif; font-size: 18px;\">Heat clarified butter in a large non-stick pan over medium heat. Sprinkle shredded potatoes into the hot butter and season with salt, black pepper, cayenne pepper, and paprika.</span></li><li><span style=\"color: rgba(0, 0, 0, 0.95); font-family: &quot;Source Sans Pro&quot;, Times, serif; font-size: 18px;\">Cook potatoes until a brown crust forms on the bottom, about 5 minutes. Continue to cook and stir until potatoes are browned all over, about 5 more minutes.</span></li></ol><p><span style=\"color: rgba(0, 0, 0, 0.95); font-family: &quot;CopperPot Bold&quot;; font-size: 24px; font-weight: 600;\">Nutrition Facts</span><br></p><p><span style=\"color: rgba(0, 0, 0, 0.95); font-family: &quot;Source Sans Pro&quot;, Times, serif; font-size: medium;\"></span></p><div class=\"partial recipe-nutrition-section\" style=\"margin-top: 24px; color: rgba(0, 0, 0, 0.95); font-family: &quot;Source Sans Pro&quot;, Times, serif; font-size: medium;\"><div class=\"section-label\" style=\"font-size: 16px; line-height: 24px; letter-spacing: 0px; font-weight: 700; text-transform: capitalize; margin-right: 6px; display: inline;\">Per Serving:</div>&nbsp;<div class=\"section-body\" style=\"font-size: 16px; line-height: 24px; letter-spacing: 0px; margin-top: 8px; display: inline;\">334 calories; protein 4.4g; carbohydrates 37.5g; fat 19.4g; cholesterol 49.2mg; sodium 13.4mg.&nbsp;</div></div>', 'Lunch', '74e6b10c5ff6e007cfe231ef0d1c002f.jpg', 0, '2021-01-22 20:46:15'),
(10, 'Thai Red Chicken Curry', 'Paul Mian', '<p><span style=\"color: rgba(0, 0, 0, 0.95); font-family: &quot;Source Sans Pro&quot;, Times, serif; font-size: 18px;\">This is a very simple, yet very tasty, Thai red curry recipe. All the ingredients can be found in your grocery store. Specialty Asian shops are also a good source for Thai ingredients. Serve over rice or noodles.</span></p><p><span style=\"font-weight: bolder; color: rgba(0, 0, 0, 0.95); font-family: &quot;Source Sans Pro&quot;, Times, serif; font-size: 18px;\">Ingredients</span></p><ul><li><span style=\"color: rgba(0, 0, 0, 0.95); font-family: &quot;Source Sans Pro&quot;, Times, serif; font-size: 18px;\">2 tablespoons olive oil</span></li><li><span style=\"color: rgba(0, 0, 0, 0.95); font-family: &quot;Source Sans Pro&quot;, Times, serif; font-size: 18px;\">4 medium shallots, thinly sliced</span></li><li><span style=\"color: rgba(0, 0, 0, 0.95); font-family: &quot;Source Sans Pro&quot;, Times, serif; font-size: 18px;\">1 medium red bell pepper, julienned</span></li><li><span style=\"color: rgba(0, 0, 0, 0.95); font-family: &quot;Source Sans Pro&quot;, Times, serif; font-size: 18px;\">1 red chile pepper, finely chopped</span></li><li><span style=\"color: rgba(0, 0, 0, 0.95); font-family: &quot;Source Sans Pro&quot;, Times, serif; font-size: 18px;\">1 tablespoon minced fresh ginger root</span></li><li><span style=\"color: rgba(0, 0, 0, 0.95); font-family: &quot;Source Sans Pro&quot;, Times, serif; font-size: 18px;\">3 cloves garlic, minced</span></li><li><span style=\"color: rgba(0, 0, 0, 0.95); font-family: &quot;Source Sans Pro&quot;, Times, serif; font-size: 18px;\">1 (13.5 ounce) can coconut milk, divided</span></li><li><span style=\"color: rgba(0, 0, 0, 0.95); font-family: &quot;Source Sans Pro&quot;, Times, serif; font-size: 18px;\">2 teaspoons Thai red curry paste</span></li><li><span style=\"color: rgba(0, 0, 0, 0.95); font-family: &quot;Source Sans Pro&quot;, Times, serif; font-size: 18px;\">1â€‰Â½ pounds skinless, boneless chicken breast, thinly sliced</span></li></ul><p><b><span style=\"color: rgba(0, 0, 0, 0.95); font-family: &quot;Source Sans Pro&quot;, Times, serif; font-size: 18px;\">Directions</span></b></p><ol><li><span style=\"color: rgba(0, 0, 0, 0.95); font-family: &quot;Source Sans Pro&quot;, Times, serif; font-size: 18px;\">Heat olive oil a large nonstick pan or skillet over medium-high heat. Add shallots and stir-fry until soft, 3 to 5 minutes. Add bell pepper, chile pepper, ginger, and garlic; stir-fry for 3 minutes. Pour in 1/4 of the coconut milk and stir in curry paste until well distributed.</span></li><li><span style=\"color: rgba(0, 0, 0, 0.95); font-family: &quot;Source Sans Pro&quot;, Times, serif; font-size: 18px;\">Add chicken, 1/4 cup Thai basil, brown sugar, lime juice, and fish sauce. Cook and stir until chicken is no longer pink in the center and juices run clear, 7 to 10 minutes.</span></li><li><span style=\"color: rgba(0, 0, 0, 0.95); font-family: &quot;Source Sans Pro&quot;, Times, serif; font-size: 18px;\">Add the rest of the coconut milk and diced tomato to the pan and bring to the boil. Simmer over medium heat for 10 to 15 minutes more. Serve with remaining basil and scallions on the side as a garnish.</span></li></ol><p><span style=\"color: rgba(0, 0, 0, 0.95); font-family: &quot;Source Sans Pro&quot;, Times, serif; font-size: 18px;\"><br></span></p><h2 class=\"section-headline\" style=\"font-family: &quot;CopperPot Bold&quot;; font-size: 24px; line-height: 32px; font-weight: 600; margin-bottom: 0px; overflow: hidden; color: rgba(0, 0, 0, 0.95); display: inline-block; padding-top: 15px;\">Nutrition Facts</h2><div class=\"partial recipe-nutrition-section\" style=\"margin-top: 24px; color: rgba(0, 0, 0, 0.95); font-family: &quot;Source Sans Pro&quot;, Times, serif; font-size: medium;\"><div class=\"section-label\" style=\"font-size: 16px; line-height: 24px; letter-spacing: 0px; font-weight: 700; text-transform: capitalize; margin-right: 6px; display: inline;\">Per Serving:</div>&nbsp;<div class=\"section-body\" style=\"font-size: 16px; line-height: 24px; letter-spacing: 0px; margin-top: 8px; display: inline;\">345 calories; protein 26.6g; carbohydrates 14.1g; fat 21.1g; cholesterol 64.6mg; sodium 166mg.&nbsp;</div></div><p><span style=\"color: rgba(0, 0, 0, 0.95); font-family: &quot;Source Sans Pro&quot;, Times, serif; font-size: medium; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; display: inline !important; float: none;\"></span><span style=\"font-weight: bold; color: rgba(0, 0, 0, 0.95); font-family: &quot;Source Sans Pro&quot;, Times, serif; font-size: 18px;\"><br></span><br></p>', 'Dinner', 'df5ffa8ad011d0de6064b06fd6327ffe.jpg', 0, '2021-01-22 20:57:23'),
(12, 'rice', 'emeka', '<p>this is going to be so awesome</p>', 'cat one', 'ee749b6338a8295268b461b2e92ac0ba.png', 0, '2021-03-05 12:35:54');

-- --------------------------------------------------------

--
-- Table structure for table `tblusers`
--

DROP TABLE IF EXISTS `tblusers`;
CREATE TABLE IF NOT EXISTS `tblusers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fullname` varchar(80) NOT NULL,
  `email` varchar(60) NOT NULL,
  `password` varchar(200) NOT NULL,
  `role` varchar(60) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblusers`
--

INSERT INTO `tblusers` (`id`, `fullname`, `email`, `password`, `role`) VALUES
(1, 'David John', 'paytest432@gmail.com', '$2y$10$savuPy7roanPC7lry0Q29e6ogrLNtE.VAe/n7tJrrOrIwhLXTm8Ta', 'Content Editor'),
(2, 'Keallua Boss', 'dave@gmail.com', '$2y$10$lvyu8Q9C.579xdnu8xjdCuJHXfLujkvfCB3VPK5Fe3F5.dXw9BHKq', 'Site Admin'),
(3, 'Jane John', 'test@gmail.com', '$2y$10$1cqGy/n.lJSvaNxAoPNmjOtuyr.pSBxRS.f4UW.SCYfdLBeOMbH2O', 'Account Admin');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
