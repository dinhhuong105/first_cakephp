-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 11, 2016 at 04:03 AM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `takeru_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `group_id` int(11) NOT NULL DEFAULT '1',
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` varchar(55) NOT NULL,
  `active` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0: Not active, 1: active',
  `last_login` varchar(25) NOT NULL,
  `created_at` int(11) NOT NULL DEFAULT '0',
  `updated_at` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `username`, `password`, `group_id`, `first_name`, `last_name`, `avatar`, `email`, `address`, `phone`, `active`, `last_login`, `created_at`, `updated_at`) VALUES
(1, 'admin', '123456', 1, 'Huong', 'Dinh', NULL, 'info@example.com', 'no address', '000000000', 1, '', 0, 0),
(2, 'member', '123456', 2, 'Member', 'Dinh', NULL, 'member@example.com', 'no address', '0000000001', 1, '', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `accounts_groups`
--

CREATE TABLE `accounts_groups` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` int(11) NOT NULL DEFAULT '0',
  `updated_at` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `accounts_groups`
--

INSERT INTO `accounts_groups` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 1474974193, 1474974193),
(2, 'Poster', 1474974210, 1474974210);

-- --------------------------------------------------------

--
-- Table structure for table `accounts_group_permissions`
--

CREATE TABLE `accounts_group_permissions` (
  `id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `perms_id` int(11) NOT NULL,
  `actions` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `accounts_permissions`
--

CREATE TABLE `accounts_permissions` (
  `id` int(11) NOT NULL,
  `controller` varchar(255) NOT NULL,
  `actions` text,
  `description` text,
  `created_at` int(11) NOT NULL DEFAULT '0',
  `updated_at` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `description` text NOT NULL,
  `alias` text NOT NULL,
  `meta_title` text NOT NULL,
  `meta_keyword` text NOT NULL,
  `meta_desc` text NOT NULL,
  `created_at` int(11) NOT NULL DEFAULT '0',
  `updated_at` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `picture`, `description`, `alias`, `meta_title`, `meta_keyword`, `meta_desc`, `created_at`, `updated_at`) VALUES
(13, 'News', NULL, '', 'news', 'News', 'News', 'News', 1476085756, 1476085756),
(14, 'Service', NULL, '', 'service', 'Service', 'Service', 'Service', 1476085764, 1476085764);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `picture` varchar(255) NOT NULL,
  `short` text NOT NULL,
  `content` text NOT NULL,
  `category_id` int(11) NOT NULL,
  `author_id` int(11) NOT NULL,
  `alias` text NOT NULL,
  `meta_title` text NOT NULL,
  `meta_keyword` text NOT NULL,
  `meta_desc` text NOT NULL,
  `created_at` int(11) NOT NULL DEFAULT '0',
  `updated_at` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `picture`, `short`, `content`, `category_id`, `author_id`, `alias`, `meta_title`, `meta_keyword`, `meta_desc`, `created_at`, `updated_at`) VALUES
