<?php
include "../koneksi.php";
$nim 	= $_GET['nim'];
$query  = mysql_query("SELECT * FROM data_ta WHERE nim='$nim'");
$data   = mysql_fetch_assoc($query);
$path	= "../folderpdf/$data[file]";

if(file_exists($path)):
	unlink($path);
	mysql_query("DELETE FROM data_ta where nim='$nim'");
	echo "<script>alert('Berhasil Hapus');window.location.assign('data_ta.php');</script>";
endif;

?>