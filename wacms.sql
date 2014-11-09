-- phpMyAdmin SQL Dump
-- version 2.11.11.3
-- http://www.phpmyadmin.net
--
-- Host: 172.16.3.64
-- Generation Time: Mar 22, 2014 at 03:00 PM
-- Server version: 5.0.83
-- PHP Version: 5.3.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `wacms`
--

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE IF NOT EXISTS `wacms_events` (
  `event_id` int(10) unsigned NOT NULL,
  `published` tinyint(1) NOT NULL,
  `allow_html` tinyint(1) NOT NULL,
  `event_date` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `event_title` varchar(255) NOT NULL,
  `event_lead_in` text NOT NULL,
  `event_description` text NOT NULL,
  PRIMARY KEY  (`event_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `galleries`
--

CREATE TABLE IF NOT EXISTS `wacms_galleries` (
  `gallery_id` int(10) unsigned NOT NULL,
  `created` datetime NOT NULL,
  `gallery_name` text NOT NULL,
  PRIMARY KEY  (`gallery_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `gallery_images`
--

CREATE TABLE IF NOT EXISTS `wacms_gallery_images` (
  `image_order` int(11) NOT NULL,
  `gallery_id` int(11) NOT NULL,
  `modified` datetime NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `title` text NOT NULL,
  `caption` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `navigation`
--

CREATE TABLE IF NOT EXISTS `wacms_navigation` (
  `title` text NOT NULL,
  `url` text NOT NULL,
  `order` smallint(6) NOT NULL,
  `active` int(1) NOT NULL,
  KEY `order` (`order`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE IF NOT EXISTS `wacms_news` (
  `news_id` int(10) unsigned NOT NULL,
  `published` tinyint(1) NOT NULL,
  `allow_html` tinyint(1) NOT NULL,
  `publish_date` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `news_headline` varchar(255) NOT NULL,
  `news_lead_in` varchar(1024) default NULL,
  `news_story` text,
  PRIMARY KEY  (`news_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE IF NOT EXISTS `wacms_pages` (
  `page_id` int(11) NOT NULL,
  `allow_html` tinyint(1) NOT NULL,
  `page_title` text NOT NULL,
  `page_url` text NOT NULL,
  `page_lead_in` text NOT NULL,
  `page_text` text NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY  (`page_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
