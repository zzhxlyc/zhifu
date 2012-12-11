/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50141
Source Host           : localhost:3306
Source Database       : zhifu

Target Server Type    : MYSQL
Target Server Version : 50141
File Encoding         : 65001

Date: 2012-12-11 11:20:45
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `admins`
-- ----------------------------
DROP TABLE IF EXISTS `admins`;
CREATE TABLE `admins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `flag` tinyint(4) DEFAULT NULL,
  `user` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `limit` int(11) DEFAULT NULL,
  `lastlogin` datetime DEFAULT NULL,
  `lastip` varchar(100) DEFAULT NULL,
  `time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of admins
-- ----------------------------
INSERT INTO `admins` VALUES ('1', '1', 'root', '202cb962ac59075b964b07152d234b70', '0', '2012-12-11 10:36:27', '::1', '2012-06-26 15:16:33');
INSERT INTO `admins` VALUES ('11', '1', 'admin', '202cb962ac59075b964b07152d234b70', '0', '2012-10-23 18:02:00', '::1', '2012-07-26 20:19:31');

-- ----------------------------
-- Table structure for `applys`
-- ----------------------------
DROP TABLE IF EXISTS `applys`;
CREATE TABLE `applys` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `identity` tinyint(4) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `sex` tinyint(4) DEFAULT NULL,
  `age` tinyint(4) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `mobile` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `area` varchar(255) DEFAULT NULL,
  `degree` tinyint(4) DEFAULT NULL,
  `year` tinyint(4) DEFAULT NULL,
  `description` text,
  `evaluate` text,
  `available` varchar(255) DEFAULT NULL,
  `deadline` date DEFAULT NULL,
  `belong` int(11) DEFAULT NULL,
  `type` varchar(20) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `author` varchar(255) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of applys
-- ----------------------------
INSERT INTO `applys` VALUES ('1', '我要当洗碗工啦1', '3', '孙悟空', '1', '127', null, '54312', 'huhu@qq.com', '水帘洞', '紫金港校区', '2', '11', '133的', '2141424分', '', null, '1', 'Company', 'lyc', '', '1', '2012-09-24 11:28:03');
INSERT INTO `applys` VALUES ('2', '发布求职信息', '3', '我市企业', '1', '0', null, '123456', 'liuyunchao@zju.edu.cn', '', '', '0', '0', '', '', '0-0-0 1-1-1 0-0-0 0-0-0 0-0-0 0-0-0 0-0-0', null, '1', 'Company', 'lyc', '我市企业', '1', '2012-11-01 09:09:49');

