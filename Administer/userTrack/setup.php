<?php
include 'dbconfig.php';

$query = array();

$query[] = "CREATE TABLE IF NOT EXISTS `clients` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `domain` varchar(128) NOT NULL,
  `token` varchar(128) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `token` (`token`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 ;";

$query[] = "CREATE TABLE IF NOT EXISTS `clientpage` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` datetime NOT NULL,
  `page` varchar(128) NOT NULL,
  `resolution` varchar(16) NOT NULL,
  `clientid` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `FK_clientpage` FOREIGN KEY (`clientid`) REFERENCES clients(`id`) ON DELETE CASCADE
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 ;";

$query[] = "CREATE TABLE IF NOT EXISTS `clicks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `client` int(11) NOT NULL,
  `data` text NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `FK_clicks` FOREIGN KEY (`client`) REFERENCES clientpage(`id`) ON DELETE CASCADE
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 ;";

$query[] = "CREATE TABLE IF NOT EXISTS `movements` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `client` int(11) NOT NULL,
  `data` text NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  CONSTRAINT `FK_movements` FOREIGN KEY (`client`) REFERENCES clientpage(`id`) ON DELETE CASCADE
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 ;";


$query[] = "CREATE TABLE IF NOT EXISTS `records` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `record` text NOT NULL,
  `client` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `FK_records` FOREIGN KEY (`client`) REFERENCES clientpage(`id`) ON DELETE CASCADE
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 ;";

$query[] = "CREATE TABLE IF NOT EXISTS `partials` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `record` text NOT NULL,
  `client` int(11) NOT NULL UNIQUE,
  PRIMARY KEY (`id`),
  CONSTRAINT `FK_partials` FOREIGN KEY (`client`) REFERENCES clientpage(`id`) ON DELETE CASCADE
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 ;";

$query[] = "CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL UNIQUE,
  `password` varchar(128) NOT NULL,
  `level` tinyint(3) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 ;";

$query[] = "CREATE TABLE IF NOT EXISTS `access` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `domain` varchar(128) NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `FK_access` FOREIGN KEY (`userid`) REFERENCES users(`id`) ON DELETE CASCADE
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 ;";

$query[] = "INSERT IGNORE INTO `users` (`id`, `name`, `password`, `level`) VALUES
(1, 'admin', '0d107d09f5bbe40cade3de5c71e9e9b7', 5);";

$query[] = "CREATE TABLE IF NOT EXISTS `limits` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `domain` varchar(128) NOT NULL,
  `record_limit` int(11) NOT NULL DEFAULT '1000',
  PRIMARY KEY (`id`),
  UNIQUE KEY `domain` (`domain`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;";

foreach($query as $q){
    $db->query($q);
}

header("location:autoConfig.php");
?>
