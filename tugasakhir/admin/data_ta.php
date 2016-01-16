<?php 
  session_start();
    if (empty($_SESSION['username']))
    {
      header('location:../index.html'); 
    } 
      else 
      {
        include "../koneksi.php";
        include "../pagination1.php";
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
<?php
    $result =mysql_query("SELECT * FROM data_ta ORDER BY nim desc");

    $rpp = 10; // jumlah record per halaman
    $reload = "data_ta.php?pagination=true";
    $page = (isset($_GET['page'])) ? (int)$_GET['page']:1; 
      if($page<=0) $page = 1;  
      $tcount = mysql_num_rows($result);
      $tpages = ($tcount) ? ceil($tcount/$rpp) : 1; // total pages, last page number
      $count = 0;
      $i = ($page-1)*$rpp;
      $no_urut = ($page-1)*$rpp; //pagination config end  
?>
  
  <div class="alert alert-success alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
             Selamat Datang, Anda sekarang berada di Halaman Admin Pencarian Tugas Akhir
          </div>
  <!-- Main component for a primary marketing message or call to action -->
  <!-- /.row -->
        <div class="col-lg-12">
            <div class="panel panel-primary">
              <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-user"></i> Data Tugas Akhir </h3> 
              </div>
              <div class="panel-body">
                <div >
                  <a href="tambah_ta.php" class="btn btn-sm btn-warning">Tambah Data Tugas Akhir <i class="fa fa-arrow-circle-right"></i></a>
                </div>
              </br>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped tablesorter">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>NIM<i class="fa fa-sort"></i></th>
                        <th>Penulis<i class="fa fa-sort"></i></th>
                        <th>Judul<i class="fa fa-sort"></i></th>
                        <th width="200px">Operasi<i class="fa fa-sort"></i></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while(($count<$rpp) && ($i<$tcount)) {
                        mysql_data_seek($result,$i);
                        $data = mysql_fetch_array($result);
                    ?>
                    <tr>
                        <td><?php echo ++$no_urut;?></td>
                        <td><?php echo $data['nim']; ?></td>
                        <td><?php echo $data['penulis']; ?></td>
                        <td><?php echo $data['judul']; ?></td>
                        <td>
                            <a class="btn btn-sm btn-success" href="edit_ta.php?hal=edit&kd= <?php echo $data['nim'];?>"><i class="fa fa-edit"></i>Update</a>
                            <a class="btn btn-sm btn-danger" href="hapus_ta.php?nim=<?php echo $data['nim'] ?> " onclick="return confirm('Apakah anda yakin menghapus data ini ?')"><i class="fa fa-wrench"></i> Hapus</a>
                            <a class="btn btn-sm btn-primary" href="lihat_ta.php?nim=<?php echo $data['nim'];?>"><i class="fa fa-wrench"></i> Lihat</a>
                        </td>
                    </tr>
                    <?php
                        $i++; 
                        $count++;
                    }
                    ?>
                </tbody>
                </table>
                </div>
                 <div align="center"><?php echo paginate_one($reload, $page, $tpages); ?></div>
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