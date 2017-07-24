<?php
session_start();

//Instansiasi Class Admin Dinas
include "../class/admin_dinas.php";
$admin_dinas = new admin_dinas();

//Cek Sesi
$ceksesi = $admin_dinas->ceksesi();
if($ceksesi){
  header("Location: home.php");
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <?php include "pages/header.php"; ?>
  </head>
  <body>
    <?php
    if (isset($_POST["login_dinas"])) {
      $nip      = $_POST['nip'];
      $password = $_POST['password'];

      $cek = $admin_dinas->login($nip, $password);
      if ($cek) {
        echo '<script>alert("Login Berhasil");</script>';
        echo '<meta http-equiv="refresh" content="0; url=home.php">';
      }else {
        echo '<script>alert("Login Gagal");</script>';
        echo '<meta http-equiv="refresh" content="0; url=index.php">';
      }
    }
    ?>

    <div class="container">
        <div class="card card-container">
            <!-- <img class="profile-img-card" src="//lh3.googleusercontent.com/-6V8xOA6M7BA/AAAAAAAAAAI/AAAAAAAAAAA/rzlHcD0KYwo/photo.jpg?sz=120" alt="" /> -->
            <center><img id="profile-img" src="../assets/icon.png" width="100px" /></center>
            <p id="profile-name" class="profile-name-card"></p>
            <form class="form-signin" method="post" name="admin_dinas" action="index.php">
                <span id="reauth-email" class="reauth-email"></span>
                <input type="text" id="inputEmail" class="form-control" placeholder="NIP" name="nip" required autofocus>
                <input type="password" id="inputPassword" class="form-control" placeholder="Password" name="password" required>

                <input type="submit" style="cursor:pointer;" class="btn btn-lg btn-primary btn-block btn-signin" value="Login" name="login_dinas" />
            </form><!-- /form -->
        </div><!-- /card-container -->
    </div><!-- /container -->
    <script src="../assets/jquery-1.11.0.min.js"></script>
    <script src="../assets/bootstrap.min.js"></script>
  </body>
</html>
