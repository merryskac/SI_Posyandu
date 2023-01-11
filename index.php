<?php include 'template/header.php';
session_start() ?>
<body>
  <!-- ======= Hero Section ======= -->
  <section id="hero" class="d-flex align-items-center">
    <div class="container position-relative" data-aos="fade-up" data-aos-delay="100">
      <div class="row justify-content-center">
        <div class="col-xl-7 col-lg-9 text-center">
          <?php if(isset($_SESSION['nama'])){ ?>
          <h4>Selamat datang, <?= $_SESSION['nama'] ?></h4>
          <?php } ?>
          <h1>Posyandu Untuk Anak Indonesia Sehat!</h1>
          <h2>Rutin ke posyandu mencegah anak terkena gizi buruk dan penyakit berbahaya.</h2>
        </div>
      </div>
      <div class="text-center">
        <a href="posyandu.php" class="btn-get-started scrollto">Cek posyandu terdekat
        </a>
      </div>

      <div class="row icon-boxes" >
        <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0" data-aos="zoom-in" data-aos-delay="200">
          
          <div class="icon-box">
            <div class="icon"><i class="ri-syringe-line"></i></div>
            <h4 class="title">Imunisasi</h4>
            <p class="description">Lindungi anak dari berbagai penyakit yang berbahaya atau berisiko dengan imunisasi.</p>
          </div>
        </div>

        <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0" data-aos="zoom-in" data-aos-delay="300">
          <div class="icon-box">
            <div class="icon"><i class="ri-alarm-warning-line"></i></div>
            <h4 class="title">Pemantauan status gizi</h4>
            <p class="description">Cegah gangguan tumbuh kembang anak dengan gizi yang cukup.</p>
          </div>
        </div>

        <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0" data-aos="zoom-in" data-aos-delay="400">
          <div class="icon-box">
            <div class="icon"><i class="ri-capsule-line"></i></div>
            <h4 class="title">Pencegahan dan penanggulangan diare</h4>
            <p class="description">Cegah diare dengan PHBS (Perilaku Hidup Bersih dan Sehat) dan oralit.</p>
          </div>
        </div>

        <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0" data-aos="zoom-in" data-aos-delay="500">
          <div class="icon-box">
            <div class="icon"><i class="ri-fingerprint-line"></i></div>
            <h4 class="title">Berita</h4>
            <p class="description">Lihat dan pantau kegiatan Posyandu di Kota Palu!</p>
          </div>
        </div>

      </div>
    </div>
  </section><!-- End Hero -->

  <main id="main">


  </main><!-- End #main -->
<?php include 'template/footer.php' ?>