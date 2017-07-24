<?php
session_start();
include "../class/pemilik_usaha.php";
$pemilik_usaha = new pemilik_usaha();

include "../class/admin_dinas.php";
$admin_dinas = new admin_dinas();

//Cek Sesi
$ceksesi = $pemilik_usaha->ceksesi();
if(!$ceksesi){
  header("Location: ../index.php");
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
              <div class="col-md-10 content">
              	  <div class="panel panel-default">
                    <div class="panel-heading">
                  		<div class="row">
                        <div class="col col-xs-6">
                          </div>
                          <div class="col col-xs-6 text-right">
                          </div>
                      </div>
                  	</div>
                  	<div class="panel-body">
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
                </div>
                </div>
                </div>
          <?php
          include "pages/footer.php";
          ?>
  </body>
</html>
