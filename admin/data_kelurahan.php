<?php
error_reporting(0);
session_start();

//Instansiasi Class Admin Dinas
include "../class/admin_dinas.php";
$admin_dinas = new admin_dinas();

//Cek Sesi
$ceksesi = $admin_dinas->ceksesi();
if(!$ceksesi){
  header("Location: index.php");
}

// Tambah POST
if(isset($_POST['tambah_data'])){
  $kelurahan = $_POST["kelurahan"];

  $cek          = $admin_dinas->tambah_kelurahan($kelurahan);
  if($cek){
    echo '<script>alert("data berhasil ditambahkan");</script>';
    echo '<meta http-equiv="refresh" content="0; url=data_kelurahan.php"';
  }else{
    echo '<script>alert("data gagal ditambahkan");</script>';
  }
}

// Edit POST
if(isset($_POST['edit_data'])){
  $id_kelurahan = $_POST["id_kelurahan"];
  $kelurahan = $_POST["kelurahan"];

  $cek          = $admin_dinas->edit_kelurahan($id_kelurahan, $kelurahan);
  if($cek){
    echo '<script>alert("data berhasil diubah");</script>';
    echo '<meta http-equiv="refresh" content="0; url=data_kelurahan.php"';
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
    <!-- BAGIAN MODAL JUMLAH PENAMBAHAN DATA kelurahan -->
    <div id="modalKec" class="modal fade in">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <a class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span></a>
                </div>
                <div class="modal-body">
                  <form class="form-horizontal" action="data_kelurahan.php?aksi=tambah_data" method="POST">
                  <fieldset>

                  <!-- Text input-->
                  <div class="form-group">
                    <label class="col-md-4 control-label" for="kelurahan">Menambahkan berapa kelurahan ?</label>
                    <div class="col-md-5">
                      <input name="ang_kel" placeholder="Masukan Jumlah kelurahan" type="text" class="form-control input-md" required="">
                    </div>
                  </div>

                  <!-- Text input-->
                  <div class="form-group">
                    <label class="col-md-4 control-label" for="LVR"></label>
                    <div class="col-md-5">
                    <input style="margin-bottom:10px;" type="submit" class="btn btn-primary" value="Tambah" name="jum_kel" />
                    </div>
                  </div>

                  </fieldset>
                  </form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dalog -->
    </div><!-- /.modal -->

    <?php include "pages/navigation.php"; ?>
      <div class="container-fluid main-container">
      		<?php include "pages/sidebar.php"; ?>
                <?php
                // Untuk halaman tambah data
                if(isset($_GET['aksi'])){
                  if ($_GET['aksi'] == 'tambah_data') {
                  ?>
                  <div class="col-md-10 content">
                    <a href="data_kelurahan.php"><button style="margin-bottom:10px;" type="button" class="btn btn-primary"><< Kembali</button></a>
              			  <div class="panel panel-default">
                      <div class="panel-heading">
                    		<div class="row">
                          <div class="col col-xs-6">
                              <h5>Tambah Data kelurahan</h5>
                            </div>
                            <div class="col col-xs-6 text-left">
                              <!-- Kosong -->
                            </div>
                        </div>
                    	</div>
                      <div class="panel-body">
                        <form class="form-horizontal" action="data_kelurahan.php" method="POST">
                        <fieldset>

                        <!-- Text input-->
                        <?php
                        $ang_kel = $_POST["ang_kel"];
                        if($_POST["jum_kel"]){
                          for($i=1;$i<=$ang_kel;$i++){
                        ?>
                        <div class="form-group">
                          <label class="col-md-4 control-label" for="kelurahan">Kelurahan</label>
                          <div class="col-md-5">
                            <input name="kelurahan[]" placeholder="Masukan data kelurahan" type="text" class="form-control input-md" required="">
                          </div>
                        </div>
                        <?php
                          }
                        }
                        ?>

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
                    $id_kelurahan = $_GET["id_kelurahan"];
                    foreach($admin_dinas->tampil_kelurahan_byid($id_kelurahan) as $data){
                    ?>
                    <div class="col-md-10 content">
                      <a href="data_kelurahan.php"><button style="margin-bottom:10px;" type="button" class="btn btn-primary"><< Kembali</button></a>
                        <div class="panel panel-default">
                        <div class="panel-heading">
                          <div class="row">
                            <div class="col col-xs-6">
                                <h5>Edit Data kelurahan</h5>
                              </div>
                              <div class="col col-xs-6 text-left">
                                <!-- Kosong -->
                              </div>
                          </div>
                        </div>
                        <div class="panel-body">
                          <form class="form-horizontal" action="data_kelurahan.php" method="POST">
                          <fieldset>

                          <!-- Text input-->
                          <div class="form-group">
                            <label class="col-md-4 control-label" for="kelurahan">kelurahan</label>
                            <div class="col-md-5">
                              <input name="id_kelurahan" value="<?php echo $_GET['id_kelurahan']; ?>" type="hidden" class="form-control input-md" required="">
                              <input name="kelurahan" value="<?php echo $data['kelurahan']; ?>" type="text" class="form-control input-md" required="">
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
                        $id_kelurahan = $_GET["id_kelurahan"];
                        $cek         = $admin_dinas->hapus_kelurahan($id_kelurahan);

                        if($cek){
                          echo '<script>alert("data berhasil dihapus");</script>';
                          echo '<meta http-equiv="refresh" content="0; url=data_kelurahan.php"';
                        }else{
                          echo '<script>alert("data gagal dihapus");</script>';
                        }
                      }
                    }else{
                    ?>
                      <div class="col-md-10 content">
                        <a data-toggle="modal" href="#modalKec"><button style="margin-bottom:10px;" type="button" class="btn btn-primary">Tambah</button></a>
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
                                    <th>Kelurahan</th>
                                    <th>Aksi</th>
                                  </tr>
                                </thead>
                                <tbody id="myTable">
                                  <?php
                                  $no = 1;
                                  foreach($admin_dinas->tampil_kelurahan() as $data){
                                  ?>
                                  <tr>
                                    <th scope="row"><?php echo $no; ?></th>
                                    <td><?php echo $data['kelurahan']; ?></td>
                                    <td>
                                      <a href="data_kelurahan.php?aksi=edit_data&id_kelurahan=<?php echo $data['id_kelurahan']; ?>"><button style="margin-bottom:10px;" type="button" class="btn btn-success">Edit</button></a>
                                      <a href="data_kelurahan.php?aksi=hapus_data&id_kelurahan=<?php echo $data['id_kelurahan']; ?>"><button style="margin-bottom:10px;" type="button" class="btn btn-danger">Hapus</button></a>
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
