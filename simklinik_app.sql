-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.31 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             11.3.0.6295
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for simklinik_app
DROP DATABASE IF EXISTS `simklinik_app`;
CREATE DATABASE IF NOT EXISTS `simklinik_app` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `simklinik_app`;

-- Dumping structure for table simklinik_app.auth_assignment
DROP TABLE IF EXISTS `auth_assignment`;
CREATE TABLE IF NOT EXISTS `auth_assignment` (
  `item_name` varchar(64) COLLATE utf8mb3_unicode_ci NOT NULL,
  `user_id` varchar(64) COLLATE utf8mb3_unicode_ci NOT NULL,
  `created_at` int DEFAULT NULL,
  PRIMARY KEY (`item_name`,`user_id`),
  KEY `idx-auth_assignment-user_id` (`user_id`),
  CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- Data exporting was unselected.

-- Dumping structure for table simklinik_app.auth_item
DROP TABLE IF EXISTS `auth_item`;
CREATE TABLE IF NOT EXISTS `auth_item` (
  `name` varchar(64) COLLATE utf8mb3_unicode_ci NOT NULL,
  `type` smallint NOT NULL,
  `description` text COLLATE utf8mb3_unicode_ci,
  `rule_name` varchar(64) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `data` blob,
  `created_at` int DEFAULT NULL,
  `updated_at` int DEFAULT NULL,
  PRIMARY KEY (`name`),
  KEY `rule_name` (`rule_name`),
  KEY `idx-auth_item-type` (`type`),
  CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- Data exporting was unselected.

-- Dumping structure for table simklinik_app.auth_item_child
DROP TABLE IF EXISTS `auth_item_child`;
CREATE TABLE IF NOT EXISTS `auth_item_child` (
  `parent` varchar(64) COLLATE utf8mb3_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8mb3_unicode_ci NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`),
  CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- Data exporting was unselected.

-- Dumping structure for table simklinik_app.auth_rule
DROP TABLE IF EXISTS `auth_rule`;
CREATE TABLE IF NOT EXISTS `auth_rule` (
  `name` varchar(64) COLLATE utf8mb3_unicode_ci NOT NULL,
  `data` blob,
  `created_at` int DEFAULT NULL,
  `updated_at` int DEFAULT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- Data exporting was unselected.

-- Dumping structure for table simklinik_app.backend_users
DROP TABLE IF EXISTS `backend_users`;
CREATE TABLE IF NOT EXISTS `backend_users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `authkey` char(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Data exporting was unselected.

-- Dumping structure for table simklinik_app.detail_obat
DROP TABLE IF EXISTS `detail_obat`;
CREATE TABLE IF NOT EXISTS `detail_obat` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_pemeriksaan` int DEFAULT NULL,
  `id_obat` int DEFAULT NULL,
  `jumlah` varchar(50) DEFAULT NULL,
  `harga` double DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_Pemeriksaan` (`id_pemeriksaan`),
  KEY `FK2_obat` (`id_obat`),
  CONSTRAINT `FK2_obat` FOREIGN KEY (`id_obat`) REFERENCES `m_obat` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_Pemeriksaan` FOREIGN KEY (`id_pemeriksaan`) REFERENCES `pemeriksaan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Data exporting was unselected.

-- Dumping structure for table simklinik_app.migration
DROP TABLE IF EXISTS `migration`;
CREATE TABLE IF NOT EXISTS `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Data exporting was unselected.

-- Dumping structure for table simklinik_app.m_jabatan
DROP TABLE IF EXISTS `m_jabatan`;
CREATE TABLE IF NOT EXISTS `m_jabatan` (
  `id` int NOT NULL AUTO_INCREMENT,
  `jabatan` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Data exporting was unselected.

-- Dumping structure for table simklinik_app.m_obat
DROP TABLE IF EXISTS `m_obat`;
CREATE TABLE IF NOT EXISTS `m_obat` (
  `id` int NOT NULL AUTO_INCREMENT,
  `kode_obat` varchar(50) DEFAULT NULL,
  `nama_obat` varchar(255) DEFAULT NULL,
  `stok` double DEFAULT NULL,
  `satuan` int DEFAULT NULL,
  `harga` double DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_SatuanObat` (`satuan`),
  CONSTRAINT `FK_SatuanObat` FOREIGN KEY (`satuan`) REFERENCES `m_satuan_obat` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Data exporting was unselected.

-- Dumping structure for table simklinik_app.m_pasien
DROP TABLE IF EXISTS `m_pasien`;
CREATE TABLE IF NOT EXISTS `m_pasien` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama_pasien` varchar(255) DEFAULT NULL,
  `tempat_lahir` varchar(255) DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `golongan_darah` varchar(50) DEFAULT NULL,
  `agama` varchar(50) DEFAULT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') DEFAULT NULL,
  `nomor_handphone` varchar(12) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Data exporting was unselected.

-- Dumping structure for table simklinik_app.m_pegawai
DROP TABLE IF EXISTS `m_pegawai`;
CREATE TABLE IF NOT EXISTS `m_pegawai` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama_lengkap` varchar(255) DEFAULT NULL,
  `tempat_lahir` varchar(50) DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') DEFAULT NULL,
  `golongan_darah` varchar(50) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `jabatan` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_Jabatan` (`jabatan`),
  CONSTRAINT `FK_Jabatan` FOREIGN KEY (`jabatan`) REFERENCES `m_jabatan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Data exporting was unselected.

-- Dumping structure for table simklinik_app.m_satuan_obat
DROP TABLE IF EXISTS `m_satuan_obat`;
CREATE TABLE IF NOT EXISTS `m_satuan_obat` (
  `id` int NOT NULL AUTO_INCREMENT,
  `kode_satuan` varchar(50) DEFAULT NULL,
  `nama_satuan` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Data exporting was unselected.

-- Dumping structure for table simklinik_app.m_satuan_tindakan
DROP TABLE IF EXISTS `m_satuan_tindakan`;
CREATE TABLE IF NOT EXISTS `m_satuan_tindakan` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama_satuan` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Data exporting was unselected.

-- Dumping structure for table simklinik_app.m_tindakan
DROP TABLE IF EXISTS `m_tindakan`;
CREATE TABLE IF NOT EXISTS `m_tindakan` (
  `id` int NOT NULL AUTO_INCREMENT,
  `tindakan` varchar(255) DEFAULT NULL,
  `satuan_tindakan` int DEFAULT NULL,
  `biaya` double DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_SatuanTindakan` (`satuan_tindakan`),
  CONSTRAINT `FK_SatuanTindakan` FOREIGN KEY (`satuan_tindakan`) REFERENCES `m_satuan_tindakan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Data exporting was unselected.

-- Dumping structure for table simklinik_app.pembayaran
DROP TABLE IF EXISTS `pembayaran`;
CREATE TABLE IF NOT EXISTS `pembayaran` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nomor_nota` varchar(50) DEFAULT NULL,
  `nomor_pemeriksaan` int DEFAULT NULL,
  `pasien` int DEFAULT NULL,
  `total` double DEFAULT NULL,
  `bayar` double DEFAULT NULL,
  `kembalian` double DEFAULT NULL,
  `tgl_pembayaran` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Data exporting was unselected.

-- Dumping structure for table simklinik_app.pemeriksaan
DROP TABLE IF EXISTS `pemeriksaan`;
CREATE TABLE IF NOT EXISTS `pemeriksaan` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nomor_pemeriksaan` varchar(50) DEFAULT NULL,
  `tgl_pemeriksaan` date DEFAULT NULL,
  `pendaftaran` int DEFAULT NULL,
  `pasien` int DEFAULT NULL,
  `dokter` int DEFAULT NULL,
  `diagnosa` varchar(255) DEFAULT NULL,
  `tindakan` int DEFAULT NULL,
  `biaya_tindakan` double DEFAULT NULL,
  `status` enum('Aktif','Selesai') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT 'Aktif',
  PRIMARY KEY (`id`),
  KEY `FK_Pendaftaran` (`pendaftaran`),
  KEY `FK_Tindakan` (`tindakan`),
  KEY `FK_PegawaiDokter` (`dokter`),
  CONSTRAINT `FK_PegawaiDokter` FOREIGN KEY (`dokter`) REFERENCES `m_pegawai` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_Pendaftaran` FOREIGN KEY (`pendaftaran`) REFERENCES `pendaftaran_pasien` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_Tindakan` FOREIGN KEY (`tindakan`) REFERENCES `m_tindakan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Data exporting was unselected.

-- Dumping structure for table simklinik_app.pendaftaran_pasien
DROP TABLE IF EXISTS `pendaftaran_pasien`;
CREATE TABLE IF NOT EXISTS `pendaftaran_pasien` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nomor_pendaftaran` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `pasien` int NOT NULL,
  `tgl_daftar` date NOT NULL,
  `status` enum('Aktif','Selesai') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'Aktif',
  PRIMARY KEY (`id`),
  KEY `FK_Pasien` (`pasien`),
  CONSTRAINT `FK_Pasien` FOREIGN KEY (`pasien`) REFERENCES `m_pasien` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Data exporting was unselected.

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