(1, 'Dân Sài Gòn vất vả trong cơn mưa đầu tuần', 'jellyfish_3-wallpaper.jpg', 'Sáng 3/10, cơn mưa kéo dài từ 2h đến 10h sáng làm nhiều tuyến đường TP. HCM ùn ứ. Người dân vất vả trong buổi sáng đầu tuần.', '<div class="the-article-body">\r\n<table class="picture" align="center">\r\n<tbody>\r\n<tr>\r\n<td class="pic"><img src="http://img.v3.news.zdn.vn/w1024/Uploaded/mdf_dexqdd/2016_10_03/Ketxe_zing_1.jpg" alt="Dan Sai Gon vat va trong con mua dau tuan hinh anh 1" width="1916" height="1320" /></td>\r\n</tr>\r\n<tr>\r\n<td class="pCaption caption">Cơn mưa k&eacute;o d&agrave;i g&acirc;y kẹt xe tại nhiều điểm n&oacute;ng trong th&agrave;nh phố. Nhiều người trễ giờ học, giờ l&agrave;m. Ghi nhận tại đường Điện Bi&ecirc;n Phủ, quận B&igrave;nh Thạnh (hướng từ H&agrave;ng Xanh về v&ograve;ng xoay Điện Bi&ecirc;n Phủ) phương tiện &ugrave;n ứ trong cơn mưa s&aacute;ng đầu tuần.</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<table class="picture" align="center">\r\n<tbody>\r\n<tr>\r\n<td class="pic"><img src="http://img.v3.news.zdn.vn/w1024/Uploaded/mdf_dexqdd/2016_10_03/Ketxe_zing_2.jpg" alt="Dan Sai Gon vat va trong con mua dau tuan hinh anh 2" width="1980" height="1320" /></td>\r\n</tr>\r\n<tr>\r\n<td class="pCaption caption">Tại cầu Điện Bi&ecirc;n Phủ, h&agrave;ng trăm phương tiện nối đu&ocirc;i nhau xếp h&agrave;ng d&agrave;i. Xe m&aacute;y, &ocirc; t&ocirc; chen ch&uacute;c nhau di chuyển qua cầu.</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<table class="picture" align="center">\r\n<tbody>\r\n<tr>\r\n<td class="pic"><img title="D&acirc;n S&agrave;i G&ograve;n vất vả trong cơn mưa đầu tuần h&igrave;nh ảnh 3" src="http://img.v3.news.zdn.vn/w1024/Uploaded/mdf_dexqdd/2016_10_03/Ketxe_zing_3.JPG" alt="Dan Sai Gon vat va trong con mua dau tuan hinh anh 3" width="1980" height="1320" /></td>\r\n</tr>\r\n<tr>\r\n<td class="pCaption caption">Buổi s&aacute;ng trời mưa, nhiều người d&acirc;n chưa kịp ăn s&aacute;ng tranh thủ dọc đường mua đồ ăn l&oacute;t dạ.</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<table class="picture" align="center">\r\n<tbody>\r\n<tr>\r\n<td class="pic"><img title="D&acirc;n S&agrave;i G&ograve;n vất vả trong cơn mưa đầu tuần h&igrave;nh ảnh 4" src="http://img.v3.news.zdn.vn/w1024/Uploaded/mdf_dexqdd/2016_10_03/Ketxe_zing_4.jpg" alt="Dan Sai Gon vat va trong con mua dau tuan hinh anh 4" width="1980" height="1320" /></td>\r\n</tr>\r\n<tr>\r\n<td class="pCaption caption">Nhiều người mưu sinh c&oacute; một ng&agrave;y vất vả khi gặp trời mưa sớm.</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<table class="picture" align="center">\r\n<tbody>\r\n<tr>\r\n<td class="pic"><img title="D&acirc;n S&agrave;i G&ograve;n vất vả trong cơn mưa đầu tuần h&igrave;nh ảnh 5" src="http://img.v3.news.zdn.vn/w1024/Uploaded/mdf_dexqdd/2016_10_03/Ketxe_zing_5.jpg" alt="Dan Sai Gon vat va trong con mua dau tuan hinh anh 5" width="1980" height="1320" /></td>\r\n</tr>\r\n<tr>\r\n<td class="pCaption caption">Người d&acirc;n phải đội mưa đi l&agrave;m trong buổi s&aacute;ng đầu tuần.</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<table class="picture" align="center">\r\n<tbody>\r\n<tr>\r\n<td class="pic"><img title="D&acirc;n S&agrave;i G&ograve;n vất vả trong cơn mưa đầu tuần h&igrave;nh ảnh 6" src="http://img.v3.news.zdn.vn/w1024/Uploaded/mdf_dexqdd/2016_10_03/Ketxe_zing_6.jpg" alt="Dan Sai Gon vat va trong con mua dau tuan hinh anh 6" width="1898" height="1320" /></td>\r\n</tr>\r\n<tr>\r\n<td class="pCaption caption">Một người phụ nữ b&aacute;n &aacute;o mưa k&eacute;o m&aacute;i che tr&aacute;nh mưa tạt v&agrave;o quầy h&agrave;ng.</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<table class="picture" align="center">\r\n<tbody>\r\n<tr>\r\n<td class="pic"><img title="D&acirc;n S&agrave;i G&ograve;n vất vả trong cơn mưa đầu tuần h&igrave;nh ảnh 7" src="http://img.v3.news.zdn.vn/w1024/Uploaded/mdf_dexqdd/2016_10_03/Ketxe_zing_7.jpg" alt="Dan Sai Gon vat va trong con mua dau tuan hinh anh 7" width="1929" height="1320" /></td>\r\n</tr>\r\n<tr>\r\n<td class="pCaption caption">Một người đ&agrave;n &ocirc;ng lớn tuổi được một thanh ni&ecirc;n phụ đẩy xe chở th&eacute;p trong cơn mưa s&aacute;ng 3/10.</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<table class="picture" align="center">\r\n<tbody>\r\n<tr>\r\n<td class="pic"><img title="D&acirc;n S&agrave;i G&ograve;n vất vả trong cơn mưa đầu tuần h&igrave;nh ảnh 8" src="http://img.v3.news.zdn.vn/w1024/Uploaded/mdf_dexqdd/2016_10_03/Ketxe_zing_8.jpg" alt="Dan Sai Gon vat va trong con mua dau tuan hinh anh 8" width="1980" height="1320" /></td>\r\n</tr>\r\n<tr>\r\n<td class="pCaption caption">Vất vả đẩy xe sắn giữa d&ograve;ng người đ&ocirc;ng chật trong buổi s&aacute;ng mưa sớm.</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<table class="picture" align="center">\r\n<tbody>\r\n<tr>\r\n<td class="pic"><img title="D&acirc;n S&agrave;i G&ograve;n vất vả trong cơn mưa đầu tuần h&igrave;nh ảnh 9" src="http://img.v3.news.zdn.vn/w1024/Uploaded/mdf_dexqdd/2016_10_03/Ketxe_zing_9.jpg" alt="Dan Sai Gon vat va trong con mua dau tuan hinh anh 9" width="1980" height="1320" /></td>\r\n</tr>\r\n<tr>\r\n<td class="pCaption caption">Những đứa trẻ kh&ocirc;ng mấy vui vẻ khi chứng kiến cảnh kẹt xe, mưa lớn đầu tuần.</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<table class="picture" align="center">\r\n<tbody>\r\n<tr>\r\n<td class="pic"><img title="D&acirc;n S&agrave;i G&ograve;n vất vả trong cơn mưa đầu tuần h&igrave;nh ảnh 10" src="http://img.v3.news.zdn.vn/w1024/Uploaded/mdf_dexqdd/2016_10_03/Ketxe_zing_10.jpg" alt="Dan Sai Gon vat va trong con mua dau tuan hinh anh 10" width="1797" height="1320" /></td>\r\n</tr>\r\n<tr>\r\n<td class="pCaption caption">Người đ&agrave;n &ocirc;ng kh&uacute;m n&uacute;m đi giữa trời mưa tr&ecirc;n đường Điện Bi&ecirc;n Phủ, quận B&igrave;nh Thạnh.</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<table class="picture" align="center">\r\n<tbody>\r\n<tr>\r\n<td class="pic"><img title="D&acirc;n S&agrave;i G&ograve;n vất vả trong cơn mưa đầu tuần h&igrave;nh ảnh 11" src="http://img.v3.news.zdn.vn/w1024/Uploaded/mdf_dexqdd/2016_10_03/Ketxe_zing_11.jpg" alt="Dan Sai Gon vat va trong con mua dau tuan hinh anh 11" width="1980" height="1320" /></td>\r\n</tr>\r\n<tr>\r\n<td class="pCaption caption">Tranh thủ&nbsp;sửa lại m&aacute;i hi&ecirc;n che đồ điện tử cũ b&aacute;n ven đường khi gặp trời mưa.</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<table class="picture" align="center">\r\n<tbody>\r\n<tr>\r\n<td class="pic"><img title="D&acirc;n S&agrave;i G&ograve;n vất vả trong cơn mưa đầu tuần h&igrave;nh ảnh 12" src="http://img.v3.news.zdn.vn/w1024/Uploaded/mdf_dexqdd/2016_10_03/Ketxe_zing_13.jpg" alt="Dan Sai Gon vat va trong con mua dau tuan hinh anh 12" width="1980" height="1320" /></td>\r\n</tr>\r\n<tr>\r\n<td class="pCaption caption">D&ugrave; v&agrave; &aacute;o mưa l&agrave; vật dụng được d&ugrave;ng nhiều nhất trong s&aacute;ng nay tại TP. HCM.</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<table class="picture" align="center">\r\n<tbody>\r\n<tr>\r\n<td class="pic"><img src="http://img.v3.news.zdn.vn/w1024/Uploaded/mdf_dexqdd/2016_10_03/Ketxe_zing_15.jpg" alt="Dan Sai Gon vat va trong con mua dau tuan hinh anh 13" width="1980" height="1320" /></td>\r\n</tr>\r\n<tr>\r\n<td class="pCaption caption">Nhiều người chạy xe ngược chiều tr&ecirc;n cầu Điện Bi&ecirc;n Phủ l&agrave;m giao th&ocirc;ng nơi đ&acirc;y th&ecirc;m phức tạp.</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</div>', 1, 2, 'Dan-Sai-Gon-vat-va-trong-con-mua-dau-tuan', '', '', '', 0, 0),
(2, 'Dân Sài Gòn vất vả trong cơn mưa đầu tuần 1', 'golden-gate-bridge-wallpaper.jpg', 'Sáng 3/10, cơn mưa kéo dài từ 2h đến 10h sáng làm nhiều tuyến đường TP. HCM ùn ứ. Người dân vất vả trong buổi sáng đầu tuần.', '<p class="the-article-summary">S&aacute;ng 3/10, cơn mưa k&eacute;o d&agrave;i từ 2h đến 10h s&aacute;ng l&agrave;m nhiều tuyến đường TP. HCM &ugrave;n ứ. Người d&acirc;n vất vả trong buổi s&aacute;ng đầu tuần.</p>\r\n<div class="the-article-body">\r\n<table class="picture" align="center">\r\n<tbody>\r\n<tr>\r\n<td class="pic"><img src="http://img.v3.news.zdn.vn/w1024/Uploaded/mdf_dexqdd/2016_10_03/Ketxe_zing_1.jpg" alt="Dan Sai Gon vat va trong con mua dau tuan hinh anh 1" width="1916" height="1320" /></td>\r\n</tr>\r\n<tr>\r\n<td class="pCaption caption">Cơn mưa k&eacute;o d&agrave;i g&acirc;y kẹt xe tại nhiều điểm n&oacute;ng trong th&agrave;nh phố. Nhiều người trễ giờ học, giờ l&agrave;m. Ghi nhận tại đường Điện Bi&ecirc;n Phủ, quận B&igrave;nh Thạnh (hướng từ H&agrave;ng Xanh về v&ograve;ng xoay Điện Bi&ecirc;n Phủ) phương tiện &ugrave;n ứ trong cơn mưa s&aacute;ng đầu tuần.</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<table class="picture" align="center">\r\n<tbody>\r\n<tr>\r\n<td class="pic"><img title="D&acirc;n S&agrave;i G&ograve;n vất vả trong cơn mưa đầu tuần h&igrave;nh ảnh 2" src="http://img.v3.news.zdn.vn/w1024/Uploaded/mdf_dexqdd/2016_10_03/Ketxe_zing_2.jpg" alt="Dan Sai Gon vat va trong con mua dau tuan hinh anh 2" width="1980" height="1320" /></td>\r\n</tr>\r\n<tr>\r\n<td class="pCaption caption">Tại cầu Điện Bi&ecirc;n Phủ, h&agrave;ng trăm phương tiện nối đu&ocirc;i nhau xếp h&agrave;ng d&agrave;i. Xe m&aacute;y, &ocirc; t&ocirc; chen ch&uacute;c nhau di chuyển qua cầu.</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<table class="picture" align="center">\r\n<tbody>\r\n<tr>\r\n<td class="pic"><img title="D&acirc;n S&agrave;i G&ograve;n vất vả trong cơn mưa đầu tuần h&igrave;nh ảnh 3" src="http://img.v3.news.zdn.vn/w1024/Uploaded/mdf_dexqdd/2016_10_03/Ketxe_zing_3.JPG" alt="Dan Sai Gon vat va trong con mua dau tuan hinh anh 3" width="1980" height="1320" /></td>\r\n</tr>\r\n<tr>\r\n<td class="pCaption caption">Buổi s&aacute;ng trời mưa, nhiều người d&acirc;n chưa kịp ăn s&aacute;ng tranh thủ dọc đường mua đồ ăn l&oacute;t dạ.</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<table class="picture" align="center">\r\n<tbody>\r\n<tr>\r\n<td class="pic"><img title="D&acirc;n S&agrave;i G&ograve;n vất vả trong cơn mưa đầu tuần h&igrave;nh ảnh 4" src="http://img.v3.news.zdn.vn/w1024/Uploaded/mdf_dexqdd/2016_10_03/Ketxe_zing_4.jpg" alt="Dan Sai Gon vat va trong con mua dau tuan hinh anh 4" width="1980" height="1320" /></td>\r\n</tr>\r\n<tr>\r\n<td class="pCaption caption">Nhiều người mưu sinh c&oacute; một ng&agrave;y vất vả khi gặp trời mưa sớm.</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<table class="picture" align="center">\r\n<tbody>\r\n<tr>\r\n<td class="pic"><img title="D&acirc;n S&agrave;i G&ograve;n vất vả trong cơn mưa đầu tuần h&igrave;nh ảnh 5" src="http://img.v3.news.zdn.vn/w1024/Uploaded/mdf_dexqdd/2016_10_03/Ketxe_zing_5.jpg" alt="Dan Sai Gon vat va trong con mua dau tuan hinh anh 5" width="1980" height="1320" /></td>\r\n</tr>\r\n<tr>\r\n<td class="pCaption caption">Người d&acirc;n phải đội mưa đi l&agrave;m trong buổi s&aacute;ng đầu tuần.</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<table class="picture" align="center">\r\n<tbody>\r\n<tr>\r\n<td class="pic"><img title="D&acirc;n S&agrave;i G&ograve;n vất vả trong cơn mưa đầu tuần h&igrave;nh ảnh 6" src="http://img.v3.news.zdn.vn/w1024/Uploaded/mdf_dexqdd/2016_10_03/Ketxe_zing_6.jpg" alt="Dan Sai Gon vat va trong con mua dau tuan hinh anh 6" width="1898" height="1320" /></td>\r\n</tr>\r\n<tr>\r\n<td class="pCaption caption">Một người phụ nữ b&aacute;n &aacute;o mưa k&eacute;o m&aacute;i che tr&aacute;nh mưa tạt v&agrave;o quầy h&agrave;ng.</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<table class="picture" align="center">\r\n<tbody>\r\n<tr>\r\n<td class="pic"><img title="D&acirc;n S&agrave;i G&ograve;n vất vả trong cơn mưa đầu tuần h&igrave;nh ảnh 7" src="http://img.v3.news.zdn.vn/w1024/Uploaded/mdf_dexqdd/2016_10_03/Ketxe_zing_7.jpg" alt="Dan Sai Gon vat va trong con mua dau tuan hinh anh 7" width="1929" height="1320" /></td>\r\n</tr>\r\n<tr>\r\n<td class="pCaption caption">Một người đ&agrave;n &ocirc;ng lớn tuổi được một thanh ni&ecirc;n phụ đẩy xe chở th&eacute;p trong cơn mưa s&aacute;ng 3/10.</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<table class="picture" align="center">\r\n<tbody>\r\n<tr>\r\n<td class="pic"><img title="D&acirc;n S&agrave;i G&ograve;n vất vả trong cơn mưa đầu tuần h&igrave;nh ảnh 8" src="http://img.v3.news.zdn.vn/w1024/Uploaded/mdf_dexqdd/2016_10_03/Ketxe_zing_8.jpg" alt="Dan Sai Gon vat va trong con mua dau tuan hinh anh 8" width="1980" height="1320" /></td>\r\n</tr>\r\n<tr>\r\n<td class="pCaption caption">Vất vả đẩy xe sắn giữa d&ograve;ng người đ&ocirc;ng chật trong buổi s&aacute;ng mưa sớm.</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<table class="picture" align="center">\r\n<tbody>\r\n<tr>\r\n<td class="pic"><img title="D&acirc;n S&agrave;i G&ograve;n vất vả trong cơn mưa đầu tuần h&igrave;nh ảnh 9" src="http://img.v3.news.zdn.vn/w1024/Uploaded/mdf_dexqdd/2016_10_03/Ketxe_zing_9.jpg" alt="Dan Sai Gon vat va trong con mua dau tuan hinh anh 9" width="1980" height="1320" /></td>\r\n</tr>\r\n<tr>\r\n<td class="pCaption caption">Những đứa trẻ kh&ocirc;ng mấy vui vẻ khi chứng kiến cảnh kẹt xe, mưa lớn đầu tuần.</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<table class="picture" align="center">\r\n<tbody>\r\n<tr>\r\n<td class="pic"><img title="D&acirc;n S&agrave;i G&ograve;n vất vả trong cơn mưa đầu tuần h&igrave;nh ảnh 10" src="http://img.v3.news.zdn.vn/w1024/Uploaded/mdf_dexqdd/2016_10_03/Ketxe_zing_10.jpg" alt="Dan Sai Gon vat va trong con mua dau tuan hinh anh 10" width="1797" height="1320" /></td>\r\n</tr>\r\n<tr>\r\n<td class="pCaption caption">Người đ&agrave;n &ocirc;ng kh&uacute;m n&uacute;m đi giữa trời mưa tr&ecirc;n đường Điện Bi&ecirc;n Phủ, quận B&igrave;nh Thạnh.</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<table class="picture" align="center">\r\n<tbody>\r\n<tr>\r\n<td class="pic"><img title="D&acirc;n S&agrave;i G&ograve;n vất vả trong cơn mưa đầu tuần h&igrave;nh ảnh 11" src="http://img.v3.news.zdn.vn/w1024/Uploaded/mdf_dexqdd/2016_10_03/Ketxe_zing_11.jpg" alt="Dan Sai Gon vat va trong con mua dau tuan hinh anh 11" width="1980" height="1320" /></td>\r\n</tr>\r\n<tr>\r\n<td class="pCaption caption">Tranh thủ&nbsp;sửa lại m&aacute;i hi&ecirc;n che đồ điện tử cũ b&aacute;n ven đường khi gặp trời mưa.</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<table class="picture" align="center">\r\n<tbody>\r\n<tr>\r\n<td class="pic"><img src="http://img.v3.news.zdn.vn/w1024/Uploaded/mdf_dexqdd/2016_10_03/Ketxe_zing_13.jpg" alt="Dan Sai Gon vat va trong con mua dau tuan hinh anh 12" width="1980" height="1320" /></td>\r\n</tr>\r\n<tr>\r\n<td class="pCaption caption">D&ugrave; v&agrave; &aacute;o mưa l&agrave; vật dụng được d&ugrave;ng nhiều nhất trong s&aacute;ng nay tại TP. HCM.</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<table class="picture" align="center">\r\n<tbody>\r\n<tr>\r\n<td class="pic"><img src="http://img.v3.news.zdn.vn/w1024/Uploaded/mdf_dexqdd/2016_10_03/Ketxe_zing_15.jpg" alt="Dan Sai Gon vat va trong con mua dau tuan hinh anh 13" width="1980" height="1320" /></td>\r\n</tr>\r\n<tr>\r\n<td class="pCaption caption">Nhiều người chạy xe ngược chiều tr&ecirc;n cầu Điện Bi&ecirc;n Phủ l&agrave;m giao th&ocirc;ng nơi đ&acirc;y th&ecirc;m phức tạp.</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</div>', 1, 1, 'Dan-Sai-Gon-vat-va-trong-con-mua-dau-tuan-1', 'Dân Sài Gòn vất vả trong cơn mưa đầu tuần 1', 'Dân Sài Gòn vất vả trong cơn mưa đầu tuần 1', 'Dân Sài Gòn vất vả trong cơn mưa đầu tuần 1', 1, 0),
(3, 'Vietnam to scrap controversial online business rule', 'news_1.png', 'The rule has shocked the startup community.', '<p class="Normal">The startup community in Vietnam can breathe a sigh of relief now that the government has decided to get rid of a rule that would criminalize online business violations with possible jail sentences.</p>\r\n<p class="Normal">The Justice Committee of the National Assembly, Vietnam&rsquo;s top legislature, on Monday agreed with the justice ministry that Article 292 should be removed from the 2015 Penal Code.</p>\r\n<p class="Normal">The assembly is expected to make the final decision soon, but it is almost certain that the rule will be scrapped.</p>\r\n<p class="Normal">Under the article, companies providing services online without being properly registered would be fined as usual, just like most business offenses.&nbsp;But the rule would take a step further: when businesses generated a profit of VND50 million ($2,200) or revenue of VND500 million ($22,000), there would be criminal charges that could lead to jail terms of up to five years.</p>\r\n<p class="Normal">The article was enshrined in the 2015 Penal Code, which itself had been scheduled to come into effect on July 1 but later postponed due to multiple errors and loopholes. Article 292 is one of the most controversial parts of the code.</p>\r\n<p class="Normal">Justice Minister Le Thanh Long said the article has met with strong opposition.</p>\r\n<p class="Normal">The local startup community, with most members providing services online, in July filed a petition calling for the criminalization to be reviewed. The petition, sent to both the National Assembly and the cabinet, had nearly 6,000 signatures.</p>\r\n<p class="Normal">Lawyer Tran Duc Hoang said Vietnamese startups would be hurt by the article while foreign services providers such as Facebook are not subjected to strict rules.</p>\r\n<p class="Normal">The Vietnam Chamber of Commerce and Industry has recently asked legislators to scrap the article, warning of negative impacts on the economy. The chamber, which represents thousands of local comapnies, said the rule would be incongruous with the modern era of online services and startups.</p>', 1, 1, 'Vietnam-to-scrap-controversial-online-business-rule', 'Vietnam to scrap controversial online business rule', 'Vietnam to scrap controversial online business rule', 'Vietnam to scrap controversial online business rule', 1475553712, 1475553712),
(4, 'news', 'news_1.png', 'test', '<p>test aaaa</p>', 1, 1, 'news', 'news', 'news', 'news', 1475554463, 1475554463),
(5, 'test', 'news_1.png', 'test short', '<p>test content</p>', 1, 1, 'test', 'test', 'test', 'test', 1475554676, 1475554676),
(6, 'test news', 'news_1.png', 'test news short', '<p>test news content</p>', 1, 1, 'test-news', 'test news', 'test news', 'test news', 1475555714, 1475555714),
(7, 'test 123', 'news_1.png', 'sdfasdf', '<p>asdfasdf</p>', 1, 1, 'test-123', 'test 123', 'test 123', 'test 123', 1475561975, 1475561975),
(8, 'test 111', 'donald_trump.jpg', 'asfasdf', '<p>asdfasdf asdf</p>', 1, 1, 'test-111', 'test 111', 'test 111', 'test 111', 1475562516, 1475562516),
(9, 'aaa', 'pininfarina_h2_speed-wallpaper.jpg', 'aaaaa', '<p>aaaaaaaaaaaaa</p>', 1, 1, 'aaa', 'aaa', 'aaa', 'aaa', 1475565176, 1475565176),
(10, 'xxx', 'donald_trump.jpg', 'xxxxx', '<p>xxxxxxx</p>', 1, 1, 'xxx', 'xxx', 'xxx', 'xxx', 1475567822, 1475567822),
(12, 'asdsadffffffffffff', 'news_1.png', 'asdfasdf', '<p>asdfasdfasdf</p>', 1, 1, 'asdsadffffffffffff', 'asdsadffffffffffff', 'asdsadffffffffffff', 'asdsadffffffffffff', 1475567872, 1475567872),
(13, 'gggggasdfasd', 'pininfarina_h2_speed-wallpaper.jpg', 'asdfasdfasdf', '<p>asdfasdfasdf</p>', 1, 1, 'gggggasdfasd', 'gggggasdfasd', 'gggggasdfasd', 'gggggasdfasd', 1475567920, 1475567920),
(14, 'asdffffdfdfd', 'news_1.png', 'dfdfdfdf', '<p>dfdfdfdf</p>', 1, 1, 'asdffffdfdfd', 'asdffffdfdfd', 'asdffffdfdfd', 'asdffffdfdfd', 1475568574, 1475568574),
(15, 'sddddsdfsdf', 'news_1.png', 'sdsdfsfsdf', '<p>sdfsdfsdfsdf</p>', 1, 1, 'sddddsdfsdf', 'sddddsdfsdf', 'sddddsdfsdf', 'sddddsdfsdf', 1475568617, 1475568617),
(16, 'asasfsdfasssssdfas', 'news_1.png', 'asdfasdf', '<p>asdfasdfasdf</p>', 1, 1, 'asasfsdfasssssdfas', 'asasfsdfasssssdfas', 'asasfsdfasssssdfas', 'asasfsdfasssssdfas', 1475569259, 1475569259),
(25, 'adfasdasdfasdfasdf', 'news_1.png', 'asdfasdf', '<p>asdfasdf</p>', 1, 1, 'adfasdasdfasdfasdf', 'adfasdasdfasdfasdf', 'adfasdasdfasdfasdf', 'adfasdasdfasdfasdf', 1475570328, 1475570328),
(26, 'asdfasdfasd fas', 'news_1.png', 'sdfa sdf asdf ', '<p>asdf asdfasdf&nbsp;</p>', 1, 1, 'asdfasdfasd-fas', 'asdfasdfasd fas', 'asdfasdfasd fas', 'asdfasdfasd fas', 1475570407, 1475570407),
(29, 'zxvzxcv', 'golden-gate-bridge-wallpaper.jpg', 'zxcvzxcvc', '<p>zxcvzxcv</p>', 1, 1, 'zxvzxcv', 'zxvzxcv', 'zxvzxcv', 'zxvzxcv', 1475570902, 1475570902),
(30, 'tweasfasdf', 'donald_trump.jpg', 'asdfasdf', '<p>asdfasdfasdf</p>', 1, 1, 'tweasfasdf', 'tweasfasdf', 'tweasfasdf', 'tweasfasdf', 1475571045, 1475571045),
(31, 'asdfaZDVZXCVZXCV', 'news_1.png', 'ZXVZXCV', '<p>asdasdfasd</p>', 1, 1, 'asdfazdvzxcvzxcv', 'asdfaZDVZXCVZXCV', 'asdfaZDVZXCVZXCV', 'asdfaZDVZXCVZXCV', 1475571516, 1475571516),
(32, 'asssssssssssasdfasd', 'news_1.png', 'asdfadsf', '<p>asdfadsf</p>', 1, 1, 'asssssssssssasdfasd', 'asssssssssssasdfasd', 'asssssssssssasdfasd', 'asssssssssssasdfasd', 1475571766, 1475571766),
(33, 'test news with tags', 'jellyfish_3-wallpaper.jpg', 'short section', '<p>content section</p>', 1, 1, 'test-news-with-tags', 'test news with tags', 'test news with tags', 'test news with tags', 1475573187, 1475573187),
(34, 'test tags asdfasd', 'golden-gate-bridge-wallpaper.jpg', 'asdfasdfa', '<p>asdfasdf</p>', 1, 1, 'test-tags-asdfasd', 'test tags asdfasd', 'test tags asdfasd', 'test tags asdfasd', 1475579663, 1475579663),
(35, 'asdfasggggadfadf', 'jellyfish_3-wallpaper.jpg', 'asdfadfasdf', '<p>asdfasdfadsf</p>\r\n<p><img src="../../../webroot/js/admin/tinymce/plugins/fileman/Uploads/Images/jellyfish_3_wallpaper.jpg" alt="" width="1000" height="562" /></p>', 13, 1, 'asdfasggggadfadf', 'asdfasggggadfadf', 'asdfasggggadfadf', 'asdfasggggadfadf', 1475579749, 1476088398),
(36, 'afdsdf', 'pininfarina_h2_speed-wallpaper.jpg', 'asdfasdf', '<p>asdfasdfasf</p>', 1, 1, 'afdsdf', 'afdsdf', 'afdsdf', 'afdsdf', 1475633076, 1475633076),
(37, 'adddsssss edit', 'jellyfish_3-wallpaper.jpg', 'asdfasdf edit', '<p>asdfasfdasdfasd edit</p>', 2, 1, 'edit-alias', 'adddsssss', 'adddsssss', 'adddsssss', 1475633208, 1475736564),
(38, 'test admin panel', 'pininfarina_h2_speed-wallpaper.jpg', 'asdfasdf', '<p>asdfasdf</p>\r\n<p>test aaaadsafda</p>', 13, 1, 'test-admin-panel', 'test admin panel', 'test admin panel', 'test admin panel', 1475750569, 1476087487);