-- ----------------------------
-- Table structure for `articles`
-- ----------------------------
DROP TABLE IF EXISTS `articles`;
CREATE TABLE `articles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `content` text,
  `admin` int(11) DEFAULT NULL,
  `author` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `file` varchar(255) DEFAULT NULL,
  `click` int(11) DEFAULT NULL,
  `time` datetime DEFAULT NULL,
  `lastmodify` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of articles
-- ----------------------------
INSERT INTO `articles` VALUES ('1', '发一篇文章', '<p>\r\n	<span style=\"color: rgb(0, 0, 0); font-family: arial, 宋体, sans-serif; font-size: 14px; line-height: 24px; \">原本可能是一个门的</span><a href=\"http://baike.baidu.com/view/115742.htm\" style=\"color: rgb(19, 110, 194); font-family: arial, 宋体, sans-serif; font-size: 14px; line-height: 24px; \" target=\"_blank\">符号</a><span style=\"color: rgb(0, 0, 0); font-family: arial, 宋体, sans-serif; font-size: 14px; line-height: 24px; \">，像在古埃及的</span><a href=\"http://baike.baidu.com/view/104404.htm\" style=\"color: rgb(19, 110, 194); font-family: arial, 宋体, sans-serif; font-size: 14px; line-height: 24px; \" target=\"_blank\">象形文字</a><span style=\"color: rgb(0, 0, 0); font-family: arial, 宋体, sans-serif; font-size: 14px; line-height: 24px; \">里（1）。最早什么时候出现在</span><a href=\"http://baike.baidu.com/view/179090.htm\" style=\"color: rgb(19, 110, 194); font-family: arial, 宋体, sans-serif; font-size: 14px; line-height: 24px; \" target=\"_blank\">闪族</a><span style=\"color: rgb(0, 0, 0); font-family: arial, 宋体, sans-serif; font-size: 14px; line-height: 24px; \">的书面当中我们已经无法知道了。大约在</span><a href=\"http://baike.baidu.com/view/1039767.htm\" style=\"color: rgb(19, 110, 194); font-family: arial, 宋体, sans-serif; font-size: 14px; line-height: 24px; \" target=\"_blank\">公元前</a><span style=\"color: rgb(0, 0, 0); font-family: arial, 宋体, sans-serif; font-size: 14px; line-height: 24px; \">1000年，在比布鲁斯（</span><a href=\"http://baike.baidu.com/view/366210.htm\" style=\"color: rgb(19, 110, 194); font-family: arial, 宋体, sans-serif; font-size: 14px; line-height: 24px; \" target=\"_blank\">古地中海</a><span style=\"color: rgb(0, 0, 0); font-family: arial, 宋体, sans-serif; font-size: 14px; line-height: 24px; \">港市，位于现黎嫩</span><a href=\"http://baike.baidu.com/view/132820.htm\" style=\"color: rgb(19, 110, 194); font-family: arial, 宋体, sans-serif; font-size: 14px; line-height: 24px; \" target=\"_blank\">贝鲁特</a><span style=\"color: rgb(0, 0, 0); font-family: arial, 宋体, sans-serif; font-size: 14px; line-height: 24px; \">以北的朱拜勒，公元第二千年成为繁华的</span><a href=\"http://baike.baidu.com/view/36703.htm\" style=\"color: rgb(19, 110, 194); font-family: arial, 宋体, sans-serif; font-size: 14px; line-height: 24px; \" target=\"_blank\">腓尼基</a><span style=\"color: rgb(0, 0, 0); font-family: arial, 宋体, sans-serif; font-size: 14px; line-height: 24px; \">城）和腓尼基的其他一些方以及迦南的中心这符号是特定的线性形式（2），对于的性形式来说。在闪族的语言叫做th，意思door（门）。</span></p>\r\n<div class=\"spctrl\" style=\"height: 14px; line-height: 14px; overflow: hidden; color: rgb(0, 0, 0); font-family: arial, 宋体, sans-serif; \">\r\n	&nbsp;</div>\r\n<p>\r\n	<span style=\"color: rgb(0, 0, 0); font-family: arial, 宋体, sans-serif; font-size: 14px; line-height: 24px; \">　　</span><a href=\"http://baike.baidu.com/view/310524.htm\" style=\"color: rgb(19, 110, 194); font-family: arial, 宋体, sans-serif; font-size: 14px; line-height: 24px; \" target=\"_blank\">希腊人</a><span style=\"color: rgb(0, 0, 0); font-family: arial, 宋体, sans-serif; font-size: 14px; line-height: 24px; \">重新改变的</span><a href=\"http://baike.baidu.com/view/1519757.htm\" style=\"color: rgb(19, 110, 194); font-family: arial, 宋体, sans-serif; font-size: 14px; line-height: 24px; \" target=\"_blank\">闪族人</a><span style=\"color: rgb(0, 0, 0); font-family: arial, 宋体, sans-serif; font-size: 14px; line-height: 24px; \">的命名为delta他们保留了</span><a href=\"http://baike.baidu.com/view/262077.htm\" style=\"color: rgb(19, 110, 194); font-family: arial, 宋体, sans-serif; font-size: 14px; line-height: 24px; \" target=\"_blank\">腓尼基人</a><span style=\"color: rgb(0, 0, 0); font-family: arial, 宋体, sans-serif; font-size: 14px; line-height: 24px; \">的符号（3）。在</span><a href=\"http://baike.baidu.com/view/3784.htm\" style=\"color: rgb(19, 110, 194); font-family: arial, 宋体, sans-serif; font-size: 14px; line-height: 24px; \" target=\"_blank\">意大利</a><span style=\"color: rgb(0, 0, 0); font-family: arial, 宋体, sans-serif; font-size: 14px; line-height: 24px; \">的殖民地-希腊的Khalkis（或Chalcis-卡尔</span><a href=\"http://baike.baidu.com/view/1641230.htm\" style=\"color: rgb(19, 110, 194); font-family: arial, 宋体, sans-serif; font-size: 14px; line-height: 24px; \" target=\"_blank\">基斯</a><span style=\"color: rgb(0, 0, 0); font-family: arial, 宋体, sans-serif; font-size: 14px; line-height: 24px; \">(希腊东南部一港市）</span><a href=\"http://baike.baidu.com/view/256204.htm\" style=\"color: rgb(19, 110, 194); font-family: arial, 宋体, sans-serif; font-size: 14px; line-height: 24px; \" target=\"_blank\">母</a><span style=\"color: rgb(0, 0, 0); font-family: arial, 宋体, sans-serif; font-size: 14px; line-height: 24px; \">有了轻微的弧度（4）。这种形状致使它也存在于</span><a href=\"http://baike.baidu.com/view/18498.htm\" style=\"color: rgb(19, 110, 194); font-family: arial, 宋体, sans-serif; font-size: 14px; line-height: 24px; \" target=\"_blank\">拉丁文</a><span style=\"color: rgb(0, 0, 0); font-family: arial, 宋体, sans-serif; font-size: 14px; line-height: 24px; \">的书写中（5）。从拉丁时代这个三角逐渐的被圆滑（6）</span></p>\r\n', '1', '', null, null, '17', '2012-09-25 09:19:40', null);
INSERT INTO `articles` VALUES ('2', '标题标题标题标题标题标题标题标题', '<p>\r\n	<span style=\"color: rgb(51, 51, 51); font-family: tahoma, arial, 宋体; line-height: 18px;\">内容</span><span style=\"color: rgb(51, 51, 51); font-family: tahoma, arial, 宋体; line-height: 18px;\">内容</span><span style=\"color: rgb(51, 51, 51); font-family: tahoma, arial, 宋体; line-height: 18px;\">内容</span><span style=\"color: rgb(51, 51, 51); font-family: tahoma, arial, 宋体; line-height: 18px;\">内容</span><span style=\"color: rgb(51, 51, 51); font-family: tahoma, arial, 宋体; line-height: 18px;\">内容</span><span style=\"color: rgb(51, 51, 51); font-family: tahoma, arial, 宋体; line-height: 18px;\">内容</span><span style=\"color: rgb(51, 51, 51); font-family: tahoma, arial, 宋体; line-height: 18px;\">内容</span><span style=\"color: rgb(51, 51, 51); font-family: tahoma, arial, 宋体; line-height: 18px;\">内容</span><span style=\"color: rgb(51, 51, 51); font-family: tahoma, arial, 宋体; line-height: 18px;\">内容</span><span style=\"color: rgb(51, 51, 51); font-family: tahoma, arial, 宋体; line-height: 18px;\">内容</span><span style=\"color: rgb(51, 51, 51); font-family: tahoma, arial, 宋体; line-height: 18px;\">内容</span><span style=\"color: rgb(51, 51, 51); font-family: tahoma, arial, 宋体; line-height: 18px;\">内容</span><span style=\"color: rgb(51, 51, 51); font-family: tahoma, arial, 宋体; line-height: 18px;\">内容</span></p>\r\n', '1', '', '2012/12/1354712742213.jpg', '2012/12/1354712742647.jpg', '0', '2012-12-05 21:05:42', '2012-12-05 21:05:42');

-- ----------------------------
-- Table structure for `categorys`
-- ----------------------------
DROP TABLE IF EXISTS `categorys`;
CREATE TABLE `categorys` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `parent` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of categorys
-- ----------------------------
INSERT INTO `categorys` VALUES ('1', '工业', '0');
INSERT INTO `categorys` VALUES ('2', '农业', '0');
INSERT INTO `categorys` VALUES ('3', '机械', '1');
INSERT INTO `categorys` VALUES ('4', '养殖', '2');
INSERT INTO `categorys` VALUES ('7', '冶金', '1');
INSERT INTO `categorys` VALUES ('9', '汽车', '1');
INSERT INTO `categorys` VALUES ('10', '航空', '1');
INSERT INTO `categorys` VALUES ('11', '五金', '1');
INSERT INTO `categorys` VALUES ('12', '采矿', '1');

-- ----------------------------
-- Table structure for `comments`
-- ----------------------------
DROP TABLE IF EXISTS `comments`;
CREATE TABLE `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `object` int(11) DEFAULT NULL,
  `type` varchar(20) DEFAULT NULL,
  `user` int(11) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `author` varchar(255) DEFAULT NULL,
  `user_type` varchar(20) DEFAULT NULL,
  `content` varchar(511) DEFAULT NULL,
  `time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of comments
-- ----------------------------
INSERT INTO `comments` VALUES ('1', '1', 'Problem', '1', null, '浙江大学', 'Company', '撒个股', '2012-09-24 12:24:57');
INSERT INTO `comments` VALUES ('2', '1', 'Problem', '1', null, '韩盼盼', 'Expert', '回复 浙江大学：哥哥', '2012-09-24 12:25:05');
INSERT INTO `comments` VALUES ('3', '2', 'Problem', '1', null, '韩盼盼', 'Expert', '法国人更', '2012-09-24 15:49:35');
INSERT INTO `comments` VALUES ('4', '1', 'Video', '1', null, '浙江大学', 'Company', '发送发', '2012-09-24 18:25:51');
INSERT INTO `comments` VALUES ('5', '1', 'Company', '1', 'lyc', '浙江大学', 'Company', 'ss', '2012-09-25 10:44:40');
INSERT INTO `comments` VALUES ('6', '4', 'Video', '1', 'lyc', '我市企业', 'Company', 'g5gtr', '2012-10-16 19:38:29');
INSERT INTO `comments` VALUES ('7', '2', 'Idea', '1', 'hpp', '韩盼盼', 'Expert', 'gega', '2012-10-25 10:55:19');
INSERT INTO `comments` VALUES ('8', '2', 'Idea', '1', 'hpp', '韩盼盼', 'Expert', 'fwfwf', '2012-10-25 10:56:39');
INSERT INTO `comments` VALUES ('9', '2', 'Idea', '1', 'hpp', '韩盼盼', 'Expert', 'rwrwr', '2012-10-25 10:57:42');
INSERT INTO `comments` VALUES ('10', '2', 'Patent', '1', 'hpp', '韩盼盼', 'Expert', '嘎嘎嘎', '2012-10-25 11:23:22');
INSERT INTO `comments` VALUES ('11', '2', 'Patent', '1', 'lyc', '我市企业', 'Company', '回复 hpp：发送飞洒', '2012-10-25 11:23:34');

-- ----------------------------
-- Table structure for `companys`
-- ----------------------------
DROP TABLE IF EXISTS `companys`;
CREATE TABLE `companys` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `contact` varchar(255) DEFAULT NULL,
  `description` text,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `mobile` varchar(20) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `budget` double DEFAULT NULL,
  `problems` int(11) DEFAULT NULL,
  `ideas` int(11) DEFAULT NULL,
  `rate_total` int(11) DEFAULT NULL,
  `rate_num` int(11) DEFAULT NULL,
  `credit` int(11) DEFAULT NULL,
  `license` varchar(255) DEFAULT NULL,
  `verified` tinyint(4) DEFAULT NULL,
  `time` datetime DEFAULT NULL,
  `lastlogin` datetime DEFAULT NULL,
  `lastip` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of companys
-- ----------------------------
INSERT INTO `companys` VALUES ('1', 'lyc', '202cb962ac59075b964b07152d234b70', '我市企业', '刘玉翠', '高凤阁然后然后发\r\n', 'liuyunchao@zju.edu.cn', '13444515', '1234567', 'http://blog.stariy.org/', '2012/11/1352444644351.jpg', '0', '1', '2', '4', '1', '0', '2012/11/1352444781166.jpg', '1', '2012-09-24 11:20:01', '2012-12-11 09:33:06', '::1');
INSERT INTO `companys` VALUES ('3', 'abc', '202cb962ac59075b964b07152d234b70', null, null, null, 'ew424A@eqwrwqf.com', null, '134', null, null, '0', '0', '0', '0', '0', '0', null, '0', '2012-10-18 20:02:29', null, null);

-- ----------------------------
-- Table structure for `deals`
-- ----------------------------
DROP TABLE IF EXISTS `deals`;
CREATE TABLE `deals` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `patent` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `price` varchar(255) DEFAULT NULL,
  `note` text,
  `ip` varchar(20) DEFAULT NULL,
  `dis1` varchar(20) DEFAULT NULL,
  `dis2` varchar(20) DEFAULT NULL,
  `belong` int(11) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `author` varchar(255) DEFAULT NULL,
  `time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of deals
