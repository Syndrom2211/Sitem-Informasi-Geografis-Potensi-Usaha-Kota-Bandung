<?php
include_once("../koneksi.php");

class pemilik_usaha extends Koneksi{
  public $id_usaha;
  public $no_ktp;
  public $nama;
  public $pemilik;
  public $produk;
  public $alamat;
  public $keluruhan;
  public $kecamatan;
  public $no_telp;
  public $longitude_lokasi;
  public $latitude_lokasi;
  public $skala;
  public $sektor;
  public $foto_satu;
  public $foto_dua;
  public $foto_tiga;
  public $foto_empat;
  public $foto_lima;
  public $status_usaha;
  public $email;
  public $password;
  public $tempat_lahir;
  public $tanggal_lahir;
  public $foto_ktp;

  public function ceksesi(){
    return isset($_SESSION["status_pengusaha"]);
  }

  public function logout(){
    $_SESSION["status_pengusaha"] = FALSE;
    session_destroy();
    header("Location: ../index.php");
  }

  public function tampil_usaha($no_ktp){
    $sql       = "SELECT * FROM data_usaha, akun_pengusaha WHERE data_usaha.no_ktp = akun_pengusaha.no_ktp AND data_usaha.no_ktp = '".$no_ktp."'";
    $eksekusi  = $this->koneksi->query($sql);

    while($data = $eksekusi->fetch_array(MYSQLI_ASSOC)){
      $hasil[] = $data;
    }

    return $hasil;
  }

  public function tambah_usaha($id_usaha, $status, $tgl, $waktu, $nama, $pemilik, $produk, $alamat, $kelurahan, $kecamatan, $no_telp, $longitude_lokasi, $latitude_lokasi, $skala, $sektor, $status_usaha, $foto_satu, $foto_dua, $foto_tiga, $foto_empat, $foto_lima){
    //for($i=0;$i<count($produk);$i++){
      $this->id_usaha = $id_usaha;
      $this->nama = $nama;//[$i];
      $this->pemilik = $pemilik;//[$i];
      $this->produk = $produk;//[$i];
      $this->alamat = $alamat;//[$i];
      $this->kelurahan = $kelurahan;//[$i];
      $this->kecamatan = $kecamatan;//[$i];
      $this->no_telp = $no_telp;//[$i];
      $this->longitude_lokasi = $longitude_lokasi;//[$i];
      $this->latitude_lokasi = $latitude_lokasi;//[$i];
      $this->skala = $skala;//[$i];
      $this->sektor = $sektor;//[$i];
      $this->foto_satu = $foto_satu;//[$i];
      $this->foto_dua = $foto_dua;//[$i];
      $this->foto_tiga = $foto_tiga;//[$i];
      $this->foto_empat = $foto_empat;//[$i];
      $this->foto_lima = $foto_lima;//[$i];
      $this->status_usaha = $status_usaha;//[$i];
      //}

      $sql      = "INSERT INTO data_usaha VALUES('".$this->id_usaha."','".$this->pemilik."', '".$this->nama."', '".$this->produk."', '".$this->alamat."', '".$this->kelurahan."', '".$this->kecamatan."', '".$this->no_telp."', '".$this->longitude_lokasi."', '".$this->latitude_lokasi."', '".$this->skala."', '".$this->sektor."', '".$this->foto_satu."', '".$this->foto_dua."', '".$this->foto_tiga."', '".$this->foto_empat."', '".$this->foto_lima."', '".$this->status_usaha."')";
      $eksekusi = $this->koneksi->query($sql);

      $sql_dua = "INSERT INTO data_history VALUES(NULL, '".$this->id_usaha."','".$status."','".$tgl."','".$waktu."')";
      $eksekusi_dua = $this->koneksi->query($sql_dua);

      return TRUE;
  }

