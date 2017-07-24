<?php
session_start();

//Instansiasi Class Admin Dinas
include "../class/pengunjung_web.php";
$pengunjung = new pengunjung_web();

//Cek Sesi
$ceksesi = $pengunjung->ceksesi_konfirmasi();
if(!$ceksesi){
  header("Location: index.php");
}

if(isset($_POST["konfirmasi_kode"])){
  $email = $_SESSION["email_lupas"];
  $kode = $_POST["kode"];

  $cek = $pengunjung->konfirmasi_lupas($email, $kode);
  if ($cek) {
    echo '<script>alert("Kode cocok, silahkan reset password anda");</script>';
    echo '<meta http-equiv="refresh" content="0; url=reset_password.php"';
  }else{
    echo '<script>alert("Kode tidak cocok, silahkan isi dengan benar");</script>';
  }
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>.: Konfirmasi Lupa Password :.</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/admin.css" />
    <link rel="stylesheet" href="../assets/style.css" />
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.min.css">
    <link rel="SHORTCUT ICON" href="../assets/icon.png" />
  </head>
<body>
  <?php
  if (isset($_POST["konfirmasi_kode"])) {
    ?>
    <script type="text/javascript">
        $(window).on('load',function(){
            $('#reset_password').modal('show');
        });
    </script>
    <?php
  }
  ?>

  <!-- Modal -->
  <div id="konfirmasi" class="modal fade" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Konfirmasi Lupa Password</h4>
        </div>
        <div class="modal-body">
          <form action="konfirmasi_lupas.php" method="POST">
            <div class="form-group">
              <label for="pwd">Masukan Kode Konfirmasi</label>
              <input placeholder="Kode Konfirmasi" type="text" class="form-control" name="kode" required autofocus>
            </div>
            <div class="form-group">
              <label></label>
              <input type="submit" class="btn btn-lg btn-success btn-block btn-signin" name="konfirmasi_kode" value="Kirim" required autofocus>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
        </div>
      </div>

    </div>
  </div>
</body>

<script src="../assets/jquery-1.11.0.min.js"></script>
<script src="../assets/bootstrap.min.js"></script>
<script type="text/javascript">
    $(window).on('load',function(){
        $('#konfirmasi').modal('show');
    });
</script>