-- ----------------------------
INSERT INTO `deals` VALUES ('4', '1', '柳云超', '123', '312', '43若高铁', null, '浙江省', '杭州市', '1', 'Company', 'lyc', '我市企业', '2012-10-18 19:35:39');
INSERT INTO `deals` VALUES ('5', '2', '哈哈哈', '23132', 'aw3', 'fefeg', null, '浙江省', '宁波市', '1', 'Company', 'lyc', '我市企业', '2012-11-23 16:16:23');
INSERT INTO `deals` VALUES ('6', '2', '紫罗兰', '4324324', '313万', '2323', null, '浙江省', '绍兴市', '2', 'Expert', 'zll', '周琳琳', '2012-11-23 16:20:25');
INSERT INTO `deals` VALUES ('7', '2', '飞狐额', '0571-48353', '若53他', '纷纷', '::1', '', '', '1', 'Company', 'lyc', '我市企业', '2012-11-28 10:33:40');
INSERT INTO `deals` VALUES ('9', '2', '风格', '23213213', '2323', '无发热瓦', '::1', '', '', '1', 'Company', 'lyc', '我市企业', '2012-11-28 10:51:14');
INSERT INTO `deals` VALUES ('10', '1', '温家1宝', '2232432', '232', '32323', '::1', '', '', '1', 'Company', 'lyc', '我市企业', '2012-11-28 11:48:46');
INSERT INTO `deals` VALUES ('11', '1', '2343', '2324223', '2424', '1温家3宝2', '::1', '', '', '1', 'Company', 'lyc', '我市企业', '2012-11-28 11:49:09');
INSERT INTO `deals` VALUES ('12', '1', '潘炫帆', '13453434242', '11万', '阿发给', '::1', '', '', '2', 'Expert', 'zll', '周琳琳', '2012-11-28 12:20:06');
INSERT INTO `deals` VALUES ('13', '1', '潘炫帆', '13453434242', '11万', '阿发给', '::1', '', '', '2', 'Expert', 'zll', '周琳琳', '2012-11-28 12:20:45');

-- ----------------------------
-- Table structure for `deal_items`
-- ----------------------------
DROP TABLE IF EXISTS `deal_items`;
CREATE TABLE `deal_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `comment` varchar(1023) DEFAULT NULL,
  `deal` int(11) DEFAULT NULL,
  `patent` int(11) DEFAULT NULL,
  `isowner` tinyint(4) DEFAULT NULL,
  `dis1` varchar(20) DEFAULT NULL,
  `dis2` varchar(20) DEFAULT NULL,
  `belong` int(11) DEFAULT NULL,
  `type` varchar(20) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `author` varchar(255) DEFAULT NULL,
  `ip` varchar(50) DEFAULT NULL,
  `time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of deal_items
-- ----------------------------
INSERT INTO `deal_items` VALUES ('1', '发送飞洒', '5', '2', null, '', '', '1', 'Company', 'lyc', '我市企业', '::1', '2012-11-28 11:31:41');
INSERT INTO `deal_items` VALUES ('2', '阿飞飞鸽', '5', '2', null, '', '', '1', 'Company', 'lyc', '我市企业', '::1', '2012-11-28 11:33:18');
INSERT INTO `deal_items` VALUES ('3', 'Hi，', '4', '1', null, '', '', '1', 'Expert', 'hpp', '韩盼盼', '::1', '2012-11-28 11:41:42');
INSERT INTO `deal_items` VALUES ('4', 'mm~', '4', '1', null, '', '', '1', 'Expert', 'hpp', '韩盼盼', '::1', '2012-11-28 11:41:56');
INSERT INTO `deal_items` VALUES ('5', '股份嘎嘎', '4', '1', null, '', '', '2', 'Expert', 'zll', '周琳琳', '::1', '2012-11-28 11:45:03');
INSERT INTO `deal_items` VALUES ('6', '我来看看', '11', '1', null, '', '', '1', 'Company', 'lyc', '我市企业', '::1', '2012-11-28 11:50:00');
INSERT INTO `deal_items` VALUES ('7', '继续看看', '11', '1', null, '', '', '2', 'Expert', 'zll', '周琳琳', '::1', '2012-11-28 11:50:12');

-- ----------------------------
-- Table structure for `experts`
-- ----------------------------
DROP TABLE IF EXISTS `experts`;
CREATE TABLE `experts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `workplace` varchar(255) DEFAULT NULL,
  `job` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `mobile` varchar(20) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `budget` double DEFAULT NULL,
  `credit` int(11) DEFAULT NULL,
  `problems` int(11) DEFAULT NULL,
  `ideas` int(11) DEFAULT NULL,
  `patents` int(11) DEFAULT NULL,
  `rate_total` int(11) DEFAULT NULL,
  `rate_num` int(11) DEFAULT NULL,
  `verified` tinyint(4) DEFAULT NULL,
  `time` datetime DEFAULT NULL,
  `lastlogin` datetime DEFAULT NULL,
  `lastip` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of experts
-- ----------------------------
INSERT INTO `experts` VALUES ('1', 'hpp', '202cb962ac59075b964b07152d234b70', '韩盼盼', '浙江大学', '学生', 'hanpanpan@zju.edu.cn', '12345', '654321111', 'http://zjuhpp.com', '噶额个股', '2012/11/1352443886856.jpg', '0', '0', '1', '0', '1', '8', '2', '1', '2012-09-24 11:20:18', '2012-12-11 09:35:46', '::1');
INSERT INTO `experts` VALUES ('2', 'zll', '202cb962ac59075b964b07152d234b70', '周琳琳', '', '', 'zll@qq.com', '', null, '', '', '2012/09/1348537808279.jpg', '0', '0', '0', '0', '0', '0', '0', '0', '2012-09-25 09:35:27', null, null);
INSERT INTO `experts` VALUES ('3', '&#92;', 'e10adc3949ba59abbe56e057f20f883e', null, null, null, 'afdwf@qq.com', null, '24324325325', null, null, null, '0', '0', '0', '0', '0', '0', '0', '0', '2012-09-27 09:18:21', null, null);

-- ----------------------------
-- Table structure for `files`
-- ----------------------------
DROP TABLE IF EXISTS `files`;
CREATE TABLE `files` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `path` varchar(255) DEFAULT NULL,
  `belong` int(11) DEFAULT NULL,
  `type` varchar(20) DEFAULT NULL,
  `time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of files
-- ----------------------------

-- ----------------------------
-- Table structure for `ideas`
-- ----------------------------
DROP TABLE IF EXISTS `ideas`;
CREATE TABLE `ideas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company` int(11) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `author` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `cat` smallint(6) DEFAULT NULL,
  `subcat` smallint(6) DEFAULT NULL,
  `budget` double DEFAULT NULL,
  `deadline` date DEFAULT NULL,
  `description` text,
  `one` tinyint(4) DEFAULT NULL,
  `one_m` double DEFAULT NULL,
  `two` tinyint(4) DEFAULT NULL,
  `two_m` double DEFAULT NULL,
  `three` tinyint(4) DEFAULT NULL,
  `three_m` double DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `file` varchar(255) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `closed` tinyint(4) DEFAULT NULL,
  `time` datetime DEFAULT NULL,
  `lastmodify` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ideas
