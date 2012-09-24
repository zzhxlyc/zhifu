/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50141
Source Host           : localhost:3306
Source Database       : zhifu

Target Server Type    : MYSQL
Target Server Version : 50141
File Encoding         : 65001

Date: 2012-09-24 12:27:18
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
INSERT INTO `admins` VALUES ('1', '1', 'root', '202cb962ac59075b964b07152d234b70', '0', '2012-08-21 20:59:25', '::1', '2012-06-26 15:16:33');
INSERT INTO `admins` VALUES ('11', '1', 'admin', '202cb962ac59075b964b07152d234b70', '0', '2012-09-24 11:21:00', '::1', '2012-07-26 20:19:31');

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
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of applys
-- ----------------------------
INSERT INTO `applys` VALUES ('1', '我要当洗碗工啦', '3', '孙悟空', '1', '123', null, '54312', 'huhu@qq.com', '水帘洞', '紫金港校区', '2', '11', '133', '2141424', '1-0-0 0-1-0 0-0-1 0-1-0 1-0-0 0-1-0 0-0-1', null, '1', 'Company', 'lyc', '', '1', '2012-09-24 11:28:03');

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
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of articles
-- ----------------------------

-- ----------------------------
-- Table structure for `categorys`
-- ----------------------------
DROP TABLE IF EXISTS `categorys`;
CREATE TABLE `categorys` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `parent` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of categorys
-- ----------------------------
INSERT INTO `categorys` VALUES ('1', '工业', '0');
INSERT INTO `categorys` VALUES ('2', '农业', '0');
INSERT INTO `categorys` VALUES ('3', '机械', '1');
INSERT INTO `categorys` VALUES ('4', '养殖', '2');
INSERT INTO `categorys` VALUES ('7', '冶金', '1');
INSERT INTO `categorys` VALUES ('5', '服务业', '0');
INSERT INTO `categorys` VALUES ('6', 'KTV', '5');
INSERT INTO `categorys` VALUES ('8', 'KFC', '5');

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
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of comments
-- ----------------------------
INSERT INTO `comments` VALUES ('1', '1', 'Problem', '1', null, '浙江大学', 'Company', '撒个股', '2012-09-24 12:24:57');
INSERT INTO `comments` VALUES ('2', '1', 'Problem', '1', null, '韩盼盼', 'Expert', '回复 浙江大学：哥哥', '2012-09-24 12:25:05');

-- ----------------------------
-- Table structure for `companys`
-- ----------------------------
DROP TABLE IF EXISTS `companys`;
CREATE TABLE `companys` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` text,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `budget` double DEFAULT NULL,
  `rate_total` int(11) DEFAULT NULL,
  `rate_num` int(11) DEFAULT NULL,
  `license` varchar(255) DEFAULT NULL,
  `verified` tinyint(4) DEFAULT NULL,
  `time` datetime DEFAULT NULL,
  `lastlogin` datetime DEFAULT NULL,
  `lastip` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of companys
-- ----------------------------
INSERT INTO `companys` VALUES ('1', 'lyc', '202cb962ac59075b964b07152d234b70', '浙江大学', '<p>\r\n	高凤阁然后然后</p>\r\n', 'liuyunchao@zju.edu.cn', '13444515', 'http://blog.stariy.org/', null, '0', '5', '1', null, '0', '2012-09-24 11:20:01', null, null);

-- ----------------------------
-- Table structure for `deals`
-- ----------------------------
DROP TABLE IF EXISTS `deals`;
CREATE TABLE `deals` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `patent` int(11) DEFAULT NULL,
  `pname` varchar(255) DEFAULT NULL,
  `company` int(11) DEFAULT NULL,
  `author` varchar(255) DEFAULT NULL,
  `time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of deals
-- ----------------------------

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
  `phone` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `budget` double DEFAULT NULL,
  `rate_total` int(11) DEFAULT NULL,
  `rate_num` int(11) DEFAULT NULL,
  `verified` tinyint(4) DEFAULT NULL,
  `time` datetime DEFAULT NULL,
  `lastlogin` datetime DEFAULT NULL,
  `lastip` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of experts
