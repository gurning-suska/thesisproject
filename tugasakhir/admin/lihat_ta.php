<?php 
  session_start();
    if (empty($_SESSION['username']))
    {
      header('location:../index.html'); 
    } 
      else 
      {
        include "../koneksi.php";
        include "fungsi_tgl.php";
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pencarian Tugas Akhir </title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    
    
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <div class="container">
    <div class="page-header">
      <h3>Pencarian Tugas Akhir <small>Jurusan Sistem Informasi</small></h3>
    </div>

    <nav class="navbar navbar-default" role="navigation">
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
          <li><a href="../admin/index.php">Home</a></li>
          <li class="active"><a href="../admin/data_ta.php">Data Tugas Akhir</a></li>
          <li><a href="../admin/data_user.php">Data User</a></li>
          <li><a href="../admin/pencarian.php">Pencarian</a></li>
      </ul>

      <ul class="nav navbar-nav navbar-right">
          <li><a href="../admin/profil.php" class="active"><span class="glyphicon glyphicon-user"></span> 
                  <?php echo $_SESSION['nama_lengkap']; ?></a></li> 
          <li>
            <a href="../logout.php" class="active" onclick="return confirm('Apakah anda akan keluar?')">
              <span class="glyphicon glyphicon-asterisk"></span>Logout
            </a>
          </li>
      </ul>
      
    </div><!-- /.navbar-collapse -->
  </nav>

    
<?php
    $timeout = 10; // waktu timeout
    $logout_redirect_url = "../index.html"; // URL logout

    $timeout = $timeout * 60; // Converts menit kedalam detik
    if (isset($_SESSION['start_time'])) 
      {
        $elapsed_time = time() - $_SESSION['start_time'];
        if ($elapsed_time >= $timeout) 
        {
            session_destroy();
            echo "<script>alert('Session Anda Telah Habis!'); window.location = '$logout_redirect_url'</script>";
        }
      }

    $_SESSION['start_time'] = time();
?>
  
  <div class="alert alert-success alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
             Anda berada di Halaman Detail Data Tugas Akhir
          </div>
  <!-- Main component for a primary marketing message or call to action -->
  
    <?php
      $query = mysql_query("SELECT * FROM data_ta WHERE nim='$_GET[nim]'");
      $data  = mysql_fetch_array($query);
      $tanggal = tgl_indo($data['sidang']);
    ?>

  <div class="panel panel-primary">
    <div class="panel-heading">Data Tugas Akhir </i></div>
      <div class="panel-body" >
        <div><h4>Data Tugas Akhir :<i>&nbsp;<?php echo $data['penulis'];?></i></h4></div><hr width="40%" align="left">
        <div class="col-md-9 col-md-offset-2" style="background-color: #dedef8;" >
          <div >
            <label class="col-md-2" >Penulis</label><span class="col-md-10"><?php echo $data['penulis'];?></span>
          </div>
        </div>
        <div class="col-md-9 col-md-offset-2" >
          <div>
            <label class="col-md-2">NIM</label><span class="col-md-10"><?php echo $data['nim'];?></span>
          </div>
        </div>
        <div class="col-md-9 col-md-offset-2" style="background-color: #dedef8;">
          <div>
            <label class="col-md-2">Judul</label><span class="col-md-10"><?php echo $data['judul'];?></span>
          </div>
        </div>
        <div class="col-md-9 col-md-offset-2" >
          <div>
            <label class="col-md-2">Pembimbing 1</label><span class="col-md-10"><?php echo $data['pembimbing_1'];?></span>
          </div>
        </div>
        <div class="col-md-9 col-md-offset-2" style="background-color: #dedef8;">
          <div>
            <label class="col-md-2">Pembimbing 2</label><span class="col-md-10"><?php echo $data['pembimbing_2'];?></span>
          </div>
        </div>
        <div class="col-md-9 col-md-offset-2" >
          <div>
            <label class="col-md-2">Penguji 1</label><span class="col-md-10"><?php echo $data['penguji_1'];?></span>
          </div>
        </div>
        <div class="col-md-9 col-md-offset-2" style="background-color: #dedef8;">
          <div>
            <label class="col-md-2">Penguji 2</label><span class="col-md-10"><?php echo $data['penguji_2'];?></span>
          </div>
        </div>
        <div class="col-md-9 col-md-offset-2" >
          <div>
            <label class="col-md-2">Tanggal Sidang</label><span class="col-md-10"><?php echo $tanggal;?></span>
          </div>
        </div>
        <div class="col-md-9 col-md-offset-2" style="background-color: #dedef8;">
          <div>
            <label class="col-md-2">Periode Wisuda</label><span class="col-md-10"><?php echo $data['wisuda'];?></span>
          </div>
        </div>
        <div class="col-md-9 col-md-offset-2" >
          <div>
            <label class="col-md-2">File</label>
              <span class="col-md-4"><a href="../admin/download.php?nim=<?php echo $data['nim'] ?>"><?php echo $data['file'];?></a></span>
          </div>
        </div>
        <div class="col-md-9 col-md-offset-2" >
          <div>
            </br>
            <a href="../admin/data_ta.php" class="btn btn-primary">Kembali</a>
          </div>
        </div>
       </div>
      </div>
    </div>
  </div>


 

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="js/jquery-1.11.3.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
</body>
</html>
<?php } ?>