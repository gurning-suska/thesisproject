<?php
include "../koneksi.php";
$id_user        = $_POST['id_user'];
$username       = $_POST['username'];
$password 		= $_POST['password'];
$nama_lengkap 	= $_POST['nama_lengkap'];
$level 			= $_POST['level'];

$query = mysql_query("UPDATE data_user SET id_user='$id_user',username='$username', password='$password', nama_lengkap='$nama_lengkap', level='$level'
 WHERE id_user='$id_user'");
if ($query)
	{
    	echo "<script>alert('Data User Berhasil diubah!'); window.location = 'data_user.php'</script>";	
	} 
		else 
		{
			echo "<script>alert('Data User Gagal diubah!'); window.location = 'edit.php?hal=edit&kd=$id_user</script>";
    	}
?>