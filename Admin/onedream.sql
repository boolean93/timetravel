/*
Navicat MySQL Data Transfer

Source Server         : 本地MySQL
Source Server Version : 50528
Source Host           : localhost:3306
Source Database       : onedream

Target Server Type    : MYSQL
Target Server Version : 50528
File Encoding         : 65001

Date: 2014-05-03 23:01:52
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for onedream_action
-- ----------------------------
DROP TABLE IF EXISTS `onedream_action`;
CREATE TABLE `onedream_action` (
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
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8 COMMENT='系统行为表';

-- ----------------------------
-- Records of onedream_action
-- ----------------------------
INSERT INTO `onedream_action` VALUES ('1', 'user_login', '用户登录', '积分+10，每天一次', 'table:member|field:score|condition:uid={$self} AND status>-1|rule:score+10|cycle:24|max:1;', '[user|get_nickname]在[time|time_format]登录了后台', '1', '1', '1387181220');
INSERT INTO `onedream_action` VALUES ('2', 'edit_config', '编辑配置', '编辑配置', '', '', '1', '1', '1397291195');
INSERT INTO `onedream_action` VALUES ('4', 'clear_log', '清空日志', '清空行为日志', '', '', '1', '1', '1397290762');
INSERT INTO `onedream_action` VALUES ('5', 'delete_log', '删除行为日志', '删除行为日志', '', '', '1', '1', '1397290847');
INSERT INTO `onedream_action` VALUES ('6', 'change_log', '改变行为日志', '改变行为日志', '', '', '1', '1', '1397290892');
INSERT INTO `onedream_action` VALUES ('7', 'delete_config', '删除配置', '删除配置', '', '', '1', '1', '1397290985');
INSERT INTO `onedream_action` VALUES ('8', 'add_config', '新增配置', '新增配置', '', '', '1', '1', '1397291222');
INSERT INTO `onedream_action` VALUES ('9', 'update_member', '更新用户信息', '更新用户信息', '', '', '1', '1', '1397291403');
INSERT INTO `onedream_action` VALUES ('10', 'dlete_member', '删除用户', '删除用户', '', '', '1', '1', '1397291509');
INSERT INTO `onedream_action` VALUES ('11', 'add_member', '新增用户', '新增用户', '', '', '1', '1', '1397291556');
INSERT INTO `onedream_action` VALUES ('12', 'add_article', '添加内容', '添加内容', '', '', '1', '1', '1397312659');
INSERT INTO `onedream_action` VALUES ('13', 'delete_article', '删除内容', '删除内容', '', '', '1', '1', '1397312713');
INSERT INTO `onedream_action` VALUES ('14', 'delete_auth', '删除规则', '删除规则', '', '', '1', '1', '1398089890');
INSERT INTO `onedream_action` VALUES ('15', 'add_auth', '添加规则', '添加规则', '', '', '1', '1', '1398089906');
INSERT INTO `onedream_action` VALUES ('16', 'edit_auth', '编辑规则', '编辑规则', '', '', '1', '1', '1398089919');
INSERT INTO `onedream_action` VALUES ('17', 'add_role', '添加角色', '添加角色', '', '', '1', '1', '1398091224');
INSERT INTO `onedream_action` VALUES ('18', 'edit_role', '编辑角色', '编辑角色', '', '', '1', '1', '1398091243');
INSERT INTO `onedream_action` VALUES ('19', 'delete_role', '删除角色', '删除角色', '', '', '1', '1', '1398091256');
INSERT INTO `onedream_action` VALUES ('20', 'user_auth', '用户授权', '用户授权', '', '', '1', '1', '1398177027');
INSERT INTO `onedream_action` VALUES ('21', 'role_auth', '角色授权', '角色授权', '', '', '1', '1', '1398177041');

-- ----------------------------
-- Table structure for onedream_action_log
-- ----------------------------
DROP TABLE IF EXISTS `onedream_action_log`;
CREATE TABLE `onedream_action_log` (
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
) ENGINE=InnoDB AUTO_INCREMENT=112 DEFAULT CHARSET=utf8 COMMENT='行为日志表';

-- ----------------------------
-- Records of onedream_action_log
-- ----------------------------
INSERT INTO `onedream_action_log` VALUES ('1', '1', '1', '0', 'Member', '1', 'CoolHots在2014-04-12 16:14登录了后台', '1', '1397290470');
INSERT INTO `onedream_action_log` VALUES ('3', '1', '1', '0', 'Member', '1', 'CoolHots在2014-04-12 16:14登录了后台', '1', '1397290499');
INSERT INTO `onedream_action_log` VALUES ('4', '6', '1', '0', 'Action', '7', '操作url：/Admin/Action/addAction.shtml', '1', '1397290985');
INSERT INTO `onedream_action_log` VALUES ('5', '2', '1', '0', 'Config', '3', '操作url：/Admin/Config/edit.shtml', '1', '1397291152');
INSERT INTO `onedream_action_log` VALUES ('6', '6', '1', '0', 'Action', '2', '操作url：/Admin/Action/editAction.shtml', '1', '1397291195');
INSERT INTO `onedream_action_log` VALUES ('7', '6', '1', '0', 'Action', '8', '操作url：/Admin/Action/addAction.shtml', '1', '1397291222');
INSERT INTO `onedream_action_log` VALUES ('8', '1', '1', '0', 'Member', '1', 'CoolHots在2014-04-12 16:28登录了后台', '1', '1397291333');
INSERT INTO `onedream_action_log` VALUES ('9', '7', '1', '0', 'Config', '0', '操作url：/Admin/Config/delete/id/3.shtml', '1', '1397291364');
INSERT INTO `onedream_action_log` VALUES ('10', '6', '1', '0', 'Action', '9', '操作url：/Admin/Action/addAction.shtml', '1', '1397291403');
INSERT INTO `onedream_action_log` VALUES ('11', '9', '1', '0', 'Member', '1', '操作url：/Admin/Member/changepassword.shtml', '1', '1397291455');
INSERT INTO `onedream_action_log` VALUES ('12', '6', '1', '0', 'Action', '10', '操作url：/Admin/Action/addAction.shtml', '1', '1397291509');
INSERT INTO `onedream_action_log` VALUES ('13', '6', '1', '0', 'Action', '11', '操作url：/Admin/Action/addAction.shtml', '1', '1397291556');
INSERT INTO `onedream_action_log` VALUES ('14', '9', '1', '0', 'Member', '1', '操作url：/Admin/Member/edit.shtml', '1', '1397291574');
INSERT INTO `onedream_action_log` VALUES ('15', '11', '1', '0', 'Member', '2', '操作url：/Admin/Member/add.shtml', '1', '1397291583');
INSERT INTO `onedream_action_log` VALUES ('16', '10', '1', '0', 'Member', '2', '操作url：/Admin/Member/delete/id/2.shtml', '1', '1397291588');
INSERT INTO `onedream_action_log` VALUES ('17', '2', '1', '0', 'Config', '2', '操作url：/Admin/Config/edit.shtml', '1', '1397291613');
INSERT INTO `onedream_action_log` VALUES ('18', '1', '1', '0', 'Member', '1', 'CoolHots在2014-04-12 21:08登录了后台', '1', '1397308109');
INSERT INTO `onedream_action_log` VALUES ('19', '6', '1', '0', 'Action', '12', '操作url：/Admin/Action/addAction.shtml', '1', '1397312659');
INSERT INTO `onedream_action_log` VALUES ('20', '6', '1', '0', 'Action', '13', '操作url：/Admin/Action/addAction.shtml', '1', '1397312713');
INSERT INTO `onedream_action_log` VALUES ('21', '1', '1', '0', 'Member', '1', 'CoolHots在2014-04-14 11:18登录了后台', '1', '1397445485');
INSERT INTO `onedream_action_log` VALUES ('22', '2', '1', '0', 'Config', '1', '操作url：/Admin/Config/edit.shtml', '1', '1397445493');
INSERT INTO `onedream_action_log` VALUES ('23', '12', '1', '0', 'Article', '1', '操作url：/Admin/Article/add.shtml', '1', '1397447411');
INSERT INTO `onedream_action_log` VALUES ('24', '12', '1', '0', 'Article', '2', '操作url：/Admin/Article/add.shtml', '1', '1397447605');
INSERT INTO `onedream_action_log` VALUES ('25', '2', '1', '0', 'Config', '1', '操作url：/Admin/Config/edit.shtml', '1', '1397447734');
INSERT INTO `onedream_action_log` VALUES ('26', '12', '1', '0', 'Article', '3', '操作url：/Admin/Article/add.shtml', '1', '1397447757');
INSERT INTO `onedream_action_log` VALUES ('27', '12', '1', '0', 'Article', '4', '操作url：/Admin/Article/add.shtml', '1', '1397448213');
INSERT INTO `onedream_action_log` VALUES ('28', '1', '1', '0', 'Member', '1', 'CoolHots在2014-04-14 21:55登录了后台', '1', '1397483744');
INSERT INTO `onedream_action_log` VALUES ('29', '1', '1', '-1419042962', 'Member', '1', 'CoolHots在2014-04-15 15:53登录了后台', '1', '1397548418');
INSERT INTO `onedream_action_log` VALUES ('30', '2', '1', '-1419042962', 'Config', '1', '操作url：/Admin/Config/edit.shtml', '1', '1397549378');
INSERT INTO `onedream_action_log` VALUES ('31', '1', '1', '0', 'Member', '1', 'CoolHots在2014-04-21 13:24登录了后台', '1', '1398057894');
INSERT INTO `onedream_action_log` VALUES ('32', '1', '1', '0', 'Member', '1', 'CoolHots在2014-04-21 14:28登录了后台', '1', '1398061729');
INSERT INTO `onedream_action_log` VALUES ('33', '1', '1', '0', 'Member', '1', 'CoolHots在2014-04-21 14:49登录了后台', '1', '1398062990');
INSERT INTO `onedream_action_log` VALUES ('34', '1', '1', '0', 'Member', '1', 'CoolHots在2014-04-21 14:51登录了后台', '1', '1398063078');
INSERT INTO `onedream_action_log` VALUES ('35', '1', '1', '0', 'Member', '1', 'CoolHots在2014-04-21 14:51登录了后台', '1', '1398063087');
INSERT INTO `onedream_action_log` VALUES ('36', '1', '1', '0', 'Member', '1', 'CoolHots在2014-04-21 14:52登录了后台', '1', '1398063133');
INSERT INTO `onedream_action_log` VALUES ('37', '1', '1', '0', 'Member', '1', 'CoolHots在2014-04-21 14:52登录了后台', '1', '1398063152');
INSERT INTO `onedream_action_log` VALUES ('38', '1', '1', '0', 'Member', '1', 'CoolHots在2014-04-21 14:53登录了后台', '1', '1398063232');
INSERT INTO `onedream_action_log` VALUES ('39', '1', '1', '0', 'Member', '1', 'CoolHots在2014-04-21 14:56登录了后台', '1', '1398063400');
INSERT INTO `onedream_action_log` VALUES ('40', '1', '1', '0', 'Member', '1', 'CoolHots在2014-04-21 14:57登录了后台', '1', '1398063460');
INSERT INTO `onedream_action_log` VALUES ('41', '1', '1', '0', 'Member', '1', 'CoolHots在2014-04-21 14:58登录了后台', '1', '1398063489');
INSERT INTO `onedream_action_log` VALUES ('42', '1', '1', '0', 'Member', '1', 'CoolHots在2014-04-21 15:00登录了后台', '1', '1398063615');
INSERT INTO `onedream_action_log` VALUES ('43', '1', '1', '0', 'Member', '1', 'CoolHots在2014-04-21 15:01登录了后台', '1', '1398063668');
INSERT INTO `onedream_action_log` VALUES ('44', '1', '1', '0', 'Member', '1', 'CoolHots在2014-04-21 15:02登录了后台', '1', '1398063774');
INSERT INTO `onedream_action_log` VALUES ('45', '1', '1', '0', 'Member', '1', 'CoolHots在2014-04-21 15:18登录了后台', '1', '1398064715');
INSERT INTO `onedream_action_log` VALUES ('46', '1', '1', '0', 'Member', '1', 'CoolHots在2014-04-21 15:19登录了后台', '1', '1398064781');
INSERT INTO `onedream_action_log` VALUES ('47', '1', '1', '0', 'Member', '1', 'CoolHots在2014-04-21 15:27登录了后台', '1', '1398065271');
INSERT INTO `onedream_action_log` VALUES ('48', '2', '1', '0', 'Config', '1', '操作url：/Admin/Config/edit.shtml', '1', '1398065299');
INSERT INTO `onedream_action_log` VALUES ('49', '1', '1', '0', 'Member', '1', 'CoolHots在2014-04-21 15:28登录了后台', '1', '1398065320');
INSERT INTO `onedream_action_log` VALUES ('50', '1', '1', '-556259043', 'Member', '1', 'CoolHots在2014-04-21 15:34登录了后台', '1', '1398065670');
INSERT INTO `onedream_action_log` VALUES ('51', '1', '1', '0', 'Member', '1', 'CoolHots在2014-04-21 15:43登录了后台', '1', '1398066223');
INSERT INTO `onedream_action_log` VALUES ('52', '1', '1', '-556259043', 'Member', '1', 'CoolHots在2014-04-21 15:52登录了后台', '1', '1398066777');
INSERT INTO `onedream_action_log` VALUES ('53', '2', '1', '-556259043', 'Config', '1', '操作url：/Admin/Config/edit.shtml', '1', '1398066786');
INSERT INTO `onedream_action_log` VALUES ('54', '2', '1', '-556259043', 'Config', '1', '操作url：/Admin/Config/edit.shtml', '1', '1398066802');
INSERT INTO `onedream_action_log` VALUES ('55', '2', '1', '-556259043', 'Config', '1', '操作url：/Admin/Config/edit.shtml', '1', '1398066823');
INSERT INTO `onedream_action_log` VALUES ('56', '2', '1', '-556259043', 'Config', '1', '操作url：/Admin/Config/edit.shtml', '1', '1398066832');
INSERT INTO `onedream_action_log` VALUES ('57', '2', '1', '-556259043', 'Config', '1', '操作url：/Admin/Config/edit.shtml', '1', '1398066839');
INSERT INTO `onedream_action_log` VALUES ('58', '1', '1', '0', 'Member', '1', 'CoolHots在2014-04-21 19:13登录了后台', '1', '1398078836');
INSERT INTO `onedream_action_log` VALUES ('59', '1', '1', '0', 'Member', '1', 'CoolHots在2014-04-21 22:02登录了后台', '1', '1398088923');
INSERT INTO `onedream_action_log` VALUES ('60', '6', '1', '0', 'Action', '14', '操作url：/Admin/Action/addAction.shtml', '1', '1398089890');
INSERT INTO `onedream_action_log` VALUES ('61', '6', '1', '0', 'Action', '15', '操作url：/Admin/Action/addAction.shtml', '1', '1398089906');
INSERT INTO `onedream_action_log` VALUES ('62', '6', '1', '0', 'Action', '16', '操作url：/Admin/Action/addAction.shtml', '1', '1398089919');
INSERT INTO `onedream_action_log` VALUES ('63', '16', '1', '0', 'Auth', '20', '操作url：/Admin/Auth/edit.shtml', '1', '1398089945');
INSERT INTO `onedream_action_log` VALUES ('64', '16', '1', '0', 'Auth', '4', '操作url：/Admin/Auth/edit.shtml', '1', '1398090292');
INSERT INTO `onedream_action_log` VALUES ('65', '1', '1', '0', 'Member', '1', 'CoolHots在2014-04-21 22:29登录了后台', '1', '1398090590');
INSERT INTO `onedream_action_log` VALUES ('66', '16', '1', '0', 'Auth', '4', '操作url：/Admin/Auth/edit.shtml', '1', '1398090826');
INSERT INTO `onedream_action_log` VALUES ('67', '6', '1', '0', 'Action', '17', '操作url：/Admin/Action/addAction.shtml', '1', '1398091224');
INSERT INTO `onedream_action_log` VALUES ('68', '6', '1', '0', 'Action', '18', '操作url：/Admin/Action/addAction.shtml', '1', '1398091243');
INSERT INTO `onedream_action_log` VALUES ('69', '6', '1', '0', 'Action', '19', '操作url：/Admin/Action/addAction.shtml', '1', '1398091256');
INSERT INTO `onedream_action_log` VALUES ('70', '17', '1', '0', 'Role', '4', '操作url：/Admin/Role/add.shtml', '1', '1398091446');
INSERT INTO `onedream_action_log` VALUES ('71', '18', '1', '0', 'Role', '4', '操作url：/Admin/Role/edit.shtml', '1', '1398091491');
INSERT INTO `onedream_action_log` VALUES ('72', '1', '1', '0', 'Member', '1', 'CoolHots在2014-04-21 22:52登录了后台', '1', '1398091979');
INSERT INTO `onedream_action_log` VALUES ('73', '1', '1', '0', 'Member', '1', 'CoolHots在2014-04-21 23:28登录了后台', '1', '1398094130');
INSERT INTO `onedream_action_log` VALUES ('74', '1', '1', '0', 'Member', '1', 'CoolHots在2014-04-22 21:41登录了后台', '1', '1398174071');
INSERT INTO `onedream_action_log` VALUES ('75', '1', '1', '0', 'Member', '1', 'CoolHots在2014-04-22 22:20登录了后台', '1', '1398176446');
INSERT INTO `onedream_action_log` VALUES ('76', '9', '1', '0', 'Member', '1', '操作url：/Admin/Member/edit.shtml', '1', '1398176960');
INSERT INTO `onedream_action_log` VALUES ('77', '9', '1', '0', 'Member', '1', '操作url：/Admin/Member/edit.shtml', '1', '1398176969');
INSERT INTO `onedream_action_log` VALUES ('78', '6', '1', '0', 'Action', '20', '操作url：/Admin/Action/addAction.shtml', '1', '1398177027');
INSERT INTO `onedream_action_log` VALUES ('79', '6', '1', '0', 'Action', '21', '操作url：/Admin/Action/addAction.shtml', '1', '1398177041');
INSERT INTO `onedream_action_log` VALUES ('80', '21', '1', '0', 'Role', '4', '操作url：/Admin/Role/auth.shtml', '1', '1398177075');
INSERT INTO `onedream_action_log` VALUES ('81', '20', '1', '0', 'Member', '1', '操作url：/Admin/Member/auth.shtml', '1', '1398177082');
INSERT INTO `onedream_action_log` VALUES ('82', '1', '1', '0', 'Member', '1', 'CoolHots在2014-04-23 11:37登录了后台', '1', '1398224254');
INSERT INTO `onedream_action_log` VALUES ('83', '11', '1', '0', 'Member', '2', '操作url：/Admin/Member/add.shtml', '1', '1398224288');
INSERT INTO `onedream_action_log` VALUES ('84', '9', '1', '0', 'Member', '2', '操作url：/Admin/Member/changepassword.shtml', '1', '1398224295');
INSERT INTO `onedream_action_log` VALUES ('85', '1', '2', '0', 'Member', '2', '测试用户在2014-04-23 11:38登录了后台', '1', '1398224311');
INSERT INTO `onedream_action_log` VALUES ('86', '1', '1', '0', 'Member', '1', 'CoolHots在2014-04-23 11:38登录了后台', '1', '1398224325');
INSERT INTO `onedream_action_log` VALUES ('87', '20', '1', '0', 'Member', '2', '操作url：/Admin/Member/auth.shtml', '1', '1398224344');
INSERT INTO `onedream_action_log` VALUES ('88', '1', '1', '0', 'Member', '1', 'CoolHots在2014-04-23 11:39登录了后台', '1', '1398224351');
INSERT INTO `onedream_action_log` VALUES ('89', '1', '2', '0', 'Member', '2', '测试用户在2014-04-23 11:39登录了后台', '1', '1398224363');
INSERT INTO `onedream_action_log` VALUES ('90', '1', '1', '0', 'Member', '1', 'CoolHots在2014-04-23 11:39登录了后台', '1', '1398224383');
INSERT INTO `onedream_action_log` VALUES ('91', '1', '2', '0', 'Member', '2', '测试用户在2014-04-23 11:42登录了后台', '1', '1398224548');
INSERT INTO `onedream_action_log` VALUES ('92', '1', '1', '0', 'Member', '1', 'CoolHots在2014-04-23 11:50登录了后台', '1', '1398225044');
INSERT INTO `onedream_action_log` VALUES ('93', '20', '1', '0', 'Member', '2', '操作url：/Admin/Member/auth.shtml', '1', '1398225054');
INSERT INTO `onedream_action_log` VALUES ('94', '9', '1', '0', 'Member', '2', '操作url：/Admin/Member/edit.shtml', '1', '1398225067');
INSERT INTO `onedream_action_log` VALUES ('95', '1', '2', '0', 'Member', '2', '测试用户在2014-04-23 11:51登录了后台', '1', '1398225082');
INSERT INTO `onedream_action_log` VALUES ('96', '1', '1', '0', 'Member', '1', 'CoolHots在2014-04-23 11:51登录了后台', '1', '1398225099');
INSERT INTO `onedream_action_log` VALUES ('97', '1', '2', '0', 'Member', '2', '测试用户在2014-04-23 11:51登录了后台', '1', '1398225119');
INSERT INTO `onedream_action_log` VALUES ('98', '21', '1', '0', 'Role', '4', '操作url：/Admin/Role/auth.shtml', '1', '1398225149');
INSERT INTO `onedream_action_log` VALUES ('99', '1', '1', '-1265847980', 'Member', '1', 'CoolHots在2014-04-24 02:43登录了后台', '1', '1398278639');
INSERT INTO `onedream_action_log` VALUES ('101', '5', '1', '-1265847980', 'ActionLog', '1', '操作url：/Admin/Action/deletelog/id/100.shtml', '1', '1398307525');
INSERT INTO `onedream_action_log` VALUES ('102', '1', '1', '-1265847980', 'Member', '1', 'CoolHots在2014-04-24 10:54登录了后台', '1', '1398308068');
INSERT INTO `onedream_action_log` VALUES ('103', '1', '1', '-1265847980', 'Member', '1', 'CoolHots在2014-04-24 10:54登录了后台', '1', '1398308090');
INSERT INTO `onedream_action_log` VALUES ('104', '1', '1', '0', 'Member', '1', 'CoolHots在2014-04-24 11:43登录了后台', '1', '1398311006');
INSERT INTO `onedream_action_log` VALUES ('105', '16', '1', '0', 'Auth', '15', '操作url：/Admin/Auth/edit.shtml', '1', '1398311032');
INSERT INTO `onedream_action_log` VALUES ('106', '1', '1', '0', 'Member', '1', 'CoolHots在2014-04-24 20:42登录了后台', '1', '1398343332');
INSERT INTO `onedream_action_log` VALUES ('107', '1', '1', '0', 'Member', '1', 'CoolHots在2014-04-24 21:08登录了后台', '1', '1398344898');
INSERT INTO `onedream_action_log` VALUES ('108', '1', '1', '0', 'Member', '1', 'CoolHots在2014-04-24 23:44登录了后台', '1', '1398354281');
INSERT INTO `onedream_action_log` VALUES ('109', '1', '1', '0', 'Member', '1', 'CoolHots在2014-05-03 21:54登录了后台', '1', '1399125246');
INSERT INTO `onedream_action_log` VALUES ('110', '1', '1', '0', 'Member', '1', 'CoolHots在2014-05-03 22:20登录了后台', '1', '1399126856');
INSERT INTO `onedream_action_log` VALUES ('111', '1', '1', '0', 'Member', '1', 'CoolHots在2014-05-03 22:58登录了后台', '1', '1399129085');

-- ----------------------------
-- Table structure for onedream_addons
-- ----------------------------
DROP TABLE IF EXISTS `onedream_addons`;
CREATE TABLE `onedream_addons` (
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
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COMMENT='插件表';

-- ----------------------------
-- Records of onedream_addons
-- ----------------------------
INSERT INTO `onedream_addons` VALUES ('5', 'Editor', '前台编辑器', '用于增强整站长文本的输入和显示', '1', '{\"editor_type\":\"2\",\"editor_wysiwyg\":\"1\",\"editor_height\":\"300px\",\"editor_resize_type\":\"1\"}', 'thinkphp', '0.1', '1379830910', '0');
INSERT INTO `onedream_addons` VALUES ('6', 'Attachment', '附件', '用于文档模型上传附件', '1', 'null', 'thinkphp', '0.1', '1379842319', '1');
INSERT INTO `onedream_addons` VALUES ('9', 'SocialComment', '通用社交化评论', '集成了各种社交化评论插件，轻松集成到系统中。', '1', '{\"comment_type\":\"1\",\"comment_uid_youyan\":\"\",\"comment_short_name_duoshuo\":\"\",\"comment_data_list_duoshuo\":\"\"}', 'thinkphp', '0.1', '1380273962', '0');
INSERT INTO `onedream_addons` VALUES ('15', 'EditorForAdmin', '后台编辑器', '用于增强整站长文本的输入和显示', '1', '{\"editor_type\":\"2\",\"editor_wysiwyg\":\"1\",\"editor_height\":\"500px\",\"editor_resize_type\":\"1\"}', 'thinkphp', '0.1', '1383126253', '0');
INSERT INTO `onedream_addons` VALUES ('16', 'SiteStat', '站点统计信息', '统计站点的基础信息', '1', '{\"title\":\"\\u7cfb\\u7edf\\u4fe1\\u606f\",\"display\":\"1\"}', 'CoolHots', '0.1', '1399129109', '0');
INSERT INTO `onedream_addons` VALUES ('17', 'SystemInfo', '系统环境信息', '用于显示一些服务器的信息', '1', '{\"title\":\"\\u7cfb\\u7edf\\u4fe1\\u606f\",\"display\":\"1\"}', 'CoolHots', '0.1', '1399129256', '0');
INSERT INTO `onedream_addons` VALUES ('18', 'DevTeam', '开发团队信息', '开发团队成员信息', '1', '{\"title\":\"OneThink\\u5f00\\u53d1\\u56e2\\u961f\",\"display\":\"1\"}', 'CoolHots', '0.1', '1399129258', '0');

-- ----------------------------
-- Table structure for onedream_article
-- ----------------------------
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of onedream_article
-- ----------------------------
INSERT INTO `onedream_article` VALUES ('4', '测试内容', 'test', '博客园', 'CoolHots', '文章', '', '文章测试一下', '测试', '2014-04-14 12:05:00', '0', '0', '4', '1', '1');

-- ----------------------------
-- Table structure for onedream_auth
-- ----------------------------
DROP TABLE IF EXISTS `onedream_auth`;
CREATE TABLE `onedream_auth` (
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
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of onedream_auth
-- ----------------------------
INSERT INTO `onedream_auth` VALUES ('1', '用户', '0', '1', '', '0', '');
INSERT INTO `onedream_auth` VALUES ('2', '用户管理', '1', '0', '', '0', '');
INSERT INTO `onedream_auth` VALUES ('3', '用户信息', '2', '0', 'admin/member/index', '0', '');
INSERT INTO `onedream_auth` VALUES ('4', '角色管理', '2', '0', 'admin/role/index', '0', '');
INSERT INTO `onedream_auth` VALUES ('5', '行为管理', '1', '0', '', '0', '');
INSERT INTO `onedream_auth` VALUES ('6', '用户行为', '5', '0', 'admin/action/index', '0', '');
INSERT INTO `onedream_auth` VALUES ('7', '行为日志', '5', '0', 'admin/action/log', '0', '');
INSERT INTO `onedream_auth` VALUES ('8', '系统', '0', '2', '', '0', '');
INSERT INTO `onedream_auth` VALUES ('9', '系统设置', '8', '0', '', '0', '');
INSERT INTO `onedream_auth` VALUES ('10', '配置管理', '9', '0', 'admin/config/index', '0', '');
INSERT INTO `onedream_auth` VALUES ('11', '菜单管理', '9', '0', 'admin/auth/index', '0', '');
INSERT INTO `onedream_auth` VALUES ('12', '插件', '0', '3', '', '0', '');
INSERT INTO `onedream_auth` VALUES ('13', '拓展', '12', '0', '', '0', '');
INSERT INTO `onedream_auth` VALUES ('14', '插件管理', '13', '0', 'admin/addons/index', '0', '');
INSERT INTO `onedream_auth` VALUES ('15', '钩子管理', '13', '0', 'admin/addons/hooks', '0', '');
INSERT INTO `onedream_auth` VALUES ('16', '编辑用户', '3', '0', 'admin/member/edit', '0', '');
INSERT INTO `onedream_auth` VALUES ('17', '内容', '0', '0', '', '0', '');
INSERT INTO `onedream_auth` VALUES ('18', '内容管理', '17', '0', '', '0', '');
INSERT INTO `onedream_auth` VALUES ('19', '内容列表', '18', '0', 'admin/article/index', '0', '');
INSERT INTO `onedream_auth` VALUES ('20', '栏目列表', '18', '0', 'admin/category/index', '0', '栏目列表');

-- ----------------------------
-- Table structure for onedream_category
-- ----------------------------
DROP TABLE IF EXISTS `onedream_category`;
CREATE TABLE `onedream_category` (
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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of onedream_category
-- ----------------------------
INSERT INTO `onedream_category` VALUES ('4', '博客', 'blog', '0', '0', '', '', '', '1', '0');
INSERT INTO `onedream_category` VALUES ('5', 'ASP.NET', 'donet', '4', '0', '', '', '', '1', '0');

-- ----------------------------
-- Table structure for onedream_config
-- ----------------------------
DROP TABLE IF EXISTS `onedream_config`;
CREATE TABLE `onedream_config` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '配置ID',
  `name` varchar(30) NOT NULL DEFAULT '' COMMENT '配置名称',
  `title` varchar(50) NOT NULL DEFAULT '' COMMENT '配置说明',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '状态',
  `value` text NOT NULL COMMENT '配置值',
  `extra` varchar(255) NOT NULL DEFAULT '' COMMENT '配置值',
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_name` (`name`) USING BTREE,
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='系统配置表';

-- ----------------------------
-- Records of onedream_config
-- ----------------------------
INSERT INTO `onedream_config` VALUES ('1', 'SHOW_PAGE_TRACE', '是否显示页面Trace', '1', '0', '0:关闭\r\n1:开启');
INSERT INTO `onedream_config` VALUES ('2', 'LIST_ROWS', '分页大小', '1', '10', '后台数据列表分页大小，默认为10条数据.');

-- ----------------------------
-- Table structure for onedream_hooks
-- ----------------------------
DROP TABLE IF EXISTS `onedream_hooks`;
CREATE TABLE `onedream_hooks` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `name` varchar(40) NOT NULL DEFAULT '' COMMENT '钩子名称',
  `description` text NOT NULL COMMENT '描述',
  `type` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '类型',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `addons` varchar(255) NOT NULL DEFAULT '' COMMENT '钩子挂载的插件 ''，''分割',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COMMENT='插件钩子表';

-- ----------------------------
-- Records of onedream_hooks
-- ----------------------------
INSERT INTO `onedream_hooks` VALUES ('1', 'pageHeader', '页面header钩子，一般用于加载插件CSS文件和代码', '1', '0', '');
INSERT INTO `onedream_hooks` VALUES ('2', 'pageFooter', '页面footer钩子，一般用于加载插件JS文件和JS代码', '1', '0', 'ReturnTop');
INSERT INTO `onedream_hooks` VALUES ('3', 'documentEditForm', '添加编辑表单的 扩展内容钩子', '1', '0', 'Attachment');
INSERT INTO `onedream_hooks` VALUES ('4', 'documentDetailAfter', '文档末尾显示', '1', '0', 'Attachment,SocialComment');
INSERT INTO `onedream_hooks` VALUES ('5', 'documentDetailBefore', '页面内容前显示用钩子', '1', '0', '');
INSERT INTO `onedream_hooks` VALUES ('6', 'documentSaveComplete', '保存文档数据后的扩展钩子', '2', '0', 'Attachment');
INSERT INTO `onedream_hooks` VALUES ('8', 'adminArticleEdit', '后台内容编辑页编辑器', '1', '1378982734', 'EditorForAdmin');
INSERT INTO `onedream_hooks` VALUES ('13', 'AdminIndex', '首页小格子个性化显示', '1', '1382596073', 'SiteStat,SystemInfo,DevTeam');
INSERT INTO `onedream_hooks` VALUES ('14', 'topicComment', '评论提交方式扩展钩子。', '1', '1380163518', 'Editor');
INSERT INTO `onedream_hooks` VALUES ('16', 'app_begin', '应用开始.', '2', '1398312469', '');

-- ----------------------------
-- Table structure for onedream_member
-- ----------------------------
DROP TABLE IF EXISTS `onedream_member`;
CREATE TABLE `onedream_member` (
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='会员表';

-- ----------------------------
-- Records of onedream_member
-- ----------------------------
INSERT INTO `onedream_member` VALUES ('1', 'admin', '9fdcb1caaff8258f5a454aa95c48faf2', 'ebJ95e', 'CoolHots', '0', '1993-03-10', '', '72', '0', '0', '0', '1399129085', '1', '1', '');
INSERT INTO `onedream_member` VALUES ('2', 'test', 'e4a5a850fa370c03c220d70d2fc49bf5', 'CF1rfQ', '测试用户', '0', '0000-00-00', '', '5', '0', '0', '0', '1398225119', '1', '4', '');

-- ----------------------------
-- Table structure for onedream_role
-- ----------------------------
DROP TABLE IF EXISTS `onedream_role`;
CREATE TABLE `onedream_role` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '角色编号',
  `title` varchar(40) NOT NULL COMMENT '角色名称',
  `description` varchar(250) NOT NULL COMMENT '角色描述',
  `auth` text COMMENT '角色规则',
  `status` tinyint(1) unsigned NOT NULL COMMENT '角色状态',
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `status` (`status`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='系统角色表';

-- ----------------------------
-- Records of onedream_role
-- ----------------------------
INSERT INTO `onedream_role` VALUES ('1', '系统管理员', '系统管理员无需授权便拥有后台的全部管理权限。本角色是系统自带并且不可删除的。', '1,2,3', '1');
INSERT INTO `onedream_role` VALUES ('2', '无权限用户组', '本组不授权。用户属于本组的单独对该用户进行授权', null, '1');
INSERT INTO `onedream_role` VALUES ('3', '普通管理员', '普通管理员拥有绝大部份权限', null, '1');
INSERT INTO `onedream_role` VALUES ('4', '测试角色', '测试角色，权限？想太多了吧！呵呵', '', '1');
