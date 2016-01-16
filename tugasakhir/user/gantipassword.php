<?php
include "../koneksi.php";
$passwordlama 		= mysql_real_escape_string ($_POST['passwordlama']);
$passwordlama		= md5($passwordlama);
$passwordbaru 		= mysql_real_escape_string ($_POST['passwordbaru']);
$passwordbaru		= md5($passwordbaru);
$konfirmasipassword = mysql_real_escape_string ($_POST['konfirmasipassword']);
$konfirmasipassword	= md5($konfirmasipassword);
$username 			= mysql_real_escape_string ($_POST['username']);



$querycekuser = mysql_query("SELECT * FROM data_user WHERE username = '$username' AND password = '$passwordlama'");
$count = mysql_num_rows($querycekuser);
	if ($count >= 1)
	{
		$updatequery = mysql_query("UPDATE data_user SET password = '$passwordbaru' WHERE username = '$username'");
	}
			if($updatequery)
			{	
				echo "<script>alert('Data Akun Berhasil diubah!'); window.location = '../user/profil.php'</script>";	
			} 
				else 
					{
						echo "<script>alert('Data Akun Gagal diubah!'); window.location = '../user/ganti_password.php'</script>";
				    }

?>