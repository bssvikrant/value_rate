-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 19, 2016 at 09:34 AM
-- Server version: 5.5.46-0ubuntu0.14.04.2
-- PHP Version: 5.5.9-1ubuntu4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `value_rate`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE IF NOT EXISTS `admins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `full_name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(250) NOT NULL,
  `password` varchar(255) NOT NULL,
  `admin_img` varchar(255) NOT NULL,
  `status` int(2) NOT NULL,
  `type` varchar(255) NOT NULL COMMENT '''0=>superadmin'',''1=>Subadmin''',
  `date_added` datetime NOT NULL,
  `last_login` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=38 ;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `full_name`, `username`, `email`, `password`, `admin_img`, `status`, `type`, `date_added`, `last_login`) VALUES
(1, 'Emma Watson', 'admin', 'rahul.jain@betasoftsystems.com', '21232f297a57a5a743894a0e4a801fc3', '5CQtVd9Znao4wHs.jpg', 1, '0', '2015-01-16 00:00:00', '2016-02-19 05:07:15');

-- --------------------------------------------------------

--
-- Table structure for table `admins_i18n`
--

CREATE TABLE IF NOT EXISTS `admins_i18n` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `locale` varchar(6) NOT NULL,
  `model` varchar(255) NOT NULL,
  `foreign_key` int(10) NOT NULL,
  `field` varchar(255) NOT NULL,
  `content` text,
  PRIMARY KEY (`id`),
  UNIQUE KEY `I18N_LOCALE_FIELD` (`locale`,`model`,`foreign_key`,`field`),
  KEY `I18N_FIELD` (`model`,`foreign_key`,`field`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `admins_i18n`
--

INSERT INTO `admins_i18n` (`id`, `locale`, `model`, `foreign_key`, `field`, `content`) VALUES
(1, 'de_DE', 'Admins', 1, 'full_name', 'Emma Watson g'),
(2, 'de', 'Admins', 1, 'full_name', 'Emma Watson g');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(11) NOT NULL DEFAULT '1',
  `description` text COLLATE utf8_unicode_ci,
  `date_added` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `title`, `slug`, `image`, `status`, `description`, `date_added`, `modified`) VALUES
(2, 'Sports Crads', 'shoes', '0ACi724ptXOTxwV.jpg', 1, '<p>&nbsp;Sports Crads</p>', '2013-11-05 13:39:09', '2015-05-15 08:21:59');

-- --------------------------------------------------------

--
-- Table structure for table `categories_i18n`
--

