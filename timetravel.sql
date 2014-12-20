-- Adminer 4.1.0 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `action`;
CREATE TABLE `action` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `name` char(30) NOT NULL DEFAULT '' COMMENT '行为唯一标识',
  `title` char(80) NOT NULL DEFAULT '' COMMENT '行为说明',
  `remark` char(140) NOT NULL DEFAULT '' COMMENT '行为描述',
  `rule` text NOT NULL COMMENT '行为规则',
  `log` text NOT NULL COMMENT '日志规则',
  `type` tinyint(2) unsigned NOT NULL DEFAULT '1' COMMENT '类型',
  `status` tinyint(2) NOT NULL DEFAULT '0' COMMENT '状态',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '修改时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='系统行为表';

INSERT INTO `action` (`id`, `name`, `title`, `remark`, `rule`, `log`, `type`, `status`, `update_time`) VALUES
(1,	'user_login',	'用户登录',	'积分+10，每天一次',	'table:member|field:score|condition:uid={$self} AND status>-1|rule:score+10|cycle:24|max:1;',	'[user|get_nickname]在[time|time_format]登录了后台',	1,	1,	1387181220),
(2,	'edit_config',	'编辑配置',	'编辑配置',	'',	'',	1,	1,	1397291195),
(4,	'clear_log',	'清空日志',	'清空行为日志',	'',	'',	1,	1,	1397290762),
(5,	'delete_log',	'删除行为日志',	'删除行为日志',	'',	'',	1,	1,	1397290847),
(6,	'change_log',	'改变行为日志',	'改变行为日志',	'',	'',	1,	1,	1397290892),
(7,	'delete_config',	'删除配置',	'删除配置',	'',	'',	1,	1,	1397290985),
(8,	'add_config',	'新增配置',	'新增配置',	'',	'',	1,	1,	1397291222),
(9,	'update_member',	'更新用户信息',	'更新用户信息',	'',	'',	1,	1,	1397291403),
(10,	'dlete_member',	'删除用户',	'删除用户',	'',	'',	1,	1,	1397291509),
(11,	'add_member',	'新增用户',	'新增用户',	'',	'',	1,	1,	1397291556),
(12,	'add_article',	'添加内容',	'添加内容',	'',	'',	1,	1,	1397312659),
(13,	'delete_article',	'删除内容',	'删除内容',	'',	'',	1,	1,	1397312713),
(14,	'delete_auth',	'删除规则',	'删除规则',	'',	'',	1,	1,	1398089890),
(15,	'add_auth',	'添加规则',	'添加规则',	'',	'',	1,	1,	1398089906),
(16,	'edit_auth',	'编辑规则',	'编辑规则',	'',	'',	1,	1,	1398089919),
(17,	'add_role',	'添加角色',	'添加角色',	'',	'',	1,	1,	1398091224),
(18,	'edit_role',	'编辑角色',	'编辑角色',	'',	'',	1,	1,	1398091243),
(19,	'delete_role',	'删除角色',	'删除角色',	'',	'',	1,	1,	1398091256),
(20,	'user_auth',	'用户授权',	'用户授权',	'',	'',	1,	1,	1398177027),
(21,	'role_auth',	'角色授权',	'角色授权',	'',	'',	1,	1,	1398177041);

