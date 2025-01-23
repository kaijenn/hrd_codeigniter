/*
 Navicat Premium Dump SQL

 Source Server         : yoga
 Source Server Type    : MySQL
 Source Server Version : 100428 (10.4.28-MariaDB)
 Source Host           : localhost:3306
 Source Schema         : hrd

 Target Server Type    : MySQL
 Target Server Version : 100428 (10.4.28-MariaDB)
 File Encoding         : 65001

 Date: 23/01/2025 22:48:13
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for karyawan
-- ----------------------------
DROP TABLE IF EXISTS `karyawan`;
CREATE TABLE `karyawan`  (
  `id_karyawan` int NOT NULL AUTO_INCREMENT,
  `id_pelamar` int NULL DEFAULT NULL,
  `id_user` int NULL DEFAULT NULL,
  `gaji` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_karyawan`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of karyawan
-- ----------------------------
INSERT INTO `karyawan` VALUES (1, 13, 1, '2000000');
INSERT INTO `karyawan` VALUES (2, 17, 6, '30000000');
INSERT INTO `karyawan` VALUES (3, 19, 11, '20000000');

-- ----------------------------
-- Table structure for level
-- ----------------------------
DROP TABLE IF EXISTS `level`;
CREATE TABLE `level`  (
  `id_level` int NOT NULL AUTO_INCREMENT,
  `level` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_level`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of level
-- ----------------------------
INSERT INTO `level` VALUES (1, 'admin');
INSERT INTO `level` VALUES (2, 'hrd');
INSERT INTO `level` VALUES (3, 'pelamar');
INSERT INTO `level` VALUES (4, 'karyawan');

-- ----------------------------
-- Table structure for lowongan
-- ----------------------------
DROP TABLE IF EXISTS `lowongan`;
CREATE TABLE `lowongan`  (
  `id_lowongan` int NOT NULL AUTO_INCREMENT,
  `nama_lowongan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `deskripsi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `deleted_at` datetime NULL DEFAULT NULL,
  `deleted_by` int NULL DEFAULT NULL,
  `updated_by` int NULL DEFAULT NULL,
  `updated_at` datetime NULL DEFAULT NULL,
  `backup_by` int NULL DEFAULT NULL,
  `backup_at` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id_lowongan`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of lowongan
-- ----------------------------
INSERT INTO `lowongan` VALUES (3, 'Manajemen1', 'bisa bacot', NULL, NULL, 1, '2025-01-23 09:13:04', NULL, NULL);
INSERT INTO `lowongan` VALUES (4, 'Programmer', 'minimal umur 20, b', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `lowongan` VALUES (5, 'satpam', 'Berotot\r\nkekar\r\nganteng', NULL, NULL, 1, '2025-01-23 08:30:56', NULL, NULL);
INSERT INTO `lowongan` VALUES (6, 'Pemusik', 'bisa semua alat musik', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `lowongan` VALUES (7, 'Kurir', 'BISA BAWA SEMUA', NULL, NULL, 1, '2025-01-23 09:41:21', NULL, NULL);

-- ----------------------------
-- Table structure for lowongan_backup
-- ----------------------------
DROP TABLE IF EXISTS `lowongan_backup`;
CREATE TABLE `lowongan_backup`  (
  `id_lowongan` int NOT NULL AUTO_INCREMENT,
  `nama_lowongan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `deskripsi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `backup_by` int NULL DEFAULT NULL,
  `backup_at` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id_lowongan`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of lowongan_backup
-- ----------------------------
INSERT INTO `lowongan_backup` VALUES (3, 'Manajemen1', 'bisa bacot', NULL, NULL);
INSERT INTO `lowongan_backup` VALUES (5, 'satpam', 'Berotot\r\nkekar\r\nganteng', NULL, NULL);
INSERT INTO `lowongan_backup` VALUES (7, 'Kurir', 'BISA BAWA SEMUA', NULL, NULL);

-- ----------------------------
-- Table structure for pelamar
-- ----------------------------
DROP TABLE IF EXISTS `pelamar`;
CREATE TABLE `pelamar`  (
  `id_pelamar` int NOT NULL AUTO_INCREMENT,
  `id_user` int NULL DEFAULT NULL,
  `id_lowongan` int NULL DEFAULT NULL,
  `nama_pelamar` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `umur` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `alamat` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `cv` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `surat` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `status` enum('Pending','Diterima','Ditolak') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_pelamar`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 20 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of pelamar
-- ----------------------------
INSERT INTO `pelamar` VALUES (8, 1, NULL, 'akhirnyaaa', '22', 'sad', NULL, NULL, NULL);
INSERT INTO `pelamar` VALUES (9, 1, 0, 'lupi', '2222', 'Tibana', NULL, NULL, NULL);
INSERT INTO `pelamar` VALUES (10, 1, 0, 'ngantuk bg', '44', 'nagoya', NULL, NULL, NULL);
INSERT INTO `pelamar` VALUES (11, 1, 0, 'ad', '123', 'asdad', NULL, NULL, NULL);
INSERT INTO `pelamar` VALUES (12, 1, 3, 'asdasd', '1231', 'asdasd', NULL, NULL, NULL);
INSERT INTO `pelamar` VALUES (13, 1, 3, 'epan kecap pahit', '17', 'Palazzo', '1737557558_db23b307662d0384bac2.pdf', '1737556323_91e7ce89b82180b9f5d8.pdf', 'Diterima');
INSERT INTO `pelamar` VALUES (14, 1, 5, 'epan kecap jr sdsa', '122', 'palajo ', NULL, NULL, 'Diterima');
INSERT INTO `pelamar` VALUES (15, 1, 5, 'kecap epan manis', '2322', 'Tibanaaa', NULL, NULL, 'Diterima');
INSERT INTO `pelamar` VALUES (16, 2, 3, 'Leonardo Chiki', '17', 'Sandon F 35', '1737636284_e677995e2ffa714c2147.pdf', '1737636284_b7e02f2a24d6d83a88f7.pdf', 'Diterima');
INSERT INTO `pelamar` VALUES (17, 3, 5, 'Testing aja ', '21', 'seruni', '1737645098_4f4855d876d5ee294abe.pdf', '1737645098_c3dcbc007a62fc3d681c.pdf', 'Diterima');
INSERT INTO `pelamar` VALUES (18, 8, 3, 'asd', '213', 'as', '1737646619_9528dde15058068547d3.pdf', '1737646619_fe21cd3567a62ac3372c.pdf', 'Pending');
INSERT INTO `pelamar` VALUES (19, 11, 6, 'boba kecap', '22', 'Tibana', '1737646810_999f537fb2c271ec7ac8.pdf', '1737646810_20db00538b17d7ca5859.pdf', 'Diterima');

-- ----------------------------
-- Table structure for setting
-- ----------------------------
DROP TABLE IF EXISTS `setting`;
CREATE TABLE `setting`  (
  `id_setting` int NOT NULL AUTO_INCREMENT,
  `nama_website` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `logo_website` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `tab_icon` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `login_icon` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `create_by` int NULL DEFAULT NULL,
  `update_by` int NULL DEFAULT NULL,
  `deleted_by` int NULL DEFAULT NULL,
  `create_at` datetime NULL DEFAULT NULL,
  `update_at` datetime NULL DEFAULT NULL,
  `deleted_at` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id_setting`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of setting
-- ----------------------------
INSERT INTO `setting` VALUES (1, 'PT. Matcha Qiong ', '1737646953_480cf99b8447483547a9.png', '1737646953_d633b2bf67af26b8394b.png', '1737646953_066e72f8011393a7ec1a.png', NULL, 1, NULL, NULL, '2025-01-23 09:42:33', NULL);

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user`  (
  `id_user` int NOT NULL AUTO_INCREMENT,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `nohp` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `id_level` int NULL DEFAULT NULL,
  PRIMARY KEY (`id_user`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 13 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES (1, 'admin', 'c4ca4238a0b923820dcc509a6f75849b', 'yogagautama12@gmail.com', NULL, 1);
INSERT INTO `user` VALUES (2, 'Leonardo Chiki', 'c4ca4238a0b923820dcc509a6f75849b', 'zentosph@gmail.com', '6282222222', 2);
INSERT INTO `user` VALUES (8, 'bobi', 'c4ca4238a0b923820dcc509a6f75849b', 'yoga@gmail.com', '089522747300', 3);
INSERT INTO `user` VALUES (11, 'boba', 'c4ca4238a0b923820dcc509a6f75849b', 'kaizenesia@gmail.com', '085157206615', 3);
INSERT INTO `user` VALUES (12, 'mantap123', 'c4ca4238a0b923820dcc509a6f75849b', 'mantap123@gmail.com', '123', 2);

-- ----------------------------
-- Table structure for user_activity
-- ----------------------------
DROP TABLE IF EXISTS `user_activity`;
CREATE TABLE `user_activity`  (
  `id_log` int NOT NULL AUTO_INCREMENT,
  `id_user` int NULL DEFAULT NULL,
  `menu` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `time` datetime NULL DEFAULT NULL,
  `created_at` datetime NULL DEFAULT NULL,
  `updated_at` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id_log`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 874 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of user_activity
-- ----------------------------
INSERT INTO `user_activity` VALUES (686, 1, 'Masuk ke Log Activity', '2025-01-23 08:52:50', NULL, NULL);
INSERT INTO `user_activity` VALUES (687, 1, 'Masuk ke User', '2025-01-23 08:52:51', NULL, NULL);
INSERT INTO `user_activity` VALUES (688, 1, 'Masuk ke Log Activity', '2025-01-23 08:52:52', NULL, NULL);
INSERT INTO `user_activity` VALUES (689, 1, 'Masuk ke Log Activity', '2025-01-23 08:55:28', NULL, NULL);
INSERT INTO `user_activity` VALUES (690, 1, 'Masuk ke Log Activity', '2025-01-23 08:55:49', NULL, NULL);
INSERT INTO `user_activity` VALUES (691, 1, 'Masuk ke Log Activity', '2025-01-23 08:56:07', NULL, NULL);
INSERT INTO `user_activity` VALUES (692, 1, 'Masuk ke Log Activity', '2025-01-23 08:56:08', NULL, NULL);
INSERT INTO `user_activity` VALUES (693, 1, 'Masuk ke Log Activity', '2025-01-23 08:56:10', NULL, NULL);
INSERT INTO `user_activity` VALUES (694, 1, 'Masuk ke Dashboard', '2025-01-23 08:56:11', NULL, NULL);
INSERT INTO `user_activity` VALUES (695, 1, 'Masuk ke Login', '2025-01-23 09:00:03', NULL, NULL);
INSERT INTO `user_activity` VALUES (696, 1, 'Masuk ke Register', '2025-01-23 09:04:36', NULL, NULL);
INSERT INTO `user_activity` VALUES (697, 1, 'Masuk ke Login', '2025-01-23 09:04:51', NULL, NULL);
INSERT INTO `user_activity` VALUES (698, 4, 'Masuk ke Dashboard', '2025-01-23 09:04:56', NULL, NULL);
INSERT INTO `user_activity` VALUES (699, 4, 'Masuk ke Dashboard', '2025-01-23 09:06:38', NULL, NULL);
INSERT INTO `user_activity` VALUES (700, 4, 'Masuk ke Dashboard', '2025-01-23 09:06:39', NULL, NULL);
INSERT INTO `user_activity` VALUES (701, 4, 'Masuk ke Dashboard', '2025-01-23 09:07:02', NULL, NULL);
INSERT INTO `user_activity` VALUES (702, 4, 'Masuk ke Lowongan', '2025-01-23 09:07:03', NULL, NULL);
INSERT INTO `user_activity` VALUES (703, 4, 'Masuk ke Lamaran', '2025-01-23 09:07:04', NULL, NULL);
INSERT INTO `user_activity` VALUES (704, 4, 'Masuk ke Lowongan', '2025-01-23 09:07:05', NULL, NULL);
INSERT INTO `user_activity` VALUES (705, 4, 'Masuk ke Dashboard', '2025-01-23 09:07:07', NULL, NULL);
INSERT INTO `user_activity` VALUES (706, 4, 'Masuk ke Login', '2025-01-23 09:07:10', NULL, NULL);
INSERT INTO `user_activity` VALUES (707, 4, 'Masuk ke Register', '2025-01-23 09:07:54', NULL, NULL);
INSERT INTO `user_activity` VALUES (708, 4, 'Masuk ke Login', '2025-01-23 09:08:07', NULL, NULL);
INSERT INTO `user_activity` VALUES (709, 5, 'Masuk ke Dashboard', '2025-01-23 09:08:13', NULL, NULL);
INSERT INTO `user_activity` VALUES (710, 5, 'Masuk ke Lowongan', '2025-01-23 09:08:19', NULL, NULL);
INSERT INTO `user_activity` VALUES (711, 5, 'Masuk ke Lamaran', '2025-01-23 09:08:20', NULL, NULL);
INSERT INTO `user_activity` VALUES (712, 5, 'Masuk ke Lowongan', '2025-01-23 09:08:20', NULL, NULL);
INSERT INTO `user_activity` VALUES (713, 5, 'Masuk ke Lowongan', '2025-01-23 09:09:44', NULL, NULL);
INSERT INTO `user_activity` VALUES (714, 5, 'Masuk ke Lowongan', '2025-01-23 09:09:44', NULL, NULL);
INSERT INTO `user_activity` VALUES (715, 5, 'Masuk ke Lowongan', '2025-01-23 09:09:45', NULL, NULL);
INSERT INTO `user_activity` VALUES (716, 5, 'Masuk ke Lowongan', '2025-01-23 09:09:45', NULL, NULL);
INSERT INTO `user_activity` VALUES (717, 5, 'Masuk ke Lowongan', '2025-01-23 09:09:45', NULL, NULL);
INSERT INTO `user_activity` VALUES (718, 5, 'Masuk ke Lowongan', '2025-01-23 09:09:45', NULL, NULL);
INSERT INTO `user_activity` VALUES (719, 5, 'Masuk ke Dashboard', '2025-01-23 09:10:05', NULL, NULL);
INSERT INTO `user_activity` VALUES (720, 5, 'Masuk ke Login', '2025-01-23 09:10:07', NULL, NULL);
INSERT INTO `user_activity` VALUES (721, 5, 'Masuk ke Register', '2025-01-23 09:10:40', NULL, NULL);
INSERT INTO `user_activity` VALUES (722, 5, 'Masuk ke Login', '2025-01-23 09:10:48', NULL, NULL);
INSERT INTO `user_activity` VALUES (723, 6, 'Masuk ke Dashboard', '2025-01-23 09:10:55', NULL, NULL);
INSERT INTO `user_activity` VALUES (724, 6, 'Masuk ke Lowongan', '2025-01-23 09:10:58', NULL, NULL);
INSERT INTO `user_activity` VALUES (725, 6, 'Masuk ke Lamaran', '2025-01-23 09:10:59', NULL, NULL);
INSERT INTO `user_activity` VALUES (726, 6, 'Masuk ke Lowongan', '2025-01-23 09:10:59', NULL, NULL);
INSERT INTO `user_activity` VALUES (727, 6, 'Masuk ke Lamaran', '2025-01-23 09:11:38', NULL, NULL);
INSERT INTO `user_activity` VALUES (728, 6, 'Masuk ke Login', '2025-01-23 09:11:48', NULL, NULL);
INSERT INTO `user_activity` VALUES (729, 1, 'Masuk ke Dashboard', '2025-01-23 09:11:54', NULL, NULL);
INSERT INTO `user_activity` VALUES (730, 1, 'Masuk ke Lamaran', '2025-01-23 09:11:56', NULL, NULL);
INSERT INTO `user_activity` VALUES (731, 1, 'Masuk ke Lamaran', '2025-01-23 09:12:08', NULL, NULL);
INSERT INTO `user_activity` VALUES (732, 1, 'Masuk ke Karyawan', '2025-01-23 09:12:31', NULL, NULL);
INSERT INTO `user_activity` VALUES (733, 1, 'Masuk ke Karyawan', '2025-01-23 09:12:41', NULL, NULL);
INSERT INTO `user_activity` VALUES (734, 1, 'Masuk ke Karyawan', '2025-01-23 09:12:50', NULL, NULL);
INSERT INTO `user_activity` VALUES (735, 1, 'Masuk ke Lamaran', '2025-01-23 09:12:53', NULL, NULL);
INSERT INTO `user_activity` VALUES (736, 1, 'Masuk ke Lowongan', '2025-01-23 09:12:55', NULL, NULL);
INSERT INTO `user_activity` VALUES (737, 1, 'Masuk ke Edit Lowongan', '2025-01-23 09:12:58', NULL, NULL);
INSERT INTO `user_activity` VALUES (738, 1, 'Masuk ke Lowongan', '2025-01-23 09:13:04', NULL, NULL);
INSERT INTO `user_activity` VALUES (739, 1, 'Masuk ke Restore Edit Lowongan', '2025-01-23 09:13:07', NULL, NULL);
INSERT INTO `user_activity` VALUES (740, 1, 'Masuk ke Lowongan', '2025-01-23 09:13:10', NULL, NULL);
INSERT INTO `user_activity` VALUES (741, 1, 'Masuk ke Lowongan', '2025-01-23 09:13:15', NULL, NULL);
INSERT INTO `user_activity` VALUES (742, 1, 'Masuk ke Soft Delete', '2025-01-23 09:13:16', NULL, NULL);
INSERT INTO `user_activity` VALUES (743, 1, 'Masuk ke Lowongan', '2025-01-23 09:13:18', NULL, NULL);
INSERT INTO `user_activity` VALUES (744, 1, 'Masuk ke Karyawan', '2025-01-23 09:13:21', NULL, NULL);
INSERT INTO `user_activity` VALUES (745, 1, 'Masuk ke User', '2025-01-23 09:13:24', NULL, NULL);
INSERT INTO `user_activity` VALUES (746, 1, 'Masuk ke Tambah User', '2025-01-23 09:13:25', NULL, NULL);
INSERT INTO `user_activity` VALUES (747, 1, 'Masuk ke User', '2025-01-23 09:13:34', NULL, NULL);
INSERT INTO `user_activity` VALUES (748, 1, 'Masuk ke Edit User', '2025-01-23 09:13:36', NULL, NULL);
INSERT INTO `user_activity` VALUES (749, 1, 'Masuk ke User', '2025-01-23 09:13:43', NULL, NULL);
INSERT INTO `user_activity` VALUES (750, 1, 'Masuk ke User', '2025-01-23 09:13:46', NULL, NULL);
INSERT INTO `user_activity` VALUES (751, 1, 'Masuk ke Log Activity', '2025-01-23 09:13:49', NULL, NULL);
INSERT INTO `user_activity` VALUES (752, 1, 'Masuk ke Lowongan', '2025-01-23 09:14:03', NULL, NULL);
INSERT INTO `user_activity` VALUES (753, 1, 'Masuk ke Tambah Lowongan', '2025-01-23 09:14:05', NULL, NULL);
INSERT INTO `user_activity` VALUES (754, 1, 'Masuk ke Lowongan', '2025-01-23 09:14:18', NULL, NULL);
INSERT INTO `user_activity` VALUES (755, 1, 'Masuk ke Dashboard', '2025-01-23 09:14:21', NULL, NULL);
INSERT INTO `user_activity` VALUES (756, 1, 'Masuk ke Karyawan', '2025-01-23 09:14:25', NULL, NULL);
INSERT INTO `user_activity` VALUES (757, 1, 'Masuk ke User', '2025-01-23 09:14:27', NULL, NULL);
INSERT INTO `user_activity` VALUES (758, 1, 'Masuk ke Karyawan', '2025-01-23 09:14:29', NULL, NULL);
INSERT INTO `user_activity` VALUES (759, 1, 'Masuk ke Setting', '2025-01-23 09:14:30', NULL, NULL);
INSERT INTO `user_activity` VALUES (760, 1, 'Masuk ke Setting', '2025-01-23 09:14:49', NULL, NULL);
INSERT INTO `user_activity` VALUES (761, 1, 'Masuk ke Login', '2025-01-23 09:14:52', NULL, NULL);
INSERT INTO `user_activity` VALUES (762, 1, 'Masuk ke Login', '2025-01-23 09:16:41', NULL, NULL);
INSERT INTO `user_activity` VALUES (763, 1, 'Masuk ke Dashboard', '2025-01-23 09:16:47', NULL, NULL);
INSERT INTO `user_activity` VALUES (764, 1, 'Masuk ke Dashboard', '2025-01-23 09:17:59', NULL, NULL);
INSERT INTO `user_activity` VALUES (765, NULL, 'Masuk ke Login', '2025-01-23 09:18:01', NULL, NULL);
INSERT INTO `user_activity` VALUES (766, 1, 'Masuk ke Dashboard', '2025-01-23 09:18:05', NULL, NULL);
INSERT INTO `user_activity` VALUES (767, NULL, 'Masuk ke Login', '2025-01-23 09:18:24', NULL, NULL);
INSERT INTO `user_activity` VALUES (768, NULL, 'Masuk ke Register', '2025-01-23 09:19:19', NULL, NULL);
INSERT INTO `user_activity` VALUES (769, NULL, 'Masuk ke Login', '2025-01-23 09:19:31', NULL, NULL);
INSERT INTO `user_activity` VALUES (770, NULL, 'Masuk ke Login', '2025-01-23 09:19:36', NULL, NULL);
INSERT INTO `user_activity` VALUES (771, NULL, 'Masuk ke Login', '2025-01-23 09:19:42', NULL, NULL);
INSERT INTO `user_activity` VALUES (772, NULL, 'Masuk ke Login', '2025-01-23 09:19:46', NULL, NULL);
INSERT INTO `user_activity` VALUES (773, NULL, 'Masuk ke Register', '2025-01-23 09:20:07', NULL, NULL);
INSERT INTO `user_activity` VALUES (774, NULL, 'Masuk ke Login', '2025-01-23 09:20:12', NULL, NULL);
INSERT INTO `user_activity` VALUES (775, NULL, 'Masuk ke Register', '2025-01-23 09:20:29', NULL, NULL);
INSERT INTO `user_activity` VALUES (776, NULL, 'Masuk ke Login', '2025-01-23 09:20:36', NULL, NULL);
INSERT INTO `user_activity` VALUES (777, 1, 'Masuk ke Dashboard', '2025-01-23 09:20:48', NULL, NULL);
INSERT INTO `user_activity` VALUES (778, NULL, 'Masuk ke Login', '2025-01-23 09:20:49', NULL, NULL);
INSERT INTO `user_activity` VALUES (779, NULL, 'Masuk ke Register', '2025-01-23 09:20:50', NULL, NULL);
INSERT INTO `user_activity` VALUES (780, NULL, 'Masuk ke Login', '2025-01-23 09:21:09', NULL, NULL);
INSERT INTO `user_activity` VALUES (781, NULL, 'Masuk ke Register', '2025-01-23 09:21:10', NULL, NULL);
INSERT INTO `user_activity` VALUES (782, NULL, 'Masuk ke Login', '2025-01-23 09:21:23', NULL, NULL);
INSERT INTO `user_activity` VALUES (783, NULL, 'Masuk ke Login', '2025-01-23 09:22:01', NULL, NULL);
INSERT INTO `user_activity` VALUES (784, NULL, 'Masuk ke Register', '2025-01-23 09:22:05', NULL, NULL);
INSERT INTO `user_activity` VALUES (785, NULL, 'Masuk ke Login', '2025-01-23 09:22:13', NULL, NULL);
INSERT INTO `user_activity` VALUES (786, NULL, 'Masuk ke Login', '2025-01-23 09:22:18', NULL, NULL);
INSERT INTO `user_activity` VALUES (787, 1, 'Masuk ke Dashboard', '2025-01-23 09:24:41', NULL, NULL);
INSERT INTO `user_activity` VALUES (788, 1, 'Masuk ke Karyawan', '2025-01-23 09:24:43', NULL, NULL);
INSERT INTO `user_activity` VALUES (789, 1, 'Masuk ke User', '2025-01-23 09:24:43', NULL, NULL);
INSERT INTO `user_activity` VALUES (790, 1, 'Masuk ke Tambah User', '2025-01-23 09:24:44', NULL, NULL);
INSERT INTO `user_activity` VALUES (791, 1, 'Masuk ke User', '2025-01-23 09:24:49', NULL, NULL);
INSERT INTO `user_activity` VALUES (792, NULL, 'Masuk ke Login', '2025-01-23 09:24:56', NULL, NULL);
INSERT INTO `user_activity` VALUES (793, NULL, 'Masuk ke Register', '2025-01-23 09:24:57', NULL, NULL);
INSERT INTO `user_activity` VALUES (794, NULL, 'Masuk ke Login', '2025-01-23 09:25:06', NULL, NULL);
INSERT INTO `user_activity` VALUES (795, NULL, 'Masuk ke Login', '2025-01-23 09:26:40', NULL, NULL);
INSERT INTO `user_activity` VALUES (796, NULL, 'Masuk ke Register', '2025-01-23 09:26:46', NULL, NULL);
INSERT INTO `user_activity` VALUES (797, NULL, 'Masuk ke Login', '2025-01-23 09:26:55', NULL, NULL);
INSERT INTO `user_activity` VALUES (798, NULL, 'Masuk ke Register', '2025-01-23 09:29:54', NULL, NULL);
INSERT INTO `user_activity` VALUES (799, NULL, 'Masuk ke Login', '2025-01-23 09:30:02', NULL, NULL);
INSERT INTO `user_activity` VALUES (800, NULL, 'Masuk ke Login', '2025-01-23 09:30:43', NULL, NULL);
INSERT INTO `user_activity` VALUES (801, NULL, 'Masuk ke Register', '2025-01-23 09:30:44', NULL, NULL);
INSERT INTO `user_activity` VALUES (802, NULL, 'Masuk ke Login', '2025-01-23 09:30:50', NULL, NULL);
INSERT INTO `user_activity` VALUES (803, 8, 'Masuk ke Dashboard', '2025-01-23 09:33:21', NULL, NULL);
INSERT INTO `user_activity` VALUES (804, 8, 'Masuk ke Lowongan', '2025-01-23 09:33:25', NULL, NULL);
INSERT INTO `user_activity` VALUES (805, 8, 'Masuk ke Lamaran', '2025-01-23 09:33:27', NULL, NULL);
INSERT INTO `user_activity` VALUES (806, 8, 'Masuk ke Lamaran', '2025-01-23 09:33:34', NULL, NULL);
INSERT INTO `user_activity` VALUES (807, 8, 'Masuk ke Lamaran', '2025-01-23 09:33:39', NULL, NULL);
INSERT INTO `user_activity` VALUES (808, 8, 'Masuk ke Lamaran', '2025-01-23 09:36:04', NULL, NULL);
INSERT INTO `user_activity` VALUES (809, 8, 'Masuk ke Lamaran', '2025-01-23 09:36:05', NULL, NULL);
INSERT INTO `user_activity` VALUES (810, 8, 'Masuk ke Lamaran', '2025-01-23 09:36:13', NULL, NULL);
INSERT INTO `user_activity` VALUES (811, 8, 'Masuk ke Lamaran', '2025-01-23 09:36:14', NULL, NULL);
INSERT INTO `user_activity` VALUES (812, 8, 'Masuk ke Lamaran', '2025-01-23 09:36:15', NULL, NULL);
INSERT INTO `user_activity` VALUES (813, 8, 'Masuk ke Lamaran', '2025-01-23 09:36:15', NULL, NULL);
INSERT INTO `user_activity` VALUES (814, NULL, 'Masuk ke Login', '2025-01-23 09:36:17', NULL, NULL);
INSERT INTO `user_activity` VALUES (815, 8, 'Masuk ke Dashboard', '2025-01-23 09:36:26', NULL, NULL);
INSERT INTO `user_activity` VALUES (816, 8, 'Masuk ke Lamaran', '2025-01-23 09:36:28', NULL, NULL);
INSERT INTO `user_activity` VALUES (817, 8, 'Masuk ke Lowongan', '2025-01-23 09:36:29', NULL, NULL);
INSERT INTO `user_activity` VALUES (818, 8, 'Masuk ke Lamaran', '2025-01-23 09:36:30', NULL, NULL);
INSERT INTO `user_activity` VALUES (819, 8, 'Masuk ke Lamaran', '2025-01-23 09:36:40', NULL, NULL);
INSERT INTO `user_activity` VALUES (820, 8, 'Masuk ke Lamaran', '2025-01-23 09:36:41', NULL, NULL);
INSERT INTO `user_activity` VALUES (821, 8, 'Masuk ke Lamaran', '2025-01-23 09:36:42', NULL, NULL);
INSERT INTO `user_activity` VALUES (822, 8, 'Masuk ke Dashboard', '2025-01-23 09:36:48', NULL, NULL);
INSERT INTO `user_activity` VALUES (823, 8, 'Masuk ke Lowongan', '2025-01-23 09:36:50', NULL, NULL);
INSERT INTO `user_activity` VALUES (824, 8, 'Masuk ke Lamaran', '2025-01-23 09:36:59', NULL, NULL);
INSERT INTO `user_activity` VALUES (825, 8, 'Masuk ke Dashboard', '2025-01-23 09:37:02', NULL, NULL);
INSERT INTO `user_activity` VALUES (826, NULL, 'Masuk ke Login', '2025-01-23 09:37:03', NULL, NULL);
INSERT INTO `user_activity` VALUES (827, NULL, 'Masuk ke Register', '2025-01-23 09:37:58', NULL, NULL);
INSERT INTO `user_activity` VALUES (828, NULL, 'Masuk ke Login', '2025-01-23 09:38:07', NULL, NULL);
INSERT INTO `user_activity` VALUES (829, 10, 'Masuk ke Dashboard', '2025-01-23 09:38:12', NULL, NULL);
INSERT INTO `user_activity` VALUES (830, 10, 'Masuk ke Lowongan', '2025-01-23 09:38:14', NULL, NULL);
INSERT INTO `user_activity` VALUES (831, 10, 'Masuk ke Lowongan', '2025-01-23 09:38:53', NULL, NULL);
INSERT INTO `user_activity` VALUES (832, 10, 'Masuk ke Dashboard', '2025-01-23 09:38:57', NULL, NULL);
INSERT INTO `user_activity` VALUES (833, NULL, 'Masuk ke Login', '2025-01-23 09:39:21', NULL, NULL);
INSERT INTO `user_activity` VALUES (834, NULL, 'Masuk ke Register', '2025-01-23 09:39:33', NULL, NULL);
INSERT INTO `user_activity` VALUES (835, NULL, 'Masuk ke Login', '2025-01-23 09:39:42', NULL, NULL);
INSERT INTO `user_activity` VALUES (836, 11, 'Masuk ke Dashboard', '2025-01-23 09:39:46', NULL, NULL);
INSERT INTO `user_activity` VALUES (837, 11, 'Masuk ke Lowongan', '2025-01-23 09:39:47', NULL, NULL);
INSERT INTO `user_activity` VALUES (838, 11, 'Masuk ke Lamaran', '2025-01-23 09:39:49', NULL, NULL);
INSERT INTO `user_activity` VALUES (839, 11, 'Masuk ke Lowongan', '2025-01-23 09:39:51', NULL, NULL);
INSERT INTO `user_activity` VALUES (840, 11, 'Masuk ke Lamaran', '2025-01-23 09:40:10', NULL, NULL);
INSERT INTO `user_activity` VALUES (841, NULL, 'Masuk ke Login', '2025-01-23 09:40:19', NULL, NULL);
INSERT INTO `user_activity` VALUES (842, 1, 'Masuk ke Dashboard', '2025-01-23 09:40:25', NULL, NULL);
INSERT INTO `user_activity` VALUES (843, 1, 'Masuk ke Lamaran', '2025-01-23 09:40:27', NULL, NULL);
INSERT INTO `user_activity` VALUES (844, 1, 'Masuk ke Lamaran', '2025-01-23 09:40:44', NULL, NULL);
INSERT INTO `user_activity` VALUES (845, 1, 'Masuk ke Lowongan', '2025-01-23 09:40:55', NULL, NULL);
INSERT INTO `user_activity` VALUES (846, 1, 'Masuk ke Tambah Lowongan', '2025-01-23 09:40:58', NULL, NULL);
INSERT INTO `user_activity` VALUES (847, 1, 'Masuk ke Lowongan', '2025-01-23 09:41:08', NULL, NULL);
INSERT INTO `user_activity` VALUES (848, 1, 'Masuk ke Edit Lowongan', '2025-01-23 09:41:12', NULL, NULL);
INSERT INTO `user_activity` VALUES (849, 1, 'Masuk ke Lowongan', '2025-01-23 09:41:21', NULL, NULL);
INSERT INTO `user_activity` VALUES (850, 1, 'Masuk ke Restore Edit Lowongan', '2025-01-23 09:41:25', NULL, NULL);
INSERT INTO `user_activity` VALUES (851, 1, 'Masuk ke Lowongan', '2025-01-23 09:41:27', NULL, NULL);
INSERT INTO `user_activity` VALUES (852, 1, 'Masuk ke Lowongan', '2025-01-23 09:41:30', NULL, NULL);
INSERT INTO `user_activity` VALUES (853, 1, 'Masuk ke Soft Delete', '2025-01-23 09:41:31', NULL, NULL);
INSERT INTO `user_activity` VALUES (854, 1, 'Masuk ke Lowongan', '2025-01-23 09:41:32', NULL, NULL);
INSERT INTO `user_activity` VALUES (855, 1, 'Masuk ke Karyawan', '2025-01-23 09:41:34', NULL, NULL);
INSERT INTO `user_activity` VALUES (856, 1, 'Masuk ke Karyawan', '2025-01-23 09:41:45', NULL, NULL);
INSERT INTO `user_activity` VALUES (857, 1, 'Masuk ke User', '2025-01-23 09:41:48', NULL, NULL);
INSERT INTO `user_activity` VALUES (858, 1, 'Masuk ke Tambah User', '2025-01-23 09:41:51', NULL, NULL);
INSERT INTO `user_activity` VALUES (859, 1, 'Masuk ke User', '2025-01-23 09:42:05', NULL, NULL);
INSERT INTO `user_activity` VALUES (860, 1, 'Masuk ke Edit User', '2025-01-23 09:42:07', NULL, NULL);
INSERT INTO `user_activity` VALUES (861, 1, 'Masuk ke User', '2025-01-23 09:42:13', NULL, NULL);
INSERT INTO `user_activity` VALUES (862, 1, 'Masuk ke Setting', '2025-01-23 09:42:16', NULL, NULL);
INSERT INTO `user_activity` VALUES (863, 1, 'Masuk ke Setting', '2025-01-23 09:42:33', NULL, NULL);
INSERT INTO `user_activity` VALUES (864, 1, 'Masuk ke Log Activity', '2025-01-23 09:42:35', NULL, NULL);
INSERT INTO `user_activity` VALUES (865, 1, 'Masuk ke Lamaran', '2025-01-23 09:42:54', NULL, NULL);
INSERT INTO `user_activity` VALUES (866, 1, 'Masuk ke Lowongan', '2025-01-23 09:42:54', NULL, NULL);
INSERT INTO `user_activity` VALUES (867, 1, 'Masuk ke Lamaran', '2025-01-23 09:42:58', NULL, NULL);
INSERT INTO `user_activity` VALUES (868, 1, 'Masuk ke Karyawan', '2025-01-23 09:43:03', NULL, NULL);
INSERT INTO `user_activity` VALUES (869, 1, 'Masuk ke User', '2025-01-23 09:43:05', NULL, NULL);
INSERT INTO `user_activity` VALUES (870, 1, 'Masuk ke Setting', '2025-01-23 09:43:06', NULL, NULL);
INSERT INTO `user_activity` VALUES (871, 1, 'Masuk ke Soft Delete', '2025-01-23 09:43:08', NULL, NULL);
INSERT INTO `user_activity` VALUES (872, 1, 'Masuk ke Karyawan', '2025-01-23 09:43:14', NULL, NULL);
INSERT INTO `user_activity` VALUES (873, 1, 'Masuk ke Dashboard', '2025-01-23 09:43:15', NULL, NULL);

SET FOREIGN_KEY_CHECKS = 1;
