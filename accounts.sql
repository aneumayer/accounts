--
-- Table structure for table `account`
--

DROP TABLE IF EXISTS `account`;
CREATE TABLE `account` (
  `id` smallint(6) NOT NULL AUTO_INCREMENT,
  `folder_id` smallint(6) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `start_balance` decimal(10,0) NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_7D3656A4162CB942` (`folder_id`),
  CONSTRAINT `FK_7D3656A4162CB942` FOREIGN KEY (`folder_id`) REFERENCES `folder` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Table structure for table `folder`
--

DROP TABLE IF EXISTS `folder`;
CREATE TABLE `folder` (
  `id` smallint(6) NOT NULL AUTO_INCREMENT,
  `user_id` smallint(6) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_ECA209CDA76ED395` (`user_id`),
  CONSTRAINT `FK_ECA209CDA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Table structure for table `transaction`
--

DROP TABLE IF EXISTS `transaction`;
CREATE TABLE `transaction` (
  `id` smallint(6) NOT NULL AUTO_INCREMENT,
  `account_id` smallint(6) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `amount` decimal(10,0) NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_723705D19B6B5FBA` (`account_id`),
  CONSTRAINT `FK_723705D19B6B5FBA` FOREIGN KEY (`account_id`) REFERENCES `account` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` smallint(6) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date_created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
