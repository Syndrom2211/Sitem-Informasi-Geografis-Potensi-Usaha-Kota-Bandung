<?php
include_once("../koneksi.php");

class admin_dinas extends Koneksi{
  private $id_kecamatan;
  private $kecamatan;
  private $kelurahan;
  private $kota;
  private $kode_pos;
  public $id_akun;
  public $nip;
  public $password;
  public $no_ktp;
  public $nama_pengusaha;
  public $email;
  public $alamat;
  public $tempat_lahir;
  public $tanggal_lahir;
  public $foto_ktp;
  public $status_akun;

  /* =========== LOGIN ADMIN DINAS =========== */
  public function login($datanip, $datapassword){
    $this->nip      = $datanip;
    $this->password = $datapassword;

    $sql      = "SELECT * FROM akun_dinas WHERE nip = '".$this->nip."' AND password = '".md5($this->password)."'";
    $eksekusi = $this->koneksi->query($sql);
    $data     = $eksekusi->fetch_array(MYSQLI_ASSOC);
    $sesi_cek = $eksekusi->num_rows;

    if($sesi_cek == 1){
        $_SESSION["status_admin"] = TRUE;
        $_SESSION["id_akun"]   = $data["id_akun"];
        $_SESSION["nip"]       = $data["nip"];
        return TRUE;
    }
  }

  public function logout(){
    $_SESSION["status_admin"] = FALSE;
    session_destroy();
    header("Location: index.php");
  }

  public function ceksesi(){
    return isset($_SESSION["status_admin"]);
  }


  /* =========== FUNGSI KECAMATAN =========== */
  public function tambah_kecamatan($datakecamatan){
    for($i=0;$i<count($datakecamatan);$i++){
      $this->kecamatan=$datakecamatan[$i];

      $sql      = "INSERT INTO data_kecamatan VALUES(NULL,'".$this->kecamatan."')";
      $eksekusi = $this->koneksi->query($sql);
    }

    return TRUE;
  }

  public function tampil_kecamatan(){
    $sql       = "SELECT * FROM data_kecamatan ORDER BY kecamatan ASC";
    $eksekusi  = $this->koneksi->query($sql);

    while($data = $eksekusi->fetch_array(MYSQLI_ASSOC)){
      $hasil[] = $data;
    }

    return $hasil;
  }

  public function tampil_kecamatan_byid($id_kecamatan){
    $this->id_kecamatan = $id_kecamatan;

    $sql       = "SELECT * FROM data_kecamatan WHERE id_kecamatan = '".$this->id_kecamatan."'";
    $eksekusi  = $this->koneksi->query($sql);

    while($data = $eksekusi->fetch_array(MYSQLI_ASSOC)){
      $hasil[] = $data;
    }

    return $hasil;
  }

  public function edit_kecamatan($dataid_kecamatan, $datakecamatan){
    $this->id_kecamatan  = $dataid_kecamatan;
    $this->kecamatan     = $datakecamatan;

    $sql = "UPDATE data_kecamatan SET kecamatan = '".$this->kecamatan."' WHERE id_kecamatan = '".$this->id_kecamatan."'";
    $eksekusi = $this->koneksi->query($sql);

    return TRUE;
  }

  public function hapus_kecamatan($id_kecamatan){
    $this->id_kecamatan = $id_kecamatan;

    $sql      = "DELETE FROM data_kecamatan WHERE id_kecamatan = '".$this->id_kecamatan."'";
    $eksekusi = $this->koneksi->query($sql);

    return TRUE;
  }


  /* =========== FUNGSI KELURAHAN =========== */
  public function tambah_kelurahan($datakelurahan){
    for($i=0;$i<count($datakelurahan);$i++){
      $this->kelurahan=$datakelurahan[$i];

      $sql      = "INSERT INTO data_kelurahan VALUES(NULL,'".$this->kelurahan."')";
      $eksekusi = $this->koneksi->query($sql);
    }

    return TRUE;
  }

