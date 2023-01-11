<?php
include 'koneksi.php';
if(isset($_POST['simpan'])){
  $nama = $_POST['nama'];
  $alamat = $_POST['alamat'];
  $jadwal = $_POST['jadwal'];
  $dokter = $_POST['dokter'];
  $layanan = $_POST['layanan'];
  $pengumuman = $_POST['pelayanan'];
  mysqli_query($conn,"UPDATE posyandu SET nama='$nama',alamat='$alamat',jadwal='$jadwal',dokter='$dokter',layanan='$layanan',pengumuman='$pengumuman'");
  
}
header('location:'.$_SERVER['HTTP_REFERER']);