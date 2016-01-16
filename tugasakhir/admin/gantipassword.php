<?php
include "../koneksi.php";
$passwordlama 		= $_POST['passwordlama'];
$passwordbaru 		= $_POST['passwordbaru'];
$konfirmasipassword = $_POST['konfirmasipassword'];
$username 			= $_POST['username'];


$querycekuser = mysql_query("SELECT * FROM data_user WHERE username = '$username' AND password = '$passwordlama'");
$count = mysql_num_rows($querycekuser);
	if ($count >= 1)
	{
		$updatequery = mysql_query("UPDATE data_user SET password = '$passwordbaru' WHERE username = '$username'");
	}
			if($updatequery)
			{	
				echo "<script>alert('Data Akun Berhasil diubah!'); window.location = '../admin/profil.php'</script>";	
			} 
				else 
					{
						echo "<script>alert('Data Akun Gagal diubah!'); window.location = '../admin/ganti_password.php'</script>";
				    }

?>