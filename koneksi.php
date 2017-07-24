<?php
class Koneksi{
    var $koneksi;
    
    public function __construct(){
        $this->koneksi = new mysqli('localhost', 'firdamda_dinas_a', 'kmzwa8awaa12345', 'firdamda_dinas_usaha');
        
        /*
         * This is the "official" OO way to do it,
         * BUT $connect_error was broken until PHP 5.2.9 and 5.3.0.
         */
        if ($this->koneksi->connect_error) {
            die('Connect Error (' . $this->koneksi->connect_errno . ') '
                    . $this->koneksi->connect_error);
        }
        
        /*
         * Use this instead of $connect_error if you need to ensure
         * compatibility with PHP versions prior to 5.2.9 and 5.3.0.
         */
        if (mysqli_connect_error()) {
            die('Connect Error (' . mysqli_connect_errno() . ') '
                    . mysqli_connect_error());
        }
    }
}
?>