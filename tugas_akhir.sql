-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 12, 2015 at 06:47 AM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `tugas_akhir`
--

DELIMITER $$
--
-- Functions
--
CREATE DEFINER=`root`@`localhost` FUNCTION `levenshtein`( s1 VARCHAR(255), s2 VARCHAR(255) ) RETURNS int(11)
    DETERMINISTIC
BEGIN 
    DECLARE s1_len, s2_len, i, j, c, c_temp, cost INT; 
    DECLARE s1_char CHAR; 
    -- max strlen=255 
    DECLARE cv0, cv1 VARBINARY(256); 
    SET s1_len = CHAR_LENGTH(s1), s2_len = CHAR_LENGTH(s2), cv1 = 0x00, j = 1, i = 1, c = 0; 
    IF s1 = s2 THEN 
      RETURN 0; 
    ELSEIF s1_len = 0 THEN 
      RETURN s2_len; 
    ELSEIF s2_len = 0 THEN 
      RETURN s1_len; 
    ELSE 
      WHILE j <= s2_len DO 
        SET cv1 = CONCAT(cv1, UNHEX(HEX(j))), j = j + 1; 
      END WHILE; 
      WHILE i <= s1_len DO 
        SET s1_char = SUBSTRING(s1, i, 1), c = i, cv0 = UNHEX(HEX(i)), j = 1; 
        WHILE j <= s2_len DO 
          SET c = c + 1; 
          IF s1_char = SUBSTRING(s2, j, 1) THEN  
            SET cost = 0; ELSE SET cost = 1; 
          END IF; 
          SET c_temp = CONV(HEX(SUBSTRING(cv1, j, 1)), 16, 10) + cost; 
          IF c > c_temp THEN SET c = c_temp; END IF; 
          SET c_temp = CONV(HEX(SUBSTRING(cv1, j+1, 1)), 16, 10) + 1; 
          IF c > c_temp THEN  
            SET c = c_temp;  
          END IF; 
          SET cv0 = CONCAT(cv0, UNHEX(HEX(c))), j = j + 1; 
        END WHILE; 
        SET cv1 = cv0, i = i + 1; 
      END WHILE; 
    END IF; 
    RETURN c; 
  END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `levenshtein_ratio`( s1 VARCHAR(255), s2 VARCHAR(255) ) RETURNS int(11)
    DETERMINISTIC
BEGIN
    DECLARE s1_len, s2_len, max_len INT;
    SET s1_len = LENGTH(s1), s2_len = LENGTH(s2);
    IF s1_len > s2_len THEN 
      SET max_len = s1_len; 
    ELSE 
      SET max_len = s2_len; 
    END IF;
    RETURN ROUND((1 - LEVENSHTEIN(s1, s2) / max_len) * 100);
  END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `data_ta`
--

