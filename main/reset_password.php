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

if(isset($_POST["reset_submit_password"])){
  $email = $_POST["email"];
  $password_satu = $_POST["password_satu"];
  $password_dua = $_POST["password_dua"];

  $cek = $pengunjung->reset_password($email, $password_satu, $password_dua);
  if ($cek) {
    echo '<script>alert("Password berhasil direset, silahkan login");</script>';
    echo '<meta http-equiv="refresh" content="0; url=index.php"';
  }else{
    echo '<script>alert("Password gagal di reset, tidak cocok");</script>';
  }
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>.: Reset Password :.</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/admin.css" />
    <link rel="stylesheet" href="../assets/style.css" />
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.min.css">
    <link rel="SHORTCUT ICON" href="../assets/icon.png" />
  </head>
<body>
  <!-- Modal -->
  <div id="reset_password" class="modal fade" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Reset Password</h4>
        </div>
        <div class="modal-body">
          <form action="reset_password.php" method="POST">
            <div class="form-group">
              <label for="pwd">Masukan Password Baru</label>
              <input type="hidden" class="form-control" value="<?php echo $_SESSION["email_lupas"]; ?>" name="email" required autofocus>
              <input placeholder="Masukan Password" type="password" class="form-control" name="password_satu" required autofocus>
            </div>
            <div class="form-group">
              <label for="pwd">Masukan Lagi</label>
              <input placeholder="Masukan Password Lagi" type="password" class="form-control" name="password_dua" required autofocus>
            </div>
            <div class="form-group">
              <label></label>
              <input type="submit" class="btn btn-lg btn-success btn-block btn-signin" name="reset_submit_password" value="Kirim" required autofocus>
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
        $('#reset_password').modal('show');
    });
</script>
