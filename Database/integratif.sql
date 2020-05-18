SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

CREATE TABLE `jenis_sumbangan` (
  `id` int(50) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `jenis_sumbangan` (`id`, `name`) VALUES
(1, 'APD'),
(2, 'Indomie (Seleraku)'),
(3, 'Masker'),
(4, 'Obat'),
(5, 'Uang');

CREATE TABLE `sumbangan` (
  `id` int(50) NOT NULL,
  `userid` int(50) NOT NULL,
  `jenis` int(10) NOT NULL,
  `jumlah` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `sumbangan` (`id`, `userid`, `jenis`, `jumlah`) VALUES
(1, 1, 2, 25),
(2, 1, 3, 26),
(3, 2, 1, 100),
(4, 3, 4, 2),
(5, 1, 2, 20),
(6, 3, 5, 100000);

CREATE TABLE `user` (
  `id` int(50) NOT NULL,
  `name` varchar(255) NOT NULL,
  `gender` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `user` (`id`, `name`, `gender`) VALUES
(1, 'Robby Irvine Surya', 0),
(2, 'Megumin', 1),
(3, 'Hououin Kyouma', 0);

ALTER TABLE `jenis_sumbangan`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `sumbangan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jenis` (`jenis`),
  ADD KEY `userid` (`userid`);

ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `jenis_sumbangan`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

ALTER TABLE `sumbangan`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

ALTER TABLE `user`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

ALTER TABLE `sumbangan`
  ADD CONSTRAINT `sumbangan_ibfk_1` FOREIGN KEY (`jenis`) REFERENCES `jenis_sumbangan` (`id`),
  ADD CONSTRAINT `sumbangan_ibfk_2` FOREIGN KEY (`userid`) REFERENCES `user` (`id`);
COMMIT;