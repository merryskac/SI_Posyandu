<?php
include 'template/header.php';
include 'koneksi.php';
session_start();
if(isset($_POST['simpan'])){
  $id = $_GET['id'];
  $nama = $_POST['nama'];
  $alamat = $_POST['alamat'];
  $jadwal = $_POST['jadwal'];
  $dokter = $_POST['dokter'];
  $layanan = $_POST['layanan'];
  $pengumuman = $_POST['pengumuman'];
  mysqli_query($conn,"UPDATE posyandu SET nama='$nama',alamat='$alamat',jadwal='$jadwal',dokter='$dokter',layanan='$layanan',pengumuman='$pengumuman' WHERE id=$id");
}
?>

<body>
  <?php include 'template/nav.php' ?>
  <main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section class="breadcrumbs">
      <div class="container">
        <div class="d-flex justify-content-between align-items-center">
          <h2>Detail Posyandu</h2>
          <ol>
            <li><a href="index.php">Home</a></li>
            <li><a href="posyandu.php">Posyandu Terdekat</a></li>
            <li>Detail Posyandu</li>
          </ol>
        </div>
      </div>
    </section><!-- End Breadcrumbs -->
    <section class="inner-page">
      <div class="container">
        <a href="posyandu.php"><button class="btn btn-primary">Kembali</button></a>
        <a href="antrian.php?id=<?=$_GET['id']?>"><button class="btn btn-warning">Ambil antrian</button></a>
        <table class="table col-lg-12">
          <?php
          $id = $_GET['id'];
          $query = mysqli_query($conn, "SELECT * FROM posyandu WHERE id=$id");
          $data = $query->fetch_assoc()
          ?>
          <tr>
            <td>Nama Posyandu</td>
            <td>:</td>
            <td><?= $data['nama'] ?></td>
          </tr>
          <tr>
            <td>Alamat</td>
            <td>:</td>
            <td><?= $data['alamat'] ?></td>
          </tr>

          <tr>
            <td>Jadwal Posyandu</td>
            <td>:</td>
            <td><?= $data['jadwal'] ?></td>
          </tr>
          <tr>
            <td>Dokter petugas</td>
            <td>:</td>
            <td><?= $data['dokter'] ?></td>
          </tr>
          <tr>
            <td>Layanan Posyandu</td>
            <td>:</td>
            <td><?= $data['layanan'] ?></td>
          </tr>
        </table>
        <textarea class="col-12" name="txtarea" id="" disabled cols="50vh" rows="10">Pengumuman Terbaru:
          <?= $data['pengumuman'] ?>
        </textarea>
        <br><br>
        <?php if(isset($_SESSION['nama'])){ ?>
        <a><button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#id">Edit data</button></a>
        <?php } ?>

        <!-- modal -->
        <div class="modal fade" id="id" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                
                <h5 class="modal-title" id="exampleModalLabel">Edit data posyandu</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <form action="" method="POST">
                  <div class="mb-3">
                    <label for="" class="form-label">Nama Posyandu</label>
                    <input value="<?= $data['nama'] ?>" type="text" name="nama" class="form-control">
                  </div>
                  <div class="mb-3">
                    <label for="" class="form-label">Alamat</label>
                    <input type="text" value="<?= $data['alamat'] ?>" name="alamat" class="form-control">
                  </div>
                  <div class="mb-3">
                    <label for="" class="form-label">Jadwal</label>
                    <input type="text" value="<?= $data['jadwal'] ?>" name="jadwal" class="form-control">
                  </div>
                  <div class="mb-3">
                    <label for="" class="form-label">Dokter petugas</label>
                    <input type="text" name="dokter" value="<?= $data['dokter'] ?>"class="form-control">
                  </div>
                  <div class="mb-3">
                    <label for="" class="form-label">Layanan</label>
                    <input type="text" name="layanan" value="<?= $data['layanan'] ?>"class="form-control">
                  </div>
                  <textarea class="col-12" name="pengumuman" id="" cols="50vh" rows="10" placeholder="Pengumuman terbaru"><?= $data['pengumuman'] ?></textarea>
                  <input type="submit" name="simpan" class="btn btn-primary" value="simpan">
                </form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                
                
              </div>
            </div>
          </div>
        </div>
        <!-- modal fin -->

      </div>
    </section>

  </main><!-- End #main -->
  <?php include 'template/footer.php' ?>
</body>