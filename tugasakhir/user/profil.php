<?php 
  session_start();
    if (empty($_SESSION['username']))
    {
      header('location:../index.html'); 
    } 
      else 
      {
        include "../koneksi.php";
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
          <li><a href="../user/index.php">Home</a></li>
          <li><a href="../user/pencarian.php">Pencarian</a></li>
      </ul>

      <ul class="nav navbar-nav navbar-right">
          <li class="active"><a href="../user/profil.php" class="active"><span class="glyphicon glyphicon-user"></span> 
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
  
  <?php
      $query = mysql_query("SELECT username FROM data_user");
      $data  = mysql_fetch_array($query);
    ?>
  <div class="alert alert-success alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
             Selamat Datang di Halaman Admin Pencarian Tugas Akhir
          </div>
  <!-- Main component for a primary marketing message or call to action -->
  <div class="panel panel-primary">
    <div class="panel-heading"> Akun </div>
      <div class="panel-body" >
        <div class="container">
            <div class="row" align="center">
              <div class="col-md-6 col-md-offset-3 col">
                <img src="img/user.png" class="user-image img-responsive"/>
              </div>
            </div>
            </br>
            <div class="row" align="left">
              <div class="col-md-2 col-md-offset-5 col"><strong>Username</strong></div>
              <div class="col-md-2 "><?php echo $_SESSION['username']; ?></div>
            </div>
            <div class="row" align="left">
              <div class="col-md-2 col-md-offset-5 col"><strong>Nama Lengkap</strong></div>
              <div class="col-md-2 "> <?php echo $_SESSION['nama_lengkap'];?></div>
            </div>
          </br>
            <div class="row" align="center">
              <div class="col-md-6 col-md-offset-3"> 
                <a href="../user/ganti_password.php" class="btn btn-warning">Ganti Password</a>
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