  public function tampil_kelurahan(){
    $sql       = "SELECT * FROM data_kelurahan ORDER BY kelurahan ASC";
    $eksekusi  = $this->koneksi->query($sql);

    while($data = $eksekusi->fetch_array(MYSQLI_ASSOC)){
      $hasil[] = $data;
    }

    return $hasil;
  }

  public function tampil_kelurahan_byid($id_kelurahan){
    $this->id_kelurahan = $id_kelurahan;

    $sql       = "SELECT * FROM data_kelurahan WHERE id_kelurahan = '".$this->id_kelurahan."'";
    $eksekusi  = $this->koneksi->query($sql);

    while($data = $eksekusi->fetch_array(MYSQLI_ASSOC)){
      $hasil[] = $data;
    }

    return $hasil;
  }

  public function edit_kelurahan($dataid_kelurahan, $datakelurahan){
    $this->id_kelurahan  = $dataid_kelurahan;
    $this->kelurahan     = $datakelurahan;

    $sql = "UPDATE data_kelurahan SET kelurahan = '".$this->kelurahan."' WHERE id_kelurahan = '".$this->id_kelurahan."'";
    $eksekusi = $this->koneksi->query($sql);

    return TRUE;
  }

  public function hapus_kelurahan($id_kelurahan){
    $this->id_kelurahan = $id_kelurahan;

    $sql      = "DELETE FROM data_kelurahan WHERE id_kelurahan = '".$this->id_kelurahan."'";
    $eksekusi = $this->koneksi->query($sql);

    return TRUE;
  }

  /* =========== FUNGSI WILAYAH =========== */
  public function tambah_wilayah($datakota, $datakecamatan, $datakelurahan, $datakode_pos){
    for($i=0;$i<count($datakota);$i++){
      $this->kota          = $datakota[$i];
      $this->kecamatan     = $datakecamatan[$i];
      $this->kelurahan     = $datakelurahan[$i];
      $this->kode_pos      = $datakode_pos[$i];

      $sql   = "INSERT INTO data_wilayah VALUES (NULL, '".$this->kecamatan."', '".$this->kelurahan."', '".$this->kota."', '".$this->kode_pos."')";
      $eksekusi = $this->koneksi->query($sql);
    }

    return TRUE;
  }

  public function tampil_wilayah(){
    $sql       = "SELECT * FROM data_wilayah, data_kecamatan, data_kelurahan WHERE data_wilayah.id_kecamatan = data_kecamatan.id_kecamatan AND data_wilayah.id_kelurahan = data_kelurahan.id_kelurahan ORDER BY data_kecamatan.kecamatan ASC";
    $eksekusi  = $this->koneksi->query($sql);

    while($data = $eksekusi->fetch_array(MYSQLI_ASSOC)){
      $hasil[] = $data;
    }

    return $hasil;
  }

  public function tampil_wilayah_byid($id_wilayah){
    $this->id_wilayah = $id_wilayah;

    $sql       = "SELECT * FROM data_wilayah, data_kelurahan, data_kecamatan WHERE data_wilayah.id_kecamatan = data_kecamatan.id_kecamatan AND data_wilayah.id_kelurahan = data_kelurahan.id_kelurahan AND data_wilayah.id_wilayah = '".$this->id_wilayah."'";
    $eksekusi  = $this->koneksi->query($sql);

    while($data = $eksekusi->fetch_array(MYSQLI_ASSOC)){
      $hasil[] = $data;
    }

    return $hasil;
  }

  public function edit_wilayah($dataid_wilayah, $datakota, $datakecamatan, $datakelurahan, $datakode_pos){
    $this->id_wilayah = $dataid_wilayah;
    $this->kota       = $datakota;
    $this->kecamatan  = $datakecamatan;
    $this->kelurahan  = $datakelurahan;
    $this->kode_pos   = $datakode_pos;

    $sql = "UPDATE data_wilayah SET kota = '".$this->kota."', id_kecamatan = '".$this->kecamatan."', id_kelurahan = '".$this->kelurahan."', kode_pos = '".$this->kode_pos."' WHERE id_wilayah = '".$this->id_wilayah."'";
    $eksekusi = $this->koneksi->query($sql);

    return TRUE;
  }