-- ----------------------------
INSERT INTO `ideas` VALUES ('1', '1', 'hpp', '', '第一个创意悬赏', null, null, '1', '3', '10', '2012-11-03', '<p>\r\n	啊啊啊啊啊</p>\r\n', '1', '3', '2', '2', '3', '1', null, null, '0', '1', '2012-09-24 11:26:47', '2012-09-24 11:26:47');
INSERT INTO `ideas` VALUES ('2', '1', 'lyc', '我市企业', '第二个创意悬赏', null, null, '2', '4', '0', '2012-11-16', '<p>\r\n	<label for=\"\" style=\"display: block; float: left; width: 90px; padding-top: 3px; font-weight: bold; text-align: right; padding-right: 10px; color: rgb(51, 51, 51); font-family: tahoma, arial, 宋体; line-height: 18px; \">详细描述</label></p>\r\n', '1', '3', '0', '0', '0', '0', '2012/10/1351132516158.jpg', null, '2', '0', '2012-10-25 10:34:17', '2012-10-31 21:21:24');
INSERT INTO `ideas` VALUES ('3', '1', 'lyc', '我市企业', '创意悬赏创意悬赏', null, null, '-1', '-1', '22', '1970-01-01', '<p>\r\n	gewg法国法额个股</p>\r\n', '0', '0', '0', '0', '0', '0', null, null, '0', '1', '2012-10-25 10:59:33', '2012-10-25 10:59:37');
INSERT INTO `ideas` VALUES ('4', '1', 'lyc', '我市企业', '无法无法', null, null, '2', '4', '22', '0000-00-00', '<p>\r\n	22</p>\r\n', '0', '0', '0', '0', '0', '0', null, null, '0', '0', '2012-10-31 21:21:51', '2012-10-31 21:22:16');
INSERT INTO `ideas` VALUES ('5', '1', 'lyc', '我市企业', '名称名称', '公司公司', '235235', '1', '10', '33', '0000-00-00', '<p>\r\n	<span style=\"color: rgb(51, 51, 51); font-family: tahoma, arial, 宋体; font-weight: bold; line-height: 18px; text-align: right; \">公司</span><span style=\"color: rgb(51, 51, 51); font-family: tahoma, arial, 宋体; font-weight: bold; line-height: 18px; text-align: right; \">公司</span></p>\r\n', '0', '0', '0', '0', '0', '0', null, null, '2', '0', '2012-11-06 10:17:22', '2012-11-06 10:17:22');
INSERT INTO `ideas` VALUES ('6', '1', 'lyc', '我市企业', '悬赏悬赏悬赏悬赏', '我市企业', '13444515', '0', '0', '22', '2012-12-30', '<p>\r\n	额嘎嘎<span style=\"background-color: rgb(248, 248, 248); color: rgb(51, 51, 51); font-family: tahoma, arial, 宋体; font-weight: bold; line-height: 30px; text-align: right;\">详细描述</span><span style=\"background-color: rgb(248, 248, 248); color: rgb(51, 51, 51); font-family: tahoma, arial, 宋体; font-weight: bold; line-height: 30px; text-align: right;\">详细描述</span><span style=\"background-color: rgb(248, 248, 248); color: rgb(51, 51, 51); font-family: tahoma, arial, 宋体; font-weight: bold; line-height: 30px; text-align: right;\">详细描述</span></p>\r\n', '1', '11', '1', '11', '0', '0', '2012/12/1355189720273.jpg', null, '0', '0', '2012-12-11 09:35:20', '2012-12-11 09:35:20');
INSERT INTO `ideas` VALUES ('7', '1', 'lyc', '我市企业', '新的创意悬赏', '我市企业', '13444515', '1', '3', '44', '2012-12-31', '<p>\r\n	&nbsp;</p>\r\n<p>\r\n	<br />\r\n	<div>\r\n		<a count=\"14\" href=\"\" id=\"tag_3\" style=\"margin: 0px; padding: 3px 5px; border: 0px; outline: 0px; vertical-align: baseline; background-color: rgb(218, 245, 250); text-decoration: initial; color: rgb(65, 132, 187); font-family: tahoma, arial, 宋体; line-height: 30px;\" tagid=\"3\">妹子</a><span style=\"color: rgb(51, 51, 51); font-family: tahoma, arial, 宋体; line-height: 30px; background-color: rgb(248, 248, 248);\"> </span><a count=\"9\" href=\"\" id=\"tag_2\" style=\"margin: 0px; padding: 3px 5px; border: 0px; outline: 0px; vertical-align: baseline; background-color: rgb(218, 245, 250); text-decoration: initial; color: rgb(65, 132, 187); font-family: tahoma, arial, 宋体; line-height: 30px;\" tagid=\"2\">pp</a><span style=\"color: rgb(51, 51, 51); font-family: tahoma, arial, 宋体; line-height: 30px; background-color: rgb(248, 248, 248);\"> </span><a count=\"7\" href=\"\" id=\"tag_1\" style=\"margin: 0px; padding: 3px 5px; border: 0px; outline: 0px; vertical-align: baseline; background-color: rgb(218, 245, 250); text-decoration: initial; color: rgb(65, 132, 187); font-family: tahoma, arial, 宋体; line-height: 30px;\" tagid=\"1\">西安</a><span style=\"color: rgb(51, 51, 51); font-family: tahoma, arial, 宋体; line-height: 30px; background-color: rgb(248, 248, 248);\"> </span><a count=\"6\" href=\"\" id=\"tag_6\" style=\"margin: 0px; padding: 3px 5px; border: 0px; outline: 0px; vertical-align: baseline; background-color: rgb(218, 245, 250); text-decoration: initial; color: rgb(65, 132, 187); font-family: tahoma, arial, 宋体; line-height: 30px;\" tagid=\"6\">飞机</a><span style=\"color: rgb(51, 51, 51); font-family: tahoma, arial, 宋体; line-height: 30px; background-color: rgb(248, 248, 248);\"> </span><a count=\"4\" href=\"\" id=\"tag_12\" style=\"margin: 0px; padding: 3px 5px; border: 0px; outline: 0px; vertical-align: baseline; background-color: rgb(218, 245, 250); text-decoration: initial; color: rgb(65, 132, 187); font-family: tahoma, arial, 宋体; line-height: 30px;\" tagid=\"12\">工业</a></div>\r\n</p>\r\n', '1', '2', '3', '4', '5', '6', null, null, '0', '0', '2012-12-11 10:35:48', '2012-12-11 10:35:48');

-- ----------------------------
-- Table structure for `idea_items`
-- ----------------------------
DROP TABLE IF EXISTS `idea_items`;
CREATE TABLE `idea_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idea` int(11) DEFAULT NULL,
  `pname` varchar(255) DEFAULT NULL,
  `expert` int(11) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `author` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `content` text,
  `status` tinyint(4) DEFAULT NULL,
  `c_score` tinyint(4) DEFAULT NULL,
  `c_comment` varchar(255) DEFAULT NULL,
  `e_score` tinyint(4) DEFAULT NULL,
  `e_comment` varchar(255) DEFAULT NULL,
  `file` varchar(255) DEFAULT NULL,
  `time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of idea_items
-- ----------------------------
INSERT INTO `idea_items` VALUES ('1', '2', '第二个创意悬赏', '1', 'hpp', '韩盼盼', '我的创意', '<p>\r\n	罚恶个股</p>\r\n', '1', null, null, null, null, '2012/10/1351132661608.jpg', '2012-10-25 10:37:41');
INSERT INTO `idea_items` VALUES ('2', '2', '第二个创意悬赏', '2', 'zll', '周琳琳', '非法', '<p>\r\n	分隔</p>\r\n', '0', null, null, null, null, null, '2012-10-25 10:47:23');
INSERT INTO `idea_items` VALUES ('4', '6', '悬赏悬赏悬赏悬赏', '1', 'hpp', '韩盼盼', '方案方案方案方案方案', '<p>\r\n	<label for=\"\" style=\"display: block; float: left; width: 90px; font-weight: bold; text-align: right; padding-right: 10px; color: rgb(51, 51, 51); font-family: tahoma, arial, 宋体; line-height: 30px; background-color: rgb(248, 248, 248);\">详细描述</label></p>\r\n<div>\r\n	<label for=\"\" style=\"display: block; float: left; width: 90px; font-weight: bold; text-align: right; padding-right: 10px; color: rgb(51, 51, 51); font-family: tahoma, arial, 宋体; line-height: 30px; background-color: rgb(248, 248, 248);\">详细描述</label>\r\n	<div>\r\n		<label for=\"\" style=\"display: block; float: left; width: 90px; font-weight: bold; text-align: right; padding-right: 10px; color: rgb(51, 51, 51); font-family: tahoma, arial, 宋体; line-height: 30px; background-color: rgb(248, 248, 248);\">详细描述</label>\r\n		<div>\r\n			&nbsp;</div>\r\n	</div>\r\n</div>\r\n<p>\r\n	&nbsp;</p>\r\n', '0', null, null, null, null, null, '2012-12-11 09:36:09');

-- ----------------------------
-- Table structure for `links`
-- ----------------------------
DROP TABLE IF EXISTS `links`;
CREATE TABLE `links` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `img` varchar(255) DEFAULT NULL,
  `order` tinyint(4) DEFAULT NULL,
  `time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of links
-- ----------------------------

