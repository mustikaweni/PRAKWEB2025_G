<?php
class Rumah {
  public $warna = "Putih";
  public $jumlahKamar = 4;
  public $alamat = "Jln. Pasundan No. 1";

  // Konstruktor
  public function kunciPintu(){
    return "Pintu sudah dikunci!";
  }

  public function gantiWarna($warnaBaru){
    $this->warna =$warnaBaru;
    return "Warna rumah berhasil diubah menjadi " . $this->warna;
  }
  }

  $rumahSaya = new rumah();
  


echo "Warna awal rumah Saya :" . $rumahSaya->warna;
echo "<br>";

$rumahSaya->gantiWarna("Biru");

echo "Warna baru rumah saya: " . $rumahSaya->warna;
echo "<br>";

$rumahTetangga = new Rumah();
echo "Warna rumah tetangga: " .$rumahTetangga->warna;
?>