  public function hapus_wilayah($id_wilayah){
    $this->id_wilayah = $id_wilayah;

    $sql      = "DELETE FROM data_wilayah WHERE id_wilayah = '".$this->id_wilayah."'";
    $eksekusi = $this->koneksi->query($sql);

    return TRUE;
  }

  /* =========== FUNGSI sektor =========== */
  public function tambah_sektor($datasektor){
    for($i=0;$i<count($datasektor);$i++){
      $this->sektor=$datasektor[$i];

      $sql      = "INSERT INTO data_sektorusaha VALUES(NULL,'".$this->sektor."')";
      $eksekusi = $this->koneksi->query($sql);
    }

    return TRUE;
  }

  public function tampil_sektor(){
    $sql       = "SELECT * FROM data_sektorusaha ORDER BY sektor_usaha ASC";
    $eksekusi  = $this->koneksi->query($sql);

    while($data = $eksekusi->fetch_array(MYSQLI_ASSOC)){
      $hasil[] = $data;
    }

    return $hasil;
  }

  public function tampil_sektor_byid($id_sektor){
    $this->id_sektor = $id_sektor;

    $sql       = "SELECT * FROM data_sektorusaha WHERE id_sektor = '".$this->id_sektor."'";
    $eksekusi  = $this->koneksi->query($sql);

    while($data = $eksekusi->fetch_array(MYSQLI_ASSOC)){
      $hasil[] = $data;
    }

    return $hasil;
  }

  public function edit_sektor($dataid_sektor, $datasektor){
    $this->id_sektor  = $dataid_sektor;
    $this->sektor     = $datasektor;

    $sql = "UPDATE data_sektorusaha SET sektor_usaha = '".$this->sektor."' WHERE id_sektor = '".$this->id_sektor."'";
    $eksekusi = $this->koneksi->query($sql);

    return TRUE;
  }

  public function hapus_sektor($id_sektor){
    $this->id_sektor = $id_sektor;

    $sql      = "DELETE FROM data_sektorusaha WHERE id_sektor = '".$this->id_sektor."'";
    $eksekusi = $this->koneksi->query($sql);

    return TRUE;
  }

  /* =========== FUNGSI skala =========== */
  public function tambah_skala($dataskala){
    for($i=0;$i<count($dataskala);$i++){
      $this->skala=$dataskala[$i];

      $sql      = "INSERT INTO data_skalausaha VALUES(NULL,'".$this->skala."')";
      $eksekusi = $this->koneksi->query($sql);
    }

    return TRUE;
  }

  public function tampil_skala(){
    $sql       = "SELECT * FROM data_skalausaha ORDER BY skala_usaha ASC";
    $eksekusi  = $this->koneksi->query($sql);

    while($data = $eksekusi->fetch_array(MYSQLI_ASSOC)){
      $hasil[] = $data;
    }

    return $hasil;
  }

  public function tampil_skala_byid($id_skala){
    $this->id_skala = $id_skala;

    $sql       = "SELECT * FROM data_skalausaha WHERE id_skala = '".$this->id_skala."'";
    $eksekusi  = $this->koneksi->query($sql);

    while($data = $eksekusi->fetch_array(MYSQLI_ASSOC)){
      $hasil[] = $data;
    }

    return $hasil;
  }

  public function edit_skala($dataid_skala, $dataskala){
    $this->id_skala  = $dataid_skala;
    $this->skala     = $dataskala;

    $sql = "UPDATE data_skalausaha SET skala_usaha = '".$this->skala."' WHERE id_skala = '".$this->id_skala."'";
    $eksekusi = $this->koneksi->query($sql);

    return TRUE;
  }

