-- phpMyAdmin SQL Dump
-- version 4.2.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 19, 2014 at 11:04 AM
-- Server version: 5.5.24-log
-- PHP Version: 5.3.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `wohligco_eventgap`
--

-- --------------------------------------------------------

--
-- Table structure for table `accesslevel`
--

CREATE TABLE IF NOT EXISTS `accesslevel` (
`id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `accesslevel`
--

INSERT INTO `accesslevel` (`id`, `name`) VALUES
(1, 'admin'),
(3, 'customer'),
(2, 'organizer');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
`id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `parent` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `parent`, `status`) VALUES
(1, 'category1', 0, 1),
(3, 'category2', 0, 2);

-- --------------------------------------------------------

--
-- Table structure for table `discountcoupon`
--

CREATE TABLE IF NOT EXISTS `discountcoupon` (
`id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `amount` double NOT NULL,
  `percent` double NOT NULL,
  `couponcode` varchar(255) NOT NULL,
  `starttime` time NOT NULL,
  `endtime` time NOT NULL,
  `minimumticket` double NOT NULL,
  `maximumticket` double NOT NULL,
  `userperuser` int(11) NOT NULL,
  `ticketevent` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `discountcoupon`
--

INSERT INTO `discountcoupon` (`id`, `name`, `amount`, `percent`, `couponcode`, `starttime`, `endtime`, `minimumticket`, `maximumticket`, `userperuser`, `ticketevent`) VALUES
(1, 'discount', 0, 2, 'ABC', '10:00:00', '16:00:00', 4, 12, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE IF NOT EXISTS `event` (
`id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `locationlat` double DEFAULT NULL,
  `locationlon` double DEFAULT NULL,
  `venue` varchar(255) DEFAULT NULL,
  `startdate` date DEFAULT NULL,
  `enddate` date DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `listingtype` int(11) DEFAULT NULL,
  `showremainingticket` int(11) DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `alias` varchar(255) DEFAULT NULL,
  `organizer` varchar(255) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=42 ;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`id`, `title`, `locationlat`, `locationlon`, `venue`, `startdate`, `enddate`, `description`, `listingtype`, `showremainingticket`, `logo`, `location`, `alias`, `organizer`) VALUES
