<?php
include "../koneksi.php";

$nim            = $_POST['nim'];
$penulis        = $_POST['penulis'];
$judul 		    = $_POST['judul'];
$pembimbing_1 	= $_POST['pembimbing_1'];
$pembimbing_2 	= $_POST['pembimbing_2'];
$penguji_1 	    = $_POST['penguji_1'];
$penguji_2 	    = $_POST['penguji_2'];
$sidang 	    = $_POST['sidang'];

$bulan			= $_POST['bulan'];
$tahun			= $_POST['tahun'];
$file_name 		= $_FILES['file_upload']['name'];

$query = mysql_query("UPDATE data_ta SET nim='$nim',penulis='$penulis',judul='$judul',pembimbing_1='$pembimbing_1',pembimbing_2='$pembimbing_2',penguji_1='$penguji_1',penguji_2='$penguji_2',sidang='$sidang',wisuda='$bulan $tahun', file='$file_name'
 WHERE nim='$nim'");
if ($query){
//header('location:../admin/data_ta.php');}	
    echo "<script>alert('Data Tugas Akhir Berhasil diubah!'); window.location = '../admin/data_ta.php'</script>";	
} else {
	echo "<script>alert('Data Tugas Akhir Gagal diubah!'); window.location = 'edit.php?hal=edit&kd=$nim</script>";
    }
?>