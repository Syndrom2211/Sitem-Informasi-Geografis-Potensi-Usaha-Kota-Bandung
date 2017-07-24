<?php
session_start();

//Instansiasi Class Admin Dinas
include "../class/admin_dinas.php";
$admin_dinas = new admin_dinas();

include "../class/pemilik_usaha.php";
$pemilik_usaha = new pemilik_usaha();

//Cek Sesi
$ceksesi = $admin_dinas->ceksesi();
if(!$ceksesi){
  header("Location: index.php");
}

// Tambah POST
if(isset($_POST['tambah_data'])){
  $no_ktp = $_POST["no_ktp"];
  $nama_pengusaha = $_POST["nama_pengusaha"];
  $email = $_POST["email"];
  $password = $_POST["password"];
  $alamat = $_POST["alamat"];
  $tempat_lahir = $_POST["tempat_lahir"];
  $tanggal_lahir = $_POST["tanggal_lahir"];
  $status_akun = "T";

  $target_dir   = "../assets/foto_ktp/";
  //Foto
  $foto_ktp    = $target_dir.basename($_FILES["foto_ktp"]["name"]);
  $pindahgambar = $_FILES["foto_ktp"]["tmp_name"];
  //$cek_extensi  = pathinfo($foto_satu,PATHINFO_EXTENSION);

  $cek = $admin_dinas->tambah_pengusaha($no_ktp, $nama_pengusaha, $email, $password, $alamat, $tempat_lahir, $tanggal_lahir, $foto_ktp, $status_akun);
  if($cek){
    move_uploaded_file($pindahgambar, $foto_ktp);
    echo '<script>alert("data berhasil ditambah");</script>';
    echo '<meta http-equiv="refresh" content="0; url=data_akunusaha.php"';
  }else{
    echo '<script>alert("data gagal ditambah");</script>';
  }
}

