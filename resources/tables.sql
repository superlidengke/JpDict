--查询过的词
CREATE TABLE IF NOT EXISTS `query_word` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `meaning_id` char(32) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='查询过的词' AUTO_INCREMENT=1 ;
--html的简单解释
CREATE TABLE IF NOT EXISTS `simple_html_meaning` (
  `id` char(32) NOT NULL,
  `meaning` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='html的简单解释';