-- ----------------------------
-- Table structure for `logs`
-- ----------------------------
DROP TABLE IF EXISTS `logs`;
CREATE TABLE `logs` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `admin` int(11) DEFAULT NULL,
  `action` varchar(255) DEFAULT NULL,
  `type` tinyint(4) DEFAULT NULL,
  `ip` varchar(100) DEFAULT NULL,
  `time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=53 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of logs
-- ----------------------------
INSERT INTO `logs` VALUES ('1', '11', '管理员 admin 登陆', '1', '::1', '2012-09-24 11:21:00');
INSERT INTO `logs` VALUES ('2', '1', '管理员 root 登陆', '1', '::1', '2012-09-25 09:17:50');
INSERT INTO `logs` VALUES ('3', '1', '管理员 root 添加文章 发一篇文章', '1', '::1', '2012-09-25 09:19:40');
INSERT INTO `logs` VALUES ('4', '11', '管理员 admin 登陆', '1', '::1', '2012-09-26 09:05:51');
INSERT INTO `logs` VALUES ('5', '11', '管理员 admin 添加行业 ', '1', '::1', '2012-09-26 09:15:16');
INSERT INTO `logs` VALUES ('6', '11', '管理员 admin 添加行业 汽车,航空,五金,采矿', '1', '::1', '2012-09-26 09:19:31');
INSERT INTO `logs` VALUES ('7', '0', '管理员  向未知用户  发送站内信 标题：1324', '2', '::1', '2012-09-26 09:55:00');
INSERT INTO `logs` VALUES ('8', '0', '管理员  删除行业 ', '2', '::1', '2012-09-26 10:06:57');
INSERT INTO `logs` VALUES ('9', '0', '管理员  删除行业 ', '2', '::1', '2012-09-26 10:08:14');
INSERT INTO `logs` VALUES ('10', '0', '管理员  删除行业 ', '2', '::1', '2012-09-26 10:08:48');
INSERT INTO `logs` VALUES ('11', '0', '管理员  删除行业 ', '2', '::1', '2012-09-26 10:10:12');
INSERT INTO `logs` VALUES ('12', '11', '管理员 admin 登陆', '1', '::1', '2012-09-27 09:30:51');
INSERT INTO `logs` VALUES ('13', '11', '管理员 admin 登陆', '1', '::1', '2012-10-16 19:31:13');
INSERT INTO `logs` VALUES ('14', '11', '管理员 admin 登陆', '1', '::1', '2012-10-17 15:10:34');
INSERT INTO `logs` VALUES ('15', '11', '管理员 admin 登陆', '1', '::1', '2012-10-17 16:31:16');
INSERT INTO `logs` VALUES ('16', '11', '管理员 admin 登陆', '1', '::1', '2012-10-17 21:12:11');
INSERT INTO `logs` VALUES ('17', '11', '管理员 admin 添加视频 被爱', '1', '::1', '2012-10-17 21:17:48');
INSERT INTO `logs` VALUES ('18', '0', '管理员  删除视频 被爱', '2', '::1', '2012-10-17 21:17:56');
INSERT INTO `logs` VALUES ('19', '11', '管理员 admin 添加视频 北爱', '1', '::1', '2012-10-17 22:06:26');
INSERT INTO `logs` VALUES ('20', '11', '管理员 admin 添加视频 爱爱', '1', '::1', '2012-10-17 22:07:27');
INSERT INTO `logs` VALUES ('21', '11', '管理员 admin 登陆', '1', '::1', '2012-10-18 19:05:09');
INSERT INTO `logs` VALUES ('22', '11', '管理员 admin 登陆', '1', '::1', '2012-10-23 18:02:00');
INSERT INTO `logs` VALUES ('23', '1', '管理员 root 登陆', '1', '::1', '2012-10-25 12:38:08');
INSERT INTO `logs` VALUES ('24', '1', '管理员 root 登陆', '1', '::1', '2012-10-29 10:48:12');
INSERT INTO `logs` VALUES ('25', '1', '管理员 root 修改难题 发布技术难题', '1', '::1', '2012-10-29 10:58:30');
INSERT INTO `logs` VALUES ('26', '1', '管理员 root 修改专利 专利名称专利名称', '2', '::1', '2012-10-29 11:21:12');
INSERT INTO `logs` VALUES ('27', '1', '管理员 root 修改专利 专利名称专利名称', '2', '::1', '2012-10-29 11:21:23');
INSERT INTO `logs` VALUES ('28', '1', '管理员 root 修改专利 专利名称专利名称', '2', '::1', '2012-10-29 11:23:47');
INSERT INTO `logs` VALUES ('29', '1', '管理员 root 修改专利 专利名称专利名称', '2', '::1', '2012-10-29 11:23:54');
INSERT INTO `logs` VALUES ('30', '1', '管理员 root 修改专利 专利名称专利名称', '2', '::1', '2012-10-29 11:23:58');
INSERT INTO `logs` VALUES ('31', '1', '管理员 root 修改专利 专利名称专利名称', '2', '::1', '2012-10-29 11:24:02');
INSERT INTO `logs` VALUES ('32', '1', '管理员 root 登陆', '1', '::1', '2012-10-31 21:13:19');
INSERT INTO `logs` VALUES ('33', '1', '管理员 root 登陆', '1', '::1', '2012-11-01 08:57:57');
INSERT INTO `logs` VALUES ('34', '1', '管理员 root 登陆', '1', '::1', '2012-11-06 10:19:20');
INSERT INTO `logs` VALUES ('35', '1', '管理员 root 登陆', '1', '::1', '2012-11-09 14:43:48');
INSERT INTO `logs` VALUES ('36', '1', '管理员 root 修改专家 韩盼盼', '2', '::1', '2012-11-09 14:51:26');
INSERT INTO `logs` VALUES ('37', '1', '管理员 root 修改专家 韩盼盼', '2', '::1', '2012-11-09 14:51:41');
INSERT INTO `logs` VALUES ('38', '1', '管理员 root 修改专家 韩盼盼', '2', '::1', '2012-11-09 14:52:29');
INSERT INTO `logs` VALUES ('39', '1', '管理员 root 修改企业 我市企业', '2', '::1', '2012-11-09 14:56:56');
INSERT INTO `logs` VALUES ('40', '1', '管理员 root 修改企业 我市企业', '2', '::1', '2012-11-09 14:57:00');
INSERT INTO `logs` VALUES ('41', '1', '管理员 root 修改企业 我市企业', '2', '::1', '2012-11-09 14:57:05');
INSERT INTO `logs` VALUES ('42', '1', '管理员 root 审核通过企业 我市企业', '2', '::1', '2012-11-09 14:57:11');
INSERT INTO `logs` VALUES ('43', '1', '管理员 root 修改企业 我市企业', '2', '::1', '2012-11-09 15:04:04');
INSERT INTO `logs` VALUES ('44', '1', '管理员 root 修改企业 我市企业', '2', '::1', '2012-11-09 15:05:08');
INSERT INTO `logs` VALUES ('45', '1', '管理员 root 修改企业 我市企业', '2', '::1', '2012-11-09 15:05:21');
INSERT INTO `logs` VALUES ('46', '1', '管理员 root 修改企业 我市企业', '2', '::1', '2012-11-09 15:06:21');
INSERT INTO `logs` VALUES ('47', '1', '管理员 root 添加视频 121313', '1', '::1', '2012-11-09 15:15:01');
INSERT INTO `logs` VALUES ('48', '1', '管理员 root 登陆', '1', '::1', '2012-12-05 20:55:56');
INSERT INTO `logs` VALUES ('49', '1', '管理员 root 添加文章 标题标题标题标题标题标题标题标题', '1', '::1', '2012-12-05 21:05:42');
INSERT INTO `logs` VALUES ('50', '1', '管理员 root 登陆', '1', '::1', '2012-12-11 09:42:03');
INSERT INTO `logs` VALUES ('51', '1', '管理员 root 审核通过专家 韩盼盼', '2', '::1', '2012-12-11 09:46:45');
INSERT INTO `logs` VALUES ('52', '1', '管理员 root 登陆', '1', '::1', '2012-12-11 10:36:27');

-- ----------------------------
-- Table structure for `messages`
-- ----------------------------
DROP TABLE IF EXISTS `messages`;
CREATE TABLE `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `content` text,
  `read` tinyint(4) DEFAULT NULL,
  `from` int(11) DEFAULT NULL,
  `from_type` varchar(20) DEFAULT NULL,
  `from_name` varchar(255) DEFAULT NULL,
  `from_author` varchar(255) DEFAULT NULL,
  `to` int(11) DEFAULT NULL,
  `to_type` varchar(20) DEFAULT NULL,
  `to_name` varchar(255) DEFAULT NULL,
  `to_author` varchar(255) DEFAULT NULL,
  `time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of messages
-- ----------------------------
INSERT INTO `messages` VALUES ('1', '1324', '发俄方发俄方发俄方发俄方发俄方发俄方发俄方发俄方发俄方发俄方发俄方发俄方发俄方发俄方发俄方发俄方发俄方发俄方发俄方发俄方发俄方发俄方发俄方发俄方发俄方发俄方发俄方发俄方发俄方发俄方发俄方发俄方发俄方发俄方发俄方v', '1', '11', 'Admin', 'admin', '管理员', '1', 'Company', 'lyc', '浙江大学', '2012-09-26 09:55:00');
INSERT INTO `messages` VALUES ('2', '123', '41414', '1', '1', 'Company', 'lyc', '浙江大学', '1', 'Expert', 'hpp', '韩盼盼', '2012-09-26 09:58:13');
INSERT INTO `messages` VALUES ('3', '有创意需要发放奖金', 'http://localhost/a/idea/detail?id=2', '0', '1', 'Company', 'lyc', '我市企业', '1', 'Admin', null, null, '2012-10-25 10:58:42');
INSERT INTO `messages` VALUES ('4', '有创意需要发放奖金', 'http://localhost/a/idea/detail?id=2', '0', '1', 'Company', 'lyc', '我市企业', '1', 'Admin', null, null, '2012-11-06 09:44:21');
INSERT INTO `messages` VALUES ('5', '有创意需要发放奖金', 'http://localhost/a/idea/detail?id=5', '0', '1', 'Company', 'lyc', '我市企业', '1', 'Admin', null, null, '2012-11-09 15:25:53');

-- ----------------------------
-- Table structure for `options`
-- ----------------------------
DROP TABLE IF EXISTS `options`;
CREATE TABLE `options` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `key` varchar(255) NOT NULL,
  `value` varchar(1000) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of options
-- ----------------------------
INSERT INTO `options` VALUES ('1', 'MOST_COMMON_TAGS', 'a:5:{i:0;a:3:{s:2:\"id\";s:1:\"3\";s:4:\"name\";s:6:\"妹子\";s:5:\"count\";s:2:\"14\";}i:1;a:3:{s:2:\"id\";s:1:\"2\";s:4:\"name\";s:2:\"pp\";s:5:\"count\";s:1:\"9\";}i:2;a:3:{s:2:\"id\";s:1:\"1\";s:4:\"name\";s:6:\"西安\";s:5:\"count\";s:1:\"7\";}i:3;a:3:{s:2:\"id\";s:1:\"6\";s:4:\"name\";s:6:\"飞机\";s:5:\"count\";s:1:\"6\";}i:4;a:3:{s:2:\"id\";s:2:\"12\";s:4:\"name\";s:6:\"工业\";s:5:\"count\";s:1:\"4\";}}');
INSERT INTO `options` VALUES ('2', 'ADMIN_MANAGE_BASE', 'a:2:{s:5:\"title\";s:9:\"知富网\";s:6:\"slogan\";s:3:\"123\";}');
INSERT INTO `options` VALUES ('9', 'SENSITIVE_TRIE_TREE', 'a:4:{s:3:\"胡\";a:1:{s:3:\"锦\";a:1:{s:3:\"涛\";a:1:{s:0:\"\";a:0:{}}}}s:3:\"温\";a:1:{s:3:\"家\";a:1:{s:3:\"宝\";a:1:{s:0:\"\";a:0:{}}}}s:3:\"江\";a:1:{s:3:\"泽\";a:1:{s:3:\"民\";a:1:{s:0:\"\";a:0:{}}}}s:3:\"毛\";a:1:{s:3:\"泽\";a:1:{s:3:\"东\";a:1:{s:0:\"\";a:0:{}}}}}');
INSERT INTO `options` VALUES ('4', 'CRON', 'a:1:{i:1355251941;a:1:{s:6:\"action\";s:16:\"build_common_tag\";}}');

-- ----------------------------
-- Table structure for `patents`
-- ----------------------------
DROP TABLE IF EXISTS `patents`;
CREATE TABLE `patents` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cat` smallint(6) DEFAULT NULL,
  `subcat` smallint(6) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `pid` varchar(255) DEFAULT NULL,
  `budget` double DEFAULT NULL,
  `description` text,
  `phone` varchar(20) DEFAULT NULL,
  `mobile` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `app` tinyint(4) DEFAULT NULL,
  `skill` tinyint(4) DEFAULT NULL,
  `example` tinyint(4) DEFAULT NULL,
  `kind` tinyint(4) DEFAULT NULL,
  `transfer` tinyint(4) DEFAULT NULL,
  `owner` tinyint(4) DEFAULT NULL,
  `expert` int(11) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `author` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `file` varchar(255) DEFAULT NULL,
  `time` datetime DEFAULT NULL,
  `lastmodify` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of patents
