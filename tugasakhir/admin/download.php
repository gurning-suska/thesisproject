<?php
include "../koneksi.php";

if(isset($_GET['nim']))
	{
		$nim 	= $_GET['nim'];
		$query 	= "SELECT * FROM data_ta WHERE nim = '$nim'";
		$hasil 	= mysql_query($query);
		$data 	= mysql_fetch_array($hasil);

		header("Content-Disposition: attachment; filename=".$data['file']);
		
		$fp 	= fopen("../folderpdf/".$data['file'], 'r');
		$content= fread($fp, filesize('../folderpdf/'.$data['file']));
		fclose($fp);
		echo $content;
		exit;
	}
	else
	{
		echo "Maaf, file tidak dapat diunduh";
	}
?>