  public function hapus_skala($id_skala){
    $this->id_skala = $id_skala;

    $sql      = "DELETE FROM data_skalausaha WHERE id_skala = '".$this->id_skala."'";
    $eksekusi = $this->koneksi->query($sql);

    return TRUE;
  }

  /* =========== FUNGSI pengaturan =========== */
  public function tampil_admin_byid($id_akun){
    $this->id_akun = $id_akun;

    $sql       = "SELECT * FROM akun_dinas WHERE id_akun = '".$this->id_akun."'";
    $eksekusi  = $this->koneksi->query($sql);

    while($data = $eksekusi->fetch_array(MYSQLI_ASSOC)){
      $hasil[] = $data;
    }

    return $hasil;
  }

  public function edit_akun($dataid_akun, $datanip, $datapassword){
    $this->id_akun  = $dataid_akun;
    $this->nip      = $datanip;
    $this->password = $datapassword;

    $sql = "UPDATE akun_dinas SET nip = '".$this->nip."', password = '".md5($this->password)."' WHERE id_akun = '".$this->id_akun."'";
    $eksekusi = $this->koneksi->query($sql);

    return TRUE;
  }

  /* ==== AKUN USAHA === */
  public function tampil_akunusaha(){
    $sql       = "SELECT * FROM akun_pengusaha ORDER BY nama_pengusaha ASC";
    $eksekusi  = $this->koneksi->query($sql);

    while($data = $eksekusi->fetch_array(MYSQLI_ASSOC)){
      $hasil[] = $data;
    }

    return $hasil;
  }

  public function tampil_akunusaha_byid($no_ktp){
    $this->no_ktp = $no_ktp;

    $sql       = "SELECT * FROM akun_pengusaha WHERE no_ktp = '".$this->no_ktp."'";
    $eksekusi  = $this->koneksi->query($sql);

    while($data = $eksekusi->fetch_array(MYSQLI_ASSOC)){
      $hasil[] = $data;
    }

    return $hasil;
  }

  public function tambah_pengusaha($no_ktp, $nama_pengusaha, $email, $password, $alamat, $tempat_lahir, $tanggal_lahir, $foto_ktp, $status_akun){
    $this->no_ktp = $no_ktp;
    $this->nama_pengusaha = $nama_pengusaha;
    $this->email = $email;
    $this->password = $password;
    $this->alamat = $alamat;
    $this->tempat_lahir = $tempat_lahir;
    $this->tanggal_lahir = $tanggal_lahir;
    $this->foto_ktp = $foto_ktp;
    $this->status_akun = $status_akun;

    $sql = "INSERT INTO akun_pengusaha VALUES('".$no_ktp."','".$nama_pengusaha."','".$email."','".md5($password)."','".$alamat."','".$tempat_lahir."','".$tanggal_lahir."','".$foto_ktp."','".$status_akun."')";
    $eksekusi = $this->koneksi->query($sql);

    return TRUE;
  }

  public function hapus_pengusaha($no_ktp){
    $this->no_ktp = $no_ktp;

    $sql      = "DELETE FROM akun_pengusaha WHERE no_ktp = '".$this->no_ktp."'";
    $eksekusi = $this->koneksi->query($sql);

    return TRUE;
  }

  public function ubah_statusakun_ya($no_ktp, $email){
    $this->no_ktp  = $no_ktp;

    $sql = "UPDATE akun_pengusaha SET status_akun = 'Y' WHERE no_ktp = '".$this->no_ktp."'";
    $eksekusi = $this->koneksi->query($sql);
    
    $header .= "Content-Type: text/html; charset=iso-8859-1\r\n"; 
    $header .= "Reply-To: Pengusaha <".$this->no_ktp.">\r\n"; 
    $header .= "Return-Path: Admin Dinas Usaha \r\n"; 
    $header .= "From: Admin Dinas Usaha \r\n"; 
    $header .= "Organization: gis.kotabandung.firdamdam.id\r\n";

    //$to = "siapakita2211@gmail.com";
    $to = $email;
    $subject = "Hi, Diberitahukan untuk <".$this->no_ktp."> dari Dinas Usaha Kota Bandung";
    $message = "Assalamualaikum..<br>Pemberitahuan Kami sampaikan bahwa akun dengan nip ".$nip." pada website Dinas Usaha Kota Bandung telah <font color=lime>AKTIF</font> dan bisa digunakan untuk melakukan login dan penginputan data usaha.";
    @mail($to, $subject, $message, $header);
    
    return TRUE;
  }