-- ----------------------------
INSERT INTO `experts` VALUES ('1', 'hpp', '202cb962ac59075b964b07152d234b70', '韩盼盼', '浙江大学', '学生', 'hanpanpan@zju.edu.cn', '12345', 'http://zjuhpp.com', '&lt;p&gt;\r\n	阿发分玩热舞&lt;/p&gt;\r\n', null, '0', '5', '1', '0', '2012-09-24 11:20:18', null, null);

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
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ideas
-- ----------------------------
INSERT INTO `ideas` VALUES ('1', '1', null, '', '第一个创意悬赏', '0', '0', '10', '2012-11-03', '<p>\r\n	啊啊啊啊啊</p>\r\n', '1', '3', '2', '2', '3', '1', null, null, '0', '0', '2012-09-24 11:26:47', '2012-09-24 11:26:47');

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
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of idea_items
-- ----------------------------

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
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of logs
-- ----------------------------
INSERT INTO `logs` VALUES ('1', '11', '管理员 admin 登陆', '1', '::1', '2012-09-24 11:21:00');

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
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of messages
-- ----------------------------

-- ----------------------------
-- Table structure for `options`
-- ----------------------------
DROP TABLE IF EXISTS `options`;
CREATE TABLE `options` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `key` varchar(255) NOT NULL,
  `value` varchar(1000) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of options
-- ----------------------------
INSERT INTO `options` VALUES ('1', 'MOST_COMMON_TAGS', 'a:5:{i:0;a:3:{s:2:\"id\";s:1:\"3\";s:4:\"name\";s:6:\"妹子\";s:5:\"count\";s:2:\"14\";}i:1;a:3:{s:2:\"id\";s:1:\"2\";s:4:\"name\";s:2:\"pp\";s:5:\"count\";s:1:\"9\";}i:2;a:3:{s:2:\"id\";s:1:\"1\";s:4:\"name\";s:6:\"西安\";s:5:\"count\";s:1:\"7\";}i:3;a:3:{s:2:\"id\";s:1:\"6\";s:4:\"name\";s:6:\"飞机\";s:5:\"count\";s:1:\"6\";}i:4;a:3:{s:2:\"id\";s:2:\"12\";s:4:\"name\";s:6:\"工业\";s:5:\"count\";s:1:\"4\";}}');

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
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of patents
-- ----------------------------
INSERT INTO `patents` VALUES ('1', '5', '8', '发paper啦', '12345', '11', '<p>\r\n	法额饿个</p>\r\n', '214124', '4214214', '2424@qq.co', 'http://abc.com', '1', '5', '2', '1', '1', '1', '1', null, '韩盼盼', null, null, '2012-09-24 11:46:44', null);

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
  `cat` smallint(6) DEFAULT NULL,
  `subcat` smallint(6) DEFAULT NULL,
  `province` varchar(50) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `district` varchar(50) DEFAULT NULL,
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
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of problems
-- ----------------------------
INSERT INTO `problems` VALUES ('1', '1', '3', '安徽省', '合肥市', '包河区', '22', '2012-12-01', '1', 'lyc', '', '第一个难题', '12345', '54321', 'fafwa@qq.com', '<p>\r\n	afsaf</p>\r\n', '3', '0', null, null, '1', '2012-09-24 11:26:02', '2012-09-24 11:26:02');
INSERT INTO `problems` VALUES ('2', '1', '3', '湖北省', '武汉市', '江汉区', '33', '2012-12-07', '1', 'lyc', '浙江大学', '第二个难题', '12345', '13212', '24@qq.com', '<p>\r\n	wa发达反外挂</p>\r\n', '1', '0', null, null, '1', '2012-09-24 12:24:41', '2012-09-24 12:24:41');