// Edit POST
if(isset($_POST['edit_data'])){
  $no_ktp_lama = $_POST["no_ktp_lama"];
  $nama_pengusaha = $_POST["nama_pengusaha"];
  $email = $_POST["email"];
  $password = $_POST["password"];
  $alamat = $_POST["alamat"];
  $tempat_lahir = $_POST["tempat_lahir"];
  $tanggal_lahir = $_POST["tanggal_lahir"];

  $target_dir   = "../assets/foto_ktp/";
  //Foto
  $foto_ktp    = $target_dir.basename($_FILES["foto_ktp"]["name"]);
  $error        = $_FILES["foto_ktp"]["error"];
  $pindahgambar = $_FILES["foto_ktp"]["tmp_name"];
  //$cek_extensi  = pathinfo($foto_satu,PATHINFO_EXTENSION);

  // Lama
  $password_lama = $_POST["password_lama"];
  $foto_ktp_lama = $_POST["foto_ktp_lama"];

  $cek          = $pemilik_usaha->edit_pengusaha($error, $no_ktp_lama, $nama_pengusaha, $email, $password, $alamat, $tempat_lahir, $tanggal_lahir, $foto_ktp, $foto_ktp_lama, $password_lama);
  if($cek){
    move_uploaded_file($pindahgambar, $foto_ktp);
    echo '<script>alert("data berhasil diubah");</script>';
    echo '<meta http-equiv="refresh" content="0; url=data_akunusaha.php"';
  }else{
    echo '<script>alert("data gagal diubah");</script>';
  }
}
?>
<!DOCTYPE html>
<html>
  <head>
    <?php include "pages/header.php"; ?>
  </head>
  <body>
    <?php include "pages/navigation.php"; ?>
      <div class="container-fluid main-container">
      		<?php include "pages/sidebar.php"; ?>
                <?php
                // Untuk halaman tambah data
                if(isset($_GET['aksi'])){
                  if ($_GET['aksi'] == 'tambah_data') {
                  ?>
                          <div class="col-md-10 content">
                            <a href="data_akunusaha.php"><button style="margin-bottom:10px;" type="button" class="btn btn-primary"><< Kembali</button></a>
                              <div class="panel panel-default">
                              <div class="panel-heading">
                                <div class="row">
                                  <div class="col col-xs-6">
                                      <h5>Tambah Data Akun Pengusaha</h5>
                                    </div>
                                    <div class="col col-xs-6 text-left">
                                      <!-- Kosong -->
                                    </div>
                                </div>
                              </div>
                              <div class="panel-body">
                                <form class="form-horizontal" action="data_akunusaha.php" method="POST" enctype="multipart/form-data">
                                <fieldset>

                                  <!-- Text input-->
                                  <div class="form-group">
                                    <label class="col-md-4 control-label" for="skala">No. KTP</label>
                                    <div class="col-md-5">
                                      <input name="no_ktp" placeholder="Masukan No KTP" type="text" class="form-control input-md" required />
                                    </div>
                                  </div>

                                  <!-- Text input-->
                                  <div class="form-group">
                                    <label class="col-md-4 control-label" for="skala">Nama Pengusaha</label>
                                    <div class="col-md-5">
                                      <input name="nama_pengusaha" placeholder="Masukan Nama Lengkap" type="text" class="form-control input-md" required />
                                    </div>
                                  </div>

                                  <!-- Text input-->
                                  <div class="form-group">
                                    <label class="col-md-4 control-label" for="skala">Email</label>
                                    <div class="col-md-5">
                                      <input name="email" placeholder="Masukan Email" type="text" class="form-control input-md" required />
                                    </div>
                                  </div>

                                  <!-- Text input-->
                                  <div class="form-group">
                                    <label class="col-md-4 control-label" for="skala">Password</label>
                                    <div class="col-md-5">
                                      <input name="password" placeholder="Masukan Password" type="password" class="form-control input-md" />
                                    </div>
                                  </div>

                                  <!-- Text input-->
                                  <div class="form-group">
                                    <label class="col-md-4 control-label" for="skala">Alamat</label>
                                    <div class="col-md-5">
                                      <textarea name="alamat" placeholder="Masukan Alamat" class="form-control input-md" required></textarea>
                                    </div>
                                  </div>

                                  <!-- Text input-->
                                  <div class="form-group">
                                    <label class="col-md-4 control-label" for="skala">Tempat Lahir</label>
                                    <div class="col-md-5">
                                      <input name="tempat_lahir" placeholder="Masukan Tempat Lahir" type="text" class="form-control input-md" required />
                                    </div>
                                  </div>

                                  <!-- Text input-->
                                  <div class="form-group">
                                    <label class="col-md-4 control-label" for="skala">Tanggal Lahir</label>
                                    <div class="col-md-5">
                                      <input name="tanggal_lahir" placeholder="Masukan Tanggal Lahir" type="text" class="form-control input-md" required />
                                    </div>
                                  </div>

                                  <!-- Text input-->
                                  <div class="form-group">
                                    <label class="col-md-4 control-label" for="skala">Ganti Foto KTP</label>
                                    <div class="col-md-5">
                                      <input type="file" name="foto_ktp" />
                                    </div>
                                  </div>

                                <!-- Text input-->
                                <div class="form-group">
                                  <label class="col-md-4 control-label" for="LVR"></label>
                                  <div class="col-md-5">
                                  <input style="margin-bottom:10px;" type="submit" class="btn btn-primary" value="Simpan" name="tambah_data" />
                                  </div>
                                </div>

                                </fieldset>
                                </form>
                              </div>
                    <?php
                  }if($_GET['aksi'] == 'edit_data') {
                    $no_ktp = $_GET["no_ktp"];
                    foreach($admin_dinas->tampil_akunusaha_byid($no_ktp) as $data){
                    ?>
                    <div class="col-md-10 content">
                      <a href="data_akunusaha.php"><button style="margin-bottom:10px;" type="button" class="btn btn-primary"><< Kembali</button></a>
                        <div class="panel panel-default">
                        <div class="panel-heading">
                          <div class="row">
                            <div class="col col-xs-6">
                                <h5>Edit Data Akun Pengusaha</h5>
                              </div>
                              <div class="col col-xs-6 text-left">
                                <!-- Kosong -->
                              </div>
                          </div>
                        </div>
                        <div class="panel-body">
                          <form class="form-horizontal" action="data_akunusaha.php" method="POST" enctype="multipart/form-data">
                          <fieldset>

                            <!-- Text input-->
                            <div class="form-group">
                              <label class="col-md-4 control-label" for="skala">No. KTP</label>
                              <div class="col-md-5">
                                <input name="no_ktp_lama" value="<?php echo $data["no_ktp"]; ?>" type="text" class="form-control input-md" readonly />
                              </div>
                            </div>

                            <!-- Text input-->
                            <div class="form-group">
                              <label class="col-md-4 control-label" for="skala">Nama Pengusaha</label>
                              <div class="col-md-5">
                                <input name="nama_pengusaha" value="<?php echo $data["nama_pengusaha"]; ?>" type="text" class="form-control input-md" required />
                              </div>
                            </div>

                            <!-- Text input-->
                            <div class="form-group">
                              <label class="col-md-4 control-label" for="skala">Email</label>
                              <div class="col-md-5">
                                <input name="email" value="<?php echo $data["email"]; ?>" type="text" class="form-control input-md" required />
                              </div>
                            </div>

                            <!-- Text input-->
                            <div class="form-group">
                              <label class="col-md-4 control-label" for="skala">Password</label>
                              <div class="col-md-5">
                                <input name="password" placeholder="Masukan Password Baru..." type="password" class="form-control input-md" />
                                <input name="password_lama" type="hidden" value="<?php echo $data["password"]; ?>" class="form-control input-md" />
                                <i>*Kosongkan jika tidak ingin diganti</i>
                              </div>
                            </div>

                            <!-- Text input-->
                            <div class="form-group">
                              <label class="col-md-4 control-label" for="skala">Alamat</label>
                              <div class="col-md-5">
                                <input name="alamat" type="text" value="<?php echo $data["alamat"]; ?>" class="form-control input-md" required />
                              </div>
                            </div>

                            <!-- Text input-->
                            <div class="form-group">
                              <label class="col-md-4 control-label" for="skala">Tempat Lahir</label>
                              <div class="col-md-5">
                                <input name="tempat_lahir" value="<?php echo $data["tempat_lahir"]; ?>" type="text" class="form-control input-md" required />
                              </div>
                            </div>

                            <!-- Text input-->
                            <div class="form-group">
                              <label class="col-md-4 control-label" for="skala">Tanggal Lahir</label>
                              <div class="col-md-5">
                                <input name="tanggal_lahir" value="<?php echo $data["tanggal_lahir"]; ?>" type="text" class="form-control input-md" required />
                              </div>
                            </div>

                            <!-- Text input-->
                            <div class="form-group">
                              <label class="col-md-4 control-label" for="skala">Ganti Foto KTP</label>
                              <div class="col-md-5">
                                <input type="file" name="foto_ktp" />
                                <input type="hidden" name="foto_ktp_lama" value="<?php echo $data["foto_ktp"]; ?>" />
                                <img src="<?php echo $data["foto_ktp"]; ?>" width="100px" />
                              </div>
                            </div>

                          <!-- Text input-->
                          <div class="form-group">
                            <label class="col-md-4 control-label" for="LVR"></label>
                            <div class="col-md-5">
                            <input style="margin-bottom:10px;" type="submit" class="btn btn-primary" value="Simpan" name="edit_data" />
                            </div>
                          </div>

                          </fieldset>
                          </form>
                        </div>
                    <?php
                        }
                      }if($_GET['aksi'] == 'hapus_data'){
                        $no_ktp = $_GET["no_ktp"];
                        $cek         = $admin_dinas->hapus_pengusaha($no_ktp);

                        if($cek){
                          echo '<script>alert("data berhasil dihapus");</script>';
                          echo '<meta http-equiv="refresh" content="0; url=data_akunusaha.php"';
                        }else{
                          echo '<script>alert("data gagal dihapus");</script>';
                        }
                      }if($_GET['aksi'] == 'ubah_statusakun_ya'){
                        $no_ktp = $_GET["no_ktp"];
                        $cek         = $admin_dinas->ubah_statusakun_ya($no_ktp, $email);

                        echo '<meta http-equiv="refresh" content="0; url=data_akunusaha.php"';
                      }if($_GET['aksi'] == 'ubah_statusakun_tidak'){
                        $no_ktp = $_GET["no_ktp"];
                        $cek         = $admin_dinas->ubah_statusakun_tidak($no_ktp, $email);

                        echo '<meta http-equiv="refresh" content="0; url=data_akunusaha.php"';
                      }
                    }else{
                    ?>
                      <div class="col-md-10 content">
                        <a data-toggle="modal" href="data_akunusaha.php?aksi=tambah_data"><button style="margin-bottom:10px;" type="button" class="btn btn-primary">Tambah</button></a>
                  			  <div class="panel panel-default">
                            <div class="panel-heading">
                          		<div class="row">
                                <div class="col col-xs-6">
                                  </div>
                                  <div class="col col-xs-6 text-right">
                                    <form action="#" method="get">
                                        <div class="input-group">
                                            <!-- USE TWITTER TYPEAHEAD JSON WITH API TO SEARCH -->
                                            <input class="form-control" id="system-search" name="q" placeholder="Cari..." required>
                                            <span class="input-group-btn">
                                                <button type="submit" class="btn btn-default"><i class="glyphicon glyphicon-search"></i></button>
                                            </span>
                                        </div>
                                    </form>
                                  </div>
                              </div>
                          	</div>
                          	<div class="panel-body">
                              <table class="table table-list-search">
                                <thead>
                                  <tr>
                                    <th>No</th>
                                    <th>No KTP</th>
                                    <th>Nama Pemilik</th>
                                    <th>Status Akun</th>
                                    <th>Aksi</th>
                                  </tr>
                                </thead>
                                <?php
                                $no = 1;
                                foreach($admin_dinas->tampil_akunusaha() as $data){
                                ?>
                                <tbody id="myTable">
                                  <tr>
                                    <th scope="row"><?php echo $no; ?></th>
                                    <td><?php echo $data['no_ktp']; ?></td>
                                    <td><?php echo $data['nama_pengusaha']; ?></td>
                                    <td>
                                      <?php
                                      if($data["status_akun"] == "T"){
                                        $statusnya = "<a href='data_akunusaha.php?aksi=ubah_statusakun_ya&no_ktp=".$data['no_ktp']."&email=".$data['email']."'><button class='btn btn-danger'>Tidak Aktif</button></a>";
                                      }else if($data["status_akun"] == "Y"){
                                        $statusnya = "<a href='data_akunusaha.php?aksi=ubah_statusakun_tidak&no_ktp=".$data['no_ktp']."&email=".$data['email']."'><button class='btn btn-success'>Aktif</button></a>";
                                      }
                                      echo $statusnya;
                                      ?></td>
                                    <td>
                                      <div id="akunusaha" class="modal fade in">
                                          <div class="modal-dialog">
                                              <div class="modal-content">

                                                  <div class="modal-header">
                                                      <a class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span></a>
                                                  </div>
                                                  <div class="modal-body">
                                                      <h4><img src="<?php echo $data["foto_ktp"]; ?>" width="100px" /></h4>
                                                      <h4>Email : <?php echo $data["email"]; ?></h4>
                                                      <h4>Alamat : <?php echo $data["alamat"]; ?></h4>
                                                      <h4>Tempat Lahir : <?php echo $data["tanggal_lahir"]; ?></h4>
                                                      <h4>Tanggal Lahir : <?php echo $data["tempat_lahir"]; ?></h4>
                                                  </div>
                                              </div><!-- /.modal-content -->
                                          </div><!-- /.modal-dalog -->
                                      </div><!-- /.modal -->

                                      <a data-toggle="modal" href="#akunusaha"><button style="margin-bottom:10px;" type="button" class="btn btn-primary">Lihat Detail</button></a>
                                      <a href="data_akunusaha.php?aksi=edit_data&no_ktp=<?php echo $data['no_ktp']; ?>"><button style="margin-bottom:10px;" type="button" class="btn btn-success">Edit</button></a>
                                      <a href="data_akunusaha.php?aksi=hapus_data&no_ktp=<?php echo $data['no_ktp']; ?>"><button style="margin-bottom:10px;" type="button" class="btn btn-danger">Hapus</button></a>
                                    </td>
                                  </tr>
                                <?php
                                $no++;
                                }
                                ?>
                                </tbody>
                              </table>
                          	</div>
                            <?php
                            }
                            ?>
                            <div class="col-md-12 text-center">
                              <ul class="pagination pagination-lg pager" id="myPager"></ul>
                            </div>
                          </div>
                      </div>
          <?php
          include "pages/footer.php";
          ?>
  </body>
</html>
