/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 80018
 Source Host           : localhost:3306
 Source Schema         : miichi_laravel

 Target Server Type    : MySQL
 Target Server Version : 80018
 File Encoding         : 65001

 Date: 01/10/2020 14:07:27
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for cache
-- ----------------------------
DROP TABLE IF EXISTS `cache`;
CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int(11) NOT NULL,
  UNIQUE KEY `cache_key_unique` (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of cache
-- ----------------------------
BEGIN;
INSERT INTO `cache` VALUES ('miichisoft_cache356a192b7913b04c54574d18c28d46e6395428ab', 'i:1;', 1599639058);
INSERT INTO `cache` VALUES ('miichisoft_cache356a192b7913b04c54574d18c28d46e6395428ab:timer', 'i:1599639058;', 1599639058);
INSERT INTO `cache` VALUES ('miichisoft_cachespatie.permission.cache', 'O:39:\"Illuminate\\Database\\Eloquent\\Collection\":1:{s:8:\"\0*\0items\";a:4:{i:0;O:35:\"Spatie\\Permission\\Models\\Permission\":27:{s:10:\"\0*\0guarded\";a:1:{i:0;s:2:\"id\";}s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:11:\"permissions\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:13:\"\0*\0attributes\";a:5:{s:2:\"id\";i:1;s:4:\"name\";s:13:\"CreateProfile\";s:10:\"guard_name\";s:3:\"api\";s:10:\"created_at\";N;s:10:\"updated_at\";N;}s:11:\"\0*\0original\";a:5:{s:2:\"id\";i:1;s:4:\"name\";s:13:\"CreateProfile\";s:10:\"guard_name\";s:3:\"api\";s:10:\"created_at\";N;s:10:\"updated_at\";N;}s:10:\"\0*\0changes\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:8:\"\0*\0dates\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:1:{s:5:\"roles\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":1:{s:8:\"\0*\0items\";a:0:{}}}s:10:\"\0*\0touches\";a:0:{}s:10:\"timestamps\";b:1;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:0:{}}i:1;O:35:\"Spatie\\Permission\\Models\\Permission\":27:{s:10:\"\0*\0guarded\";a:1:{i:0;s:2:\"id\";}s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:11:\"permissions\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:13:\"\0*\0attributes\";a:5:{s:2:\"id\";i:2;s:4:\"name\";s:13:\"UpdateProfile\";s:10:\"guard_name\";s:3:\"api\";s:10:\"created_at\";N;s:10:\"updated_at\";N;}s:11:\"\0*\0original\";a:5:{s:2:\"id\";i:2;s:4:\"name\";s:13:\"UpdateProfile\";s:10:\"guard_name\";s:3:\"api\";s:10:\"created_at\";N;s:10:\"updated_at\";N;}s:10:\"\0*\0changes\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:8:\"\0*\0dates\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:1:{s:5:\"roles\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":1:{s:8:\"\0*\0items\";a:1:{i:0;O:29:\"Spatie\\Permission\\Models\\Role\":27:{s:10:\"\0*\0guarded\";a:1:{i:0;s:2:\"id\";}s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:5:\"roles\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:13:\"\0*\0attributes\";a:5:{s:2:\"id\";i:3;s:4:\"name\";s:6:\"Member\";s:10:\"guard_name\";s:3:\"api\";s:10:\"created_at\";N;s:10:\"updated_at\";N;}s:11:\"\0*\0original\";a:7:{s:2:\"id\";i:3;s:4:\"name\";s:6:\"Member\";s:10:\"guard_name\";s:3:\"api\";s:10:\"created_at\";N;s:10:\"updated_at\";N;s:19:\"pivot_permission_id\";i:2;s:13:\"pivot_role_id\";i:3;}s:10:\"\0*\0changes\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:8:\"\0*\0dates\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:1:{s:5:\"pivot\";O:44:\"Illuminate\\Database\\Eloquent\\Relations\\Pivot\":30:{s:12:\"incrementing\";b:0;s:10:\"\0*\0guarded\";a:0:{}s:13:\"\0*\0connection\";N;s:8:\"\0*\0table\";s:20:\"role_has_permissions\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:13:\"\0*\0attributes\";a:2:{s:13:\"permission_id\";i:2;s:7:\"role_id\";i:3;}s:11:\"\0*\0original\";a:2:{s:13:\"permission_id\";i:2;s:7:\"role_id\";i:3;}s:10:\"\0*\0changes\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:8:\"\0*\0dates\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:10:\"timestamps\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:0:{}s:11:\"pivotParent\";O:35:\"Spatie\\Permission\\Models\\Permission\":27:{s:10:\"\0*\0guarded\";a:1:{i:0;s:2:\"id\";}s:13:\"\0*\0connection\";N;s:8:\"\0*\0table\";s:11:\"permissions\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:0;s:18:\"wasRecentlyCreated\";b:0;s:13:\"\0*\0attributes\";a:1:{s:10:\"guard_name\";s:3:\"api\";}s:11:\"\0*\0original\";a:0:{}s:10:\"\0*\0changes\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:8:\"\0*\0dates\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:10:\"timestamps\";b:1;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:0:{}}s:13:\"\0*\0foreignKey\";s:13:\"permission_id\";s:13:\"\0*\0relatedKey\";s:7:\"role_id\";}}s:10:\"\0*\0touches\";a:0:{}s:10:\"timestamps\";b:1;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:0:{}}}}}s:10:\"\0*\0touches\";a:0:{}s:10:\"timestamps\";b:1;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:0:{}}i:2;O:35:\"Spatie\\Permission\\Models\\Permission\":27:{s:10:\"\0*\0guarded\";a:1:{i:0;s:2:\"id\";}s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:11:\"permissions\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:13:\"\0*\0attributes\";a:5:{s:2:\"id\";i:3;s:4:\"name\";s:13:\"DeleteProfile\";s:10:\"guard_name\";s:3:\"api\";s:10:\"created_at\";N;s:10:\"updated_at\";N;}s:11:\"\0*\0original\";a:5:{s:2:\"id\";i:3;s:4:\"name\";s:13:\"DeleteProfile\";s:10:\"guard_name\";s:3:\"api\";s:10:\"created_at\";N;s:10:\"updated_at\";N;}s:10:\"\0*\0changes\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:8:\"\0*\0dates\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:1:{s:5:\"roles\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":1:{s:8:\"\0*\0items\";a:0:{}}}s:10:\"\0*\0touches\";a:0:{}s:10:\"timestamps\";b:1;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:0:{}}i:3;O:35:\"Spatie\\Permission\\Models\\Permission\":27:{s:10:\"\0*\0guarded\";a:1:{i:0;s:2:\"id\";}s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:11:\"permissions\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:13:\"\0*\0attributes\";a:5:{s:2:\"id\";i:4;s:4:\"name\";s:11:\"ViewProfile\";s:10:\"guard_name\";s:3:\"api\";s:10:\"created_at\";N;s:10:\"updated_at\";N;}s:11:\"\0*\0original\";a:5:{s:2:\"id\";i:4;s:4:\"name\";s:11:\"ViewProfile\";s:10:\"guard_name\";s:3:\"api\";s:10:\"created_at\";N;s:10:\"updated_at\";N;}s:10:\"\0*\0changes\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:8:\"\0*\0dates\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:1:{s:5:\"roles\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":1:{s:8:\"\0*\0items\";a:1:{i:0;O:29:\"Spatie\\Permission\\Models\\Role\":27:{s:10:\"\0*\0guarded\";a:1:{i:0;s:2:\"id\";}s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:5:\"roles\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:13:\"\0*\0attributes\";a:5:{s:2:\"id\";i:3;s:4:\"name\";s:6:\"Member\";s:10:\"guard_name\";s:3:\"api\";s:10:\"created_at\";N;s:10:\"updated_at\";N;}s:11:\"\0*\0original\";a:7:{s:2:\"id\";i:3;s:4:\"name\";s:6:\"Member\";s:10:\"guard_name\";s:3:\"api\";s:10:\"created_at\";N;s:10:\"updated_at\";N;s:19:\"pivot_permission_id\";i:4;s:13:\"pivot_role_id\";i:3;}s:10:\"\0*\0changes\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:8:\"\0*\0dates\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:1:{s:5:\"pivot\";O:44:\"Illuminate\\Database\\Eloquent\\Relations\\Pivot\":30:{s:12:\"incrementing\";b:0;s:10:\"\0*\0guarded\";a:0:{}s:13:\"\0*\0connection\";N;s:8:\"\0*\0table\";s:20:\"role_has_permissions\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:13:\"\0*\0attributes\";a:2:{s:13:\"permission_id\";i:4;s:7:\"role_id\";i:3;}s:11:\"\0*\0original\";a:2:{s:13:\"permission_id\";i:4;s:7:\"role_id\";i:3;}s:10:\"\0*\0changes\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:8:\"\0*\0dates\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:10:\"timestamps\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:0:{}s:11:\"pivotParent\";r:148;s:13:\"\0*\0foreignKey\";s:13:\"permission_id\";s:13:\"\0*\0relatedKey\";s:7:\"role_id\";}}s:10:\"\0*\0touches\";a:0:{}s:10:\"timestamps\";b:1;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:0:{}}}}}s:10:\"\0*\0touches\";a:0:{}s:10:\"timestamps\";b:1;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:0:{}}}}', 1599725398);
COMMIT;

-- ----------------------------
-- Table structure for failed_jobs
-- ----------------------------
DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of failed_jobs
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for jobs
-- ----------------------------
DROP TABLE IF EXISTS `jobs`;
CREATE TABLE `jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint(3) unsigned NOT NULL,
  `reserved_at` int(10) unsigned DEFAULT NULL,
  `available_at` int(10) unsigned NOT NULL,
  `created_at` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of jobs
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for m_activities
-- ----------------------------
DROP TABLE IF EXISTS `m_activities`;
CREATE TABLE `m_activities` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Activity Name',
  `order` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'display order',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of m_activities
-- ----------------------------
BEGIN;
INSERT INTO `m_activities` VALUES (1, 'Coding', 2, NULL, NULL, NULL);
INSERT INTO `m_activities` VALUES (2, 'Testing', 1, NULL, NULL, NULL);
COMMIT;

-- ----------------------------
-- Table structure for m_companies
-- ----------------------------
DROP TABLE IF EXISTS `m_companies`;
CREATE TABLE `m_companies` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fax` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `website` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `map_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `media_1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `media_2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `media_3` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of m_companies
-- ----------------------------
BEGIN;
INSERT INTO `m_companies` VALUES (1, 'Runsystem', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
COMMIT;

-- ----------------------------
-- Table structure for m_job_levels
-- ----------------------------
DROP TABLE IF EXISTS `m_job_levels`;
CREATE TABLE `m_job_levels` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Job title',
  `level` int(10) unsigned NOT NULL COMMENT 'Job level',
  `sub` int(10) unsigned NOT NULL COMMENT 'Job sub-level',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of m_job_levels
-- ----------------------------
BEGIN;
INSERT INTO `m_job_levels` VALUES (1, 'CEO', 9, 1, NULL, NULL, NULL);
INSERT INTO `m_job_levels` VALUES (2, 'CTO', 9, 1, NULL, NULL, NULL);
INSERT INTO `m_job_levels` VALUES (3, 'COO', 9, 1, NULL, NULL, NULL);
INSERT INTO `m_job_levels` VALUES (4, 'DM', 8, 1, NULL, NULL, NULL);
INSERT INTO `m_job_levels` VALUES (5, 'SM', 8, 2, NULL, NULL, NULL);
INSERT INTO `m_job_levels` VALUES (6, 'SPM', 5, 3, NULL, NULL, NULL);
INSERT INTO `m_job_levels` VALUES (7, 'PM', 5, 2, NULL, NULL, NULL);
INSERT INTO `m_job_levels` VALUES (8, 'APM', 5, 1, NULL, NULL, NULL);
COMMIT;

-- ----------------------------
-- Table structure for m_skills
-- ----------------------------
DROP TABLE IF EXISTS `m_skills`;
CREATE TABLE `m_skills` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT ' Skill tag name',
  `order` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'Display order',
  `color` varchar(16) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '#ced2d8',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of m_skills
-- ----------------------------
BEGIN;
INSERT INTO `m_skills` VALUES (1, 'PHP', 1, 'danger', NULL, NULL, NULL);
INSERT INTO `m_skills` VALUES (2, 'NodeJS', 2, 'warning', NULL, NULL, NULL);
INSERT INTO `m_skills` VALUES (3, 'Go', 3, 'default', NULL, NULL, NULL);
COMMIT;

-- ----------------------------
-- Table structure for m_universities
-- ----------------------------
DROP TABLE IF EXISTS `m_universities`;
CREATE TABLE `m_universities` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT ' University name',
  `order` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'Display order',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of m_universities
-- ----------------------------
BEGIN;
INSERT INTO `m_universities` VALUES (1, 'Hanoi University of Technology', 1, NULL, NULL, NULL);
INSERT INTO `m_universities` VALUES (2, 'Hanoi National University', 2, NULL, NULL, NULL);
COMMIT;

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of migrations
-- ----------------------------
BEGIN;
INSERT INTO `migrations` VALUES (1, '2014_10_12_000000_create_users_table', 1);
INSERT INTO `migrations` VALUES (2, '2014_10_12_100000_create_password_resets_table', 1);
INSERT INTO `migrations` VALUES (3, '2016_06_01_000001_create_oauth_auth_codes_table', 1);
INSERT INTO `migrations` VALUES (4, '2016_06_01_000002_create_oauth_access_tokens_table', 1);
INSERT INTO `migrations` VALUES (5, '2016_06_01_000003_create_oauth_refresh_tokens_table', 1);
INSERT INTO `migrations` VALUES (6, '2016_06_01_000004_create_oauth_clients_table', 1);
INSERT INTO `migrations` VALUES (7, '2016_06_01_000005_create_oauth_personal_access_clients_table', 1);
INSERT INTO `migrations` VALUES (8, '2019_08_19_000000_create_failed_jobs_table', 1);
INSERT INTO `migrations` VALUES (9, '2020_07_20_091439_create_sessions_table', 2);
INSERT INTO `migrations` VALUES (10, '2020_07_20_091449_create_jobs_table', 2);
INSERT INTO `migrations` VALUES (11, '2020_07_20_091500_create_cache_table', 2);
INSERT INTO `migrations` VALUES (12, '2020_07_21_044708_create_permission_tables', 3);
INSERT INTO `migrations` VALUES (13, '2020_07_22_064447_add_tbl_profiles_table', 4);
INSERT INTO `migrations` VALUES (14, '2020_07_22_092114_alter_add_profile_id_users_table', 5);
INSERT INTO `migrations` VALUES (15, '2020_07_28_042509_alter_add_urls_t_profiles_table', 6);
INSERT INTO `migrations` VALUES (16, '2020_07_28_044501_create_m_skills_table', 7);
INSERT INTO `migrations` VALUES (17, '2020_07_28_045510_create_universities_table', 8);
INSERT INTO `migrations` VALUES (18, '2020_07_28_045935_alter_add_color_to_m_skills_table', 8);
INSERT INTO `migrations` VALUES (19, '2020_07_28_070430_create_skill_history_table', 9);
INSERT INTO `migrations` VALUES (20, '2020_07_28_071753_create_t_educations_table', 9);
INSERT INTO `migrations` VALUES (21, '2020_07_28_072514_create_m_companies_table', 10);
INSERT INTO `migrations` VALUES (22, '2020_07_28_072726_create_t_work_histories_table', 11);
INSERT INTO `migrations` VALUES (23, '2020_07_28_073107_create_job_levels_table', 11);
INSERT INTO `migrations` VALUES (24, '2020_07_28_073107_create_m_job_levels_table', 12);
INSERT INTO `migrations` VALUES (25, '2020_07_28_093602_create_customers_table', 13);
INSERT INTO `migrations` VALUES (26, '2020_07_28_093624_create_projects_table', 13);
INSERT INTO `migrations` VALUES (27, '2020_07_29_011953_create_t_project_efforts_table', 14);
INSERT INTO `migrations` VALUES (28, '2020_07_29_014248_create_activities_table', 14);
INSERT INTO `migrations` VALUES (29, '2020_07_29_014648_create_time_sheets_table', 15);
INSERT INTO `migrations` VALUES (30, '2020_08_04_035025_alter_add_degrees_to_t_educations_table', 16);
INSERT INTO `migrations` VALUES (31, '2020_08_04_065114_alter_add_passport_expired_at_to_t_profiles_table', 17);
INSERT INTO `migrations` VALUES (32, '2020_08_07_014839_alter_add_is_overtime_to_t_time_sheets_table', 18);
COMMIT;

-- ----------------------------
-- Table structure for model_has_permissions
-- ----------------------------
DROP TABLE IF EXISTS `model_has_permissions`;
CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of model_has_permissions
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for model_has_roles
-- ----------------------------
DROP TABLE IF EXISTS `model_has_roles`;
CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of model_has_roles
-- ----------------------------
BEGIN;
INSERT INTO `model_has_roles` VALUES (3, 'App\\User', 1);
COMMIT;

-- ----------------------------
-- Table structure for oauth_access_tokens
-- ----------------------------
DROP TABLE IF EXISTS `oauth_access_tokens`;
CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `client_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_access_tokens_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of oauth_access_tokens
-- ----------------------------
BEGIN;
INSERT INTO `oauth_access_tokens` VALUES ('04a6657a62bb5f76d5838aa53f9c0b5fe70abe21d5b202a3e55f2f904eea0816a64bd0c78992e0cb', 1, '91160930-84c5-4cc9-8b8c-7b23832c4383', NULL, '[]', 1, '2020-08-26 07:03:00', '2020-08-26 07:03:00', '2020-09-10 07:03:00');
INSERT INTO `oauth_access_tokens` VALUES ('0623da8b693d18cbf00f4c6f555389732dfeb9288bdfd32af0c19917f57b46877e275f4d8dbec1bf', 1, '91160930-84c5-4cc9-8b8c-7b23832c4383', NULL, '[]', 0, '2020-08-06 04:33:47', '2020-08-06 04:33:47', '2020-08-21 04:33:47');
INSERT INTO `oauth_access_tokens` VALUES ('2911e902ea374703d7f97532ef8488a010cdc01a773d32a5460e17dc9446e352e22e7fd6d7d3bff4', 1, '91160930-84c5-4cc9-8b8c-7b23832c4383', NULL, '[]', 0, '2020-08-11 04:55:38', '2020-08-11 04:55:38', '2020-08-26 04:55:38');
INSERT INTO `oauth_access_tokens` VALUES ('8f9dc26a33dc2dbc618af5a3ca099c75571e2623a271f6b4984b150bef09e67ce66d4b939378ca86', 1, '91160930-84c5-4cc9-8b8c-7b23832c4383', NULL, '[]', 0, '2020-08-11 04:55:25', '2020-08-11 04:55:25', '2020-08-26 04:55:25');
INSERT INTO `oauth_access_tokens` VALUES ('b41a043ea74c4898c0d4cbfdfc98847e6a665c0e6beecf64744d07f61acea1277acb844e277251bf', 1, '91160930-84c5-4cc9-8b8c-7b23832c4383', NULL, '[]', 0, '2020-07-22 03:57:28', '2020-07-22 03:57:28', '2020-08-06 03:57:28');
INSERT INTO `oauth_access_tokens` VALUES ('de2931799506d44c9c41161273dd7848366ddb51d25ef2fd0fd2d97098ee8f59bdc73047ad636d09', 1, '91160930-84c5-4cc9-8b8c-7b23832c4383', NULL, '[]', 1, '2020-07-22 03:39:19', '2020-07-22 03:39:19', '2020-08-06 03:39:19');
INSERT INTO `oauth_access_tokens` VALUES ('f2b9e76a47456c986be168ac9cd83e61223d17cb3c054cb873734d7e1634a7b9b9b96e841c16de87', 1, '91160930-84c5-4cc9-8b8c-7b23832c4383', NULL, '[]', 0, '2020-08-31 08:36:06', '2020-08-31 08:36:06', '2020-09-15 08:36:06');
INSERT INTO `oauth_access_tokens` VALUES ('f71827a555c83af0ff464d808991d697c7a58088642828bc9155c22fb328b3c1184836a147332580', 1, '91160930-84c5-4cc9-8b8c-7b23832c4383', NULL, '[]', 1, '2020-07-22 02:28:47', '2020-07-22 02:28:47', '2020-08-06 02:28:47');
COMMIT;

-- ----------------------------
-- Table structure for oauth_auth_codes
-- ----------------------------
DROP TABLE IF EXISTS `oauth_auth_codes`;
CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `client_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_auth_codes_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of oauth_auth_codes
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for oauth_clients
-- ----------------------------
DROP TABLE IF EXISTS `oauth_clients`;
CREATE TABLE `oauth_clients` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `redirect` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_clients_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of oauth_clients
-- ----------------------------
BEGIN;
INSERT INTO `oauth_clients` VALUES ('91160930-7c4a-449c-92d3-1d106db8152d', NULL, 'Laravel Personal Access Client', 'UbeZou4vvgoqcw5otkc1DViy5DeixxRSKQq3Pv4O', NULL, 'http://localhost', 1, 0, 0, '2020-07-20 09:44:54', '2020-07-20 09:44:54');
INSERT INTO `oauth_clients` VALUES ('91160930-84c5-4cc9-8b8c-7b23832c4383', NULL, 'Laravel Password Grant Client', 'EU3iaBpAADRvtO3YRVw661vhmZddBxJANVue3ZI6', 'users', 'http://localhost:8080', 0, 1, 0, '2020-07-20 09:44:54', '2020-07-20 09:44:54');
COMMIT;

-- ----------------------------
-- Table structure for oauth_personal_access_clients
-- ----------------------------
DROP TABLE IF EXISTS `oauth_personal_access_clients`;
CREATE TABLE `oauth_personal_access_clients` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `client_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of oauth_personal_access_clients
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for oauth_refresh_tokens
-- ----------------------------
DROP TABLE IF EXISTS `oauth_refresh_tokens`;
CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of oauth_refresh_tokens
-- ----------------------------
BEGIN;
INSERT INTO `oauth_refresh_tokens` VALUES ('03e27ff1ec1f4542b2dacad93135ea6850aca16a4b620eede56c7f64acfeacfd36380ee903dbed86', 'f2b9e76a47456c986be168ac9cd83e61223d17cb3c054cb873734d7e1634a7b9b9b96e841c16de87', 0, '2020-09-30 08:36:06');
INSERT INTO `oauth_refresh_tokens` VALUES ('1eb93f1c9ca4a498cae41048069bb046144cece17c927c098f74f08f5bd33e94b71dc4b6e028d3d2', '2911e902ea374703d7f97532ef8488a010cdc01a773d32a5460e17dc9446e352e22e7fd6d7d3bff4', 0, '2020-09-10 04:55:38');
INSERT INTO `oauth_refresh_tokens` VALUES ('55621881f3e30b57922d98b2a5f85bb2552a6d808ad58f8d0a310dd434e9d18ef88f3a81da816c89', 'de2931799506d44c9c41161273dd7848366ddb51d25ef2fd0fd2d97098ee8f59bdc73047ad636d09', 0, '2020-08-21 03:39:19');
INSERT INTO `oauth_refresh_tokens` VALUES ('72ed6d5b78bc592051f36d29e5a8f544a1635e19d94a3e3d293deae09fcba18aacdcbbb57f501f8e', '0623da8b693d18cbf00f4c6f555389732dfeb9288bdfd32af0c19917f57b46877e275f4d8dbec1bf', 0, '2020-09-05 04:33:47');
INSERT INTO `oauth_refresh_tokens` VALUES ('aee598e19047ad0696d08cc485707e0f5ba9d4f5b47c2325bdc1da74d56bb7feb84a50a93fa31fb6', 'b41a043ea74c4898c0d4cbfdfc98847e6a665c0e6beecf64744d07f61acea1277acb844e277251bf', 0, '2020-08-21 03:57:28');
INSERT INTO `oauth_refresh_tokens` VALUES ('cadd4a6beb4707ac3bb990acfa018db86fec25a3c6f55dcf7a8098882a12910aae4b6cebc820c8d9', '04a6657a62bb5f76d5838aa53f9c0b5fe70abe21d5b202a3e55f2f904eea0816a64bd0c78992e0cb', 0, '2020-09-25 07:03:00');
INSERT INTO `oauth_refresh_tokens` VALUES ('d9cdda26f7c95048cda45e73cc5b0e76125b050e6a02ef4a4e5f8f35985dc0cc0aac7e8c7cf65361', '8f9dc26a33dc2dbc618af5a3ca099c75571e2623a271f6b4984b150bef09e67ce66d4b939378ca86', 0, '2020-09-10 04:55:25');
INSERT INTO `oauth_refresh_tokens` VALUES ('df8fe587415497443ee0c88ec7a4f13fb8a00e6150108b44f36cdd22f85e9a9bdab963ba6c4576e0', 'f71827a555c83af0ff464d808991d697c7a58088642828bc9155c22fb328b3c1184836a147332580', 0, '2020-08-21 02:28:47');
COMMIT;

-- ----------------------------
-- Table structure for password_resets
-- ----------------------------
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of password_resets
-- ----------------------------
BEGIN;
INSERT INTO `password_resets` VALUES ('thanh.pham@miichisoft.com', '$2y$10$XvkVZIYbSKt.fQ0iBj9R0.JL5ecYVnc3Ii0s1X9fpd/ottrqCBCMm', '2020-08-31 08:48:32');
COMMIT;

-- ----------------------------
-- Table structure for permissions
-- ----------------------------
DROP TABLE IF EXISTS `permissions`;
CREATE TABLE `permissions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of permissions
-- ----------------------------
BEGIN;
INSERT INTO `permissions` VALUES (1, 'CreateProfile', 'api', NULL, NULL);
INSERT INTO `permissions` VALUES (2, 'UpdateProfile', 'api', NULL, NULL);
INSERT INTO `permissions` VALUES (3, 'DeleteProfile', 'api', NULL, NULL);
INSERT INTO `permissions` VALUES (4, 'ViewProfile', 'api', NULL, NULL);
COMMIT;

-- ----------------------------
-- Table structure for role_has_permissions
-- ----------------------------
DROP TABLE IF EXISTS `role_has_permissions`;
CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) unsigned NOT NULL,
  `role_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`),
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of role_has_permissions
-- ----------------------------
BEGIN;
INSERT INTO `role_has_permissions` VALUES (2, 3);
INSERT INTO `role_has_permissions` VALUES (4, 3);
COMMIT;

-- ----------------------------
-- Table structure for roles
-- ----------------------------
DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of roles
-- ----------------------------
BEGIN;
INSERT INTO `roles` VALUES (1, 'Admin', 'api', NULL, NULL);
INSERT INTO `roles` VALUES (2, 'Moderator', 'api', NULL, NULL);
INSERT INTO `roles` VALUES (3, 'Member', 'api', NULL, NULL);
INSERT INTO `roles` VALUES (4, 'Guest', 'api', NULL, NULL);
COMMIT;

-- ----------------------------
-- Table structure for sessions
-- ----------------------------
DROP TABLE IF EXISTS `sessions`;
CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL,
  UNIQUE KEY `sessions_id_unique` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of sessions
-- ----------------------------
BEGIN;
INSERT INTO `sessions` VALUES ('4z411DTa7mUrdDt0SPlSsEnYP7navpBHH2OH4ksy', 1, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/84.0.4147.135 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiN21SSFhxdHNuZjQ3Q2I5d09LalZIR1NJekZyeERZSnlHUm9mak9RUyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMCI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==', 1598863045);
INSERT INTO `sessions` VALUES ('E5qfzI5XC9Bd00S0G07C7TyE5Bys3Swmwn9APjlM', NULL, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/84.0.4147.135 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiYUZucGttT21ETXZieUozSzVmOURiZnRjT2dEamxpSUJNSkhPc3RIOCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTQ0OiJodHRwOi8vYXBpLm1paWNoaXNvZnQubmV0OjgwMDAvcGFzc3dvcmQvcmVzZXQvZGY2MzQzNTA0ZGE1NDFiMzA1ZGFiMDY5NmJkOWJhODlkN2VhODRmMDUyZmE0YmZmOWZkZjVmNjZiNzc4MjRiND9lbWFpbD10aGFuaC5waGFtJTQwbWlpY2hpc29mdC5jb20iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1598862818);
INSERT INTO `sessions` VALUES ('wjYqrXNWgI5XH4oG9cmt8O4h6qIsBLbwzAQoywjS', NULL, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/84.0.4147.135 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiaHR0WlZiQ2xoZTlJdzRITTJtU3JLWjdXck9lV0dRb2R1aEZscXBlYSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1598955119);
COMMIT;

-- ----------------------------
-- Table structure for t_customers
-- ----------------------------
DROP TABLE IF EXISTS `t_customers`;
CREATE TABLE `t_customers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fax` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `website` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `map_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customs` json DEFAULT NULL COMMENT 'other field',
  `description` text COLLATE utf8mb4_unicode_ci,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of t_customers
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for t_educations
-- ----------------------------
DROP TABLE IF EXISTS `t_educations`;
CREATE TABLE `t_educations` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `profile_id` bigint(20) unsigned NOT NULL COMMENT 'Profiel ID',
  `university_id` bigint(20) unsigned NOT NULL COMMENT 'school id',
  `degree` enum('HighSchool','Bachelor','Master','PhD','PostDoc') COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'education degree',
  `from` date NOT NULL COMMENT 'Admission year',
  `to` date DEFAULT NULL COMMENT 'Graduation year',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of t_educations
-- ----------------------------
BEGIN;
INSERT INTO `t_educations` VALUES (1, 1, 1, 'HighSchool', '2001-09-01', '2006-09-01', NULL, NULL);
INSERT INTO `t_educations` VALUES (2, 1, 2, 'HighSchool', '2007-09-01', '2010-09-01', NULL, NULL);
COMMIT;

-- ----------------------------
-- Table structure for t_profiles
-- ----------------------------
DROP TABLE IF EXISTS `t_profiles`;
CREATE TABLE `t_profiles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `staff_id` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Staff profile ID',
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Path to Staff avatar',
  `homepage` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `facebook` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `github` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `full_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Staff full name',
  `nationality_id` int(10) unsigned DEFAULT '189' COMMENT 'nationality id',
  `dob` date DEFAULT NULL COMMENT 'Staff Date Of Birth',
  `gender` enum('Male','Female','Others') COLLATE utf8mb4_unicode_ci DEFAULT 'Male' COMMENT 'Staff gender',
  `marital_status_id` enum('Married','Single','Divorced','Widowed','Others') COLLATE utf8mb4_unicode_ci DEFAULT 'Single' COMMENT 'Staff martial status',
  `permanent_address` text COLLATE utf8mb4_unicode_ci COMMENT 'Resident address',
  `temporary_address` text COLLATE utf8mb4_unicode_ci COMMENT 'Temporary residence',
  `official_email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Staff official email',
  `private_email` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Staff private email',
  `home_phone` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Staff home phone',
  `mobile` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Staff mobile',
  `work_phone` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Staff work phone',
  `passport_num` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Passport Number',
  `passport_expired_at` date DEFAULT NULL COMMENT 'passport expired date',
  `nin_num` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'National Identification Number',
  `nin_card_issued_date` date DEFAULT NULL COMMENT 'Identification card issued date',
  `nin_card_issued_place` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Identification card issued place',
  `sin_num` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Social Issuarance Number',
  `secondary_insurance_num` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Secondary Insurance Number',
  `driving_license` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Driving Licence Number',
  `vehicle_number_plate` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'National registered Vehicle Number Plate',
  `vehicle_ticket` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Registered Vehicle ticket number',
  `instance_message_id` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Skype ID',
  `status_id` int(10) unsigned DEFAULT NULL COMMENT 'Staff employment status',
  `current_position_id` int(10) unsigned DEFAULT NULL COMMENT 'Staff current Position',
  `joined_date` date DEFAULT NULL COMMENT 'Staff joined date',
  `termination_date` date DEFAULT NULL COMMENT 'Staff joined date',
  `termination_notes` text COLLATE utf8mb4_unicode_ci COMMENT 'Staff more information',
  `termination_type_id` int(10) unsigned DEFAULT NULL COMMENT 'Terminated reason',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `tbl_profiles_profile_id_unique` (`staff_id`),
  UNIQUE KEY `tbl_profiles_official_email_unique` (`official_email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of t_profiles
-- ----------------------------
BEGIN;
INSERT INTO `t_profiles` VALUES (1, 'MSC00008', 'https://randomuser.me/api/portraits/men/41.jpg', 'https://google.com', NULL, 'https://github.com/thanhpt-25', 'Phạm Tiến Thành', 189, '1983-07-25', 'Male', 'Single', 'Ngoc Lam', 'Viet Hung', 'thanh.pham@miichisoft.com', NULL, '0868186740', '0984348793', NULL, 'B0517678', '2021-07-25', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'thanh.pham', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2020-09-08 10:32:23');
COMMIT;

-- ----------------------------
-- Table structure for t_project_efforts
-- ----------------------------
DROP TABLE IF EXISTS `t_project_efforts`;
CREATE TABLE `t_project_efforts` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `project_id` bigint(20) unsigned NOT NULL,
  `level_id` bigint(20) unsigned NOT NULL,
  `effort` double(8,2) NOT NULL DEFAULT '0.00' COMMENT 'Effort in MD',
  `profile_id` bigint(20) unsigned DEFAULT NULL,
  `status` enum('TBH','TBA','Assigned') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'TBA',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of t_project_efforts
-- ----------------------------
BEGIN;
INSERT INTO `t_project_efforts` VALUES (1, 1, 1, 0.50, 1, 'Assigned', NULL, NULL);
INSERT INTO `t_project_efforts` VALUES (2, 2, 1, 0.50, 1, 'Assigned', NULL, NULL);
INSERT INTO `t_project_efforts` VALUES (3, 3, 1, 0.50, 1, 'Assigned', NULL, NULL);
INSERT INTO `t_project_efforts` VALUES (4, 4, 1, 0.50, 1, 'Assigned', NULL, NULL);
INSERT INTO `t_project_efforts` VALUES (5, 5, 1, 0.50, 1, 'Assigned', NULL, NULL);
COMMIT;

-- ----------------------------
-- Table structure for t_projects
-- ----------------------------
DROP TABLE IF EXISTS `t_projects`;
CREATE TABLE `t_projects` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'project name',
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'project slug',
  `size` int(10) unsigned DEFAULT NULL COMMENT 'Size of Project in MD',
  `duration` int(10) unsigned DEFAULT NULL COMMENT 'Project length',
  `start` date DEFAULT NULL COMMENT 'project start date',
  `end` date DEFAULT NULL COMMENT 'project end date',
  `customer_id` bigint(20) unsigned NOT NULL COMMENT 'Foreign key to t_customers',
  `parent_id` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '0:parent project. other: parent id of this project',
  `type` enum('ODC','FixBid','TimeAndMaterial') COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Contract type',
  `style` enum('WF','Scrum','Kanban') COLLATE utf8mb4_unicode_ci NOT NULL,
  `state` enum('BlackHat','RedHat','GreenHat','Waiting','Started','Finished','Canceled') COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('Red','Amber','Green') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Green',
  `customs` json DEFAULT NULL COMMENT 'other field',
  `version` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1.0.0' COMMENT 'major.minor.batch',
  `is_current` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'current version or not',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of t_projects
-- ----------------------------
BEGIN;
INSERT INTO `t_projects` VALUES (1, 'hacos', 'ads-hacos', 10, 100, '2020-08-01', '2020-09-30', 1, 0, 'ODC', 'Scrum', 'Started', 'Green', NULL, '1.0.0', 0, NULL, NULL);
INSERT INTO `t_projects` VALUES (2, 'farming', 'farming', 10, 100, '2020-08-01', '2020-09-30', 1, 1, 'ODC', 'Scrum', 'Started', 'Green', NULL, '1.0.1', 1, NULL, NULL);
INSERT INTO `t_projects` VALUES (3, 'photoruction', 'photoruction', 10, 100, '2020-08-01', '2020-09-30', 1, 1, 'ODC', 'Scrum', 'Started', 'Green', NULL, '1.0.1', 1, NULL, NULL);
INSERT INTO `t_projects` VALUES (4, 'sport combine', 'sport combine', 10, 100, '2020-08-01', '2020-09-30', 1, 1, 'ODC', 'Scrum', 'Started', 'Green', NULL, '1.0.1', 1, NULL, NULL);
INSERT INTO `t_projects` VALUES (5, '39 house', '39 house', 10, 100, '2020-08-01', '2020-09-30', 1, 1, 'ODC', 'Scrum', 'Started', 'Green', NULL, '1.0.1', 1, NULL, NULL);
COMMIT;

-- ----------------------------
-- Table structure for t_skill_history
-- ----------------------------
DROP TABLE IF EXISTS `t_skill_history`;
CREATE TABLE `t_skill_history` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `profile_id` bigint(20) unsigned NOT NULL COMMENT 'profile id',
  `skill_id` bigint(20) unsigned NOT NULL COMMENT 'skill belong to profile',
  `exp_in_years` double(8,2) unsigned NOT NULL DEFAULT '0.00' COMMENT 'Year of experience',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of t_skill_history
-- ----------------------------
BEGIN;
INSERT INTO `t_skill_history` VALUES (1, 1, 1, 1.50, NULL, NULL);
INSERT INTO `t_skill_history` VALUES (2, 1, 2, 4.50, NULL, NULL);
COMMIT;

-- ----------------------------
-- Table structure for t_time_sheets
-- ----------------------------
DROP TABLE IF EXISTS `t_time_sheets`;
CREATE TABLE `t_time_sheets` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `profile_id` bigint(20) unsigned NOT NULL,
  `activity_id` bigint(20) unsigned NOT NULL,
  `project_id` bigint(20) unsigned NOT NULL,
  `registered_at` date NOT NULL,
  `duration` smallint(6) NOT NULL,
  `is_overtime` tinyint(1) NOT NULL DEFAULT '0',
  `is_leave` tinyint(1) NOT NULL DEFAULT '0',
  `status` enum('New','Approved','Rejected') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'New',
  `approved_by` bigint(20) unsigned DEFAULT NULL COMMENT 'Approved By ProfileID',
  `type` enum('Chargeable','Shadow','Support') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Chargeable',
  `comment` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of t_time_sheets
-- ----------------------------
BEGIN;
INSERT INTO `t_time_sheets` VALUES (1, 1, 1, 1, '2020-08-09', 100, 0, 0, 'Approved', NULL, 'Chargeable', NULL, '2020-08-07 02:54:08', '2020-08-07 07:43:58');
INSERT INTO `t_time_sheets` VALUES (2, 1, 1, 1, '2020-08-09', 100, 0, 0, 'Rejected', NULL, 'Shadow', NULL, '2020-08-07 02:54:08', '2020-08-07 07:43:58');
INSERT INTO `t_time_sheets` VALUES (3, 1, 1, 2, '2020-08-10', 120, 0, 0, 'New', NULL, 'Chargeable', NULL, '2020-08-07 02:54:08', '2020-08-11 09:31:07');
INSERT INTO `t_time_sheets` VALUES (4, 1, 2, 2, '2020-08-12', 150, 0, 0, 'New', NULL, 'Chargeable', NULL, '2020-08-12 08:55:53', '2020-08-12 08:55:53');
INSERT INTO `t_time_sheets` VALUES (5, 1, 2, 2, '2020-08-14', 60, 0, 0, 'New', NULL, 'Chargeable', NULL, '2020-08-12 09:04:43', '2020-08-12 09:04:43');
INSERT INTO `t_time_sheets` VALUES (6, 1, 2, 2, '2020-08-15', 60, 1, 0, 'New', NULL, 'Chargeable', NULL, '2020-08-13 04:38:13', '2020-08-13 04:57:13');
INSERT INTO `t_time_sheets` VALUES (7, 1, 2, 2, '2020-08-13', 60, 0, 1, 'New', NULL, 'Support', '<p>This is a comment. We hope you have a good day my friend. Thank you for help us</p>', '2020-08-13 08:46:14', '2020-08-13 08:46:14');
COMMIT;

-- ----------------------------
-- Table structure for t_work_histories
-- ----------------------------
DROP TABLE IF EXISTS `t_work_histories`;
CREATE TABLE `t_work_histories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `profile_id` bigint(20) unsigned NOT NULL COMMENT 'Profile ID',
  `company_id` bigint(20) unsigned NOT NULL COMMENT 'Company ID',
  `level_id` bigint(20) unsigned NOT NULL COMMENT 'Job Level ID',
  `from` date NOT NULL COMMENT 'Date of Join',
  `to` date DEFAULT NULL COMMENT 'Date of resignation',
  `current_work_here` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Current work here',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of t_work_histories
-- ----------------------------
BEGIN;
INSERT INTO `t_work_histories` VALUES (1, 1, 1, 3, '2011-03-01', '2012-03-01', 0, NULL, NULL);
COMMIT;

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `profile_id` bigint(20) DEFAULT NULL COMMENT 'tbl_profile.id',
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of users
-- ----------------------------
BEGIN;
INSERT INTO `users` VALUES (1, 1, 'Pham Tien Thanh', 'thanh.pham@miichisoft.com', NULL, '$2y$10$eLM/JdN7J9NjD60JeenCP.ZEMaSfGa375DnFPIl58HavYR9WZcqS2', 'duns0SNk8YvWulB8We7BQC48HD18DKy2cD7fGKPVe5RNfwZ6QOug2BrBDJqt', '2020-07-20 09:57:11', '2020-08-31 08:35:22');
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
