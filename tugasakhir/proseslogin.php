<?php
include ("koneksi.php");
date_default_timezone_set('Asia/Jakarta');

session_start();

$username = $_POST['username'];
$password = $_POST['password'];

$username = mysql_real_escape_string($username);
$password = mysql_real_escape_string($password);
$password = md5($password);

$query = mysql_query("SELECT * FROM data_user WHERE username='$username' AND password='$password'");
$data = mysql_fetch_array ($query);
$hasil=mysql_num_rows($query);

if ($password == $data['password'])
	{
	    // menyimpan username dan level ke dalam session
	    $_SESSION['level'] = $data['level'];
	    $_SESSION['username'] = $data['username'];
	    $_SESSION['nama_lengkap'] = $data['nama_lengkap'];
	}
  else 
  {
    echo "<script>alert('Mohon periksa kembali Username dan Password anda !'); document.location.href=\"index.html\"</script>";
  }
if (isset($_SESSION['level']))
        {
          // jika level admin
          if ($_SESSION['level'] == "admin")
           { 
            header('location:admin/index.php'); 
           }
       // jika kondisi level user maka akan diarahkan ke halaman lain
       else if ($_SESSION['level'] == "user")
           {
               header('location:user/index.php');
           }
        }
  ?>