-- --------------------------------------------------------

--
-- Table structure for table `posts_tags`
--

CREATE TABLE `posts_tags` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `posts_tags`
--

INSERT INTO `posts_tags` (`id`, `post_id`, `tag_id`) VALUES
(6, 36, 2),
(37, 37, 2),
(33, 37, 7),
(63, 38, 1),
(64, 38, 2);

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `alias` text NOT NULL,
  `meta_title` varchar(255) NOT NULL,
  `meta_keyword` text NOT NULL,
  `meta_desc` text NOT NULL,
  `created_at` int(11) NOT NULL DEFAULT '0',
  `updated_at` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`id`, `name`, `alias`, `meta_title`, `meta_keyword`, `meta_desc`, `created_at`, `updated_at`) VALUES
(1, 'Test', 'test-edit-tags', 'test edit tags', 'test edit tags', 'test', 0, 1476082781),
(2, 'Vietnam', '', 'Vietnam', 'Vietnam', 'Vietnam', 0, 0),
(7, 'add new tag', '', 'add new tag', 'add new tag', 'add new tag', 1475736459, 1475736459),
(14, 'About Us Edit', 'about-us-edit', 'About Us Edit', 'About Us Edit', 'About Us Edit', 1476081822, 1476081822),
(15, 'Tag 1', 'tag-1', 'Tag 1', 'Tag 1', 'Tag 1', 1476085497, 1476085497),
(16, 'Tags 2', 'tags-2', 'Tags 2', 'Tags 2', 'Tags 2', 1476085506, 1476085506),
(17, 'Tag 3', 'tag-3', 'Tag 3', 'Tag 3', 'Tag 3', 1476085514, 1476085514),
(18, 'Tag 4', 'tag-4', 'Tag 4', 'Tag 4', 'Tag 4', 1476085521, 1476085521),
(19, 'Tag 5', 'tag-5', 'Tag 5', 'Tag 5', 'Tag 5', 1476085529, 1476085529),
(21, 'Tag 6', 'tag-6', 'Tag 6', 'Tag 6', 'Tag 6', 1476085565, 1476085565),
(22, 'Tag 7', 'tag-7', 'Tag 7', 'Tag 7', 'Tag 7', 1476085602, 1476085602),
(23, 'Tag 8', 'tag-8', 'Tag 8', 'Tag 8', 'Tag 8', 1476085609, 1476085609),
(24, 'Tag 9', 'tag-9', 'Tag 9', 'Tag 9', 'Tag 9', 1476085616, 1476085616),
(25, 'Tag 10', 'tag-10', 'Tag 10', 'Tag 10', 'Tag 10', 1476085622, 1476085622),
(26, 'Tag test', 'tag-test', 'Tag test', 'Tag test', 'Tag test', 1476085653, 1476085653),
(27, 'Tag 2', 'tag-2', ' tag 2', ' tag 2', ' tag 2', 1476086917, 1476086971),
(28, ' tag 2', '', ' tag 2', ' tag 2', ' tag 2', 1476091302, 1476091302),
(29, ' tag 3', '', ' tag 3', ' tag 3', ' tag 3', 1476091302, 1476091302);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `group_id` (`group_id`);

--
-- Indexes for table `accounts_groups`
--
ALTER TABLE `accounts_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `accounts_group_permissions`
--
ALTER TABLE `accounts_group_permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `group_id` (`group_id`),
  ADD UNIQUE KEY `perms_id` (`perms_id`);

--
-- Indexes for table `accounts_permissions`
--
ALTER TABLE `accounts_permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `controller` (`controller`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cat_name` (`name`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts_tags`
--
ALTER TABLE `posts_tags`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tag_key` (`post_id`,`tag_id`),
  ADD KEY `tag_id` (`tag_id`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tag_name` (`name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `accounts_groups`
--
ALTER TABLE `accounts_groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `accounts_group_permissions`
--
ALTER TABLE `accounts_group_permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `accounts_permissions`
--
ALTER TABLE `accounts_permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
--
-- AUTO_INCREMENT for table `posts_tags`
--
ALTER TABLE `posts_tags`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;
--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `accounts`
--
ALTER TABLE `accounts`
  ADD CONSTRAINT `group_id` FOREIGN KEY (`group_id`) REFERENCES `accounts_groups` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