  public function ubah_statusakun_tidak($no_ktp, $email){
    $this->no_ktp  = $no_ktp;

    $sql = "UPDATE akun_pengusaha SET status_akun = 'T' WHERE no_ktp = '".$this->no_ktp."'";
    $eksekusi = $this->koneksi->query($sql);

    $header .= "Content-Type: text/html; charset=iso-8859-1\r\n"; 
    $header .= "Reply-To: Pengusaha <".$this->no_ktp.">\r\n"; 
    $header .= "Return-Path: Admin Dinas Usaha \r\n"; 
    $header .= "From: Admin Dinas Usaha \r\n"; 
    $header .= "Organization: gis.kotabandung.firdamdam.id\r\n";

    //$to = "siapakita2211@gmail.com";
    $to = $email;
    $subject = "Hi, Diberitahukan untuk <".$this->no_ktp."> dari Dinas Usaha Kota Bandung";
    $message = "Assalamualaikum..<br>Pemberitahuan Kami sampaikan bahwa akun dengan nip ".$nip." pada website Dinas Usaha Kota Bandung telah di <font color=red>NON-AKTIFKAN</font> karena ada beberapa permasalahan yang terjadi, silahkan hubungi karyawan kami untuk info lebih lanjut.";
    @mail($to, $subject, $message, $header);
    
    return TRUE;
  }

  /* === data usaha === */
  public function tampil_u_dinas(){
      $sql       = "SELECT * FROM data_usaha, data_history, akun_pengusaha WHERE data_usaha.id_usaha = data_history.id_usaha AND data_usaha.no_ktp = akun_pengusaha.no_ktp AND data_history.status = 'dinas' ORDER BY data_usaha.nama ASC";
      $eksekusi  = $this->koneksi->query($sql);

      while($data = $eksekusi->fetch_array(MYSQLI_ASSOC)){
        $hasil[] = $data;
      }

      return $hasil;
  }

  public function tampil_u_pengusaha(){
      $sql       = "SELECT * FROM data_usaha, data_history, akun_pengusaha WHERE data_usaha.id_usaha = data_history.id_usaha AND data_usaha.no_ktp = akun_pengusaha.no_ktp AND data_history.status = 'pengusaha' ORDER BY data_usaha.nama ASC";
      $eksekusi  = $this->koneksi->query($sql);

      while($data = $eksekusi->fetch_array(MYSQLI_ASSOC)){
        $hasil[] = $data;
      }

      return $hasil;
  }

  public function ubah_statususaha_ya($id_usaha){
    $this->id_usaha  = $id_usaha;

    $sql = "UPDATE data_usaha SET status_usaha = 'Y' WHERE id_usaha = '".$this->id_usaha."'";
    $eksekusi = $this->koneksi->query($sql);

    return TRUE;
  }

  public function ubah_statususaha_tidak($id_usaha){
    $this->id_usaha  = $id_usaha;

    $sql = "UPDATE data_usaha SET status_usaha = 'T' WHERE id_usaha = '".$this->id_usaha."'";
    $eksekusi = $this->koneksi->query($sql);

    return TRUE;
  }

  public function tampil_usaha(){
    $sql       = "SELECT * FROM data_usaha, akun_pengusaha WHERE data_usaha.no_ktp = akun_pengusaha.no_ktp";
    $eksekusi  = $this->koneksi->query($sql);

    while($data = $eksekusi->fetch_array(MYSQLI_ASSOC)){
      $hasil[] = $data;
    }

    return $hasil;
  }
}
?>
