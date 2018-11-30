CREATE TABLE IF NOT EXISTS `posts` ( 
`id` INT NOT NULL AUTO_INCREMENT , 
`title` VARCHAR(100) NOT NULL , 
`author` VARCHAR(100) NOT NULL , 
`content` TEXT NOT NULL , 
`created` DATETIME NOT NULL , 
`modified` DATETIME NOT NULL , 
`image` VARCHAR(512) NOT NULL , 
`category_id` INT(11) NOT NULL , 
PRIMARY KEY (`id`)) ENGINE = InnoDB;


INSERT INTO `posts` (`title`, `author`, `content`, `created`, `modified`, `image`, `category_id`) VALUES
('tit1', 'author1', 'content1', '2014-06-01 00:35:07', '2014-05-30 17:34:33', '818f9b0291a0571449ef33e913e831828f74248f-ic_launcher.jpg', 1),
('tit2', 'author2', 'content2', '2014-06-01 00:35:07', '2014-05-30 17:34:33', '66602e1a7cce07485df0598a10fadfb24b9e0ab0-cube-3319359_960_720.jpg', 2),
('tit3', 'author3', 'content3', '2014-06-01 00:35:07', '2014-05-30 17:34:54', '858843bcd6e2bb100f025f0fb52800c15d3ac25b-color-degradado-fondos-degradados-multicolor-51200-670x410.jpg', 3);


CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(256) NOT NULL,
  `created` datetime NOT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

INSERT INTO `categories` (`id`, `name`, `created`, `modified`) VALUES
(1, 'Fashion', '2014-06-01 00:35:07', '2014-05-30 17:34:33'),
(2, 'Electronics', '2014-06-01 00:35:07', '2014-05-30 17:34:33'),
(3, 'Motors', '2014-06-01 00:35:07', '2014-05-30 17:34:54');