/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 50718
 Source Host           : localhost
 Source Database       : idapple

 Target Server Type    : MySQL
 Target Server Version : 50718
 File Encoding         : utf-8

 Date: 05/11/2018 07:38:31 AM
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `apples`
-- ----------------------------
DROP TABLE IF EXISTS `apples`;
CREATE TABLE `apples` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `apple_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `apples_apple_id_unique` (`apple_id`),
  KEY `apples_user_id_foreign` (`user_id`),
  CONSTRAINT `apples_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
--  Table structure for `credit_cards`
-- ----------------------------
DROP TABLE IF EXISTS `credit_cards`;
CREATE TABLE `credit_cards` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `number` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `apples_apple_id_unique` (`number`),
  KEY `apples_user_id_foreign` (`user_id`),
  CONSTRAINT `credit_cards_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
--  Table structure for `id_seria`
-- ----------------------------
DROP TABLE IF EXISTS `id_seria`;
CREATE TABLE `id_seria` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `seria` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
--  Records of `id_seria`
-- ----------------------------
BEGIN;
INSERT INTO `id_seria` VALUES ('1', 'test', '2018-05-11 00:37:47', '2018-05-11 00:37:47');
COMMIT;

-- ----------------------------
--  Table structure for `menu_system`
-- ----------------------------
DROP TABLE IF EXISTS `menu_system`;
CREATE TABLE `menu_system` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `label` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `route` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_id` int(11) NOT NULL,
  `order` tinyint(4) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
--  Records of `menu_system`
-- ----------------------------
BEGIN;
INSERT INTO `menu_system` VALUES ('1', 'Users', 'icon-list', 'user', '0', '0', '1'), ('2', 'Create User', '', 'user.create', '1', '1', '1'), ('3', 'All User', '', 'user.index', '1', '2', '1'), ('4', 'ID Apple', 'icon-list', 'apple', '0', '0', '1'), ('6', 'Manage All ID', '', 'apple.index', '4', '2', '1'), ('7', 'Insert AppleId Multilines', '', 'apple.insert', '4', '3', '1'), ('8', 'Credit Cards', 'icon-list', 'creditCard', '0', '0', '1'), ('9', 'All Credit cards', '', 'creditCard.index', '8', '1', '1'), ('10', 'Insert Credit Multilines', '', 'creditCard.create', '8', '2', '1'), ('11', 'ID Supports', 'icon-list', 'support', '0', '0', '1'), ('12', 'All ID Support', '', 'support.index', '11', '1', '1'), ('13', 'Ports', 'icon-list', 'port', '0', '0', '1'), ('14', 'All Ports', '', 'port.index', '13', '1', '1'), ('15', 'Manage Seria', 'icon-list', 'seria', '0', '0', '1'), ('16', 'All Seria', '', 'seria.index', '15', '1', '1'), ('17', 'Insert Seria Multiline', '', 'seria.insert', '15', '2', '1'), ('18', 'Manage View Seria', 'icon-list', 'viewSeria', '0', '0', '1'), ('19', 'All View Seria', '', 'viewSeria.index', '18', '1', '1'), ('20', 'Insert View Seria Multiline', '', 'viewSeria.insert', '18', '2', '1'), ('21', 'Manage ID Seria', 'icon-list', 'idSeria', '0', '0', '1'), ('22', 'All ID Seria', '', 'idSeria.index', '21', '1', '1');
COMMIT;

-- ----------------------------
--  Table structure for `migrations`
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
--  Records of `migrations`
-- ----------------------------
BEGIN;
INSERT INTO `migrations` VALUES ('1', '2014_10_12_000000_create_users_table', '1'), ('2', '2014_10_12_100000_create_password_resets_table', '1'), ('3', '2017_08_11_195050_create_youtube_table', '1'), ('4', '2017_08_11_214503_add_channel_logo_to_youtube_table', '1'), ('5', '2017_08_16_045421_create_menu_system_table', '1'), ('6', '2017_08_28_225127_create_apples_table', '1'), ('7', '2017_08_28_230231_create_user_transaction_table', '1');
COMMIT;

-- ----------------------------
--  Table structure for `password_resets`
-- ----------------------------
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_username_index` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
--  Table structure for `ports`
-- ----------------------------
DROP TABLE IF EXISTS `ports`;
CREATE TABLE `ports` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `port` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
--  Records of `ports`
-- ----------------------------
BEGIN;
INSERT INTO `ports` VALUES ('1', '111', '2018-05-10 23:38:32', '2018-05-10 23:38:32'), ('2', '222', '2018-05-10 23:38:32', '2018-05-10 23:38:32'), ('3', '333', '2018-05-10 23:38:32', '2018-05-10 23:38:32'), ('4', '444', '2018-05-10 23:38:32', '2018-05-10 23:38:32');
COMMIT;

-- ----------------------------
--  Table structure for `seria`
-- ----------------------------
DROP TABLE IF EXISTS `seria`;
CREATE TABLE `seria` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `seria` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `apples_apple_id_unique` (`seria`),
  KEY `apples_user_id_foreign` (`user_id`),
  CONSTRAINT `seria_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
--  Records of `seria`
-- ----------------------------
BEGIN;
INSERT INTO `seria` VALUES ('5', 'ddd', '1', '2018-05-11 00:05:29', '2018-05-11 00:05:29'), ('6', 'eeee', '1', '2018-05-11 00:05:29', '2018-05-11 00:05:29');
COMMIT;

-- ----------------------------
--  Table structure for `supports`
-- ----------------------------
DROP TABLE IF EXISTS `supports`;
CREATE TABLE `supports` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `mail` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
--  Table structure for `users`
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_username_unique` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
--  Records of `users`
-- ----------------------------
BEGIN;
INSERT INTO `users` VALUES ('1', 'hung.nguyen', 'admin', '$2y$10$lacT5CE6ghk2hq5X8Ecvv.1Eze.M.Xywh5dcP0YQRP4qAyNozDlAi', null, null, null), ('2', 'demo', 'demo', '$2y$10$JQi8eARui291FiAXeER4TO.j08MMDTKTkgB7sLnpNsdK4kmzdNGtC', null, '2018-05-07 18:17:26', '2018-05-07 18:17:26');
COMMIT;

-- ----------------------------
--  Table structure for `view_seria`
-- ----------------------------
DROP TABLE IF EXISTS `view_seria`;
CREATE TABLE `view_seria` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `seria` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `apples_apple_id_unique` (`seria`),
  KEY `apples_user_id_foreign` (`user_id`),
  CONSTRAINT `view_seria_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
--  Records of `view_seria`
-- ----------------------------
BEGIN;
INSERT INTO `view_seria` VALUES ('4', 'minh', '1', '2018-05-11 00:23:08', '2018-05-11 00:23:08'), ('5', 'vy', '1', '2018-05-11 00:23:08', '2018-05-11 00:23:08');
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
