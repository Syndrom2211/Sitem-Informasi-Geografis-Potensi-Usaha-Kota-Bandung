<?php
session_start();

//Instansiasi Class Admin Dinas
include "../class/admin_dinas.php";
$admin_dinas = new admin_dinas();

//Cek Sesi
$ceksesi = $admin_dinas->ceksesi();
if(!$ceksesi){
  header("Location: index.php");
}

// Edit POST
if(isset($_POST['edit_data'])){
  $id_akun  = $_POST["id_akun"];
  $nip      = $_POST["nip"];
  $password = $_POST["password"];

  $cek          = $admin_dinas->edit_akun($id_akun, $nip, $password);
  if($cek){
    echo '<script>alert("data berhasil diubah");</script>';
    echo '<script>alert("silahkan login kembali");</script>';
    session_destroy();
    echo '<meta http-equiv="refresh" content="0; url=home.php"';
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
                            <form class="form-horizontal" method="post" action="pengaturan.php">
                            <fieldset>

                            <?php
                            $id_akun = $_GET["id_akun"];
                            foreach($admin_dinas->tampil_admin_byid($id_akun) as $data){
                            ?>
                            <!-- Text input-->
                            <div class="form-group">
                              <label class="col-md-4 control-label" for="skala">NIP</label>
                              <div class="col-md-5">
                                <input name="id_akun" value="<?php echo $id_akun; ?>" type="hidden" class="form-control input-md" />
                                <input name="nip" value="<?php echo $data["nip"]; ?>" type="text" class="form-control input-md" readonly="" />
                              </div>
                            </div>

                            <!-- Text input-->
                            <div class="form-group">
                              <label class="col-md-4 control-label" for="skala">Password</label>
                              <div class="col-md-5">
                                <input name="password" placeholder="Masukan password baru" type="password" class="form-control input-md" required />
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
                              $id_akun = $_SESSION["id_akun"];
                              foreach($admin_dinas->tampil_admin_byid($id_akun) as $data){
                              ?>
                              <!-- Text input-->
                              <div class="form-group">
                                <label class="col-md-4 control-label" for="skala">NIP</label>
                                <div class="col-md-5">
                                  <input name="nip" value="<?php echo $data["nip"]; ?>" type="text" class="form-control input-md" readonly="">
                                </div>
                              </div>

                              <!-- Text input-->
                              <div class="form-group">
                                <label class="col-md-4 control-label" for="skala">Password</label>
                                <div class="col-md-5">
                                  <input name="password" value="<?php echo $data["password"]; ?>" type="password" class="form-control input-md" readonly="">
                                </div>
                              </div>
                              <?php
                              }
                              ?>

                              <!-- Text input-->
                              <div class="form-group">
                                <label class="col-md-4 control-label" for="LVR"></label>
                                <div class="col-md-5">
                                <a href="pengaturan.php?aksi=edit_data&id_akun=<?php echo $id_akun; ?>"><button style="margin-bottom:10px;" class="btn btn-primary" name="edit_data" />Edit</button>
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
