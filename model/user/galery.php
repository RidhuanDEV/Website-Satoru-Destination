<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Galeri - Satoru Destination</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/galery.css">
</head>
<body>
  <!-- nav bar -->
  <nav class="navbar navbar-expand-lg bg-dark border-bottom border-body sticky-top" data-bs-theme="dark">
      <div class="container-fluid">
          <a class="navbar-brand" href="../../index.php">SATORU Destination</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                  aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse " id="navbarNav">
              <ul class="navbar-nav col-8 g-6 text-center">
                  <li class="nav-item g-6 col-1">
                      <a class="nav-link" href="product.php">Product</a>
                  </li>
                  <li class="nav-item g-6 col-1">
                      <a class="nav-link" href="about.php">About</a>
                  </li>
                  <li class="nav-item g-6 col-1">
                      <a class="nav-link active" href="galery.php">Galery</a>
                  </li>
                  <li class="nav-item g-6 col-1 ">
                      <a class="nav-link" href="pesanan.php">Pesanan</a>
                  </li>
              </ul>
              <div class="justify-content-end col-4 p-2">
                  <?php
                  session_start();

                  include '../../controller/koneksi.php';
                  if (isset($_SESSION['user_id'])) {
                      // Mengambil nama pengguna dari database atau sesi
                      $sql = "SELECT nama FROM tbl_user WHERE id = " . $_SESSION['user_id'];
                      $result = $conn->query($sql);
                      $row = $result->fetch_assoc();
                      $userName = $row['nama']; // Contoh nama, sesuaikan dengan pengambilan nama dari database/sesi

                      // Mengecek panjang nama dan apakah mengandung spasi
                      if (strlen($userName) > 10 || strpos($userName, ' ') !== false) {
                          // Mengambil bagian pertama dari nama jika mengandung spasi
                          $userNameParts = explode(' ', $userName);
                          $userName = $userNameParts[0];

                          // Memotong nama jika lebih dari 10 huruf
                          if (strlen($userName) > 10) {
                              $userName = substr($userName, 0, 10) . '...';
                          }
                      }

                      echo '  <ul class="navbar-nav col-sm-12 g-6 text-center">
                                      <li class="nav-item g-4 col-sm-6 ">
                                          <a class="nav-link overflow-hidden" href="account.php">' . htmlspecialchars($userName) . '</a>
                                      </li>
                                      <li class="nav-item g-4 col-sm-5 mx-4">
                                          <a class="nav-link" href="../../controller/logout.php">Log Out</a>
                                      </li>
                                  </ul>
                              ';
                  } else {
                    echo '
                    <ul class="navbar-nav col-sm-12 g-6 text-center justify-content-end">
                        <li class="nav-item g-4 col-sm-4 ">
                            <a href="model/user/form/login.php" class="text-decoration-none">SIGN IN / SIGN UP</a>
                        </li>
                    </ul>';
                  }
                  ?>
              </div>
          </div>
      </div>
  </nav>
  <!-- akhir navbar -->

  <!-- Galery -->
  <div class="container my-5">
      <h1 class="text-center mb-4">Galery</h1>
      <div class="row">
          <div class="col-sm-4 mb-4">
              <div class="gallery-img">
                  <img src="../../view/assets/ancol.jpg" class="img-thumbnail" alt="Wisata 1">
                  <div class="overlay">
                      <h5>Taman Ancol</h5>
                  </div>
              </div>
          </div>
          <div class="col-sm-4 mb-4">
              <div class="gallery-img">
                  <img src="../../view/assets/pulau komodo.jpg" class="img-thumbnail" alt="Wisata 2">
                  <div class="overlay">
                      <h5>Pulau Komodo</h5>
                  </div>
              </div>
          </div>
          <div class="col-sm-4 mb-4">
              <div class="gallery-img">
                  <img src="../../view/assets/pantaikuta.jpg" class="img-thumbnail" alt="Wisata 3">
                  <div class="overlay">
                      <h5>Pantai Kuta</h5>
                  </div>
              </div>
          </div>
      </div>
      <div class="row">
          <div class="col-sm-4 mb-4">
              <div class="gallery-img">
                  <img src="../../view/assets/bunaken.jpeg" class="img-thumbnail" alt="Galeri 4">
                  <div class="overlay">
                      <h5>Pantai Bunaken</h5>
                  </div>
              </div>
          </div>
          <div class="col-sm-4 mb-4">
              <div class="gallery-img">
                  <img src="../../view/assets/gunungbromo.jpg" class="img-thumbnail" alt="Galeri 5">
                  <div class="overlay">
                      <h5>Gunung Bromo</h5>
                  </div>
              </div>
          </div>
          <div class="col-sm-4 mb-4">
              <div class="gallery-img">
                  <img src="../../view/assets/gunungkelud.jpg" class="img-thumbnail" alt="Galeri 6">
                  <div class="overlay">
                      <h5>Gunung Kelud</h5>
                  </div>
              </div>
          </div>
      </div>
  </div>
  <!-- Akhir Galery -->

  <div class="container my-5">
  <h1 class="text-center mb-4">Panduan Berwisata</h1>
    <div class="col-md-12 mb-4">
      <div class="card guide-card">
        <div class="row">
          <div class="col-md-4">
            <img src="../../view/assets/bunaken.jpeg" class="card-img" alt="Panduan 1">
          </div>
          <div class="col-md-8 d-flex">
            <div class="card-body d-flex flex-column justify-content-between">
              <h5 class="card-title">Panduan Wisata Ke Taman Bunaken</h5>
              <p class="card-text">Ini adalah panduan untuk membantu kamu menikmati perjalanan wisata ke taman bunaken yang indah.</p>
              <p class="card-text">Download PDF ini Jika anda ingin mengetahuinya !</p>
              <a href="../../view/assets/Panduan Mengenai Cara ke Bunaken.pdf" class="btn btn-primary" download>Download PDF</a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-12 mb-4">
      <div class="card guide-card">
        <div class="row">
          <div class="col-md-4">
            <img src="../../view/assets/bunaken.jpeg" class="card-img" alt="Panduan 1">
          </div>
          <div class="col-md-8 d-flex">
            <div class="card-body d-flex flex-column justify-content-between">
              <h5 class="card-title">Panduan Wisata Ke Taman Bunaken</h5>
              <p class="card-text">Ini adalah panduan untuk membantu kamu menikmati perjalanan wisata ke taman bunaken yang indah.</p>
              <p class="card-text">Download PDF ini Jika anda ingin mengetahuinya !</p>
              <a href="../../view/assets/Panduan Mengenai Cara ke Bunaken.pdf" class="btn btn-primary" download>Download PDF</a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-12 mb-4">
      <div class="card guide-card">
        <div class="row">
          <div class="col-md-4">
            <img src="../../view/assets/bunaken.jpeg" class="card-img" alt="Panduan 1">
          </div>
          <div class="col-md-8 d-flex">
            <div class="card-body d-flex flex-column justify-content-between">
              <h5 class="card-title">Panduan Wisata Ke Taman Bunaken</h5>
              <p class="card-text">Ini adalah panduan untuk membantu kamu menikmati perjalanan wisata ke taman bunaken yang indah.</p>
              <p class="card-text">Download PDF ini Jika anda ingin mengetahuinya !</p>
              <a href="../../view/assets/Panduan Mengenai Cara ke Bunaken.pdf" class="btn btn-primary" download>Download PDF</a>
            </div>
          </div>
        </div>
      </div>
    </div>
    </div>