-- ----------------------------
INSERT INTO `patents` VALUES ('1', '5', '8', '发paper啦', '12345', '11', '<p>\r\n	法额饿个</p>\r\n', '214124', '4214214', '2424@qq.co', 'http://abc.com', '1', '5', '2', '1', '1', '1', '1', 'hpp', '韩盼盼', null, null, '2012-09-24 11:46:44', null);
INSERT INTO `patents` VALUES ('2', '1', '3', '专利名称专利名称', '124123', '24', '<p>\r\n	gew各个额哥恶化</p>\r\n', '23214', null, null, '', '0', '0', null, '0', '30', null, '1', 'hpp', '韩盼盼', '2012/10/1351135167669.jpg', '2012/10/1351481042501.jpg', '2012-10-25 11:19:27', '2012-10-29 11:24:02');
INSERT INTO `patents` VALUES ('3', '2', '4', '专利专利专利专利专利', '232424', '22', '<p>\r\n	阿发额哥阿嘎恶法非法</p>\r\n', '21312324', null, null, '', '2', '2', '3', '3', '4', '3', '1', 'hpp', '韩盼盼', '2012/12/1355189839983.jpg', null, '2012-12-11 09:37:19', '2012-12-11 09:37:19');

-- ----------------------------
-- Table structure for `pay`
-- ----------------------------
DROP TABLE IF EXISTS `pay`;
CREATE TABLE `pay` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `belong` int(11) DEFAULT NULL,
  `type` varchar(20) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `author` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `kind` varchar(20) DEFAULT NULL,
  `method` varchar(20) DEFAULT NULL,
  `paid` double DEFAULT NULL,
  `time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pay
-- ----------------------------

-- ----------------------------
-- Table structure for `problems`
-- ----------------------------
DROP TABLE IF EXISTS `problems`;
CREATE TABLE `problems` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `contact` varchar(255) DEFAULT NULL,
  `cat` smallint(6) DEFAULT NULL,
  `subcat` smallint(6) DEFAULT NULL,
  `province` varchar(50) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `district` varchar(50) DEFAULT NULL,
  `province2` varchar(50) DEFAULT NULL,
  `city2` varchar(50) DEFAULT NULL,
  `district2` varchar(50) DEFAULT NULL,
  `budget` double DEFAULT NULL,
  `deadline` date DEFAULT NULL,
  `company` int(11) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `author` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `mobile` varchar(20) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `description` text,
  `status` tinyint(4) DEFAULT NULL,
  `closed` tinyint(4) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `file` varchar(255) DEFAULT NULL,
  `verify` tinyint(4) DEFAULT NULL,
  `time` datetime DEFAULT NULL,
  `lastmodify` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of problems
-- ----------------------------
INSERT INTO `problems` VALUES ('1', '公司公司', '姓名姓名', '1', '3', '安徽省', '合肥市', '包河区', null, null, null, '22', '2012-12-01', '1', 'lyc', '', '第一个难题', '12345', '54321', 'fafwa@qq.com', '<p>\r\n	afsaf</p>\r\n', '3', '0', null, null, '1', '2012-09-24 11:26:02', '2012-09-24 11:26:02');
INSERT INTO `problems` VALUES ('2', '公司公司', '姓名姓名', '1', '3', '湖北省', '武汉市', '江汉区', null, null, null, '33', '2012-12-07', '1', 'lyc', '浙江大学', '第二个难题', '12345', '13212', '24@qq.com', '<p>\r\n	wa发达反外挂</p>\r\n', '3', '0', null, null, '1', '2012-09-24 12:24:41', '2012-09-24 12:24:41');
INSERT INTO `problems` VALUES ('3', '公司公司', '打劫个', '1', '3', '', '', '', '', '', '', '23', null, '1', 'lyc', '我市企业', '布技术难题布技术难题', '23', null, null, '歌舞和维护', '1', '0', null, null, '1', '2012-10-25 11:13:33', '2012-10-25 11:13:33');
INSERT INTO `problems` VALUES ('4', '好公司哦', '发布技术难题', '1', '3', '安徽省', '合肥市', '包河区', '', '', '', '22', '2012-11-23', '1', 'lyc', '我市企业', '发布技术难题', '234235', null, null, '<p>\r\n	&nbsp;</p>\r\n<h2 style=\"margin: 5px 0px 15px; padding: 0px; border: 0px; outline: 0px; font-size: 20px; vertical-align: baseline; color: rgb(51, 51, 51); font-family: tahoma, arial, 宋体; \">\r\n	发布技术难题</h2>\r\n', '1', '1', '2012/10/1351479510327.jpg', null, '1', '2012-10-29 10:41:56', '2012-12-11 10:59:23');
INSERT INTO `problems` VALUES ('5', '公司公司', '姓名姓名', '1', '10', '', '', '', '', '', '', '0', null, '1', 'lyc', '我市企业', '名称名称', '323251', null, null, '<p>\r\n	fafag<span style=\"color: rgb(51, 51, 51); font-family: tahoma, arial, 宋体; font-weight: bold; line-height: 18px; text-align: right; \">详细描</span><span style=\"color: rgb(51, 51, 51); font-family: tahoma, arial, 宋体; font-weight: bold; line-height: 18px; text-align: right; \">详细描</span></p>\r\n', '1', '0', null, null, '1', '2012-11-06 10:15:55', '2012-11-06 10:15:55');
INSERT INTO `problems` VALUES ('6', '首页难题', '首页难题', '-1', '-1', null, null, null, null, null, null, null, null, '1', 'lyc', '我市企业', '首页难题', '444242432', null, null, ' 首页难题首页难题', '0', '0', null, null, '0', '2012-11-06 16:48:13', '2012-11-06 16:48:13');
INSERT INTO `problems` VALUES ('7', '首页难题', '首页难题', '-1', '-1', null, null, null, null, null, null, null, null, '1', 'lyc', '我市企业', '首页难题', '444242432', null, null, ' 首页难题首页难题', '0', '0', null, null, '0', '2012-11-06 16:48:14', '2012-11-06 16:48:14');
INSERT INTO `problems` VALUES ('8', '非阿哥阿哥', '任务任务', '1', '3', null, null, null, null, null, null, null, null, '1', 'lyc', '我市企业', '发放瓦哇嘎', '131142442', null, null, ' 23131', '0', '0', null, null, '0', '2012-11-12 09:52:24', '2012-11-12 09:52:24');
INSERT INTO `problems` VALUES ('9', '我市企业', '广东人', '1', '3', '', '', '', '', '', '', '11', '2012-12-29', '1', 'lyc', '我市企业', '发哥哥噶飞啊', '13444515', null, null, '<p>\r\n	发给非阿哥阿哥阿哥</p>\r\n', '1', '0', '2012/12/1355189661511.jpg', null, '1', '2012-12-11 09:34:21', '2012-12-11 09:34:21');

-- ----------------------------
-- Table structure for `recruits`
-- ----------------------------
DROP TABLE IF EXISTS `recruits`;
CREATE TABLE `recruits` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `company` varchar(255) DEFAULT NULL,
  `companydesc` varchar(500) DEFAULT NULL,
  `num` int(4) DEFAULT NULL,
  `identity` tinyint(4) DEFAULT NULL,
  `specialty` varchar(255) DEFAULT NULL,
  `area` varchar(255) DEFAULT NULL,
  `degree` tinyint(4) DEFAULT NULL,
  `pay` varchar(255) DEFAULT NULL,
  `age` varchar(255) DEFAULT NULL,
  `eatroom` tinyint(4) DEFAULT NULL,
  `description` text,
  `belong` int(11) DEFAULT NULL,
  `type` varchar(20) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `author` varchar(255) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of recruits
-- ----------------------------
INSERT INTO `recruits` VALUES ('1', '找洗碗工啦', '公司A', null, '12', '3', '计算机', '玉泉校区', '3', '', '12', '2', '1313131', '1', 'Company', 'lyc', '', '1', '2012-09-24 11:27:18');
INSERT INTO `recruits` VALUES ('2', '找码农1', '公司A', null, '22', '2', '计算机', '西湖科技园', '3', '', '22', '1', '1231', '1', 'Expert', 'hpp', '韩盼盼', '1', '2012-09-24 11:48:06');
INSERT INTO `recruits` VALUES ('3', '1212', '公司A', null, '1212', '1', '121', '212', '0', '', '', null, '', '1', 'Company', 'lyc', '我市企业', '1', '2012-10-16 19:19:12');
INSERT INTO `recruits` VALUES ('4', 'vege', '公司A', null, '2', null, '', '', '0', '1万', '45岁到60岁', null, '', '1', 'Company', 'lyc', '我市企业', '1', '2012-10-17 15:02:30');

-- ----------------------------
-- Table structure for `recruit_items`
-- ----------------------------
DROP TABLE IF EXISTS `recruit_items`;
CREATE TABLE `recruit_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `recruit` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `sex` tinyint(4) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `mobile` varchar(20) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `belong` int(11) DEFAULT NULL,
  `type` varchar(20) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `author` varchar(255) DEFAULT NULL,
  `resume` varchar(255) DEFAULT NULL,
  `time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of recruit_items
-- ----------------------------
INSERT INTO `recruit_items` VALUES ('1', '1', '风格更', '2', '2424', '43535', 'ffawf@fwf.cm', null, null, null, null, '2012/10/1350463271729.jpg', '2012-10-17 16:41:11');
INSERT INTO `recruit_items` VALUES ('2', '1', '分隔11', '1', '32431', '435251', 'daf@qf.cpma', '2', 'Expert', 'zll', '周琳琳', '2012/10/1350466518482.doc', '2012-10-17 17:18:15');
INSERT INTO `recruit_items` VALUES ('6', '1', '韩盼盼', '2', '12345', '654321', 'hanpanpan@zju.edu.cn', '1', 'Expert', 'hpp', '韩盼盼', '2012/11/1351733170383.jpg', '2012-11-01 09:26:10');

-- ----------------------------
-- Table structure for `reset_code`
-- ----------------------------
DROP TABLE IF EXISTS `reset_code`;
CREATE TABLE `reset_code` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` int(11) DEFAULT NULL,
  `type` varchar(10) DEFAULT NULL,
  `code` varchar(32) DEFAULT NULL,
  `time` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of reset_code
