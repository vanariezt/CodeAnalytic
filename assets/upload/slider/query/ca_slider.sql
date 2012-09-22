
CREATE TABLE IF NOT EXISTS `ca_slider` (
  `id` varchar(10) NOT NULL,
  `title` varchar(100) DEFAULT NULL,
  `target` varchar(15) DEFAULT NULL,
  `image` varchar(500) DEFAULT NULL,
  `video` varchar(500) DEFAULT NULL,
  `description` varchar(500) DEFAULT NULL,
  `url` varchar(300) DEFAULT NULL,
  `attr_id` varchar(20) DEFAULT NULL,
  `attr_class` varchar(20) DEFAULT NULL,
  `publish` enum('1','0') DEFAULT '0',
  `order` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;