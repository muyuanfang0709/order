/*
 Navicat Premium Data Transfer

 Source Server         : 公司数据库
 Source Server Type    : MySQL
 Source Server Version : 50726
 Source Host           : 10.50.50.5:3306
 Source Schema         : order

 Target Server Type    : MySQL
 Target Server Version : 50726
 File Encoding         : 65001

 Date: 18/08/2021 12:07:09
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for access
-- ----------------------------
DROP TABLE IF EXISTS `access`;
CREATE TABLE `access`  (
  `role` int(11) NOT NULL,
  `page` int(11) NOT NULL,
  PRIMARY KEY (`role`, `page`) USING BTREE
) ENGINE = MyISAM CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Fixed;

-- ----------------------------
-- Records of access
-- ----------------------------
INSERT INTO `access` VALUES (1, 100);
INSERT INTO `access` VALUES (1, 200);
INSERT INTO `access` VALUES (1, 300);
INSERT INTO `access` VALUES (1, 400);
INSERT INTO `access` VALUES (1, 500);
INSERT INTO `access` VALUES (1, 600);
INSERT INTO `access` VALUES (1, 700);
INSERT INTO `access` VALUES (1, 1001);
INSERT INTO `access` VALUES (1, 1002);
INSERT INTO `access` VALUES (1, 1003);
INSERT INTO `access` VALUES (1, 1004);
INSERT INTO `access` VALUES (1, 1005);
INSERT INTO `access` VALUES (1, 1006);
INSERT INTO `access` VALUES (1, 1007);
INSERT INTO `access` VALUES (1, 1008);
INSERT INTO `access` VALUES (1, 1009);
INSERT INTO `access` VALUES (1, 1010);
INSERT INTO `access` VALUES (1, 1011);
INSERT INTO `access` VALUES (1, 1012);
INSERT INTO `access` VALUES (1, 2001);
INSERT INTO `access` VALUES (1, 3001);
INSERT INTO `access` VALUES (1, 3002);
INSERT INTO `access` VALUES (1, 4001);
INSERT INTO `access` VALUES (1, 4002);
INSERT INTO `access` VALUES (1, 4003);
INSERT INTO `access` VALUES (1, 4004);
INSERT INTO `access` VALUES (1, 4005);
INSERT INTO `access` VALUES (1, 4006);
INSERT INTO `access` VALUES (1, 4007);
INSERT INTO `access` VALUES (1, 5001);
INSERT INTO `access` VALUES (1, 5002);
INSERT INTO `access` VALUES (1, 5003);
INSERT INTO `access` VALUES (1, 5004);
INSERT INTO `access` VALUES (1, 6001);
INSERT INTO `access` VALUES (1, 6002);
INSERT INTO `access` VALUES (1, 6003);
INSERT INTO `access` VALUES (1, 6004);
INSERT INTO `access` VALUES (1, 7001);
INSERT INTO `access` VALUES (2, 200);
INSERT INTO `access` VALUES (2, 300);
INSERT INTO `access` VALUES (2, 400);
INSERT INTO `access` VALUES (2, 600);
INSERT INTO `access` VALUES (2, 700);
INSERT INTO `access` VALUES (2, 2001);
INSERT INTO `access` VALUES (2, 3001);
INSERT INTO `access` VALUES (2, 3002);
INSERT INTO `access` VALUES (2, 4001);
INSERT INTO `access` VALUES (2, 4002);
INSERT INTO `access` VALUES (2, 4003);
INSERT INTO `access` VALUES (2, 4004);
INSERT INTO `access` VALUES (2, 4005);
INSERT INTO `access` VALUES (2, 4006);
INSERT INTO `access` VALUES (2, 4007);
INSERT INTO `access` VALUES (2, 6001);
INSERT INTO `access` VALUES (2, 6002);
INSERT INTO `access` VALUES (2, 7001);
INSERT INTO `access` VALUES (3, 200);
INSERT INTO `access` VALUES (3, 300);
INSERT INTO `access` VALUES (3, 500);
INSERT INTO `access` VALUES (3, 600);
INSERT INTO `access` VALUES (3, 700);
INSERT INTO `access` VALUES (3, 2001);
INSERT INTO `access` VALUES (3, 3001);
INSERT INTO `access` VALUES (3, 3002);
INSERT INTO `access` VALUES (3, 5001);
INSERT INTO `access` VALUES (3, 5002);
INSERT INTO `access` VALUES (3, 5004);
INSERT INTO `access` VALUES (3, 6001);
INSERT INTO `access` VALUES (3, 6002);
INSERT INTO `access` VALUES (3, 6003);
INSERT INTO `access` VALUES (3, 6004);
INSERT INTO `access` VALUES (3, 7001);
INSERT INTO `access` VALUES (4, 200);
INSERT INTO `access` VALUES (4, 300);
INSERT INTO `access` VALUES (4, 600);
INSERT INTO `access` VALUES (4, 700);
INSERT INTO `access` VALUES (4, 2001);
INSERT INTO `access` VALUES (4, 3001);
INSERT INTO `access` VALUES (4, 3002);
INSERT INTO `access` VALUES (4, 6001);
INSERT INTO `access` VALUES (4, 6002);
INSERT INTO `access` VALUES (4, 7001);

-- ----------------------------
-- Table structure for department
-- ----------------------------
DROP TABLE IF EXISTS `department`;
CREATE TABLE `department`  (
  `dep_id` tinyint(4) NOT NULL,
  `name` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `remark` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`dep_id`) USING BTREE
) ENGINE = MyISAM CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of department
-- ----------------------------
INSERT INTO `department` VALUES (1, '工程部', NULL);
INSERT INTO `department` VALUES (2, '营运部', NULL);
INSERT INTO `department` VALUES (3, '生产部', NULL);
INSERT INTO `department` VALUES (4, '行政部', NULL);
INSERT INTO `department` VALUES (5, '财务部', NULL);

-- ----------------------------
-- Table structure for food
-- ----------------------------
DROP TABLE IF EXISTS `food`;
CREATE TABLE `food`  (
  `food_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `remark` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `create_time` datetime NOT NULL,
  PRIMARY KEY (`food_id`, `name`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 25 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of food
-- ----------------------------
INSERT INTO `food` VALUES (1, '红烧猪蹄', '', '2021-04-26 18:37:49');
INSERT INTO `food` VALUES (2, '五香牛肉', NULL, '2021-04-27 11:01:58');
INSERT INTO `food` VALUES (3, '青椒炒鱿鱼', NULL, '2021-04-27 11:02:39');
INSERT INTO `food` VALUES (4, '肉饼蒸蛋', NULL, '2021-04-27 11:03:00');
INSERT INTO `food` VALUES (5, '青椒毛肚', NULL, '2021-04-27 11:03:22');
INSERT INTO `food` VALUES (7, '红烧排骨', NULL, '2021-04-27 11:03:56');
INSERT INTO `food` VALUES (8, '虾仁炒蛋', NULL, '2021-04-27 11:04:13');
INSERT INTO `food` VALUES (9, '白斩鸡', NULL, '2021-04-27 11:06:00');
INSERT INTO `food` VALUES (10, '小炒黄牛肉', NULL, '2021-04-27 11:07:05');
INSERT INTO `food` VALUES (11, '腊鸡腿炒黄豆', NULL, '2021-04-27 11:07:34');
INSERT INTO `food` VALUES (12, '雪菜小黄鱼', NULL, '2021-04-27 11:08:01');
INSERT INTO `food` VALUES (13, '辣子鸡', NULL, '2021-04-27 11:08:16');
INSERT INTO `food` VALUES (14, '荷兰豆炒腊肠', NULL, '2021-04-27 11:08:38');
INSERT INTO `food` VALUES (15, '炒牛蛙', NULL, '2021-04-27 11:09:00');
INSERT INTO `food` VALUES (16, '油爆虾', NULL, '2021-04-27 11:09:16');
INSERT INTO `food` VALUES (17, '红烧肉', NULL, '2021-04-27 11:09:33');
INSERT INTO `food` VALUES (18, '红烧鸡翅', NULL, '2021-04-27 11:09:49');
INSERT INTO `food` VALUES (19, '爆炒花甲', NULL, '2021-04-27 11:10:11');
INSERT INTO `food` VALUES (20, '炒鸡块', NULL, '2021-04-27 11:10:35');
INSERT INTO `food` VALUES (-1, '出差/请假', NULL, '2021-05-06 10:11:02');
INSERT INTO `food` VALUES (21, '爆炒鸡柳', NULL, '2021-05-06 15:03:01');
INSERT INTO `food` VALUES (22, '香菇炖鸡', NULL, '2021-05-06 15:03:01');
INSERT INTO `food` VALUES (23, '油焖肉丸', NULL, '2021-05-06 15:03:01');

-- ----------------------------
-- Table structure for order
-- ----------------------------
DROP TABLE IF EXISTS `order`;
CREATE TABLE `order`  (
  `order_id` int(11) NOT NULL AUTO_INCREMENT,
  `create_time` datetime NOT NULL,
  `state` tinyint(4) NOT NULL,
  `notice` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`order_id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 5 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of order
-- ----------------------------
INSERT INTO `order` VALUES (1, '2021-04-27 11:29:12', 1, '发布菜单凭证');
INSERT INTO `order` VALUES (2, '2021-05-07 05:44:41', 1, NULL);
INSERT INTO `order` VALUES (3, '2021-05-07 05:53:38', 1, NULL);
INSERT INTO `order` VALUES (4, '2021-05-15 09:50:31', 1, NULL);

-- ----------------------------
-- Table structure for order_info
-- ----------------------------
DROP TABLE IF EXISTS `order_info`;
CREATE TABLE `order_info`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `day` date NOT NULL,
  `week` tinyint(4) NOT NULL,
  `food` varchar(64) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '[1,2,3]',
  `create_time` datetime NOT NULL,
  `create_user` int(11) NOT NULL,
  `state` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 15 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of order_info
-- ----------------------------
INSERT INTO `order_info` VALUES (1, 1, '2021-05-09', 1, '1|2|3', '2021-05-07 17:43:43', 2, 1);
INSERT INTO `order_info` VALUES (2, 1, '2021-05-10', 1, '5|7|8', '2021-05-07 17:43:55', 2, 1);
INSERT INTO `order_info` VALUES (3, 1, '2021-05-11', 1, '10|11|12', '2021-05-07 17:44:08', 2, 1);
INSERT INTO `order_info` VALUES (4, 1, '2021-05-12', 1, '14|15|16', '2021-05-07 17:44:20', 2, 1);
INSERT INTO `order_info` VALUES (5, 2, '2021-05-17', 2, '14|7|19', '2021-05-07 17:44:55', 2, 1);
INSERT INTO `order_info` VALUES (6, 2, '2021-05-28', 2, '22|19|1', '2021-05-07 17:45:04', 2, 1);
INSERT INTO `order_info` VALUES (7, 2, '2021-05-31', 2, '11|22|2', '2021-05-07 17:45:33', 2, 1);
INSERT INTO `order_info` VALUES (8, 2, '2021-05-02', 2, '7|14|21', '2021-05-07 17:45:49', 2, 1);
INSERT INTO `order_info` VALUES (9, 3, '2021-05-15', 3, '7|2|18', '2021-05-07 17:53:53', 2, 1);
INSERT INTO `order_info` VALUES (10, 3, '2021-05-11', 3, '19|14|15', '2021-05-07 17:54:09', 2, 1);
INSERT INTO `order_info` VALUES (11, 3, '2021-05-06', 3, '7|15|16', '2021-05-07 17:54:24', 2, 1);
INSERT INTO `order_info` VALUES (12, 4, '2021-05-16', 4, '1|11|15', '2021-05-15 09:50:42', 1, 1);
INSERT INTO `order_info` VALUES (13, 4, '2021-05-17', 4, '15|14|16', '2021-05-15 09:50:54', 1, 1);
INSERT INTO `order_info` VALUES (14, 4, '2021-05-18', 4, '15|17|18', '2021-05-15 09:51:02', 1, 1);

-- ----------------------------
-- Table structure for page
-- ----------------------------
DROP TABLE IF EXISTS `page`;
CREATE TABLE `page`  (
  `id` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `controller` varchar(128) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `action` varchar(128) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `name` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `tag` varchar(128) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `display` tinyint(4) NULL DEFAULT NULL,
  `ordering` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`, `pid`) USING BTREE
) ENGINE = MyISAM CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of page
-- ----------------------------
INSERT INTO `page` VALUES (100, 0, 'System', NULL, '系统管理', NULL, 1, 0);
INSERT INTO `page` VALUES (1001, 100, 'System', 'AddUser', '添加用户', NULL, 0, 0);
INSERT INTO `page` VALUES (1002, 100, 'System', 'UserList', '用户列表', NULL, 1, 0);
INSERT INTO `page` VALUES (1003, 100, 'System', 'DeleteUser', '删除用户', NULL, 0, 0);
INSERT INTO `page` VALUES (1004, 100, 'System', 'EditorUser', '编辑用户', '', 0, 0);
INSERT INTO `page` VALUES (1005, 100, 'System', 'AddRole', '添加角色', NULL, 0, 0);
INSERT INTO `page` VALUES (1006, 100, 'System', 'RoleList', '角色列表', NULL, 1, 0);
INSERT INTO `page` VALUES (1007, 100, 'System', 'DeleteRole', '删除角色', NULL, 0, 0);
INSERT INTO `page` VALUES (1008, 100, 'System', 'EditRole', '编辑角色', NULL, 0, 0);
INSERT INTO `page` VALUES (200, 0, 'Information', NULL, '用户信息管理', NULL, 1, 0);
INSERT INTO `page` VALUES (2001, 200, 'Information', 'PwdModify', '密码修改', NULL, 1, 0);
INSERT INTO `page` VALUES (300, 0, 'Login', NULL, '登录管理', NULL, 1, 0);
INSERT INTO `page` VALUES (3001, 300, 'Login', 'Login', '用户登录', NULL, 1, 0);
INSERT INTO `page` VALUES (3002, 300, 'Login', 'Logout', '用户登出', NULL, 1, 0);
INSERT INTO `page` VALUES (400, 0, 'Dishes', '', '菜品管理', NULL, 1, 0);
INSERT INTO `page` VALUES (4001, 400, 'Dishes', 'MenuList', '菜品列表', NULL, 1, 0);
INSERT INTO `page` VALUES (4002, 400, 'Dishes', 'DishesNextWeek', '下星期选菜', '', 1, 0);
INSERT INTO `page` VALUES (4003, 400, 'Dishes', 'AddNewDishes', '添加新菜', NULL, 1, 0);
INSERT INTO `page` VALUES (500, 0, 'Maintain', '', '维护管理', NULL, 1, 0);
INSERT INTO `page` VALUES (5001, 500, 'Maintain', 'UserAlerts', '用户提醒', NULL, 1, 0);
INSERT INTO `page` VALUES (5002, 500, 'Maintain', 'DepartStatistics', '部门点餐份数统计', NULL, 1, 0);
INSERT INTO `page` VALUES (7001, 700, 'Iframe', 'Iframe', '框架主页', NULL, 1, 0);
INSERT INTO `page` VALUES (5003, 500, 'Maintain', 'PersonnelHistory', '用户点餐记录', NULL, 1, 0);
INSERT INTO `page` VALUES (600, 0, 'Management', NULL, '点餐管理', NULL, 1, 0);
INSERT INTO `page` VALUES (6001, 600, 'Management', 'UserOrder', '用户点餐', NULL, 1, 0);
INSERT INTO `page` VALUES (6002, 600, 'Management', 'ViewOrder', '查看点餐', NULL, 1, 0);
INSERT INTO `page` VALUES (6003, 600, 'Management', 'EditOrder', '编辑点餐', NULL, 1, 0);
INSERT INTO `page` VALUES (700, 0, 'Iframe', NULL, '框架', NULL, 1, 0);
INSERT INTO `page` VALUES (5004, 500, 'Maintain', 'DepartHistory', '部门点餐历史记录', NULL, 1, 0);
INSERT INTO `page` VALUES (1009, 100, 'System', 'UserJudge', '判断用户名', NULL, 1, 0);
INSERT INTO `page` VALUES (1010, 100, 'System', 'NameJudge', '判断姓名', NULL, 1, 0);
INSERT INTO `page` VALUES (4004, 400, 'Dishes', 'Deletefood', '删除菜品', NULL, 1, 0);
INSERT INTO `page` VALUES (1011, 100, 'System', 'PasswordJudge', '判断密码', NULL, 1, 0);
INSERT INTO `page` VALUES (4005, 400, 'Dishes', 'Deleteorderinfo', '删除菜单信息', NULL, 1, 0);
INSERT INTO `page` VALUES (1012, 100, 'System', 'userModify', '编辑页面', NULL, 1, 0);
INSERT INTO `page` VALUES (4006, 400, 'Dishes', 'addOrder', '添加新的订单号', NULL, 1, 0);
INSERT INTO `page` VALUES (4007, 400, 'Dishes', 'historyOrder', '查看历史记录', NULL, 1, 0);
INSERT INTO `page` VALUES (6004, 600, 'Management', 'assistOrder', '协助多人点餐', NULL, 1, 0);

-- ----------------------------
-- Table structure for result
-- ----------------------------
DROP TABLE IF EXISTS `result`;
CREATE TABLE `result`  (
  `result_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `order_info_id` int(11) NOT NULL,
  `food_id` int(11) NOT NULL,
  `create_time` datetime NOT NULL,
  `state` tinyint(4) NOT NULL,
  PRIMARY KEY (`result_id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 25 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Fixed;

-- ----------------------------
-- Records of result
-- ----------------------------
INSERT INTO `result` VALUES (1, 2, 8, -1, '2021-05-07 05:47:27', 1);
INSERT INTO `result` VALUES (2, 2, 5, 19, '2021-05-07 05:47:27', 1);
INSERT INTO `result` VALUES (3, 2, 6, 22, '2021-05-07 05:47:27', 1);
INSERT INTO `result` VALUES (4, 2, 7, 2, '2021-05-07 05:47:27', 1);
INSERT INTO `result` VALUES (5, 1, 8, 7, '2021-05-07 05:49:02', 1);
INSERT INTO `result` VALUES (6, 1, 5, 7, '2021-05-07 05:49:02', 1);
INSERT INTO `result` VALUES (7, 1, 6, 22, '2021-05-07 05:49:02', 1);
INSERT INTO `result` VALUES (8, 1, 7, 22, '2021-05-07 05:49:02', 1);
INSERT INTO `result` VALUES (9, 4, 8, -1, '2021-05-07 05:49:14', 1);
INSERT INTO `result` VALUES (10, 4, 5, -1, '2021-05-07 05:49:14', 1);
INSERT INTO `result` VALUES (11, 4, 6, -1, '2021-05-07 05:49:14', 1);
INSERT INTO `result` VALUES (12, 4, 7, -1, '2021-05-07 05:49:14', 1);
INSERT INTO `result` VALUES (13, 2, 11, -1, '2021-05-07 05:54:42', 1);
INSERT INTO `result` VALUES (14, 2, 10, 19, '2021-05-07 05:54:42', 1);
INSERT INTO `result` VALUES (15, 2, 9, 18, '2021-05-07 05:54:42', 1);
INSERT INTO `result` VALUES (16, 1, 11, 15, '2021-05-07 06:05:03', 1);
INSERT INTO `result` VALUES (17, 1, 10, 14, '2021-05-07 06:05:03', 1);
INSERT INTO `result` VALUES (18, 1, 9, 7, '2021-05-07 06:05:03', 1);
INSERT INTO `result` VALUES (19, 4, 11, -1, '2021-05-07 06:07:13', 1);
INSERT INTO `result` VALUES (20, 4, 10, -1, '2021-05-07 06:07:13', 1);
INSERT INTO `result` VALUES (21, 4, 9, -1, '2021-05-07 06:07:13', 1);
INSERT INTO `result` VALUES (22, 1, 12, 11, '2021-05-15 09:51:26', 1);
INSERT INTO `result` VALUES (23, 1, 13, 16, '2021-05-15 09:51:26', 1);
INSERT INTO `result` VALUES (24, 1, 14, 18, '2021-05-15 09:51:26', 1);

-- ----------------------------
-- Table structure for role
-- ----------------------------
DROP TABLE IF EXISTS `role`;
CREATE TABLE `role`  (
  `role_id` tinyint(4) NOT NULL,
  `name` varchar(64) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `description` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `remark` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `state` tinyint(4) NOT NULL DEFAULT 0,
  `create_time` datetime NOT NULL,
  PRIMARY KEY (`role_id`) USING BTREE
) ENGINE = MyISAM CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of role
-- ----------------------------
INSERT INTO `role` VALUES (1, '系统管理员', '管理用户和角色。包括全部功能。', NULL, 1, '2021-04-27 09:48:34');
INSERT INTO `role` VALUES (2, '点餐管理员', '负责管理菜单与发布菜品', NULL, 1, '2021-04-27 09:51:18');
INSERT INTO `role` VALUES (3, '点餐维护员', '管理用户点餐信息', NULL, 1, '2021-04-27 09:51:38');
INSERT INTO `role` VALUES (4, '普通用户', '登录、点餐', NULL, 1, '2021-04-27 09:52:37');

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user`  (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `password` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `role_id` int(11) NOT NULL,
  `name` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '系统里显示的名字',
  `dep_id` tinyint(4) NOT NULL,
  `number` varchar(11) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `state` tinyint(4) NOT NULL DEFAULT 0,
  `create_time` datetime NOT NULL,
  PRIMARY KEY (`uid`) USING BTREE,
  UNIQUE INDEX `user`(`user`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 5 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = REDUNDANT;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES (1, '苏', 'e10adc3949ba59abbe56e057f20f883e', 1, '苏白', 1, '123456', 1, '2021-05-05 05:51:13');
INSERT INTO `user` VALUES (2, '汤', 'e10adc3949ba59abbe56e057f20f883e', 1, '汤琪轩', 1, '17354360357', 1, '2021-05-06 01:54:05');
INSERT INTO `user` VALUES (3, '龚', '96e79218965eb72c92a549dd5a330112', 4, '龚磊', 5, '123456', 0, '2021-05-07 09:33:52');
INSERT INTO `user` VALUES (4, '龚公', 'e10adc3949ba59abbe56e057f20f883e', 3, '龔龔龔', 1, '123456', 1, '2021-05-07 05:48:31');

-- ----------------------------
-- Table structure for user_state
-- ----------------------------
DROP TABLE IF EXISTS `user_state`;
CREATE TABLE `user_state`  (
  `state` tinyint(4) NOT NULL,
  `description` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`state`) USING BTREE
) ENGINE = MyISAM CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of user_state
-- ----------------------------
INSERT INTO `user_state` VALUES (1, '正常状态');
INSERT INTO `user_state` VALUES (0, '禁止登陆');

SET FOREIGN_KEY_CHECKS = 1;