  public function tampil_kelurahan_bycamat(){
    $sql       = "SELECT data_kecamatan.id_kecamatan, data_kecamatan.kecamatan, data_kelurahan.kelurahan FROM data_wilayah, data_kelurahan, data_kecamatan WHERE data_wilayah.id_kelurahan = data_kelurahan.id_kelurahan AND data_wilayah.id_kecamatan = data_kecamatan.id_kecamatan";
    $eksekusi  = $this->koneksi->query($sql);

    while($data = $eksekusi->fetch_array(MYSQLI_ASSOC)){
      $hasil[] = $data;
    }

    return $hasil;
  }

  public function hapus_usaha($id_usaha){
    $this->id_usaha = $id_usaha;

    $sql      = "DELETE FROM data_usaha WHERE id_usaha = '".$this->id_usaha."'";
    $eksekusi = $this->koneksi->query($sql);

    $sqldua      = "DELETE FROM data_history WHERE id_usaha = '".$this->id_usaha."'";
    $eksekusidua = $this->koneksi->query($sqldua);

    return TRUE;
  }

  public function tampil_usahabyid($id_usaha){
    $this->id_usaha = $id_usaha;

    $sql       = "SELECT * FROM data_usaha, akun_pengusaha WHERE data_usaha.no_ktp = akun_pengusaha.no_ktp AND data_usaha.id_usaha = '".$this->id_usaha."'";
    $eksekusi  = $this->koneksi->query($sql);

    while($data = $eksekusi->fetch_array(MYSQLI_ASSOC)){
      $hasil[] = $data;
    }

    return $hasil;
  }

