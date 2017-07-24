<?php
session_start();
error_reporting(0);
date_default_timezone_set('Asia/Jakarta');

include "../class/pemilik_usaha.php";
$pemilik_usaha = new pemilik_usaha();

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
    <style type='text/css'>
    /* Always set the map height explicitly to define the size of the div
     * element that contains the map. */
    #map {
      height: 100%;
    }
    #description {
      font-family: Roboto;
      font-size: 15px;
      font-weight: 300;
    }

    #infowindow-content .title {
      font-weight: bold;
    }

    #infowindow-content {
      display: none;
    }

    #map #infowindow-content {
      display: inline;
    }

    .pac-card {
      margin: 10px 10px 0 0;
      border-radius: 2px 0 0 2px;
      box-sizing: border-box;
      -moz-box-sizing: border-box;
      outline: none;
      box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
      background-color: #fff;
      font-family: Roboto;
    }

    #pac-container {
      padding-bottom: 12px;
      margin-right: 12px;
    }

    .pac-controls {
      display: inline-block;
      padding: 5px 11px;
    }

    .pac-controls label {
      font-family: Roboto;
      font-size: 13px;
      font-weight: 300;
    }

    #pac-input {
      background-color: #fff;
      font-family: Roboto;
      font-size: 15px;
      font-weight: 300;
      margin-left: 12px;
      padding: 0 11px 0 13px;
      text-overflow: ellipsis;
      width: 400px;
    }

    #pac-input:focus {
      border-color: #4d90fe;
    }

    #title {
      color: #fff;
      background-color: #4d90fe;
      font-size: 25px;
      font-weight: 500;
      padding: 6px 12px;
    }
    #target {
      width: 345px;
    }
    </style>
  </head>
  <body>
    <?php
    if (isset($_POST["tambah_usaha"])) {
      //Data
      $id_usaha = rand(1, 1000);
      $nama = $_POST['nama'];
      $pemilik = $_POST['pemilik'];
      $produk = $_POST['produk'];
      $alamat = $_POST['alamat'];
      $kelurahan = $_POST['kelurahan'];
      $kecamatan = $_POST['kecamatan'];
      $no_telp = $_POST['no_telp'];
      $longitude_lokasi = $_POST['longitude_lokasi'];
      $latitude_lokasi = $_POST['latitude_lokasi'];
      $skala = $_POST['skala'];
      $sektor = $_POST['sektor'];
      $status_usaha = "T";
      $status = "dinas";
      $waktu = date('h:i:s');
      $tgl   = date('Y-m-d');

      $target_dir   = "../assets/foto_usaha/";
      //Foto 1
      $foto_satu    = $target_dir.basename($_FILES["foto_satu"]["name"]);
      $error        = $_FILES["foto_satu"]["error"];
      $pindahgambar_satu = $_FILES["foto_satu"]["tmp_name"];
      //$cek_extensi  = pathinfo($foto_satu,PATHINFO_EXTENSION);

      //Foto 2
      $foto_dua    = $target_dir.basename($_FILES["foto_dua"]["name"]);
      $error        = $_FILES["foto_dua"]["error"];
      $pindahgambar_dua = $_FILES["foto_dua"]["tmp_name"];
      //$cek_extensi  = pathinfo($foto_dua,PATHINFO_EXTENSION);

      //Foto 3
      $foto_tiga    = $target_dir.basename($_FILES["foto_tiga"]["name"]);
      $error        = $_FILES["foto_tiga"]["error"];
      $pindahgambar_tiga = $_FILES["foto_tiga"]["tmp_name"];
      //$cek_extensi  = pathinfo($foto_tiga,PATHINFO_EXTENSION);

      //Foto 4
      $foto_empat    = $target_dir.basename($_FILES["foto_empat"]["name"]);
      $error        = $_FILES["foto_empat"]["error"];
      $pindahgambar_empat = $_FILES["foto_empat"]["tmp_name"];
      //$cek_extensi  = pathinfo($foto_empat,PATHINFO_EXTENSION);

      //Foto 5
      $foto_lima    = $target_dir.basename($_FILES["foto_lima"]["name"]);
      $error        = $_FILES["foto_lima"]["error"];
      $pindahgambar_lima = $_FILES["foto_lima"]["tmp_name"];
      //$cek_extensi  = pathinfo($foto_lima,PATHINFO_EXTENSION);

      $cek          = $pemilik_usaha->tambah_usaha($id_usaha, $status, $tgl, $waktu, $nama, $pemilik, $produk, $alamat, $kelurahan, $kecamatan, $no_telp, $longitude_lokasi, $latitude_lokasi, $skala, $sektor, $status_usaha, $foto_satu, $foto_dua, $foto_tiga, $foto_empat, $foto_lima);
      if($cek){
        move_uploaded_file($pindahgambar_satu, $foto_satu);
        move_uploaded_file($pindahgambar_dua, $foto_dua);
        move_uploaded_file($pindahgambar_tiga, $foto_tiga);
        move_uploaded_file($pindahgambar_empat, $foto_empat);
        move_uploaded_file($pindahgambar_lima, $foto_lima);
        echo '<script>alert("Data Usaha berhasil ditambahkan");</script>';
        echo '<meta http-equiv="refresh" content="0; url=data_u_dinas.php"';
      }else{
        echo '<script>alert("Data Usaha gagal ditambahkan");</script>';
      }
    }

    if (isset($_POST['ubah_usaha'])) {
      //Data
      $id_usaha = $_POST['id_usaha'];
      $nama = $_POST['nama'];
      $produk = $_POST['produk'];
      $alamat = $_POST['alamat'];
      $kelurahan = $_POST['kelurahan'];
      $kecamatan = $_POST['kecamatan'];
      $no_telp = $_POST['no_telp'];
      $longitude_lokasi = $_POST['longitude_lokasi'];
      $latitude_lokasi = $_POST['latitude_lokasi'];
      $skala = $_POST['skala'];
      $sektor = $_POST['sektor'];
      $status_usaha = $_POST['status_usaha'];

      //Foto lama
      $foto_satu_lama = $_POST['foto_satu_lama'];
      $foto_dua_lama = $_POST['foto_dua_lama'];
      $foto_tiga_lama = $_POST['foto_tiga_lama'];
      $foto_empat_lama = $_POST['foto_empat_lama'];
      $foto_lima_lama = $_POST['foto_lima_lama'];

      $target_dir   = "../assets/foto_usaha/";
      //Foto 1
      $foto_satu    = $target_dir.basename($_FILES["foto_satu"]["name"]);
      $error        = $_FILES["foto_satu"]["error"];
      $pindahgambar_satu = $_FILES["foto_satu"]["tmp_name"];
      $error_satu        = $_FILES["foto_satu"]["error"];
      //$cek_extensi  = pathinfo($foto_satu,PATHINFO_EXTENSION);

      //Foto 2
      $foto_dua    = $target_dir.basename($_FILES["foto_dua"]["name"]);
      $error        = $_FILES["foto_dua"]["error"];
      $pindahgambar_dua = $_FILES["foto_dua"]["tmp_name"];
      $error_dua        = $_FILES["foto_dua"]["error"];
      //$cek_extensi  = pathinfo($foto_dua,PATHINFO_EXTENSION);

      //Foto 3
      $foto_tiga    = $target_dir.basename($_FILES["foto_tiga"]["name"]);
      $error        = $_FILES["foto_tiga"]["error"];
      $pindahgambar_tiga = $_FILES["foto_tiga"]["tmp_name"];
      $error_tiga        = $_FILES["foto_tiga"]["error"];
      //$cek_extensi  = pathinfo($foto_tiga,PATHINFO_EXTENSION);

      //Foto 4
      $foto_empat    = $target_dir.basename($_FILES["foto_empat"]["name"]);
      $error        = $_FILES["foto_empat"]["error"];
      $pindahgambar_empat = $_FILES["foto_empat"]["tmp_name"];
      $error_empat        = $_FILES["foto_empat"]["error"];
      //$cek_extensi  = pathinfo($foto_empat,PATHINFO_EXTENSION);

      //Foto 5
      $foto_lima    = $target_dir.basename($_FILES["foto_lima"]["name"]);
      $error        = $_FILES["foto_lima"]["error"];
      $pindahgambar_lima = $_FILES["foto_lima"]["tmp_name"];
      $error_lima       = $_FILES["foto_lima"]["error"];
      //$cek_extensi  = pathinfo($foto_lima,PATHINFO_EXTENSION);

      $cek          = $pemilik_usaha->ubah_usaha($error_satu, $error_dua, $error_tiga, $error_empat, $error_lima, $id_usaha, $nama, $produk, $alamat, $kelurahan, $kecamatan, $no_telp, $longitude_lokasi, $latitude_lokasi, $skala, $sektor, $status_usaha, $foto_satu, $foto_dua, $foto_tiga, $foto_empat, $foto_lima, $foto_satu_lama, $foto_dua_lama, $foto_tiga_lama, $foto_empat_lama, $foto_lima_lama);
      if($cek){
        move_uploaded_file($pindahgambar_satu, $foto_satu);
        move_uploaded_file($pindahgambar_dua, $foto_dua);
        move_uploaded_file($pindahgambar_tiga, $foto_tiga);
        move_uploaded_file($pindahgambar_empat, $foto_empat);
        move_uploaded_file($pindahgambar_lima, $foto_lima);
        echo '<script>alert("Data Usaha berhasil diubah");</script>';
        echo '<meta http-equiv="refresh" content="0; url=data_u_dinas.php"';
      }else{
        echo '<script>alert("Data Usaha gagal diubah");</script>';
      }
    }
    ?>

    <!-- BAGIAN MODAL JUMLAH PENAMBAHAN DATA KECAMATAN -->
    <!--<div id="modalPiljum" class="modal fade in">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <a class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span></a>
                </div>
                <div class="modal-body">
                  <form class="form-horizontal" action="data_u_dinas.php?aksi=tambah_data" method="POST" enctype="multipart/form-data">
                  <fieldset>

                  <div class="form-group">
                    <label class="col-md-4 control-label" for="Product Name">Jumlah Data Usaha</label>
                    <div class="col-md-5">
                    <input id="Product Name" name="jumlah_usaha" type="text" class="form-control input-md" required="">

                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-md-4 control-label" for="LVR"></label>
                    <div class="col-md-5">
                    <input style="margin-bottom:10px;" name="ok" type="submit" class="btn btn-primary" value="OK" />
                    </div>
                  </div>

                  </fieldset>
                  </form>
                </div>
            </div>
        </div>
    </div> -->

    <?php include "pages/navigation.php"; ?>
      <div class="container-fluid main-container">
      		<?php
          include "pages/sidebar.php";
          ?>
          <?php
          // Untuk halaman tambah data
          if(isset($_GET['aksi'])){
            if ($_GET['aksi'] == 'tambah_data') {
            ?>
            <div class="col-md-10 content">
              <a href="data_u_dinas.php"><button style="margin-bottom:10px;" type="button" class="btn btn-primary"><< Kembali</button></a>
                <div class="panel panel-default">
                <div class="panel-heading">
                  <div class="row">
                    <div class="col col-xs-6">
                        <h5>Tambah Data Usaha Oleh Dinas</h5>
                      </div>
                      <div class="col col-xs-6 text-left">
                        <!-- Kosong -->
                      </div>
                  </div>
                </div>
                <div class="panel-body">
                  <form class="form-horizontal" action="data_u_dinas.php" method="POST" enctype="multipart/form-data">
                  <fieldset>
                  <legend>Data Usaha</legend>

                  <!-- Text input-->
                  <div class="form-group">
                    <label class="col-md-4 control-label" for="Product Name">Nama Usaha</label>
                    <div class="col-md-5">
                    <input id="Product Name" name="nama" type="text" class="form-control input-md" required="">
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-md-4 control-label" for="Product Name">Pemilik Usaha</label>
                    <div class="col-md-5">
                      <select name="pemilik" class="form-control">
                        <?php
                        foreach($admin_dinas->tampil_akunusaha() as $data){
                          if($data["status_akun"] == "Y"){
                        ?>
                          <option value="<?php echo $data["no_ktp"]; ?>"><?php echo $data["nama_pengusaha"]; ?></option>
                        <?php
                          }
                        }
                        ?>
                      </select>
                    </div>
                  </div>

                  <!-- Text input-->
                  <div class="form-group">
                    <label class="col-md-4 control-label" for="Product Name">Produk Utama</label>
                    <div class="col-md-5">
                    <input id="Produk Utama" name="produk" type="text" class="form-control input-md" required="">

                    </div>
                  </div>

                  <!-- Textarea -->
                  <div class="form-group">
                    <label class="col-md-4 control-label" for="textarea">Alamat Lengkap</label>
                    <div class="col-md-4">
                      <textarea class="form-control input-md" id="textarea" name="alamat"></textarea>
                    </div>
                  </div>

                  <!-- Select Basic -->
                  <div class="form-group">
                    <label class="col-md-4 control-label" for="Loan Type">Kecamatan</label>
                    <div class="col-md-5">
                      <select name="kecamatan" id="kecamatan" class="form-control">
                        <?php
                        foreach($admin_dinas->tampil_kecamatan() as $data){
                        ?>
                          <option value="<?php echo $data['kecamatan']; ?>"><?php echo $data['kecamatan']; ?></option>
                        <?php
                        }
                        ?>
                      </select>
                    </div>
                  </div>

                  <!-- Select Basic -->
                  <div class="form-group">
                    <label class="col-md-4 control-label" for="Loan Type">Kelurahan</label>
                    <div class="col-md-5">
                      <select name="kelurahan" id="kelurahan" class="form-control">
                        <?php
                        foreach($pemilik_usaha->tampil_kelurahan_bycamat() as $data){
                        ?>
                          <option value="<?php echo $data['kelurahan']; ?>" data-id="<?php echo $data['kecamatan']; ?>"><?php echo $data['kelurahan']; ?></option>
                        <?php
                        }
                        ?>
                      </select>
                    </div>
                  </div>

                  <!-- Text input-->
                  <div class="form-group">
                    <label class="col-md-4 control-label" for="Loan Amount Min">No Telepon</label>
                    <div class="col-md-5">
                      <input id="Loan Amount Min" name="no_telp" type="text" class="form-control input-md">
                    </div>
                  </div>

                  <!-- Text input-->
                  <div class="form-group">
                    <input id="pac-input" class="" type="text" placeholder="Search Box">
                    <div id="map" class="form-control input-md" style="width:100%;height:400px;"></div>
                    <script type="text/javascript">
                      function initAutocomplete() {
                        var map = new google.maps.Map(document.getElementById('map'), {
                          center: {lat: -6.8860682, lng: 107.613718},
                          zoom: 13,
                          mapTypeId: 'roadmap'
                        });

                        google.maps.event.addListener(map, 'click', function(event){document.getElementById('latclick').value = event.latLng.lat()});
                        google.maps.event.addListener(map, 'click', function(event){document.getElementById('longclick').value = event.latLng.lng()});

                        // Create the search box and link it to the UI element.
                        var input = document.getElementById('pac-input');
                        var searchBox = new google.maps.places.SearchBox(input);
                        map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

                        // Bias the SearchBox results towards current map's viewport.
                        map.addListener('bounds_changed', function() {
                          searchBox.setBounds(map.getBounds());
                        });

                        var markers = [];
                        // Listen for the event fired when the user selects a prediction and retrieve
                        // more details for that place.
                        searchBox.addListener('places_changed', function() {
                          var places = searchBox.getPlaces();

                          if (places.length == 0) {
                            return;
                          }

                          // Clear out the old markers.
                          markers.forEach(function(marker) {
                            marker.setMap(null);
                          });
                          markers = [];

                          // For each place, get the icon, name and location.
                          var bounds = new google.maps.LatLngBounds();
                          places.forEach(function(place) {
                            if (!place.geometry) {
                              console.log("Returned place contains no geometry");
                              return;
                            }
                            var icon = {
                              url: place.icon,
                              size: new google.maps.Size(71, 71),
                              origin: new google.maps.Point(0, 0),
                              anchor: new google.maps.Point(17, 34),
                              scaledSize: new google.maps.Size(25, 25)
                            };

                            // Create a marker for each place.
                            markers.push(new google.maps.Marker({
                              map: map,
                              icon: icon,
                              title: place.name,
                              position: place.geometry.location
                            }));

                            if (place.geometry.viewport) {
                              // Only geocodes have viewport.
                              bounds.union(place.geometry.viewport);
                            } else {
                              bounds.extend(place.geometry.location);
                            }
                          });
                          map.fitBounds(bounds);
                        });
                      }
                    </script>
                    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDg8iN7O6Ey8uABfYvbZUbvClX8aFORxnU&libraries=places&callback=initAutocomplete" async defer></script>
                  </div>

                  <!-- Text input-->
                  <div class="form-group">
                    <label class="col-md-4 control-label" for="LoanAmountMax">Latitude</label>
                    <div class="col-md-5">
                    <input id="latclick" name="latitude_lokasi" type="text" class="form-control input-md" readonly>

                    </div>
                  </div>

                  <!-- Text input-->
                  <div class="form-group">
                    <label class="col-md-4 control-label" for="LoanAmountMax">Longitude</label>
                    <div class="col-md-5">
                    <input id="longclick" name="longitude_lokasi" type="text" class="form-control input-md" readonly>

                    </div>
                  </div>

                  <!-- Select Basic -->
                  <div class="form-group">
                    <label class="col-md-4 control-label" for="Loan Type">Skala Usaha</label>
                    <div class="col-md-5">
                      <select name="skala" class="form-control">
                        <?php
                        foreach($admin_dinas->tampil_skala() as $data){
                        ?>
                          <option value="<?php echo $data["skala_usaha"]; ?>"><?php echo $data["skala_usaha"]; ?></option>
                        <?php
                        }
                        ?>
                      </select>
                    </div>
                  </div>

                  <!-- Text input-->
                  <div class="form-group">
                    <label class="col-md-4 control-label" for="Loan Type">Sektor Usaha</label>
                    <div class="col-md-5">
                      <select name="sektor" class="form-control">
                        <?php
                        foreach($admin_dinas->tampil_sektor() as $data){
                        ?>
                          <option value="<?php echo $data["sektor_usaha"]; ?>"><?php echo $data["sektor_usaha"]; ?></option>
                        <?php
                        }
                        ?>
                      </select>
                    </div>
                  </div>
                  <!-- Text input-->
                  <div class="form-group">
                    <label class="col-md-4 control-label" for="Loan Type">Foto Usaha[1]</label>
                    <div class="col-md-5">
                      <input type="file" name="foto_satu" />
                    </div>
                  </div>

                  <!-- Text input-->
                  <div class="form-group">
                    <label class="col-md-4 control-label" for="Loan Type">Foto Usaha[2]</label>
                    <div class="col-md-5">
                      <input type="file" name="foto_dua" />
                    </div>
                  </div>

                  <!-- Text input-->
                  <div class="form-group">
                    <label class="col-md-4 control-label" for="Loan Type">Foto Usaha[3]</label>
                    <div class="col-md-5">
                      <input type="file" name="foto_tiga" />
                    </div>
                  </div>

                  <!-- Text input-->
                  <div class="form-group">
                    <label class="col-md-4 control-label" for="Loan Type">Foto Usaha[4]</label>
                    <div class="col-md-5">
                      <input type="file" name="foto_empat" />
                    </div>
                  </div>

                  <!-- Text input-->
                  <div class="form-group">
                    <label class="col-md-4 control-label" for="Loan Type">Foto Usaha[5]</label>
                    <div class="col-md-5">
                      <input type="file" name="foto_lima" />
                    </div>
                  </div>

                  <!-- Text input-->
                  <div class="form-group">
                    <label class="col-md-4 control-label" for="LVR"></label>
                    <div class="col-md-5">
                    <input style="margin-bottom:10px;" type="submit" class="btn btn-primary" value="Simpan" name="tambah_usaha" />
                    </div>
                  </div>

                  </fieldset>
                  </form>
                </div>
                <?php
                }if ($_GET['aksi'] == 'ubah_data') {
                ?>
                <div class="col-md-10 content">
                  <a href="data_u_dinas.php"><button style="margin-bottom:10px;" type="button" class="btn btn-primary"><< Kembali</button></a>
                    <div class="panel panel-default">
                    <div class="panel-heading">
                      <div class="row">
                        <div class="col col-xs-6">
                            <h5>Edit Data Usaha</h5>
                          </div>
                          <div class="col col-xs-6 text-left">
                            <!-- Kosong -->
                          </div>
                      </div>
                    </div>
                  <div class="panel-body">
                    <form class="form-horizontal" action="data_u_dinas.php" method="POST" enctype="multipart/form-data">
                    <fieldset>
                    <?php
                    $id_usaha = $_GET['id_usaha'];
                    foreach($pemilik_usaha->tampil_usahabyid($id_usaha) as $databy){
                      if($databy["status_usaha"] == "T"){
                        $statusnya = "<font color='red'>Tidak Aktif</font>";
                      }else if($databy["status_usaha"] == "Y"){
                        $statusnya = "<font color='lime'>Aktif</font>";
                      }
                    ?>
                    <legend>
                      Data Usaha (Status: <?php echo $statusnya; ?>)
                    </legend>
                    <br>

                    <div class="form-group">
                      <label class="col-md-4 control-label" for="Product Name">Nama Usaha</label>
                      <div class="col-md-5">
                      <input type="hidden" value="<?php echo $databy["status_usaha"]; ?>" name="status_usaha" />
                      <input value="<?php echo $databy['id_usaha']; ?>" name="id_usaha" type="hidden" class="form-control input-md" required="" />
                      <input id="Product Name" value="<?php echo $databy['nama']; ?>" name="nama" type="text" class="form-control input-md" required="">
                      </div>
                    </div>

                    <!-- Text input-->
                    <div class="form-group">
                      <label class="col-md-4 control-label" for="Product Name">Pemilik Usaha</label>
                      <div class="col-md-5">
                      <input id="Pemilik Usaha" type="text" class="form-control input-md" value="<?php echo $databy['nama_pengusaha']; ?>" readonly>
                      </div>
                    </div>

                    <!-- Text input-->
                    <div class="form-group">
                      <label class="col-md-4 control-label" for="Product Name">Produk Utama</label>
                      <div class="col-md-5">
                      <input id="Produk Utama" value="<?php echo $databy['produk']; ?>" name="produk" type="text" class="form-control input-md" required="">
                      </div>
                    </div>

                    <!-- Textarea -->
                    <div class="form-group">
                      <label class="col-md-4 control-label" for="textarea">Alamat Lengkap</label>
                      <div class="col-md-4">
                        <textarea class="form-control input-md" id="textarea" name="alamat"><?php echo $databy['alamat']; ?></textarea>
                      </div>
                    </div>

                    <!-- Select Basic -->
                    <div class="form-group">
                      <label class="col-md-4 control-label" for="Loan Type">Kecamatan</label>
                      <div class="col-md-5">
                        <select name="kecamatan" id="kecamatan" class="form-control">
                          <option value="<?php echo $databy['kecamatan']; ?>"><?php echo $databy['kecamatan']; ?></option>
                          <?php
                          foreach($admin_dinas->tampil_kecamatan() as $data){
                          ?>
                            <option value="<?php echo $data['kecamatan']; ?>"><?php echo $data['kecamatan']; ?></option>
                          <?php
                          }
                          ?>
                        </select>
                      </div>
                    </div>

                    <!-- Select Basic -->
                    <div class="form-group">
                      <label class="col-md-4 control-label" for="Loan Type">Kelurahan</label>
                      <div class="col-md-5">
                        <select name="kelurahan" id="kelurahan" class="form-control">
                          <option value="<?php echo $databy['kelurahan']; ?>"><?php echo $databy['kelurahan']; ?></option>
                          <?php
                          foreach($pemilik_usaha->tampil_kelurahan_bycamat() as $data){
                          ?>
                            <option value="<?php echo $data['kelurahan']; ?>" data-id="<?php echo $data['kecamatan']; ?>"><?php echo $data['kelurahan']; ?></option>
                          <?php
                          }
                          ?>
                        </select>
                      </div>
                    </div>

                    <!-- Text input-->
                    <div class="form-group">
                      <label class="col-md-4 control-label" for="Loan Amount Min">No Telepon</label>
                      <div class="col-md-5">
                        <input id="Loan Amount Min" value="<?php echo $databy["no_telp"]; ?>" name="no_telp" type="text" class="form-control input-md">
                      </div>
                    </div>

                    <!-- Text input-->
                    <div class="form-group">
                      <input id="pac-input" class="" type="text" placeholder="Search Box">
                      <div id="map" class="form-control input-md" style="width:100%;height:400px;"></div>
                      <script type="text/javascript">
                        function initAutocomplete() {
                          var map = new google.maps.Map(document.getElementById('map'), {
                            center: {lat: -6.8860682, lng: 107.613718},
                            zoom: 13,
                            mapTypeId: 'roadmap'
                          });

                          google.maps.event.addListener(map, 'click', function(event){document.getElementById('latclick').value = event.latLng.lat()});
                          google.maps.event.addListener(map, 'click', function(event){document.getElementById('longclick').value = event.latLng.lng()});

                          // Create the search box and link it to the UI element.
                          var input = document.getElementById('pac-input');
                          var searchBox = new google.maps.places.SearchBox(input);
                          map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

                          // Bias the SearchBox results towards current map's viewport.
                          map.addListener('bounds_changed', function() {
                            searchBox.setBounds(map.getBounds());
                          });

                          var markers = [];
                          // Listen for the event fired when the user selects a prediction and retrieve
                          // more details for that place.
                          searchBox.addListener('places_changed', function() {
                            var places = searchBox.getPlaces();

                            if (places.length == 0) {
                              return;
                            }

                            // Clear out the old markers.
                            markers.forEach(function(marker) {
                              marker.setMap(null);
                            });
                            markers = [];

                            // For each place, get the icon, name and location.
                            var bounds = new google.maps.LatLngBounds();
                            places.forEach(function(place) {
                              if (!place.geometry) {
                                console.log("Returned place contains no geometry");
                                return;
                              }
                              var icon = {
                                url: place.icon,
                                size: new google.maps.Size(71, 71),
                                origin: new google.maps.Point(0, 0),
                                anchor: new google.maps.Point(17, 34),
                                scaledSize: new google.maps.Size(25, 25)
                              };

                              // Create a marker for each place.
                              markers.push(new google.maps.Marker({
                                map: map,
                                icon: icon,
                                title: place.name,
                                position: place.geometry.location
                              }));

                              if (place.geometry.viewport) {
                                // Only geocodes have viewport.
                                bounds.union(place.geometry.viewport);
                              } else {
                                bounds.extend(place.geometry.location);
                              }
                            });
                            map.fitBounds(bounds);
                          });
                        }
                      </script>
                      <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDg8iN7O6Ey8uABfYvbZUbvClX8aFORxnU&libraries=places&callback=initAutocomplete" async defer></script>
                    </div>

                    <!-- Text input-->
                    <div class="form-group">
                      <label class="col-md-4 control-label" for="LoanAmountMax">Latitude</label>
                      <div class="col-md-5">
                      <input id="latclick" name="latitude_lokasi" value="<?php echo $databy["latitude_lokasi"]; ?>" type="text" class="form-control input-md" readonly>

                      </div>
                    </div>

                    <!-- Text input-->
                    <div class="form-group">
                      <label class="col-md-4 control-label" for="LoanAmountMax">Longitude</label>
                      <div class="col-md-5">
                      <input id="longclick" name="longitude_lokasi" value="<?php echo $databy["longitude_lokasi"]; ?>" type="text" class="form-control input-md" readonly>

                      </div>
                    </div>

                    <!-- Select Basic -->
                    <div class="form-group">
                      <label class="col-md-4 control-label" for="Loan Type">Skala Usaha</label>
                      <div class="col-md-5">
                        <select name="skala" class="form-control">
                          <?php
                          foreach($admin_dinas->tampil_skala() as $data){
                          ?>
                            <option value="<?php echo $data["skala_usaha"]; ?>"><?php echo $data["skala_usaha"]; ?></option>
                          <?php
                          }
                          ?>
                        </select>
                      </div>
                    </div>

                    <!-- Text input-->
                    <div class="form-group">
                      <label class="col-md-4 control-label" for="Loan Type">Sektor Usaha</label>
                      <div class="col-md-5">
                        <select name="sektor" class="form-control">
                          <?php
                          foreach($admin_dinas->tampil_sektor() as $data){
                          ?>
                            <option value="<?php echo $data["sektor_usaha"]; ?>"><?php echo $data["sektor_usaha"]; ?></option>
                          <?php
                          }
                          ?>
                        </select>
                      </div>
                    </div>

                    <!-- Text input-->
                    <div class="form-group">
                      <label class="col-md-4 control-label" for="Loan Type">Ganti Foto Usaha[1]</label>
                      <div class="col-md-5">
                        <img src="<?php echo $databy["foto_satu"]; ?>" width="100px" />
                        <input type="file" name="foto_satu" />
                        <input type="hidden" name="foto_satu_lama" value="<?php echo $databy["foto_satu"]; ?>" />
                      </div>
                    </div>

                    <!-- Text input-->
                    <div class="form-group">
                      <label class="col-md-4 control-label" for="Loan Type">Ganti Foto Usaha[2]</label>
                      <div class="col-md-5">
                        <img src="<?php echo $databy["foto_dua"]; ?>" width="100px" />
                        <input type="file" name="foto_dua" />
                        <input type="hidden" name="foto_dua_lama" value="<?php echo $databy["foto_dua"]; ?>" />
                      </div>
                    </div>

                    <!-- Text input-->
                    <div class="form-group">
                      <label class="col-md-4 control-label" for="Loan Type">Ganti Foto Usaha[3]</label>
                      <div class="col-md-5">
                        <img src="<?php echo $databy["foto_tiga"]; ?>" width="100px" />
                        <input type="file" name="foto_tiga" />
                        <input type="hidden" name="foto_tiga_lama" value="<?php echo $databy["foto_tiga"]; ?>" />
                      </div>
                    </div>

                    <!-- Text input-->
                    <div class="form-group">
                      <label class="col-md-4 control-label">Ganti Foto Usaha[4]</label>
                      <div class="col-md-5">
                        <img src="<?php echo $databy["foto_empat"]; ?>" width="100px" />
                        <input type="file" name="foto_empat" />
                        <input type="hidden" name="foto_empat_lama" value="<?php echo $databy["foto_empat"]; ?>" />
                      </div>
                    </div>

                    <!-- Text input-->
                    <div class="form-group">
                      <label class="col-md-4 control-label">Ganti Foto Usaha[5]</label>
                      <div class="col-md-5">
                        <img src="<?php echo $databy["foto_lima"]; ?>" width="100px" />
                        <input type="file" name="foto_lima" />
                        <input type="hidden" name="foto_lima_lama" value="<?php echo $databy["foto_lima"]; ?>" />
                      </div>
                    </div>

                    <!-- Text input-->
                    <div class="form-group">
                      <label class="col-md-4 control-label" for="LVR"></label>
                      <div class="col-md-5">
                      <input style="margin-bottom:10px;" type="submit" class="btn btn-primary" value="Simpan" name="ubah_usaha" />
                      </div>
                    </div>
                    <?php
                    }
                    ?>
                    </fieldset>
                    </form>
                  </div>
                </div>
                <?php
                }if($_GET['aksi'] == 'hapus_data'){
                    $id_usaha    = $_GET["id_usaha"];
                    $cek         = $pemilik_usaha->hapus_usaha($id_usaha);

                    if($cek){
                      echo '<script>alert("Data berhasil dihapus");</script>';
                      echo '<meta http-equiv="refresh" content="0; url=data_u_dinas.php"';

                    }else{
                      echo '<script>alert("Data gagal dihapus");</script>';
                    }
                  }if($_GET['aksi'] == 'ubah_statususaha_ya'){
                    $id_usaha = $_GET["id_usaha"];
                    $cek         = $admin_dinas->ubah_statususaha_ya($id_usaha);

                    echo '<meta http-equiv="refresh" content="0; url=data_u_dinas.php"';
                  }if($_GET['aksi'] == 'ubah_statususaha_tidak'){
                    $id_usaha = $_GET["id_usaha"];
                    $cek         = $admin_dinas->ubah_statususaha_tidak($id_usaha);

                    echo '<meta http-equiv="refresh" content="0; url=data_u_dinas.php"';
                  }
                }else{
                ?>
                <div class="col-md-10 content">
                  <a href="data_u_dinas.php?aksi=tambah_data"><button style="margin-bottom:10px;" type="button" class="btn btn-primary">Tambah</button></a>
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
                              <th>Nama Usaha</th>
                              <th>Pemilik Usaha</th>
                              <th>Produk Utama</th>
                              <th>Gambar Usaha</th>
                              <th>Status Usaha</th>
                              <th>Aksi</th>
                            </tr>
                          </thead>
                          <tbody id="myTable">
                            <?php
                            $i = 1;
                            foreach($admin_dinas->tampil_u_dinas() as $data){
                            ?>
                            <tr>
                              <th scope="row"><?php echo $i; ?></th>
                              <td><?php echo $data["nama"]; ?></td>
                              <td><?php echo $data["nama_pengusaha"]; ?></td>
                              <td><?php echo $data["produk"]; ?></td>
                              <td><img src="<?php echo $data["foto_satu"]; ?>" width="100px" /></td>
                              <td>
                                <?php
                                if($data["status_usaha"] == "T"){
                                  $statusnya = "<a href='data_u_dinas.php?aksi=ubah_statususaha_ya&id_usaha=".$data['id_usaha']."'><button class='btn btn-danger'>Tidak Aktif</button></a>";
                                }else if($data["status_usaha"] == "Y"){
                                  $statusnya = "<a href='data_u_dinas.php?aksi=ubah_statususaha_tidak&id_usaha=".$data['id_usaha']."'><button class='btn btn-success'>Aktif</button></a>";
                                }
                                echo $statusnya;
                                ?>
                              </td>
                              <td>
                                <a data-toggle="modal" href="#tampil_usaha"><button style="margin-bottom:10px;" type="button" class="btn btn-primary">Lihat Detail</button></a>
                                <a href="data_u_dinas.php?aksi=ubah_data&id_usaha=<?php echo $data['id_usaha']; ?>"><button style="margin-bottom:10px;" type="button" class="btn btn-success">Edit</button></a>
                                <a href="data_u_dinas.php?aksi=hapus_data&id_usaha=<?php echo $data['id_usaha']; ?>"><button style="margin-bottom:10px;" type="button" class="btn btn-danger">Hapus</button></a>
                              </td>
                            </tr>

                            <!-- BAGIAN MODAL -->
                            <div id="tampil_usaha" class="modal fade in">
                                <div class="modal-dialog">
                                    <div class="modal-content">

                                        <div class="modal-header">
                                            <a class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span></a>
                                        </div>
                                        <div class="modal-body">
                                          <h4>Tanggal Submit : <?php echo $data["tgl"]; ?></h4>
                                          <h4>Waktu Submit : <?php echo $data["waktu"]; ?></h4>
                                            <h4>
                                              <img src="<?php echo $data["foto_satu"]; ?>" width="100px" />
                                              <img src="<?php echo $data["foto_dua"]; ?>" width="100px"  />
                                              <img src="<?php echo $data["foto_tiga"]; ?>" width="100px" />
                                              <img src="<?php echo $data["foto_empat"]; ?>" width="100px" />
                                              <img src="<?php echo $data["foto_lima"]; ?>" width="100px" />
                                            </h4>
                                            <h4>Alamat : <?php echo $data["alamat"]; ?></h4>
                                            <h4>Kelurahan : <?php echo $data["kelurahan"]; ?></h4>
                                            <h4>Kecamatan : <?php echo $data["kecamatan"]; ?></h4>
                                            <h4>No Telepon : <?php echo $data["no_telp"]; ?></h4>
                                            BAGIAN MAP
                                            <h4>Skala Usaha : <?php echo $data["skala"]; ?></h4>
                                            <h4>Sektor Usaha : <?php echo $data["sektor"]; ?></h4>
                                        </div>
                                    </div><!-- /.modal-content -->
                                </div><!-- /.modal-dalog -->
                            </div><!-- /.modal -->
                            <?php
                            $i++;
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
