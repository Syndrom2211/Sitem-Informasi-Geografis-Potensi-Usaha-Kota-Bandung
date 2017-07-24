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

// Tambah POST
if(isset($_POST['tambah_data'])){
  $skala = $_POST["skala"];

  $cek          = $admin_dinas->tambah_skala($skala);
  if($cek){
    echo '<script>alert("data berhasil ditambahkan");</script>';
    echo '<meta http-equiv="refresh" content="0; url=data_skala.php"';
  }else{
    echo '<script>alert("data gagal ditambahkan");</script>';
  }
}

// Edit POST
if(isset($_POST['edit_data'])){
  $id_skala = $_POST["id_skala"];
  $skala_usaha = $_POST["skala_usaha"];

  $cek          = $admin_dinas->edit_skala($id_skala, $skala_usaha);
  if($cek){
    echo '<script>alert("data berhasil diubah");</script>';
    echo '<meta http-equiv="refresh" content="0; url=data_skala.php"';
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
    <!-- BAGIAN MODAL JUMLAH PENAMBAHAN DATA skala -->
    <div id="modalKec" class="modal fade in">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <a class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span></a>
                </div>
                <div class="modal-body">
                  <form class="form-horizontal" action="data_skala.php?aksi=tambah_data" method="POST">
                  <fieldset>

                  <!-- Text input-->
                  <div class="form-group">
                    <label class="col-md-4 control-label" for="skala">Menambahkan berapa skala ?</label>
                    <div class="col-md-5">
                      <input name="ang_kel" placeholder="Masukan Jumlah skala" type="text" class="form-control input-md" required="">
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
                    <a href="data_skala.php"><button style="margin-bottom:10px;" type="button" class="btn btn-primary"><< Kembali</button></a>
              			  <div class="panel panel-default">
                      <div class="panel-heading">
                    		<div class="row">
                          <div class="col col-xs-6">
                              <h5>Tambah Data skala</h5>
                            </div>
                            <div class="col col-xs-6 text-left">
                              <!-- Kosong -->
                            </div>
                        </div>
                    	</div>
                      <div class="panel-body">
                        <form class="form-horizontal" action="data_skala.php" method="POST">
                        <fieldset>

                        <!-- Text input-->
                        <?php
                        $ang_kel = $_POST["ang_kel"];
                        if($_POST["jum_kel"]){
                          for($i=1;$i<=$ang_kel;$i++){
                        ?>
                        <div class="form-group">
                          <label class="col-md-4 control-label" for="skala">Skala</label>
                          <div class="col-md-5">
                            <input name="skala[]" placeholder="Masukan data skala" type="text" class="form-control input-md" required="">
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
                    $id_skala = $_GET["id_skala"];
                    foreach($admin_dinas->tampil_skala_byid($id_skala) as $data){
                    ?>
                    <div class="col-md-10 content">
                      <a href="data_skala.php"><button style="margin-bottom:10px;" type="button" class="btn btn-primary"><< Kembali</button></a>
                        <div class="panel panel-default">
                        <div class="panel-heading">
                          <div class="row">
                            <div class="col col-xs-6">
                                <h5>Edit Data skala</h5>
                              </div>
                              <div class="col col-xs-6 text-left">
                                <!-- Kosong -->
                              </div>
                          </div>
                        </div>
                        <div class="panel-body">
                          <form class="form-horizontal" action="data_skala.php" method="POST">
                          <fieldset>

                          <!-- Text input-->
                          <div class="form-group">
                            <label class="col-md-4 control-label" for="skala">skala</label>
                            <div class="col-md-5">
                              <input name="id_skala" value="<?php echo $id_skala; ?>" type="hidden" class="form-control input-md" required="">
                              <input name="skala_usaha" value="<?php echo $data['skala_usaha']; ?>" type="text" class="form-control input-md" required="">
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
                        $id_skala = $_GET["id_skala"];
                        $cek         = $admin_dinas->hapus_skala($id_skala);

                        if($cek){
                          echo '<script>alert("data berhasil dihapus");</script>';
                          echo '<meta http-equiv="refresh" content="0; url=data_skala.php"';
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
                                    <th>Skala</th>
                                    <th>Aksi</th>
                                  </tr>
                                </thead>
                                <tbody id="myTable">
                                  <?php
                                  $no = 1;
                                  foreach($admin_dinas->tampil_skala() as $data){
                                  ?>
                                  <tr>
                                    <th scope="row"><?php echo $no; ?></th>
                                    <td><?php echo $data['skala_usaha']; ?></td>
                                    <td>
                                      <a href="data_skala.php?aksi=edit_data&id_skala=<?php echo $data['id_skala']; ?>"><button style="margin-bottom:10px;" type="button" class="btn btn-success">Edit</button></a>
                                      <a href="data_skala.php?aksi=hapus_data&id_skala=<?php echo $data['id_skala']; ?>"><button style="margin-bottom:10px;" type="button" class="btn btn-danger">Hapus</button></a>
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
