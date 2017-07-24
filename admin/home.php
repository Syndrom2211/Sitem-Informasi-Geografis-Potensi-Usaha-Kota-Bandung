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
?>
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
                    Selamat Datang di halaman administrator
                </div>
                </div>
                </div>
          <?php
          include "pages/footer.php";
          ?>
  </body>
</html>
