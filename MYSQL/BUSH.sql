-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: 2017-09-20 21:18:35
-- 服务器版本： 5.7.19-0ubuntu0.16.04.1
-- PHP Version: 7.0.22-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `MAIN`
--

-- --------------------------------------------------------

--
-- 表的结构 `BUSH`
--

CREATE TABLE `BUSH` (
  `CMD` char(30) CHARACTER SET utf8 NOT NULL COMMENT '指令',
  `FAS` char(255) CHARACTER SET utf8 NOT NULL COMMENT '指令执行后打开的页面',
  `HELP` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT 'SORRY<NO HELP FOT THIS COMMAND!' COMMENT '指令帮助'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `BUSH`
--

INSERT INTO `BUSH` (`CMD`, `FAS`, `HELP`) VALUES
('cid', '/zhfz/admin/app/cid.php', '更改你的5位学号'),
('eggs', '/zhfz/admin/app/eggs', '彩蛋'),
('name', '/zhfz/admin/app/name.php', '更改你的姓名'),
('xs', 'app/xs.php', '使用授权码添加学时'),
('zyfz', '/zhfz/admin/app/zyfz.php', '查看你的志愿者学时');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `BUSH`
--
ALTER TABLE `BUSH`
  ADD PRIMARY KEY (`CMD`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
