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
          <li  class="active"><a href="../user/pencarian.php">Pencarian</a></li>
      </ul>

      <ul class="nav navbar-nav navbar-right">
          <li><a href="../user/profil.php" class="active"><span class="glyphicon glyphicon-user"></span> 
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
             Selamat Datang di Halaman Pencarian Tugas Akhir
          </div>
  <!-- Main component for a primary marketing message or call to action -->
  <div class="panel panel-primary">
    <div class="panel-heading"> Pencarian Tugas Akhir </div>
      <div class="panel-body" >
        <div class="container">
          <h4>Pencarian Data Tugas Akhir</h4><hr width="40%" align="left">
            <form action="pencarian.php" method="post" role="search">
              <div class="row">
                <div class="col-md-5 col-md-offset-3"><input type="text" name="cari" class="form-control" placeholder="Masukkan judul"></div>&nbsp;
                <span><input type='submit' value='Cari Data' class='btn btn-primary'></span>
              </div>
            </form> </br>
            
                <?php
                  $query="SELECT * FROM data_ta limit 10";
                  
                  if(isset($_POST['cari']))
                    { 
                      $cari=trim($_POST['cari']);
                      $query="SELECT penulis,nim,judul,levenshtein('$cari',judul) as lev FROM data_ta HAVING lev<=20 ORDER BY lev";
                      echo "</br>";
                      echo "<p>Berikut hasil pencarian dengan judul : <b><i>$cari</i></b></p>";
                    }
                      $result=mysql_query($query) or die(mysql_error());
                      $hasil=mysql_num_rows($result);
                      $no=1;
                      $rpp = 10; // jumlah record per halaman
                      $reload = "pencarian.php?pagination=true";
                      $page = (isset($_GET['page'])) ? (int)$_GET['page']:1; 
                        if($page<=0) $page = 1;  
                        $tcount = mysql_num_rows($result);
                        $tpages = ($tcount) ? ceil($tcount/$rpp) : 1; // total pages, last page number
                        $count = 0;
                        $i = ($page-1)*$rpp;
                        $no_urut = ($page-1)*$rpp; //pagination config end
                      if($hasil>0)
                      { ?>
                    
                      <div class="col-md-11">
                        <table class="table table-hover">
                          <th >
                            <td align="center"><b>Penulis</b></td>
                            <td align="center"><b>NIM</b></td>
                            <td align="center"><b>Judul</b></td>
                            <td align="center"><b>Operasi</b></td>
                          </th>
                        <?php 
                        while($data=mysql_fetch_object($result))
                        {?>
                          <tr>
                            <td><?php   echo $no?></td>
                            <td><?php   echo $data->penulis ?></td>
                            <td><?php   echo $data->nim ?></td>
                            <td><?php   echo $data->judul ?></td>
                            <td>
                               <a class="btn btn-sm btn-primary" href="lihat_pencarian.php?nim=<?php echo $data->nim?>"><i class="fa fa-wrench"></i> Lihat</a>
                            </td>
                          </tr>
                          <?php $no++; 
                        }
                      }
                      else
                      {
                        if(isset($_POST['cari']))
                          {
                            $cari=$_POST['cari'];
                            $query="SELECT * FROM  data_ta  where penulis like '%$cari%' or judul like '%$cari%'  ";
                            ?>
                            <div class="col-md-11">
                            <table class="table table-hover">
                              <th >
                                <td align="center"><b>Penulis</b></td>
                                <td align="center"><b>NIM</b></td>
                                <td align="center"><b>Judul</b></td>
                                <td align="center"><b>Operasi</b></td>
                              </th>
                            <?php 
                          }
                            $result=mysql_query($query) or die(mysql_error());
                            $no=1; //penomoran
                            while($data=mysql_fetch_array($result))
                            { ?>
                            <tr>
                              <td><?php   echo $no?></td>
                              <td><?php   echo $data['penulis'];?></td>
                              <td><?php   echo $data['nim'];?></td>
                              <td><?php   echo $data['judul'];?></td>
                              <td>
                                <a class="btn btn-sm btn-primary" href="lihat_pencarian.php?nim=<?php echo $data['nim'];?>"><i class="fa fa-wrench"></i> Lihat</a>
                              </td>
                            </tr>
                            <?php $no++; 
                            }
                      }
                      //else
                        //{
                          //echo "Maaf judul yang anda cari tidak sesuai...";
                        //}
                    ?>
              </table>  
            <div align="center"><?php echo paginate_one($reload, $page, $tpages); ?></div>
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