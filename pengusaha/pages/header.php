<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>.: Pengusaha :.</title>

<!-- Bootstrap CSS -->
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
<link rel="stylesheet" href="../assets/admin.css" />
<link rel="stylesheet" href="../assets/style.css" />
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.min.css">
<link rel="SHORTCUT ICON" href="../assets/icon.png" />

<?php
//logout
if (isset($_GET["aksi"])) {
  if($_GET["aksi"] == "logout"){
    $cek = $pemilik_usaha->logout();
  }
}
?>
