<?php
session_start();
error_reporting(0);

//Instansiasi Class Admin Dinas
include "../class/pemilik_usaha.php";
$pemilik_usaha = new pemilik_usaha();

//Cek Sesi
$ceksesi = $pemilik_usaha->ceksesi();
if(!$ceksesi){
  header("Location: ../index.php");
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
    echo '<meta http-equiv="refresh" content="0; url=pengaturan.php"';
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
                  if($_GET['aksi'] == 'edit_data') {
                    ?>
                    <div class="col-md-10 content">
                        <div class="panel panel-default">
                          <div class="panel-heading">
                            <div class="row">
                              <div class="col col-xs-6">
                                </div>
                            </div>
                          </div>
                          <div class="panel-body">
                            <form class="form-horizontal" method="post" action="pengaturan.php" enctype="multipart/form-data">
                            <fieldset>

                            <?php
                            $no_ktp = $_GET["no_ktp"];
                            foreach($pemilik_usaha->tampil_pengusaha_byid($no_ktp) as $data){
                            ?>
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
                            <?php
                            }
                            ?>

                            <!-- Text input-->
                            <div class="form-group">
                              <label class="col-md-4 control-label" for="LVR"></label>
                              <div class="col-md-5">
                              <input type="submit" style="margin-bottom:10px;" class="btn btn-primary" name="edit_data" value="Simpan" />
                              </div>
                            </div>
                          </div>
                            </fieldset>
                          </form>
                    <?php
                        }
                    }else{
                    ?>
                      <div class="col-md-10 content">
                  			  <div class="panel panel-default">
                            <div class="panel-heading">
                          		<div class="row">
                                <div class="col col-xs-6">
                                  </div>
                              </div>
                          	</div>
                          	<div class="panel-body">
                              <div class="form-horizontal">
                              <fieldset>

                              <?php
                              $no_ktp = $_SESSION["no_ktp"];
                              foreach($pemilik_usaha->tampil_pengusaha_byid($no_ktp) as $data){
                              ?>
                              <div class="form-group">
                                <label class="col-md-4 control-label" for="skala">No. KTP</label>
                                <div class="col-md-5">
                                  <input name="no_ktp" value="<?php echo $data["no_ktp"]; ?>" type="text" class="form-control input-md" readonly="" />
                                </div>
                              </div>

                              <!-- Text input-->
                              <div class="form-group">
                                <label class="col-md-4 control-label" for="skala">Nama Pengusaha</label>
                                <div class="col-md-5">
                                  <input name="nama_pengusaha" value="<?php echo $data["nama_pengusaha"]; ?>" type="text" class="form-control input-md" readonly />
                                </div>
                              </div>

                              <!-- Text input-->
                              <div class="form-group">
                                <label class="col-md-4 control-label" for="skala">Email</label>
                                <div class="col-md-5">
                                  <input name="email" value="<?php echo $data["email"]; ?>" type="text" class="form-control input-md" readonly />
                                </div>
                              </div>

                              <!-- Text input-->
                              <div class="form-group">
                                <label class="col-md-4 control-label" for="skala">Password</label>
                                <div class="col-md-5">
                                  <input name="password" value="<?php echo $data["password"]; ?>" type="password" class="form-control input-md" readonly />
                                </div>
                              </div>

                              <!-- Text input-->
                              <div class="form-group">
                                <label class="col-md-4 control-label" for="skala">Alamat</label>
                                <div class="col-md-5">
                                  <textarea name="alamat" class="form-control input-md" readonly /><?php echo $data["alamat"]; ?></textarea>
                                </div>
                              </div>

                              <!-- Text input-->
                              <div class="form-group">
                                <label class="col-md-4 control-label" for="skala">Tempat Lahir</label>
                                <div class="col-md-5">
                                  <input name="tempat_lahir" value="<?php echo $data["tempat_lahir"]; ?>" type="text" class="form-control input-md" readonly />
                                </div>
                              </div>

                              <!-- Text input-->
                              <div class="form-group">
                                <label class="col-md-4 control-label" for="skala">Tanggal Lahir</label>
                                <div class="col-md-5">
                                  <input name="tanggal_lahir" value="<?php echo $data["tanggal_lahir"]; ?>" type="text" class="form-control input-md" readonly />
                                </div>
                              </div>

                              <!-- Text input-->
                              <div class="form-group">
                                <label class="col-md-4 control-label" for="skala">Foto KTP</label>
                                <div class="col-md-5">
                                  <img src="<?php echo $data["foto_ktp"]; ?>" width="100px" />
                                </div>
                              </div>
                              <?php
                              }
                              ?>

                              <!-- Text input-->
                              <div class="form-group">
                                <label class="col-md-4 control-label" for="LVR"></label>
                                <div class="col-md-5">
                                <a href="pengaturan.php?aksi=edit_data&no_ktp=<?php echo $no_ktp  ; ?>"><button style="margin-bottom:10px;" class="btn btn-primary" name="edit_data" />Edit</button>
                                </div>
                              </div>
                            </div>
                              </fieldset>
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
