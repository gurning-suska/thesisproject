<?php
include "../koneksi.php";
$id_user 	= $_GET['id_user'];

$query = mysql_query("DELETE FROM data_user WHERE id_user='$id_user'");
if ($query){
	echo "<script>alert('Data Berhasil dihapus!'); window.location = 'data_user.php'</script>";	
} else {
	echo "<script>alert('Data Gagal dihapus!')</script>";	
}
?>