  public function ubah_usaha($error_satu, $error_dua, $error_tiga, $error_empat, $error_lima, $id_usaha, $nama, $produk, $alamat, $kelurahan, $kecamatan, $no_telp, $longitude_lokasi, $latitude_lokasi, $skala, $sektor, $status_usaha, $foto_satu, $foto_dua, $foto_tiga, $foto_empat, $foto_lima, $foto_satu_lama, $foto_dua_lama, $foto_tiga_lama, $foto_empat_lama, $foto_lima_lama){
    //for($i=0;$i<count($produk);$i++){
      $this->id_usaha = $id_usaha;
      $this->nama = $nama;//[$i];
      $this->produk = $produk;//[$i];
      $this->alamat = $alamat;//[$i];
      $this->kelurahan = $kelurahan;//[$i];
      $this->kecamatan = $kecamatan;//[$i];
      $this->no_telp = $no_telp;//[$i];
      $this->longitude_lokasi = $longitude_lokasi;//[$i];
      $this->latitude_lokasi = $latitude_lokasi;//[$i];
      $this->skala = $skala;//[$i];
      $this->sektor = $sektor;//[$i];
      $this->foto_satu = $foto_satu;//[$i];
      $this->foto_dua = $foto_dua;//[$i];
      $this->foto_tiga = $foto_tiga;//[$i];
      $this->foto_empat = $foto_empat;//[$i];
      $this->foto_lima = $foto_lima;//[$i];
      $this->status_usaha = $status_usaha;//[$i];
      //}

      //4 kosong
      //0 ada
      if(($error_satu == 4) && ($error_dua == 4) && ($error_tiga == 4) && ($error_empat == 4) && ($error_lima == 4)){
        $sql = "UPDATE data_usaha SET nama = '".$this->nama."', produk = '".$this->produk."', alamat = '".$this->alamat."', kelurahan = '".$this->kelurahan."', kecamatan = '".$this->kecamatan."', no_telp = '".$this->no_telp."', longitude_lokasi = '".$this->longitude_lokasi."', latitude_lokasi = '".$this->latitude_lokasi."', skala = '".$this->skala."', sektor = '".$this->sektor."', foto_satu = '".$foto_satu_lama."', foto_dua = '".$foto_dua_lama."', foto_tiga = '".$foto_tiga_lama."', foto_empat = '".$foto_empat_lama."', foto_lima = '".$foto_lima_lama."', status_usaha = '".$status_usaha."' WHERE id_usaha = '".$this->id_usaha."'";
        $eksekusi = $this->koneksi->query($sql);
      }else if(($error_satu == 4) && ($error_dua == 4) && ($error_tiga == 4) && ($error_empat == 4) && ($error_lima == 0)){
        $sql = "UPDATE data_usaha SET nama = '".$this->nama."', produk = '".$this->produk."', alamat = '".$this->alamat."', kelurahan = '".$this->kelurahan."', kecamatan = '".$this->kecamatan."', no_telp = '".$this->no_telp."', longitude_lokasi = '".$this->longitude_lokasi."', latitude_lokasi = '".$this->latitude_lokasi."', skala = '".$this->skala."', sektor = '".$this->sektor."', foto_satu = '".$foto_satu_lama."', foto_dua = '".$foto_dua_lama."', foto_tiga = '".$foto_tiga_lama."', foto_empat = '".$foto_empat_lama."', foto_lima = '".$this->foto_lima."', status_usaha = '".$status_usaha."' WHERE id_usaha = '".$this->id_usaha."'";
        $eksekusi = $this->koneksi->query($sql);
      }else if(($error_satu == 4) && ($error_dua == 4) && ($error_tiga == 4) && ($error_empat == 0) && ($error_lima == 0)){
        $sql = "UPDATE data_usaha SET nama = '".$this->nama."', produk = '".$this->produk."', alamat = '".$this->alamat."', kelurahan = '".$this->kelurahan."', kecamatan = '".$this->kecamatan."', no_telp = '".$this->no_telp."', longitude_lokasi = '".$this->longitude_lokasi."', latitude_lokasi = '".$this->latitude_lokasi."', skala = '".$this->skala."', sektor = '".$this->sektor."', foto_satu = '".$foto_satu_lama."', foto_dua = '".$foto_dua_lama."', foto_tiga = '".$foto_tiga_lama."', foto_empat = '".$this->foto_empat."', foto_lima = '".$this->foto_lima."', status_usaha = '".$status_usaha."' WHERE id_usaha = '".$this->id_usaha."'";
        $eksekusi = $this->koneksi->query($sql);
      }else if(($error_satu == 4) && ($error_dua == 4) && ($error_tiga == 0) && ($error_empat == 0) && ($error_lima == 0)){
        $sql = "UPDATE data_usaha SET nama = '".$this->nama."', produk = '".$this->produk."', alamat = '".$this->alamat."', kelurahan = '".$this->kelurahan."', kecamatan = '".$this->kecamatan."', no_telp = '".$this->no_telp."', longitude_lokasi = '".$this->longitude_lokasi."', latitude_lokasi = '".$this->latitude_lokasi."', skala = '".$this->skala."', sektor = '".$this->sektor."', foto_satu = '".$foto_satu_lama."', foto_dua = '".$foto_dua_lama."', foto_tiga = '".$this->foto_tiga."', foto_empat = '".$this->foto_empat."', foto_lima = '".$this->foto_lima."', status_usaha = '".$status_usaha."' WHERE id_usaha = '".$this->id_usaha."'";
        $eksekusi = $this->koneksi->query($sql);
      }else if(($error_satu == 4) && ($error_dua == 0) && ($error_tiga == 0) && ($error_empat == 0) && ($error_lima == 0)){
        $sql = "UPDATE data_usaha SET nama = '".$this->nama."', produk = '".$this->produk."', alamat = '".$this->alamat."', kelurahan = '".$this->kelurahan."', kecamatan = '".$this->kecamatan."', no_telp = '".$this->no_telp."', longitude_lokasi = '".$this->longitude_lokasi."', latitude_lokasi = '".$this->latitude_lokasi."', skala = '".$this->skala."', sektor = '".$this->sektor."', foto_satu = '".$foto_satu_lama."', foto_dua = '".$this->foto_dua."', foto_tiga = '".$this->foto_tiga."', foto_empat = '".$this->foto_empat."', foto_lima = '".$this->foto_lima."', status_usaha = '".$status_usaha."' WHERE id_usaha = '".$this->id_usaha."'";
        $eksekusi = $this->koneksi->query($sql);
      }else if(($error_satu == 0) && ($error_dua == 0) && ($error_tiga == 0) && ($error_empat == 0) && ($error_lima == 0)){
        $sql = "UPDATE data_usaha SET nama = '".$this->nama."', produk = '".$this->produk."', alamat = '".$this->alamat."', kelurahan = '".$this->kelurahan."', kecamatan = '".$this->kecamatan."', no_telp = '".$this->no_telp."', longitude_lokasi = '".$this->longitude_lokasi."', latitude_lokasi = '".$this->latitude_lokasi."', skala = '".$this->skala."', sektor = '".$this->sektor."', foto_satu = '".$this->foto_satu."', foto_dua = '".$this->foto_dua."', foto_tiga = '".$this->foto_tiga."', foto_empat = '".$this->foto_empat."', foto_lima = '".$this->foto_lima."', status_usaha = '".$status_usaha."' WHERE id_usaha = '".$this->id_usaha."'";
        $eksekusi = $this->koneksi->query($sql);
      }else if(($error_satu == 0) && ($error_dua == 4) && ($error_tiga == 4) && ($error_empat == 4) && ($error_lima == 4)){
        $sql = "UPDATE data_usaha SET nama = '".$this->nama."', produk = '".$this->produk."', alamat = '".$this->alamat."', kelurahan = '".$this->kelurahan."', kecamatan = '".$this->kecamatan."', no_telp = '".$this->no_telp."', longitude_lokasi = '".$this->longitude_lokasi."', latitude_lokasi = '".$this->latitude_lokasi."', skala = '".$this->skala."', sektor = '".$this->sektor."', foto_satu = '".$this->foto_satu."', foto_dua = '".$foto_dua_lama."', foto_tiga = '".$foto_tiga_lama."', foto_empat = '".$foto_empat_lama."', foto_lima = '".$foto_lima_lama."', status_usaha = '".$status_usaha."' WHERE id_usaha = '".$this->id_usaha."'";
        $eksekusi = $this->koneksi->query($sql);
      }else if(($error_satu == 0) && ($error_dua == 0) && ($error_tiga == 4) && ($error_empat == 4) && ($error_lima == 4)){
        $sql = "UPDATE data_usaha SET nama = '".$this->nama."', produk = '".$this->produk."', alamat = '".$this->alamat."', kelurahan = '".$this->kelurahan."', kecamatan = '".$this->kecamatan."', no_telp = '".$this->no_telp."', longitude_lokasi = '".$this->longitude_lokasi."', latitude_lokasi = '".$this->latitude_lokasi."', skala = '".$this->skala."', sektor = '".$this->sektor."', foto_satu = '".$this->foto_satu."', foto_dua = '".$this->foto_dua."', foto_tiga = '".$foto_tiga_lama."', foto_empat = '".$foto_empat_lama."', foto_lima = '".$foto_lima_lama."', status_usaha = '".$status_usaha."' WHERE id_usaha = '".$this->id_usaha."'";
        $eksekusi = $this->koneksi->query($sql);
      }else if(($error_satu == 0) && ($error_dua == 0) && ($error_tiga == 0) && ($error_empat == 4) && ($error_lima == 4)){
        $sql = "UPDATE data_usaha SET nama = '".$this->nama."', produk = '".$this->produk."', alamat = '".$this->alamat."', kelurahan = '".$this->kelurahan."', kecamatan = '".$this->kecamatan."', no_telp = '".$this->no_telp."', longitude_lokasi = '".$this->longitude_lokasi."', latitude_lokasi = '".$this->latitude_lokasi."', skala = '".$this->skala."', sektor = '".$this->sektor."', foto_satu = '".$this->foto_satu."', foto_dua = '".$this->foto_dua."', foto_tiga = '".$this->foto_tiga."', foto_empat = '".$foto_empat_lama."', foto_lima = '".$foto_lima_lama."', status_usaha = '".$status_usaha."' WHERE id_usaha = '".$this->id_usaha."'";
        $eksekusi = $this->koneksi->query($sql);
      }else if(($error_satu == 0) && ($error_dua == 0) && ($error_tiga == 0) && ($error_empat == 0) && ($error_lima == 4)){
        $sql = "UPDATE data_usaha SET nama = '".$this->nama."', produk = '".$this->produk."', alamat = '".$this->alamat."', kelurahan = '".$this->kelurahan."', kecamatan = '".$this->kecamatan."', no_telp = '".$this->no_telp."', longitude_lokasi = '".$this->longitude_lokasi."', latitude_lokasi = '".$this->latitude_lokasi."', skala = '".$this->skala."', sektor = '".$this->sektor."', foto_satu = '".$this->foto_satu."', foto_dua = '".$this->foto_dua."', foto_tiga = '".$this->foto_tiga."', foto_empat = '".$this->foto_empat."', foto_lima = '".$foto_lima_lama."', status_usaha = '".$status_usaha."' WHERE id_usaha = '".$this->id_usaha."'";
        $eksekusi = $this->koneksi->query($sql);
      }else if(($error_satu == 0) && ($error_dua == 0) && ($error_tiga == 0) && ($error_empat == 0) && ($error_lima == 0)){
        $sql = "UPDATE data_usaha SET nama = '".$this->nama."', produk = '".$this->produk."', alamat = '".$this->alamat."', kelurahan = '".$this->kelurahan."', kecamatan = '".$this->kecamatan."', no_telp = '".$this->no_telp."', longitude_lokasi = '".$this->longitude_lokasi."', latitude_lokasi = '".$this->latitude_lokasi."', skala = '".$this->skala."', sektor = '".$this->sektor."', foto_satu = '".$this->foto_satu."', foto_dua = '".$this->foto_dua."', foto_tiga = '".$this->foto_tiga."', foto_empat = '".$this->foto_empat."', foto_lima = '".$this->foto_lima."', status_usaha = '".$status_usaha."' WHERE id_usaha = '".$this->id_usaha."'";
        $eksekusi = $this->koneksi->query($sql);
      }else if(($error_satu == 0) && ($error_dua == 0) && ($error_tiga == 0) && ($error_empat == 0) && ($error_lima == 0)){
        $sql = "UPDATE data_usaha SET nama = '".$this->nama."', produk = '".$this->produk."', alamat = '".$this->alamat."', kelurahan = '".$this->kelurahan."', kecamatan = '".$this->kecamatan."', no_telp = '".$this->no_telp."', longitude_lokasi = '".$this->longitude_lokasi."', latitude_lokasi = '".$this->latitude_lokasi."', skala = '".$this->skala."', sektor = '".$this->sektor."', foto_satu = '".$foto_satu_lama."', foto_dua = '".$this->foto_dua."', foto_tiga = '".$foto_tiga_lama."', foto_empat = '".$foto_empat_lama."', foto_lima = '".$foto_lima_lama."', status_usaha = '".$status_usaha."' WHERE id_usaha = '".$this->id_usaha."'";
        $eksekusi = $this->koneksi->query($sql);
      }else if(($error_satu == 0) && ($error_dua == 0) && ($error_tiga == 0) && ($error_empat == 0) && ($error_lima == 0)){
        $sql = "UPDATE data_usaha SET nama = '".$this->nama."', produk = '".$this->produk."', alamat = '".$this->alamat."', kelurahan = '".$this->kelurahan."', kecamatan = '".$this->kecamatan."', no_telp = '".$this->no_telp."', longitude_lokasi = '".$this->longitude_lokasi."', latitude_lokasi = '".$this->latitude_lokasi."', skala = '".$this->skala."', sektor = '".$this->sektor."', foto_satu = '".$foto_satu_lama."', foto_dua = '".$this->foto_dua."', foto_tiga = '".$this->foto_tiga."', foto_empat = '".$foto_empat_lama."', foto_lima = '".$foto_lima_lama."', status_usaha = '".$status_usaha."' WHERE id_usaha = '".$this->id_usaha."'";
        $eksekusi = $this->koneksi->query($sql);
      }else if(($error_satu == 0) && ($error_dua == 0) && ($error_tiga == 0) && ($error_empat == 0) && ($error_lima == 0)){
        $sql = "UPDATE data_usaha SET nama = '".$this->nama."', produk = '".$this->produk."', alamat = '".$this->alamat."', kelurahan = '".$this->kelurahan."', kecamatan = '".$this->kecamatan."', no_telp = '".$this->no_telp."', longitude_lokasi = '".$this->longitude_lokasi."', latitude_lokasi = '".$this->latitude_lokasi."', skala = '".$this->skala."', sektor = '".$this->sektor."', foto_satu = '".$foto_satu_lama."', foto_dua = '".$this->foto_dua."', foto_tiga = '".$this->foto_tiga."', foto_empat = '".$this->foto_empat."', foto_lima = '".$foto_lima_lama."', status_usaha = '".$status_usaha."' WHERE id_usaha = '".$this->id_usaha."'";
        $eksekusi = $this->koneksi->query($sql);
      }else if(($error_satu == 0) && ($error_dua == 0) && ($error_tiga == 0) && ($error_empat == 0) && ($error_lima == 0)){
        $sql = "UPDATE data_usaha SET nama = '".$this->nama."', produk = '".$this->produk."', alamat = '".$this->alamat."', kelurahan = '".$this->kelurahan."', kecamatan = '".$this->kecamatan."', no_telp = '".$this->no_telp."', longitude_lokasi = '".$this->longitude_lokasi."', latitude_lokasi = '".$this->latitude_lokasi."', skala = '".$this->skala."', sektor = '".$this->sektor."', foto_satu = '".$foto_satu_lama."', foto_dua = '".$foto_dua_lama."', foto_tiga = '".$this->foto_tiga."', foto_empat = '".$foto_empat_lama."', foto_lima = '".$foto_lima_lama."', status_usaha = '".$status_usaha."' WHERE id_usaha = '".$this->id_usaha."'";
        $eksekusi = $this->koneksi->query($sql);
      }else if(($error_satu == 0) && ($error_dua == 0) && ($error_tiga == 0) && ($error_empat == 0) && ($error_lima == 0)){
        $sql = "UPDATE data_usaha SET nama = '".$this->nama."', produk = '".$this->produk."', alamat = '".$this->alamat."', kelurahan = '".$this->kelurahan."', kecamatan = '".$this->kecamatan."', no_telp = '".$this->no_telp."', longitude_lokasi = '".$this->longitude_lokasi."', latitude_lokasi = '".$this->latitude_lokasi."', skala = '".$this->skala."', sektor = '".$this->sektor."', foto_satu = '".$foto_satu_lama."', foto_dua = '".$foto_dua_lama."', foto_tiga = '".$this->foto_tiga."', foto_empat = '".$this->foto_empat."', foto_lima = '".$foto_lima_lama."', status_usaha = '".$status_usaha."' WHERE id_usaha = '".$this->id_usaha."'";
        $eksekusi = $this->koneksi->query($sql);
      }else if(($error_satu == 0) && ($error_dua == 0) && ($error_tiga == 0) && ($error_empat == 0) && ($error_lima == 0)){
        $sql = "UPDATE data_usaha SET nama = '".$this->nama."', produk = '".$this->produk."', alamat = '".$this->alamat."', kelurahan = '".$this->kelurahan."', kecamatan = '".$this->kecamatan."', no_telp = '".$this->no_telp."', longitude_lokasi = '".$this->longitude_lokasi."', latitude_lokasi = '".$this->latitude_lokasi."', skala = '".$this->skala."', sektor = '".$this->sektor."', foto_satu = '".$foto_satu_lama."', foto_dua = '".$foto_dua_lama."', foto_tiga = '".$foto_tiga_lama."', foto_empat = '".$this->foto_empat."', foto_lima = '".$foto_lima_lama."', status_usaha = '".$status_usaha."' WHERE id_usaha = '".$this->id_usaha."'";
        $eksekusi = $this->koneksi->query($sql);
      }

      return TRUE;
  }

