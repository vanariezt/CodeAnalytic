-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 22, 2012 at 03:24 
-- Server version: 5.1.41
-- PHP Version: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ca.0.2.1`
--

-- --------------------------------------------------------

--
-- Table structure for table `ca_add_ons`
--

CREATE TABLE IF NOT EXISTS `ca_add_ons` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `title` varchar(30) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `order` int(5) DEFAULT NULL,
  `publish` enum('0','1') DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `ca_add_ons`
-- 
-- --------------------------------------------------------

--
-- Table structure for table `ca_album`
--

CREATE TABLE IF NOT EXISTS `ca_album` (
  `id` varchar(10) NOT NULL,
  `name` varchar(30) DEFAULT NULL,
  `description` varchar(100) DEFAULT NULL,
  `order` int(10) DEFAULT '0',
  `publish` enum('0','1') DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ca_album`
--

INSERT INTO `ca_album` (`id`, `name`, `description`, `order`, `publish`) VALUES
('1343522666', 'Uncategory', '-', 1, '1');

-- --------------------------------------------------------

--
-- Table structure for table `ca_categories`
--

CREATE TABLE IF NOT EXISTS `ca_categories` (
  `id` varchar(10) NOT NULL,
  `name` varchar(30) DEFAULT NULL,
  `meta_keyword` varchar(225) DEFAULT NULL,
  `meta_description` varchar(225) DEFAULT NULL,
  `permalink` varchar(100) DEFAULT NULL,
  `order` int(10) DEFAULT '0',
  `publish` enum('0','1') DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ca_categories`
--

INSERT INTO `ca_categories` (`id`, `name`, `meta_keyword`, `meta_description`, `permalink`, `order`, `publish`) VALUES
('8948759595', 'uncategory', 'uncategory', 'all about uncategory', 'uncategory', 2, '1'),
('1348292247', 'blog', 'blog', 'blog', 'blog', 0, '1');

-- --------------------------------------------------------

--
-- Table structure for table `ca_comments`
--

CREATE TABLE IF NOT EXISTS `ca_comments` (
  `id` varchar(10) NOT NULL,
  `date` datetime DEFAULT NULL,
  `id_posts` varchar(10) DEFAULT NULL,
  `member_id` varchar(10) DEFAULT NULL,
  `content` text,
  `com_url` varchar(225) DEFAULT NULL,
  `ip` varchar(30) DEFAULT NULL,
  `order` int(10) DEFAULT '0',
  `publish` enum('0','1') DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ca_comments`
--


-- --------------------------------------------------------

--
-- Table structure for table `ca_gallery`
--

CREATE TABLE IF NOT EXISTS `ca_gallery` (
  `id` varchar(10) NOT NULL,
  `user_id` varchar(10) DEFAULT NULL,
  `title` varchar(30) DEFAULT NULL,
  `img` varchar(225) DEFAULT 'codeanalytic_media_ca_thumb_small.jpg',
  `date` datetime DEFAULT NULL,
  `album_id` int(10) DEFAULT NULL,
  `description` varchar(225) DEFAULT NULL,
  `order` int(10) DEFAULT '0',
  `publish` enum('0','1') DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ca_gallery`
--


-- --------------------------------------------------------

--
-- Table structure for table `ca_htmlarea`
--

CREATE TABLE IF NOT EXISTS `ca_htmlarea` (
  `id` varchar(15) NOT NULL,
  `pos` smallint(1) NOT NULL,
  `title` varchar(100) NOT NULL,
  `html` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ca_htmlarea`
--


-- --------------------------------------------------------

--
-- Table structure for table `ca_ippoll`
--

CREATE TABLE IF NOT EXISTS `ca_ippoll` (
  `ip` varchar(15) DEFAULT NULL,
  `pid` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ca_ippoll`
--

INSERT INTO `ca_ippoll` (`ip`, `pid`) VALUES
('192.168.0.6', 1),
('192.168.0.4', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ca_link`
--

CREATE TABLE IF NOT EXISTS `ca_link` (
  `id` varchar(10) NOT NULL,
  `title` varchar(30) DEFAULT NULL,
  `url` varchar(100) DEFAULT NULL,
  `target` varchar(15) DEFAULT NULL,
  `attr_id` varchar(15) DEFAULT NULL,
  `attr_class` varchar(225) DEFAULT NULL,
  `order` int(10) DEFAULT '0',
  `publish` enum('0','1') DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ca_link`
--

INSERT INTO `ca_link` (`id`, `title`, `url`, `target`, `attr_id`, `attr_class`, `order`, `publish`) VALUES
('1342404124', 'CodeAnalytic', 'http://www.codeanalytic.com', '_blank', '-', '-', 1, '1'),
('1347987614', 'Twitter@CodeAnalytic', 'https://twitter.com/CodeAnalytic', '_blank', '-', '-', 2, '1'),
('1347987662', 'Facebook@CodeAnlaytic', 'https://facebook.com/CodeAnalytic', '_blank', '-', '-', 3, '1'),
('1347987694', 'Support', 'http://forum.codeanalytic.com', '_blank', '-', '-', 0, '1');

-- --------------------------------------------------------

--
-- Table structure for table `ca_members`
--

CREATE TABLE IF NOT EXISTS `ca_members` (
  `id` varchar(10) NOT NULL,
  `username` varchar(30) DEFAULT NULL,
  `password` varchar(45) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `photo` varchar(100) DEFAULT 'default_ca_thumb_small.jpg',
  `first_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `gender` enum('0','1') DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `born` date DEFAULT NULL,
  `about` varchar(225) DEFAULT NULL,
  `login_from` varchar(25) DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `is_activated` enum('0','1') DEFAULT '0',
  `order` int(10) DEFAULT NULL,
  `publish` enum('0','1') DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ca_members`
--

-- --------------------------------------------------------
INSERT INTO `ca_members` (`id`, `username`, `password`, `email`, `photo`, `first_name`, `last_name`, `gender`, `address`, `phone`, `born`, `about`, `login_from`, `last_login`, `is_activated`, `order`, `publish`) VALUES
('uF3gO1shm4', 'noname', 'af74363590cf3797d6c6383aaa2750d4', 'noname@codeanalytic.com', '1346824383_ca_thumb_middle.png', '', '', '', '', '', '0000-00-00', '', '', '2012-09-05 05:41:26', '0', 0, '1');
--
-- Table structure for table `ca_members_statistic`
--

CREATE TABLE IF NOT EXISTS `ca_members_statistic` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `member_id` varchar(15) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=43 ;

--
-- Dumping data for table `ca_members_statistic`
--


-- --------------------------------------------------------

--
-- Table structure for table `ca_menu`
--

CREATE TABLE IF NOT EXISTS `ca_menu` (
  `id` varchar(10) NOT NULL,
  `id_parent` varchar(10) DEFAULT '0',
  `name` varchar(100) DEFAULT NULL,
  `url` varchar(100) DEFAULT NULL,
  `target` varchar(15) DEFAULT NULL,
  `attr_id` varchar(30) DEFAULT NULL,
  `attr_class` varchar(100) DEFAULT NULL,
  `order` int(10) DEFAULT '0',
  `publish` enum('0','1') DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ca_menu`
--

INSERT INTO `ca_menu` (`id`, `id_parent`, `name`, `url`, `target`, `attr_id`, `attr_class`, `order`, `publish`) VALUES
('1341930566', '0', 'home', 'home', '_self', 'home', 'icon, home', 5, '1'),
('1348115719', '0', 'About', 'about', '_self', '-', '-', 4, '1'),
('1348119324', '0', 'blog', 'blog', '_self', '-', '-', 3, '1');

-- --------------------------------------------------------

--
-- Table structure for table `ca_module`
--

CREATE TABLE IF NOT EXISTS `ca_module` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` enum('1','0') DEFAULT '0',
  `id_parent` int(11) DEFAULT '0',
  `path_name` varchar(50) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `url` varbinary(50) DEFAULT NULL,
  `order` int(11) DEFAULT '0',
  `publish` enum('0','1') DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2147483648 ;

--
-- Dumping data for table `ca_module`
--

INSERT INTO `ca_module` (`id`, `type`, `id_parent`, `path_name`, `name`, `url`, `order`, `publish`) VALUES
(1111111101, '1', 0, 'gallery/', 'gallery', 'gallery/data', 2, '1'),
(1111111102, '1', 0, 'pages/', 'pages', 'pages/index', 7, '1'),
(1111111103, '1', 0, 'media/', 'media', 'media/index', 5, '1'),
(1111111104, '1', 1111111101, 'album/', 'album', 'album/index', 3, '1'),
(1111111105, '1', 0, 'posts/', 'posts', 'posts/index', 9, '1'),
(1111111106, '1', 0, 'menu/', 'menu', 'menu/index', 6, '1'),
(1111111107, '1', 0, 'link/', 'link', 'link/index', 4, '1'),
(1111111108, '1', 0, 'polling/', 'polling', 'polling/index', 8, '1'),
(1111111109, '1', 1111111105, 'categories/', 'categories', 'categories/index', 0, '1'),
(1111111110, '1', 0, 'add-ons/', 'add-ons', 'add_ons/index', 3, '1'),
(1111111111, '0', 1111111110, 'security/', 'security', 'security/index', 0, '1'), 
(1111111113, '0', 1111111110, 'word_censor/', 'word censor', 'word_censor/index', 2, '1');

-- --------------------------------------------------------

--
-- Table structure for table `ca_pages`
--

CREATE TABLE IF NOT EXISTS `ca_pages` (
  `id` varchar(10) NOT NULL,
  `user_id` varchar(10) DEFAULT NULL,
  `title` varchar(100) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `is_like` enum('0','1') DEFAULT '0',
  `is_share` enum('0','1') DEFAULT '0',
  `meta_keyword` varchar(225) DEFAULT NULL,
  `meta_description` varchar(225) DEFAULT NULL,
  `content` text,
  `view` int(10) DEFAULT NULL,
  `link` varchar(225) DEFAULT NULL,
  `permalink` varchar(100) DEFAULT NULL,
  `show_as_menu` enum('0','1') DEFAULT '0',
  `order` int(10) DEFAULT '0',
  `publish` enum('0','1') DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ca_pages`
--

INSERT INTO `ca_pages` (`id`, `user_id`, `title`, `date`, `is_like`, `is_share`, `meta_keyword`, `meta_description`, `content`, `view`, `link`, `permalink`, `show_as_menu`, `order`, `publish`) VALUES
('1348132162', '1346619543', 'The Reason Why You Use CodeAnalytic', '2012-09-20 04:51:06', '1', '1', 'about hadinug, founder codeanlaytic, inventor of codeanalytic', 'about hadinug, founder codeanlaytic, inventor of codeanalytic', '<p>"One Touch In All Sollution" yes it was, when you start installed codeanlaytic you''ll get website best view on web browser and mobile browser. It''s automaticly when you use codeanalytic for website engine.</p>\n<p>&nbsp;</p>\n<p>There are many reason why you should choose codeanalaytic for your website. I try to quote from codeanalytic official website, "<a href="http://codeanalytic.com/" target="_blank">CodeAnalytic</a>&nbsp;is one of more Content Management System, started in 2012 with lines code&nbsp;to enhance the typography of everyday writing.&nbsp;Everything you see here, from the documentation to the code itself, was created by and for the community. CodeAnalytic is an Open Source project. It also means you are free to use it for anything paying anyone a license fee and a number of other important freedoms".</p>\n<p><br />I put little information from CodeAnalytic and get the experience&nbsp;when develop this cms, CodeAnlaytic using height&nbsp;programing&nbsp;technique. CodeAnalytic is create base OOP php 4+ that optimized with ajax jQuery in backEnd proccess. CodeAnaltic is OpenSource CMS that allow you to edit the script.&nbsp;Maybe this list can be&nbsp;represent codeanalytic fiture that must you know . Codeanalytic using ..</p>\n<p>&nbsp;</p>\n<p>1. Height programing technique PHP OOP 4+</p>\n<p>2. CodeIgniter Base Modification</p>\n<p>3. jQuery and Mobile jQuery</p>\n<p>4. Using MYSQL</p>\n<p>5. Multi Language</p>\n<p>6. FusionChart</p>\n<p>7. HMVC structure</p>\n<p>8. UserFriendly URL and using permalink</p>\n<p>9. Ajax BackEnd Proccess</p>\n<p>10. Widget Click and Drag on the Fly</p>\n<p>11. Virtual Keybord</p>\n<p>12. Ajax Upload on The Fly</p>\n<p>13. Easy drag and drop short data list</p>\n<p>14. Live Coding on CMS</p>\n<p>15. TinyMCE editor modification</p>\n<p>16. and many things else..</p>\n<p>&nbsp;</p>\n<p>Many things else that I can write in here. Because codeanalytic more than CMS ever there in the world.&nbsp;</p>', 18, 'pages/detail/1348132162/2012/09/20/04/51/06', 'the-reason-why-you-use-codeanalytic', '1', 0, '1');

-- --------------------------------------------------------

--
-- Table structure for table `ca_poll`
--

CREATE TABLE IF NOT EXISTS `ca_poll` (
  `pid` varchar(10) NOT NULL,
  `question` varchar(225) DEFAULT NULL,
  `noofanswers` int(2) DEFAULT NULL,
  `answer1` varchar(225) DEFAULT NULL,
  `answer2` varchar(225) DEFAULT NULL,
  `answer3` varchar(225) DEFAULT NULL,
  `answer4` varchar(225) DEFAULT NULL,
  `answer5` varchar(225) DEFAULT NULL,
  `answer6` varchar(225) DEFAULT NULL,
  `order` int(10) DEFAULT NULL,
  `publish` enum('0','1') DEFAULT '0',
  PRIMARY KEY (`pid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ca_poll`
--

INSERT INTO `ca_poll` (`pid`, `question`, `noofanswers`, `answer1`, `answer2`, `answer3`, `answer4`, `answer5`, `answer6`, `order`, `publish`) VALUES
('1', 'How about performance codeanalytic, in your website', 3, 'good', 'very good', 'bad', '', '', '', 0, '1');

-- --------------------------------------------------------

--
-- Table structure for table `ca_pollresult`
--

CREATE TABLE IF NOT EXISTS `ca_pollresult` (
  `pid` varchar(10) NOT NULL,
  `answer1` int(10) DEFAULT NULL,
  `answer2` int(10) DEFAULT NULL,
  `answer3` int(10) DEFAULT NULL,
  `answer4` int(10) DEFAULT NULL,
  `answer5` int(10) DEFAULT NULL,
  `answer6` int(10) DEFAULT NULL,
  PRIMARY KEY (`pid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ca_pollresult`
--

INSERT INTO `ca_pollresult` (`pid`, `answer1`, `answer2`, `answer3`, `answer4`, `answer5`, `answer6`) VALUES
('1', 3, 1, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `ca_posts`
--

CREATE TABLE IF NOT EXISTS `ca_posts` (
  `id` varchar(10) NOT NULL,
  `cat_id` varchar(250) DEFAULT NULL,
  `user_id` varchar(10) DEFAULT NULL,
  `title` varchar(100) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `img` varchar(225) DEFAULT 'codeanalytic_media_ca_thumb_small.jpg',
  `is_show_thumb` enum('0','1') NOT NULL,
  `is_like` enum('0','1') DEFAULT '0',
  `is_share` enum('0','1') DEFAULT '0',
  `meta_keyword` varchar(225) DEFAULT NULL,
  `meta_description` varchar(225) DEFAULT NULL,
  `content` text,
  `view` int(10) DEFAULT NULL,
  `link` varchar(225) NOT NULL,
  `permalink` varchar(225) NOT NULL,
  `order` int(10) DEFAULT '0',
  `publish` enum('0','1') DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ca_posts`
--

INSERT INTO `ca_posts` (`id`, `cat_id`, `user_id`, `title`, `date`, `img`, `is_show_thumb`, `is_like`, `is_share`, `meta_keyword`, `meta_description`, `content`, `view`, `link`, `permalink`, `order`, `publish`) VALUES
('1348239622', '8948759595,1348292247', '1346619543', 'What Is Lorem Ipsum', '2012-09-21 22:58:50', 'codeanalytic_media_ca_thumb_small.jpg', '0', '1', '1', 'lorem, ipsum', 'lorem ipsum', '<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\n<p>&nbsp;</p>', 1, 'posts/detail/1348239622/2012/09/21/22/58/50', 'what-is-lorem-ipsum', 0, '1'),
('1348291654', '8948759595', '1346619543', 'Why We Use Lorem Ipsum', '2012-08-22 13:26:36', 'codeanalytic_media_ca_thumb_small.jpg', '0', '1', '1', 'why lorem, lorem', 'why use lorem ipsum', '<p><br />It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using ''Content here, content here'', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for ''lorem ipsum'' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>', NULL, 'posts/detail/1348291654/2012/08/22/13/26/36', 'why-we-use-lorem-ipsum', 0, '1'),
('1348291721', '8948759595,1348292247', '1346619543', 'Where Does It''s Come From', '2012-07-22 13:27:55', 'codeanalytic_media_ca_thumb_small.jpg', '0', '1', '1', 'Whre Does It''s, Lorem Ipsum', 'Whre Does It''s, Lorem Ipsum', '<p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.</p>\n<p>The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from "de Finibus Bonorum et Malorum" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham</p>', NULL, 'posts/detail/1348291721/2012/07/22/13/27/55', 'where-does-it-s-come-from', 0, '1'),
('1348291774', '8948759595', '1346619543', 'Where Can I Get', '2012-06-22 13:28:59', 'codeanalytic_media_ca_thumb_small.jpg', '0', '1', '1', 'Lorem', 'Where Can I Get Some', '<p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don''t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn''t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.</p>', NULL, 'posts/detail/1348291774/2012/06/22/13/28/59', 'where-can-i-get', 0, '1');

-- --------------------------------------------------------

--
-- Table structure for table `ca_privileges`
--

CREATE TABLE IF NOT EXISTS `ca_privileges` (
  `priv_id` int(2) NOT NULL AUTO_INCREMENT,
  `priv_name` varchar(15) DEFAULT NULL,
  `insert` enum('0','1') DEFAULT '0',
  `update` enum('0','1') DEFAULT '0',
  `delete` enum('0','1') DEFAULT '0',
  `publish` enum('0','1') DEFAULT '0',
  `description` varchar(225) DEFAULT NULL,
  PRIMARY KEY (`priv_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `ca_privileges`
--

INSERT INTO `ca_privileges` (`priv_id`, `priv_name`, `insert`, `update`, `delete`, `publish`, `description`) VALUES
(1, 'administrator', '1', '1', '1', '1', 'all privilages'),
(2, 'admin', '1', '1', '0', '1', 'admin website'),
(3, 'editor', '0', '1', '0', '0', 'editor pages'),
(4, 'publisher', '0', '0', '0', '1', 'publisher page');

-- --------------------------------------------------------

-- --------------------------------------------------------

--
-- Table structure for table `ca_subscribe`
--

CREATE TABLE IF NOT EXISTS `ca_subscribe` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `email` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `ca_subscribe`
--

INSERT INTO `ca_subscribe` (`id`, `email`) VALUES
(1, 'info@codeanalytic.com');

-- --------------------------------------------------------

--
-- Table structure for table `ca_template`
--

CREATE TABLE IF NOT EXISTS `ca_template` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `thumb` varchar(225) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `maker` varchar(100) DEFAULT NULL,
  `description` varchar(300) DEFAULT NULL,
  `order` int(10) DEFAULT NULL,
  `publish` enum('0','1') DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `ca_template`
--

INSERT INTO `ca_template` (`id`, `name`, `thumb`, `date`, `maker`, `description`, `order`, `publish`) VALUES
(1, 'Default', 'preview.jpg', '2012-08-14 00:00:00', 'Aris Sudaryanto\r\n', '\r\nTheme for CodeAnalytic cms is stylish, customizable, simple,\r\nand readable. Make it yours with a custom menu, header image, and background.\r\n You can see much supports widget areas (in the sidebar, footer) and featured images It include inside', 2, '1');

-- --------------------------------------------------------

--
-- Table structure for table `ca_third_party`
--

CREATE TABLE IF NOT EXISTS `ca_third_party` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `title` varchar(30) CHARACTER SET latin1 DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `order` int(5) DEFAULT NULL,
  `publish` enum('0','1') CHARACTER SET latin1 DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `ca_third_party`
--

INSERT INTO `ca_third_party` (`id`, `title`, `date`, `order`, `publish`) VALUES
(1, 'prettyPhoto', '2012-07-25 17:17:43', 2, '1'),
(2, 'calendar', '2012-07-25 17:17:43', 3, '1'),
(3, 'jquery.dropron', '2012-08-12 05:36:09', 0, '1');

-- --------------------------------------------------------

--
-- Table structure for table `ca_users`
--

CREATE TABLE IF NOT EXISTS `ca_users` (
  `user_id` varchar(10) NOT NULL,
  `priv_id` int(3) DEFAULT NULL,
  `username` varchar(30) DEFAULT NULL,
  `password` varchar(45) DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `photo` varchar(100) DEFAULT 'default_ca_thumb_middle.jpg',
  `last_login` datetime DEFAULT NULL,
  `order` int(10) DEFAULT '0',
  `active` enum('0','1') DEFAULT '0',
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ca_users`
--

-- --------------------------------------------------------

--
-- Table structure for table `ca_users_statistic`
--

CREATE TABLE IF NOT EXISTS `ca_users_statistic` (
  `user_id` varchar(15) DEFAULT NULL,
  `date` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ca_users_statistic`
--

-- --------------------------------------------------------

--
-- Table structure for table `ca_widget`
--

CREATE TABLE IF NOT EXISTS `ca_widget` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `order` int(10) DEFAULT NULL,
  `type` enum('0','1') DEFAULT '0',
  `position` enum('1','2','3','4','5','6','7') DEFAULT NULL,
  `id_htmlarea` varchar(15) NOT NULL DEFAULT '0',
  `id_template` varchar(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `ca_widget`
--

INSERT INTO `ca_widget` (`id`, `name`, `order`, `type`, `position`, `id_htmlarea`, `id_template`) VALUES
(1, 'archives_wi', 2, '0', '2', '0', '1'),
(2, 'list_categories_wi', 1, '0', '2', '0', '1');

-- --------------------------------------------------------

--
-- Table structure for table `ca_word_censor`
--

CREATE TABLE IF NOT EXISTS `ca_word_censor` (
  `id` varchar(11) NOT NULL,
  `word` varchar(225) DEFAULT NULL,
  `replace` varchar(225) DEFAULT NULL,
  `order` int(11) DEFAULT '0',
  `publish` enum('1','0') DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ca_word_censor`
--

INSERT INTO `ca_word_censor` (`id`, `word`, `replace`, `order`, `publish`) VALUES
('1347521846', 'fuck', 'f***', 0, '1');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