-- ----------------------------

-- ----------------------------
-- Table structure for `solutions`
-- ----------------------------
DROP TABLE IF EXISTS `solutions`;
CREATE TABLE `solutions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `problem` int(11) DEFAULT NULL,
  `pname` varchar(255) DEFAULT NULL,
  `expert` int(11) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `author` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text,
  `c_score` tinyint(4) DEFAULT NULL,
  `c_comment` varchar(255) DEFAULT NULL,
  `e_score` tinyint(4) DEFAULT NULL,
  `e_comment` varchar(255) DEFAULT NULL,
  `file` varchar(255) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of solutions
-- ----------------------------
INSERT INTO `solutions` VALUES ('1', '1', '第一个难题', '1', 'hpp', '韩盼盼', '我的竞标方案1', '<p>\r\n	我的竞标方案我的竞标方案我的竞标方案1</p>\r\n', null, null, null, null, null, '0', '2012-09-24 12:22:11');
INSERT INTO `solutions` VALUES ('2', '1', '第一个难题', '1', 'hpp', '韩盼盼', '竞标方案2', '<p>\r\n	竞标方案2竞标方案2</p>\r\n', '5', '不错不错', '5', '不错不错', null, '1', '2012-09-24 12:22:55');
INSERT INTO `solutions` VALUES ('3', '2', '第二个难题', '1', 'hpp', '韩盼盼', '发风光', '<p>\r\n	个峰</p>\r\n', '3', '234', null, null, null, '1', '2012-09-24 15:46:52');
INSERT INTO `solutions` VALUES ('4', '4', '发布技术难题', '1', 'hpp', '韩盼盼', '提交竞标方案1', '<p>\r\n	案1</p>\r\n', null, null, null, null, null, '0', '2012-11-01 09:58:11');
INSERT INTO `solutions` VALUES ('5', '9', '发哥哥噶飞啊', '1', 'hpp', '韩盼盼', '竞标方案竞标方案竞标方案竞标方案', '<p>\r\n	&nbsp;</p>\r\n<h3 style=\"margin: 0px; padding: 5px; border: 0px; outline: 0px; font-size: 16px; vertical-align: baseline; background-color: rgb(240, 245, 248); color: rgb(51, 51, 51); font-family: tahoma, arial, 宋体;\">\r\n	竞标方案竞标方案竞标方案</h3>\r\n', null, null, null, null, null, '0', '2012-12-11 09:37:39');

-- ----------------------------
-- Table structure for `solution_items`
-- ----------------------------
DROP TABLE IF EXISTS `solution_items`;
CREATE TABLE `solution_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company` int(11) DEFAULT NULL,
  `solution` int(11) DEFAULT NULL,
  `time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of solution_items
-- ----------------------------
INSERT INTO `solution_items` VALUES ('1', '1', '4', null);
INSERT INTO `solution_items` VALUES ('2', '1', '3', '2012-11-23 12:30:04');

