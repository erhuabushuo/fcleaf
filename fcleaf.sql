-- phpMyAdmin SQL Dump
-- version 3.5.2
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2012 年 12 月 15 日 14:17
-- 服务器版本: 5.5.25a
-- PHP 版本: 5.4.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `fcleaf`
--

-- --------------------------------------------------------

--
-- 表的结构 `articles`
--

CREATE TABLE IF NOT EXISTS `articles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `summary` text NOT NULL,
  `clicked_num` int(11) NOT NULL,
  `is_recommended` tinyint(1) NOT NULL,
  `img` varchar(255) NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_articles_category` (`category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- 转存表中的数据 `articles`
--

INSERT INTO `articles` (`id`, `category_id`, `title`, `summary`, `clicked_num`, `is_recommended`, `img`, `created_at`, `updated_at`) VALUES
(1, 7, '测试文章标题', '<p>\r\n	测试文章内容<img alt="sad" height="20" src="http://localhost/assets/js/ckeditor/plugins/smiley/images/sad_smile.gif" title="sad" width="20" /></p>\r\n', 0, 1, '9f261c413b9f39205233412362725c11.gif', 1353853636, 1355233453),
(2, 7, '我的测试啊', '<p>\r\n	我的测试啊</p>\r\n', 0, 1, '', 1355233395, 1355233448),
(3, 7, '测试文章标题1', '<p>\r\n	测试文章标题1</p>\r\n', 0, 1, '7486f333bf7e2000531942d4828f9146.jpg', 1355233487, 1355233495),
(4, 7, '蜡笔小心', '<p>\r\n	蜡笔小心蜡笔小心</p>\r\n', 0, 0, 'baf60aedfcc497004355a779a6f754b2.jpg', 1355233679, 1355233687),
(5, 7, '蜡笔小心', '<p>\r\n	蜡笔小心</p>\r\n', 0, 0, 'ce3ebbb52d3b0b4f53123ae0d3fb461c.jpg', 1355233813, 1355233813);

-- --------------------------------------------------------

--
-- 表的结构 `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `struct` varchar(255) DEFAULT NULL,
  `order` int(11) NOT NULL DEFAULT '0',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- 转存表中的数据 `categories`
--

INSERT INTO `categories` (`id`, `pid`, `type`, `title`, `struct`, `order`, `created_at`, `updated_at`) VALUES
(1, 0, 0, '一级分类', '1', 0, 1354720489, 1354720489),
(2, 0, 0, '一级分类', '2', 0, 1354720489, 1354720489),
(3, 1, 0, '二级分类', '1-1', 0, 1354720489, 1354720489),
(4, 2, 0, '二级分类', '2-2', 0, 1354720489, 1354720489),
(5, 3, 0, '三级分类', '1-1-3', 0, 1354720489, 1354720489),
(6, 5, 0, '四级分类', '1-1-3-5', 0, 1354720489, 1354720489),
(7, 6, 0, '五级分类', '1-1-3-5-7', 1, 0, 1355056584),
(8, 4, 0, '三级分类', '2-2-8', 0, 1355027869, 1355027869);

-- --------------------------------------------------------

--
-- 表的结构 `migration`
--

CREATE TABLE IF NOT EXISTS `migration` (
  `type` varchar(25) NOT NULL,
  `name` varchar(50) NOT NULL,
  `migration` varchar(100) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `migration`
--

INSERT INTO `migration` (`type`, `name`, `migration`) VALUES
('app', 'default', '001_create_users'),
('app', 'default', '002_create_articles'),
('app', 'default', '003_upgrade'),
('app', 'default', '004_create_categories'),
('app', 'default', '005_create_products');

-- --------------------------------------------------------

--
-- 表的结构 `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `group` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `last_login` int(11) NOT NULL,
  `login_hash` varchar(255) NOT NULL,
  `profile_fields` text NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `group`, `email`, `last_login`, `login_hash`, `profile_fields`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'YWqmPGH+dOEvOh6pf83a62lzJ1QQLHRMPHhNIaohB3s=', 100, 'erhuabushuo@gmail.com', 1355577141, 'e05c63eedf18dbfb287ae8d982ac073b6b097ad4', 'a:0:{}', 1352641423, 0);

--
-- 限制导出的表
--

--
-- 限制表 `articles`
--
ALTER TABLE `articles`
  ADD CONSTRAINT `fk_articles_category` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