</div>

  </div>
</div>

  </div>
  <!-- Akhir Panduan Section -->
   <!-- Footer -->
   <footer class="bg-dark text-center text-white mt-5">
        <!-- Grid container -->
        <div class="container p-4">
        <!-- Section: Social media -->
        
        </div>
        <!-- Grid container -->
        <!-- Section: Links -->
        <section>
        <div class="container text-center text-md-start mt-5">
            <!-- Grid row -->
            <div class="row mt-3">
            <!-- Grid column -->
            <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
                <!-- Content -->
                <h6 class="text-uppercase fw-bold">SATORU Destination</h6>
                <hr class="mb-4 mt-0 d-inline-block mx-auto" style="width: 60px; background-color: #7c4dff; height: 2px;" />
                <p>
                SATORU Destination adalah website yang menyediakan Tiket tempat wisata yang ada di Indonesia.
                </p>
            </div>
            <!-- Grid column -->
            <!-- Grid column -->
            <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
                <!-- Links -->
                <h6 class="text-uppercase fw-bold">Products</h6>
                <hr class="mb-4 mt-0 d-inline-block mx-auto" style="width: 60px; background-color: #7c4dff; height: 2px;" />
                <p>
                <a href="product.php" class="text-white">Wisata</a>
                </p>
                <p>
                <a href="about.php" class="text-white
                ">About</a>
                </p>
                <p>
                <a href="galery.php" class="text-white
                ">Galery</a>
                </p>
                <p>
                <a href="pesanan.php" class="text-white
                ">Pesanan</a>
                </p>
            </div>
            <!-- Grid column -->
            <!-- Grid column -->
                <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
                    <!-- Links -->
                    <h6 class="text-uppercase fw-bold">Social Media</h6>
                    <hr class="mb-4 mt-0 d-inline-block mx-auto" style="width: 60px; background-color: #7c4dff; height: 2px;" />
                    <p>
                    <a href="https://www.youtube.com/@SatoruFoundation"0class="text-white"
                    >Youtube</a>
                    </p>
                    <p>
                    <a href="https://wa.me/+6282113472156" class="text-white
                    ">WhatsApp</a>
                    </p>
                
                </div>
            
            <!-- Grid column -->
            <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
                <!-- Links -->
                <h6 class="text-uppercase fw-bold">Location</h6>
                <hr class="mb-4 mt-0 d-inline-block mx-auto" style="width: 60px; background-color: #7c4dff; height: 2px;" />
                <p>Institut Teknologi Indonesia</p>
                <p>
                Banten, Indonesia
                </p>
            </div>
            <!-- Grid column -->
            </div>
            <!-- Grid row -->
        </div>
        </section>
        <!-- Section: Links -->
    </footer>
    <!-- akhir footer -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
          integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
  </script>
</body>
</html>
