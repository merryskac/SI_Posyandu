<?php
include 'template/header.php';
include 'koneksi.php'
?>
<?php
if (isset($_POST['submit'])) {
  $nama = $_POST['nama_posyandu'];
  $alamat = $_POST['alamat'];
  $latitude = $_POST['latitude'];
  $longitude = $_POST['longitude'];


  $tambah = $conn->query("INSERT INTO posyandu(nama,alamat,latitude,longitude) VALUES ('$nama','$alamat','$latitude','$longitude')");
  if ($tambah) {
    $cek = true;
    $message = 'Data ditambahkan';
  } else {
    $cek = false;
    $message = 'Data gagal ditambahkan';
  }
}

?>

<body>
  <?php include 'template/nav.php' ?>
  <main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section class="breadcrumbs">
      <div class="container">
        <div class="d-flex justify-content-between align-items-center">
          <h2>Tambah Posyandu </h2>
          <ol>
            <li><a href="index.php">Home</a></li>
            <li>Tambah Posyandu</li>
          </ol>
        </div>
      </div>
    </section><!-- End Breadcrumbs -->
    <section class="inner-page">
      <div class="container">
        <?php
        if (isset($cek) && $_SERVER['REQUEST_METHOD'] == 'POST') {
          if ($cek == true) {
        ?>
            <div class="alert alert-success"><?= $message ?></div>
          <?php
          } else {
          ?>
            <div class="alert alert-danger"><?= $message ?></div>
        <?php
          }
        }
        ?>
        <a href="posyandu.php"><button class="btn btn-primary">Kembali</button></a>
        <p></p>
        <div id="map" style="height: 500px;"></div>
        <p>
          Peta Kota Palu
        </p>
        <form action="" method="post">
          <div class="mb-3">
            <label for="" class="form-label">Nama Posyandu</label>
            <input type="text" class="form-control" name="nama_posyandu" aria-describedby="emailHelp">
          </div>
          <div class="mb-3">
            <label for="" class="form-label">Alamat Lengkap</label>
            <input type="text" name="alamat" class="form-control" id="">
          </div>
          <div class="mb-3">
            <label for="" class="form-label">Latitude</label>
            <input type="text" name="latitude" class="form-control" id="lat">
          </div>
          <div class="mb-3">
            <label for="" class="form-label">Longitude</label>
            <input type="text" name="longitude" class="form-control" id="long">
          </div>
          <button type="submit" name="submit" class="btn btn-primary">Submit</button>
        </form>
      </div>
    </section>

  </main><!-- End #main -->
  <?php include 'template/footer.php' ?>
</body>
<script>
  let latlang = [0, 0]
  if (latlang[0] == 0 && latlang[1] == 0) {
    latlang = [-0.8842524969620659, 119.89088392343886]
  }
  let map = L.map('map').setView([-0.8842524969620659, 119.89088392343886], 13)
  let layerMap = L.tileLayer('https://api.mapbox.com/styles' +
    '/v1/mapbox/streets-v11/tiles/{z}/{x}/{y}?' +
    'access_token=pk.eyJ1IjoibWVycnlza2FjIiwiYSI6ImNreTgwcmUyNDFhbj' +
    'EzMWxxb3M1OWs5emcifQ.4oskRh8WEmGkxBz38lTeww', {
      attribution: '© <a href="https://www.mapbox.com/feedback/">Mapbox</a>' +
        ' © <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    })

  map.addLayer(layerMap)
  let markerPosyandu = new L.marker(latlang, {
    draggable: 'true'
  })
  map.addLayer(markerPosyandu)
  markerPosyandu.on('dragend', event => {
    let position = markerPosyandu.getLatLng();
    $("#lat").val(position.lat)
    $("#long").val(position.lng)
    console.log(position)
  })
</script>