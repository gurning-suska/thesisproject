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
    <link href="css/bootstrap.css" rel="stylesheet">

    <!-- FONTAWESOME STYLES-->
    <link href="css/font-awesome.css" rel="stylesheet" />
    
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
             Selamat Datang, anda berada di Halaman Data User Pencarian Tugas Akhir
          </div>
  <!-- Main component for a primary marketing message or call to action -->
  <!-- /.row -->
        <div class="col-lg-12">
            <div class="panel panel-primary">
              <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-user"></i> Data User </h3> 
              </div>
              <div class="panel-body">
                  <div >
                    <a href="tambah_user.php" class="btn btn-sm btn-warning">Tambah Data User <i class="fa fa-arrow-circle-right"></i></a>
                  </div>
                  </br>  
                 <div class="table-responsive">
                    <?php
                    $tampil=mysql_query("select * from data_user order by id_user desc");
                    ?>
                  <table class="table table-bordered table-hover table-striped tablesorter">
                  
                      <tr>
                        <th>ID User<i class="fa fa-sort"></i></th>
                        <th>Username<i class="fa fa-sort"></i></th>
                        <th>Nama Lengkap<i class="fa fa-sort"></i></th>
                        <th>Level<i class="fa fa-sort"></i></th>
                        <th width="150px">Operasi<i class="fa fa-sort"></i></th>
                      </tr>
                     <?php while($data=mysql_fetch_array($tampil))
                    { ?>
                    <tr>
                      <td><?php echo $data['id_user']; ?></td>
                      <td><?php echo $data['username']; ?></td>
                      <td><?php echo $data['nama_lengkap']; ?></td>
                      <td><?php echo $data['level']; ?></td>
                      <td>
                          <a class="btn btn-sm btn-success" href="edit_user.php?hal=edit&kd=<?php echo $data['id_user'];?>"><i class="fa fa-edit"></i> Update</a>
                          <a class="btn btn-sm btn-danger" href="hapus_user.php?id_user=<?php echo $data['id_user'] ?> " onclick="return confirm('Apakah anda yakin menghapus data ini ?')"><i class="fa fa-wrench"></i> Hapus</a>
                      </td>
                    </tr>
                 <?php   
              }
              ?>
                   </table>
                   
              </div> 
            </div>
          </div>
        </div><!-- /.row --> 

 

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="js/jquery-1.11.3.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
</body>
</html>
<?php } ?>