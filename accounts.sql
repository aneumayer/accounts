--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` SMALLINT(6) NOT NULL AUTO_INCREMENT,
  `first_name` VARCHAR(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` VARCHAR(255) COLLATE utf8_unicode_ci NOT NULL,
  `username` VARCHAR(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` VARCHAR(255) COLLATE utf8_unicode_ci NOT NULL,
  `date_created` DATETIME NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Table structure for table `folders`
--

DROP TABLE IF EXISTS `folders`;
CREATE TABLE `folders` (
  `id` SMALLINT(6) NOT NULL AUTO_INCREMENT,
  `user_id` SMALLINT(6) NOT NULL,
  `name` VARCHAR(255) COLLATE utf8_unicode_ci NOT NULL,
  `date` DATETIME NOT NULL,
  PRIMARY KEY (`id`),
  KEY (`user_id`),
  CONSTRAINT fk_user FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Table structure for table `account_types`
--

DROP TABLE IF EXISTS `account_types`;
CREATE TABLE `account_types` (
  `id` SMALLINT(6) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
INSERT INTO `account_types` (`id`, `name`) VALUES (1, 'Checking');
INSERT INTO `account_types` (`id`, `name`) VALUES (2, 'Savings');
INSERT INTO `account_types` (`id`, `name`) VALUES (3, 'Credit Card');

--
-- Table structure for table `accounts`
--

DROP TABLE IF EXISTS `accounts`;
CREATE TABLE `accounts` (
  `id` SMALLINT(6) NOT NULL AUTO_INCREMENT,
  `folder_id` SMALLINT(6) NOT NULL,
  `name` VARCHAR(255) COLLATE utf8_unicode_ci NOT NULL,
  `account_type_id` SMALLINT(6) NOT NULL,
  `start_balance` decimal(10,0) NOT NULL,
  `date` DATETIME NOT NULL,
  PRIMARY KEY (`id`),
  KEY (`folder_id`),
  KEY (`account_type_id`),
  CONSTRAINT fk_folder FOREIGN KEY (`folder_id`) REFERENCES `folders` (`id`),
  CONSTRAINT fk_account_type FOREIGN KEY (`account_type_id`) REFERENCES `account_types` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Table structure for table `transaction_types`
--

DROP TABLE IF EXISTS `transaction_types`;
CREATE TABLE `transaction_types` (
  `id` SMALLINT(6) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) COLLATE utf8_unicode_ci NOT NULL,
  `modifier` TINYINT(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
INSERT INTO `transaction_types` (`id`, `name`, `modifier`) VALUES (1, 'Deposit', '1');
INSERT INTO `transaction_types` (`id`, `name`, `modifier`) VALUES (2, 'Withdrawal', '-1');
INSERT INTO `transaction_types` (`id`, `name`, `modifier`) VALUES (3, 'Transfer', '-1');
INSERT INTO `transaction_types` (`id`, `name`, `modifier`) VALUES (4, 'Check', '-1');
INSERT INTO `transaction_types` (`id`, `name`, `modifier`) VALUES (5, 'Credit Card', '-1');
INSERT INTO `transaction_types` (`id`, `name`, `modifier`) VALUES (6, 'Online Payment', '-1');

--
-- Table structure for table `transaction_categories`
--

DROP TABLE IF EXISTS `transaction_categories`;
CREATE TABLE `transaction_categories` (
  `id` SMALLINT(6) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
INSERT INTO `transaction_categories` (`id`, `name`) VALUES (1, 'Income');
INSERT INTO `transaction_categories` (`id`, `name`) VALUES (2, 'Transfer');
INSERT INTO `transaction_categories` (`id`, `name`) VALUES (3, 'Credit Card Payment');
INSERT INTO `transaction_categories` (`id`, `name`) VALUES (4, 'Other Bill');
INSERT INTO `transaction_categories` (`id`, `name`) VALUES (5, 'Water Bill');
INSERT INTO `transaction_categories` (`id`, `name`) VALUES (6, 'Power Bill');
INSERT INTO `transaction_categories` (`id`, `name`) VALUES (7, 'Internet');
INSERT INTO `transaction_categories` (`id`, `name`) VALUES (8, 'Cell Phone');
INSERT INTO `transaction_categories` (`id`, `name`) VALUES (9, 'Rent');
INSERT INTO `transaction_categories` (`id`, `name`) VALUES (10, 'Insurance');
INSERT INTO `transaction_categories` (`id`, `name`) VALUES (11, 'Health Insurance');
INSERT INTO `transaction_categories` (`id`, `name`) VALUES (12, 'Gas');
INSERT INTO `transaction_categories` (`id`, `name`) VALUES (13, 'Eating Out');
INSERT INTO `transaction_categories` (`id`, `name`) VALUES (14, 'Other Expenses');
INSERT INTO `transaction_categories` (`id`, `name`) VALUES (15, 'Groceries and Target');

--
-- Table structure for table `transactions`
--

DROP TABLE IF EXISTS `transactions`;
CREATE TABLE `transactions` (
  `id` SMALLINT(6) NOT NULL AUTO_INCREMENT,
  `account_id` SMALLINT(6) NOT NULL,
  `name` VARCHAR(255) COLLATE utf8_unicode_ci NOT NULL,
  `amount` DECIMAL(10,0) NOT NULL,
  `transaction_type_id` SMALLINT(6) NOT NULL,
  `transaction_category_id` SMALLINT(6) NOT NULL,
  `date` DATETIME NOT NULL,
  PRIMARY KEY (`id`),
  KEY (`account_id`),
  KEY (`transaction_type_id`),
  KEY (`transaction_category_id`),
  CONSTRAINT fk_account FOREIGN KEY (`account_id`) REFERENCES `accounts` (`id`),
  CONSTRAINT fk_transaction_type FOREIGN KEY (`transaction_type_id`) REFERENCES `transaction_types` (`id`),
  CONSTRAINT fk_transaction_category FOREIGN KEY (`transaction_category_id`) REFERENCES `transaction_categories` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
