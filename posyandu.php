<?php
session_start();
include 'template/header.php';
include 'koneksi.php'
?>

<body>
  <?php include 'template/nav.php' ?>
  <main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section class="breadcrumbs">
      <div class="container">
        <div class="d-flex justify-content-between align-items-center">
          <h2>Posyandu Terdekat</h2>
          <ol>
            <li><a href="index.php">Home</a></li>
            <li>Posyandu Terdekat</li>
          </ol>
        </div>
      </div>
    </section><!-- End Breadcrumbs -->
    <section class="inner-page">
      <div class="container">
        <?php
        if (isset($_SESSION['check'])) { ?>
          <div class="alert alert-success">
            <?= $_SESSION['check'] ?>

          </div>
        <?php
          unset($_SESSION['check']);
        }
        ?>
        <?php if(isset($_SESSION['username'])){ ?>
        <a href="tambah_posyandu.php"><button class="btn btn-primary">Tambah posyandu</button></a>
        <?php } ?>
        <button class="btn btn-warning" id="cek_posyandu">Cek posyandu terdekat</button>
        <a href="posyandu.php"><button class="btn btn-danger" id="tutup" hidden>Tutup</button></a>
        <p></p>
        <div id="map" style="height: 500px;"></div>
        <p>
          Peta Kota Palu
        </p>
        <br><br>
        <h2>Daftar Posyandu</h2>
        <form action="" method="GET">
          <div class="input-group mb-3">
            <input class="form-control" type="text" name="cari" placeholder="cari posyandu berdasarkan nama atau alamat">
            <button type="submit" class="btn btn-primary" id="button-addon2">Cari</button>
          </div>
        </form>
        <table class="table">
          <thead>
            <tr>
              <td>No.</td>
              <td>Nama Pos.</td>
              <td>Alamat</td>
              <td>Action</td>
            </tr>
          </thead>
          <tbody>
            <?php
            $no = 1;
            
            $datas = mysqli_query($conn,"SELECT  * FROM posyandu");
            $halaman = isset($_GET['halaman'])?$_GET['halaman']:1;
            $next = $halaman+1;
            $prev = $halaman-1;
            $banyak_data = 5;
            $num_awal = $halaman*$banyak_data-$banyak_data;
            $query = mysqli_query($conn, "SELECT * FROM posyandu LIMIT $num_awal, $banyak_data");
            $no = $banyak_data*$halaman-$banyak_data+1;
            $banyak_page = ceil($datas->num_rows/$banyak_data);
            if (isset($_GET['cari'])) {
              $cari = $_GET['cari'];
              $query = mysqli_query($conn, "SELECT * FROM posyandu WHERE nama LIKE '%$cari%' OR alamat LIKE '%$cari%'");
            }

            while ($data = $query->fetch_assoc()) {
            ?>
              <tr>
                <td><?= $no ?></td>
                <td><?= $data['nama'] ?></td>
                <td><?= $data['alamat'] ?></td>
                <td><a href="detail_posyandu.php?id=<?= $data['id'] ?>"><button class="btn btn-primary">Detail</button></a>
                <?php if(isset($_SESSION['username'])){ ?>  
                <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#hapus_<?= $data['id'] ?>">Hapus</button>
                <?php } ?>
                </td>
              </tr>
              <?php

              ?>
              <!-- Modal -->
              <div class="modal fade" id="hapus_<?= $data['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Hapus</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      Hapus data <?= $data['nama'] ?>?
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                      <a href="hapus_posyandu.php?id=<?= $data['id'] ?>"><button type="button" class="btn btn-primary">Hapus</button></a>
                    </div>
                  </div>
                </div>
              </div>
            <?php
              $no += 1;
            }
            ?>
          </tbody>
        </table>
        <?php
        if ($query->num_rows < 1) { ?>
          <center>tidak ada data </center>
          <center><a href="posyandu.php">Kembali</a></center>
        <?php
        }
        ?>
        <nav aria-label="Page navigation example">
          <ul class="pagination">
            <li class="page-item"><a class="page-link" href="halaman?<?=$prev?>">Previous</a></li>
            <?php for($i=1;$i<=$banyak_page;$i++){?>
              <li class="page-item"><a class="page-link" href="?halaman=<?=$i?>"><?=$i?></a></li>
              <?php
            } ?>
            <li class="page-item"><a class="page-link" href="?halaman=<?=$next?>">Next</a></li>
          </ul>
        </nav>
      </div>
    </section>

  </main><!-- End #main -->
  <?php include 'template/footer.php' ?>
</body>
<script>
  let map = L.map('map').setView([-0.8828804972219374, 119.85731606079105], 13)
  let layerMap = L.tileLayer('https://api.mapbox.com/styles' +
    '/v1/mapbox/streets-v11/tiles/{z}/{x}/{y}?' +
    'access_token=pk.eyJ1IjoibWVycnlza2FjIiwiYSI6ImNreTgwcmUyNDFhbj' +
    'EzMWxxb3M1OWs5emcifQ.4oskRh8WEmGkxBz38lTeww', {
      attribution: '© <a href="https://www.mapbox.com/feedback/">Mapbox</a>' +
        ' © <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    })
  map.addLayer(layerMap)
  let MarkerIcon = L.icon({
    iconUrl: 'marker/location-pin.png',
    iconSize: [50, 50],
    iconAnchor: [25, 50],
    popupAnchor: [0, -50]
  })
  <?php
  $query = mysqli_query($conn, "SELECT * FROM posyandu");

  while ($data = $query->fetch_assoc()) {
  ?>

    new L.marker([<?= $data['latitude'] ?>, <?= $data['longitude'] ?>], {
      icon: MarkerIcon,

    }).bindPopup('<b><?= $data['nama'] ?></b><br><?= $data['alamat'] ?><br><br><a href="detail_posyandu.php?id=<?= $data['id'] ?>"><button class="btn btn-primary btn-sm">Detail</button></a><a href="antrian.php?id=<?= $data['id'] ?>"><button class="btn btn-warning btn-sm">Ambil no. antrian</button></a>').addTo(map)

  <?php
  }
  ?>
  $('#cek_posyandu').on('click', (event) => {
    let markerLocation
    if (markerLocation) {
      console.log(markerLocation)
      map.removeLayer(markerLocation)
    }
    if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(e => {
        let lat = e.coords.latitude
        let long = e.coords.longitude
        let coords = [lat, long]
        map.flyTo(coords,15)
        markerLocation = L.marker(coords, {
        }).bindPopup('lokasi saya')
        map.addLayer(markerLocation)
      })
    }
    $('#cek_posyandu').attr('hidden', true);
    $('#tutup').removeAttr('hidden');
  })
</script>