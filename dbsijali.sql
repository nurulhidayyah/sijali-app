-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 20, 2023 at 07:10 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbsijali`
--

-- --------------------------------------------------------

--
-- Table structure for table `pengaduan`
--

CREATE TABLE `pengaduan` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `created_at` int(11) NOT NULL,
  `bukti` varchar(255) DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  `kategori_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pengaduan`
--

INSERT INTO `pengaduan` (`id`, `user_id`, `title`, `body`, `created_at`, `bukti`, `status`, `kategori_id`) VALUES
(1, 2, 'Fasilitas', 'Ac rusak panas euy!!', 1689810770, '488-1000x500-grayscale.jpg', 4, 2),
(2, 2, 'Test', 'Nyobanyoba', 1689811161, '488-1000x500-grayscale1.jpg', 2, 1),
(3, 2, 'Sekali Lagi', 'dasdada', 1689811728, '488-1000x500-grayscale2.jpg', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `id` int(11) NOT NULL,
  `staff` varchar(255) NOT NULL,
  `kategori` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `role_id` int(11) NOT NULL,
  `date_created` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`id`, `staff`, `kategori`, `email`, `password`, `image`, `role_id`, `date_created`) VALUES
(1, 'UPT Kemahasiswaan', 'Kemahasiswaan', 'kemahasiswaan@gmail.com', '$2y$10$sFcN/KUhaVS8KVyCb8BcZ.Qlm5oVmNhdgsZuoxCg0gxGp4D110.cy', 'default.jpg', 3, '1689810517'),
(2, 'UPT Sarana Prasarana', 'Sarana dan Prasarana', 'sarpras@gmail.com', '$2y$10$OEeFK0IJuuyOPT4yATp9qO63et/diQ2lvk2aPudwkrzowz8yRiXnS', 'default.jpg', 3, '1689810840');

-- --------------------------------------------------------

--
-- Table structure for table `tanggapan`
--

CREATE TABLE `tanggapan` (
  `id` int(11) NOT NULL,
  `pengaduan_id` int(11) NOT NULL,
  `tanggapan` text DEFAULT NULL,
  `tanggal` varchar(255) NOT NULL,
  `kategori_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tanggapan`
--

INSERT INTO `tanggapan` (`id`, `pengaduan_id`, `tanggapan`, `tanggal`, `kategori_id`) VALUES
(1, 1, 'Oke siap', '1689811133', 2),
(2, 2, 'jangan nyobanyoba', '1689811293', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `npm` varchar(255) NOT NULL,
  `email` varchar(128) NOT NULL,
  `image` varchar(128) DEFAULT NULL,
  `password` varchar(256) NOT NULL,
  `role_id` int(11) NOT NULL,
  `is_active` int(1) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `npm`, `email`, `image`, `password`, `role_id`, `is_active`, `date_created`) VALUES
(1, 'Admin', '1', 'admin@gmail.com', 'default.jpg', '$2y$10$0JmWxeGoMIeHLjni1pzH5.1zJFKeuA.ZRa4V7upTRHNE3ziE6jrY2', 1, 1, 1689810438),
(2, 'Nurul Hidayah', '1101191095', 'nurulhidayyah45@gmail.com', 'default.jpg', '$2y$10$pKkCBxu/t5XSodFTmWYEt.rrV3mhtVVP0iXn8hBJ6YqJQxyphCPAy', 2, 1, 1689810572);

-- --------------------------------------------------------

--
-- Table structure for table `user_access_menu`
--

CREATE TABLE `user_access_menu` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `user_access_menu`
--

INSERT INTO `user_access_menu` (`id`, `role_id`, `menu_id`) VALUES
(1, 1, 1),
(3, 1, 3),
(4, 2, 2),
(11, 1, 6),
(12, 2, 6),
(13, 3, 5),
(14, 3, 6);

-- --------------------------------------------------------

--
-- Table structure for table `user_activated`
--

CREATE TABLE `user_activated` (
  `id` int(11) NOT NULL,
  `status` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_activated`
