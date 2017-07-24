<?php
session_start();
include "../class/pengunjung_web.php";
$pengunjung = new pengunjung_web;

include "../class/admin_dinas.php";
$admin_dinas = new admin_dinas;

if (isset($_POST['daftar'])) {
  //Gambar
  $target_dir   = "../assets/foto_ktp/";
  $foto         = $target_dir.basename($_FILES["foto_ktp"]["name"]);
  $error        = $_FILES["foto_ktp"]["error"];
  $cek_extensi  = pathinfo($foto,PATHINFO_EXTENSION);
  $pindahgambar = $_FILES["foto_ktp"]["tmp_name"];

  // Ke Database
  $no_ktp   = $_POST["no_ktp"];
  $nama_pengusaha   = $_POST["nama_pengusaha"];
  $email    = $_POST["email"];
  $password = $_POST["password"];
  $alamat   = $_POST["alamat"];
  $tempat_lahir = $_POST["tempat_lahir"];
  $tgl_lahir    = $_POST["tgl_lahir"];
  $status_akun  = "T";

  $cek = $pengunjung->daftar_pengusaha($no_ktp, $nama_pengusaha, $email, $password, $alamat, $tempat_lahir, $tgl_lahir, $foto, $status_akun);
  if($cek) {
    move_uploaded_file($pindahgambar, $foto);
    echo '<script>alert("Pendaftaran Berhasil, cek inbox/spam untuk pemberitahuan pengaktifan akun");</script>';
    echo '<meta http-equiv="refresh" content="0; url=index.php"';
  }else{
    echo '<script>alert("Pendaftaran Gagal, Silahkan cek kembali form isian");</script>';
  }
}

if (isset($_POST['login'])) {
  $no_ktp = $_POST['no_ktp'];
  $password = $_POST['password'];

  $cek = $pengunjung->login_pengusaha($no_ktp, $password);
  if($cek) {
    echo '<script>alert("Login berhasil");</script>';
    echo '<meta http-equiv="refresh" content="0; url=../pengusaha/">';
  }else{
    echo '<script>alert("Maaf, input data salah / akun belum di aktifasi");</script>';
    echo '<meta http-equiv="refresh" content="0; url=index.php">';
  }
}

