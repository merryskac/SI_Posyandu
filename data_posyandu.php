<?php
include 'template/header.php';
include 'koneksi.php';
session_start();
if (isset($_POST['simpan'])) {
  $id = $_GET['id'];
  $nama = $_POST['nama'];
  $alamat = $_POST['alamat'];
  $jadwal = $_POST['jadwal'];
  $dokter = $_POST['dokter'];
  $layanan = $_POST['layanan'];
  $pengumuman = $_POST['pengumuman'];
  mysqli_query($conn, "UPDATE posyandu SET nama='$nama',alamat='$alamat',jadwal='$jadwal',dokter='$dokter',layanan='$layanan',pengumuman='$pengumuman' WHERE id=$id");
}
?>

<body>
  <?php include 'template/nav.php' ?>
  <main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section class="breadcrumbs">
      <div class="container">
        <div class="d-flex justify-content-between align-items-center">
          
          <h2>Data Peserta Posyandu</h2>
          <ol>
            <li><a href="index.php">Home</a></li>
            <li><a href="posyandu.php">Posyandu Terdekat</a></li>
            <li>Data peserta posyandu</li>
          </ol>
        </div>
      </div>
    </section><!-- End Breadcrumbs -->
    <section class="inner-page">
      <div class="container">
        <a href="posyandu.php"><button class="btn btn-primary">Kembali</button></a>
        <table class="table col-lg-12">
          <thead>
            <tr>
              <th>No.</th>
              <th>Nama</th>
              <th>Alamat</th>
              <th>Banyak peserta</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $no = 0;
            $query = mysqli_query($conn, "SELECT * FROM posyandu");
            $banyak = [];
            while ($data = $query->fetch_assoc()) {
              $nama = $data['nama'];
              $no += 1;
              
              $get_peserta = $conn->query("SELECT * FROM peserta WHERE posyandu='$nama'");
              $total = $get_peserta->num_rows;
              array_push($banyak, $total);
            ?>
              <tr>
                <td><?= $no ?></td>
                <td><?= $data['nama'] ?></td>
                <td><?= $data['alamat'] ?></td>
                <td><?= isset($banyak[$no - 1]) ? $banyak[$no - 1] : 0 ?></td>
              </tr>
            <?php
            }

            ?>
          </tbody>
        </table>
            <h3>Total: <?= array_sum($banyak) ?> peserta</h3>
      </div>
    </section>

  </main><!-- End #main -->
  <?php include 'template/footer.php' ?>
</body>