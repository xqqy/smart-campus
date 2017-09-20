-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: 2017-09-20 21:18:26
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
-- 表的结构 `ABUSH`
--

CREATE TABLE `ABUSH` (
  `CMD` char(30) CHARACTER SET utf8 NOT NULL COMMENT '指令',
  `FAS` char(255) CHARACTER SET utf8 NOT NULL COMMENT '指令执行后打开的页面',
  `HELP` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT 'SORRY<br />NO HELP FOT THIS COMMAND!' COMMENT '指令帮助'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `ABUSH`
--

INSERT INTO `ABUSH` (`CMD`, `FAS`, `HELP`) VALUES
('admin', 'app/admin/', '注册管理员账户'),
('reg', 'app/reg/', '批量注册账户'),
('unadmin', 'app/unadmin/', '注销管理员账户'),
('unreg', 'app/unreg/', '批量删除账户'),
('xs', 'app/xs/', '添加学时\r\n');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ABUSH`
--
ALTER TABLE `ABUSH`
  ADD PRIMARY KEY (`CMD`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