(1, 'demo', 2.3, 3.5, 'Parel', '2014-05-13', '2014-05-15', 'demo', 1, 1, 'img/keynotes.jpg', 'dombivili', 'dom', '1'),
(8, 'abcdef', 11, 12, 'mumbai', '2014-05-13', '2014-05-16', 'abcdefg', 1, 1, 'img/keynotes.jpg', 'kurla', 'demo', '2'),
(9, 'jhj', NULL, NULL, 'oiuo', '0000-00-00', '0000-00-00', 'jhkjl', 0, 0, 'img/keynotes.jpg', 'iouoi', 'hjh', '1'),
(10, 'fdkjshf', NULL, NULL, 'hfjkdf', '0000-00-00', '0000-00-00', 'dlkfj;asdkjf', 1, 0, 'img/keynotes.jpg', 'hjjk', 'kfhjlks', NULL),
(11, 'kdfdf', NULL, NULL, 'fasd', '2014-07-08', '2014-07-02', 'kjhelijrhwe', 1, 0, 'img/keynotes.jpg', 'thane', 'demo', NULL),
(12, 'Kapil Sharma', NULL, NULL, 'Dindoshi', '0000-00-00', '0000-00-00', 'Comedy nights comedy show', 2, 0, 'img/keynotes.jpg', 'Goregaon', 'Comedy nyts', '1'),
(13, 'Kapil Sharma', NULL, NULL, 'Dindoshi', '0000-00-00', '0000-00-00', 'Comedy nights comedy show', 2, 0, 'img/keynotes.jpg', 'Goregaon', 'Comedy nyts', NULL),
(14, 'Kapil Sharma', NULL, NULL, 'Dindoshi', '0000-00-00', '0000-00-00', 'Comedy nights comedy show', 2, 0, 'img/keynotes.jpg', 'Goregaon', 'Comedy nyts', NULL),
(15, 'Kapil Sharma', NULL, NULL, 'Dindoshi', '0000-00-00', '0000-00-00', 'Comedy nights comedy show', 2, 0, 'img/keynotes.jpg', 'Goregaon', 'Comedy nyts', NULL),
(16, 'Kapil Sharma', NULL, NULL, 'Dindoshi', '0000-00-00', '0000-00-00', 'Comedy nights comedy show', 2, 0, 'img/keynotes.jpg', 'Goregaon', 'Comedy nyts', NULL),
(17, 'lkfjsdlk', NULL, NULL, 'dlkfjal', '0000-00-00', '0000-00-00', 'fadfawsdfasdf', 2, 0, 'img/keynotes.jpg', 'dkfjas', 'kdjfalks', NULL),
(18, 'lkdfjo', NULL, NULL, 'kjhk', '0000-00-00', '0000-00-00', 'jhkj', 2, 0, 'img/keynotes.jpg', 'kjhjh', 'kjk', '14'),
(20, 'datetesting', NULL, NULL, 'kjhkjh', '0000-00-00', '0000-00-00', 'jhkjh', 2, 0, 'img/keynotes.jpg', 'kjhjk', 'kjk', '14'),
(21, 'testin', 0, 0, 'kjhkjh', '0000-00-00', '0000-00-00', 'jhkjh', 2, 0, 'img/keynotes.jpg', 'kjhjk', 'kjk', '14'),
(22, 'testing', 0, 0, 'kjhkjh', '0000-00-00', '0000-00-00', 'hkjh', 2, 0, 'img/keynotes.jpg', 'hkj', 'hjkhj', ''),
(23, 'testing', NULL, NULL, 'kjhkjh', '0000-00-00', '0000-00-00', 'hkjh', 2, 0, 'img/keynotes.jpg', 'hkj', 'hjkhj', ''),
(24, 'Indian Idol', 0, 0, 'Goregaon', '0000-00-00', '0000-00-00', 'Hello12', 2, 0, 'img/keynotes.jpg', 'Film city', 'Anupam', '14'),
(25, 'Testing preview', 0, 0, 'kjhlkjh', '0000-00-00', '0000-00-00', 'jhgjhg', 2, 0, 'img/keynotes.jpg', 'hkjh', 'jkhlkjh', '17'),
(26, 'ab', NULL, NULL, 'kh', '0000-00-00', '0000-00-00', 'hgh', 1, 0, 'img/keynotes.jpg', 'jhj', 'kjhjkh', '17'),
(27, 'Event', 0, 0, 'Demo', '2013-12-31', '2014-12-30', 'event description', 1, 0, 'img/keynotes.jpg', 'Loca', 'alisa', '17'),
(28, 'lhafksd', 0, 0, '', '2014-07-11', '2014-07-11', '', 0, 0, 'img/keynotes.jpg', 'thane', '', '17'),
(29, 'ksdhfj', NULL, NULL, '', '0000-00-00', '0000-00-00', '', 0, 0, 'img/keynotes.jpg', 'dombivili', '', '17'),
(30, 'dfjlksd', NULL, NULL, '', '0000-00-00', '0000-00-00', '', 0, 0, 'img/keynotes.jpg', 'karjat', '', '17'),
(31, 'kdlhfk', NULL, NULL, '', '0000-00-00', '0000-00-00', '', 0, 0, 'img/keynotes.jpg', 'thane', '', '17'),
(32, 'khkjh', NULL, NULL, '', '0000-00-00', '0000-00-00', '', 0, 0, 'img/keynotes.jpg', 'thane', 'kjhkj', '17'),
(33, 'fasdf', NULL, NULL, '', '0000-00-00', '0000-00-00', '', 0, 0, 'img/keynotes.jpg', 'lklk', '', '17'),
(34, 'ojf', NULL, NULL, '', '0000-00-00', '0000-00-00', '', 0, 0, 'img/keynotes.jpg', 'asdfa', 'oih;io', '17'),
(35, 'kfajsdkfaj', NULL, NULL, '', '0000-00-00', '0000-00-00', '', 0, 0, 'img/keynotes.jpg', 'asdf', 'gjhg', '17'),
(36, 'My Event', NULL, NULL, '', '0000-00-00', '0000-00-00', '', 0, 0, 'img/keynotes.jpg', 'dfa', '', '17'),
(37, 'demo', NULL, NULL, '', '0000-00-00', '0000-00-00', '', 0, 0, 'img/keynotes.jpg', 'sdasd', '', '17'),
(38, 'demo', NULL, NULL, '', '0000-00-00', '0000-00-00', '', 0, 0, 'img/keynotes.jpg', 'sdfa', '', '17'),
(39, 'lkdjflk', 0, 0, '', '2014-07-12', '2014-07-05', '', 0, 0, 'img/keynotes.jpg', 'fsdfsad', '', '17'),
(40, 'Event for Birthday', NULL, NULL, 'Atria Mall', '2013-12-30', '2014-12-31', 'Decsckjk', 2, 0, 'img/keynotes.jpg', 'Goregoan, Mumbai', 'alsi', '19'),
(41, 'mamamm', NULL, NULL, 'mmamam', '2013-12-31', '2014-12-31', 'Demo', 0, 0, 'img/keynotes.jpg', 'mammam', 'mammam', '20');