-- ----------------------------
-- Table structure for `tags`
-- ----------------------------
DROP TABLE IF EXISTS `tags`;
CREATE TABLE `tags` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `count` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tags
-- ----------------------------
INSERT INTO `tags` VALUES ('1', '西安', '12');
INSERT INTO `tags` VALUES ('2', 'pp', '16');
INSERT INTO `tags` VALUES ('3', '妹子', '20');
INSERT INTO `tags` VALUES ('4', '旅游', '2');
INSERT INTO `tags` VALUES ('5', '青岛', '1');
INSERT INTO `tags` VALUES ('6', '飞机', '8');
INSERT INTO `tags` VALUES ('7', '高铁', '1');
INSERT INTO `tags` VALUES ('8', '北京', '0');
INSERT INTO `tags` VALUES ('9', '动车', '1');
INSERT INTO `tags` VALUES ('10', '撒旦', '0');
INSERT INTO `tags` VALUES ('11', '美女', '2');
INSERT INTO `tags` VALUES ('12', '工业', '6');
INSERT INTO `tags` VALUES ('13', '农业', '2');
INSERT INTO `tags` VALUES ('14', '机械', '1');
INSERT INTO `tags` VALUES ('15', '杭州', '1');
INSERT INTO `tags` VALUES ('16', '科研', '1');
INSERT INTO `tags` VALUES ('17', '爱情', '2');
INSERT INTO `tags` VALUES ('18', '友情', '2');

-- ----------------------------
-- Table structure for `tag_items`
-- ----------------------------
DROP TABLE IF EXISTS `tag_items`;
CREATE TABLE `tag_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tag` bigint(20) DEFAULT NULL,
  `belong` int(11) DEFAULT NULL,
  `type` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=36 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tag_items
-- ----------------------------
INSERT INTO `tag_items` VALUES ('1', '6', '1', 'Problem');
INSERT INTO `tag_items` VALUES ('2', '12', '1', 'Problem');
INSERT INTO `tag_items` VALUES ('3', '14', '1', 'Problem');
INSERT INTO `tag_items` VALUES ('4', '2', '1', 'Idea');
INSERT INTO `tag_items` VALUES ('5', '3', '1', 'Idea');
INSERT INTO `tag_items` VALUES ('6', '15', '1', 'Company');
INSERT INTO `tag_items` VALUES ('7', '3', '1', 'Expert');
INSERT INTO `tag_items` VALUES ('8', '2', '1', 'Expert');
INSERT INTO `tag_items` VALUES ('9', '16', '1', 'Patent');
INSERT INTO `tag_items` VALUES ('10', '1', '4', 'Video');
INSERT INTO `tag_items` VALUES ('11', '2', '4', 'Video');
INSERT INTO `tag_items` VALUES ('12', '3', '4', 'Video');
INSERT INTO `tag_items` VALUES ('14', '17', '10', 'Video');
INSERT INTO `tag_items` VALUES ('15', '18', '10', 'Video');
INSERT INTO `tag_items` VALUES ('16', '17', '11', 'Video');
INSERT INTO `tag_items` VALUES ('17', '18', '12', 'Video');
INSERT INTO `tag_items` VALUES ('18', '1', '2', 'Idea');
INSERT INTO `tag_items` VALUES ('25', '3', '4', 'Problem');
INSERT INTO `tag_items` VALUES ('24', '2', '2', 'Patent');
INSERT INTO `tag_items` VALUES ('26', '2', '4', 'Problem');
INSERT INTO `tag_items` VALUES ('27', '6', '4', 'Idea');
INSERT INTO `tag_items` VALUES ('28', '12', '4', 'Idea');
INSERT INTO `tag_items` VALUES ('29', '2', '14', 'Video');
INSERT INTO `tag_items` VALUES ('30', '3', '14', 'Video');
INSERT INTO `tag_items` VALUES ('31', '1', '6', 'Idea');
INSERT INTO `tag_items` VALUES ('32', '3', '7', 'Idea');
INSERT INTO `tag_items` VALUES ('33', '2', '7', 'Idea');
INSERT INTO `tag_items` VALUES ('34', '1', '7', 'Idea');
INSERT INTO `tag_items` VALUES ('35', '1', '14', 'Video');

-- ----------------------------
-- Table structure for `topics`
-- ----------------------------
DROP TABLE IF EXISTS `topics`;
CREATE TABLE `topics` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `content` text,
  `parent` int(11) DEFAULT NULL,
  `comments` int(11) DEFAULT NULL,
  `belong` int(11) DEFAULT NULL,
  `type` varchar(20) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `author` varchar(255) DEFAULT NULL,
  `time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of topics
-- ----------------------------
INSERT INTO `topics` VALUES ('1', 'CC98是个好地方', '<p>\r\n	rt</p>\r\n', '0', '2', '1', 'Company', 'lyc', '浙江大学', '2012-09-24 11:30:48');
INSERT INTO `topics` VALUES ('9', '', 'fesf', '1', '0', '1', 'Company', 'lyc', '浙江大学', '2012-09-26 10:29:34');
INSERT INTO `topics` VALUES ('8', '', 'fasfe', '1', '0', '1', 'Company', 'lyc', '浙江大学', '2012-09-26 10:28:55');

-- ----------------------------
-- Table structure for `videos`
-- ----------------------------
DROP TABLE IF EXISTS `videos`;
CREATE TABLE `videos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `desc` varchar(511) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `click` int(11) DEFAULT NULL,
  `belong` int(11) DEFAULT NULL,
  `type` varchar(20) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `author` varchar(255) DEFAULT NULL,
  `time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of videos
-- ----------------------------
INSERT INTO `videos` VALUES ('1', '海军', '打三分', 'http://player.youku.com/player.php/sid/XNDU0MDQwNTQ0/v.swf', null, '8', '1', 'Company', 'lyc', '浙江大学', '2012-09-24 18:25:42');
INSERT INTO `videos` VALUES ('4', '博客', '博客', 'http://blog.stariy.org/', null, '20', '1', 'Company', 'lyc', '浙江大学', '2012-09-26 09:31:15');
INSERT INTO `videos` VALUES ('7', '江南style婚礼版', '江南style婚礼版', 'http://www.tudou.com/l/xdJrUGGpC1g/&#038;resourceId=0_04_05_99&#038;iid=154729419/v.swf', '', '1', '1', 'Company', 'lyc', '我市企业', '2012-10-17 21:09:19');
INSERT INTO `videos` VALUES ('8', '江南style婚礼版', '', 'http://www.tudou.com/l/xdJrUGGpC1g/&#038;resourceId=0_04_05_99&#038;iid=154729419/v.swf', 'http://www.baidu.com/img/baidu_sylogo1.gif', '0', '1', 'Company', 'lyc', '我市企业', '2012-10-17 21:10:10');
INSERT INTO `videos` VALUES ('6', '实拍南京枪击案 奥迪逆行连撞多车逃逸', '实拍南京枪击案 奥迪逆行连撞多车逃逸', 'http://player.youku.com/player.php/sid/XNDYzMTQwNDQ0/v.swf', '2012/10/1350479067518', '1', '1', 'Company', 'lyc', '我市企业', '2012-10-17 21:04:27');
INSERT INTO `videos` VALUES ('11', '北爱', '撒旦的飒飒', 'http://player.youku.com/player.php/sid/XMzQxNzQzNDg0/v.swf', '2012/10/1350482786133', '2', '11', 'Admin', 'admin', '管理员', '2012-10-17 22:06:26');
INSERT INTO `videos` VALUES ('10', '被爱', 'e', 'http://player.youku.com/player.php/sid/XMzQxNzQzNDg0/v.swf', '2012/10/1350479868717', '7', '11', 'Admin', 'admin', '管理员', '2012-10-17 21:17:48');
INSERT INTO `videos` VALUES ('12', '爱爱', '', 'http://player.youku.com/player.php/sid/XMzQxNzQzNDg0/v.swf', '2012/11/1352445260665.jpg', '18', '11', 'Admin', 'admin', '管理员', '2012-10-17 22:07:27');
INSERT INTO `videos` VALUES ('13', '121313', '131313', 'http://player.youku.com/player.php/sid/XMzQxNzQzNDg0/v.swf', '2012/11/1352445301414.jpg', '0', '1', 'Admin', 'admin', '管理员', '2012-11-09 15:15:01');
INSERT INTO `videos` VALUES ('14', '42424111111111111111111', '234234111111111111111111', 'http://player.youku.com/player.php/sid/XMzQxNzQzNDg0/v.swf', '2012/11/1352445465233.jpg', '10', '1', 'Company', 'lyc', '我市企业', '2012-11-09 15:17:45');

-- ----------------------------
-- Table structure for `words`
-- ----------------------------
DROP TABLE IF EXISTS `words`;
CREATE TABLE `words` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of words
-- ----------------------------
INSERT INTO `words` VALUES ('2', '胡锦涛');
INSERT INTO `words` VALUES ('3', '温家宝');
INSERT INTO `words` VALUES ('5', '江泽民');
INSERT INTO `words` VALUES ('7', '毛泽东');
