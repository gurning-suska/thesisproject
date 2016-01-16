<?php 
  session_start();
    if (empty($_SESSION['username']))
    {
      echo "<script>alert('Anda belum mempunyai hak akses.'); window.location = '../index.html'</script>"; 
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
          <li><a href="../admin/index.php">Home</a></li>
          <li><a href="../admin/data_ta.php">Data Tugas Akhir</a></li>
          <li class="active"><a href="../admin/data_user.php">Data User</a></li>
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
             Anda sekarang berada di Halaman Update Data User
          </div>
  <!-- Main component for a primary marketing message or call to action -->
  
  
    <?php
      $query = mysql_query("SELECT * FROM data_user WHERE id_user='$_GET[kd]'");
      $data  = mysql_fetch_array($query);
    ?>

    <div class="panel panel-danger">
    <div class="panel-heading"> Update Data User</div>
      <div class="panel-body" >
        <div class="container">
          </div>
              </br>
            <form action="insert_user.php" method="post" enctype="multipart/form-data">
              <div class="row">
                <div class="col-md-2 col-md-offset-2" align="left"><label for="nama_lengkap">Nama Lengkap</label></div>
                <div class="col-md-6"><input type="text" name="nama_lengkap" class="form-control" value="<?php echo $data['nama_lengkap'];?>" required></div>
              </div>
              </br>
              <div class="row">
                <div class="col-md-2 col-md-offset-2" align="left"><label for="id_user">ID User</label></div>
                <div class="col-md-6"><input type="text" name="id_user" id="id_user" class="form-control" value="<?php echo $data['id_user'];?>" required></div>
              </div>
            </br>
              <div class="row">
                <div class="col-md-2 col-md-offset-2" align="left"><label for="username">Username</label></div>
                <div class="col-md-6"><input type="text" name="username" id="username" class="form-control" value="<?php echo $data['username'];?>" required></div>
              </div>
            </br>
              <div class="row">
                <div class="col-md-2 col-md-offset-2" align="left"><label for="password">Password</label></div>
                <div class="col-md-6"><input type="text" name="password" id="password" class="form-control" value="<?php echo $data['password'];?>" required></div>
              </div>
            </br>
              <div class="row">
                <div class="col-md-2 col-md-offset-2" align="left"><label for="level">Level</label></div>
                <div class="col-md-6">
                  <select type="text" name="level" id="level" class="form-control" value="<?php echo $data['level'];?>" required>
                    <option value="admin">Admin</option>
                    <option value="user">User</option>
                  </select>
                </div>
              </div>
            </br>
            <div class="row" align="center">
              <div class="col-md-6 col-md-offset-3 col"> 
                <input type="submit" value="Simpan Data"  class="btn btn-primary"/>&nbsp;&nbsp;
                
                <a href="../admin/data_user.php" class="btn btn-success">Kembali</a>
              </div>
            </div>
            </form>
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