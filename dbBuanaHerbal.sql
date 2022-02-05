/*
SQLyog Ultimate v11.11 (64 bit)
MySQL - 5.5.5-10.1.10-MariaDB : Database - dbbuanaherbal
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
#CREATE DATABASE /*!32312 IF NOT EXISTS*/`dbbuanaherbal` /*!40100 DEFAULT CHARACTER SET latin1 */;

#USE `dbbuanaherbal`;

/*Table structure for table `barang` */

DROP TABLE IF EXISTS `barang`;

CREATE TABLE `barang` (
  `id_barang` int(11) NOT NULL AUTO_INCREMENT,
  `nama_barang` varchar(200) DEFAULT NULL,
  `barcode` varchar(200) DEFAULT NULL,
  `kategori` varchar(30) DEFAULT NULL,
  `stock` int(11) DEFAULT NULL,
  `satuan` varchar(20) DEFAULT NULL,
  `harga_juals` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_barang`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `barang` */

/*Table structure for table `customer` */

DROP TABLE IF EXISTS `customer`;

CREATE TABLE `customer` (
  `id_customer` int(11) NOT NULL AUTO_INCREMENT,
  `nama_customer` varchar(100) DEFAULT NULL,
  `alamat` varchar(200) DEFAULT NULL,
  `tlp` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id_customer`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `customer` */

/*Table structure for table `pembelian` */

DROP TABLE IF EXISTS `pembelian`;

CREATE TABLE `pembelian` (
  `id_pembelian` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) DEFAULT NULL,
  `tgl_pembelian` datetime DEFAULT NULL,
  `id_suplier` int(11) DEFAULT NULL,
  `keterangan` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id_pembelian`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `pembelian` */

/*Table structure for table `pembelian_detail` */

DROP TABLE IF EXISTS `pembelian_detail`;

CREATE TABLE `pembelian_detail` (
  `id_pembelian_detail` int(11) NOT NULL AUTO_INCREMENT,
  `id_pembelian` int(11) DEFAULT NULL,
  `id_barang` int(11) DEFAULT NULL,
  `qty_masuk` int(11) DEFAULT NULL,
  `qty_keluars` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_pembelian_detail`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `pembelian_detail` */

/*Table structure for table `penjualan` */

DROP TABLE IF EXISTS `penjualan`;

CREATE TABLE `penjualan` (
  `id_penjualan` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) DEFAULT NULL,
  `tgl_penjualan` datetime DEFAULT NULL,
  `id_customer` int(11) DEFAULT NULL,
  `keterangan` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id_penjualan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `penjualan` */

/*Table structure for table `penjualan_detail` */

DROP TABLE IF EXISTS `penjualan_detail`;

CREATE TABLE `penjualan_detail` (
  `id_penjualan_detail` int(11) NOT NULL AUTO_INCREMENT,
  `id_penjualan` int(11) DEFAULT NULL,
  `id_barang` int(11) DEFAULT NULL,
  `qty_keluar` int(11) DEFAULT NULL,
  `harga_jual` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_penjualan_detail`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `penjualan_detail` */

/*Table structure for table `suplier` */

DROP TABLE IF EXISTS `suplier`;

CREATE TABLE `suplier` (
  `id_suplier` int(11) NOT NULL AUTO_INCREMENT,
  `nama_suplier` varchar(100) DEFAULT NULL,
  `alamat` varchar(200) DEFAULT NULL,
  `tlp` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id_suplier`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `suplier` */

/*Table structure for table `user` */

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) DEFAULT NULL,
  `real_name` varchar(200) DEFAULT NULL,
  `password` varchar(200) DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `user` */

insert  into `user`(`id_user`,`username`,`real_name`,`password`,`last_login`) values (1,'rizal','Rizal Purnomo','c6318323cc5693ce1f8d220cc9a5030e','2022-01-30 19:41:14');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
