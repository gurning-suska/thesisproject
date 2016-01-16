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
    <link rel="stylesheet" href="datepicker/themes/base/jquery.ui.all.css">
    
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
          <li><a href="../admin/profil.php" class="active" ><span class="glyphicon glyphicon-user"></span> 
                  <?php echo $_SESSION['nama_lengkap']; ?></a></li> 
          <li>
            <a href="../logout.php" class="active" onclick="return confirm('Apakah anda akan keluar?')">
              <span class="glyphicon glyphicon-asterisk"></span>
                  Logout
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
             Anda sekarang berada di Halaman Update Data Tugas Akhir
          </div>
  <!-- Main component for a primary marketing message or call to action -->
<?php
  $query = mysql_query("SELECT * FROM data_ta WHERE nim='$_GET[kd]'");
  $data  = mysql_fetch_array($query);
?>

  <div class="panel panel-danger">
    <div class="panel-heading"> Update Data Tugas Akhir </div>
      <div class="panel-body" >
        <div class="container">
          </div>
              </br>
            <form action="insert_ta.php" method="post" enctype="multipart/form-data">
              <div class="row">
                <div class="col-md-2 col-md-offset-2" align="left"><label for="nim">NIM</label></div>
                <div class="col-md-6"><input type="text" name="nim" class="form-control" value="<?php echo $data['nim'];?>" required></div>
              </div>
              </br>
              <div class="row">
                <div class="col-md-2 col-md-offset-2" align="left"><label for="penulis">Penulis</label></div>
                <div class="col-md-6"><input type="text" name="penulis" id="penulis" class="form-control" value="<?php echo $data['penulis'];?>" required></div>
              </div>
            </br>
              <div class="row">
                <div class="col-md-2 col-md-offset-2" align="left"><label for="judul">Judul</label></div>
                <div class="col-md-6"><textarea type="text" name="judul" class="form-control" required><?php echo $data['judul'];?></textarea></div>
              </div>
            </br>
              <div class="row">
                <div class="col-md-2 col-md-offset-2" align="left"><label for="pembimbing_1">Pembimbing 1</label></div>
                <div class="col-md-6">
                  <select type="text" name="pembimbing_1" class="form-control" placeholder="Pembimbing 1" required>
                    <option value="<?php echo $data['pembimbing_1'];?>"><?php echo $data['pembimbing_1'];?></option>
                      <?php $query = mysql_query("SELECT * FROM dosen"); while($qry = mysql_fetch_array($query))
                        {
                          echo "<option value=\"$qry[nama_dosen]\">$qry[nama_dosen]</option>";
                        }
                      ?>
                  </select></div>
                </div>
                </br>
              <div class="row">
                <div class="col-md-2 col-md-offset-2" align="left"><label for="pembimbing_2">Pembimbing 2</label></div>
                <div class="col-md-6">
                  <select type="text" name="pembimbing_2" class="form-control" placeholder="Pembimbing 2" >
                    <option value="<?php echo $data['pembimbing_2'];?>"><?php echo $data['pembimbing_2'];?></option>
                      <?php $query = mysql_query("SELECT * FROM dosen"); while($qry = mysql_fetch_array($query))
                        {
                          echo "<option value=\"$qry[nama_dosen]\">$qry[nama_dosen]</option>";
                        }
                      ?>
                  </select></div>
                </div>
                </br>
              <div class="row">
                <div class="col-md-2 col-md-offset-2" align="left"><label for="penguji_1">Penguji 1</label></div>
                <div class="col-md-6">
                  <select type="text" name="penguji_1" class="form-control" placeholder="Penguji 1" required>
                    <option value="<?php echo $data['penguji_2'];?>"><?php echo $data['penguji_1'];?></option>
                      <?php $query = mysql_query("SELECT * FROM dosen"); while($qry = mysql_fetch_array($query))
                        {
                          echo "<option value=\"$qry[nama_dosen]\">$qry[nama_dosen]</option>";
                        }
                      ?>
                  </select></div>
                </div>
                </br>
              <div class="row">
                <div class="col-md-2 col-md-offset-2" align="left"><label for="penguji_2">Penguji 2</label></div>
                <div class="col-md-6">
                  <select type="text" name="penguji_2" class="form-control" placeholder="Penguji 2" required>
                    <option value="<?php echo $data['penguji_2'];?>"><?php echo $data['penguji_2'];?></option>
                      <?php $query = mysql_query("SELECT * FROM dosen"); while($qry = mysql_fetch_array($query))
                        {
                          echo "<option value=\"$qry[nama_dosen]\">$qry[nama_dosen]</option>";
                        }
                      ?>
                  </select></div>
                </div>
                </br>
              <div class="row">
                <div class="col-md-2 col-md-offset-2" align="left"><label for="sidang">Tanggal Sidang</label></div>
                <div class="col-md-6"><input type="text" name="sidang" id="datepicker" class="form-control" value="<?php echo $data['sidang'];?>" required></div>
              </div>
              </br>
              <div class="row">
                <div class="col-md-2 col-md-offset-2" align="left">
                  <label for="wisuda">Peroide Wisuda</label>
                </div>
                <div class="col-md-4" >
                                <select type="text" name="bulan" class="form-control" required>
                                  <option selected="selected">Bulan</option>
                                    <?php
                                    $bulan=array("Februari","Maret","Juni","Juli","November");
                                    $jlh_bln=count($bulan);
                                    for($c=0; $c<$jlh_bln; $c+=1){
                                    echo"<option value=$bulan[$c]> $bulan[$c] </option>";
                                    }
                                    ?>
                                </select>
                              </div>
                              <div class="col-md-2">
                                <select type="text" name="tahun"  class="form-control" required>
                                  <option selected="selected">Tahun</option>
                                  <?php
                                    $now=date("Y");
                                    for($i=$now; $i>=2010; $i-=1)
                                    {
                                      echo"<option> $i </option>";
                                    }
                                  ?>
                                </select>
                              </div>
                 </div>
              </br>
              <div class="row">
                <div class="col-md-2 col-md-offset-2" align="left"><label for="file">Upload File</label></div>
                <div class="col-md-6"><input name="file_upload"  type="file"  required/></input></div>
              </div>
              </br>
            <div class="row" align="center">
              <div class="col-md-6 col-md-offset-3 col"> 
                <input type="submit" value="Simpan Data"  class="btn btn-primary"/>&nbsp;&nbsp;
                <a href="../admin/data_ta.php" class="btn btn-success">Kembali</a>
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
    <script src="datepicker/js/jquery-1.7.2.js"></script>
    <script src="datepicker/ui/jquery.ui.core.js"></script>
    <script src="datepicker/ui/jquery.ui.widget.js"></script>
    <script src="datepicker/ui/jquery.ui.datepicker.js"></script>
    <script>
      $(function() {
        $( "#datepicker" ).datepicker({
          dateFormat: "yy-mm-dd",
          changeMonth: true,
          changeYear: true
        });
      });
    </script>
   
</body>
</html>
<?php } ?>