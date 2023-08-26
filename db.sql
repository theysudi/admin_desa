/*
SQLyog Community v13.1.9 (64 bit)
MySQL - 10.4.13-MariaDB : Database - tabg
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`tabg` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `tabg`;

/*Table structure for table `failed_jobs` */

DROP TABLE IF EXISTS `failed_jobs`;

CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `failed_jobs` */

/*Table structure for table `m_ahli` */

DROP TABLE IF EXISTS `m_ahli`;

CREATE TABLE `m_ahli` (
  `id_ahli` int(10) NOT NULL AUTO_INCREMENT,
  `no_identitas` varchar(100) DEFAULT NULL,
  `nama_ahli` varchar(200) DEFAULT NULL,
  `bidang` varchar(200) DEFAULT NULL,
  `keahlian` varchar(200) DEFAULT NULL,
  `asosiasi` varchar(200) DEFAULT NULL,
  `no_tlp` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_ahli`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `m_ahli` */

/*Table structure for table `m_dokumen` */

DROP TABLE IF EXISTS `m_dokumen`;

CREATE TABLE `m_dokumen` (
  `id_dokumen` int(10) NOT NULL AUTO_INCREMENT,
  `nama_dokumen` varchar(200) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  PRIMARY KEY (`id_dokumen`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `m_dokumen` */

/*Table structure for table `m_dokumen_jenis` */

DROP TABLE IF EXISTS `m_dokumen_jenis`;

CREATE TABLE `m_dokumen_jenis` (
  `id_dokumen_jenis` int(19) NOT NULL AUTO_INCREMENT,
  `jenis_dokumen` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id_dokumen_jenis`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `m_dokumen_jenis` */

/*Table structure for table `m_fungsi_bg` */

DROP TABLE IF EXISTS `m_fungsi_bg`;

CREATE TABLE `m_fungsi_bg` (
  `id_fungsi` int(10) NOT NULL AUTO_INCREMENT,
  `fungsi` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_fungsi`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `m_fungsi_bg` */

/*Table structure for table `m_jenis_konsultasi` */

DROP TABLE IF EXISTS `m_jenis_konsultasi`;

CREATE TABLE `m_jenis_konsultasi` (
  `id_jenis_konsultasi` int(10) NOT NULL AUTO_INCREMENT,
  `jenis_konsultasi` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id_jenis_konsultasi`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `m_jenis_konsultasi` */

/*Table structure for table `m_klasifikasi_bg` */

DROP TABLE IF EXISTS `m_klasifikasi_bg`;

CREATE TABLE `m_klasifikasi_bg` (
  `id_klasifikasi_bg` int(10) DEFAULT NULL,
  `klasifikasi_bg` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `m_klasifikasi_bg` */

/*Table structure for table `m_pemilik` */

DROP TABLE IF EXISTS `m_pemilik`;

CREATE TABLE `m_pemilik` (
  `id_pemilik` int(10) NOT NULL AUTO_INCREMENT,
  `no_identitas` varchar(50) DEFAULT NULL,
  `nama_pemilik` varchar(200) DEFAULT NULL,
  `alamat_pemilik` text DEFAULT NULL,
  `no_tlp` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `isaktif` int(1) DEFAULT 1,
  PRIMARY KEY (`id_pemilik`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `m_pemilik` */

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `migrations` */

insert  into `migrations`(`id`,`migration`,`batch`) values 
(1,'2014_10_12_000000_create_users_table',1),
(2,'2014_10_12_100000_create_password_resets_table',1),
(3,'2019_08_19_000000_create_failed_jobs_table',1);

/*Table structure for table `password_resets` */

DROP TABLE IF EXISTS `password_resets`;

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `password_resets` */

/*Table structure for table `permission_role` */

DROP TABLE IF EXISTS `permission_role`;

CREATE TABLE `permission_role` (
  `permission_id` bigint(20) unsigned NOT NULL,
  `role_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`),
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `permission_role` */

insert  into `permission_role`(`permission_id`,`role_id`) values 
(2,2),
(3,2),
(4,2),
(5,2),
(6,2),
(7,2),
(8,2),
(9,2),
(10,2),
(10,3),
(11,2),
(12,2),
(13,2),
(14,2),
(14,3),
(15,2),
(15,3),
(16,2),
(16,4);

/*Table structure for table `permissions` */

DROP TABLE IF EXISTS `permissions`;

CREATE TABLE `permissions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `permissions` */

insert  into `permissions`(`id`,`name`,`guard_name`,`created_at`,`updated_at`) values 
(2,'Admin','web',NULL,NULL),
(3,'MasterData','web',NULL,NULL),
(4,'Desa','web',NULL,NULL),
(5,'Subak','web',NULL,NULL),
(6,'KelompokTani','web',NULL,NULL),
(7,'subsektor','web',NULL,NULL),
(8,'JenisTanaman','web',NULL,NULL),
(9,'komoditas','web',NULL,NULL),
(10,'TambahTanam','web',NULL,NULL),
(11,'Penyosoh','web',NULL,NULL),
(12,'optKelompok','web',NULL,NULL),
(13,'opt','web',NULL,NULL),
(14,'Produksi','web',NULL,NULL),
(15,'SeranganOpt','web',NULL,NULL),
(16,'Survey','web',NULL,NULL);

/*Table structure for table `roles` */

DROP TABLE IF EXISTS `roles`;

CREATE TABLE `roles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `roles` */

insert  into `roles`(`id`,`name`,`guard_name`,`created_at`,`updated_at`) values 
(2,'Admin','web',NULL,NULL),
(3,'Penyuluh','web',NULL,NULL),
(4,'Survey','web',NULL,NULL);

/*Table structure for table `settings` */

DROP TABLE IF EXISTS `settings`;

CREATE TABLE `settings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nama_sistem` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_institusi` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `logo_sistem` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `logo_sistem_minimal` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat_institusi` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telp_institusi` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_institusi` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `settings` */

insert  into `settings`(`id`,`nama_sistem`,`nama_institusi`,`logo_sistem`,`logo_sistem_minimal`,`alamat_institusi`,`telp_institusi`,`email_institusi`,`created_at`,`updated_at`) values 
(1,'SIMBG','Kota Denpasar','assets/images/logo.png','assets/images/logo_minimal.png','Jl. Tukad Pakerisan No. 97 Denpasar, Bali, Indonesia.','+62 361-256-995','humas@instiki.ac.id','2022-03-17 09:54:56','2022-09-17 10:16:51');

/*Table structure for table `t_bangunan_gedung` */

DROP TABLE IF EXISTS `t_bangunan_gedung`;

CREATE TABLE `t_bangunan_gedung` (
  `id_bangunan_gedung` int(10) DEFAULT NULL,
  `id_pemilik` int(10) DEFAULT NULL,
  `id_jenis_konsultasi` int(10) DEFAULT NULL,
  `id_klasifikasi_bg` int(10) DEFAULT NULL,
  `id_fungsi_bg` int(10) DEFAULT NULL,
  `nama_bangunan_gedung` varchar(200) DEFAULT NULL,
  `luas_bg` double(10,2) DEFAULT NULL,
  `ketinggian_bg` double(10,2) DEFAULT NULL,
  `jumlah_lantai` int(10) DEFAULT NULL,
  `luas_basement` double(10,2) DEFAULT NULL,
  `jumlah_lantai_basement` int(10) DEFAULT NULL,
  `perancang_dokumen_teknis` varchar(200) DEFAULT NULL,
  `status_verifikasi` int(1) DEFAULT 0 COMMENT '0 belum diverifikasi, 1 sudah'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `t_bangunan_gedung` */

/*Table structure for table `t_bangunan_gedung_dokumen` */

DROP TABLE IF EXISTS `t_bangunan_gedung_dokumen`;

CREATE TABLE `t_bangunan_gedung_dokumen` (
  `id_bg_dokumen` int(10) NOT NULL AUTO_INCREMENT,
  `id_bagunan_gedung` int(10) DEFAULT NULL,
  `id_dokumen` int(10) DEFAULT NULL,
  PRIMARY KEY (`id_bg_dokumen`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `t_bangunan_gedung_dokumen` */

/*Table structure for table `tx_registrasi` */

DROP TABLE IF EXISTS `tx_registrasi`;

CREATE TABLE `tx_registrasi` (
  `id_registrasi` int(10) NOT NULL AUTO_INCREMENT,
  `kode_registrasi` varchar(20) DEFAULT NULL,
  `id_bangunan_gedung` int(10) DEFAULT NULL,
  `tgl_registrasi` datetime DEFAULT NULL,
  PRIMARY KEY (`id_registrasi`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tx_registrasi` */

/*Table structure for table `tx_registrasi_ahli` */

DROP TABLE IF EXISTS `tx_registrasi_ahli`;

CREATE TABLE `tx_registrasi_ahli` (
  `id_registrasi_ahli` int(10) NOT NULL AUTO_INCREMENT,
  `id_registrasi` int(10) DEFAULT NULL,
  `id_ahli` int(10) DEFAULT NULL,
  PRIMARY KEY (`id_registrasi_ahli`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tx_registrasi_ahli` */

/*Table structure for table `tx_registrasi_ahli_dokumen` */

DROP TABLE IF EXISTS `tx_registrasi_ahli_dokumen`;

CREATE TABLE `tx_registrasi_ahli_dokumen` (
  `id_registrasi_ahli_dokumen` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_registrasi` int(10) DEFAULT NULL,
  `id_dokumen` int(10) DEFAULT NULL,
  `id_ahli` int(10) DEFAULT NULL,
  `status_kesesuaian` int(11) DEFAULT NULL,
  `catatan` text DEFAULT NULL,
  `link_dokumen` text DEFAULT NULL,
  KEY `id_registrasi_ahli_dokumen` (`id_registrasi_ahli_dokumen`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tx_registrasi_ahli_dokumen` */

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `users_username_unique` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`name`,`email`,`username`,`email_verified_at`,`password`,`remember_token`,`created_at`,`updated_at`,`role_id`) values 
(1,'admin','admin','admin',NULL,'$2y$10$WUEYio8LRLeZ17jp.u8P0uBcHjdokBQLrO2K1x8ooe8CJ2EBZJK/y',NULL,NULL,NULL,2),
(4,'Penyuluh','penyuluh','penyuluh',NULL,'$2y$10$WUEYio8LRLeZ17jp.u8P0uBcHjdokBQLrO2K1x8ooe8CJ2EBZJK/y',NULL,NULL,NULL,4);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
