-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Anamakine: localhost
-- Üretim Zamanı: 27 Eki 2018, 07:24:50
-- Sunucu sürümü: 5.7.17-log
-- PHP Sürümü: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `fizyotakip`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `bildirimler`
--

CREATE TABLE `bildirimler` (
  `id` int(10) UNSIGNED NOT NULL,
  `ekleyen_id` int(11) NOT NULL,
  `gonderilen_id` int(11) NOT NULL,
  `mesaj_detay` text COLLATE utf8mb4_unicode_ci,
  `mesaj_durum` int(11) DEFAULT NULL,
  `plan_sayisi` int(11) DEFAULT NULL,
  `aktif` int(11) NOT NULL DEFAULT '1',
  `silinme_tarihi` datetime DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `bildirimler`
--

INSERT INTO `bildirimler` (`id`, `ekleyen_id`, `gonderilen_id`, `mesaj_detay`, `mesaj_durum`, `plan_sayisi`, `aktif`, `silinme_tarihi`, `remember_token`, `created_at`, `updated_at`) VALUES
(30, 4, 5, '2018-10-23 13:53:53 tarihinde doktorunuz tarafından adınıza yeni bir plan atanmıştır', 0, 1, 1, NULL, NULL, '2018-10-23 10:53:53', '2018-10-23 10:53:53');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `bolgeler`
--

CREATE TABLE `bolgeler` (
  `id` int(10) UNSIGNED NOT NULL,
  `ekleyen_id` int(11) NOT NULL,
  `isim` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ozellikleri` text COLLATE utf8mb4_unicode_ci,
  `resim` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `aktif` int(11) NOT NULL DEFAULT '1',
  `silinme_tarihi` datetime DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `bolgeler`
--

INSERT INTO `bolgeler` (`id`, `ekleyen_id`, `isim`, `ozellikleri`, `resim`, `aktif`, `silinme_tarihi`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 1, 'bolge 1', 'bolge 1', 'gallery/indir.png', 1, NULL, NULL, '2018-09-21 03:32:41', '2018-09-21 03:32:41');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `egzersiz`
--

CREATE TABLE `egzersiz` (
  `id` int(10) UNSIGNED NOT NULL,
  `ekleyen_id` int(11) NOT NULL,
  `egzersiz_isim` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `egzersiz_kategori` int(11) DEFAULT NULL,
  `egzersiz_hareket` int(11) DEFAULT NULL,
  `resim` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `resim_iki` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `video` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `aciklama` text COLLATE utf8mb4_unicode_ci,
  `aktif` int(11) NOT NULL DEFAULT '1',
  `silme_tarihi` datetime DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `egzersiz`
--

INSERT INTO `egzersiz` (`id`, `ekleyen_id`, `egzersiz_isim`, `egzersiz_kategori`, `egzersiz_hareket`, `resim`, `resim_iki`, `video`, `aciklama`, `aktif`, `silme_tarihi`, `remember_token`, `created_at`, `updated_at`) VALUES
(36, 1, 'Dumbbell Bench Press', 1, 2, 'gallery/1_2.jpg', 'gallery/1_2.jpg', 'gallery/indir.png', '<p>1.Lorem Ipsum, dizgi ve baskı end&uuml;strisinde kullanılan mıgır metinlerdir.</p>\r\n\r\n<p>2.Lorem Ipsum, dizgi ve baskı end&uuml;strisinde kullanılan mıgır metinlerdir.</p>\r\n\r\n<p>3.Lorem Ipsum, adı bilinmeyen bir matbaacının bir hurufat numune kitabı oluşturmak 4.&uuml;zere bir yazı galerisini alarak karıştırdığı 1500&#39;lerden beri end&uuml;stri standardı sahte metinler olarak kullanılmıştır.</p>\r\n\r\n<p>5.Lorem Ipsum, dizgi ve baskı end&uuml;strisinde kullanılan mıgır metinlerdir.</p>\r\n\r\n<p>6.Lorem Ipsum, dizgi ve baskı end&uuml;strisinde kullanılan mıgır metinlerdir.</p>\r\n\r\n<p>7.Lorem Ipsum, adı bilinmeyen bir matbaacının bir hurufat numune kitabı oluşturmak &uuml;zere bir yazı galerisini alarak karıştırdığı 1500&#39;lerden beri end&uuml;stri standardı sahte metinler olarak kullanılmıştır.</p>', 1, NULL, NULL, '2018-09-21 10:09:00', '2018-09-21 10:09:00'),
(39, 1, 'Incline Dumbbell Press', 1, 2, 'gallery/380_1.jpg', 'gallery/380_2.jpg', 'gallery/indir.png', NULL, 1, NULL, NULL, '2018-10-20 04:17:09', '2018-10-20 04:17:09'),
(40, 1, 'Dumbbell Flyes', 5, 2, 'gallery/12_1.jpg', 'gallery/12_2.jpg', 'gallery/indir.png', NULL, 0, '2018-10-20 07:56:48', NULL, '2018-10-20 04:18:56', '2018-10-20 04:56:48'),
(41, 1, 'Pushups', 1, 2, 'gallery/70_1.jpg', 'gallery/70_2.jpg', 'gallery/indir.png', '<p>Lorem Ipsum, dizgi ve baskı end&uuml;strisinde kullanılan mıgır metinlerdir.</p>\r\n\r\n<p>Lorem Ipsum, dizgi ve baskı end&uuml;strisinde kullanılan mıgır metinlerdir.</p>\r\n\r\n<p>Lorem Ipsum, adı bilinmeyen bir matbaacının bir hurufat numune kitabı oluşturmak &uuml;zere bir yazı galerisini alarak karıştırdığı 1500&#39;lerden beri end&uuml;stri standardı sahte metinler olarak kullanılmıştır.</p>', 1, NULL, NULL, '2018-10-20 04:20:10', '2018-10-20 04:20:10'),
(42, 1, 'Low Cable Crossover', 1, 2, 'gallery/1621_1.jpg', 'gallery/1621_2.jpg', 'gallery/indir.png', NULL, 1, NULL, NULL, '2018-10-20 04:22:11', '2018-10-20 04:22:11'),
(43, 1, 'Dips - Chest Version', 1, 2, 'gallery/145_1.jpg', 'gallery/145_2.jpg', 'gallery/indir.png', NULL, 1, NULL, NULL, '2018-10-20 04:22:50', '2018-10-20 04:22:50'),
(44, 1, 'Barbell Bench Press - Medium Grip', 1, 2, 'gallery/360_1.jpg', 'gallery/360_2.jpg', 'gallery/indir.png', NULL, 1, NULL, NULL, '2018-10-20 04:23:24', '2018-10-20 04:23:24'),
(45, 1, 'Bodyweight Flyes', 1, 2, 'gallery/1561_1.jpg', 'gallery/1561_2.jpg', 'gallery/indir.png', NULL, 1, NULL, NULL, '2018-10-20 04:24:05', '2018-10-20 04:24:05'),
(46, 1, 'Decline Dumbbell Flyes', 1, 2, 'gallery/36_1.jpg', 'gallery/36_2.jpg', 'gallery/indir.png', NULL, 1, NULL, NULL, '2018-10-20 04:25:32', '2018-10-20 04:25:32'),
(47, 1, 'Incline Cable Flye', 1, 2, 'gallery/181_1.jpg', 'gallery/181_2.jpg', 'gallery/indir.png', NULL, 1, NULL, NULL, '2018-10-20 04:26:16', '2018-10-20 04:26:16'),
(48, 1, 'Incline Dumbbell Press Reverse-Grip', 1, 2, 'gallery/3331_1.jpg', 'gallery/3331_2.jpg', 'gallery/indir.png', NULL, 1, NULL, NULL, '2018-10-20 04:26:45', '2018-10-20 04:26:45'),
(49, 1, 'Wide-Grip Barbell Bench Press', 1, 2, 'gallery/35_1.jpg', 'gallery/35_2.jpg', 'gallery/indir.png', NULL, 1, NULL, NULL, '2018-10-20 04:27:22', '2018-10-20 04:27:22'),
(50, 1, 'Decline Barbell Bench Press', 1, 2, 'gallery/34_1.jpg', 'gallery/34_2.jpg', 'gallery/indir.png', NULL, 1, NULL, NULL, '2018-10-20 04:27:58', '2018-10-20 04:27:58'),
(51, 1, 'Incline Push-Up', 1, 2, 'gallery/883_1.jpg', 'gallery/883_2.jpg', 'gallery/indir.png', NULL, 1, NULL, NULL, '2018-10-20 04:28:39', '2018-10-20 04:28:39'),
(52, 1, 'Wide Decline Barbell Bench Press', 1, 2, 'gallery/33_1.jpg', 'gallery/35_2.jpg', 'gallery/indir.png', NULL, 1, NULL, NULL, '2018-10-20 04:30:04', '2018-10-20 04:30:04'),
(53, 1, 'Rickshaw Carry', 2, 2, 'gallery/742_1.jpg', 'gallery/742_2.jpg', 'gallery/indir.png', NULL, 1, NULL, NULL, '2018-10-20 04:31:43', '2018-10-20 04:31:43'),
(54, 1, 'Wrist Rotations with Straight Bar', 2, 2, 'gallery/1691_1.jpg', 'gallery/1691_2.jpg', 'gallery/indir.png', NULL, 1, NULL, NULL, '2018-10-20 04:32:09', '2018-10-20 04:32:09'),
(55, 1, 'Palms-Down Wrist Curl Over A Bench', 2, 2, 'gallery/2_1.jpg', 'gallery/2_2.jpg', 'gallery/indir.png', NULL, 1, NULL, NULL, '2018-10-20 04:33:17', '2018-10-20 04:33:17'),
(56, 1, 'Farmer\'s Walk', 2, 2, 'gallery/682_1.jpg', 'gallery/682_2.jpg', 'gallery/indir.png', NULL, 1, NULL, NULL, '2018-10-20 04:34:46', '2018-10-20 04:34:46'),
(57, 1, 'Barbell  The Back Wrist Curl', 2, 2, 'gallery/5_1.jpg', 'gallery/5_2.jpg', 'gallery/indir.png', NULL, 1, NULL, NULL, '2018-10-20 04:35:46', '2018-10-20 04:35:46'),
(58, 1, 'Finger Curls', 2, 2, 'gallery/1681_1.jpg', 'gallery/1681_2.jpg', 'gallery/indir.png', NULL, 1, NULL, NULL, '2018-10-20 04:36:23', '2018-10-20 04:36:23'),
(59, 1, 'Wrist Roller', 2, 2, 'gallery/5_1.jpg', 'gallery/5_2.jpg', 'gallery/indir.png', NULL, 1, NULL, NULL, '2018-10-20 04:37:56', '2018-10-20 04:37:56'),
(60, 1, 'One-Arm Dumbbell Wrist Curl', 2, 2, 'gallery/386_1.jpg', 'gallery/386_2.jpg', 'gallery/indir.png', NULL, 1, NULL, NULL, '2018-10-20 04:39:08', '2018-10-20 04:39:08'),
(61, 1, 'Seated Palms-Down Barbell Wrist Curl', 2, 2, 'gallery/indir.png', 'gallery/indir.png', 'gallery/indir.png', NULL, 0, '2018-10-20 07:40:20', NULL, '2018-10-20 04:39:38', '2018-10-20 04:40:20'),
(62, 1, 'Dumbbell Lying Supination', 2, 2, 'gallery/323_1.jpg', 'gallery/323_2.jpg', 'gallery/indir.png', NULL, 1, NULL, NULL, '2018-10-20 04:40:54', '2018-10-20 04:40:54'),
(63, 1, 'Dumbbell Lying Pronation', 2, 2, 'gallery/321_1.jpg', 'gallery/321_2.jpg', 'gallery/indir.png', NULL, 1, NULL, NULL, '2018-10-20 04:42:01', '2018-10-20 04:42:01'),
(64, 1, 'Dumbbell Curl Over A Bench', 2, 2, 'gallery/3_1.jpg', 'gallery/3_2.jpg', 'gallery/indir.png', NULL, 1, NULL, NULL, '2018-10-20 04:43:05', '2018-10-20 04:43:05'),
(65, 1, 'Weighted Pull Ups', 3, 2, 'gallery/928_1.jpg', 'gallery/928_2.jpg', 'gallery/indir.png', NULL, 1, NULL, NULL, '2018-10-20 04:44:31', '2018-10-20 04:44:31'),
(66, 1, 'Pullups', 3, 2, 'gallery/46_1.jpg', 'gallery/46_2.jpg', 'gallery/indir.png', NULL, 1, NULL, NULL, '2018-10-20 04:44:54', '2018-10-20 04:44:54'),
(67, 1, 'Chin-Up', 3, 2, 'gallery/46_1.jpg', 'gallery/46_2.jpg', 'gallery/indir.png', NULL, 1, NULL, NULL, '2018-10-20 04:46:33', '2018-10-20 04:46:33'),
(68, 1, 'Rocky Pull-Ups/Pulldowns', 3, 2, 'gallery/279_1.jpg', 'gallery/279_2.jpg', 'gallery/indir.png', NULL, 1, NULL, NULL, '2018-10-20 04:47:24', '2018-10-20 04:47:24'),
(69, 1, 'V-Bar Pulldown', 3, 2, 'gallery/177_1.jpg', 'gallery/177_2.jpg', 'gallery/indir.png', NULL, 1, NULL, NULL, '2018-10-20 04:47:49', '2018-10-20 04:47:49'),
(70, 1, 'Muscle Up', 3, 2, 'gallery/1501_1.jpg', 'gallery/1501_2.jpg', 'gallery/indir.png', NULL, 1, NULL, NULL, '2018-10-20 04:48:17', '2018-10-20 04:48:17'),
(71, 1, 'Shotgun Row', 3, 2, 'gallery/1971_1.jpg', 'gallery/1971_2.jpg', 'gallery/indir.png', NULL, 1, NULL, NULL, '2018-10-20 04:48:47', '2018-10-20 04:48:47'),
(72, 1, 'Wide-Grip Pull-Up', 3, 2, 'gallery/3961_1.jpg', 'gallery/3961_2.jpg', 'gallery/indir.png', NULL, 1, NULL, NULL, '2018-10-20 04:49:16', '2018-10-20 04:49:16'),
(73, 1, 'Close-Grip Front Lat Pulldown', 3, 2, 'gallery/14_1.jpg', 'gallery/14_2.jpg', 'gallery/indir.png', NULL, 1, NULL, NULL, '2018-10-20 04:49:42', '2018-10-20 04:49:42'),
(74, 1, 'V-Bar Pullup', 3, 2, 'gallery/140_1.jpg', 'gallery/140_2.jpg', 'gallery/indir.png', NULL, 1, NULL, NULL, '2018-10-20 04:50:14', '2018-10-20 04:50:14'),
(75, 1, 'Wide-Grip Rear Pull-Up', 3, 2, 'gallery/191_1.jpg', 'gallery/191_2.jpg', 'gallery/indir.png', NULL, 1, NULL, NULL, '2018-10-20 04:50:43', '2018-10-20 04:50:43'),
(76, 1, 'Rope Straight-Arm Pulldown', 3, 2, 'gallery/2171_1.jpg', 'gallery/2171_2.jpg', 'gallery/indir.png', NULL, 1, NULL, NULL, '2018-10-20 04:51:12', '2018-10-20 04:51:12'),
(77, 1, 'Rope Climb', 3, 2, 'gallery/1441_1.jpg', 'gallery/1441_2.jpg', 'gallery/indir.png', NULL, 1, NULL, NULL, '2018-10-20 04:51:40', '2018-10-20 04:51:40'),
(78, 1, 'Wide-Grip Lat Pulldown', 3, 2, 'gallery/10_1.jpg', 'gallery/10_2.jpg', 'gallery/indir.png', NULL, 1, NULL, NULL, '2018-10-20 04:52:13', '2018-10-20 04:52:13'),
(79, 1, 'Underhand Cable Pulldowns', 3, 2, 'gallery/139_1.jpg', 'gallery/139_2.jpg', 'gallery/indir.png', NULL, 1, NULL, NULL, '2018-10-20 04:53:05', '2018-10-20 04:53:05'),
(80, 1, 'Dips - Triceps Version', 6, 2, 'gallery/55_1.jpg', 'gallery/55_2.jpg', 'gallery/indir.png', NULL, 1, NULL, NULL, '2018-10-20 04:55:44', '2018-10-20 04:55:44'),
(81, 1, 'Decline EZ Bar Triceps Extension', 6, 2, 'gallery/166_1.jpg', 'gallery/166_2.jpg', 'gallery/indir.png', NULL, 1, NULL, NULL, '2018-10-20 04:56:05', '2018-10-20 04:56:05'),
(82, 1, 'Dumbbell Floor Press', 6, 2, 'gallery/680_1.jpg', 'gallery/680_2.jpg', 'gallery/indir.png', NULL, 1, NULL, NULL, '2018-10-20 04:56:22', '2018-10-20 04:56:22'),
(83, 1, 'Close-Grip Barbell Bench Press', 6, 2, 'gallery/23_1.jpg', 'gallery/23_2.jpg', 'gallery/indir.png', NULL, 1, NULL, NULL, '2018-10-20 04:57:36', '2018-10-20 04:57:36'),
(84, 1, 'Triceps Pushdown - V-Bar Attachment', 6, 2, 'gallery/143_1.jpg', 'gallery/143_2.jpg', 'gallery/indir.png', NULL, 1, NULL, NULL, '2018-10-20 04:58:05', '2018-10-20 04:58:05'),
(85, 1, 'Weighted Bench Dip', 6, 2, 'gallery/334_1.jpg', 'gallery/334_2.jpg', 'gallery/indir.png', NULL, 1, NULL, NULL, '2018-10-20 04:58:34', '2018-10-20 04:58:34'),
(86, 1, 'Kneeling Cable Triceps Extension', 6, 2, 'gallery/150_1.jpg', 'gallery/150_2.jpg', 'gallery/indir.png', NULL, 1, NULL, NULL, '2018-10-20 04:59:03', '2018-10-20 04:59:03'),
(87, 1, 'Reverse Grip Triceps Pushdown', 6, 2, 'gallery/179_1.jpg', 'gallery/179_2.jpg', 'gallery/indir.png', NULL, 1, NULL, NULL, '2018-10-20 05:00:43', '2018-10-20 05:00:43'),
(88, 1, 'Standing Dumbbell Triceps Extension', 6, 2, 'gallery/345_1.jpg', 'gallery/345_2.jpg', 'gallery/indir.png', NULL, 1, NULL, NULL, '2018-10-20 05:01:06', '2018-10-20 05:01:06'),
(89, 1, 'Push-Ups - Close Triceps', 6, 2, 'gallery/363_1.jpg', 'gallery/363_2.jpg', 'gallery/indir.png', NULL, 1, NULL, NULL, '2018-10-20 05:01:43', '2018-10-20 05:01:43'),
(90, 1, 'EZ-Bar Skullcrusher', 6, 2, 'gallery/1641_1.jpg', 'gallery/1641_2.jpg', 'gallery/indir.png', NULL, 1, NULL, NULL, '2018-10-20 05:02:18', '2018-10-20 05:02:18'),
(91, 1, 'Pushdown - Rope Attachment', 6, 2, 'gallery/54_1.jpg', 'gallery/54_2.jpg', 'gallery/indir.png', NULL, 1, NULL, NULL, '2018-10-20 05:02:53', '2018-10-20 05:02:53'),
(92, 1, 'Cable One Arm Tricep Extension', 6, 2, 'gallery/80_1.jpg', 'gallery/80_2.jpg', 'gallery/indir.png', NULL, 1, NULL, NULL, '2018-10-20 05:03:37', '2018-10-20 05:03:37'),
(93, 1, 'Seated Triceps Press', 6, 2, 'gallery/341_1.jpg', 'gallery/341_2.jpg', 'gallery/indir.png', NULL, 1, NULL, NULL, '2018-10-20 05:04:24', '2018-10-20 05:04:24'),
(94, 1, 'Single-Arm Linear Jammer', 7, 2, 'gallery/1741_1.jpg', 'gallery/1741_2.jpg', 'gallery/indir.png', NULL, 1, NULL, NULL, '2018-10-20 05:29:06', '2018-10-20 05:29:06'),
(95, 1, 'Side Laterals to Front Raise', 7, 2, 'gallery/1791_1.jpg', 'gallery/1791_2.jpg', 'gallery/indir.png', NULL, 1, NULL, NULL, '2018-10-20 05:29:31', '2018-10-20 05:29:31'),
(96, 1, 'One-Arm Dumbbell Press', 7, 2, 'gallery/366_1.jpg', 'gallery/366_2.jpg', 'gallery/indir.png', NULL, 1, NULL, NULL, '2018-10-20 05:30:08', '2018-10-20 05:30:08'),
(97, 1, 'Clean and Press', 7, 2, 'gallery/864_1.jpg', 'gallery/864_2.jpg', 'gallery/indir.png', NULL, 1, NULL, NULL, '2018-10-20 05:30:36', '2018-10-20 05:30:36'),
(98, 1, 'Push Press', 7, 2, 'gallery/186_1.jpg', 'gallery/186_2.jpg', 'gallery/indir.png', NULL, 1, NULL, NULL, '2018-10-20 05:31:06', '2018-10-20 05:31:06'),
(99, 1, 'Clean and Jerk', 7, 2, 'gallery/670_1.jpg', 'gallery/670_2.jpg', 'gallery/indir.png', NULL, 1, NULL, NULL, '2018-10-20 05:31:39', '2018-10-20 05:31:39'),
(100, 1, 'Standing Palms-In Dumbbell Press', 7, 2, 'gallery/367_1.jpg', 'gallery/367_2.jpg', 'gallery/indir.png', NULL, 1, NULL, NULL, '2018-10-20 05:32:03', '2018-10-20 05:32:03'),
(101, 1, 'Standing Military Press', 7, 2, 'gallery/370_1.jpg', 'gallery/370_2.jpg', 'gallery/indir.png', NULL, 1, NULL, NULL, '2018-10-20 05:32:39', '2018-10-20 05:32:39'),
(102, 1, 'One-Arm Kettlebell Push Press', 7, 2, 'gallery/519_1.jpg', 'gallery/519_2.jpg', 'gallery/indir.png', NULL, 1, NULL, NULL, '2018-10-20 05:33:03', '2018-10-20 05:33:03'),
(103, 1, 'Seated Barbell Military Press', 7, 2, 'gallery/382_1.jpg', 'gallery/382_2.jpg', 'gallery/indir.png', NULL, 1, NULL, NULL, '2018-10-20 05:33:24', '2018-10-20 05:33:24'),
(104, 1, 'One-Arm Side Laterals', 7, 2, 'gallery/173_1.jpg', 'gallery/173_2.jpg', 'gallery/indir.png', NULL, 1, NULL, NULL, '2018-10-20 05:33:47', '2018-10-20 05:33:47'),
(105, 1, 'Power Partials', 7, 2, 'gallery/270_1.jpg', 'gallery/270_2.jpg', 'gallery/indir.png', NULL, 1, NULL, NULL, '2018-10-20 05:34:15', '2018-10-20 05:34:15'),
(110, 1, 'Seated Dumbbell Press', 7, 2, 'gallery/364_1.jpg', 'gallery/364_2.jpg', 'gallery/173_1.jpg', '<p>dfdfdf</p>', 1, NULL, NULL, '2018-10-20 05:36:27', '2018-10-20 05:36:27'),
(111, 1, 'Dumbbell Raise Above Head', 7, 2, 'gallery/374_1.jpg', 'gallery/374_2.jpg', 'gallery/indir.png', NULL, 1, NULL, NULL, '2018-10-20 05:37:48', '2018-10-20 05:37:48'),
(112, 1, 'Reverse Flyes', 7, 2, 'gallery/375_1.jpg', 'gallery/375_2.jpg', 'gallery/indir.png', NULL, 1, NULL, NULL, '2018-10-20 05:38:15', '2018-10-20 05:38:15'),
(113, 1, 'Incline Hammer Curls', 8, 2, 'gallery/882_1.jpg', 'gallery/882_2.jpg', 'gallery/indir.png', NULL, 1, NULL, NULL, '2018-10-20 05:40:04', '2018-10-20 05:40:04'),
(114, 1, 'Wide-Grip Standing Barbell Curl', 8, 2, 'gallery/287_1.jpg', 'gallery/287_2.jpg', 'gallery/indir.png', NULL, 1, NULL, NULL, '2018-10-20 05:40:29', '2018-10-20 05:40:29'),
(115, 1, 'Spider Curl', 8, 2, 'gallery/178_1.jpg', 'gallery/178_2.jpg', 'gallery/indir.png', NULL, 1, NULL, NULL, '2018-10-20 05:40:49', '2018-10-20 05:40:49'),
(116, 1, 'EZ-Bar Curl', 8, 2, 'gallery/210_1.jpg', 'gallery/210_2.jpg', 'gallery/indir.png', NULL, 1, NULL, NULL, '2018-10-20 05:41:18', '2018-10-20 05:41:18'),
(117, 1, 'Hammer Curls', 8, 2, 'gallery/147_1.jpg', 'gallery/147_2.jpg', 'gallery/indir.png', NULL, 1, NULL, NULL, '2018-10-20 05:50:00', '2018-10-20 05:50:00'),
(118, 1, 'Zottman Curl', 8, 2, 'gallery/204_1.jpg', 'gallery/204_2.jpg', 'gallery/indir.png', NULL, 1, NULL, NULL, '2018-10-20 05:50:34', '2018-10-20 05:50:34'),
(119, 1, 'Biceps Curl To Shoulder Press', 8, 2, 'gallery/4101_1.jpg', 'gallery/4101_2.jpg', 'gallery/indir.png', NULL, 1, NULL, NULL, '2018-10-20 05:51:00', '2018-10-20 05:51:00'),
(120, 1, 'Concentration Curls', 8, 2, 'gallery/136_1.jpg', 'gallery/136_2.jpg', 'gallery/indir.png', NULL, 1, NULL, NULL, '2018-10-20 05:51:53', '2018-10-20 05:51:53'),
(121, 1, 'Barbell Curl', 8, 2, 'gallery/169_1.jpg', 'gallery/169_2.jpg', 'gallery/indir.png', NULL, 1, NULL, NULL, '2018-10-20 05:52:17', '2018-10-20 05:52:17'),
(122, 1, 'Overhead Cable Curl', 8, 2, 'gallery/213_1.jpg', 'gallery/213_2.jpg', 'gallery/indir.png', NULL, 1, NULL, NULL, '2018-10-20 05:52:55', '2018-10-20 05:52:55'),
(123, 1, 'Flexor Incline Dumbbell Curls', 8, 2, 'gallery/285_1.jpg', 'gallery/285_2.jpg', 'gallery/indir.png', NULL, 1, NULL, NULL, '2018-10-20 05:53:20', '2018-10-20 05:53:20'),
(124, 1, 'Machine Bicep Curl', 8, 2, 'gallery/899_1.jpg', 'gallery/899_2.jpg', 'gallery/indir.png', NULL, 1, NULL, NULL, '2018-10-20 05:53:41', '2018-10-20 05:53:41'),
(125, 1, 'Dumbbell Bicep Curl', 8, 2, 'gallery/223_1.jpg', 'gallery/223_2.jpg', 'gallery/indir.png', NULL, 1, NULL, NULL, '2018-10-20 05:54:08', '2018-10-20 05:54:08'),
(126, 1, 'Cross Body Hammer Curl', 8, 2, 'gallery/236_1.jpg', 'gallery/236_2.jpg', 'gallery/indir.png', NULL, 1, NULL, NULL, '2018-10-20 05:54:34', '2018-10-20 05:54:34'),
(127, 1, 'Close-Grip EZ Bar Curl', 8, 2, 'gallery/238_1.jpg', 'gallery/238_2.jpg', 'gallery/indir.png', NULL, 1, NULL, NULL, '2018-10-20 05:54:56', '2018-10-20 05:54:56'),
(128, 1, 'T-Bar Row with Handle', 9, 2, 'gallery/1931_1.jpg', 'gallery/1931_2.jpg', 'gallery/indir.png', NULL, 1, NULL, NULL, '2018-10-20 05:59:25', '2018-10-20 05:59:25'),
(130, 1, 'Deficit Deadlift', 9, 2, 'gallery/679_1.jpg', 'gallery/679_2.jpg', 'gallery/indir.png', NULL, 1, NULL, NULL, '2018-10-20 06:00:21', '2018-10-20 06:00:21'),
(131, 1, 'Axle Deadlift', 9, 2, 'gallery/750_1.jpg', 'gallery/750_2.jpg', 'gallery/indir.png', NULL, 1, NULL, NULL, '2018-10-20 06:00:53', '2018-10-20 06:00:53'),
(132, 1, 'Hyperextensions (Back Extensions)', 9, 2, 'gallery/47_1.jpg', 'gallery/47_2.jpg', 'gallery/indir.png', NULL, 1, NULL, NULL, '2018-10-20 06:01:23', '2018-10-20 06:01:23'),
(133, 1, 'One-Arm Long Bar Row', 9, 2, 'gallery/1941_1.jpg', 'gallery/1941_2.jpg', 'gallery/indir.png', NULL, 1, NULL, NULL, '2018-10-20 06:01:51', '2018-10-20 06:01:51'),
(134, 1, 'One-Arm Dumbbell Row', 9, 2, 'gallery/13_1.jpg', 'gallery/13_2.jpg', 'gallery/indir.png', NULL, 1, NULL, NULL, '2018-10-20 06:02:20', '2018-10-20 06:02:20'),
(135, 1, 'Bent Over One-Arm Long Bar Row', 9, 2, 'gallery/19_1.jpg', 'gallery/19_2.jpg', 'gallery/indir.png', NULL, 1, NULL, NULL, '2018-10-20 06:03:05', '2018-10-20 06:03:05'),
(136, 1, 'T-Bar Row', 9, 2, 'gallery/3381_1.jpg', 'gallery/3381_2.jpg', 'gallery/indir.png', NULL, 1, NULL, NULL, '2018-10-20 06:03:32', '2018-10-20 06:03:32'),
(137, 1, 'Bent Over Two-Arm Long Bar Row', 9, 2, 'gallery/19_1.jpg', 'gallery/19_2.jpg', 'gallery/indir.png', NULL, 1, NULL, NULL, '2018-10-20 06:04:01', '2018-10-20 06:04:01'),
(138, 1, 'Hyperextension Bench', 9, 2, 'gallery/24_1.jpg', 'gallery/24_2.jpg', 'gallery/indir.png', NULL, 1, NULL, NULL, '2018-10-20 06:04:45', '2018-10-20 06:04:45'),
(139, 1, 'Dumbbell Incline Row', 9, 2, 'gallery/1311_1.jpg', 'gallery/1311_2.jpg', 'gallery/indir.png', NULL, 1, NULL, NULL, '2018-10-20 06:05:18', '2018-10-20 06:05:18'),
(140, 1, 'Bent Over Two-Dumbbell Row With Palms In', 9, 2, 'gallery/17_1.jpg', 'gallery/17_2.jpg', 'gallery/indir.png', NULL, 1, NULL, NULL, '2018-10-20 06:05:49', '2018-10-20 06:05:49'),
(141, 1, 'Atlas Stones', 9, 2, 'gallery/659_1.jpg', 'gallery/659_2.jpg', 'gallery/indir.png', NULL, 1, NULL, NULL, '2018-10-20 06:07:25', '2018-10-20 06:07:25'),
(142, 1, 'Lying Face Down Plate Neck', 10, 2, 'gallery/25_1.jpg', 'gallery/25_2.jpg', 'gallery/indir.png', NULL, 1, NULL, NULL, '2018-10-20 06:09:31', '2018-10-20 06:09:31'),
(143, 1, 'Lying Face Up Plate Neck', 10, 2, 'gallery/26_1.jpg', 'gallery/26_2.jpg', 'gallery/indir.png', NULL, 1, NULL, NULL, '2018-10-20 06:09:59', '2018-10-20 06:09:59'),
(144, 1, 'Seated Head Harness Neck', 10, 2, 'gallery/29_1.jpg', 'gallery/29_2.jpg', 'gallery/indir.png', NULL, 1, NULL, NULL, '2018-10-20 06:10:33', '2018-10-20 06:10:33'),
(145, 1, 'Isometric Neck Exercise - Sides', 10, 2, 'gallery/28_1.jpg', 'gallery/28_2.jpg', 'gallery/indir.png', NULL, 1, NULL, NULL, '2018-10-20 06:10:57', '2018-10-20 06:10:57'),
(146, 1, 'Neck Bridge Prone', 10, 2, 'gallery/3451_1.jpg', 'gallery/3451_2.jpg', 'gallery/indir.png', NULL, 1, NULL, NULL, '2018-10-20 06:11:33', '2018-10-20 06:11:33'),
(147, 1, 'Side Neck Stretch', 10, 2, 'gallery/447_1.jpg', 'gallery/447_2.jpg', 'gallery/indir.png', NULL, 1, NULL, NULL, '2018-10-20 06:12:10', '2018-10-20 06:12:10'),
(148, 1, 'Chin To Chest Stretch', 10, 2, 'gallery/467_1.jpg', 'gallery/467_2.jpg', 'gallery/indir.png', NULL, 1, NULL, NULL, '2018-10-20 06:12:33', '2018-10-20 06:12:33'),
(149, 1, 'Neck-SMR', 10, 2, 'gallery/628_1.jpg', 'gallery/628_2.jpg', 'gallery/indir.png', NULL, 1, NULL, NULL, '2018-10-20 06:12:58', '2018-10-20 06:12:58'),
(150, 1, 'Single-Leg Press', 11, 2, 'gallery/3941_1.jpg', 'gallery/3941_2.jpg', 'gallery/indir.png', NULL, 1, NULL, NULL, '2018-10-20 06:16:47', '2018-10-20 06:16:47'),
(151, 1, 'Clean from Blocks', 11, 2, 'gallery/746_1.jpg', 'gallery/746_2.jpg', 'gallery/indir.png', NULL, 1, NULL, NULL, '2018-10-20 06:17:09', '2018-10-20 06:17:09'),
(152, 1, 'Barbell Full Squat', 11, 2, 'gallery/64_1.jpg', 'gallery/64_2.jpg', 'gallery/indir.png', NULL, 1, NULL, NULL, '2018-10-20 06:17:28', '2018-10-20 06:17:28'),
(153, 1, 'Tire Flip', 11, 2, 'gallery/725_1.jpg', 'gallery/725_2.jpg', 'gallery/indir.png', NULL, 1, NULL, NULL, '2018-10-20 06:18:07', '2018-10-20 06:18:07'),
(154, 1, 'Hang Clean', 11, 2, 'gallery/187_1.jpg', 'gallery/688_2.jpg', 'gallery/indir.png', NULL, 1, NULL, NULL, '2018-10-20 06:18:25', '2018-10-20 06:18:25'),
(155, 1, 'Box Squat', 11, 2, 'gallery/665_1.jpg', 'gallery/665_2.jpg', 'gallery/indir.png', NULL, 1, NULL, NULL, '2018-10-20 06:19:01', '2018-10-20 06:19:01'),
(156, 1, 'Reverse Band Box Squat', 11, 2, 'gallery/753_1.jpg', 'gallery/753_2.jpg', 'gallery/indir.png', NULL, 1, NULL, NULL, '2018-10-20 06:19:22', '2018-10-20 06:19:22'),
(157, 1, 'Front Squats With Two Kettlebells', 11, 2, 'gallery/511_1.jpg', 'gallery/511_2.jpg', 'gallery/indir.png', NULL, 1, NULL, NULL, '2018-10-20 06:19:50', '2018-10-20 06:19:50'),
(158, 1, 'Single Leg Push-off', 11, 2, 'gallery/818_1.jpg', 'gallery/818_2.jpg', 'gallery/indir.png', NULL, 1, NULL, NULL, '2018-10-20 06:20:09', '2018-10-20 06:20:09'),
(159, 1, 'Rope Jumping', 11, 2, 'gallery/651_1.jpg', 'gallery/651_2.jpg', 'gallery/indir.png', NULL, 1, NULL, NULL, '2018-10-20 06:20:32', '2018-10-20 06:20:32'),
(160, 1, 'Barbell Walking Lunge', 11, 2, 'gallery/2241_1.jpg', 'gallery/2241_2.jpg', 'gallery/indir.png', NULL, 1, NULL, NULL, '2018-10-20 06:20:55', '2018-10-20 06:20:55'),
(161, 1, 'Olympic Squat', 11, 2, 'gallery/700_1.jpg', 'gallery/700_2.jpg', 'gallery/indir.png', NULL, 1, NULL, NULL, '2018-10-20 06:21:22', '2018-10-20 06:21:22'),
(162, 1, 'Kettlebell Pistol Squat', 11, 2, 'gallery/521_1.jpg', 'gallery/521_2.jpg', 'gallery/indir.png', NULL, 1, NULL, NULL, '2018-10-20 06:21:56', '2018-10-20 06:21:56'),
(163, 1, 'Lying Leg Curls', 11, 2, 'gallery/52_1.jpg', 'gallery/52_2.jpg', 'gallery/indir.png', NULL, 1, NULL, NULL, '2018-10-20 06:26:23', '2018-10-20 06:26:23'),
(164, 1, 'Smith Machine Shrug', 12, 2, 'gallery/134_1.jpg', 'gallery/134_2.jpg', 'gallery/indir.png', NULL, 1, NULL, NULL, '2018-10-20 06:27:54', '2018-10-20 06:27:54'),
(165, 1, 'Leverage Shrug', 12, 2, 'gallery/898_1.jpg', 'gallery/898_2.jpg', 'gallery/indir.png', NULL, 1, NULL, NULL, '2018-10-20 06:28:23', '2018-10-20 06:28:23'),
(166, 1, 'Standing Dumbbell Upright Row', 12, 2, 'gallery/368_1.jpg', 'gallery/368_2.jpg', 'gallery/indir.png', NULL, 1, NULL, NULL, '2018-10-20 06:28:47', '2018-10-20 06:28:47'),
(167, 1, 'Kettlebell Sumo High Pull', 12, 2, 'gallery/645_1.jpg', 'gallery/645_2.jpg', 'gallery/indir.png', NULL, 1, NULL, NULL, '2018-10-20 06:29:08', '2018-10-20 06:29:08'),
(168, 1, 'Dumbbell Shrug', 12, 2, 'gallery/96_1.jpg', 'gallery/96_2.jpg', 'gallery/indir.png', NULL, 1, NULL, NULL, '2018-10-20 06:29:31', '2018-10-20 06:29:31'),
(169, 1, 'Calf-Machine Shoulder Shrug', 12, 2, 'gallery/184_1.jpg', 'gallery/184_2.jpg', 'gallery/indir.png', NULL, 1, NULL, NULL, '2018-10-20 06:29:55', '2018-10-20 06:29:55'),
(170, 1, 'Barbell Shrug', 12, 2, 'gallery/97_1.jpg', 'gallery/97_2.jpg', 'gallery/indir.png', NULL, 1, NULL, NULL, '2018-10-20 06:30:18', '2018-10-20 06:30:18'),
(171, 1, 'Upright Cable Row', 12, 2, 'gallery/71_1.jpg', 'gallery/71_2.jpg', 'gallery/indir.png', NULL, 1, NULL, NULL, '2018-10-20 06:31:00', '2018-10-20 06:31:00'),
(172, 1, 'Cable Shrugs', 12, 2, 'gallery/133_1.jpg', 'gallery/133_2.jpg', 'gallery/indir.png', NULL, 1, NULL, NULL, '2018-10-20 06:31:22', '2018-10-20 06:31:22'),
(173, 1, 'Upright Row - With Bands', 12, 2, 'gallery/261_1.jpg', 'gallery/261_2.jpg', 'gallery/indir.png', NULL, 1, NULL, NULL, '2018-10-20 06:31:44', '2018-10-20 06:31:44'),
(174, 1, 'Smith Machine Behind the Back Shrug', 12, 2, 'gallery/2131_1.jpg', 'gallery/2131_2.jpg', 'gallery/indir.png', NULL, 1, NULL, NULL, '2018-10-20 06:32:05', '2018-10-20 06:32:05'),
(175, 1, 'Smith Machine Upright Row', 12, 2, 'gallery/78_1.jpg', 'gallery/78_2.jpg', 'gallery/indir.png', NULL, 1, NULL, NULL, '2018-10-20 06:32:29', '2018-10-20 06:32:29'),
(176, 1, 'Clean Shrug', 12, 2, 'gallery/673_1.jpg', 'gallery/673_2.jpg', 'gallery/indir.png', NULL, 1, NULL, NULL, '2018-10-20 06:32:52', '2018-10-20 06:32:52'),
(177, 1, 'Scapular Pull-Up', 12, 2, 'gallery/1451_1.jpg', 'gallery/1451_2.jpg', 'gallery/indir.png', NULL, 1, NULL, NULL, '2018-10-20 06:33:24', '2018-10-20 06:33:24'),
(178, 1, 'Landmine 180\'s', 13, 2, 'gallery/1751_1.jpg', 'gallery/1751_2.jpg', 'gallery/indir.png', NULL, 1, NULL, NULL, '2018-10-20 06:36:04', '2018-10-20 06:36:04'),
(179, 1, 'Suspended Fallout', 13, 2, 'gallery/2723_1.jpg', 'gallery/2723_2.jpg', 'gallery/indir.png', NULL, 1, NULL, NULL, '2018-10-20 06:36:33', '2018-10-20 06:36:33'),
(180, 1, 'Plank', 13, 2, 'gallery/908_1.jpg', 'gallery/908_2.jpg', 'gallery/indir.png', NULL, 1, NULL, NULL, '2018-10-20 06:36:59', '2018-10-20 06:36:59'),
(181, 1, 'Standing Cable Lift', 13, 2, 'gallery/936_1.jpg', 'gallery/936_2.jpg', 'gallery/indir.png', NULL, 1, NULL, NULL, '2018-10-20 06:37:29', '2018-10-20 06:37:29'),
(182, 1, 'Bottoms Up', 13, 2, 'gallery/2021_1.jpg', 'gallery/2021_2.jpg', 'gallery/indir.png', NULL, 1, NULL, NULL, '2018-10-20 06:37:57', '2018-10-20 06:37:57'),
(183, 1, 'Spell Caster', 13, 2, 'gallery/2041_1.jpg', 'gallery/2041_2.jpg', 'gallery/indir.png', NULL, 1, NULL, NULL, '2018-10-20 06:38:30', '2018-10-20 06:38:30'),
(184, 1, 'Dumbbell V-Sit Cross Jab', 13, 2, 'gallery/4751_1.jpg', 'gallery/4751_2.jpg', 'gallery/indir.png', NULL, 1, NULL, NULL, '2018-10-20 06:39:06', '2018-10-20 06:39:06'),
(185, 1, 'Decline Reverse Crunch', 13, 2, 'gallery/194_1.jpg', 'gallery/194_2.jpg', 'gallery/indir.png', NULL, 1, NULL, NULL, '2018-10-20 06:39:27', '2018-10-20 06:39:27'),
(186, 1, 'Spider Crawl', 13, 2, 'gallery/2061_1.jpg', 'gallery/2061_2.jpg', 'gallery/indir.png', NULL, 1, NULL, NULL, '2018-10-20 06:40:45', '2018-10-20 06:40:45'),
(187, 1, 'Cross-Body Crunch', 13, 2, 'gallery/124_1.jpg', 'gallery/124_2.jpg', 'gallery/indir.png', NULL, 1, NULL, NULL, '2018-10-20 06:41:10', '2018-10-20 06:41:10'),
(188, 1, 'One-Arm Cable Side Bends', 13, 2, 'gallery/933_1.jpg', 'gallery/933_2.jpg', 'gallery/indir.png', NULL, 1, NULL, NULL, '2018-10-20 06:41:51', '2018-10-20 06:41:51'),
(189, 1, 'Elbow to Knee', 13, 2, 'gallery/2031_1 (1).jpg', 'gallery/2031_2 (1).jpg', 'gallery/indir.png', NULL, 1, NULL, NULL, '2018-10-20 06:42:27', '2018-10-20 06:42:27'),
(190, 1, 'Cocoons', 13, 2, 'gallery/2011_1.jpg', 'gallery/2011_2.jpg', 'gallery/indir.png', NULL, 1, NULL, NULL, '2018-10-20 06:42:53', '2018-10-20 06:42:53'),
(191, 1, 'Plate Twist', 13, 2, 'gallery/106_1.jpg', 'gallery/106_2.jpg', 'gallery/indir.png', NULL, 1, NULL, NULL, '2018-10-20 06:43:17', '2018-10-20 06:43:17'),
(192, 1, 'Barbell Glute Bridge', 14, 2, 'gallery/662_1.jpg', 'gallery/662_2.jpg', 'gallery/indir.png', NULL, 1, NULL, NULL, '2018-10-20 06:45:46', '2018-10-20 06:45:46'),
(193, 1, 'Barbell Hip Thrust', 14, 2, 'gallery/661_1.jpg', 'gallery/661_2.jpg', 'gallery/indir.png', NULL, 1, NULL, NULL, '2018-10-20 06:46:18', '2018-10-20 06:46:18'),
(194, 1, 'One-Legged Cable Kickback', 14, 2, 'gallery/101_1.jpg', 'gallery/101_2.jpg', 'gallery/indir.png', NULL, 1, NULL, NULL, '2018-10-20 06:46:40', '2018-10-20 06:46:40'),
(195, 1, 'Butt Lift (Bridge)', 14, 2, 'gallery/99_1.jpg', 'gallery/99_2.jpg', 'gallery/indir.png', NULL, 1, NULL, NULL, '2018-10-20 06:47:01', '2018-10-20 06:47:01'),
(196, 1, 'Single Leg Glute Bridge', 14, 2, 'gallery/915_1.jpg', 'gallery/915_2.jpg', 'gallery/indir.png', NULL, 1, NULL, NULL, '2018-10-20 06:47:27', '2018-10-20 06:47:27'),
(197, 1, 'Step-up with Knee Raise', 14, 2, 'gallery/2251_1.jpg', 'gallery/2251_2.jpg', 'gallery/indir.png', NULL, 1, NULL, NULL, '2018-10-20 06:47:51', '2018-10-20 06:47:51'),
(198, 1, 'Kneeling Squat', 14, 2, 'gallery/697_1.jpg', 'gallery/697_2.jpg', 'gallery/indir.png', NULL, 1, NULL, NULL, '2018-10-20 06:48:18', '2018-10-20 06:48:18'),
(199, 1, 'Glute Kickback', 14, 2, 'gallery/98_1.jpg', 'gallery/98_2.jpg', 'gallery/indir.png', NULL, 1, NULL, NULL, '2018-10-20 06:48:40', '2018-10-20 06:48:40'),
(200, 1, 'Flutter Kicks', 14, 2, 'gallery/267_1.jpg', 'gallery/267_2.jpg', 'gallery/indir.png', NULL, 1, NULL, NULL, '2018-10-20 06:49:03', '2018-10-20 06:49:03'),
(201, 1, 'Physioball Hip Bridge', 14, 2, 'gallery/1111_1.jpg', 'gallery/1111_2.jpg', 'gallery/indir.png', NULL, 1, NULL, NULL, '2018-10-20 06:49:27', '2018-10-20 06:49:27'),
(202, 1, 'Kneeling Jump Squat', 14, 2, 'gallery/749_1.jpg', 'gallery/749_2.jpg', 'gallery/indir.png', NULL, 1, NULL, NULL, '2018-10-20 06:49:51', '2018-10-20 06:49:51'),
(203, 1, 'Pull Through', 14, 2, 'gallery/707_1.jpg', 'gallery/707_2.jpg', 'gallery/indir.png', NULL, 1, NULL, NULL, '2018-10-20 06:50:23', '2018-10-20 06:50:23'),
(204, 1, 'Hip Extension with Bands', 14, 2, 'gallery/877_1.jpg', 'gallery/877_2.jpg', 'gallery/indir.png', NULL, 1, NULL, NULL, '2018-10-20 06:50:46', '2018-10-20 06:50:46'),
(205, 1, 'Leg Lift', 14, 2, 'gallery/100_1.jpg', 'gallery/100_2.jpg', 'gallery/indir.png', NULL, 1, NULL, NULL, '2018-10-20 06:51:50', '2018-10-20 06:51:50');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `egzersiz_kategori`
--

CREATE TABLE `egzersiz_kategori` (
  `id` int(10) UNSIGNED NOT NULL,
  `kategori_ad` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kategori_ust` int(11) NOT NULL DEFAULT '0',
  `resim` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `aktif` int(11) NOT NULL DEFAULT '1',
  `silme_tarihi` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `egzersiz_kategori`
--

INSERT INTO `egzersiz_kategori` (`id`, `kategori_ad`, `kategori_ust`, `resim`, `aktif`, `silme_tarihi`, `created_at`, `updated_at`) VALUES
(1, 'Gögüs', 0, 'gallery/guide-1.gif', 1, NULL, '2018-09-20 12:41:16', '2018-10-22 06:27:22'),
(2, 'Forearms', 0, 'gallery/guide-2.gif', 1, NULL, '2018-09-21 03:58:38', '2018-10-22 06:28:20'),
(3, 'Lats', 0, 'gallery/guide-3.gif', 1, NULL, '2018-09-21 04:01:19', '2018-10-22 06:28:50'),
(5, 'aa', 0, 'gallery/70_1.jpg', 0, '2018-10-20 07:56:57', '2018-09-21 09:37:04', '2018-10-20 04:56:57'),
(6, 'Triceps', 0, 'gallery/guide-10.gif', 1, NULL, '2018-10-20 04:55:04', '2018-10-22 06:29:41'),
(7, 'Shoulders', 0, 'gallery/guide-12.gif', 1, NULL, '2018-10-20 05:19:34', '2018-10-22 06:30:16'),
(8, 'Biceps', 0, 'gallery/guide-15.gif', 1, NULL, '2018-10-20 05:39:43', '2018-10-22 06:31:07'),
(9, 'Back', 0, 'gallery/guide-4.gif', 1, NULL, '2018-10-20 05:58:39', '2018-10-22 06:33:41'),
(10, 'Neck', 0, 'gallery/guide-6.gif', 1, NULL, '2018-10-20 06:07:59', '2018-10-22 06:34:22'),
(11, 'Quadriceps & Leg', 0, 'gallery/guide-7.gif', 1, NULL, '2018-10-20 06:16:16', '2018-10-22 06:34:53'),
(12, 'Traps', 0, 'gallery/guide-11.gif', 1, NULL, '2018-10-20 06:27:35', '2018-10-22 06:35:27'),
(13, 'Abdominals', 0, 'gallery/guide-13.gif', 1, NULL, '2018-10-20 06:34:00', '2018-10-22 06:35:59'),
(14, 'Glutes', 0, 'gallery/guide-14.gif', 1, NULL, '2018-10-20 06:44:58', '2018-10-22 06:36:39');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `eklemler`
--

CREATE TABLE `eklemler` (
  `id` int(10) UNSIGNED NOT NULL,
  `ekleyen_id` int(11) NOT NULL,
  `isim` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ozellikleri` text COLLATE utf8mb4_unicode_ci,
  `resim` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `aktif` int(11) NOT NULL DEFAULT '1',
  `silinme_tarihi` datetime DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `eklemler`
--

INSERT INTO `eklemler` (`id`, `ekleyen_id`, `isim`, `ozellikleri`, `resim`, `aktif`, `silinme_tarihi`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 1, 'eklem 1', 'eklme 1', 'gallery/indir.png', 1, NULL, NULL, '2018-09-21 03:32:53', '2018-09-21 03:32:53');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `hareketler`
--

CREATE TABLE `hareketler` (
  `id` int(10) UNSIGNED NOT NULL,
  `ekleyen_id` int(11) NOT NULL,
  `hareket_isim` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `aktif` int(11) NOT NULL DEFAULT '1',
  `silme_tarihi` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `hareketler`
--

INSERT INTO `hareketler` (`id`, `ekleyen_id`, `hareket_isim`, `aktif`, `silme_tarihi`, `created_at`, `updated_at`) VALUES
(1, 1, 'kol', 1, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `hareketolustur`
--

CREATE TABLE `hareketolustur` (
  `id` int(10) UNSIGNED NOT NULL,
  `ekleyen_id` int(11) NOT NULL,
  `baslik` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `resim` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Aaos` double DEFAULT NULL,
  `Ama` double DEFAULT NULL,
  `KendalMcreacy` double DEFAULT NULL,
  `bolge` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `eklem` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hareket` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ozellikleri` text COLLATE utf8mb4_unicode_ci,
  `aktif` int(11) NOT NULL DEFAULT '1',
  `silme_tarihi` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `hareketolustur`
--

INSERT INTO `hareketolustur` (`id`, `ekleyen_id`, `baslik`, `resim`, `Aaos`, `Ama`, `KendalMcreacy`, `bolge`, `eklem`, `hareket`, `ozellikleri`, `aktif`, `silme_tarihi`, `created_at`, `updated_at`) VALUES
(2, 1, 'Hareket olustur 1', 'gallery/indir.png', 12, 12, 12, '1', '1', '1', 'dfdfdf', 1, NULL, '2018-09-21 03:33:41', '2018-09-21 03:33:41');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `hareketturu`
--

CREATE TABLE `hareketturu` (
  `id` int(10) UNSIGNED NOT NULL,
  `ekleyen_id` int(11) NOT NULL,
  `isim` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hareketturu` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `aktif` int(11) NOT NULL DEFAULT '1',
  `silme_tarihi` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `hareketturu`
--

INSERT INTO `hareketturu` (`id`, `ekleyen_id`, `isim`, `hareketturu`, `aktif`, `silme_tarihi`, `created_at`, `updated_at`) VALUES
(1, 1, 'Harekt 1', 'acma', 1, NULL, '2018-09-21 03:33:06', '2018-09-21 03:33:06');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `hasta`
--

CREATE TABLE `hasta` (
  `id` int(10) UNSIGNED NOT NULL,
  `ekleyen_id` int(11) NOT NULL,
  `hasta_resim` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hasta_ad` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hasta_soyad` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hasta_telefon` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hasta_eposta` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hasta_sifre` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hasta_babaadi` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hasta_anneadi` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hasta_tc` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hasta_dogumyeri` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hasta_dogumtarihi` date DEFAULT NULL,
  `hasta_cinsiyet` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hasta_medenihali` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hasta_kangurubu` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hasta_ulke` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hasta_il` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hasta_ilce` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hasta_acikadress` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kurum_id` int(11) NOT NULL,
  `aktif` int(11) NOT NULL DEFAULT '1',
  `silme_tarihi` datetime DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `hasta`
--

INSERT INTO `hasta` (`id`, `ekleyen_id`, `hasta_resim`, `hasta_ad`, `hasta_soyad`, `hasta_telefon`, `hasta_eposta`, `hasta_sifre`, `hasta_babaadi`, `hasta_anneadi`, `hasta_tc`, `hasta_dogumyeri`, `hasta_dogumtarihi`, `hasta_cinsiyet`, `hasta_medenihali`, `hasta_kangurubu`, `hasta_ulke`, `hasta_il`, `hasta_ilce`, `hasta_acikadress`, `kurum_id`, `aktif`, `silme_tarihi`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 4, NULL, 'Hasta bir', 'hasta soyad', '0 (545) 789-45-12', 'hasta@gmail.com', '$2y$10$y/c4sQvf4rr2TqaMKzS6VOipsEDymlGqHNZO3egfYR7ZTkAOzFtkC', NULL, NULL, NULL, NULL, NULL, 'NULL', 'NULL', 'NULL', NULL, NULL, NULL, NULL, 1, 1, NULL, NULL, '2018-09-21 04:07:27', '2018-09-21 04:07:27');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `hastaliklar`
--

CREATE TABLE `hastaliklar` (
  `id` int(10) UNSIGNED NOT NULL,
  `ekleyen_id` int(11) NOT NULL,
  `hastalik_isim` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hastalik_kategori` int(11) NOT NULL,
  `aktif` int(11) NOT NULL DEFAULT '1',
  `silme_tarihi` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `hastaliklar`
--

INSERT INTO `hastaliklar` (`id`, `ekleyen_id`, `hastalik_isim`, `hastalik_kategori`, `aktif`, `silme_tarihi`, `created_at`, `updated_at`) VALUES
(1, 1, 'kasılma', 1, 1, NULL, '2018-09-21 03:33:59', '2018-09-21 03:33:59');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `hastalik_hareket`
--

CREATE TABLE `hastalik_hareket` (
  `id` int(10) UNSIGNED NOT NULL,
  `hastalik_id` int(11) NOT NULL,
  `hareket_id` int(11) NOT NULL,
  `aktif` int(11) NOT NULL DEFAULT '1',
  `silme_tarihi` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `hastalik_hareket`
--

INSERT INTO `hastalik_hareket` (`id`, `hastalik_id`, `hareket_id`, `aktif`, `silme_tarihi`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 1, NULL, '2018-09-21 03:34:00', '2018-09-21 03:34:00');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `hazirplanlar`
--

CREATE TABLE `hazirplanlar` (
  `id` int(10) UNSIGNED NOT NULL,
  `ekleyen_id` int(11) NOT NULL,
  `plan_ismi` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `egzersiz_isim` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `set` int(11) DEFAULT NULL,
  `tekrar` int(11) DEFAULT NULL,
  `dinlenme` int(11) DEFAULT NULL,
  `haftalik_tekrar` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gunluk_tekrar` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kurum_id` int(11) DEFAULT NULL,
  `aktif` int(11) NOT NULL DEFAULT '1',
  `silinme_tarihi` datetime DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `hazirplanlar`
--

INSERT INTO `hazirplanlar` (`id`, `ekleyen_id`, `plan_ismi`, `egzersiz_isim`, `set`, `tekrar`, `dinlenme`, `haftalik_tekrar`, `gunluk_tekrar`, `kurum_id`, `aktif`, `silinme_tarihi`, `remember_token`, `created_at`, `updated_at`) VALUES
(33, 4, 'aaa', 'Dumbbell Bench Press', 3, 2, 2, 'Haftada 1', 'Günde 2', 1, 0, '2018-10-22 15:39:13', NULL, '2018-10-22 12:20:46', '2018-10-22 12:39:13'),
(34, 4, 'Hasta bire program bir', 'Dumbbell Bench Press', 3, 2, 2, 'Haftada 1', 'Günde 1', 1, 0, '2018-10-23 07:04:37', NULL, '2018-10-22 12:34:28', '2018-10-23 04:04:37'),
(35, 4, 'aaa', 'Dumbbell Bench Press', 3, 2, 2, 'Haftada 1', 'Günde 2', 1, 1, NULL, NULL, '2018-10-22 12:39:17', '2018-10-22 12:39:17'),
(36, 4, 'aaa', 'Incline Dumbbell Press', 2, 2, 2, 'Haftada 1', 'Günde 2', 1, 1, NULL, NULL, '2018-10-22 12:39:17', '2018-10-22 12:39:17'),
(37, 4, 'Hasta bire program bir', 'Dumbbell Bench Press', 1, 1, 1, 'Haftada 2', 'Günde 1', 1, 0, '2018-10-23 07:04:37', NULL, '2018-10-22 12:56:15', '2018-10-23 04:04:37'),
(38, 4, 'Hasta bire program bir', 'Dumbbell Bench Press', 1, 1, 1, 'Haftada 2', 'Günde 1', 1, 1, NULL, NULL, '2018-10-23 04:04:40', '2018-10-23 04:04:40');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kategoriler`
--

CREATE TABLE `kategoriler` (
  `id` int(10) UNSIGNED NOT NULL,
  `kategori_ad` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kategori_ust` int(11) NOT NULL DEFAULT '0',
  `aktif` int(11) NOT NULL DEFAULT '1',
  `silme_tarihi` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `kategoriler`
--

INSERT INTO `kategoriler` (`id`, `kategori_ad`, `kategori_ust`, `aktif`, `silme_tarihi`, `created_at`, `updated_at`) VALUES
(1, 'Kategrori 1', 0, 1, NULL, '2018-09-21 03:32:25', '2018-09-21 03:32:25');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kurumlar`
--

CREATE TABLE `kurumlar` (
  `id` int(10) UNSIGNED NOT NULL,
  `ekleyen_id` int(11) NOT NULL,
  `kurum_resim` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kurum_arayanad` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kurum_arayansoyad` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kurum_arayantelefon` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kurum_arayaneposta` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kurum_arayansifre` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kurum_adi` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kurum_yetkiliadi` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kurum_yetkilinumara` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kurum_vergidairesi` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kurum_verginumarasi` int(11) DEFAULT NULL,
  `kurum_yetkilicinsiyet` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kurum_ulke` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kurum_il` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kurum_ilce` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kurum_acikadress` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `aktif` int(11) NOT NULL DEFAULT '1',
  `silme_tarihi` datetime DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `kurumlar`
--

INSERT INTO `kurumlar` (`id`, `ekleyen_id`, `kurum_resim`, `kurum_arayanad`, `kurum_arayansoyad`, `kurum_arayantelefon`, `kurum_arayaneposta`, `kurum_arayansifre`, `kurum_adi`, `kurum_yetkiliadi`, `kurum_yetkilinumara`, `kurum_vergidairesi`, `kurum_verginumarasi`, `kurum_yetkilicinsiyet`, `kurum_ulke`, `kurum_il`, `kurum_ilce`, `kurum_acikadress`, `aktif`, `silme_tarihi`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, 'Kurum ad', 'Kurum soyad', '0 (548) 569-85-45', 'kurum1@gmail.com', '$2y$10$8a3DjfG51GQYy3RH82IkxeQXZhHFKqt.274qIwlhgBFt1Gs7xVGqC', NULL, NULL, NULL, NULL, NULL, 'NULL', NULL, NULL, NULL, 'value=\"\"', 1, NULL, NULL, '2018-09-21 04:03:57', '2018-09-21 04:04:51');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2018_01_29_080425_create_bolgeler_tabla', 1),
(4, '2018_01_29_083311_create_eklemler_create', 1),
(5, '2018_01_29_084910_create_hareketturu_table', 1),
(6, '2018_01_29_101136_create_hareketolustur_table', 1),
(7, '2018_02_04_132233_create_hastaliklar_table', 1),
(8, '2018_02_04_133006_create_hareketler_table', 1),
(9, '2018_02_04_133251_create_hastalik_hareket_table', 1),
(10, '2018_02_15_141456_create_kategoriler_table', 1),
(11, '2018_02_22_134145_create_egzersiz_kategori_table', 1),
(12, '2018_02_23_072919_create_egzersiz_table', 1),
(13, '2018_03_02_143023_create_setler_table', 1),
(14, '2018_03_09_123358_create_hasta_table', 1),
(15, '2018_04_13_120359_create_setyorum_table', 1),
(16, '2018_04_13_130658_create_kurumlar_table', 1),
(17, '2018_04_28_080945_create_hazirplanlar_table', 1),
(18, '2018_06_07_081305_create_bildirimler_table', 1),
(19, '2018_06_07_125711_create_plantablosu_table', 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `plantablosu`
--

CREATE TABLE `plantablosu` (
  `id` int(10) UNSIGNED NOT NULL,
  `ekleyen_id` int(11) NOT NULL,
  `hasta_id` int(11) NOT NULL,
  `baslangic_tarihi` date DEFAULT NULL,
  `bitis_tarihi` date DEFAULT NULL,
  `program_adi` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `plan_numarasi` int(11) NOT NULL,
  `egzersiz_isim` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `haftalik_tekrar` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `set` int(3) DEFAULT NULL,
  `tekrar` int(3) DEFAULT NULL,
  `dinlenme` int(5) DEFAULT NULL,
  `pazartesi` enum('0','1') COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `sali` enum('0','1') COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `carsamba` enum('0','1') COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `persembe` enum('0','1') COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `cuma` enum('0','1') COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `cumartesi` enum('0','1') COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `pazar` enum('0','1') COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `plan_durum` enum('0','1') COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `aktif` int(11) NOT NULL DEFAULT '1',
  `silinme_tarihi` datetime DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `plantablosu`
--

INSERT INTO `plantablosu` (`id`, `ekleyen_id`, `hasta_id`, `baslangic_tarihi`, `bitis_tarihi`, `program_adi`, `plan_numarasi`, `egzersiz_isim`, `haftalik_tekrar`, `set`, `tekrar`, `dinlenme`, `pazartesi`, `sali`, `carsamba`, `persembe`, `cuma`, `cumartesi`, `pazar`, `plan_durum`, `aktif`, `silinme_tarihi`, `remember_token`, `created_at`, `updated_at`) VALUES
(82, 4, 1, '2018-10-19', '2018-10-18', 'Hasta bire program bir', 1, 'Dumbbell Bench Press', 'Haftada 2', 1, 1, 1, '1', '0', '1', '0', '0', '0', '0', '1', 1, NULL, NULL, '2018-10-23 10:53:53', '2018-10-23 10:54:16');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `setler`
--

CREATE TABLE `setler` (
  `id` int(10) UNSIGNED NOT NULL,
  `ekleyen_id` int(11) NOT NULL,
  `hasta_id` int(11) NOT NULL,
  `baslangic_tarihi` date DEFAULT NULL,
  `bitis_tarihi` date DEFAULT NULL,
  `program_adi` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `egzersiz_isim` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `set` int(11) DEFAULT NULL,
  `tekrar` int(11) DEFAULT NULL,
  `dinlenme` int(11) DEFAULT NULL,
  `haftalik_tekrar` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gunluk_tekrar` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `plan_sayisi` int(11) DEFAULT NULL,
  `aktif` int(11) NOT NULL DEFAULT '1',
  `silinme_tarihi` datetime DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `setler`
--

INSERT INTO `setler` (`id`, `ekleyen_id`, `hasta_id`, `baslangic_tarihi`, `bitis_tarihi`, `program_adi`, `egzersiz_isim`, `set`, `tekrar`, `dinlenme`, `haftalik_tekrar`, `gunluk_tekrar`, `plan_sayisi`, `aktif`, `silinme_tarihi`, `remember_token`, `created_at`, `updated_at`) VALUES
(83, 4, 1, '2018-10-19', '2018-10-18', 'Hasta bire program bir', 'Dumbbell Bench Press', 1, 1, 1, 'Haftada 2', 'Günde 1', 1, 1, NULL, NULL, '2018-10-23 10:53:53', '2018-10-23 10:53:53');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `setyorum`
--

CREATE TABLE `setyorum` (
  `id` int(10) UNSIGNED NOT NULL,
  `ekleyen_id` int(11) NOT NULL,
  `hasta_id` int(11) NOT NULL,
  `yorum` text COLLATE utf8mb4_unicode_ci,
  `plan_sayisi` int(11) DEFAULT NULL,
  `aktif` int(11) NOT NULL DEFAULT '1',
  `silme_tarihi` datetime DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `setyorum`
--

INSERT INTO `setyorum` (`id`, `ekleyen_id`, `hasta_id`, `yorum`, `plan_sayisi`, `aktif`, `silme_tarihi`, `remember_token`, `created_at`, `updated_at`) VALUES
(29, 4, 1, 'hasta planı ugularken yapması gerekneler', 1, 1, NULL, NULL, '2018-10-23 04:18:08', '2018-10-23 04:18:08'),
(30, 4, 1, NULL, 1, 1, NULL, NULL, '2018-10-23 10:53:53', '2018-10-23 10:53:53');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `yetki` int(11) DEFAULT '1',
  `onay` int(11) DEFAULT '0',
  `hasta_id` int(11) DEFAULT NULL,
  `kurum_id` int(11) DEFAULT NULL,
  `aktif` int(11) NOT NULL DEFAULT '1',
  `silme_tarihi` datetime DEFAULT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `yetki`, `onay`, `hasta_id`, `kurum_id`, `aktif`, `silme_tarihi`, `token`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'veysel', 'veyselakpinar13@gmail.com', '$2y$10$Optl8rZIrQI42zYrKzaP7.tvjDYhyHN5FfeZjFx3MdJvyj.wbuuPW', 1, 1, NULL, NULL, 1, NULL, NULL, 'hjCpxKTVJuGEWkpfIIjiijMnoq23XDxJWAsW1xJMwaehtl2VQjFTwVEk54zC', NULL, NULL),
(2, 'admin', 'veyselakpinar134@gmail.com', '$2y$10$Optl8rZIrQI42zYrKzaP7.tvjDYhyHN5FfeZjFx3MdJvyj.wbuuPW', 1, 0, NULL, NULL, 1, NULL, NULL, 'KfalENruYlgta3wRFmHZdxMIP0eEtUu5sYheYdBeW5zOxr110QFWOc8ZeW0h', '2018-09-20 12:37:45', '2018-09-20 12:37:45'),
(3, 'Kurum ad', 'kurum1@gmail.com', '$2y$10$4kxyw5omBdKYb9FgFEU5C.LhjulAItHyUFne3WFc7POUACs0ksnFy', 88, 1, NULL, 1, 1, NULL, NULL, 'QB7dhdwK66saSTY2AADbnUau81Mby6zTh5HlFBRw5i3H5DMhwCecyYNxb4wx', '2018-09-21 04:03:57', '2018-09-21 04:03:57'),
(4, 'Aysegül', 'ayse@gmail.com', '$2y$10$mpZDCpcqdrcyvkjWSRG7tOxzWD.Ls.UBeCLAN/85TCzAop6tJ0BbC', 2, 1, NULL, 1, 1, NULL, NULL, 'qm6d7uWxkabamR3KZhl8AfdCafs9sZwqElU8qZ2g302U35qgZkcvlRG0KI8a', '2018-09-21 04:06:17', '2018-09-21 04:06:31'),
(5, 'Hasta bir', 'hasta@gmail.com', '$2y$10$z0QmpN94RYJJMeEFyc9Nn..oXXQwWgFV20aoxoJGRc09vK0DB4cHC', 4, 1, 1, NULL, 1, NULL, NULL, 'Lct40nTahkbGZm12ssTuN44ka1fslNxS1Fwj2N7y2gfhsPw7CMONi4GaQq3G', '2018-09-21 04:07:27', '2018-09-21 04:07:27'),
(6, 'Turkmen', 'turkmen12345@gmail.com', '$2y$10$rP6dpbTnM2p74TzxFRmCU.JwwfnVzfMD6gct75XLp6NcH45BPkT6G', 1, 1, NULL, NULL, 1, NULL, NULL, NULL, '2018-09-21 04:07:27', '2018-09-21 04:07:27');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `bildirimler`
--
ALTER TABLE `bildirimler`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `bolgeler`
--
ALTER TABLE `bolgeler`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `egzersiz`
--
ALTER TABLE `egzersiz`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `egzersiz_kategori`
--
ALTER TABLE `egzersiz_kategori`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `eklemler`
--
ALTER TABLE `eklemler`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `hareketler`
--
ALTER TABLE `hareketler`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `hareketolustur`
--
ALTER TABLE `hareketolustur`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `hareketturu`
--
ALTER TABLE `hareketturu`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `hasta`
--
ALTER TABLE `hasta`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `hastaliklar`
--
ALTER TABLE `hastaliklar`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `hastalik_hareket`
--
ALTER TABLE `hastalik_hareket`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `hazirplanlar`
--
ALTER TABLE `hazirplanlar`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `kategoriler`
--
ALTER TABLE `kategoriler`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `kurumlar`
--
ALTER TABLE `kurumlar`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Tablo için indeksler `plantablosu`
--
ALTER TABLE `plantablosu`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `setler`
--
ALTER TABLE `setler`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `setyorum`
--
ALTER TABLE `setyorum`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `bildirimler`
--
ALTER TABLE `bildirimler`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
--
-- Tablo için AUTO_INCREMENT değeri `bolgeler`
--
ALTER TABLE `bolgeler`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Tablo için AUTO_INCREMENT değeri `egzersiz`
--
ALTER TABLE `egzersiz`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=206;
--
-- Tablo için AUTO_INCREMENT değeri `egzersiz_kategori`
--
ALTER TABLE `egzersiz_kategori`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- Tablo için AUTO_INCREMENT değeri `eklemler`
--
ALTER TABLE `eklemler`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Tablo için AUTO_INCREMENT değeri `hareketler`
--
ALTER TABLE `hareketler`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Tablo için AUTO_INCREMENT değeri `hareketolustur`
--
ALTER TABLE `hareketolustur`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Tablo için AUTO_INCREMENT değeri `hareketturu`
--
ALTER TABLE `hareketturu`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Tablo için AUTO_INCREMENT değeri `hasta`
--
ALTER TABLE `hasta`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Tablo için AUTO_INCREMENT değeri `hastaliklar`
--
ALTER TABLE `hastaliklar`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Tablo için AUTO_INCREMENT değeri `hastalik_hareket`
--
ALTER TABLE `hastalik_hareket`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Tablo için AUTO_INCREMENT değeri `hazirplanlar`
--
ALTER TABLE `hazirplanlar`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
--
-- Tablo için AUTO_INCREMENT değeri `kategoriler`
--
ALTER TABLE `kategoriler`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Tablo için AUTO_INCREMENT değeri `kurumlar`
--
ALTER TABLE `kurumlar`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Tablo için AUTO_INCREMENT değeri `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- Tablo için AUTO_INCREMENT değeri `plantablosu`
--
ALTER TABLE `plantablosu`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;
--
-- Tablo için AUTO_INCREMENT değeri `setler`
--
ALTER TABLE `setler`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;
--
-- Tablo için AUTO_INCREMENT değeri `setyorum`
--
ALTER TABLE `setyorum`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
--
-- Tablo için AUTO_INCREMENT değeri `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
