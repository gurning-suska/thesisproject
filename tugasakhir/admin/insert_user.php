<?php
include "../koneksi.php";
$id_user        = $_POST['id_user'];
$username       = mysql_real_escape_string ($_POST['username']);
$password 		= mysql_real_escape_string ($_POST['password']);
$password 		= md5($password);
$nama_lengkap 	= $_POST['nama_lengkap'];
$level 			= $_POST['level'];


$query = mysql_query("INSERT INTO data_user (id_user, username, password, nama_lengkap, level) VALUES ('$id_user', '$username', '$password', '$nama_lengkap', '$level')");
if ($query)
	{
		echo "<script>alert('Data User Berhasil dimasukan!'); window.location = '../admin/data_user.php'</script>";	
	} 
	else 
	{
		echo "<script>alert('Data User Gagal dimasukan!'); window.location = '../admin/data_user.php'</script>";	
	}
?>