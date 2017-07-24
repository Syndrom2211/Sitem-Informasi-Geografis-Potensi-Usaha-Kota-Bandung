<?php
session_start();
error_reporting(0);

include "../class/admin_dinas.php";
$admin_dinas = new admin_dinas();

//Cek Sesi
$ceksesi = $admin_dinas->ceksesi();
if(!$ceksesi){
  header("Location: index.php");
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
      		<?php
          include "pages/sidebar.php";
          ?>
                <div class="col-md-10 content">
            			  <div class="panel panel-default" style="overflow-x:scroll;">
                    	<div class="panel-body">
                        <table id="laporan_data" class="table table-list-search">
                          <thead>
                            <tr>
                              <th>No</th>
                              <th>Nama Usaha</th>
                              <th>Pemilik Usaha</th>
                              <th>Produk Utama</th>
                              <th>Alamat</th>
                              <th>Kecamatan</th>
                              <th>Kelurahan</th>
                              <th>No. Telp</th>
                              <th>Latitude Lokasi</th>
                              <th>Longitude Lokasi</th>
                              <th>Skala</th>
                              <th>Sektor</th>
                              <th>Status Usaha</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                            $i = 1;
                            foreach($admin_dinas->tampil_usaha() as $data){
                            ?>
                            <tr>
                              <th scope="row"><?php echo $i; ?></th>
                              <td><?php echo $data["nama"]; ?></td>
                              <td><?php echo $data["nama_pengusaha"]; ?></td>
                              <td><?php echo $data["produk"]; ?></td>
                              <td><?php echo $data["alamat"]; ?></td>
                              <td><?php echo $data["kecamatan"]; ?></td>
                              <td><?php echo $data["kelurahan"]; ?></td>
                              <td><?php echo $data["no_telp"]; ?></td>
                              <td><?php echo $data["latitude_lokasi"]; ?></td>
                              <td><?php echo $data["longitude_lokasi"]; ?></td>
                              <td><?php echo $data["skala"]; ?></td>
                              <td><?php echo $data["sektor"]; ?></td>
                              <td>
                                <?php
                                if($data["status_usaha"] == "T"){
                                  $statusnya = "Tidak Aktif";
                                }else if($data["status_usaha"] == "Y"){
                                  $statusnya = "Aktif";
                                }
                                echo $statusnya;
                                ?>
                              </td>
                            </tr>
                            <?php
                            $i++;
                            }
                            ?>
                          </tbody>
                        </table>
                    </div>
              </div>
      		</div>
          <?php
          include "pages/footer.php";
          ?>
  </body>
</html>