CREATE TABLE IF NOT EXISTS `data_ta` (
  `nim` bigint(13) NOT NULL,
  `penulis` varchar(50) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `pembimbing_1` varchar(50) NOT NULL,
  `pembimbing_2` varchar(50) DEFAULT NULL,
  `penguji_1` varchar(50) NOT NULL,
  `penguji_2` varchar(50) NOT NULL,
  `sidang` date NOT NULL,
  `wisuda` varchar(20) NOT NULL,
  `file` varchar(100) NOT NULL,
  PRIMARY KEY (`nim`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data_ta`
--

INSERT INTO `data_ta` (`nim`, `penulis`, `judul`, `pembimbing_1`, `pembimbing_2`, `penguji_1`, `penguji_2`, `sidang`, `wisuda`, `file`) VALUES
(10653004459, 'ZAHIRSYAH', 'PENERAPAN SERVICE ORIENTED ARCHITECTURE (SOA) PADA WEB IKLAN', 'Syaifullah, SE, M.Sc', '', 'Eki Saputra, S.Kom, M.Kom', 'Syahtriatna,S.Kom, M.Kom', '2013-07-01', 'Februari 2014', 'Zahirsyah - 10653004459.pdf'),
(10753000283, 'KHAIRUNNAS', 'PENGARUH PENERAPAN SISTEM INFORMASI LOGISTIK (SIL) TERHADAP KINERJA PENGGUNA DENGAN MENGGUNAKAN METODE TASK TECHNOLOGY FIT', 'Syaifullah, SE, M.Sc', '', 'Angraini, S.Kom, M.Eng', 'Megawati, S.Kom, MT', '2014-05-16', 'November 2014', 'Khairunnas - 10753000283.pdf'),
(10753000356, 'JONY WIDIANTO', 'STUDI KELAYAKAN SISTEM INFORMASI AKADEMIK BERBASIS WEB PADA POLTEKES KEMENKES RIAU DENGAN MENGGUNAKAN METODE KELAYAKAN TELOS', 'Syaifullah, SE, M.Sc', '', 'Zarnelly, S.Kom, M.Sc', 'Eki Saputra, S.Kom, M.Kom', '2014-05-13', 'November 2014', 'Joni Widianto - 10753000356.pdf'),
(10853001617, 'LILY EFRIYANTI', 'PENGEMBANGAN SISTEM INFORMASI PENDAFTARAN CONSULTANT', 'Wahyudi, ST, MT', '', 'Zarnelly, S.Kom, M.Sc', 'Mustakim, ST', '2013-06-03', 'November 2013', 'Lily Efrianti - 100853001617.pdf'),
(10853002150, 'KHASBI MAIMUUNAH', 'PENGARUH PEMANFAATAN INTERNET TERHADAP KINERJA DOSEN', 'Nurmaini Dalimunthe, S.Kom, M.Kes', 'Astuti Meflinda, SE, MM', 'Angraini, S.Kom, M.Eng', 'Megawati, S.Kom, MT', '2014-03-25', 'Juni 2014', 'Khasbi Maimuunah - 10853002150.pdf'),
(10853002761, 'TRESNA NURVIA HAYATI', 'IMPLEMENTASI WEB PORTAL PARIWISATA KABUPATEN SOLOK', 'Idria Maita, S.Kom, M.Sc', '', 'Syahtriatna,S.Kom, M.Kom', 'Anofrizen, S.Kom, M.Kom', '2013-11-15', 'Februari 2014', 'Tresna Nurvia Hayati - 100853002761.pdf'),
(10853002979, 'CICI ISMIATI', 'ANALISIS TINGKAT KEPUASAN PENGGUNA ONLINE PUBLIC ACCESS CATALOG (OPAC) DENGAN MENGGUNAKAN METODE END USER COMPUTING SATISFACTION (EUCS)', 'Nurmaini Dalimunthe, S.Kom, M.Kes', '', 'Angraini, S.Kom, M.Eng', 'Megawati, S.Kom, MT', '2014-07-10', 'November 2014', 'Cici Ismiati - 10853002979.pdf'),
(10853003008, 'HERYANTA BANGUN', 'APLIKASI SISTEM PAKAR IDENTIFIKASI GAYA BERPIKIR BERBASIS ANDROID', 'Megawati, S.Kom, MT', '', 'Idria Maita, S.Kom, M.Sc', 'Nesdi Evrilyan R, S.Kom, M.Sc', '2014-06-27', 'November 2014', 'Heryanta Bangun - 10853003008.pdf'),
(10853003288, 'ELEFNA SALVIA', 'EVALUASI PENERAPAN TEKNOLOGI INFORMASI MENGGUNAKAN HUMAN ORGANIZATION TECHNOLOGY (HOT) FIT MODELS ', 'Angraini, S.Kom, M.Eng', '', 'Nurmaini Dalimunthe, S.Kom, M.Kes', 'Anofrizen, S.Kom, M.Kom', '2013-11-01', 'Maret 2014', 'Elefna Salvia - 100853003288.pdf'),
(10853004003, 'OKTAVIANA FRANSISCA', 'ANALISIS PENGELOLAAN TEKNOLOGI INFORMASI PADA  PT.BANK MANDIRI MENGGUNAKAN COBIT 4.1', 'Angraini, S.Kom, M.Eng', '', 'Idria Maita, S.Kom, M.Sc', 'Syahtriatna,S.Kom, M.Kom', '2014-01-10', 'Maret 2014', 'Oktaviana Fransisca - 10853004003.pdf'),
(10853004338, 'WENI SUSTRIA', 'PENERAPAN KONSEP GREEN ICT PADA PROSES EVALUASI KINERJA DOSEN', 'Nesdi Evrilyan R, S.Kom, M.Sc', 'Dian Ramadhani,S.T', 'Eki Saputra, S.Kom, M.Kom', 'Mustakim, ST', '2013-05-17', 'Juni 2013', 'Weni Sustria - 10853004338.pdf'),
(10953005622, 'SRI SUCIA DARUL SALMI', 'RANCANG BANGUN KNOWLEDGE MANAGEMENT SYSTEM PADA SEKRETARIAT BADAN KOORDINASI PENYULUHAN PROVINSI RIAU', 'Zarnelly, S.Kom, M.Sc', '', 'Nesdi Evrilyan R, S.Kom, M.Sc', 'Idria Maita, S.Kom, M.Sc', '2014-06-20', 'November 2014', 'Sri Sucia Darul Salmi - 10953005622.pdf'),
(10953006747, 'AIDIEL FITRA', 'PERANCANGAN ARSITEKTUR SISTEM INFORMASI MENGGUNAKAN THE OPEN GROUP ARCHITECTURE FRAMEWORK (TOGAF) PADA UNIVERSITAS ISLAM NEGERI SULTAN SYARIF KASIM RIAU', 'Idria Maita, S.Kom, M.Sc', 'Zarnelly, S.Kom, M.Sc', 'Dr. Okfalisa', 'Angraini, S.Kom, M.Eng', '2014-01-15', 'Maret 2014', 'Aidiel Fitra - 10953006747.pdf'),
(10953006793, 'YOZITA DEWI', 'AUDIT HOSPITAL MANAGEMENT SYSTEM (HMS) PADA RSIA ANDINI PEKANBARU MENGGUNAKAN COBIT FRAMEWORK 4.1', 'Angraini, S.Kom, M.Eng', '', 'Zarnelly, S.Kom, M.Sc', 'Megawati, S.Kom, MT', '2014-06-19', 'November 2014', 'Yozita Dewi - 10953006793.pdf'),
(10953008042, 'RESKI FILIA AMANDA', 'EVALUASI KINERJA SISTEM INFORMASI INVENTORI', 'Angraini, S.Kom, M.Eng', '', 'Syahtriatna,S.Kom, M.Kom', 'Anofrizen, S.Kom, M.Kom', '2015-01-16', 'Maret 2014', 'Reski Filia Amanda - 10953008042.pdf'),
(11053102135, 'MUHAMMAD YURIZKIANSYAH', 'PENGUKURAN SISTEM INFORMASI COMPETENCY BASED PERFORMANCE MANAGEMENT (CBPM) MENGGUNAKAN COBIT FRAMEWORK 4.1', 'Syaifullah, SE, M.Sc', '', 'Idria Maita, S.Kom, M.Sc', 'Megawati, S.Kom, MT', '2015-05-19', 'Agustus 2015', 'Muhammad Yurizkiansyah - 11053102135.pdf'),
(11053103242, 'ABDI SAPUTRA', 'E-MARKETING SYSTEM AGENT PROPERTY MENGGUNAKAN PENDEKATAN SOSTAC FRAMEWORK', 'Syaifullah, SE, M.Sc', '', 'Siti Monalisa, ST, M.Kom', 'Megawati, S.Kom, MT', '2014-10-30', 'Maret 2015', 'Abdi Saputra - 11053103242.pdf'),
(11053200625, 'MERI ANDANI', 'MANAJEMEN RISIKO KEAMANAN APLIKASI SISTEM INFORMASI LAPORAN HARIAN PKS & PPKO ONLINE PADA PTPN V MENGGUNAKAN METODE NIST SP 800-30', 'Angraini, S.Kom, M.Eng', '', 'Idria Maita, S.Kom, M.Sc', 'Eki Saputra, S.Kom, M.Kom', '2014-10-02', 'November 2014', 'Meri Andani - 11053200625.pdf'),
(11053202970, 'UMI KHALSUM', 'IMPLEMENTASI SISTEM PENGELOMPOKAN DATA PENERIMA BEASISWA MENGGUNAKAN METODE K-MEANS IMPLEMENTASI SISTEM PENGELOMPOKAN DATA PENERIMA  BEASISWA MENGGUNAKAN METODE K-MEANS', 'Eki Saputra, S.Kom, M.Kom', '', 'Nesdi Evrilyan R, S.Kom, M.Sc', 'Megawati, S.Kom, MT', '2014-07-08', 'November 2014', 'Umi Khalsum - 11053202970.pdf'),
(11053202982, 'DESRI HELIZAR', 'PENGUKURAN SUMBER DAYA TEKNOLOGI INFORMASI MENGGUNAKAN METODE COBIT 4.1 PADA PERPUSTAKAAN SOEMAN HS PEKANBARU', 'Nesdi Evrilyan R, S.Kom, M.Sc', '', 'Idria Maita, S.Kom, M.Sc', 'Angraini, S.Kom, M.Eng', '2014-07-17', 'November 2014', 'Desri Helizar - 11053202982.pdf'),
(11053203252, 'VENI AGUSTIN', 'ANALISIS KEBUTUHAN SISTEM INFORMASI STATUS LINGKUNGAN HIDUP DAERAH DENGAN STANDAR IEEE 830', 'Angraini, S.Kom, M.Eng', '', 'Megawati, S.Kom, MT', 'Eki Saputra, S.Kom, M.Kom', '2014-10-09', 'November 2014', 'Veni Agustin - 11053203252.pdf'),
(11053203428, 'SRI WAHYU ADHA', 'SISTEM PENENTUAN GURU BERPRESTASI MENGGUNAKAN METODE SAW(SIMPLE ADDITIVE WEIGHTING)', 'Eki Saputra, S.Kom, M.Kom', 'Angraini, S.Kom, M.Eng', 'Nesdi Evrilyan R, S.Kom, M.Sc', 'Megawati, S.Kom, MT', '2014-06-23', 'November 2014', 'Sri Wahyu Adha - 11053203428.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `data_user`
--

CREATE TABLE IF NOT EXISTS `data_user` (
  `id_user` bigint(30) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `nama_lengkap` varchar(60) NOT NULL,
  `level` enum('admin','user') NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data_user`
--

INSERT INTO `data_user` (`id_user`, `username`, `password`, `nama_lengkap`, `level`) VALUES
(0, 'd', '8277e0910d750195b448797616e091ad', 'dosen', 'user'),
(1234, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin', 'admin'),
(11053102210, 'user', 'ee11cbb19052e40b07aac0ca060c23ee', 'ardi', 'user');

-- --------------------------------------------------------

--
-- Table structure for table `dosen`
--

CREATE TABLE IF NOT EXISTS `dosen` (
  `id_dosen` int(3) NOT NULL AUTO_INCREMENT,
  `nama_dosen` varchar(60) NOT NULL,
  PRIMARY KEY (`id_dosen`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

--
-- Dumping data for table `dosen`
--

INSERT INTO `dosen` (`id_dosen`, `nama_dosen`) VALUES
(1, 'Syaifullah, SE, M.Sc'),
(2, 'Anofrizen, S.Kom, M.Kom'),
(3, 'Zarnelly, S.Kom, M.Sc'),
(4, 'Nurmaini Dalimunthe, S.Kom, M.Kes'),
(5, 'Nesdi Evrilyan R, S.Kom, M.Sc'),
(6, 'Idria Maita, S.Kom, M.Sc'),
(7, 'Angraini, S.Kom, M.Eng'),
(8, 'Eki Saputra, S.Kom, M.Kom'),
(9, 'Arif Marsal, Lc, MA'),
(10, 'Rice Novita, S.Kom, M.Kom'),
(11, 'Inggih Permana, S.T, MT'),
(12, 'Megawati, S.Kom, MT'),
(13, 'Siti Monalisa, ST, M.Kom'),
(14, 'M. Jazman, S.Kom, M.InfoSys'),
(15, 'Mustakim, ST, M.Kom'),
(16, 'Syahtriatna,S.Kom, M.Kom'),
(17, 'Astuti Meflinda, SE, MM'),
(18, 'Dr. Okfalisa'),
(19, 'Mustakim, ST'),
(20, 'Wahyudi, ST, MT'),
(21, 'Wirdah Anugerah, S.Kom'),
(22, 'Fathurrahma, ST'),
(23, 'Mona Fronita, S.Kom'),
(24, 'Arabiatul Adawiyah, S.Kom'),
(25, 'Nurul Aini, S.Kom'),
(26, 'Dian Ramadhani,S.T');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
