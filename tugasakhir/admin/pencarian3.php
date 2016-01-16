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
          <li><a href="../admin/index.php">Home</a></li>
          <li><a href="../admin/data_ta.php">Data Tugas Akhir</a></li>
          <li><a href="../admin/data_user.php">Data User</a></li>
          <li  class="active"><a href="../admin/pencarian.php">Pencarian</a></li>
      </ul>

      <ul class="nav navbar-nav navbar-right">
          <li><a href="../admin/profil.php" class="active"><span class="glyphicon glyphicon-user"></span> 
                  <?php echo $_SESSION['nama_lengkap']; ?></a></li> 
          <li><a href="../logout.php" class="active"><span class="glyphicon glyphicon-asterisk"></span>
                  <onclick="return confirm('Apakah anda akan keluar?');">Logout</a></li>
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
             Selamat Datang di Halaman Pencarian Tugas Akhir
          </div>
  <!-- Main component for a primary marketing message or call to action -->
  <div class="panel panel-primary">
    <div class="panel-heading"> Pencarian Tugas Akhir </div>
      <div class="panel-body" >
        <div class="container">
          <h4>Pencarian Data Tugas Akhir</h4><hr width="40%" align="left">
            <div align="center">
            <form action="pencarian.php" method="POST" class="navbar-form" role="search">
              <div class="form-group" >
                <input type='text' placeholder='Cari Data ' name='cari' class='form-control'> 
              </div>
                <input type='submit' value='Cari Data' class='btn btn-sm btn-primary'> <a href='pencarian.php' class='btn btn-sm btn-success' > All Data</a>
            </form>
            </div>
            <div class="col-md-11">
              <table class="table table-hover">
                <th >
                  <td>Penulis</td>
                  <td>NIM</td>
                  <td align="center">Judul</td>
                  <td>Operasi</td>
                </th>
                
                <?php 
                  $query="select * from data_ta";
                  
                    if(isset($_POST['cari']))
                      {
                        $cari=$_POST['cari'];
                        $query="SELECT * FROM  data_ta  where penulis like '%$cari%' or judul like '%$cari%'  ";
                      }
                        $result=mysql_query($query) or die(mysql_error());
                        $no=1; //penomoran 
                        while($data=mysql_fetch_array($result))
                        
                        {?>
                      
                      <tr>
                        <td><?php   echo $no?></td>
                        <td><?php   echo $data['penulis'];?></td>
                        <td><?php   echo $data['nim'];?></td>
                        <td><?php   echo $data['judul'];?></td>
                        <td>
                          <a class="btn btn-sm btn-primary" href="lihat_pencarian.php?nim=<?php echo $data['nim'];?>"><i class="fa fa-wrench"></i> Lihat</a>
                        </td>
                      </tr>
                      <?php $no++; }?>
              </table>  
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