-- --------------------------------------------------------

--
-- Table structure for table `eventcategory`
--

CREATE TABLE IF NOT EXISTS `eventcategory` (
  `event` int(11) NOT NULL,
  `category` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `eventcategory`
--

INSERT INTO `eventcategory` (`event`, `category`) VALUES
(1, 1),
(8, 7),
(8, 8),
(8, 9),
(10, 3),
(11, 1),
(12, 3),
(13, 3),
(14, 3),
(15, 3),
(16, 3),
(17, 1),
(18, 1),
(19, 1),
(20, 3),
(23, 0),
(22, 0),
(21, 0),
(24, 0),
(26, 3),
(29, 3),
(30, 1),
(30, 3),
(31, 1),
(31, 3),
(27, 1),
(27, 3),
(32, 1),
(32, 3),
(33, 3),
(34, 1),
(35, 3),
(36, 3),
(37, 3),
(38, 3),
(39, 3),
(28, 3),
(40, 1),
(40, 3),
(41, 1),
(41, 3),
(25, 1),
(25, 3);

-- --------------------------------------------------------

--
-- Table structure for table `eventlog`
--

CREATE TABLE IF NOT EXISTS `eventlog` (
`id` int(11) NOT NULL,
  `event` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `eventlog`
--

INSERT INTO `eventlog` (`id`, `event`, `user`, `description`, `timestamp`) VALUES
(1, 1, 1, 'Event Created', '2014-05-12 10:46:24'),
(2, 1, 1, 'Event Edited', '2014-05-12 10:47:43'),
(3, 1, 1, 'Event Category ,Topic updated', '2014-05-12 11:16:19'),
(4, 1, 1, 'Event Category ,Topic updated', '2014-05-12 11:16:51');

-- --------------------------------------------------------

--
-- Table structure for table `eventsponsor`
--

CREATE TABLE IF NOT EXISTS `eventsponsor` (
  `event` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `amountsponsor` double NOT NULL,
  `image` varchar(255) NOT NULL,
  `starttime` datetime NOT NULL,
  `endtime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `eventsponsor`
--

INSERT INTO `eventsponsor` (`event`, `user`, `amountsponsor`, `image`, `starttime`, `endtime`) VALUES
(1, 1, 10000, 'abc.jpg', '2014-07-23 00:00:00', '2014-07-25 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `eventtopic`
--

CREATE TABLE IF NOT EXISTS `eventtopic` (
  `event` int(11) NOT NULL,
  `topic` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `eventtopic`
--

INSERT INTO `eventtopic` (`event`, `topic`) VALUES
(1, 1),
(8, 4),
(8, 5),
(10, 0),
(11, 0),
(12, 3),
(13, 3),
(14, 3),
(15, 3),
(16, 3),
(17, 1),
(18, 1),
(19, 2),
(20, 1),
(23, 0),
(22, 0),
(21, 0),
(24, 2),
(26, 2),
(29, 3),
(30, 1),
(30, 2),
(30, 3),
(31, 1),
(31, 2),
(31, 3),
(27, 1),
(27, 3),
(32, 1),
(33, 2),
(34, 3),
(35, 2),
(36, 2),
(37, 2),
(38, 2),
(39, 2),
(28, 3),
(40, 1),
(40, 3),
(41, 1),
(41, 2),
(41, 3),
(25, 1),
(25, 2);

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE IF NOT EXISTS `menu` (
`id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `keyword` varchar(255) NOT NULL,
  `url` text NOT NULL,
  `linktype` int(11) NOT NULL,
  `parent` int(11) NOT NULL,
  `isactive` int(11) NOT NULL,
  `order` int(11) NOT NULL,
  `icon` varchar(255) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `name`, `description`, `keyword`, `url`, `linktype`, `parent`, `isactive`, `order`, `icon`) VALUES
(1, 'Users', '', '', 'site/viewusers', 1, 0, 1, 1, 'icon-user'),
(2, 'Events', '', '', 'site/viewevents', 1, 0, 1, 2, ' icon-calendar'),
(3, 'Organizer', '', '', 'site/vieworganizers', 1, 0, 1, 3, ' icon-user-md'),
(4, 'Dashboard', '', '', 'site/index', 1, 0, 1, 0, 'icon-dashboard'),
(5, 'Ticket', '', '', 'site/viewticketevent', 1, 0, 1, 4, ' icon-ticket'),
(6, 'Discount Coupon', '', '', 'site/viewdiscountcoupon', 1, 0, 1, 5, 'icon-money'),
(7, 'Category', '', '', 'site/viewcategory', 1, 0, 1, 6, 'icon-book'),
(8, 'Topic', '', '', 'site/viewtopic', 1, 0, 1, 7, ' icon-file-text-alt'),
(9, 'Newsletter', '', '', 'site/viewnewsletter', 1, 0, 1, 8, ' icon-list-alt');

-- --------------------------------------------------------

--
-- Table structure for table `menuaccess`
--

CREATE TABLE IF NOT EXISTS `menuaccess` (
  `menu` int(11) NOT NULL,
  `access` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menuaccess`
--

INSERT INTO `menuaccess` (`menu`, `access`) VALUES
(1, 1),
(4, 1),
(2, 1),
(3, 1),
(5, 1),
(6, 1),
(7, 1),
(7, 3),
(8, 1),
(9, 1);

-- --------------------------------------------------------

--
-- Table structure for table `newsletter`
--

CREATE TABLE IF NOT EXISTS `newsletter` (
`id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE IF NOT EXISTS `order` (
`id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `discountcoupon` int(11) NOT NULL,
  `totalamount` double NOT NULL,
  `paymenttype` int(11) NOT NULL,
  `discountamount` double NOT NULL,
  `finalamount` double NOT NULL,
  `details` varchar(255) NOT NULL,
  `event` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `code` varchar(255) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `orderticket`
--

CREATE TABLE IF NOT EXISTS `orderticket` (
`id` int(11) NOT NULL,
  `order` int(11) NOT NULL,
  `event` int(11) NOT NULL,
  `ticket` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `position` varchar(255) NOT NULL,
  `amount` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `organizer`
--

CREATE TABLE IF NOT EXISTS `organizer` (
`id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `info` varchar(255) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `contact` varchar(255) DEFAULT NULL,
  `user` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `organizer`
--

INSERT INTO `organizer` (`id`, `name`, `description`, `email`, `info`, `website`, `contact`, `user`) VALUES
(1, 'demo', 'demo', 'demo@email.com', 'demo', 'https://www.google.co.in/', '323232', 0),
(2, 'wohlig123', 'abc', 'wohlig@wohlig.com', '1234', 'www.wohlig.com', '8989898989', 5),
(3, 'wohlig1', 'abc', 'wohlig@wohlig.com', '1234', 'wohlig.com', '8989898989', 6),
(4, 'fskdjl', '', '', '', '', '', 7),
(5, '', '', 'abc@gmail.com', '', '', '', 8),
(6, '', '', 'fsd@fas', '', '', '', 9),
(7, NULL, NULL, NULL, NULL, NULL, NULL, 11),
(8, NULL, NULL, NULL, NULL, NULL, NULL, 12),
(9, NULL, NULL, NULL, NULL, NULL, NULL, 13),
(10, NULL, NULL, NULL, NULL, NULL, NULL, 14),
(11, NULL, NULL, NULL, NULL, NULL, NULL, 15),
(12, NULL, NULL, NULL, NULL, NULL, NULL, 17),
(13, NULL, NULL, NULL, NULL, NULL, NULL, 18),
(14, NULL, NULL, NULL, NULL, NULL, NULL, 19),
(15, NULL, NULL, NULL, NULL, NULL, NULL, 20),
(16, NULL, NULL, NULL, NULL, NULL, NULL, 21);

-- --------------------------------------------------------

--
-- Table structure for table `ticketevent`
--

CREATE TABLE IF NOT EXISTS `ticketevent` (
`id` int(11) NOT NULL,
  `event` int(11) NOT NULL,
  `ticket` varchar(255) NOT NULL,
  `tickettype` int(11) NOT NULL,
  `amount` double NOT NULL,
  `ticketname` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `starttime` time NOT NULL,
  `endtime` time NOT NULL,
  `description` varchar(255) NOT NULL,
  `ticketmaxallowed` double NOT NULL,
  `ticketminallowed` double NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `ticketevent`
--

INSERT INTO `ticketevent` (`id`, `event`, `ticket`, `tickettype`, `amount`, `ticketname`, `quantity`, `starttime`, `endtime`, `description`, `ticketmaxallowed`, `ticketminallowed`) VALUES
(1, 1, 'demo', 1, 400, 'demo', 9, '10:00:00', '17:00:00', 'demo', 5, 2);

-- --------------------------------------------------------

--
-- Table structure for table `tickettype`
--

CREATE TABLE IF NOT EXISTS `tickettype` (
`id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tickettype`
--

INSERT INTO `tickettype` (`id`, `name`) VALUES
(1, 'free'),
(2, 'paid'),
(3, 'donation');

-- --------------------------------------------------------

--
-- Table structure for table `topic`
--

CREATE TABLE IF NOT EXISTS `topic` (
`id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `parent` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `topic`
--

INSERT INTO `topic` (`id`, `name`, `parent`, `status`) VALUES
(1, 'Topic1', 0, 1),
(2, 'Topic2', 1, 1),
(3, 'topic3', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
`id` int(11) NOT NULL,
  `firstname` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `website` varchar(255) DEFAULT NULL,
  `description` text,
  `eventinfo` int(11) DEFAULT NULL,
  `contact` varchar(255) DEFAULT NULL,
  `address` text,
  `city` varchar(255) DEFAULT NULL,
  `pincode` int(11) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `accesslevel` int(11) DEFAULT NULL,
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `facebookuserid` varchar(255) DEFAULT NULL,
  `newsletterstatus` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `showwebsite` varchar(255) DEFAULT NULL,
  `eventsheld` varchar(255) DEFAULT NULL,
  `topeventlocation` varchar(255) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `firstname`, `lastname`, `password`, `email`, `website`, `description`, `eventinfo`, `contact`, `address`, `city`, `pincode`, `dob`, `accesslevel`, `timestamp`, `facebookuserid`, `newsletterstatus`, `status`, `logo`, `showwebsite`, `eventsheld`, `topeventlocation`) VALUES
(1, 'wohlig', '', '3e80288355e03166bf584f506c8837d2', 'wohlig@wohlig.com', '', '', 0, '233232', 'dadar', 'Mumbai', 322323, '1991-01-08', 1, '0000-00-00 00:00:00', '0', 0, 1, NULL, NULL, NULL, NULL),
(4, 'pratik', 'shah', '0cb2b62754dfd12b6ed0161d4b447df7', 'pratik@wohlig.com', '', '', 0, '8080209455', 'mulund', 'Mumbai', 400080, '1991-07-01', 1, '2014-05-12 06:52:44', '', 0, 1, NULL, NULL, NULL, NULL),
(5, 'wohlig123', 'tech', 'wohlig123', 'wohlig@wohlig.com', 'www.wohlig.com', 'abc', 1234, '8989898989', 'abcdefg', 'mumbai', 200001, '1991-01-08', 1, '2014-05-12 06:52:44', '2', 2, 1, NULL, NULL, NULL, NULL),
(6, 'wohlig1', 'tech', 'a63526467438df9566c508027d9cb06b', 'wohlig@wohlig.com', 'wohlig.com', 'abc', 1234, '8989898989', 'abcdefg', 'mumbai', 200001, '1991-01-08', 1, '2014-05-12 06:52:44', '2', 2, 1, NULL, NULL, NULL, NULL),
(7, 'fskdjl', '', 'd41d8cd98f00b204e9800998ecf8427e', '', '', '', 0, '', '', '', 0, '0000-00-00', 0, '0000-00-00 00:00:00', '', 0, 0, NULL, NULL, NULL, NULL),
(8, '', '', 'e10adc3949ba59abbe56e057f20f883e', 'abc@gmail.com', '', '', 0, '', '', '', 0, '0000-00-00', 0, '0000-00-00 00:00:00', '', 0, 0, NULL, NULL, NULL, NULL),
(9, '', '', '5ca2aa845c8cd5ace6b016841f100d82', 'fsd@fas', '', '', 0, '', '', '', 0, '0000-00-00', 0, '0000-00-00 00:00:00', '', 0, 0, NULL, NULL, NULL, NULL),
(10, NULL, NULL, '5a5dc3936c05c32e61aa539e7ffb40c0', 'jfhskfaldjs@kdfhakjsdh', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2014-07-12 11:44:08', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(11, NULL, NULL, 'd41d8cd98f00b204e9800998ecf8427e', 'kjhdkjf@dkfjks', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2014-07-12 11:45:41', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(12, NULL, NULL, '900150983cd24fb0d6963f7d28e17f72', 'jfaksdj@dkjfak', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2014-07-12 11:50:43', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(13, NULL, NULL, '47bce5c74f589f4867dbd57e9ca9f808', 'aaa@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2014-07-12 11:58:32', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(14, 'jagrutinew', '', '594f803b380a41396ed63dca39503542', 'aaaa@gmail.com', '', 'testinnew', 1, '', '', '', 0, '0000-00-00', 2, '0000-00-00 00:00:00', '', 0, 0, '', 'false', 'true', 'false'),
(15, NULL, NULL, '594f803b380a41396ed63dca39503542', 'aaaab@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2014-07-17 06:19:44', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(16, NULL, NULL, '0cc175b9c0f1b6a831c399e269772661', 'a@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2014-07-18 08:03:44', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(17, 'abc', '', '187ef4436122d1cc2f40dc2b92f0eba0', 'ab@gmail.com', '', 'name: abc', 1, '', '', '', 0, '0000-00-00', 2, '2014-07-18 12:38:38', '', 0, 0, '', 'true', 'true', ''),
(18, 'aa', '', 'f30aa7a662c728b7407c54ae6bfd27d1', 'dd@dd.com', '', 'aaa', 0, '', '', '', 0, '0000-00-00', 2, '2014-07-18 13:07:08', '', 0, 0, '', '', '', ''),
(19, NULL, NULL, '0192023a7bbd73250516f069df18b500', 'admin@admin.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2014-07-19 08:56:16', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(20, NULL, NULL, 'fe01ce2a7fbac8fafaed7c982a04e229', 'demo@demo.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2014-07-19 09:29:46', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(21, NULL, NULL, 'd16fb36f0911f878998c136191af705e', 'xyz@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2014-07-19 10:07:15', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(22, NULL, NULL, 'db8834197077287186e8c7524ca43d6f', 'vijaya@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2014-07-19 10:17:37', NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `userinterestevents`
--

CREATE TABLE IF NOT EXISTS `userinterestevents` (
  `user` int(11) NOT NULL,
  `event` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `userlog`
--

CREATE TABLE IF NOT EXISTS `userlog` (
`id` int(11) NOT NULL,
  `onuser` int(11) NOT NULL,
  `fromuser` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `userlog`
--

INSERT INTO `userlog` (`id`, `onuser`, `fromuser`, `description`, `timestamp`) VALUES
(1, 1, 1, 'User Address Edited', '2014-05-12 06:50:21'),
(2, 1, 1, 'User Details Edited', '2014-05-12 06:51:43'),
(3, 1, 1, 'User Details Edited', '2014-05-12 06:51:53'),
(4, 4, 1, 'User Created', '2014-05-12 06:52:44'),
(5, 4, 1, 'User Address Edited', '2014-05-12 12:31:48');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accesslevel`
--
ALTER TABLE `accesslevel`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `discountcoupon`
--
ALTER TABLE `discountcoupon`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `event`
--
ALTER TABLE `event`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `eventlog`
--
ALTER TABLE `eventlog`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `newsletter`
--
ALTER TABLE `newsletter`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orderticket`
--
ALTER TABLE `orderticket`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `organizer`
--
ALTER TABLE `organizer`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ticketevent`
--
ALTER TABLE `ticketevent`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tickettype`
--
ALTER TABLE `tickettype`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `topic`
--
ALTER TABLE `topic`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `userlog`
--
ALTER TABLE `userlog`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accesslevel`
--
ALTER TABLE `accesslevel`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `discountcoupon`
--
ALTER TABLE `discountcoupon`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `event`
--
ALTER TABLE `event`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=42;
--
-- AUTO_INCREMENT for table `eventlog`
--
ALTER TABLE `eventlog`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `newsletter`
--
ALTER TABLE `newsletter`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `orderticket`
--
ALTER TABLE `orderticket`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `organizer`
--
ALTER TABLE `organizer`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `ticketevent`
--
ALTER TABLE `ticketevent`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tickettype`
--
ALTER TABLE `tickettype`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `topic`
--
ALTER TABLE `topic`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `userlog`
--
ALTER TABLE `userlog`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