-- ----------------------------
-- Table structure for `recruits`
-- ----------------------------
DROP TABLE IF EXISTS `recruits`;
CREATE TABLE `recruits` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `num` int(4) DEFAULT NULL,
  `identity` tinyint(4) DEFAULT NULL,
  `specialty` varchar(255) DEFAULT NULL,
  `area` varchar(255) DEFAULT NULL,
  `degree` tinyint(4) DEFAULT NULL,
  `pay` double DEFAULT NULL,
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
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of recruits
-- ----------------------------
INSERT INTO `recruits` VALUES ('1', '找洗碗工啦', '12', '3', '计算机', '玉泉校区', '3', '11', '12', '2', '1313131', '1', 'Company', 'lyc', '', '1', '2012-09-24 11:27:18');
INSERT INTO `recruits` VALUES ('2', '找码农', '22', '2', '计算机', '西湖科技园', '3', '11', '22', '1', '123', '1', 'Expert', 'hpp', '韩盼盼', '1', '2012-09-24 11:48:06');

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
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of solutions
-- ----------------------------
INSERT INTO `solutions` VALUES ('1', '1', '第一个难题', '1', 'hpp', '韩盼盼', '我的竞标方案1', '<p>\r\n	我的竞标方案我的竞标方案我的竞标方案1</p>\r\n', null, null, null, null, null, '0', '2012-09-24 12:22:11');
INSERT INTO `solutions` VALUES ('2', '1', '第一个难题', '1', 'hpp', '韩盼盼', '竞标方案2', '<p>\r\n	竞标方案2竞标方案2</p>\r\n', '5', '不错不错', '5', '不错不错', null, '1', '2012-09-24 12:22:55');

-- ----------------------------
-- Table structure for `tags`
-- ----------------------------
DROP TABLE IF EXISTS `tags`;
CREATE TABLE `tags` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `count` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tags
-- ----------------------------
INSERT INTO `tags` VALUES ('1', '西安', '7');
INSERT INTO `tags` VALUES ('2', 'pp', '11');
INSERT INTO `tags` VALUES ('3', '妹子', '16');
INSERT INTO `tags` VALUES ('4', '旅游', '2');
INSERT INTO `tags` VALUES ('5', '青岛', '1');
INSERT INTO `tags` VALUES ('6', '飞机', '7');
INSERT INTO `tags` VALUES ('7', '高铁', '1');
INSERT INTO `tags` VALUES ('8', '北京', '0');
INSERT INTO `tags` VALUES ('9', '动车', '1');
INSERT INTO `tags` VALUES ('10', '撒旦', '0');
INSERT INTO `tags` VALUES ('11', '美女', '2');
INSERT INTO `tags` VALUES ('12', '工业', '5');
INSERT INTO `tags` VALUES ('13', '农业', '2');
INSERT INTO `tags` VALUES ('14', '机械', '1');
INSERT INTO `tags` VALUES ('15', '杭州', '1');
INSERT INTO `tags` VALUES ('16', '科研', '1');

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
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

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
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of topics
-- ----------------------------
INSERT INTO `topics` VALUES ('1', 'CC98是个好地方', '<p>\r\n	rt</p>\r\n', '0', '4', '1', 'Company', null, '浙江大学', '2012-09-24 11:30:48');
INSERT INTO `topics` VALUES ('2', '', '顶LZ', '1', '0', '1', 'Company', null, '浙江大学', '2012-09-24 11:31:03');
INSERT INTO `topics` VALUES ('3', '', '继续顶', '1', '0', '1', 'Company', 'lyc', '浙江大学', '2012-09-24 11:39:32');
INSERT INTO `topics` VALUES ('4', '', '发送发', '1', '0', '1', 'Company', 'lyc', '浙江大学', '2012-09-24 11:42:24');
INSERT INTO `topics` VALUES ('5', '', '<blockquote>以下是引用<a href=\"javascript:;\">浙江大学</a>在2012-09-24 11:42:24 的回复<p>发送发</p></blockquote>\n顶', '1', '0', '1', 'Expert', 'hpp', '韩盼盼', '2012-09-24 11:48:32');

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
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of videos
-- ----------------------------

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
INSERT INTO `words` VALUES ('8', '伦敦奥运');
INSERT INTO `words` VALUES ('2', '胡锦涛');
INSERT INTO `words` VALUES ('3', '温家宝');
INSERT INTO `words` VALUES ('5', '江泽民');
INSERT INTO `words` VALUES ('7', '毛泽东');
