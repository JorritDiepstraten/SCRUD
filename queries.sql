DROP TABLE IF EXISTS `it_companies`;

CREATE TABLE `it_companies` (
  `company_id` int(11) unsigned NOT NULL auto_increment,
  `rank` int(11) unsigned NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `industries` varchar(255) NOT NULL,
  `revenue` float(9,2) NOT NULL,
  `fiscal_year` year(4) NOT NULL,
  `employees` int(11) unsigned NOT NULL,
  `market_cap` float(9,2) NOT NULL,
  `headquarters` varchar(255) NOT NULL,
  PRIMARY KEY  (`company_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

LOCK TABLES `it_companies` WRITE;

INSERT INTO `it_companies` (`company_id`, `rank`, `company_name`, `industries`, `revenue`, `fiscal_year`, `employees`, `market_cap`, `headquarters`)
VALUES
  (1,1,'Samsung Electronics','Mobile Devices, Semiconductor, Personal Computing',212.68,'2013',326000,137.91,'Seoul, South Korea'),
  (2,2,'Apple Inc.','Mobile Devices, Personal Computing, Consumer software',182.79,'2014',98000,616.59,'Cupertino, CA, USA (Silicon Valley)'),
  (3,3,'Foxconn','OEM Component Manufacturing',132.07,'2013',1290000,32.15,'New Taipei, Taiwan'),
  (4,4,'HP','Personal Computing and Servers, Consulting',111.45,'2014',317500,65.30,'Palo Alto, CA, USA (Silicon Valley)'),
  (5,5,'IBM','Computing services, Mainframes',99.75,'2013',433362,188.21,'Armonk, NY, USA'),
  (6,6,'Amazon.com','Internet Retailer, App Hosting',88.99,'2014',154100,175.22,'Seattle, WA, USA'),
  (7,7,'Microsoft','Business computing',86.83,'2014',128076,370.31,'Redmond, WA, USA'),
  (8,8,'Sony','Electronic Devices, Personal Computing',72.34,'2014',146300,17.60,'Tokyo, Japan'),
  (9,9,'Panasonic','Electronics Devices & Components',70.83,'2013',293742,22.70,'Osaka, Japan'),
  (10,10,'Google','Internet Advertising, Search Engine, Miscellaneous',59.82,'2013',53546,396.24,'Mountain View, CA, USA (Silicon Valley)'),
  (11,11,'Dell','Personal Computers and Servers',56.94,'2013',108800,22.97,'Austin, TX, USA'),
  (12,12,'Toshiba','Semiconductor, Consumer devices',56.20,'2013',206087,17.67,'Tokyo, Japan'),
  (13,13,'LG Electronics','Personal Computer, Electronics',54.75,'2013',38718,17.67,'Seoul, South Korea'),
  (14,14,'Intel','Semiconductor',52.70,'2013',104700,168.48,'Santa Clara, CA, USA (Silicon Valley)');

UNLOCK TABLES;