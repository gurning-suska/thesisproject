<?php
include "../koneksi.php";

$file_name 		= $_FILES['file_upload']['name']; //Membaca nama file
$source 		= $_FILES['file_upload']['tmp_name'];//Source tempat upload file sementara
$direktori 		= "../folderpdf/$file_name";//Tempat upload file disimpan
move_uploaded_file($source,$direktori);//Memindahkan upload file dari direktori sementara ke tempat permanen


$nim          = $_POST['nim'];
$penulis        = $_POST['penulis'];
$judul 		    = $_POST['judul'];
$pembimbing_1 	= $_POST['pembimbing_1'];
$pembimbing_2 	= $_POST['pembimbing_2'];
$penguji_1 	    = $_POST['penguji_1'];
$penguji_2 	    = $_POST['penguji_2'];
$sidang 	    = $_POST['sidang'];

$bulan			= $_POST['bulan'];
$tahun			= $_POST['tahun'];

//$q     = mysql_query("INSERT INTO data_ta (wisuda) values ('$bulan-$tahun')");
$query = mysql_query("INSERT INTO data_ta (nim, penulis, judul, pembimbing_1, pembimbing_2, penguji_1, penguji_2, sidang, wisuda, file) 
	VALUES ('$nim', '$penulis', '$judul', '$pembimbing_1', '$pembimbing_2', '$penguji_1', '$penguji_2','$sidang', '$bulan $tahun', '$file_name')");
if ($query){
	echo "<script>alert('Data Tugas Akhir Berhasil dimasukkan!'); window.location = '../admin/data_ta.php'</script>";	
} else {
	echo "<script>alert('Data Tugas Akhir Gagal dimasukkan!'); window.location = '../admin/data_ta.php'</script>";	
}
?>