--

INSERT INTO `user_activated` (`id`, `status`) VALUES
(0, 'Not Activated'),
(1, 'Activated');

-- --------------------------------------------------------

--
-- Table structure for table `user_menu`
--

CREATE TABLE `user_menu` (
  `id` int(11) NOT NULL,
  `menu` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `user_menu`
--

INSERT INTO `user_menu` (`id`, `menu`) VALUES
(1, 'admin'),
(2, 'user'),
(3, 'menu'),
(5, 'staff'),
(6, 'setting');

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `id` int(11) NOT NULL,
  `role` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`id`, `role`) VALUES
(1, 'Administrator'),
(2, 'Member'),
(3, 'Staff');

-- --------------------------------------------------------

--
-- Table structure for table `user_sub_menu`
--

CREATE TABLE `user_sub_menu` (
  `id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `title` varchar(128) NOT NULL,
  `url` varchar(128) NOT NULL,
  `icon` varchar(128) NOT NULL,
  `is_active` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `user_sub_menu`
--

INSERT INTO `user_sub_menu` (`id`, `menu_id`, `title`, `url`, `icon`, `is_active`) VALUES
(1, 1, 'Dashboard', 'admin', 'fas fa-tachometer-alt', 1),
(2, 1, 'Role', 'admin/role', 'fas fa-fw fa-user-tie', 1),
(3, 1, 'Users', 'admin/users', 'fas fa-users', 1),
(4, 3, 'Menu Management', 'menu', 'fas fa-fw fa-folder', 1),
(5, 3, 'Submenu Management', 'menu/submenu', 'fas fa-fw fa-folder-open', 1),
(6, 6, 'My Profile', 'setting', 'fas fa-fw fa-user', 1),
(7, 6, 'Edit Profile', 'setting/edit', 'fas fa-fw fa-user-edit', 1),
(8, 6, 'Change Password', 'setting/changePassword', 'fas fa-fw fa-key', 1),
(9, 2, 'Dashboard User', 'user', 'fas fa-fw fa-tachometer-alt', 1),
(10, 2, 'Pengaduan', 'user/pengaduan', 'fas fa-envelope', 1),
(12, 1, 'Staff', 'admin/staffs', 'fas fa-user-cog', 1),
(13, 1, 'Pengaduan Masuk', 'admin/pengaduan', 'fas fa-envelope-open-text\r\n', 1),
(14, 5, 'Dashboard Staff', 'staff', 'fas fa-fw fa-tachometer-alt', 1),
(15, 5, 'Pengaduan Masuk (Staff)', 'staff/pengaduan', 'fas fa-envelope-open-text', 1),
(16, 5, 'Pengaduan Proses (Staff)', 'staff/pengaduanproses', 'fas fa-microchip', 1),
(17, 5, 'Pengaduan Ditolak (Staff)', 'staff/pengaduanditolak', 'fas fa-user-times', 1),
(18, 1, 'Laporan', 'admin/laporan', 'fas fa-file-pdf', 1),
(19, 5, 'Pengaduan Selesai (Staff)', 'staff/pengaduanselesai', 'fas fa-check-square', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_token`
--

CREATE TABLE `user_token` (
  `id` int(11) NOT NULL,
  `email` varchar(128) NOT NULL,
  `token` varchar(128) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pengaduan`
--
ALTER TABLE `pengaduan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tanggapan`
--
ALTER TABLE `tanggapan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_access_menu`
--
ALTER TABLE `user_access_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_activated`
--
ALTER TABLE `user_activated`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_menu`
--
ALTER TABLE `user_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_token`
--
ALTER TABLE `user_token`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pengaduan`
--
ALTER TABLE `pengaduan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tanggapan`
--
ALTER TABLE `tanggapan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_access_menu`
--
ALTER TABLE `user_access_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `user_activated`
--
ALTER TABLE `user_activated`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_menu`
--
ALTER TABLE `user_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `user_token`
--
ALTER TABLE `user_token`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
