<?php
session_start();
error_reporting(0);

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
  $kota      = $_POST['kota'];
  $kecamatan = $_POST['kecamatan'];
  $kelurahan = $_POST['kelurahan'];
  $kode_pos  = $_POST['kode_pos'];

  $cek = $admin_dinas->tambah_wilayah($kota, $kecamatan, $kelurahan, $kode_pos);
  if($cek){
    echo '<script>alert("data berhasil ditambahkan");</script>';
    echo '<meta http-equiv="refresh" content="0; url=data_wilayah.php"';
  }else{
    echo '<script>alert("data gagal ditambahkan");</script>';
  }
}

// Edit POST
if(isset($_POST['edit_data'])){
  $id_wilayah = $_POST["id_wilayah"];
  $kota       = $_POST['kota'];
  $kecamatan  = $_POST['kecamatan'];
  $kelurahan  = $_POST['kelurahan'];
  $kode_pos   = $_POST['kode_pos'];

  $cek = $admin_dinas->edit_wilayah($id_wilayah, $kota, $kecamatan, $kelurahan, $kode_pos);
  if($cek){
    echo '<script>alert("data berhasil diubah");</script>';
    echo '<meta http-equiv="refresh" content="0; url=data_wilayah.php"';
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
    <!-- BAGIAN MODAL JUMLAH PENAMBAHAN DATA wilayah -->
    <div id="modalKec" class="modal fade in">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <a class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span></a>
                </div>
                <div class="modal-body">
                  <form class="form-horizontal" action="data_wilayah.php?aksi=tambah_data" method="POST">
                  <fieldset>

                  <!-- Text input-->
                  <div class="form-group">
                    <label class="col-md-4 control-label" for="wilayah">Menambahkan berapa wilayah ?</label>
                    <div class="col-md-5">
                      <input name="ang_wil" placeholder="Masukan Jumlah wilayah" type="text" class="form-control input-md" required="">
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
                    <a href="data_wilayah.php"><button style="margin-bottom:10px;" type="button" class="btn btn-primary"><< Kembali</button></a>
              			  <div class="panel panel-default">
                      <div class="panel-heading">
                    		<div class="row">
                          <div class="col col-xs-6">
                              <h5>Tambah Data wilayah</h5>
                            </div>
                            <div class="col col-xs-6 text-left">
                              <!-- Kosong -->
                            </div>
                        </div>
                    	</div>
                      <div class="panel-body">
                        <form class="form-horizontal" action="data_wilayah.php" method="POST">
                        <fieldset>

                        <!-- Text input-->
                        <?php
                        $ang_wil = $_POST["ang_wil"];
                        if($_POST["jum_kel"]){
                          for($i=1;$i<=$ang_wil;$i++){
                        ?>
                        <div class="form-group">
                          <label class="col-md-4 control-label" for="wilayah">Wilayah ke-<?php echo $i; ?></label>
                        </div>

                        <!-- Kota -->
                        <div class="form-group">
                          <label class="col-md-4 control-label" for="wilayah">Kota</label>
                          <div class="col-md-5">
                            <input name="kota[]" value="Bandung" type="text" class="form-control input-md" readonly>
                          </div>
                        </div>

                        <!-- Kecamatan -->
                        <div class="form-group">
                          <label class="col-md-4 control-label" for="wilayah">Kecamatan</label>
                          <div class="col-md-5">
                            <select name="kecamatan[]">
                              <option value="">-= Pilih Kecamatan =-</option>
                              <?php
                              foreach($admin_dinas->tampil_kecamatan() as $data){
                              ?>
                                <option value="<?php echo $data['id_kecamatan']; ?>"><?php echo $data['kecamatan']; ?></option>
                              <?php
                              }
                              ?>
                            </select>
                          </div>
                        </div>

                        <!-- Kelurahan -->
                        <div class="form-group">
                          <label class="col-md-4 control-label" for="wilayah">Kelurahan</label>
                          <div class="col-md-5">
                            <select name="kelurahan[]">
                              <option value="">-= Pilih Kelurahan =-</option>
                              <?php
                              foreach($admin_dinas->tampil_kelurahan() as $data){
                              ?>
                                <option value="<?php echo $data['id_kelurahan']; ?>"><?php echo $data['kelurahan']; ?></option>
                              <?php
                              }
                              ?>
                            </select>
                          </div>
                        </div>

                        <!-- Kode Pos -->
                        <div class="form-group">
                          <label class="col-md-4 control-label" for="wilayah">Kode Pos</label>
                          <div class="col-md-5">
                            <input name="kode_pos[]" placeholder="Masukan kode pos" type="text" class="form-control input-md" required="">
                          </div>
                        </div>
                        <br>
                        <hr>
                        <br>
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
                    $id_wilayah = $_GET["id_wilayah"];
                    ?>
                    <div class="col-md-10 content">
                      <a href="data_wilayah.php"><button style="margin-bottom:10px;" type="button" class="btn btn-primary"><< Kembali</button></a>
                        <div class="panel panel-default">
                        <div class="panel-heading">
                          <div class="row">
                            <div class="col col-xs-6">
                                <h5>Edit Data wilayah</h5>
                              </div>
                              <div class="col col-xs-6 text-left">
                                <!-- Kosong -->
                              </div>
                          </div>
                        </div>
                        <div class="panel-body">
                          <form class="form-horizontal" action="data_wilayah.php" method="POST">
                          <fieldset>
                            <?php
                            foreach($admin_dinas->tampil_wilayah_byid($id_wilayah) as $data){
                            ?>
                            <!-- Kota -->
                            <div class="form-group">
                              <label class="col-md-4 control-label" for="wilayah">Kota</label>
                              <div class="col-md-5">
                                <input name="id_wilayah" type="hidden" class="form-control input-md" value="<?php echo $id_wilayah; ?>" readonly>
                                <input name="kota" value="<?php echo $data["kota"]; ?>" type="text" class="form-control input-md" readonly>
                              </div>
                            </div>

                            <!-- Kecamatan -->
                            <div class="form-group">
                              <label class="col-md-4 control-label" for="wilayah">Kecamatan</label>
                              <div class="col-md-5">
                                <select name="kecamatan">
                                    <option value="<?php echo $data["id_kecamatan"]; ?>"><?php echo $data["kecamatan"]; ?></option>
                                  <?php
                                  foreach($admin_dinas->tampil_kecamatan() as $datax){
                                  ?>
                                    <option value="<?php echo $datax['id_kecamatan']; ?>"><?php echo $datax['kecamatan']; ?></option>
                                  <?php
                                  }
                                  ?>
                                </select>
                              </div>
                            </div>

                            <!-- Kelurahan -->
                            <div class="form-group">
                              <label class="col-md-4 control-label" for="wilayah">Kelurahan</label>
                              <div class="col-md-5">
                                <select name="kelurahan">
                                  <option value="<?php echo $data["id_kelurahan"]; ?>"><?php echo $data["kelurahan"]; ?></option>
                                  <?php
                                  foreach($admin_dinas->tampil_kelurahan() as $datay){
                                  ?>
                                    <option value="<?php echo $datay['id_kelurahan']; ?>"><?php echo $datay['kelurahan']; ?></option>
                                  <?php
                                  }
                                  ?>
                                </select>
                              </div>
                            </div>

                            <!-- Kode Pos -->
                            <div class="form-group">
                              <label class="col-md-4 control-label" for="wilayah">Kode Pos</label>
                              <div class="col-md-5">
                                <input name="kode_pos" value="<?php echo $data["kode_pos"]; ?>" type="text" class="form-control input-md" required="">
                              </div>
                            </div>
                            <br>
                            <hr>
                            <br>
                            <?php
                                }
                                ?>
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
                      }if($_GET['aksi'] == 'hapus_data'){
                        $id_wilayah = $_GET["id_wilayah"];
                        $cek         = $admin_dinas->hapus_wilayah($id_wilayah);

                        if($cek){
                          echo '<script>alert("data berhasil dihapus");</script>';
                          echo '<meta http-equiv="refresh" content="0; url=data_wilayah.php"';
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
                                    <th>Kecamatan</th>
                                    <th>Kelurahan</th>
                                    <th>Kota</th>
                                    <th>Kode Pos</th>
                                    <th>Aksi</th>
                                  </tr>
                                </thead>
                                <tbody id="myTable">
                                  <?php
                                  $no = 1;
                                  foreach($admin_dinas->tampil_wilayah() as $data){
                                  ?>
                                  <tr>
                                    <th scope="row"><?php echo $no; ?></th>
                                    <td><?php echo $data['kecamatan']; ?></td>
                                    <td><?php echo $data['kelurahan']; ?></td>
                                    <td><?php echo $data['kota']; ?></td>
                                    <td><?php echo $data['kode_pos']; ?></td>
                                    <td>
                                      <a href="data_wilayah.php?aksi=edit_data&id_wilayah=<?php echo $data['id_wilayah']; ?>"><button style="margin-bottom:10px;" type="button" class="btn btn-success">Edit</button></a>
                                      <a href="data_wilayah.php?aksi=hapus_data&id_wilayah=<?php echo $data['id_wilayah']; ?>"><button style="margin-bottom:10px;" type="button" class="btn btn-danger">Hapus</button></a>
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