if (isset($_POST['lupas'])) {
  $email      = $_POST['email_lupas'];
  $randomcode = "LP".rand(1, 1000);

  $cek = $pengunjung->lupa_password($email, $randomcode);
  if ($cek) {
    echo '<script>alert("Kode konfirmasi telah dikirim, silahkan cek email");</script>';
    echo '<meta http-equiv="refresh" content="0; url=konfirmasi_lupas.php"';
  }else{
    echo '<script>alert("Email tidak terdapat di database");</script>';
  }
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Dinas Usaha Kota Bandung</title>
    <link rel="stylesheet" href="../assets/main.css">
    <link rel="stylesheet" href="../assets/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/search.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css">
    <script src="../assets/jquery-1.11.0.min.js"></script>
    <script src="../assets/bootstrap.min.js"></script>
    <link rel="SHORTCUT ICON" href="../assets/icon.png" />
  </head>
  <body>
    <!-- Modal -->
    <div id="tentang_website" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Tentang Website</h4>
          </div>
          <div class="modal-body">
            <p>Melalui website ini, Anda dapat melihat informasi lengkap seputar usaha di Kota Bandung, seperti nama usaha, pemilik usaha, produk, alamat, skala usaha, peta alamat usaha, dan informasi-informasi lainnya.</p>
            <p>Website ini memberi kemudahan kepada Anda untuk mencari informasi usaha dengan menggunakan fitur Pencarian dan Filterasi. Dengan fitur Filtrasi, Anda dapat menyaring informasi berdasarkan kecamatan, kelurahan, jenis usaha, ataupun sektor Usaha.</p>
            <p>Website ini cocok bagi Anda yang ingin membuat usaha baru ataupun mengembangkan usaha yang telah ada. Dengan berbagai fitur yang telah disediakan, Anda dimudahkan untuk menentukan jenis usaha yang akan dibangun, lokasi yang tepat dan strategis, serta keputusan-keputusan lainnya yang dapat Anda putuskan dengan menggunakan semua informasi yang ada.</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
          </div>
        </div>

      </div>
    </div>

    <!-- Modal -->
    <div id="lupa_password" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Lupa Password</h4>
          </div>
          <div class="modal-body">
            <form action="index.php" method="post">
            <div class="form-group">
              <label for="pwd">Masukan Email</label>
              <input placeholder="Masukan Email Anda..." type="email" class="form-control" name="email_lupas" required autofocus>
            </div>
            <div class="form-group">
              <label></label>
              <input type="submit" class="btn btn-lg btn-success btn-block btn-signin" name="lupas" value="Kirim" required autofocus>
            </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
          </div>
        </div>

      </div>
    </div>

    <!-- Modal -->
    <div id="daftar_pengusaha" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Daftar Pengusaha</h4>
          </div>
          <form action="index.php" method="POST" enctype="multipart/form-data">
          <div class="modal-body">
            <div class="form-group">
              <label>No KTP :</label>
              <input type="text" class="form-control" placeholder="Masukan No. KTP" name="no_ktp" required autofocus />
            </div>
            <div class="form-group">
              <label>Nama Pengusaha :</label>
              <input type="text" class="form-control" placeholder="Masukan Nama Pengusaha" name="nama_pengusaha" required autofocus />
            </div>
            <div class="form-group">
              <label>Email :</label>
              <input type="text" class="form-control" placeholder="Masukan Email" name="email" required autofocus >
            </div>
            <div class="form-group">
              <label>Password :</label>
              <input type="password" class="form-control" placeholder="Masukan Password" name="password" required autofocus>
            </div>
            <div class="form-group">
              <label>Alamat :</label>
              <textarea type="text" class="form-control" placeholder="Masukan Alamat" name="alamat" required autofocus></textarea>
            </div>
            <div class="form-group">
              <label>Tempat Lahir :</label>
              <input type="text" class="form-control" placeholder="Masukan Tempat Lahir" name="tempat_lahir" required autofocus>
            </div>
            <div class="form-group">
              <label>Tanggal Lahir :</label>
              <input type="text" class="form-control" placeholder="Masukan Tanggal Lahir" name="tgl_lahir" required autofocus>
            </div>
            <div class="form-group">
              <label>Foto KTP :</label>
              <input type="file" placeholder="Masukan Foto KTP" name="foto_ktp" required autofocus>
            </div>
            <div class="form-group">
              <label></label>
              <input type="submit" class="btn btn-lg btn-success btn-block btn-signin" name="daftar" value="Daftar" required autofocus>
            </div>
          </div>
          </form>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
          </div>
        </div>

      </div>
    </div>

    <nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header page-scroll">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php"><img style="float:left;margin-right:10px" src="../assets/icon.png" width="20px" />Dinas Usaha Kota Bandung</a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <li class="hidden">
                    <a href="#page-top"></a>
                </li>
                <li class="page-scroll">
                    <a href="#peta_usaha">Peta Usaha</a>
                </li>
                <li class="page-scroll">
                    <a href="#login_pengusaha">Login Pengusaha</a>
                </li>
                <li class="page-scroll">
                    <a href="#" data-toggle="modal" data-target="#tentang_website">Tentang Website</a>
                </li>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container-fluid -->
    </nav>
    <div class="container">
      <!-- Modal -->
      <div class="modal fade" id="daftar" role="dialog">
        <div class="modal-body">
          <div class="container">
              <div class="card card-container">
                  <!-- <img class="profile-img-card" src="//lh3.googleusercontent.com/-6V8xOA6M7BA/AAAAAAAAAAI/AAAAAAAAAAA/rzlHcD0KYwo/photo.jpg?sz=120" alt="" /> -->
                  <img id="profile-img" class="profile-img-card" src="//ssl.gstatic.com/accounts/ui/avatar_2x.png" />
                  <p id="profile-name" class="profile-name-card"></p>
                  <form class="form-signin" method="POST" action="index.php">
                      <span id="reauth-email" class="reauth-email"></span>
                      <input type="submit" style="cursor:pointer;" class="btn btn-lg btn-primary btn-block btn-signin" value="Login" name="daftar" />
                  </form><!-- /form -->
              </div><!-- /card-container -->
          </div><!-- /container -->
        </div>
      </div>
    </div>
    <div class="content-wrapper">
        <section class="primary" id="peta_usaha">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <h2>INFORMASI USAHA DI KOTA BANDUNG</h2>
                        <hr class="star-primary">
                    </div>
                </div>
                <div class="row">
                  <!-- TABLE DATA -->
                  <div class="col-md-12 content">
              			  <div class="panel panel-default" style="overflow-x:scroll">
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
                                <th>Skala</th>
                                <th>Sektor</th>
                                <th>Status Usaha</th>
                              </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                  <th>No</th>
                                  <th>Nama Usaha</th>
                                  <th>Pemilik Usaha</th>
                                  <th>Produk Utama</th>
                                  <th>Alamat</th>
                                  <th>Kecamatan</th>
                                  <th>Kelurahan</th>
                                  <th>No. Telp</th>
                                  <th>Skala</th>
                                  <th>Sektor</th>
                                  <th>Status Usaha</th>
                                </tr>
                            </tfoot>
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
                                <td><?php echo $data["kelurahan"]; ?></td>
                                <td><?php echo $data["kecamatan"]; ?></td>
                                <td><?php echo $data["no_telp"]; ?></td>
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
                </div>
                    <div id="map" style="width:100%;height:600px;"></div>
                    <script type="text/javascript">

                    function initMap() {
                       var myLatLng = {lat: -6.9025157, lng: 107.6165933};

                       // Create a map object and specify the DOM element for display.
                       var map = new google.maps.Map(document.getElementById('map'), {
                         center: myLatLng,
                         scrollwheel: false,
                         zoom: 13,
                         mapTypeId: google.maps.MapTypeId.ROADMAP
                       });

                       // Tambahkan Marker
                          var locations = [
                            <?php
                            foreach($admin_dinas->tampil_usaha() as $data){
                              if($data["status_usaha"] == "Y"){
                            ?>
                              ['<?php echo $data["nama"]; ?>', '<?php echo $data["produk"]; ?>', '<?php echo $data["alamat"]; ?>', '<?php echo $data["kelurahan"]; ?>', '<?php echo $data["kecamatan"]; ?>', '<?php echo $data["no_telp"]; ?>', '<?php echo $data["latitude_lokasi"]; ?>', '<?php echo $data["longitude_lokasi"]; ?>', '<?php echo $data["skala"]; ?>', '<?php echo $data["sektor"]; ?>', '<?php echo $data["foto_satu"]; ?>', '<?php echo $data["foto_dua"]; ?>', '<?php echo $data["foto_tiga"]; ?>', '<?php echo $data["foto_empat"]; ?>', '<?php echo $data["foto_lima"]; ?>'],
                            <?php
                              }
                            }
                            ?>
                         ];
                        var infowindow = new google.maps.InfoWindow();

                         /* kode untuk menampilkan banyak marker */
                        for (var i = 0; i < locations.length; i++) {
                          var marker = new google.maps.Marker({
                            position: new google.maps.LatLng(locations[i][6], locations[i][7]),
                            map: map
                            //icon: '../assets/grad-icon.png'
                        });

                        google.maps.event.addListener(marker, 'click', (function(marker, i) {
                          return function() {
                            infowindow.setContent("Nama Usaha : " + locations[i][0] + "<br> Produk : " + locations[i][1] + "<br> Alamat : " + locations[i][2] + "<br> Kelurahan : " + locations[i][3] + "<br> Kecamatan : " + locations[i][4] + "<br> No. Telepon : " + locations[i][5] + "<br> Skala : " + locations[i][8] + "<br> Sektor : " + locations[i][9] + "<br><br><img src='" + locations[i][10] + "' width='50px' />&nbsp;<img src='" + locations[i][11] + "' width='50px' />&nbsp;<img src='" + locations[i][12] + "' width='50px' />&nbsp;<img src='" + locations[i][13] + "' width='50px' />&nbsp;<img src='" + locations[i][14] + "' width='50px' />");
                            infowindow.open(map, marker);
                          }
                        })(marker, i));

                         /* menambahkan event clik untuk menampikan
                            infowindows dengan isi sesuai denga
                         marker yang di klik */

                 }
               }

                 	</script>
                  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDg8iN7O6Ey8uABfYvbZUbvClX8aFORxnU&callback=initMap" async defer></script>

                  <!-- TABLE DATA -->

            </div>
        </section>
    <?php
    //Cek Sesi
    $ceksesi = $pengunjung->ceksesi();
    if($ceksesi){
      //Empty Form
    }else{
    ?>
        <section class="success" id="login_pengusaha">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <h2>LOGIN PENGUSAHA</h2>
                        <hr class="star-primary">
                    </div>
                </div>
                        <!-- <img class="profile-img-card" src="//lh3.googleusercontent.com/-6V8xOA6M7BA/AAAAAAAAAAI/AAAAAAAAAAA/rzlHcD0KYwo/photo.jpg?sz=120" alt="" /> -->
                        <form class="form-signin" method="POST" action="index.php">
                            <div class="form-group">
                              <label for="usr">No. KTP :</label>
                              <input type="text" class="form-control" id="usr" name="no_ktp" />
                            </div>
                            <div class="form-group">
                              <label for="pwd">Password :</label>
                              <input type="password" class="form-control" id="pwd" name="password" >
                            </div>
                            <input type="submit" style="cursor:pointer;" class="btn btn-lg btn-primary btn-block btn-signin" value="Login" name="login" />
                        </form><!-- /form -->
                        <br>
                        <button style="cursor:pointer;" class="btn btn-lg btn-danger btn-block btn-signin" data-toggle="modal" data-target="#lupa_password" />Lupa Password</button>
                        <br/>
                        <button style="cursor:pointer;" class="btn btn-lg btn-success btn-block btn-signin" data-toggle="modal" data-target="#daftar_pengusaha" />Daftar Pengusaha</button>
            </div>
        </section>
      <?php
      }
      ?>
        <footer class="container-fluid" style="min-height:110px; background-color:black;color:#fff;text-align:center;padding-top:50px;">
            Dinas Usaha Kota Bandung © 2017
        </footer>
    </div>
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript">
      $('#laporan_data').DataTable( {
          initComplete: function () {
              this.api().columns().every( function () {
                  var column = this;
                  var select = $('<select><option value=""></option></select>')
                      .appendTo( $(column.footer()).empty() )
                      .on( 'change', function () {
                          var val = $.fn.dataTable.util.escapeRegex(
                              $(this).val()
                          );

                          column
                              .search( val ? '^'+val+'$' : '', true, false )
                              .draw();
                      } );

                  column.data().unique().sort().each( function ( d, j ) {
                      select.append( '<option value="'+d+'">'+d+'</option>' )
                  } );
              } );
          }
      } );
    </script>
  </body>
</html>