DROP TABLE IF EXISTS `action_log`;
CREATE TABLE `action_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `action_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '行为id',
  `user_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '执行用户id',
  `action_ip` bigint(20) NOT NULL COMMENT '执行行为者ip',
  `model` varchar(50) NOT NULL DEFAULT '' COMMENT '触发行为的表',
  `record_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '触发行为的数据id',
  `remark` varchar(255) NOT NULL DEFAULT '' COMMENT '日志备注',
  `status` tinyint(2) NOT NULL DEFAULT '1' COMMENT '状态',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '执行行为的时间',
  PRIMARY KEY (`id`),
  KEY `action_ip_ix` (`action_ip`) USING BTREE,
  KEY `action_id_ix` (`action_id`) USING BTREE,
  KEY `user_id_ix` (`user_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='行为日志表';

INSERT INTO `action_log` (`id`, `action_id`, `user_id`, `action_ip`, `model`, `record_id`, `remark`, `status`, `create_time`) VALUES
(1,	1,	1,	0,	'Member',	1,	'CoolHots在2014-04-12 16:14登录了后台',	1,	1397290470),
(3,	1,	1,	0,	'Member',	1,	'CoolHots在2014-04-12 16:14登录了后台',	1,	1397290499),
(4,	6,	1,	0,	'Action',	7,	'操作url：/Admin/Action/addAction.shtml',	1,	1397290985),
(5,	2,	1,	0,	'Config',	3,	'操作url：/Admin/Config/edit.shtml',	1,	1397291152),
(6,	6,	1,	0,	'Action',	2,	'操作url：/Admin/Action/editAction.shtml',	1,	1397291195),
(7,	6,	1,	0,	'Action',	8,	'操作url：/Admin/Action/addAction.shtml',	1,	1397291222),
(8,	1,	1,	0,	'Member',	1,	'CoolHots在2014-04-12 16:28登录了后台',	1,	1397291333),
(9,	7,	1,	0,	'Config',	0,	'操作url：/Admin/Config/delete/id/3.shtml',	1,	1397291364),
(10,	6,	1,	0,	'Action',	9,	'操作url：/Admin/Action/addAction.shtml',	1,	1397291403),
(11,	9,	1,	0,	'Member',	1,	'操作url：/Admin/Member/changepassword.shtml',	1,	1397291455),
(12,	6,	1,	0,	'Action',	10,	'操作url：/Admin/Action/addAction.shtml',	1,	1397291509),
(13,	6,	1,	0,	'Action',	11,	'操作url：/Admin/Action/addAction.shtml',	1,	1397291556),
(14,	9,	1,	0,	'Member',	1,	'操作url：/Admin/Member/edit.shtml',	1,	1397291574),
(15,	11,	1,	0,	'Member',	2,	'操作url：/Admin/Member/add.shtml',	1,	1397291583),
(16,	10,	1,	0,	'Member',	2,	'操作url：/Admin/Member/delete/id/2.shtml',	1,	1397291588),
(17,	2,	1,	0,	'Config',	2,	'操作url：/Admin/Config/edit.shtml',	1,	1397291613),
(18,	1,	1,	0,	'Member',	1,	'CoolHots在2014-04-12 21:08登录了后台',	1,	1397308109),
(19,	6,	1,	0,	'Action',	12,	'操作url：/Admin/Action/addAction.shtml',	1,	1397312659),
(20,	6,	1,	0,	'Action',	13,	'操作url：/Admin/Action/addAction.shtml',	1,	1397312713),
(21,	1,	1,	0,	'Member',	1,	'CoolHots在2014-04-14 11:18登录了后台',	1,	1397445485),
(22,	2,	1,	0,	'Config',	1,	'操作url：/Admin/Config/edit.shtml',	1,	1397445493),
(23,	12,	1,	0,	'Article',	1,	'操作url：/Admin/Article/add.shtml',	1,	1397447411),
(24,	12,	1,	0,	'Article',	2,	'操作url：/Admin/Article/add.shtml',	1,	1397447605),
(25,	2,	1,	0,	'Config',	1,	'操作url：/Admin/Config/edit.shtml',	1,	1397447734),
(26,	12,	1,	0,	'Article',	3,	'操作url：/Admin/Article/add.shtml',	1,	1397447757),
(27,	12,	1,	0,	'Article',	4,	'操作url：/Admin/Article/add.shtml',	1,	1397448213),
(28,	1,	1,	0,	'Member',	1,	'CoolHots在2014-04-14 21:55登录了后台',	1,	1397483744),
(29,	1,	1,	-1419042962,	'Member',	1,	'CoolHots在2014-04-15 15:53登录了后台',	1,	1397548418),
(30,	2,	1,	-1419042962,	'Config',	1,	'操作url：/Admin/Config/edit.shtml',	1,	1397549378),
(31,	1,	1,	0,	'Member',	1,	'CoolHots在2014-04-21 13:24登录了后台',	1,	1398057894),
(32,	1,	1,	0,	'Member',	1,	'CoolHots在2014-04-21 14:28登录了后台',	1,	1398061729),
(33,	1,	1,	0,	'Member',	1,	'CoolHots在2014-04-21 14:49登录了后台',	1,	1398062990),
(34,	1,	1,	0,	'Member',	1,	'CoolHots在2014-04-21 14:51登录了后台',	1,	1398063078),
(35,	1,	1,	0,	'Member',	1,	'CoolHots在2014-04-21 14:51登录了后台',	1,	1398063087),
(36,	1,	1,	0,	'Member',	1,	'CoolHots在2014-04-21 14:52登录了后台',	1,	1398063133),
(37,	1,	1,	0,	'Member',	1,	'CoolHots在2014-04-21 14:52登录了后台',	1,	1398063152),
(38,	1,	1,	0,	'Member',	1,	'CoolHots在2014-04-21 14:53登录了后台',	1,	1398063232),
(39,	1,	1,	0,	'Member',	1,	'CoolHots在2014-04-21 14:56登录了后台',	1,	1398063400),
(40,	1,	1,	0,	'Member',	1,	'CoolHots在2014-04-21 14:57登录了后台',	1,	1398063460),
(41,	1,	1,	0,	'Member',	1,	'CoolHots在2014-04-21 14:58登录了后台',	1,	1398063489),
(42,	1,	1,	0,	'Member',	1,	'CoolHots在2014-04-21 15:00登录了后台',	1,	1398063615),
(43,	1,	1,	0,	'Member',	1,	'CoolHots在2014-04-21 15:01登录了后台',	1,	1398063668),
(44,	1,	1,	0,	'Member',	1,	'CoolHots在2014-04-21 15:02登录了后台',	1,	1398063774),
(45,	1,	1,	0,	'Member',	1,	'CoolHots在2014-04-21 15:18登录了后台',	1,	1398064715),
(46,	1,	1,	0,	'Member',	1,	'CoolHots在2014-04-21 15:19登录了后台',	1,	1398064781),
(47,	1,	1,	0,	'Member',	1,	'CoolHots在2014-04-21 15:27登录了后台',	1,	1398065271),
(48,	2,	1,	0,	'Config',	1,	'操作url：/Admin/Config/edit.shtml',	1,	1398065299),
(49,	1,	1,	0,	'Member',	1,	'CoolHots在2014-04-21 15:28登录了后台',	1,	1398065320),
(50,	1,	1,	-556259043,	'Member',	1,	'CoolHots在2014-04-21 15:34登录了后台',	1,	1398065670),
(51,	1,	1,	0,	'Member',	1,	'CoolHots在2014-04-21 15:43登录了后台',	1,	1398066223),
(52,	1,	1,	-556259043,	'Member',	1,	'CoolHots在2014-04-21 15:52登录了后台',	1,	1398066777),
(53,	2,	1,	-556259043,	'Config',	1,	'操作url：/Admin/Config/edit.shtml',	1,	1398066786),
(54,	2,	1,	-556259043,	'Config',	1,	'操作url：/Admin/Config/edit.shtml',	1,	1398066802),
(55,	2,	1,	-556259043,	'Config',	1,	'操作url：/Admin/Config/edit.shtml',	1,	1398066823),
(56,	2,	1,	-556259043,	'Config',	1,	'操作url：/Admin/Config/edit.shtml',	1,	1398066832),
(57,	2,	1,	-556259043,	'Config',	1,	'操作url：/Admin/Config/edit.shtml',	1,	1398066839),
(58,	1,	1,	0,	'Member',	1,	'CoolHots在2014-04-21 19:13登录了后台',	1,	1398078836),
(59,	1,	1,	0,	'Member',	1,	'CoolHots在2014-04-21 22:02登录了后台',	1,	1398088923),
(60,	6,	1,	0,	'Action',	14,	'操作url：/Admin/Action/addAction.shtml',	1,	1398089890),
(61,	6,	1,	0,	'Action',	15,	'操作url：/Admin/Action/addAction.shtml',	1,	1398089906),
(62,	6,	1,	0,	'Action',	16,	'操作url：/Admin/Action/addAction.shtml',	1,	1398089919),
(63,	16,	1,	0,	'Auth',	20,	'操作url：/Admin/Auth/edit.shtml',	1,	1398089945),
(64,	16,	1,	0,	'Auth',	4,	'操作url：/Admin/Auth/edit.shtml',	1,	1398090292),
(65,	1,	1,	0,	'Member',	1,	'CoolHots在2014-04-21 22:29登录了后台',	1,	1398090590),
(66,	16,	1,	0,	'Auth',	4,	'操作url：/Admin/Auth/edit.shtml',	1,	1398090826),
(67,	6,	1,	0,	'Action',	17,	'操作url：/Admin/Action/addAction.shtml',	1,	1398091224),
(68,	6,	1,	0,	'Action',	18,	'操作url：/Admin/Action/addAction.shtml',	1,	1398091243),
(69,	6,	1,	0,	'Action',	19,	'操作url：/Admin/Action/addAction.shtml',	1,	1398091256),
(70,	17,	1,	0,	'Role',	4,	'操作url：/Admin/Role/add.shtml',	1,	1398091446),
(71,	18,	1,	0,	'Role',	4,	'操作url：/Admin/Role/edit.shtml',	1,	1398091491),
(72,	1,	1,	0,	'Member',	1,	'CoolHots在2014-04-21 22:52登录了后台',	1,	1398091979),
(73,	1,	1,	0,	'Member',	1,	'CoolHots在2014-04-21 23:28登录了后台',	1,	1398094130),
(74,	1,	1,	0,	'Member',	1,	'CoolHots在2014-04-22 21:41登录了后台',	1,	1398174071),
(75,	1,	1,	0,	'Member',	1,	'CoolHots在2014-04-22 22:20登录了后台',	1,	1398176446),
(76,	9,	1,	0,	'Member',	1,	'操作url：/Admin/Member/edit.shtml',	1,	1398176960),
(77,	9,	1,	0,	'Member',	1,	'操作url：/Admin/Member/edit.shtml',	1,	1398176969),
(78,	6,	1,	0,	'Action',	20,	'操作url：/Admin/Action/addAction.shtml',	1,	1398177027),
(79,	6,	1,	0,	'Action',	21,	'操作url：/Admin/Action/addAction.shtml',	1,	1398177041),
(80,	21,	1,	0,	'Role',	4,	'操作url：/Admin/Role/auth.shtml',	1,	1398177075),
(81,	20,	1,	0,	'Member',	1,	'操作url：/Admin/Member/auth.shtml',	1,	1398177082),
(82,	1,	1,	0,	'Member',	1,	'CoolHots在2014-04-23 11:37登录了后台',	1,	1398224254),
(83,	11,	1,	0,	'Member',	2,	'操作url：/Admin/Member/add.shtml',	1,	1398224288),
(84,	9,	1,	0,	'Member',	2,	'操作url：/Admin/Member/changepassword.shtml',	1,	1398224295),
(85,	1,	2,	0,	'Member',	2,	'测试用户在2014-04-23 11:38登录了后台',	1,	1398224311),
(86,	1,	1,	0,	'Member',	1,	'CoolHots在2014-04-23 11:38登录了后台',	1,	1398224325),
(87,	20,	1,	0,	'Member',	2,	'操作url：/Admin/Member/auth.shtml',	1,	1398224344),
(88,	1,	1,	0,	'Member',	1,	'CoolHots在2014-04-23 11:39登录了后台',	1,	1398224351),
(89,	1,	2,	0,	'Member',	2,	'测试用户在2014-04-23 11:39登录了后台',	1,	1398224363),
(90,	1,	1,	0,	'Member',	1,	'CoolHots在2014-04-23 11:39登录了后台',	1,	1398224383),
(91,	1,	2,	0,	'Member',	2,	'测试用户在2014-04-23 11:42登录了后台',	1,	1398224548),
(92,	1,	1,	0,	'Member',	1,	'CoolHots在2014-04-23 11:50登录了后台',	1,	1398225044),
(93,	20,	1,	0,	'Member',	2,	'操作url：/Admin/Member/auth.shtml',	1,	1398225054),
(94,	9,	1,	0,	'Member',	2,	'操作url：/Admin/Member/edit.shtml',	1,	1398225067),
(95,	1,	2,	0,	'Member',	2,	'测试用户在2014-04-23 11:51登录了后台',	1,	1398225082),
(96,	1,	1,	0,	'Member',	1,	'CoolHots在2014-04-23 11:51登录了后台',	1,	1398225099),
(97,	1,	2,	0,	'Member',	2,	'测试用户在2014-04-23 11:51登录了后台',	1,	1398225119),
(98,	21,	1,	0,	'Role',	4,	'操作url：/Admin/Role/auth.shtml',	1,	1398225149),
(99,	1,	1,	-1265847980,	'Member',	1,	'CoolHots在2014-04-24 02:43登录了后台',	1,	1398278639),
(101,	5,	1,	-1265847980,	'ActionLog',	1,	'操作url：/Admin/Action/deletelog/id/100.shtml',	1,	1398307525),
(102,	1,	1,	-1265847980,	'Member',	1,	'CoolHots在2014-04-24 10:54登录了后台',	1,	1398308068),
(103,	1,	1,	-1265847980,	'Member',	1,	'CoolHots在2014-04-24 10:54登录了后台',	1,	1398308090),
(104,	1,	1,	0,	'Member',	1,	'CoolHots在2014-04-24 11:43登录了后台',	1,	1398311006),
(105,	16,	1,	0,	'Auth',	15,	'操作url：/Admin/Auth/edit.shtml',	1,	1398311032),
(106,	1,	1,	0,	'Member',	1,	'CoolHots在2014-04-24 20:42登录了后台',	1,	1398343332),
(107,	1,	1,	0,	'Member',	1,	'CoolHots在2014-04-24 21:08登录了后台',	1,	1398344898),
(108,	1,	1,	0,	'Member',	1,	'CoolHots在2014-04-24 23:44登录了后台',	1,	1398354281),
(109,	1,	1,	0,	'Member',	1,	'CoolHots在2014-05-03 21:54登录了后台',	1,	1399125246),
(110,	1,	1,	0,	'Member',	1,	'CoolHots在2014-05-03 22:20登录了后台',	1,	1399126856),
(111,	1,	1,	0,	'Member',	1,	'CoolHots在2014-05-03 22:58登录了后台',	1,	1399129085),
(112,	1,	1,	0,	'Member',	1,	'CoolHots在2014-12-01 02:26登录了后台',	1,	1417372001),
(113,	16,	1,	0,	'Auth',	19,	'操作url：/timetravel/Admin/index.php?s=/Admin/Auth/edit.html',	1,	1417372394),
(114,	16,	1,	0,	'Auth',	20,	'操作url：/timetravel/Admin/index.php?s=/Admin/Auth/edit.html',	1,	1417372411),
(115,	16,	1,	0,	'Auth',	20,	'操作url：/timetravel/Admin/index.php?s=/Admin/Auth/edit.html',	1,	1417372419),
(116,	16,	1,	0,	'Auth',	18,	'操作url：/timetravel/Admin/index.php?s=/Admin/Auth/edit.html',	1,	1417374137),
(117,	15,	1,	0,	'Auth',	21,	'操作url：/timetravel/Admin/index.php?s=/Admin/Auth/add.html',	1,	1417377599),
(118,	16,	1,	0,	'Auth',	21,	'操作url：/timetravel/Admin/index.php?s=/Admin/Auth/edit.html',	1,	1417377619),
(119,	16,	1,	0,	'Auth',	21,	'操作url：/timetravel/Admin/index.php?s=/Admin/Auth/edit.html',	1,	1417377750),
(120,	15,	1,	0,	'Auth',	22,	'操作url：/timetravel/Admin/index.php?s=/Admin/Auth/add.html',	1,	1417377780),
(121,	15,	1,	0,	'Auth',	23,	'操作url：/timetravel/Admin/index.php?s=/Admin/Auth/add.html',	1,	1417380236),
(122,	15,	1,	0,	'Auth',	24,	'操作url：/timetravel/Admin/index.php?s=/Admin/Auth/add.html',	1,	1417487515),
(123,	15,	1,	0,	'Auth',	25,	'操作url：/timetravel/Admin/index.php?s=/Admin/Auth/add.html',	1,	1417487592),
(124,	15,	1,	0,	'Auth',	26,	'操作url：/timetravel/Admin/index.php?s=/Admin/Auth/add.html',	1,	1417487649),
(125,	1,	1,	0,	'Member',	1,	'CoolHots在2014-12-03 00:52登录了后台',	1,	1417539168),
(126,	1,	1,	0,	'Member',	1,	'CoolHots在2014-12-04 20:36登录了后台',	1,	1417696583),
(127,	2,	1,	2130706433,	'Config',	1,	'操作url：/timetravel/admin/index.php?s=/Admin/Config/edit.html',	1,	1417885510),
(128,	1,	1,	2130706433,	'Member',	1,	'CoolHots在2014-12-07 16:41登录了后台',	1,	1417941685),
(129,	2,	1,	2130706433,	'Config',	1,	'操作url：/timetravel/Admin/index.php?s=/Admin/Config/edit.html',	1,	1417944516),
(130,	1,	1,	0,	'Member',	1,	'CoolHots在2014-12-08 22:47登录了后台',	1,	1418050027),
(131,	12,	1,	0,	'Article',	4,	'操作url：/timetravel/Admin/index.php?s=/Admin/Article/add.html',	1,	1418053535),
(132,	12,	1,	0,	'Article',	5,	'操作url：/timetravel/Admin/index.php?s=/Admin/Article/add.html',	1,	1418107855),
(133,	12,	1,	0,	'Article',	6,	'操作url：/timetravel/Admin/index.php?s=/Admin/Article/add.html',	1,	1418108546),
(134,	12,	1,	0,	'Article',	7,	'操作url：/timetravel/Admin/index.php?s=/Admin/Article/add.html',	1,	1418110428),
(135,	13,	1,	0,	'Article',	0,	'操作url：/timetravel/Admin/index.php?s=/Admin/Article/delete/id/7.html',	1,	1418113286),
(136,	13,	1,	0,	'Article',	0,	'操作url：/timetravel/Admin/index.php?s=/Admin/Article/delete/id/4.html',	1,	1418113292),
(137,	16,	1,	0,	'Auth',	18,	'操作url：/timetravel/Admin/index.php?s=/Admin/Auth/edit.html',	1,	1418114331),
(138,	1,	1,	0,	'Member',	1,	'CoolHots在2014-12-09 21:04登录了后台',	1,	1418130254),
(139,	12,	1,	0,	'Article',	7,	'操作url：/timetravel/Admin/index.php?s=/Admin/Article/add.html',	1,	1418130683),
(140,	12,	1,	0,	'Article',	8,	'操作url：/timetravel/Admin/index.php?s=/Admin/Article/add.html',	1,	1418130783),
(141,	12,	1,	0,	'Article',	9,	'操作url：/timetravel/Admin/index.php?s=/Admin/Article/add.html',	1,	1418192001),
(142,	15,	1,	0,	'Auth',	27,	'操作url：/timetravel/Admin/index.php?s=/Admin/Auth/add.html',	1,	1418192802),
(143,	1,	1,	0,	'Member',	1,	'CoolHots在2014-12-10 19:26登录了后台',	1,	1418210809),
(144,	16,	1,	0,	'Auth',	27,	'操作url：/timetravel/Admin/index.php?s=/Admin/Auth/edit.html',	1,	1418231608),
(145,	15,	1,	0,	'Auth',	28,	'操作url：/timetravel/Admin/index.php?s=/Admin/Auth/add.html',	1,	1418231627),
(146,	16,	1,	0,	'Auth',	28,	'操作url：/timetravel/Admin/index.php?s=/Admin/Auth/edit.html',	1,	1418231661),
(147,	1,	1,	0,	'Member',	1,	'CoolHots在2014-12-11 11:16登录了后台',	1,	1418267817),
(148,	12,	1,	0,	'Article',	10,	'操作url：/timetravel/Admin/index.php?s=/Admin/Article/add.html',	1,	1418301355),
(149,	12,	1,	0,	'Article',	11,	'操作url：/timetravel/Admin/index.php?s=/Admin/Article/add.html',	1,	1418315742),
(150,	1,	1,	0,	'Member',	1,	'CoolHots在2014-12-14 15:56登录了后台',	1,	1418543814),
(151,	1,	1,	2130706433,	'Member',	1,	'CoolHots在2014-12-18 10:11登录了后台',	1,	1418868691),
(152,	1,	1,	0,	'Member',	1,	'CoolHots在2014-12-20 22:27登录了后台',	1,	1419085649);

DROP TABLE IF EXISTS `addons`;
CREATE TABLE `addons` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `name` varchar(40) NOT NULL COMMENT '插件名或标识',
  `title` varchar(20) NOT NULL DEFAULT '' COMMENT '中文名',
  `description` text COMMENT '插件描述',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态',
  `config` text COMMENT '配置',
  `author` varchar(40) DEFAULT '' COMMENT '作者',
  `version` varchar(20) DEFAULT '' COMMENT '版本号',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '安装时间',
  `has_adminlist` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否有后台列表',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='插件表';

INSERT INTO `addons` (`id`, `name`, `title`, `description`, `status`, `config`, `author`, `version`, `create_time`, `has_adminlist`) VALUES
(5,	'Editor',	'前台编辑器',	'用于增强整站长文本的输入和显示',	1,	'{\"editor_type\":\"2\",\"editor_wysiwyg\":\"1\",\"editor_height\":\"300px\",\"editor_resize_type\":\"1\"}',	'thinkphp',	'0.1',	1379830910,	0),
(6,	'Attachment',	'附件',	'用于文档模型上传附件',	1,	'null',	'thinkphp',	'0.1',	1379842319,	1),
(9,	'SocialComment',	'通用社交化评论',	'集成了各种社交化评论插件，轻松集成到系统中。',	1,	'{\"comment_type\":\"1\",\"comment_uid_youyan\":\"\",\"comment_short_name_duoshuo\":\"\",\"comment_data_list_duoshuo\":\"\"}',	'thinkphp',	'0.1',	1380273962,	0),
(15,	'EditorForAdmin',	'后台编辑器',	'用于增强整站长文本的输入和显示',	1,	'{\"editor_type\":\"2\",\"editor_wysiwyg\":\"2\",\"editor_markdownpreview\":\"1\",\"editor_height\":\"500px\",\"editor_resize_type\":\"1\"}',	'thinkphp',	'0.1',	1383126253,	0),
(16,	'SiteStat',	'站点统计信息',	'统计站点的基础信息',	1,	'{\"title\":\"\\u7cfb\\u7edf\\u4fe1\\u606f\",\"display\":\"1\"}',	'CoolHots',	'0.1',	1399129109,	0),
(17,	'SystemInfo',	'系统环境信息',	'用于显示一些服务器的信息',	1,	'{\"title\":\"\\u7cfb\\u7edf\\u4fe1\\u606f\",\"display\":\"1\"}',	'CoolHots',	'0.1',	1399129256,	0),
(18,	'DevTeam',	'开发团队信息',	'开发团队成员信息',	1,	'{\"title\":\"OneThink\\u5f00\\u53d1\\u56e2\\u961f\",\"display\":\"1\"}',	'CoolHots',	'0.1',	1399129258,	0);

DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1,	'boolean93',	'8ebb931a1cbc799f12b381aed3e21ca7');

DROP TABLE IF EXISTS `article`;
CREATE TABLE `article` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `content` longtext NOT NULL,
  `header_img` varchar(255) NOT NULL DEFAULT '',
  `type` varchar(255) NOT NULL,
  `create_time` varchar(255) NOT NULL,
  `click` int(11) NOT NULL DEFAULT '0',
  `good` int(11) NOT NULL DEFAULT '0',
  `reply` int(11) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `article` (`id`, `title`, `content`, `header_img`, `type`, `create_time`, `click`, `good`, `reply`, `status`) VALUES
(1,	'zheshibiaoti',	'&lt;p&gt;hehehhehe&lt;/p&gt;',	'/timetravel/Admin/Uploads/2014-12-11/5489455f090f0.png	',	'time',	'2038108',	0,	0,	0,	0),
(2,	'这是标题',	'&lt;p&gt;啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊&lt;/p&gt;',	'img_1.jpg',	'time',	'12312313',	2,	0,	0,	0),
(3,	'',	'',	'img_1.jpg',	'leader',	'',	0,	0,	0,	0),
(5,	'123123123',	'&lt;p&gt;1231231&lt;/p&gt;',	'',	'leader',	'',	0,	0,	0,	0),
(6,	'23',	'&lt;p&gt;123123133131&lt;/p&gt;',	'',	'time',	'1418108546',	0,	0,	0,	0),
(7,	'123456',	'&lt;p&gt;1232133&lt;/p&gt;',	'',	'time',	'1418130683',	0,	0,	0,	0),
(8,	'1aaa',	'&lt;p&gt;1111&lt;/p&gt;',	'',	'time',	'1418130784',	0,	0,	0,	0),
(9,	'离开家阿萨德了卷卡式带',	'&lt;p&gt;阿萨德了卡斯加大了看&lt;img src=&quot;/timetravel/Admin/Uploads/ueditor/image/548959ead1d9e.png&quot; title=&quot;548959ead1d9e.png&quot; alt=&quot;网址大全.png&quot;/&gt;&lt;/p&gt;',	'离开家阿萨德了空间阿斯达',	'time',	'1418192001',	0,	0,	0,	0),
(10,	'',	'',	'',	'',	'1418301355',	0,	0,	0,	0),
(11,	'Hey',	'',	'',	'',	'1418315742',	0,	0,	0,	0);

DROP TABLE IF EXISTS `auth`;
CREATE TABLE `auth` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '规则ID',
  `title` varchar(50) NOT NULL DEFAULT '' COMMENT '标题',
  `pid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '上级分类ID',
  `sort` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '排序（同级有效）',
  `url` char(255) NOT NULL DEFAULT '' COMMENT '链接地址',
  `hide` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否隐藏',
  `tip` varchar(255) NOT NULL DEFAULT '' COMMENT '提示',
  PRIMARY KEY (`id`),
  KEY `pid` (`pid`) USING BTREE,
  KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `auth` (`id`, `title`, `pid`, `sort`, `url`, `hide`, `tip`) VALUES
(1,	'用户',	0,	1,	'',	0,	''),
(2,	'用户管理',	1,	0,	'',	0,	''),
(3,	'用户信息',	2,	0,	'admin/member/index',	0,	''),
(4,	'角色管理',	2,	0,	'admin/role/index',	0,	''),
(5,	'行为管理',	1,	0,	'',	0,	''),
(6,	'用户行为',	5,	0,	'admin/action/index',	0,	''),
(7,	'行为日志',	5,	0,	'admin/action/log',	0,	''),
(8,	'系统',	0,	2,	'',	0,	''),
(9,	'系统设置',	8,	0,	'',	0,	''),
(10,	'配置管理',	9,	0,	'admin/config/index',	0,	''),
(11,	'菜单管理',	9,	0,	'admin/auth/index',	0,	''),
(12,	'插件',	0,	3,	'',	0,	''),
(13,	'拓展',	12,	0,	'',	0,	''),
(14,	'插件管理',	13,	0,	'admin/addons/index',	0,	''),
(15,	'钩子管理',	13,	0,	'admin/addons/hooks',	0,	''),
(16,	'编辑用户',	3,	0,	'admin/member/edit',	0,	''),
(17,	'内容',	0,	0,	'',	0,	''),
(18,	'内容管理',	17,	0,	'',	0,	''),
(19,	'文章列表',	18,	0,	'admin/article/index',	0,	''),
(20,	'活动列表',	18,	0,	'admin/route/index',	0,	'栏目列表'),
(21,	'其他管理',	17,	0,	'',	0,	''),
(22,	'首页图片轮播',	21,	0,	'admin/slider/index',	0,	''),
(23,	'简介管理',	21,	0,	'admin/stuff/index',	0,	''),
(24,	'游记管理',	18,	0,	'admin/memory/index',	0,	''),
(25,	'价格管理',	21,	0,	'admin/price/index',	0,	''),
(26,	'[关联管理]文章-路线',	18,	0,	'admin/relation/index',	0,	''),
(27,	'图片管理',	17,	0,	'',	0,	''),
(28,	'图片管理',	27,	0,	'admin/image/index',	0,	'');

DROP TABLE IF EXISTS `category`;
CREATE TABLE `category` (
  `cid` int(11) NOT NULL AUTO_INCREMENT COMMENT '栏目主键',
  `title` varchar(50) NOT NULL COMMENT '栏目标题',
  `ename` varchar(100) NOT NULL COMMENT '别名(英文名)',
  `pid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '上级栏目',
  `type` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0列表，1单页',
  `keywords` varchar(50) DEFAULT '' COMMENT '关键字',
  `description` varchar(255) DEFAULT '' COMMENT '关键字',
  `content` text COMMENT '内容',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '1显示0隐藏',
  `sort` smallint(6) NOT NULL DEFAULT '100' COMMENT '排序',
  PRIMARY KEY (`cid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `category` (`cid`, `title`, `ename`, `pid`, `type`, `keywords`, `description`, `content`, `status`, `sort`) VALUES
(4,	'博客',	'blog',	0,	0,	'',	'',	'',	1,	0),
(5,	'ASP.NET',	'donet',	4,	0,	'',	'',	'',	1,	0);

DROP TABLE IF EXISTS `config`;
CREATE TABLE `config` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '配置ID',
  `name` varchar(30) NOT NULL DEFAULT '' COMMENT '配置名称',
  `title` varchar(50) NOT NULL DEFAULT '' COMMENT '配置说明',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '状态',
  `value` text NOT NULL COMMENT '配置值',
  `extra` varchar(255) NOT NULL DEFAULT '' COMMENT '配置值',
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_name` (`name`) USING BTREE,
  KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='系统配置表';

INSERT INTO `config` (`id`, `name`, `title`, `status`, `value`, `extra`) VALUES
(1,	'SHOW_PAGE_TRACE',	'是否显示页面Trace',	1,	'0',	'0:关闭\r\n1:开启'),
(2,	'LIST_ROWS',	'分页大小',	1,	'10',	'后台数据列表分页大小，默认为10条数据.');

DROP TABLE IF EXISTS `hooks`;
CREATE TABLE `hooks` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `name` varchar(40) NOT NULL DEFAULT '' COMMENT '钩子名称',
  `description` text NOT NULL COMMENT '描述',
  `type` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '类型',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `addons` varchar(255) NOT NULL DEFAULT '' COMMENT '钩子挂载的插件 ''，''分割',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='插件钩子表';

INSERT INTO `hooks` (`id`, `name`, `description`, `type`, `update_time`, `addons`) VALUES
(1,	'pageHeader',	'页面header钩子，一般用于加载插件CSS文件和代码',	1,	0,	''),
(2,	'pageFooter',	'页面footer钩子，一般用于加载插件JS文件和JS代码',	1,	0,	'ReturnTop'),
(3,	'documentEditForm',	'添加编辑表单的 扩展内容钩子',	1,	0,	'Attachment'),
(4,	'documentDetailAfter',	'文档末尾显示',	1,	0,	'Attachment,SocialComment'),
(5,	'documentDetailBefore',	'页面内容前显示用钩子',	1,	0,	''),
(6,	'documentSaveComplete',	'保存文档数据后的扩展钩子',	2,	0,	'Attachment'),
(8,	'adminArticleEdit',	'后台内容编辑页编辑器',	1,	1378982734,	'EditorForAdmin'),
(13,	'AdminIndex',	'首页小格子个性化显示',	1,	1382596073,	'SiteStat,SystemInfo,DevTeam'),
(14,	'topicComment',	'评论提交方式扩展钩子。',	1,	1380163518,	'Editor'),
(16,	'app_begin',	'应用开始.',	2,	1398312469,	'');

DROP TABLE IF EXISTS `image`;
CREATE TABLE `image` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `image` (`id`, `url`) VALUES
(5,	'/timetravel/Admin/Uploads/2014-12-11/5489455f090f0.png'),
(6,	'/timetravel/Admin/Uploads/2014-12-11/54894a9f2e4ca.png');

DROP TABLE IF EXISTS `member`;
CREATE TABLE `member` (
  `uid` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户ID',
  `username` char(16) NOT NULL,
  `password` char(32) NOT NULL COMMENT '密码',
  `encrypt` varchar(6) NOT NULL COMMENT '密钥',
  `nickname` char(16) NOT NULL DEFAULT '' COMMENT '昵称',
  `sex` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '性别，0为男，1为女',
  `birthday` date NOT NULL DEFAULT '0000-00-00' COMMENT '生日',
  `qq` char(10) NOT NULL DEFAULT '' COMMENT 'qq号',
  `login` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '登录次数',
  `reg_ip` bigint(20) NOT NULL DEFAULT '0' COMMENT '注册IP',
  `reg_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '注册时间',
  `last_login_ip` bigint(20) NOT NULL DEFAULT '0' COMMENT '最后登录IP',
  `last_login_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '最后登录时间',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '会员状态',
  `roleid` int(11) NOT NULL COMMENT '角色编号',
  `auth` text,
  PRIMARY KEY (`uid`),
  KEY `status` (`status`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='会员表';

INSERT INTO `member` (`uid`, `username`, `password`, `encrypt`, `nickname`, `sex`, `birthday`, `qq`, `login`, `reg_ip`, `reg_time`, `last_login_ip`, `last_login_time`, `status`, `roleid`, `auth`) VALUES
(1,	'admin',	'9fdcb1caaff8258f5a454aa95c48faf2',	'ebJ95e',	'Boolean93',	0,	'1993-03-10',	'',	83,	0,	0,	0,	1419085649,	1,	1,	''),
(2,	'test',	'e4a5a850fa370c03c220d70d2fc49bf5',	'CF1rfQ',	'测试用户',	0,	'0000-00-00',	'',	5,	0,	0,	0,	1398225119,	1,	4,	'');

DROP TABLE IF EXISTS `memory`;
CREATE TABLE `memory` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `content` longtext NOT NULL,
  `pic_url` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `create_time` varchar(255) NOT NULL,
  `click` int(11) NOT NULL,
  `good` int(11) NOT NULL,
  `readable` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `memory` (`id`, `title`, `content`, `pic_url`, `user_id`, `create_time`, `click`, `good`, `readable`) VALUES
(1,	'title',	'感觉自己萌萌哒感觉自己萌萌哒感觉自己萌萌哒感觉自己萌萌哒感觉自己萌萌哒感觉自己萌萌哒感觉自己萌萌哒感觉自己萌萌哒感觉自己萌萌哒\n',	'img_2.jpg',	1,	'213123',	113,	13,	1),
(2,	'23',	'&lt;p&gt;123123112334&lt;/p&gt;',	'',	1,	'1417081222',	36,	9,	1),
(3,	'',	'&lt;p&gt;&lt;img src=&quot;/timetravel/Public/Uploads/ueditor/image/5479da6e8d7db.jpg&quot; title=&quot;5479da6e8d7db.jpg&quot; alt=&quot;05时光之旅分页（文章）.jpg&quot;/&gt;&lt;/p&gt;',	'',	1,	'1417271930',	33,	16,	1),
(4,	'daslkdasldkj',	'&lt;p&gt;asdasdasdad&lt;/p&gt;',	'',	1,	'1418458963',	30,	26,	1),
(5,	'呵呵',	'&lt;p&gt;123213231&lt;/p&gt;',	'/timetravel/Public/image/img_1.jpg',	1,	'1418460017',	6,	0,	1),
(6,	'Hey!',	'&lt;p&gt;阿斯达立刻就暗示的徕卡金士顿乐极哀来是看得见&lt;br/&gt;&lt;/p&gt;',	'http://localhost:1234/timetravel/Public/image/img_1.jpg',	1,	'1419099433',	0,	0,	1);

DROP TABLE IF EXISTS `nav`;
CREATE TABLE `nav` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `fid` varchar(255) NOT NULL,
  `controller` varchar(255) NOT NULL,
  `function` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `nav` (`id`, `name`, `fid`, `controller`, `function`) VALUES
(1,	'游记管理',	'0',	'',	''),
(2,	'文章管理',	'0',	'',	''),
(3,	'路线管理',	'0',	'',	''),
(4,	'用户管理',	'0',	'',	''),
(5,	'文章路线关联',	'0',	'',	''),
(6,	'小部件管理',	'0',	'',	''),
(7,	'主页轮播管理',	'0',	'',	''),
(8,	'订单管理',	'0',	'',	''),
(9,	'价格管理',	'0',	'',	''),
(10,	'管理员管理',	'0',	'',	''),
(11,	'游记列表',	'1',	'Memory',	'index'),
(12,	'文章列表',	'2',	'Article',	'index'),
(13,	'',	'',	'',	'');

DROP TABLE IF EXISTS `onedream_article`;
CREATE TABLE `onedream_article` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '文章编号',
  `title` varchar(60) NOT NULL DEFAULT '' COMMENT '标题',
  `shorttitle` varchar(30) NOT NULL DEFAULT '' COMMENT '副标题',
  `copyfrom` varchar(30) NOT NULL DEFAULT '' COMMENT '来源',
  `author` varchar(30) NOT NULL DEFAULT '' COMMENT '作者',
  `keywords` varchar(50) DEFAULT '' COMMENT '关键字',
  `litpic` varchar(150) NOT NULL DEFAULT '' COMMENT '缩略图',
  `content` text COMMENT '内容',
  `description` varchar(255) NOT NULL DEFAULT '' COMMENT '摘要描述',
  `publishtime` datetime NOT NULL COMMENT '发布时间',
  `updatetime` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `click` smallint(6) unsigned NOT NULL DEFAULT '0' COMMENT '点击数',
  `cid` int(10) unsigned NOT NULL COMMENT '分类ID',
  `commentflag` tinyint(1) NOT NULL DEFAULT '1' COMMENT '允许评论',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '1回收站',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `onedream_article` (`id`, `title`, `shorttitle`, `copyfrom`, `author`, `keywords`, `litpic`, `content`, `description`, `publishtime`, `updatetime`, `click`, `cid`, `commentflag`, `status`) VALUES
(4,	'测试内容',	'test',	'博客园',	'CoolHots',	'文章',	'',	'文章测试一下',	'测试',	'2014-04-14 12:05:00',	0,	0,	4,	1,	1);

DROP TABLE IF EXISTS `order`;
CREATE TABLE `order` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `price` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `information` longtext NOT NULL,
  `route_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `price`;
CREATE TABLE `price` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `route_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `price` (`id`, `title`, `price`, `route_id`) VALUES
(1,	'123',	'123',	10),
(2,	'',	'100',	20);

DROP TABLE IF EXISTS `relation_article_route`;
CREATE TABLE `relation_article_route` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `article_id` int(11) NOT NULL,
  `route_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `relation_article_route` (`id`, `article_id`, `route_id`) VALUES
(1,	1,	1),
(7,	10,	18),
(8,	7,	11),
(9,	10,	18),
(10,	11,	1),
(11,	11,	1),
(12,	1,	18);

DROP TABLE IF EXISTS `role`;
CREATE TABLE `role` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '角色编号',
  `title` varchar(40) NOT NULL COMMENT '角色名称',
  `description` varchar(250) NOT NULL COMMENT '角色描述',
  `auth` text COMMENT '角色规则',
  `status` tinyint(1) unsigned NOT NULL COMMENT '角色状态',
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `status` (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='系统角色表';

INSERT INTO `role` (`id`, `title`, `description`, `auth`, `status`) VALUES
(1,	'系统管理员',	'系统管理员无需授权便拥有后台的全部管理权限。本角色是系统自带并且不可删除的。',	'1,2,3',	1),
(2,	'无权限用户组',	'本组不授权。用户属于本组的单独对该用户进行授权',	NULL,	1),
(3,	'普通管理员',	'普通管理员拥有绝大部份权限',	NULL,	1),
(4,	'测试角色',	'测试角色，权限？想太多了吧！呵呵',	'',	1);

DROP TABLE IF EXISTS `route`;
CREATE TABLE `route` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `travel_line` varchar(255) NOT NULL,
  `content` longtext NOT NULL,
  `taobao` text NOT NULL,
  `create_time` varchar(255) NOT NULL,
  `start_time` varchar(255) NOT NULL,
  `end_time` varchar(255) NOT NULL,
  `pic_url` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `route` (`id`, `title`, `travel_line`, `content`, `taobao`, `create_time`, `start_time`, `end_time`, `pic_url`, `type`) VALUES
(1,	'阿萨大多数',	'重庆-天堂',	'&lt;p&gt;&lt;img src=&quot;/timetravel/Admin/Uploads/ueditor/image/5489650bcff40.png&quot; title=&quot;5489650bcff40.png&quot; alt=&quot;网址大全.png&quot;/&gt;&lt;/p&gt;',	'http://baidu.com',	'12313987',	'1234',	'2131231231',	'/timetravel/Admin/Uploads/2014-12-11/5489455f090f0.png	',	'time'),
(2,	'啊实打实',	'阿斯顿',	'&lt;p&gt;lqskjdlkasjd&lt;/p&gt;',	'',	'21331233',	'12313',	'1241414',	'/timetravel/Public/image/img_1.jpg',	'young'),
(3,	'啊实打实',	'阿斯顿',	'按时的',	'',	'21331233',	'12313',	'12414142414',	'/timetravel/Public/image/img_1.jpg',	'young'),
(4,	'啊实打实',	'阿斯顿',	'按时的',	'',	'21331233',	'12313',	'12414142414',	'/timetravel/Public/image/img_1.jpg',	'young'),
(5,	'啊实打实',	'阿斯顿',	'按时的',	'',	'21331233',	'12313',	'12414142414',	'/timetravel/Public/image/img_1.jpg',	'young'),
(6,	'啊实打实',	'阿斯顿',	'&lt;p&gt;按时的&lt;/p&gt;',	'',	'21331233',	'12313',	'12414142414',	'/timetravel/Admin/Uploads/2014-12-11/5489455f090f0.png	',	'extreme'),
(7,	'啊实打实',	'阿斯顿',	'按时的',	'',	'21331233',	'12313',	'12414142414',	'img_1.jpg',	'extreme'),
(8,	'啊实打实',	'阿斯顿',	'按时的',	'',	'21331233',	'12313',	'12414142414',	'img_1.jpg',	'extreme'),
(9,	'啊实打实',	'阿斯顿',	'按时的',	'',	'21331233',	'12313',	'12414142414',	'img_1.jpg',	'extreme'),
(10,	'啊实打实',	'阿斯顿',	'按时的',	'',	'21331233',	'12313',	'12414142414',	'img_1.jpg',	'time'),
(11,	'啊实打实',	'阿斯顿',	'按时的',	'',	'21331233',	'12313',	'12414142414',	'img_1.jpg',	'time'),
(12,	'啊实打实',	'阿斯顿',	'按时的',	'',	'21331233',	'12313',	'12414142414',	'img_1.jpg',	'time'),
(13,	'啊实打实',	'阿斯顿',	'按时的',	'',	'21331233',	'12313',	'12414142414',	'img_1.jpg',	'time'),
(14,	'啊实打实',	'阿斯顿',	'按时的',	'',	'21331233',	'12313',	'12414142414',	'img_1.jpg',	'time'),
(15,	'啊实打实',	'阿斯顿',	'按时的',	'',	'21331233',	'12313',	'12414142414',	'img_1.jpg',	'time'),
(16,	'啊实打实',	'阿斯顿',	'按时的',	'',	'21331233',	'12313',	'12414142414',	'img_1.jpg',	'time'),
(18,	'1',	'',	'&lt;p&gt;1&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;1&lt;/p&gt;',	'',	'1418130820',	'1',	'1',	'/timetravel/Public/image/img_1.jpg',	'time'),
(19,	'lakj',	'lkj',	'',	'',	'1',	'1',	'1',	'/timetravel/Public/image/img_1.jpg',	'young'),
(20,	'',	'',	'',	'',	'0',	'0',	'0',	'/timetravel/Public/image/img_1.jpg',	'young'),
(21,	'',	'',	'',	'',	'0',	'0',	'1000000000',	'/timetravel/Public/image/img_1.jpg',	'young'),
(22,	'',	'',	'',	'',	'0',	'0',	'1000000000',	'/timetravel/Public/image/img_1.jpg',	'young'),
(23,	'',	'',	'',	'',	'0',	'0',	'0',	'/timetravel/Public/image/img_1.jpg',	'young'),
(24,	'',	'',	'',	'',	'0',	'0',	'0',	'/timetravel/Public/image/img_1.jpg',	'young'),
(25,	'',	'',	'',	'',	'0',	'0',	'0',	'/timetravel/Public/image/img_1.jpg',	'young'),
(26,	'',	'',	'',	'',	'0',	'0',	'0',	'/timetravel/Public/image/img_1.jpg',	'young'),
(27,	'',	'',	'',	'',	'0',	'0',	'1000000000',	'/timetravel/Public/image/img_1.jpg',	'young'),
(28,	'',	'',	'',	'',	'0',	'0',	'0',	'/timetravel/Public/image/img_1.jpg',	'young'),
(29,	'',	'',	'',	'',	'0',	'0',	'1000000000',	'/timetravel/Public/image/img_1.jpg',	'young'),
(30,	'',	'',	'',	'',	'0',	'0',	'0',	'/timetravel/Public/image/img_1.jpg',	'young'),
(31,	'',	'',	'',	'',	'0',	'0',	'0',	'/timetravel/Public/image/img_1.jpg',	'young'),
(32,	'',	'',	'',	'',	'0',	'0',	'1000000000',	'/timetravel/Public/image/img_1.jpg',	'young');

DROP TABLE IF EXISTS `slider`;
CREATE TABLE `slider` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `img_url` varchar(255) NOT NULL,
  `status` int(128) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `slider` (`id`, `img_url`, `status`) VALUES
(1,	'/timetravel/Admin/Uploads/2014-12-11/5489455f090f0.png	',	0),
(2,	'/timetravel/Admin/Uploads/2014-12-11/54894a9f2e4ca.png	',	0);

DROP TABLE IF EXISTS `stuff`;
CREATE TABLE `stuff` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `img_url` varchar(255) NOT NULL,
  `other` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `stuff` (`id`, `title`, `img_url`, `other`) VALUES
(1,	'极限探险的意义',	'asdas.jpg',	'extreme_1'),
(2,	'什么是极致探险',	'asd.jpg',	'extreme_2'),
(9,	'young',	'/timetravel/Admin/Uploads/2014-12-11/5489455f090f0.png	',	'喵!!!!!');

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `tel` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `register_time` varchar(255) NOT NULL,
  `last_login_time` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `user` (`id`, `username`, `password`, `tel`, `status`, `register_time`, `last_login_time`) VALUES
(1,	'Boolean93',	'b8088d2b23b7a932062f2c0a71214adc',	'1',	0,	'123123',	'1231233');

-- 2014-12-20 20:44:53
