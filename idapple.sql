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

 Date: 05/08/2018 03:22:41 AM
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
  `is_used` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `apples_apple_id_unique` (`apple_id`),
  KEY `apples_user_id_foreign` (`user_id`),
  CONSTRAINT `apples_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
--  Records of `apples`
-- ----------------------------
BEGIN;
INSERT INTO `apples` VALUES ('1', 'hoang', '1', '1', '2018-05-07 18:55:07', '2018-05-07 19:54:32'), ('2', 'ngan', '1', '1', '2018-05-07 18:55:07', '2018-05-07 19:54:40');
COMMIT;

-- ----------------------------
--  Table structure for `credit_cards`
-- ----------------------------
DROP TABLE IF EXISTS `credit_cards`;
CREATE TABLE `credit_cards` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `number` varchar(16) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `is_used` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `apples_apple_id_unique` (`number`),
  KEY `apples_user_id_foreign` (`user_id`),
  CONSTRAINT `credit_cards_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
--  Records of `credit_cards`
-- ----------------------------
BEGIN;
INSERT INTO `credit_cards` VALUES ('3', '42136546164', '1', '1', '2018-05-07 19:26:28', '2018-05-07 19:57:10'), ('4', '123469854313', '1', '0', '2018-05-07 19:26:28', '2018-05-07 19:26:28');
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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
--  Records of `menu_system`
-- ----------------------------
BEGIN;
INSERT INTO `menu_system` VALUES ('1', 'Users', 'icon-list', 'user', '0', '0', '1'), ('2', 'Create User', '', 'user.create', '1', '1', '1'), ('3', 'All User', '', 'user.index', '1', '2', '1'), ('4', 'ID Apple', 'icon-list', 'apple', '0', '0', '1'), ('6', 'Manage All ID', '', 'apple.index', '4', '2', '1'), ('7', 'Insert AppleId Multilines', '', 'apple.insert', '4', '3', '1'), ('8', 'Credit Cards', 'icon-list', 'creditCard', '0', '0', '1'), ('9', 'All Credit cards', '', 'creditCard.index', '8', '1', '1'), ('10', 'Insert Credit Multilines', '', 'creditCard.create', '8', '2', '1'), ('11', 'ID Supports', 'icon-list', 'support', '0', '0', '1'), ('12', 'All ID Support', '', 'support.index', '11', '1', '1');
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
--  Table structure for `supports`
-- ----------------------------
DROP TABLE IF EXISTS `supports`;
CREATE TABLE `supports` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `mail` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
--  Records of `supports`
-- ----------------------------
BEGIN;
INSERT INTO `supports` VALUES ('2', 'test', '2018-05-07 20:19:34', '2018-05-07 20:19:34');
COMMIT;

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

SET FOREIGN_KEY_CHECKS = 1;