CREATE TABLE IF NOT EXISTS `categories_i18n` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `locale` varchar(6) NOT NULL,
  `model` varchar(255) NOT NULL,
  `foreign_key` int(10) NOT NULL,
  `field` varchar(255) NOT NULL,
  `content` text,
  PRIMARY KEY (`id`),
  UNIQUE KEY `I18N_LOCALE_FIELD` (`locale`,`model`,`foreign_key`,`field`),
  KEY `I18N_FIELD` (`model`,`foreign_key`,`field`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `categories_i18n`
--

INSERT INTO `categories_i18n` (`id`, `locale`, `model`, `foreign_key`, `field`, `content`) VALUES
(4, 'de_DE', 'Categories', 2, 'title', 'Sports Crads ger'),
(5, 'de_DE', 'Categories', 2, 'slug', 'shoes'),
(6, 'de_DE', 'Categories', 2, 'description', '<p> Sports Crads</p>');

-- --------------------------------------------------------

--
-- Table structure for table `cms_pages`
--

CREATE TABLE IF NOT EXISTS `cms_pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pagename` varchar(255) DEFAULT NULL,
  `pageheading` text NOT NULL,
  `pagecontent` text NOT NULL,
  `pageurl` varchar(100) NOT NULL,
  `link` varchar(255) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `phone_no` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `status` int(2) NOT NULL DEFAULT '1',
  `meta_title` varchar(255) NOT NULL,
  `meta_keywords` text NOT NULL,
  `meta_description` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `cms_pages`
--

INSERT INTO `cms_pages` (`id`, `pagename`, `pageheading`, `pagecontent`, `pageurl`, `link`, `company_name`, `phone_no`, `email`, `location`, `status`, `meta_title`, `meta_keywords`, `meta_description`) VALUES
(1, 'Terms & Conditions', '', '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages Ipsum. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages Ipsum.<br /><br /><span style="font-size: medium;"><strong>1. Contrary to popular belief, Lorem</strong></span><br /><br />&nbsp;&nbsp;&nbsp; <strong>1. Lorem Ipsum is simply dummy</strong> text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages Ipsum. <br />&nbsp;&nbsp;&nbsp; <br />&nbsp;&nbsp;&nbsp; <strong>2. Lorem Ipsum is simply dummy</strong> text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages Ipsum. <br />&nbsp;&nbsp;&nbsp; <br />&nbsp;&nbsp;&nbsp;<strong> 3. Lorem Ipsum is simply dummy</strong> text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages Ipsum.</p>\r\n<p><span style="font-size: medium;"><strong>2. It is a long established fact that</strong></span><br />&nbsp;&nbsp;&nbsp; <br />&nbsp;&nbsp;&nbsp; <strong>1. industry. Lorem Ipsum has been the industry''s</strong> standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. Ipsum. <br />&nbsp;&nbsp;&nbsp; <br />&nbsp;&nbsp;&nbsp;<strong> 2. It is a long established fact that a</strong> reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using ''Content here, content here'', making it look like readable English. <br />&nbsp;&nbsp;&nbsp; <br />&nbsp;&nbsp;&nbsp; <strong>3. Lorem Ipsum is simply dummy</strong> text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages Ipsum. <br style="text-align: justify;" /></p>', 'terms', 'Home/cms/terms', '', '0', '', '', 1, 'Live3Times - Terms & Conditions', 'Terms & Conditions', 'Terms & Conditions'),
(4, 'About Us', '', '<h2 class="title_head">Welcome to Sitter Guide</h2>\r\n<p>Test Sitter Guide content.&nbsp;</p>\r\n<p class="strong">*Subject to Terms and Conditions*</p>', 'about-us sp', 'Homes/cms/about_us', 'Beta Soft Systems Pvt Ltd', '0', '', '', 1, 'Live3Times - About Us', 'About Us', 'About Us'),
(6, 'Privacy Policy', '', '<p><span style="font-size: medium;"><strong style="font-size: medium;">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</strong></span><br /><br />Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages Ipsum. Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College Ipsum.<br /><br /><span style="font-size: medium;"><strong>There are many variations of passages of Lorem Ipsum available, but the majority</strong></span><br /><br />Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word <br /><br />in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section<br /><br /><span style="font-size: medium;"><strong>There are many variations of passages of Lorem Ipsum available, but the majority</strong></span><br /><br />It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using ''Content here, content here'', making it look like readable English. <br /><br />It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using ''Content here, content here'', making it look like readable English. <br style="text-align: justify;" /></p>', 'privacy', 'Home/cms/privacy', '', '0', '', '', 0, 'Live3Times - Privacy Policy', 'Privacy Policy', 'Privacy Policy'),
(7, 'Contact Us', '', '', 'contact-us', 'Home/contact-us', 'Beta Soft Systems Pvt Ltd ', '0172 467 7163', 'info@betasofttrainings.com', 'Sco 398 Sector - 20 Panchkula, Haryana 134116', 1, 'Live3Times - Contact Us', 'Contact Us', 'Contact Us');

-- --------------------------------------------------------

--
-- Table structure for table `cms_pages_i18n`
--

CREATE TABLE IF NOT EXISTS `cms_pages_i18n` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `locale` varchar(6) NOT NULL,
  `model` varchar(255) NOT NULL,
  `foreign_key` int(10) NOT NULL,
  `field` varchar(255) NOT NULL,
  `content` text,
  PRIMARY KEY (`id`),
  UNIQUE KEY `I18N_LOCALE_FIELD` (`locale`,`model`,`foreign_key`,`field`),
  KEY `I18N_FIELD` (`model`,`foreign_key`,`field`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `cms_pages_i18n`
--

INSERT INTO `cms_pages_i18n` (`id`, `locale`, `model`, `foreign_key`, `field`, `content`) VALUES
(1, 'de_DE', 'CmsPages', 4, 'pagename', 'About Us ger'),
(2, 'de_DE', 'CmsPages', 4, 'pagecontent', '<h2 class="title_head">Welcome to Sitter Guide</h2>\r\n<p>Test Sitter Guide content.&nbsp;</p>\r\n<p class="strong">*Subject to Terms and Conditions*</p>');

-- --------------------------------------------------------

--
-- Table structure for table `contact_requests`
--

CREATE TABLE IF NOT EXISTS `contact_requests` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone_no` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `reply` text NOT NULL COMMENT 'Message reply',
  `reply_status` int(11) NOT NULL DEFAULT '0' COMMENT '0=> No Reply, 1=>Reply  sent',
  `date_added` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `contact_requests`
--

INSERT INTO `contact_requests` (`id`, `name`, `email`, `phone_no`, `country`, `subject`, `message`, `reply`, `reply_status`, `date_added`) VALUES
(3, 'Sukhdev', 'sukhdev@betasoftsystems.com', '646464564', 'fhfhf', 'fghfghgfh', 'fhfghfghgfhgfhg j ifgdgd gdghdfjghdfjghdfj h jhg jhgjghfj hgj hgjhgfj hgj hgjh j hjgh jhj hgjfhgfjghdj h jgh jhg jghjghdjghgjhgjhgjdh j j jghghdfjgh jghj gh jhgj hgjfhgjdh jgjhfj h', '<p><span style="font-family: Arial,Helvetica,sans-serif;"> </span></p>\r\n<table style="border-collapse: collapse; border-spacing: 0; background-color: #f8f8f8; padding: 0;" border="0" cellspacing="0" cellpadding="0" align="center">\r\n<tbody>\r\n<tr style="height: 36px;" height="36">\r\n<td style="width: 30px; background-color: #33628a;" width="30" valign="middle"><span style="background-color: #33628a;">&nbsp;</span></td>\r\n<td style="width: 500px; background-color: #33628a;" width="500" valign="middle"><span style="color: #ffffff; font-size: medium;"><strong>Sitter Guide</strong></span></td>\r\n<td style="width: 30px; background-color: #33628a;" width="30" valign="middle"><span style="background-color: #33628a;">&nbsp;</span></td>\r\n</tr>\r\n<tr>\r\n<td style="height: 20px;" colspan="3" valign="top"><br /></td>\r\n</tr>\r\n<tr>\r\n<td style="width: 30px;" width="30" valign="top"><br /></td>\r\n<td style="width: 500px;" width="500" valign="top"><span style="font-family: Arial,Helvetica,sans-serif;"> \r\n<table style="border-collapse: collapse; border-spacing: 0; padding: 0;" border="0" cellspacing="0" cellpadding="0" width="499" height="108" align="left">\r\n<tbody>\r\n<tr>\r\n<td valign="top">Hello Sukhdev,</td>\r\n</tr>\r\n<tr>\r\n<td style="height: 25px;" valign="top"><br /></td>\r\n</tr>\r\n<tr>\r\n<td valign="top">\r\n<p>Hello good day.</p>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</span></td>\r\n<td style="width: 30px;" width="30" valign="top"><br /></td>\r\n</tr>\r\n<tr>\r\n<td style="height: 20px;" colspan="3" valign="top"><br /></td>\r\n</tr>\r\n<tr>\r\n<td style="width: 30px; background-color: #eeeeee;" width="30" valign="top"><br /></td>\r\n<td style="background-color: #eeeeee; padding: 15px 0;" valign="top"><span style="background-color: #eeeeee;"><span style="font-family: Arial,Helvetica,sans-serif;"> \r\n<table style="border-collapse: collapse; border-spacing: 0; text-align: justify; padding: 0;" border="0" cellspacing="0" cellpadding="0" align="left">\r\n<tbody>\r\n<tr>\r\n<td style="width: 500px; height: 20px;" width="500" valign="top">\r\n<p style="font-weight: bold;">Regards,<br /> Team Sitter Guide</p>\r\n<p style="font-weight: bold;"><br /><span style="font-weight: bold;">Note</span>: This is a system generated email, please do not reply</p>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</span> </span></td>\r\n<td style="width: 30px; background-color: #eeeeee;" width="30" valign="top"><span style="background-color: #eeeeee;">&nbsp;</span></td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<p><span style="font-family: Arial,Helvetica,sans-serif;"> </span></p>', 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `contact_requests_i18n`
--

CREATE TABLE IF NOT EXISTS `contact_requests_i18n` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `locale` varchar(6) NOT NULL,
  `model` varchar(255) NOT NULL,
  `foreign_key` int(10) NOT NULL,
  `field` varchar(255) NOT NULL,
  `content` text,
  PRIMARY KEY (`id`),
  UNIQUE KEY `I18N_LOCALE_FIELD` (`locale`,`model`,`foreign_key`,`field`),
  KEY `I18N_FIELD` (`model`,`foreign_key`,`field`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `email_templates`
--

CREATE TABLE IF NOT EXISTS `email_templates` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `alias` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `allowed_vars` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `email_from` varchar(250) NOT NULL,
  `email_name` varchar(255) NOT NULL,
  `status` int(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=27 ;

--
-- Dumping data for table `email_templates`
--

INSERT INTO `email_templates` (`id`, `title`, `alias`, `subject`, `allowed_vars`, `description`, `email_from`, `email_name`, `status`) VALUES
(1, 'Admin Reset Password', 'admin_forgot_password', 'Sitter Guide- Admin Reset Password', '{user},{new_password}', '<p><span style="font-family: Arial,Helvetica,sans-serif;"> </span></p>\n<table style="border-collapse: collapse; border-spacing: 0; background-color: #f8f8f8; padding: 0;" border="0" cellspacing="0" cellpadding="0" align="center">\n<tbody>\n<tr style="height: 36px;" height="36">\n<td style="width: 30px; background-color: #33628a;" width="30" valign="middle"><span style="background-color: #33628a;">&nbsp;</span></td>\n<td style="width: 500px; background-color: #33628a;" width="500" valign="middle"><span style="background-color: #33628a;"><span style="color: white; font-size: small;"><strong>Sitter Guide - Reset Password</strong></span></span></td>\n<td style="width: 30px; background-color: #33628a;" width="30" valign="middle"><span style="background-color: #33628a;">&nbsp;</span></td>\n</tr>\n<tr>\n<td style="height: 20px;" colspan="3" valign="top"><br /></td>\n</tr>\n<tr>\n<td style="width: 30px;" width="30" valign="top"><br /></td>\n<td style="width: 500px;" width="500" valign="top"><span style="font-family: Arial,Helvetica,sans-serif;"> \n<table style="border-collapse: collapse; border-spacing: 0; padding: 0;" border="0" cellspacing="0" cellpadding="0" width="499" height="108" align="left">\n<tbody>\n<tr>\n<td valign="top">\n<p>Hello {user},</p>\n<p>&nbsp;</p>\n</td>\n</tr>\n<tr>\n<td style="height: 25px;" valign="top">You have requested for reset your password, Kindly review the below details</td>\n</tr>\n<tr>\n<td valign="top">\n<p>Your new password is : {new_password}</p>\nYou can log in using this new password.</td>\n</tr>\n</tbody>\n</table>\n</span></td>\n<td style="width: 30px;" width="30" valign="top"><br /></td>\n</tr>\n<tr>\n<td style="height: 20px;" colspan="3" valign="top"><br /></td>\n</tr>\n<tr>\n<td style="width: 30px; background-color: #eeeeee;" width="30" valign="top"><br /></td>\n<td style="background-color: #eeeeee; padding: 15px 0;" valign="top"><span style="background-color: #eeeeee;"><span style="font-family: Arial,Helvetica,sans-serif;"> \n<table style="border-collapse: collapse; border-spacing: 0; text-align: justify; padding: 0;" border="0" cellspacing="0" cellpadding="0" align="left">\n<tbody>\n<tr>\n<td style="width: 500px; height: 20px;" width="500" valign="top">\n<p style="font-weight: bold;">Regards,<br /> Team Sitter Guide</p>\n<p style="font-weight: bold;"><span style="font-family: Arial; font-size: xx-small; font-weight: normal;">Notice: The information in this email and in any attachments is confidential and intended solely for the attention and use of the named addressee. This information may be subject to legal professional or other privilege or may otherwise be protected by work product immunity or other legal rules. It must not be disclosed to any person without authorization. If you are not the intended recipient, or a person responsible for delivering it to the intended recipient, you are not authorized to and must not disclose, copy, distribute, or retain this message or any part of it.</span></p>\n</td>\n</tr>\n</tbody>\n</table>\n</span> </span></td>\n<td style="width: 30px; background-color: #eeeeee;" width="30" valign="top"><span style="background-color: #eeeeee;">&nbsp;</span></td>\n</tr>\n</tbody>\n</table>\n<p><span style="font-family: Arial,Helvetica,sans-serif;"> </span></p>', 'noreply@sitterguide.com', 'Sitter Guide', 1),
(2, 'Contact Request Reply', 'reply_contact', 'Sitter Guidde : Contact Request Reply ', '{to_name}, {content}', '<p><span style="font-family: Arial,Helvetica,sans-serif;"> </span></p>\n<table style="border-collapse: collapse; border-spacing: 0; background-color: #f8f8f8; padding: 0;" border="0" cellspacing="0" cellpadding="0" align="center">\n<tbody>\n<tr style="height: 36px;" height="36">\n<td style="width: 30px; background-color: #33628a;" width="30" valign="middle"><span style="background-color: #33628a;">&nbsp;</span></td>\n<td style="width: 500px; background-color: #33628a;" width="500" valign="middle"><span style="color: #ffffff; font-size: medium;"><strong>Sitter Guide</strong></span></td>\n<td style="width: 30px; background-color: #33628a;" width="30" valign="middle"><span style="background-color: #33628a;">&nbsp;</span></td>\n</tr>\n<tr>\n<td style="height: 20px;" colspan="3" valign="top"><br /></td>\n</tr>\n<tr>\n<td style="width: 30px;" width="30" valign="top"><br /></td>\n<td style="width: 500px;" width="500" valign="top"><span style="font-family: Arial,Helvetica,sans-serif;"> \n<table style="border-collapse: collapse; border-spacing: 0; padding: 0;" border="0" cellspacing="0" cellpadding="0" width="499" height="108" align="left">\n<tbody>\n<tr>\n<td valign="top">Hello {to_name},</td>\n</tr>\n<tr>\n<td style="height: 25px;" valign="top"><br /></td>\n</tr>\n<tr>\n<td valign="top">\n<p>{content}</p>\n</td>\n</tr>\n</tbody>\n</table>\n</span></td>\n<td style="width: 30px;" width="30" valign="top"><br /></td>\n</tr>\n<tr>\n<td style="height: 20px;" colspan="3" valign="top"><br /></td>\n</tr>\n<tr>\n<td style="width: 30px; background-color: #eeeeee;" width="30" valign="top"><br /></td>\n<td style="background-color: #eeeeee; padding: 15px 0;" valign="top"><span style="background-color: #eeeeee;"><span style="font-family: Arial,Helvetica,sans-serif;"> \n<table style="border-collapse: collapse; border-spacing: 0; text-align: justify; padding: 0;" border="0" cellspacing="0" cellpadding="0" align="left">\n<tbody>\n<tr>\n<td style="width: 500px; height: 20px;" width="500" valign="top">\n<p style="font-weight: bold;">Regards,<br /> Team Sitter Guide</p>\n<p style="font-weight: bold;"><br /><span style="font-weight: bold;">Note</span>: This is a system generated email, please do not reply</p>\n</td>\n</tr>\n</tbody>\n</table>\n</span> </span></td>\n<td style="width: 30px; background-color: #eeeeee;" width="30" valign="top"><span style="background-color: #eeeeee;">&nbsp;</span></td>\n</tr>\n</tbody>\n</table>\n<p><span style="font-family: Arial,Helvetica,sans-serif;"> </span></p>', 'noreply@sitterguide.com', 'Sitter Guide', 0),
(21, 'Account Activated', 'account_activated', 'Sitter Guide- Account Activated', '{full_name}', '<p><span style="font-family: Arial,Helvetica,sans-serif;"> </span></p>\r\n<table style="border-collapse: collapse; border-spacing: 0; background-color: #f8f8f8; padding: 0;" border="0" cellspacing="0" cellpadding="0" align="center">\r\n<tbody>\r\n<tr style="height: 36px;" height="36">\r\n<td style="width: 30px; background-color: #33628a;" width="30" valign="middle"><span style="background-color: #33628a;">&nbsp;</span></td>\r\n<td style="width: 500px; background-color: #33628a;" width="500" valign="middle"><span style="background-color: #33628a;"><span style="color: white; font-size: small;"><strong>Sitter Guide- Account Activated</strong></span> </span></td>\r\n<td style="width: 30px; background-color: #33628a;" width="30" valign="middle"><span style="background-color: #33628a;">&nbsp;</span></td>\r\n</tr>\r\n<tr>\r\n<td style="height: 20px;" colspan="3" valign="top"><br /></td>\r\n</tr>\r\n<tr>\r\n<td style="width: 30px;" width="30" valign="top"><br /></td>\r\n<td style="width: 500px;" width="500" valign="top"><span style="font-family: Arial,Helvetica,sans-serif;"> \r\n<table style="border-collapse: collapse; border-spacing: 0; padding: 0;" border="0" cellspacing="0" cellpadding="0" width="499" height="108" align="left">\r\n<tbody>\r\n<tr>\r\n<td valign="top">Hello {full_name},</td>\r\n</tr>\r\n<tr>\r\n<td style="height: 25px;" valign="top"><br /></td>\r\n</tr>\r\n<tr>\r\n<td valign="top">\r\n<p>Your account has been activated successfull. Thanks for being a member of Sitter Guide.</p>\r\n<p>&nbsp;</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td class="system_contmail" colspan="2">If you didn''t request this - please let us know straight away at:<a href="mailto:info@razznation.com"> info@sitterguide.com</a></td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</span></td>\r\n<td style="width: 30px;" width="30" valign="top"><br /></td>\r\n</tr>\r\n<tr>\r\n<td style="height: 20px;" colspan="3" valign="top"><br /></td>\r\n</tr>\r\n<tr>\r\n<td style="width: 30px; background-color: #eeeeee;" width="30" valign="top"><br /></td>\r\n<td style="background-color: #eeeeee; padding: 15px 0;" valign="top"><span style="background-color: #eeeeee;"><span style="font-family: Arial,Helvetica,sans-serif;"> \r\n<table style="border-collapse: collapse; border-spacing: 0; text-align: justify; padding: 0;" border="0" cellspacing="0" cellpadding="0" align="left">\r\n<tbody>\r\n<tr>\r\n<td style="width: 500px; height: 20px;" width="500" valign="top">\r\n<p style="font-weight: bold;">Regards,<br /> Team Sitter Guide</p>\r\n<hr />\r\n<p><span style="font-family: Arial; font-size: xx-small;">Notice:  The information in this email and in any  attachments is confidential  and intended solely for the attention and use of the  named addressee.  This information may be subject to legal professional or other   privilege or may otherwise be protected by work product immunity or  other legal  rules. It must not be disclosed to any person without  authorization. If you are  not the intended recipient, or a person  responsible for delivering it to the  intended recipient, you are not  authorized to and must not disclose, copy,  distribute, or retain this  message or any part of  it.</span></p>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</span> </span></td>\r\n<td style="width: 30px; background-color: #eeeeee;" width="30" valign="top"><span style="background-color: #eeeeee;">&nbsp;</span></td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<p><span style="font-family: Arial,Helvetica,sans-serif;"> </span></p>', 'noreply@sitterguide.com', 'Sitter Guide', 1),
(19, 'Admin Change Password', 'admin_change_password', 'Sitter Guide - Change Password', '{name},{password}', '<p><span style="font-family: Arial,Helvetica,sans-serif;"> </span></p>\r\n<table style="border-collapse: collapse; border-spacing: 0; background-color: #f8f8f8; padding: 0;" border="0" cellspacing="0" cellpadding="0" align="center">\r\n<tbody>\r\n<tr style="height: 36px;" height="36">\r\n<td style="width: 30px; background-color: #33628a;" width="30" valign="middle"><span style="background-color: #33628a;">&nbsp;</span></td>\r\n<td style="width: 500px; background-color: #33628a;" width="500" valign="middle"><span style="background-color: #33628a;"><span style="color: white; font-size: small;"><strong>&nbsp;Sitter Guide - Admin Change Password</strong></span></span><span style="color: #ffffff; font-size: small;"><strong>&nbsp;</strong></span><br /></td>\r\n<td style="width: 30px; background-color: #33628a;" width="30" valign="middle"><span style="background-color: #33628a;">&nbsp;</span></td>\r\n</tr>\r\n<tr>\r\n<td style="height: 20px;" colspan="3" valign="top">\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td style="width: 30px;" width="30" valign="top"><br /></td>\r\n<td style="width: 500px;" width="500" valign="top"><span style="font-family: Arial,Helvetica,sans-serif;"> \r\n<table style="border-collapse: collapse; border-spacing: 0; padding: 0;" border="0" cellspacing="0" cellpadding="0" width="499" height="108" align="left">\r\n<tbody>\r\n<tr>\r\n<td valign="top"><img style="display: block; margin-left: auto; margin-right: auto;" src="/razz_nation/app/webroot/img/uploads/logo.png" alt="" /><br /></td>\r\n</tr>\r\n<tr>\r\n<td valign="top"><br /></td>\r\n</tr>\r\n<tr>\r\n<td valign="top">Hi {name},</td>\r\n</tr>\r\n<tr>\r\n<td style="height: 25px;" valign="top"><br /></td>\r\n</tr>\r\n<tr>\r\n<td valign="top">\r\n<p>You have changed your password successfully. You new password will be {password}.</p>\r\n<p>&nbsp;</p>\r\n<p>If you have any questions please contact us at <a href="mailto:info@razznation.com">info@sitterguide.com</a></p>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</span></td>\r\n<td style="width: 30px;" width="30" valign="top"><br /></td>\r\n</tr>\r\n<tr>\r\n<td style="height: 20px;" colspan="3" valign="top"><br /></td>\r\n</tr>\r\n<tr>\r\n<td style="width: 30px; background-color: #eeeeee;" width="30" valign="top"><br /></td>\r\n<td style="background-color: #eeeeee; padding: 15px 0;" valign="top"><span style="background-color: #eeeeee;"><span style="font-family: Arial,Helvetica,sans-serif;"> \r\n<table style="border-collapse: collapse; border-spacing: 0; text-align: justify; padding: 0;" border="0" cellspacing="0" cellpadding="0" width="500" height="128" align="left">\r\n<tbody>\r\n<tr>\r\n<td style="width: 500px; height: 20px;" width="500" valign="top">\r\n<p style="font-weight: bold;">Regards,<br />Team Sitter Guide</p>\r\n<p style="font-weight: bold;">&nbsp;</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td>\r\n<p><span style="font-family: Arial; font-size: xx-small;">Notice:  The information in this email and in any  attachments is confidential  and intended solely for the attention and use of the  named addressee.  This information may be subject to legal professional or other   privilege or may otherwise be protected by work product immunity or  other legal  rules. It must not be disclosed to any person without  authorization. If you are  not the intended recipient, or a person  responsible for delivering it to the  intended recipient, you are not  authorized to and must not disclose, copy,  distribute, or retain this  message or any part of  it.</span></p>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</span> </span></td>\r\n<td style="width: 30px; background-color: #eeeeee;" width="30" valign="top"><span style="background-color: #eeeeee;">&nbsp;</span></td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<p><span style="font-family: Arial,Helvetica,sans-serif;"> </span></p>', 'noreply@sitterguide.com', 'Sitter Guide', 1),
(13, 'Forgot Password', 'forgot_password', 'Value Rate - Reset your Password', '{fname},{email},{password},{link}', '<p><span style="font-family: Arial,Helvetica,sans-serif;"> </span></p>\n<table style="border-collapse: collapse; border-spacing: 0; background-color: #f8f8f8; padding: 0;" border="0" cellspacing="0" cellpadding="0" align="center">\n<tbody>\n<tr style="height: 36px;" height="36">\n<td width="30" valign="middle"><span style="background-color: #33628a;">&nbsp;</span></td>\n<td style="width: 500px; background-color: #33628a;" width="500" valign="middle"><span style="background-color: #33628a;"><span style="color: white; font-size: small;"><strong>&nbsp;Value Rate - Forgot Password</strong></span></span><span style="color: #ffffff; font-size: small;"><strong>&nbsp;</strong></span><br /></td>\n<td style="width: 30px; background-color: #33628a;" width="30" valign="middle"><span style="background-color: #33628a;">&nbsp;</span></td>\n</tr>\n<tr>\n<td style="height: 20px;" colspan="3" valign="top">\n</td>\n</tr>\n<tr>\n<td style="width: 30px;" width="30" valign="top"><br /></td>\n<td style="width: 500px;" width="500" valign="top"><span style="font-family: Arial,Helvetica,sans-serif;"> \n<table style="border-collapse: collapse; border-spacing: 0; padding: 0;" border="0" cellspacing="0" cellpadding="0" width="499" height="108" align="left">\n<tbody>\n<tr>\n<td valign="top"></td>\n</tr>\n<tr>\n<td valign="top"><br /></td>\n</tr>\n<tr>\n<td valign="top">Hi {fname},</td>\n</tr>\n<tr>\n<td style="height: 25px;" valign="top"><br /></td>\n</tr>\n<tr>\n<td valign="top">\n<p>You have requested to reset your password for: {email}.</p>\n<p>&nbsp;</p>\n<p>Your new password is: {password}</p>\n<p>Please select the following link to login with your new password: {link}</p>\n<p>If you have any questions please contact us at <a href="mailto:info@valuerate.com">info@valuerate.com</a></p>\n</td>\n</tr>\n</tbody>\n</table>\n</span></td>\n<td style="width: 30px;" width="30" valign="top"><br /></td>\n</tr>\n<tr>\n<td style="height: 20px;" colspan="3" valign="top"><br /></td>\n</tr>\n<tr>\n<td style="width: 30px; background-color: #eeeeee;" width="30" valign="top"><br /></td>\n<td style="background-color: #eeeeee; padding: 15px 0;" valign="top"><span style="background-color: #eeeeee;"><span style="font-family: Arial,Helvetica,sans-serif;"> \n<table style="border-collapse: collapse; border-spacing: 0; text-align: justify; padding: 0;" border="0" cellspacing="0" cellpadding="0" width="500" height="128" align="left">\n<tbody>\n<tr>\n<td style="width: 500px; height: 20px;" width="500" valign="top">\n<p style="font-weight: bold;">Regards,<br /><strong>&nbsp;</strong></p>\n<p style="font-weight: bold;">Team Value Rate</p>\n<p style="font-weight: bold;">&nbsp;</p>\n</td>\n</tr>\n<tr>\n<td>\n\n</td>\n</tr>\n</tbody>\n</table>\n</span> </span></td>\n<td style="width: 30px; background-color: #eeeeee;" width="30" valign="top"><span style="background-color: #eeeeee;">&nbsp;</span></td>\n</tr>\n</tbody>\n</table>\n<p><span style="font-family: Arial,Helvetica,sans-serif;"> </span></p>', 'noreply@valuerate.com', 'Value Rate', 1),
(7, 'Contact Us', 'contact_us', 'Sitter Guide - Contact Us', '{fname},{reason},{message}', '<p><span style="font-family: Arial,Helvetica,sans-serif;"> </span></p>\n<table style="border-collapse: collapse; border-spacing: 0; background-color: #f8f8f8; padding: 0;" border="0" cellspacing="0" cellpadding="0" align="center">\n<tbody>\n<tr style="height: 36px;" height="36">\n<td style="width: 30px; background-color: #33628a;" width="30" valign="middle"><span style="background-color: #33628a;">&nbsp;</span></td>\n<td style="width: 500px; background-color: #33628a;" width="500" valign="middle"><span style="background-color: #33628a;"><span style="color: white; font-size: small;"><strong>&nbsp;Sitter Guide -Contact us</strong></span></span><span style="color: #ffffff; font-size: small;"><strong>&nbsp;</strong></span><br /></td>\n<td style="width: 30px; background-color: #33628a;" width="30" valign="middle"><span style="background-color: #33628a;">&nbsp;</span></td>\n</tr>\n<tr>\n<td style="height: 20px;" colspan="3" valign="top">\n<p>&nbsp;</p>\n<p>&nbsp;</p>\n</td>\n</tr>\n<tr>\n<td style="width: 30px;" width="30" valign="top"><br /></td>\n<td style="width: 500px;" width="500" valign="top"><span style="font-family: Arial,Helvetica,sans-serif;"> \n<table style="border-collapse: collapse; border-spacing: 0; padding: 0;" border="0" cellspacing="0" cellpadding="0" width="499" height="108" align="left">\n<tbody>\n<tr>\n<td valign="top"><img style="display: block; margin-left: auto; margin-right: auto;" src="/razz_nation/app/webroot/img/uploads/logo.png" alt="" /><br /></td>\n</tr>\n<tr>\n<td valign="top"><br /></td>\n</tr>\n<tr>\n<td valign="top">Hi {fname},</td>\n</tr>\n<tr>\n<td style="height: 25px;" valign="top"><br /></td>\n</tr>\n<tr>\n<td valign="top">\n<p>Thank you for contacting us. We will be in touch as soon as possible..</p>\n<p>&nbsp;</p>\n<p>Inquiry : {message}</p>\n<p>If you have any questions please contact us at <a href="mailto:info@razznation.com">info@sitterguide.com</a></p>\n</td>\n</tr>\n</tbody>\n</table>\n</span></td>\n<td style="width: 30px;" width="30" valign="top"><br /></td>\n</tr>\n<tr>\n<td style="height: 20px;" colspan="3" valign="top"><br /></td>\n</tr>\n<tr>\n<td style="width: 30px; background-color: #eeeeee;" width="30" valign="top"><br /></td>\n<td style="background-color: #eeeeee; padding: 15px 0;" valign="top"><span style="background-color: #eeeeee;"><span style="font-family: Arial,Helvetica,sans-serif;"> \n<table style="border-collapse: collapse; border-spacing: 0; text-align: justify; padding: 0;" border="0" cellspacing="0" cellpadding="0" width="500" height="128" align="left">\n<tbody>\n<tr>\n<td style="width: 500px; height: 20px;" width="500" valign="top">\n<p style="font-weight: bold;">Regards,<br /><strong>&nbsp;</strong></p>\n<p style="font-weight: bold;">Team Stter Guide</p>\n<p style="font-weight: bold;">&nbsp;</p>\n</td>\n</tr>\n<tr>\n<td>\n<p><span style="font-family: Arial; font-size: xx-small;">Notice:  The information in this email and in any  attachments is confidential  and intended solely for the attention and use of the  named addressee.  This information may be subject to legal professional or other   privilege or may otherwise be protected by work product immunity or  other legal  rules. It must not be disclosed to any person without  authorization. If you are  not the intended recipient, or a person  responsible for delivering it to the  intended recipient, you are not  authorized to and must not disclose, copy,  distribute, or retain this  message or any part of  it.</span></p>\n</td>\n</tr>\n</tbody>\n</table>\n</span> </span></td>\n<td style="width: 30px; background-color: #eeeeee;" width="30" valign="top"><span style="background-color: #eeeeee;">&nbsp;</span></td>\n</tr>\n</tbody>\n</table>\n<p><span style="font-family: Arial,Helvetica,sans-serif;"> </span></p>', 'noreply@sitterguide.com', 'Sitter Guide', 1),
(8, 'Contact Us Admin', 'contact_us_admin', 'Sitter Guide - Contact Us', '{fname},{message}', '<p><span style="font-family: Arial,Helvetica,sans-serif;"> </span></p>\r\n<table style="border-collapse: collapse; border-spacing: 0; background-color: #f8f8f8; padding: 0;" border="0" cellspacing="0" cellpadding="0" align="center">\r\n<tbody>\r\n<tr style="height: 36px;" height="36">\r\n<td style="width: 30px; background-color: #33628a;" width="30" valign="middle"><span style="background-color: #33628a;">&nbsp;</span></td>\r\n<td style="width: 500px; background-color: #33628a;" width="500" valign="middle"><span style="background-color: #33628a;"><span style="color: white; font-size: small;"><strong>&nbsp;Sitter Guide -Contact us</strong></span></span><span style="color: #ffffff; font-size: small;"><strong>&nbsp;</strong></span><br /></td>\r\n<td style="width: 30px; background-color: #33628a;" width="30" valign="middle"><span style="background-color: #33628a;">&nbsp;</span></td>\r\n</tr>\r\n<tr>\r\n<td style="height: 20px;" colspan="3" valign="top">\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td style="width: 30px;" width="30" valign="top"><br /></td>\r\n<td style="width: 500px;" width="500" valign="top"><span style="font-family: Arial,Helvetica,sans-serif;"> \r\n<table style="border-collapse: collapse; border-spacing: 0; padding: 0;" border="0" cellspacing="0" cellpadding="0" width="499" height="108" align="left">\r\n<tbody>\r\n<tr>\r\n<td valign="top"><img style="display: block; margin-left: auto; margin-right: auto;" src="/razz_nation/app/webroot/img/uploads/logo.png" alt="" /><br /></td>\r\n</tr>\r\n<tr>\r\n<td valign="top"><br /></td>\r\n</tr>\r\n<tr>\r\n<td valign="top">Hi Admin,</td>\r\n</tr>\r\n<tr>\r\n<td style="height: 25px;" valign="top"><br /></td>\r\n</tr>\r\n<tr>\r\n<td valign="top">\r\n<p>{fname} contacting you</p>\r\n<p>Thank you for contacting us. We will be in touch as soon as possible..</p>\r\n<p>&nbsp;</p>\r\n<p>Inquiry : {message}</p>\r\n<p>If you have any questions please contact us at <a href="mailto:info@razznation.com">info@sitterguide.com</a></p>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</span></td>\r\n<td style="width: 30px;" width="30" valign="top"><br /></td>\r\n</tr>\r\n<tr>\r\n<td style="height: 20px;" colspan="3" valign="top"><br /></td>\r\n</tr>\r\n<tr>\r\n<td style="width: 30px; background-color: #eeeeee;" width="30" valign="top"><br /></td>\r\n<td style="background-color: #eeeeee; padding: 15px 0;" valign="top"><span style="background-color: #eeeeee;"><span style="font-family: Arial,Helvetica,sans-serif;"> \r\n<table style="border-collapse: collapse; border-spacing: 0; text-align: justify; padding: 0;" border="0" cellspacing="0" cellpadding="0" width="500" height="128" align="left">\r\n<tbody>\r\n<tr>\r\n<td style="width: 500px; height: 20px;" width="500" valign="top">\r\n<p style="font-weight: bold;">Regards,<br /><strong>&nbsp;</strong></p>\r\n<p style="font-weight: bold;">Team Sitter Guide</p>\r\n<p style="font-weight: bold;">&nbsp;</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td>\r\n<p><span style="font-family: Arial; font-size: xx-small;">Notice:  The information in this email and in any  attachments is confidential  and intended solely for the attention and use of the  named addressee.  This information may be subject to legal professional or other   privilege or may otherwise be protected by work product immunity or  other legal  rules. It must not be disclosed to any person without  authorization. If you are  not the intended recipient, or a person  responsible for delivering it to the  intended recipient, you are not  authorized to and must not disclose, copy,  distribute, or retain this  message or any part of  it.</span></p>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</span> </span></td>\r\n<td style="width: 30px; background-color: #eeeeee;" width="30" valign="top"><span style="background-color: #eeeeee;">&nbsp;</span></td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<p><span style="font-family: Arial,Helvetica,sans-serif;"> </span></p>', 'noreply@sitterguide.com', 'Sitter Guide', 1);

-- --------------------------------------------------------

--
-- Table structure for table `email_templates_i18n`
--

CREATE TABLE IF NOT EXISTS `email_templates_i18n` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `locale` varchar(6) NOT NULL,
  `model` varchar(255) NOT NULL,
  `foreign_key` int(10) NOT NULL,
  `field` varchar(255) NOT NULL,
  `content` text,
  PRIMARY KEY (`id`),
  UNIQUE KEY `I18N_LOCALE_FIELD` (`locale`,`model`,`foreign_key`,`field`),
  KEY `I18N_FIELD` (`model`,`foreign_key`,`field`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `email_templates_i18n`
--

INSERT INTO `email_templates_i18n` (`id`, `locale`, `model`, `foreign_key`, `field`, `content`) VALUES
(1, 'de_DE', 'EmailTemplates', 13, 'title', 'Forgot Password ger'),
(2, 'de_DE', 'EmailTemplates', 13, 'subject', 'Sitter Guide - ger Reset your Password'),
(3, 'de_DE', 'EmailTemplates', 13, 'email_from', 'noreply@sitterguide.com'),
(4, 'de_DE', 'EmailTemplates', 13, 'email_name', 'Sitter Guide ger'),
(5, 'de_DE', 'EmailTemplates', 13, 'description', '<p><span style="font-family: Arial,Helvetica,sans-serif;"> </span></p>\r\n<table style="border-collapse: collapse; border-spacing: 0; background-color: #f8f8f8; padding: 0;" border="0" cellspacing="0" cellpadding="0" align="center">\r\n<tbody>\r\n<tr style="height: 36px;" height="36">\r\n<td width="30" valign="middle"><span style="background-color: #33628a;">&nbsp;</span></td>\r\n<td style="width: 500px; background-color: #33628a;" width="500" valign="middle"><span style="background-color: #33628a;"><span style="color: white; font-size: small;"><strong>&nbsp;Sitter Guide -Forgot Password</strong></span></span><span style="color: #ffffff; font-size: small;"><strong>&nbsp;</strong></span><br /></td>\r\n<td style="width: 30px; background-color: #33628a;" width="30" valign="middle"><span style="background-color: #33628a;">&nbsp;</span></td>\r\n</tr>\r\n<tr>\r\n<td style="height: 20px;" colspan="3" valign="top">\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td style="width: 30px;" width="30" valign="top"><br /></td>\r\n<td style="width: 500px;" width="500" valign="top"><span style="font-family: Arial,Helvetica,sans-serif;"> \r\n<table style="border-collapse: collapse; border-spacing: 0; padding: 0;" border="0" cellspacing="0" cellpadding="0" width="499" height="108" align="left">\r\n<tbody>\r\n<tr>\r\n<td valign="top"><img style="display: block; margin-left: auto; margin-right: auto;" src="/razz_nation/app/webroot/img/uploads/logo.png" alt="" /><br /></td>\r\n</tr>\r\n<tr>\r\n<td valign="top"><br /></td>\r\n</tr>\r\n<tr>\r\n<td valign="top">Hi {fname},</td>\r\n</tr>\r\n<tr>\r\n<td style="height: 25px;" valign="top"><br /></td>\r\n</tr>\r\n<tr>\r\n<td valign="top">\r\n<p>You have requested to reset your password for: {email} on Razz Nation.</p>\r\n<p>&nbsp;</p>\r\n<p>Your temporary password is: {password}</p>\r\n<p>Please select the following link to login with your new password: {link}</p>\r\n<p>If you have any questions please contact us at <a href="mailto:info@razznation.com">info@sitterguide.com</a></p>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</span></td>\r\n<td style="width: 30px;" width="30" valign="top"><br /></td>\r\n</tr>\r\n<tr>\r\n<td style="height: 20px;" colspan="3" valign="top"><br /></td>\r\n</tr>\r\n<tr>\r\n<td style="width: 30px; background-color: #eeeeee;" width="30" valign="top"><br /></td>\r\n<td style="background-color: #eeeeee; padding: 15px 0;" valign="top"><span style="background-color: #eeeeee;"><span style="font-family: Arial,Helvetica,sans-serif;"> \r\n<table style="border-collapse: collapse; border-spacing: 0; text-align: justify; padding: 0;" border="0" cellspacing="0" cellpadding="0" width="500" height="128" align="left">\r\n<tbody>\r\n<tr>\r\n<td style="width: 500px; height: 20px;" width="500" valign="top">\r\n<p style="font-weight: bold;">Regards,<br /><strong>&nbsp;</strong></p>\r\n<p style="font-weight: bold;">Team Sitter Guide</p>\r\n<p style="font-weight: bold;">&nbsp;</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td>\r\n<p><span style="font-family: Arial; font-size: xx-small;">Notice:  The information in this email and in any  attachments is confidential  and intended solely for the attention and use of the  named addressee.  This information may be subject to legal professional or other   privilege or may otherwise be protected by work product immunity or  other legal  rules. It must not be disclosed to any person without  authorization. If you are  not the intended recipient, or a person  responsible for delivering it to the  intended recipient, you are not  authorized to and must not disclose, copy,  distribute, or retain this  message or any part of  it.</span></p>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</span> </span></td>\r\n<td style="width: 30px; background-color: #eeeeee;" width="30" valign="top"><span style="background-color: #eeeeee;">&nbsp;</span></td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<p><span style="font-family: Arial,Helvetica,sans-serif;"> </span></p>'),
(6, 'de_DE', 'EmailTemplates', 8, 'title', 'Contact Us Admin ger'),
(7, 'de_DE', 'EmailTemplates', 8, 'subject', 'Sitter Guide - Contact Us'),
(8, 'de_DE', 'EmailTemplates', 8, 'email_from', 'noreply@sitterguide.com'),
(9, 'de_DE', 'EmailTemplates', 8, 'email_name', 'Sitter Guide'),
(10, 'de_DE', 'EmailTemplates', 8, 'description', '<p><span style="font-family: Arial,Helvetica,sans-serif;"> </span></p>\r\n<table style="border-collapse: collapse; border-spacing: 0; background-color: #f8f8f8; padding: 0;" border="0" cellspacing="0" cellpadding="0" align="center">\r\n<tbody>\r\n<tr style="height: 36px;" height="36">\r\n<td style="width: 30px; background-color: #33628a;" width="30" valign="middle"><span style="background-color: #33628a;">&nbsp;</span></td>\r\n<td style="width: 500px; background-color: #33628a;" width="500" valign="middle"><span style="background-color: #33628a;"><span style="color: white; font-size: small;"><strong>&nbsp;Sitter Guide -Contact us</strong></span></span><span style="color: #ffffff; font-size: small;"><strong>&nbsp;</strong></span><br /></td>\r\n<td style="width: 30px; background-color: #33628a;" width="30" valign="middle"><span style="background-color: #33628a;">&nbsp;</span></td>\r\n</tr>\r\n<tr>\r\n<td style="height: 20px;" colspan="3" valign="top">\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td style="width: 30px;" width="30" valign="top"><br /></td>\r\n<td style="width: 500px;" width="500" valign="top"><span style="font-family: Arial,Helvetica,sans-serif;"> \r\n<table style="border-collapse: collapse; border-spacing: 0; padding: 0;" border="0" cellspacing="0" cellpadding="0" width="499" height="108" align="left">\r\n<tbody>\r\n<tr>\r\n<td valign="top"><img style="display: block; margin-left: auto; margin-right: auto;" src="/razz_nation/app/webroot/img/uploads/logo.png" alt="" /><br /></td>\r\n</tr>\r\n<tr>\r\n<td valign="top"><br /></td>\r\n</tr>\r\n<tr>\r\n<td valign="top">Hi Admin,</td>\r\n</tr>\r\n<tr>\r\n<td style="height: 25px;" valign="top"><br /></td>\r\n</tr>\r\n<tr>\r\n<td valign="top">\r\n<p>{fname} contacting you</p>\r\n<p>Thank you for contacting us. We will be in touch as soon as possible..</p>\r\n<p>&nbsp;</p>\r\n<p>Inquiry : {message}</p>\r\n<p>If you have any questions please contact us at <a href="mailto:info@razznation.com">info@sitterguide.com</a></p>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</span></td>\r\n<td style="width: 30px;" width="30" valign="top"><br /></td>\r\n</tr>\r\n<tr>\r\n<td style="height: 20px;" colspan="3" valign="top"><br /></td>\r\n</tr>\r\n<tr>\r\n<td style="width: 30px; background-color: #eeeeee;" width="30" valign="top"><br /></td>\r\n<td style="background-color: #eeeeee; padding: 15px 0;" valign="top"><span style="background-color: #eeeeee;"><span style="font-family: Arial,Helvetica,sans-serif;"> \r\n<table style="border-collapse: collapse; border-spacing: 0; text-align: justify; padding: 0;" border="0" cellspacing="0" cellpadding="0" width="500" height="128" align="left">\r\n<tbody>\r\n<tr>\r\n<td style="width: 500px; height: 20px;" width="500" valign="top">\r\n<p style="font-weight: bold;">Regards,<br /><strong>&nbsp;</strong></p>\r\n<p style="font-weight: bold;">Team Sitter Guide</p>\r\n<p style="font-weight: bold;">&nbsp;</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td>\r\n<p><span style="font-family: Arial; font-size: xx-small;">Notice:  The information in this email and in any  attachments is confidential  and intended solely for the attention and use of the  named addressee.  This information may be subject to legal professional or other   privilege or may otherwise be protected by work product immunity or  other legal  rules. It must not be disclosed to any person without  authorization. If you are  not the intended recipient, or a person  responsible for delivering it to the  intended recipient, you are not  authorized to and must not disclose, copy,  distribute, or retain this  message or any part of  it.</span></p>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</span> </span></td>\r\n<td style="width: 30px; background-color: #eeeeee;" width="30" valign="top"><span style="background-color: #eeeeee;">&nbsp;</span></td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<p><span style="font-family: Arial,Helvetica,sans-serif;"> </span></p>'),
(11, 'de_DE', 'EmailTemplates', 7, 'title', 'Contact Us ger'),
(12, 'de_DE', 'EmailTemplates', 7, 'subject', 'Sitter Guide - Contact Us'),
(13, 'de_DE', 'EmailTemplates', 7, 'email_from', 'noreply@sitterguide.com'),
(14, 'de_DE', 'EmailTemplates', 7, 'email_name', 'Sitter Guide'),
(15, 'de_DE', 'EmailTemplates', 7, 'description', '<p><span style="font-family: Arial,Helvetica,sans-serif;"> </span></p>\r\n<table style="border-collapse: collapse; border-spacing: 0; background-color: #f8f8f8; padding: 0;" border="0" cellspacing="0" cellpadding="0" align="center">\r\n<tbody>\r\n<tr style="height: 36px;" height="36">\r\n<td style="width: 30px; background-color: #33628a;" width="30" valign="middle"><span style="background-color: #33628a;">&nbsp;</span></td>\r\n<td style="width: 500px; background-color: #33628a;" width="500" valign="middle"><span style="background-color: #33628a;"><span style="color: white; font-size: small;"><strong>&nbsp;Sitter Guide -Contact us</strong></span></span><span style="color: #ffffff; font-size: small;"><strong>&nbsp;</strong></span><br /></td>\r\n<td style="width: 30px; background-color: #33628a;" width="30" valign="middle"><span style="background-color: #33628a;">&nbsp;</span></td>\r\n</tr>\r\n<tr>\r\n<td style="height: 20px;" colspan="3" valign="top">\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td style="width: 30px;" width="30" valign="top"><br /></td>\r\n<td style="width: 500px;" width="500" valign="top"><span style="font-family: Arial,Helvetica,sans-serif;"> \r\n<table style="border-collapse: collapse; border-spacing: 0; padding: 0;" border="0" cellspacing="0" cellpadding="0" width="499" height="108" align="left">\r\n<tbody>\r\n<tr>\r\n<td valign="top"><img style="display: block; margin-left: auto; margin-right: auto;" src="/razz_nation/app/webroot/img/uploads/logo.png" alt="" /><br /></td>\r\n</tr>\r\n<tr>\r\n<td valign="top"><br /></td>\r\n</tr>\r\n<tr>\r\n<td valign="top">Hi {fname},</td>\r\n</tr>\r\n<tr>\r\n<td style="height: 25px;" valign="top"><br /></td>\r\n</tr>\r\n<tr>\r\n<td valign="top">\r\n<p>Thank you for contacting us. We will be in touch as soon as possible..</p>\r\n<p>&nbsp;</p>\r\n<p>Inquiry : {message}</p>\r\n<p>If you have any questions please contact us at <a href="mailto:info@razznation.com">info@sitterguide.com</a></p>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</span></td>\r\n<td style="width: 30px;" width="30" valign="top"><br /></td>\r\n</tr>\r\n<tr>\r\n<td style="height: 20px;" colspan="3" valign="top"><br /></td>\r\n</tr>\r\n<tr>\r\n<td style="width: 30px; background-color: #eeeeee;" width="30" valign="top"><br /></td>\r\n<td style="background-color: #eeeeee; padding: 15px 0;" valign="top"><span style="background-color: #eeeeee;"><span style="font-family: Arial,Helvetica,sans-serif;"> \r\n<table style="border-collapse: collapse; border-spacing: 0; text-align: justify; padding: 0;" border="0" cellspacing="0" cellpadding="0" width="500" height="128" align="left">\r\n<tbody>\r\n<tr>\r\n<td style="width: 500px; height: 20px;" width="500" valign="top">\r\n<p style="font-weight: bold;">Regards,<br /><strong>&nbsp;</strong></p>\r\n<p style="font-weight: bold;">Team Stter Guide</p>\r\n<p style="font-weight: bold;">&nbsp;</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td>\r\n<p><span style="font-family: Arial; font-size: xx-small;">Notice:  The information in this email and in any  attachments is confidential  and intended solely for the attention and use of the  named addressee.  This information may be subject to legal professional or other   privilege or may otherwise be protected by work product immunity or  other legal  rules. It must not be disclosed to any person without  authorization. If you are  not the intended recipient, or a person  responsible for delivering it to the  intended recipient, you are not  authorized to and must not disclose, copy,  distribute, or retain this  message or any part of  it.</span></p>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</span> </span></td>\r\n<td style="width: 30px; background-color: #eeeeee;" width="30" valign="top"><span style="background-color: #eeeeee;">&nbsp;</span></td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<p><span style="font-family: Arial,Helvetica,sans-serif;"> </span></p>');

-- --------------------------------------------------------

--
-- Table structure for table `executive_ratings`
--

CREATE TABLE IF NOT EXISTS `executive_ratings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `executive_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `rating` int(1) NOT NULL,
  `note` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `executive_ratings`
--

INSERT INTO `executive_ratings` (`id`, `executive_id`, `user_id`, `rating`, `note`) VALUES
(6, 0, 86, 4, 'Thisi s gpp rating'),
(7, 10, 86, 3, 'This is first rating ');

-- --------------------------------------------------------

--
-- Table structure for table `i18n`
--

CREATE TABLE IF NOT EXISTS `i18n` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `locale` varchar(6) NOT NULL,
  `model` varchar(255) NOT NULL,
  `foreign_key` int(10) NOT NULL,
  `field` varchar(255) NOT NULL,
  `content` text,
  PRIMARY KEY (`id`),
  UNIQUE KEY `I18N_LOCALE_FIELD` (`locale`,`model`,`foreign_key`,`field`),
  KEY `I18N_FIELD` (`model`,`foreign_key`,`field`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `promo_codes`
--

CREATE TABLE IF NOT EXISTS `promo_codes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `promo_code` varchar(255) NOT NULL,
  `coupon_type` enum('discounted_coupon','fixed_coupon') NOT NULL,
  `discount_rate` int(11) NOT NULL,
  `start_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `expire_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `description` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `date_added` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `promo_codes`
--

INSERT INTO `promo_codes` (`id`, `promo_code`, `coupon_type`, `discount_rate`, `start_date`, `expire_date`, `description`, `status`, `date_added`) VALUES
(1, 'Lohri25 ger', 'discounted_coupon', 25, '2016-04-06 00:00:00', '2016-04-20 00:00:00', 'Lohri discount 25 percent ger', 0, '2016-01-05 12:48:06');

-- --------------------------------------------------------

--
-- Table structure for table `promo_codes_i18n`
--

CREATE TABLE IF NOT EXISTS `promo_codes_i18n` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `locale` varchar(6) NOT NULL,
  `model` varchar(255) NOT NULL,
  `foreign_key` int(10) NOT NULL,
  `field` varchar(255) NOT NULL,
  `content` text,
  PRIMARY KEY (`id`),
  UNIQUE KEY `I18N_LOCALE_FIELD` (`locale`,`model`,`foreign_key`,`field`),
  KEY `I18N_FIELD` (`model`,`foreign_key`,`field`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `site_configurations`
--

CREATE TABLE IF NOT EXISTS `site_configurations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `site_contact_email` varchar(255) NOT NULL,
  `site_name` varchar(255) NOT NULL,
  `site_logo` varchar(255) NOT NULL,
  `site_favicon` varchar(255) NOT NULL,
  `site_footer` varchar(255) NOT NULL,
  `meta_title` varchar(255) NOT NULL,
  `meta_keyword` text NOT NULL,
  `meta_description` text NOT NULL,
  `ganalytics` text NOT NULL,
  `timezone` varchar(255) NOT NULL,
  `facebook_link` varchar(255) NOT NULL,
  `twitter_link` varchar(255) NOT NULL,
  `google_link` varchar(255) NOT NULL,
  `instagram_link` varchar(255) NOT NULL,
  `youtube_link` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `site_configurations`
--

INSERT INTO `site_configurations` (`id`, `site_contact_email`, `site_name`, `site_logo`, `site_favicon`, `site_footer`, `meta_title`, `meta_keyword`, `meta_description`, `ganalytics`, `timezone`, `facebook_link`, `twitter_link`, `google_link`, `instagram_link`, `youtube_link`) VALUES
(1, 'rahul.jain@betasoftsystems.com', 'Sitter Guides', 'a71Uw18xmuRtUpf.jpg', '', 'as dasd', 'Sitter Guide', 'Sitter Guide', 'Sitter Guide', '<script type="text/javascript">  var _gaq = _gaq || [];  _gaq.push([_setAccount, UA-XXXXX-Y]);  _gaq.push([_trackPageview]);  (function() {    var ga = document.createElement(script); ga.type = text/javascript; ga.async = true;    ga.src = (https: == document.location.protocol ? https://ssl : http://www) + .google-analytics.com/ga.js;    var s = document.getElementsByTagName(script)[0]; s.parentNode.insertBefore(ga, s);  })();</script>', 'America/New_York', 'www.facebook.com', 'www.twitter.com', 'www.google.com', 'www.instagram.com', 'www.youtube.com');

-- --------------------------------------------------------

--
-- Table structure for table `site_configurations_i18n`
--

CREATE TABLE IF NOT EXISTS `site_configurations_i18n` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `locale` varchar(6) NOT NULL,
  `model` varchar(255) NOT NULL,
  `foreign_key` int(10) NOT NULL,
  `field` varchar(255) NOT NULL,
  `content` text,
  PRIMARY KEY (`id`),
  UNIQUE KEY `I18N_LOCALE_FIELD` (`locale`,`model`,`foreign_key`,`field`),
  KEY `I18N_FIELD` (`model`,`foreign_key`,`field`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `site_configurations_i18n`
--

INSERT INTO `site_configurations_i18n` (`id`, `locale`, `model`, `foreign_key`, `field`, `content`) VALUES
(1, 'de_DE', 'SiteConfigurations', 1, 'site_name', 'Sitter Guides'),
(2, 'de_DE', 'SiteConfigurations', 1, 'site_footer', 'This is german content'),
(3, 'de_DE', 'SiteConfigurations', 1, 'meta_title', 'Sitter Guide'),
(4, 'de_DE', 'SiteConfigurations', 1, 'meta_keyword', 'Sitter Guide'),
(5, 'de_DE', 'SiteConfigurations', 1, 'meta_description', 'Sitter Guide');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `zip` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `org_password` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` varchar(255) DEFAULT NULL,
  `status` int(2) NOT NULL DEFAULT '1',
  `type` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=89 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `address`, `city`, `state`, `country`, `zip`, `password`, `org_password`, `image`, `date_added`, `updated_at`, `status`, `type`) VALUES
(42, 'Vikrant', 'vik@gmail.com', '1231231231', '#23 Street , Fot Night', 'Abi', 'Abu Dabi', 'UAE', '123123', '21232f297a57a5a743894a0e4a801fc3', 'admin', 'BW8j0BztxzCIcy3.jpg', '2016-02-16 04:35:19', NULL, 1, ''),
(43, 'testing', 'vikrant.bhalla@betasoftsystems.com', '123123123', '#23 Street , Fot Night', 'Abi', 'Abu Dabi', 'UAE', 'adsdfas@gmail.com', '5d77dd46dc2440c6eb3b3e17302b9988', 'dIR9UktN', '', '2016-01-21 11:56:31', NULL, 1, ''),
(45, '', 'adsasd@gmail.com', '', 'ewrwer', '', '', '', '', '', '', '', '2016-02-17 07:14:42', NULL, 1, ''),
(49, '', 'adsasd@gmail.com', '', '', '', '', '', '', 'f14cff4cac07c597fc84da2add2443c8', '', '', '2016-02-17 08:21:30', NULL, 1, ''),
(53, '', 'honeyjj@gmail.com', '', '', '', '', '', '', 'ce2fc606496e4863afa1756ea23695eb', '6TsiTqmaOY', '', '2016-02-17 10:15:24', NULL, 1, ''),
(54, '', 'honeypp@gmail.com', '', '', '', '', '', '', '49db0d7679ace887c167dc24400d2dc9', 'VCJOLThoMG', '', '2016-02-17 10:15:15', NULL, 1, 'valuerater'),
(55, '', 'honeyp@gmail.com', '', '', '', '', '', '', 'a138ccca88894d1f3c79ca17f5830269', 'N19kES04To', '', '2016-02-17 10:15:09', NULL, 1, 'valuerater'),
(61, '', 'kol@gmail.com', '', '', '', '', '', '', '9e2ba8cf397a13e6bfd81660e7db3888', 'bGNAjkwUne', '', '2016-02-17 11:12:37', NULL, 1, 'valuerater'),
(67, '', 'qqqq@gmail.com', '', '', '', '', '', '', '91a016b55c69884309c2dc0d0e3faa78', 'W49UxUKI1M', '', '2016-02-17 11:29:43', NULL, 1, 'valuerater'),
(68, '', 'qqqq@gmail.com', '', '', '', '', '', '', 'da70b0405ee7d10f492a5d5a5fb4c382', 'RXXnN7tWp9', '', '2016-02-17 11:34:05', NULL, 1, 'valuerater'),
(86, 'Honey', 'honey@gmail.com', '', '', '', '', '', '', '848fe9b43652bbfd247c85b8524e1999', '4gmnjFoUmI', '', '2016-02-19 06:09:11', NULL, 1, 'valuerater'),
(87, '', 'adsasd@gmail.com', '', '', '', '', '', '', '53811f51f9bc806d58ee372e2bf64742', 'ejFHRC6Z8Q', '', '2016-02-18 07:36:30', NULL, 1, 'valuerater'),
(88, '', 'honkkkey@gmail.com', '', '', '', '', '', '', '7f6429c5a4fd1bd865fa80442bf5ca20', 'cvoVRgBHUQ', '', '2016-02-18 07:37:36', NULL, 1, 'valuerater');

-- --------------------------------------------------------

--
-- Table structure for table `users_i18n`
--

CREATE TABLE IF NOT EXISTS `users_i18n` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `locale` varchar(6) NOT NULL,
  `model` varchar(255) NOT NULL,
  `foreign_key` int(10) NOT NULL,
  `field` varchar(255) NOT NULL,
  `content` text,
  PRIMARY KEY (`id`),
  UNIQUE KEY `I18N_LOCALE_FIELD` (`locale`,`model`,`foreign_key`,`field`),
  KEY `I18N_FIELD` (`model`,`foreign_key`,`field`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `users_i18n`
--

INSERT INTO `users_i18n` (`id`, `locale`, `model`, `foreign_key`, `field`, `content`) VALUES
(1, 'de_DE', 'Users', 30, 'name', 'Männer'),
(2, 'de_DE', 'Users', 30, 'phone', '9050605253'),
(3, 'de_DE', 'Users', 30, 'email', 'sukhdev@betasoftsystems.com'),
(4, 'de_DE', 'Users', 30, 'country', 'asdsad'),
(5, 'de_DE', 'Users', 30, 'city', 'sadsad'),
(6, 'de_DE', 'Users', 30, 'state', 'sadsadas'),
(7, 'de_DE', 'Users', 30, 'address', 'dsad'),
(8, 'de_DE', 'Users', 30, 'zip', '234234'),
(9, 'es_ES', 'Users', 30, 'name', 'hombres'),
(10, 'es_ES', 'Users', 30, 'phone', '9050605253'),
(11, 'es_ES', 'Users', 30, 'email', 'sukhdev@betasoftsystems.com'),
(12, 'es_ES', 'Users', 30, 'country', 'sadsa'),
(13, 'es_ES', 'Users', 30, 'city', 'dasd'),
(14, 'es_ES', 'Users', 30, 'state', 'sad'),
(15, 'es_ES', 'Users', 30, 'address', 'sadsa'),
(16, 'es_ES', 'Users', 30, 'zip', 'das');

-- --------------------------------------------------------

--
-- Table structure for table `user_details`
--

CREATE TABLE IF NOT EXISTS `user_details` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL,
  `company_name` text NOT NULL,
  `brief_des` text NOT NULL,
  `currency` text NOT NULL,
  `industry` text NOT NULL,
  `website` text NOT NULL,
  `date_found` text NOT NULL,
  `facebook_url` text NOT NULL,
  `linkedin_url` text NOT NULL,
  `twitter_url` text NOT NULL,
  `google_url` text NOT NULL,
  `company_summary` text NOT NULL,
  `company_video` varchar(255) NOT NULL,
  `i_goal` text NOT NULL,
  `i_type` text NOT NULL,
  `i_pre_money` text NOT NULL,
  `i_post_money` text NOT NULL,
  `i_expected_returns` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `user_details`
--

INSERT INTO `user_details` (`id`, `user_id`, `company_name`, `brief_des`, `currency`, `industry`, `website`, `date_found`, `facebook_url`, `linkedin_url`, `twitter_url`, `google_url`, `company_summary`, `company_video`, `i_goal`, `i_type`, `i_pre_money`, `i_post_money`, `i_expected_returns`) VALUES
(5, 42, 'D & D Pvt . Ltd .', 'America''s Favorite Donut and Coffee Shop', 'USD', 'Other', 'www.dunkindonuts.com', 'March 2006', 'https://www.facebook.com/DunkinDonuts', '', 'https://twitter.com/dunkindonuts', '', 'sdfsdfsdfsdfsdfsdfddddddddddddddddddddddddddd', 'https://www.youtube.com/embed/zuAx_nhA_4s', '$30,2000', '', '$50,000', '$80,000', '10 times ,3 years'),
(6, 43, 'Abc Pvt. Ltd.', 'Brief descritpon of Pvt. Ltd.', 'UAE', 'IT Service', 'http://mashable.com', 'January 2000', 'http://facebook.com/', 'http://linkedin.com/', 'http://twitter.com/', 'http://google.com/', 'This is the overview of the company This is the overview of the company This is the overview of the company This is the overview of the company This is the overview of the company This is the overview of the company This is the overview of the company This is the overview of the company This is the overview of the company This is the overview of the company This is the overview of the company This is the overview of the company This is the overview of the company This is the overview of the company This is the overview of the company This is the overview of the company This is the overview of the company This is the overview of the company This is the overview of the company This is the overview of the company This is the overview of the company This is the overview of the company This is the overview of the company ', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `user_executive_summaries`
--

CREATE TABLE IF NOT EXISTS `user_executive_summaries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `user_executive_summaries`
--

INSERT INTO `user_executive_summaries` (`id`, `user_id`, `title`, `description`) VALUES
(8, 43, '', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker '),
(10, 42, 'gggppp', ' dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.'),
(11, 42, 'asdfa', 'asdasdasd'),
(12, 42, 'businuess', 'sdfksdfsdkjbfjsdfbjsdfbsdbhfsdjhbsdfshbddhfhsdfbsdhfbsdhfbsdhfbsdhfbsdfsdfsdfsdfsdfsdfsdfsdf');

-- --------------------------------------------------------

--
-- Table structure for table `user_funding_materials`
--

CREATE TABLE IF NOT EXISTS `user_funding_materials` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `document_name` varchar(225) NOT NULL,
  `document_path` varchar(225) NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `user_funding_materials`
--

INSERT INTO `user_funding_materials` (`id`, `user_id`, `document_name`, `document_path`, `create_date`) VALUES
(7, 42, 'New Document', 'hLm3JpbMYcLUGMo.doc', '2016-01-20 10:49:49');

-- --------------------------------------------------------

--
-- Table structure for table `user_members`
--

CREATE TABLE IF NOT EXISTS `user_members` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `position` varchar(200) NOT NULL,
  `linkedin_url` text NOT NULL,
  `experience` text NOT NULL,
  `image` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Dumping data for table `user_members`
--

INSERT INTO `user_members` (`id`, `user_id`, `name`, `position`, `linkedin_url`, `experience`, `image`) VALUES
(7, 52, 'OO', 'CEO', 'http://api.cakephp.org/3.0/class-Cake.Validation.Validation.html#_url', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 'BsTcfa6cC0Ixxno.jpg'),
(8, 52, 'Vikrant', 'Sr. Dev', 'http://stackoverflow.com/questions/29448597/how-to-validate-urls-in-cakephp-3-x', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 'lCW2JJDTY0amrlE.jpg'),
(9, 52, 'Ravi', 'Je. Dev', 'http://www.w3schools.com/bootstrap/bootstrap_tabs_pills.asp', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 'EXiEvRsi72OacKO.jpg'),
(14, 51, 'New Member ', 'C E O', '', 'This is my exprience right here . This is my exprience right here . This is my exprience right here . This is my exprience right here . This is my exprience right here . This is my exprience right here . This is my exprience right here . This is my exprience right here . This is my exprience right here . This is my exprience right here . This is my exprience right here . This is my exprience right here . This is my exprience right here . This is my exprience right here . This is my exprience right here . This is my exprience right here . This is my exprience right here . This is my exprience right here . This is my exprience right here . ', ''),
(17, 69, 'new member', 'CEO', 'http://book.cakephp.org/2.0/en/getting-started/cakephp-conventions.html', 'http://book.cakephp.org/2.0/en/getting-started/cakephp-conventions.html', 'IlKdLO0otr5pVsm.jpg'),
(22, 42, 'Clark Kent', 'Manager', 'https://in.linkedin.com/', 'Working as a manger from 3 years', 'W8L7z9nKgQHiaQG.jpg'),
(23, 42, 'Bruce Wayne', 'Manager', 'https://in.linkedin.com/', 'Working as a manger from 3 years', 'Ydfz156sgbzuj0M.jpg'),
(24, 42, 'honey', 'sdfsdfsdfs', 'https://www.youtube.com/embed/zuAx_nhA_4s', '2', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
