-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: 2017-09-12 22:06:57
-- 服务器版本： 5.7.19-0ubuntu0.16.04.1
-- PHP Version: 7.0.22-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

# `push`@`localhost` 的权限

GRANT USAGE ON *.* TO 'push'@'localhost';

GRANT SELECT, INSERT, UPDATE, DELETE ON `PUSH`.* TO 'push'@'localhost';