  public function tampil_pengusaha_byid($no_ktp){
    $this->no_ktp = $no_ktp;

    $sql       = "SELECT * FROM akun_pengusaha WHERE no_ktp = '".$this->no_ktp."'";
    $eksekusi  = $this->koneksi->query($sql);

    while($data = $eksekusi->fetch_array(MYSQLI_ASSOC)){
      $hasil[] = $data;
    }

    return $hasil;
  }

  public function edit_pengusaha($dataerror, $no_ktp_lama, $nama_pengusaha, $email, $password, $alamat, $tempat_lahir, $tanggal_lahir, $foto_ktp, $foto_ktp_lama, $password_lama){
    $this->pemilik = $nama_pengusaha;
    $this->email = $email;
    $this->password = $password;
    $this->alamat = $alamat;
    $this->tempat_lahir = $tempat_lahir;
    $this->tanggal_lahir = $tanggal_lahir;
    $this->foto_ktp = $foto_ktp;

    if(!empty($this->password) && ($dataerror == 0)){
      $sql = "UPDATE akun_pengusaha SET no_ktp = '".$no_ktp_lama."', nama_pengusaha = '".$this->pemilik."', email = '".$this->email."', password = '".md5($this->password)."', alamat = '".$this->alamat."', tempat_lahir = '".$this->tempat_lahir."', tanggal_lahir = '".$this->tanggal_lahir."', foto_ktp = '".$this->foto_ktp."' WHERE no_ktp = '".$no_ktp_lama."'";
      $eksekusi = $this->koneksi->query($sql);
    }else if(empty($this->password) && ($dataerror == 4)){
      $sql = "UPDATE akun_pengusaha SET no_ktp = '".$no_ktp_lama."', nama_pengusaha = '".$this->pemilik."', email = '".$this->email."', password = '".$password_lama."', alamat = '".$this->alamat."', tempat_lahir = '".$this->tempat_lahir."', tanggal_lahir = '".$this->tanggal_lahir."', foto_ktp = '".$foto_ktp_lama."' WHERE no_ktp = '".$no_ktp_lama."'";
      $eksekusi = $this->koneksi->query($sql);
    }else if(empty($this->password) && ($dataerror == 0)){
      $sql = "UPDATE akun_pengusaha SET no_ktp = '".$no_ktp_lama."', nama_pengusaha = '".$this->pemilik."', email = '".$this->email."', password = '".$password_lama."', alamat = '".$this->alamat."', tempat_lahir = '".$this->tempat_lahir."', tanggal_lahir = '".$this->tanggal_lahir."', foto_ktp = '".$this->foto_ktp."' WHERE no_ktp = '".$no_ktp_lama."'";
      $eksekusi = $this->koneksi->query($sql);
    }else if(!empty($this->password) && ($dataerror == 4)){
      $sql = "UPDATE akun_pengusaha SET no_ktp = '".$no_ktp_lama."', nama_pengusaha = '".$this->pemilik."', email = '".$this->email."', password = '".md5($this->password)."', alamat = '".$this->alamat."', tempat_lahir = '".$this->tempat_lahir."', tanggal_lahir = '".$this->tanggal_lahir."', foto_ktp = '".$foto_ktp_lama."' WHERE no_ktp = '".$no_ktp_lama."'";
      $eksekusi = $this->koneksi->query($sql);
    }

    return TRUE;
  }
}
?>
