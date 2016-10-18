-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 18, 2016 at 08:01 AM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 7.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dev_v1`
--
CREATE DATABASE IF NOT EXISTS `dev_v1` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `dev_v1`;

-- --------------------------------------------------------

--
-- Table structure for table `answers`
--

CREATE TABLE `answers` (
  `aid` int(20) NOT NULL,
  `qid` int(20) NOT NULL,
  `answered_user` varchar(20) NOT NULL,
  `answer` text NOT NULL,
  `marked` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `answers`
--

INSERT INTO `answers` (`aid`, `qid`, `answered_user`, `answer`, `marked`) VALUES
(162, 11, 'zuul', '<p>Hi</p>', 1),
(163, 12, 'zuul', '<p>Hello</p>', 0),
(164, 19, 'zuul', '<p>$_POST</p>', 1),
(165, 20, 'zuul', '<p style="margin-bottom: 1em; padding: 0px; border: 0px; font-size: 15px; clear: both; color: rgb(36, 39, 41); font-family: Arial, &quot;Helvetica Neue&quot;, Helvetica, sans-serif;">Is there an SQL injection possibility even when using&nbsp;<code style="margin: 0px; padding: 1px 5px; border: 0px; font-size: 13px; font-family: Consolas, Menlo, Monaco, &quot;Lucida Console&quot;, &quot;Liberation Mono&quot;, &quot;DejaVu Sans Mono&quot;, &quot;Bitstream Vera Sans Mono&quot;, &quot;Courier New&quot;, monospace, sans-serif; background-color: rgb(239, 240, 241); white-space: pre-wrap;">mysql_real_escape_string()</code>&nbsp;function?</p><p style="margin-bottom: 1em; padding: 0px; border: 0px; font-size: 15px; clear: both; color: rgb(36, 39, 41); font-family: Arial, &quot;Helvetica Neue&quot;, Helvetica, sans-serif;">Consider this sample situation. SQL is constructed in PHP like this:</p><pre class="default prettyprint prettyprinted" style="margin-bottom: 1em; padding: 5px; border-width: 0px; border-style: initial; border-color: initial; width: auto; max-height: 600px; font-family: Consolas, Menlo, Monaco, &quot;Lucida Console&quot;, &quot;Liberation Mono&quot;, &quot;DejaVu Sans Mono&quot;, &quot;Bitstream Vera Sans Mono&quot;, &quot;Courier New&quot;, monospace, sans-serif; background-color: rgb(239, 240, 241); color: rgb(57, 51, 24); word-wrap: normal;"><code style="margin: 0px; border: 0px; font-size: 13px; font-family: Consolas, Menlo, Monaco, &quot;Lucida Console&quot;, &quot;Liberation Mono&quot;, &quot;DejaVu Sans Mono&quot;, &quot;Bitstream Vera Sans Mono&quot;, &quot;Courier New&quot;, monospace, sans-serif; background-color: rgb(239, 240, 241); white-space: inherit;"><span class="pln" style="margin: 0px; padding: 0px; border: 0px; color: rgb(48, 51, 54);">$login </span><span class="pun" style="margin: 0px; padding: 0px; border: 0px; color: rgb(48, 51, 54);">=</span><span class="pln" style="margin: 0px; padding: 0px; border: 0px; color: rgb(48, 51, 54);"> mysql_real_escape_string</span><span class="pun" style="margin: 0px; padding: 0px; border: 0px; color: rgb(48, 51, 54);">(</span><span class="typ" style="margin: 0px; padding: 0px; border: 0px; color: rgb(43, 145, 175);">GetFromPost</span><span class="pun" style="margin: 0px; padding: 0px; border: 0px; color: rgb(48, 51, 54);">(</span><span class="str" style="margin: 0px; padding: 0px; border: 0px; color: rgb(125, 39, 39);">''login''</span><span class="pun" style="margin: 0px; padding: 0px; border: 0px; color: rgb(48, 51, 54);">));</span><span class="pln" style="margin: 0px; padding: 0px; border: 0px; color: rgb(48, 51, 54);">\n$password </span><span class="pun" style="margin: 0px; padding: 0px; border: 0px; color: rgb(48, 51, 54);">=</span><span class="pln" style="margin: 0px; padding: 0px; border: 0px; color: rgb(48, 51, 54);"> mysql_real_escape_string</span><span class="pun" style="margin: 0px; padding: 0px; border: 0px; color: rgb(48, 51, 54);">(</span><span class="typ" style="margin: 0px; padding: 0px; border: 0px; color: rgb(43, 145, 175);">GetFromPost</span><span class="pun" style="margin: 0px; padding: 0px; border: 0px; color: rgb(48, 51, 54);">(</span><span class="str" style="margin: 0px; padding: 0px; border: 0px; color: rgb(125, 39, 39);">''password''</span><span class="pun" style="margin: 0px; padding: 0px; border: 0px; color: rgb(48, 51, 54);">));</span><span class="pln" style="margin: 0px; padding: 0px; border: 0px; color: rgb(48, 51, 54);">\n\n$sql </span><span class="pun" style="margin: 0px; padding: 0px; border: 0px; color: rgb(48, 51, 54);">=</span><span class="pln" style="margin: 0px; padding: 0px; border: 0px; color: rgb(48, 51, 54);"> </span><span class="str" style="margin: 0px; padding: 0px; border: 0px; color: rgb(125, 39, 39);">"SELECT * FROM table WHERE login=''$login'' AND password=''$password''"</span><span class="pun" style="margin: 0px; padding: 0px; border: 0px; color: rgb(48, 51, 54);">;</span></code></pre><p style="margin-bottom: 1em; padding: 0px; border: 0px; font-size: 15px; clear: both; color: rgb(36, 39, 41); font-family: Arial, &quot;Helvetica Neue&quot;, Helvetica, sans-serif;">I have heard numerous people say to me that a code like that is still dangerous and possible to hack even with&nbsp;<code style="margin: 0px; padding: 1px 5px; border: 0px; font-size: 13px; font-family: Consolas, Menlo, Monaco, &quot;Lucida Console&quot;, &quot;Liberation Mono&quot;, &quot;DejaVu Sans Mono&quot;, &quot;Bitstream Vera Sans Mono&quot;, &quot;Courier New&quot;, monospace, sans-serif; background-color: rgb(239, 240, 241); white-space: pre-wrap;">mysql_real_escape_string()</code>&nbsp;function used. But I cannot think of any possible exploit?</p><p style="margin-bottom: 1em; padding: 0px; border: 0px; font-size: 15px; clear: both; color: rgb(36, 39, 41); font-family: Arial, &quot;Helvetica Neue&quot;, Helvetica, sans-serif;">Classic injections like this:</p><pre class="default prettyprint prettyprinted" style="margin-bottom: 1em; padding: 5px; border-width: 0px; border-style: initial; border-color: initial; width: auto; max-height: 600px; font-family: Consolas, Menlo, Monaco, &quot;Lucida Console&quot;, &quot;Liberation Mono&quot;, &quot;DejaVu Sans Mono&quot;, &quot;Bitstream Vera Sans Mono&quot;, &quot;Courier New&quot;, monospace, sans-serif; background-color: rgb(239, 240, 241); color: rgb(57, 51, 24); word-wrap: normal;"><code style="margin: 0px; border: 0px; font-size: 13px; font-family: Consolas, Menlo, Monaco, &quot;Lucida Console&quot;, &quot;Liberation Mono&quot;, &quot;DejaVu Sans Mono&quot;, &quot;Bitstream Vera Sans Mono&quot;, &quot;Courier New&quot;, monospace, sans-serif; background-color: rgb(239, 240, 241); white-space: inherit;"><span class="pln" style="margin: 0px; padding: 0px; border: 0px; color: rgb(48, 51, 54);">aaa</span><span class="str" style="margin: 0px; padding: 0px; border: 0px; color: rgb(125, 39, 39);">'' OR 1=1 --</span></code></pre><p style="margin-bottom: 1em; padding: 0px; border: 0px; font-size: 15px; clear: both; color: rgb(36, 39, 41); font-family: Arial, &quot;Helvetica Neue&quot;, Helvetica, sans-serif;">do not work.</p><p style="margin-bottom: 1em; padding: 0px; border: 0px; font-size: 15px; clear: both; color: rgb(36, 39, 41); font-family: Arial, &quot;Helvetica Neue&quot;, Helvetica, sans-serif;">Do you know of any possible injection that would get through the PHP code above?</p>', 1),
(166, 15, 'zuul', '<p><span style="color: rgb(51, 51, 51);">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</span></p><div><span style="color: rgb(51, 51, 51);"><br></span></div>', 1),
(167, 12, 'ravitejamajeti', '<p>Heello</p><p>&nbsp;&nbsp;&nbsp;&nbsp;</p><p>&nbsp;</p>', 1),
(168, 15, 'ravitejamajeti', '<p><span style="color: rgb(51, 51, 51);">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</span></p>', 0),
(169, 11, 'ravitejamajeti', '<p>askdkasd</p>', 0),
(170, 11, 'ravitejamajeti', '<p><br></p><p>sdf</p><p>&nbsp; &nbsp;&nbsp;</p><p>&nbsp; &nbsp;</p><p>&nbsp;&nbsp;</p><p>&nbsp;</p><p>&nbsp; &nbsp; &nbsp;&nbsp;</p>', 0);

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `qid` int(20) NOT NULL,
  `qnd_user` varchar(20) NOT NULL,
  `question_title` text NOT NULL,
  `question` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`qid`, `qnd_user`, `question_title`, `question`) VALUES
(11, 'ravitejamajeti', 'Title1', 'Description1'),
(12, 'ravitejamajeti', 'Title2', 'Description2'),
(13, 'ravitejamajeti', 'Title3', 'Description3'),
(14, 'ravitejamajeti', 'Title4', 'Description4'),
(15, 'ravitejamajeti', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum'),
(16, 'ravitejamajeti', 'aklsjdalsd', 'llskjdlaskd'),
(17, 'ravitejamajeti', 'This is a drop table question and we are just posting this for testing', '--!drop tables;'),
(18, 'ravitejamajeti', 'Summernote 1', ' Summernote 1 '),
(19, 'zuul', '$_POST', '<p>$_POST</p>'),
(20, 'zuul', 'Hi', '<p>Hi</p>'),
(21, 'zuul', 'szjda', '$result'),
(22, 'zuul', 'szjda', '<p style="margin-bottom: 1em; padding: 0px; border: 0px; font-size: 15px; clear: both; color: rgb(36, 39, 41); font-family: Arial, &quot;Helvetica Neue&quot;, Helvetica, sans-serif;">Is there an SQL injection possibility even when using&nbsp;<code style="margin: 0px; padding: 1px 5px; border: 0px; font-size: 13px; font-family: Consolas, Menlo, Monaco, &quot;Lucida Console&quot;, &quot;Liberation Mono&quot;, &quot;DejaVu Sans Mono&quot;, &quot;Bitstream Vera Sans Mono&quot;, &quot;Courier New&quot;, monospace, sans-serif; background-color: rgb(239, 240, 241); white-space: pre-wrap;">mysql_real_escape_string()</code>&nbsp;function?</p><p style="margin-bottom: 1em; padding: 0px; border: 0px; font-size: 15px; clear: both; color: rgb(36, 39, 41); font-family: Arial, &quot;Helvetica Neue&quot;, Helvetica, sans-serif;">Consider this sample situation. SQL is constructed in PHP like this:</p><pre class="default prettyprint prettyprinted" style="margin-bottom: 1em; padding: 5px; border-width: 0px; border-style: initial; border-color: initial; width: auto; max-height: 600px; font-family: Consolas, Menlo, Monaco, &quot;Lucida Console&quot;, &quot;Liberation Mono&quot;, &quot;DejaVu Sans Mono&quot;, &quot;Bitstream Vera Sans Mono&quot;, &quot;Courier New&quot;, monospace, sans-serif; background-color: rgb(239, 240, 241); color: rgb(57, 51, 24); word-wrap: normal;"><code style="margin: 0px; border: 0px; font-size: 13px; font-family: Consolas, Menlo, Monaco, &quot;Lucida Console&quot;, &quot;Liberation Mono&quot;, &quot;DejaVu Sans Mono&quot;, &quot;Bitstream Vera Sans Mono&quot;, &quot;Courier New&quot;, monospace, sans-serif; background-color: rgb(239, 240, 241); white-space: inherit;"><span class="pln" style="margin: 0px; padding: 0px; border: 0px; color: rgb(48, 51, 54);">$login </span><span class="pun" style="margin: 0px; padding: 0px; border: 0px; color: rgb(48, 51, 54);">=</span><span class="pln" style="margin: 0px; padding: 0px; border: 0px; color: rgb(48, 51, 54);"> mysql_real_escape_string</span><span class="pun" style="margin: 0px; padding: 0px; border: 0px; color: rgb(48, 51, 54);">(</span><span class="typ" style="margin: 0px; padding: 0px; border: 0px; color: rgb(43, 145, 175);">GetFromPost</span><span class="pun" style="margin: 0px; padding: 0px; border: 0px; color: rgb(48, 51, 54);">(</span><span class="str" style="margin: 0px; padding: 0px; border: 0px; color: rgb(125, 39, 39);">''login''</span><span class="pun" style="margin: 0px; padding: 0px; border: 0px; color: rgb(48, 51, 54);">));</span><span class="pln" style="margin: 0px; padding: 0px; border: 0px; color: rgb(48, 51, 54);">\r\n$password </span><span class="pun" style="margin: 0px; padding: 0px; border: 0px; color: rgb(48, 51, 54);">=</span><span class="pln" style="margin: 0px; padding: 0px; border: 0px; color: rgb(48, 51, 54);"> mysql_real_escape_string</span><span class="pun" style="margin: 0px; padding: 0px; border: 0px; color: rgb(48, 51, 54);">(</span><span class="typ" style="margin: 0px; padding: 0px; border: 0px; color: rgb(43, 145, 175);">GetFromPost</span><span class="pun" style="margin: 0px; padding: 0px; border: 0px; color: rgb(48, 51, 54);">(</span><span class="str" style="margin: 0px; padding: 0px; border: 0px; color: rgb(125, 39, 39);">''password''</span><span class="pun" style="margin: 0px; padding: 0px; border: 0px; color: rgb(48, 51, 54);">));</span><span class="pln" style="margin: 0px; padding: 0px; border: 0px; color: rgb(48, 51, 54);">\r\n\r\n$sql </span><span class="pun" style="margin: 0px; padding: 0px; border: 0px; color: rgb(48, 51, 54);">=</span><span class="pln" style="margin: 0px; padding: 0px; border: 0px; color: rgb(48, 51, 54);"> </span><span class="str" style="margin: 0px; padding: 0px; border: 0px; color: rgb(125, 39, 39);">"SELECT * FROM table WHERE login=''$login'' AND password=''$password''"</span><span class="pun" style="margin: 0px; padding: 0px; border: 0px; color: rgb(48, 51, 54);">;</span></code></pre><p style="margin-bottom: 1em; padding: 0px; border: 0px; font-size: 15px; clear: both; color: rgb(36, 39, 41); font-family: Arial, &quot;Helvetica Neue&quot;, Helvetica, sans-serif;">I have heard numerous people say to me that a code like that is still dangerous and possible to hack even with&nbsp;<code style="margin: 0px; padding: 1px 5px; border: 0px; font-size: 13px; font-family: Consolas, Menlo, Monaco, &quot;Lucida Console&quot;, &quot;Liberation Mono&quot;, &quot;DejaVu Sans Mono&quot;, &quot;Bitstream Vera Sans Mono&quot;, &quot;Courier New&quot;, monospace, sans-serif; background-color: rgb(239, 240, 241); white-space: pre-wrap;">mysql_real_escape_string()</code>&nbsp;function used. But I cannot think of any possible exploit?</p><p style="margin-bottom: 1em; padding: 0px; border: 0px; font-size: 15px; clear: both; color: rgb(36, 39, 41); font-family: Arial, &quot;Helvetica Neue&quot;, Helvetica, sans-serif;">Classic injections like this:</p><pre class="default prettyprint prettyprinted" style="margin-bottom: 1em; padding: 5px; border-width: 0px; border-style: initial; border-color: initial; width: auto; max-height: 600px; font-family: Consolas, Menlo, Monaco, &quot;Lucida Console&quot;, &quot;Liberation Mono&quot;, &quot;DejaVu Sans Mono&quot;, &quot;Bitstream Vera Sans Mono&quot;, &quot;Courier New&quot;, monospace, sans-serif; background-color: rgb(239, 240, 241); color: rgb(57, 51, 24); word-wrap: normal;"><code style="margin: 0px; border: 0px; font-size: 13px; font-family: Consolas, Menlo, Monaco, &quot;Lucida Console&quot;, &quot;Liberation Mono&quot;, &quot;DejaVu Sans Mono&quot;, &quot;Bitstream Vera Sans Mono&quot;, &quot;Courier New&quot;, monospace, sans-serif; background-color: rgb(239, 240, 241); white-space: inherit;"><span class="pln" style="margin: 0px; padding: 0px; border: 0px; color: rgb(48, 51, 54);">aaa</span><span class="str" style="margin: 0px; padding: 0px; border: 0px; color: rgb(125, 39, 39);">'' OR 1=1 --</span></code></pre><p style="margin-bottom: 1em; padding: 0px; border: 0px; font-size: 15px; clear: both; color: rgb(36, 39, 41); font-family: Arial, &quot;Helvetica Neue&quot;, Helvetica, sans-serif;">do not work.</p><p style="margin-bottom: 1em; padding: 0px; border: 0px; font-size: 15px; clear: both; color: rgb(36, 39, 41); font-family: Arial, &quot;Helvetica Neue&quot;, Helvetica, sans-serif;">Do you know of any possible injection that would get through the PHP code above?</p>'),
(25, 'rstantz', '  ', '<p>&nbsp;&nbsp;</p>'),
(26, 'admin', '', '<p>&nbsp; &nbsp;&nbsp;</p>'),
(27, 'admin', '', '<p>&nbsp; &nbsp;&nbsp;</p>'),
(28, 'admin', '', '<p>&nbsp; &nbsp;</p>'),
(29, 'admin', 'asdasda', '<p>dfdsfdsf</p>'),
(30, 'admin', '', ''),
(31, 'admin', '', ''),
(32, 'admin', '', ''),
(33, 'admin', '', ''),
(34, 'admin', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_name` varchar(20) NOT NULL,
  `password` varchar(100) NOT NULL,
  `user_role` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_name`, `password`, `user_role`) VALUES
('ravitejamajeti', '10crores', NULL),
('staypuft', 'm@r$hM@ll0w', NULL),
('admin', 'cs518pa$$', NULL),
('jbrunelle', 'M0n@rch$', NULL),
('pvenkman', 'imadoctor', NULL),
('dbarrett', 'dbarrett', NULL),
('ltully', '<!--<i>', NULL),
('janine', '--!drop tables;', NULL),
('winston', 'zeddM0r3', NULL),
('gozer', 'd3$truct0R', NULL),
('slimer', 'f33dM3', NULL),
('zuul', '105"; DROP TABLE', NULL),
('keymaster', 'n0D@na', NULL),
('gatekeeper', '$l0r', NULL),
('rstantz', '"; INSERT INTO Customers (CustomerName,Address,City) Values(@0,@1,@2); --', NULL),
('dbarrett', 'fr1ed3GGS', NULL),
('espengler', 'don''t cross the streams', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `answers`
--
ALTER TABLE `answers`
  ADD PRIMARY KEY (`aid`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`qid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `answers`
--
ALTER TABLE `answers`
  MODIFY `aid` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=171;
--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `qid` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
