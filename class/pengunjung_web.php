<?php
include_once("../koneksi.php");

class pengunjung_web extends Koneksi{
  // Pendaftaran Pengusaha
  public $no_ktp;
  public $nama_pengusaha;
  public $email;
  public $password;
  public $alamat;
  public $tempat_lahir;
  public $tgl_lahir;
  public $foto;
  public $status_akun;

  public function daftar_pengusaha($no_ktp, $nama_pengusaha, $email, $password, $alamat, $tempat_lahir, $tgl_lahir, $foto, $status_akun){
    $this->no_ktp   = $no_ktp;
    $this->nama_pengusaha   = $nama_pengusaha;
    $this->email    = $email;
    $this->password = $password;
    $this->alamat   = $alamat;
    $this->tempat_lahir = $tempat_lahir;
    $this->tgl_lahir    = $tgl_lahir;
    $this->foto         = $foto;
    $this->status_akun  = $status_akun;

    $sql = "INSERT INTO akun_pengusaha VALUES('".$this->no_ktp."','".$this->nama_pengusaha."','".$this->email."','".md5($this->password)."','".$this->alamat."','".$this->tempat_lahir."','".$this->tgl_lahir."','".$this->foto."','".$this->status_akun."')";
    $eksekusi = $this->koneksi->query($sql);

    return TRUE;
  }

  public function login_pengusaha($no_ktp, $password){
    $this->no_ktp = $no_ktp;
    $this->password = $password;

    $sql      = "SELECT * FROM akun_pengusaha WHERE no_ktp='".$this->no_ktp."' AND password = '".md5($this->password)."'";
    $eksekusi = $this->koneksi->query($sql);
    $data     = $eksekusi->fetch_array(MYSQLI_ASSOC);

    if ($data["status_akun"] == "Y") {
      $sesi_cek = $eksekusi->num_rows;
      if($sesi_cek == 1){
        $_SESSION["status_pengusaha"]   = TRUE;
        $_SESSION["no_ktp"]   = $data["no_ktp"];
        $_SESSION["nama_pengusaha"]   = $data["nama_pengusaha"];
        $_SESSION["alamat"]   = $data["alamat"];
        $_SESSION["status_akun"] = $data["status_akun"];
        return TRUE;
      }
    }if ($data["status_akun"] == "T") {
      $sesi_cek = $eksekusi->num_rows;
      if($sesi_cek == 1){
        return FALSE;
      }
    }
  }

  public function lupa_password($email, $randomcode){
    $this->email = $email;

    $sql      = "SELECT * FROM akun_pengusaha WHERE email = '".$this->email."'";
    $eksekusi = $this->koneksi->query($sql);
    $data     = $eksekusi->fetch_array(MYSQLI_ASSOC);
    $sesi_cek = $eksekusi->num_rows;

    if($sesi_cek == 1){
        $_SESSION['email_lupas'] = $email;
        $sql = "INSERT INTO data_konfirmasi_lupas VALUES(NULL, '".$this->email."', '".$randomcode."')";
        $eksekusi = $this->koneksi->query($sql);

        //bagian kirim ke email
        $header .= "Content-Type: text/html; charset=iso-8859-1\r\n"; 
        $header .= "Reply-To: Pengusaha <".$this->no_ktp.">\r\n"; 
        $header .= "Return-Path: Admin Dinas Usaha \r\n"; 
        $header .= "From: Admin Dinas Usaha \r\n"; 
        $header .= "Organization: gis.kotabandung.firdamdam.id\r\n";
    
        //$to = "siapakita2211@gmail.com";
        $to = $email;
        $subject = "Hi, Diberitahukan untuk <".$email."> dari Dinas Usaha Kota Bandung";
        $message = "Assalamualaikum..<br>Pemberitahuan Kami sampaikan bahwa akun dengan email ".$email." yang melakukan reset password, bahwa kode nya adalah <b>".$randomcode."</b>, terima kasih...";
        @mail($to, $subject, $message, $header);
    
        return TRUE;
    }if($sesi_cek == 0){
        return FALSE;
    }
  }

  public function konfirmasi_lupas($email, $kode){
    $this->email = $email;

    $sql      = "SELECT * FROM data_konfirmasi_lupas WHERE email = '".$this->email."' AND kode = '".$kode."'";
    $eksekusi = $this->koneksi->query($sql);
    $data     = $eksekusi->fetch_array(MYSQLI_ASSOC);
    $sesi_cek = $eksekusi->num_rows;

    if($sesi_cek == 1){
        $_SESSION["id_konfirmasi"] = $data["id_konfirmasi"];
        return TRUE;
    }if($sesi_cek == 0){
        return FALSE;
    }
  }

  public function reset_password($email, $password_satu, $password_dua){
    if($password_satu != $password_dua){
      return FALSE;
    }else{
      $sql = "UPDATE akun_pengusaha SET password = '".md5($password_satu)."' WHERE email = '".$email."'";
      $eksekusi = $this->koneksi->query($sql);
      return TRUE;
    }
  }

  public function ceksesi(){
    return isset($_SESSION["status_pengusaha"]);
  }

  public function ceksesi_konfirmasi(){
    return isset($_SESSION["email_lupas"]);
  }
}
?>
