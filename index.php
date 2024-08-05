
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SATORU Destination</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
  <!-- nav bar -->
  <nav class="navbar navbar-expand-lg bg-dark border-bottom border-body sticky-top" data-bs-theme="dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">SATORU Destination</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse " id="navbarNav">
        <ul class="navbar-nav col-8 g-6 text-center">
          <li class="nav-item g-6 col-1">
            <a class="nav-link" href="model/user/product.php">Product</a>
          </li>
          <li class="nav-item g-6 col-1">
            <a class="nav-link" href="model/user/about.php">About</a>
          </li>
          <li class="nav-item g-6 col-1">
            <a class="nav-link" href="model/user/galery.php">Galery</a>
          </li>
          <li class="nav-item g-6 col-1 ">
            <a class="nav-link" href="model/user/pesanan.php">Pesanan</a>
          </li>
        </ul>
        <div class="justify-content-end col-4 p-2"> 
          <?php
          session_start();
          
          include 'controller/koneksi.php';
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
                        <a class="nav-link overflow-hidden" href="model/user/account.php">' . htmlspecialchars($userName) . '</a>
                      </li>
                      <li class="nav-item g-4 col-sm-5 mx-4">
                        <a class="nav-link" href="controller/logout.php">Log Out</a>
                      </li>
                    </ul>
                  ';
          } else {
            echo '<a href="model/user/form/login.php" class="text-decoration-none">SIGN IN / SIGN UP</a>';
          }

          ?>
        </div>
      </div>
    </div>
  </nav>
  <!-- akhir navbar -->
   <!-- Contoh Wisata -->
  <div class="col-sm-12">
    <div id="carouselExampleCaptions" class="carousel slide">
      <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
      </div>
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img class="img-thumbnail w-100 object-fit-cover" style="height: 450px;" src="view/assets/wisata3.jpg" alt="..." />
          <div class="carousel-caption d-none d-md-block">
            <h3>Cari Tempat Destination Wisata !</h3>
            <h5>Mulai Dari Rp.100.000</h5>
          </div>
        </div>
        <div class="carousel-item">
          <img class="img-thumbnail w-100 object-fit-cover" style="height: 450px;" src="view/assets/wisata.jpg" alt="..." />
          <div class="carousel-caption d-none d-md-block">
          <h3>Cari Tempat Destination Wisata !</h3>
          <h5>Mulai Dari Rp.100.000</h5>
          </div>
        </div>
        <div class="carousel-item">
          <img class="img-thumbnail w-100 object-fit-cover" style="height: 450px;" src="view/assets/wisata2.jpg" alt="..." />
          <div class="carousel-caption d-none d-md-block">
          <h3>Cari Tempat Destination Wisata !</h3>
          <h5>Mulai Dari Rp.100.000</h5>
          </div>
        </div>
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>
  </div>
  <!-- akhir contoh wisata -->
   <!-- query mengambil data wisata terbaru -->
    <!-- wisata terpopuler -->
    <div class="col-sm-12">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <h1 class="text-center mt-5">Wisata Terpopuler</h1>
                </div>
            </div>
            <div class="row rounded border p-2">
                <?php
                include 'controller/koneksi.php';
                include 'controller/fungsi_limit_wisata.php' ;
                $wisata = fetch_wisata('ASC');
                 for ($i = 0; $i < 3; $i++) {
                  if (isset($wisata[$i])) {
                      $nama = $wisata[$i]['nama'];
                      $deskripsi = $wisata[$i]['deskripsi'];
                      $foto =  $wisata[$i]["foto"];
                      if ($wisata[$i]["diskon"] == 'true') {
                          $discounted_price = $wisata[$i]["harga"] * 0.8;
                          $original_price = number_format($wisata[$i]["harga"], 0, ',', '.');
                          $discount_label = '<span class="badge bg-success">Discount 20%</span>';
                      } else {
                          $discounted_price = $wisata[$i]["harga"];
                          $original_price = '';
                          $discount_label = '';
                      }
                  } else {
                      $nama = "Coming Soon";
                      $deskripsi = "Coming Soon";
                      $foto = "coming_soon.jpeg"; // Gambar placeholder
                  }
                      echo '
                      
                          <div class="col-sm-4">
                              <div class="card mt-3">
                                  <img src="view/produk/' . $foto . '" class="img-fluid" style="object-fit: cover;height: 300px;" alt="...">
                              </div>
                              <div class="col-md-8 d-flex">
                                  <div class="card-body d-flex flex-column justify-content-between">
                                      <div class="d-md-block">
                                          <h5 class="card-title">' . $nama . '</h5>
                                          <p class="card-text">' . $deskripsi . '</p>
                                      </div>
                                      <div class="d-md-block">';
                                  if (isset($wisata[$i])){
                                    if ($wisata[$i]["diskon"] == 'true') {
                                        echo '
                                        <p class="card-text">
                                            <small class="text-body-secondary">
                                                <s>Rp.' . $original_price . '</s>
                                            </small>
                                        </p>
                                        <p class="card-text">
                                            <small class="text-body-secondary text-danger">
                                                Rp.' . $discounted_price . '
                                            </small> ' . $discount_label . '
                                        </p>';
                                    } else {
                                        echo '
                                        <p class="card-text">
                                            <small class="text-body-secondary">
                                                Rp.' . $discounted_price . '
                                            </small>
                                        </p>';
                                    }
                                  
                                        echo '
                                        <a href="model/user/transaksi.php?id_wisata=' . $wisata[$i]['id'] . '" class="btn btn-primary">
                                            Pesan Tiket Wisata
                                        </a>';
                                  }
                        echo'        </div>
                                  </div>
                              </div>
                          </div>
                      ';
                    
                    } 
                
                ?>
            </div>
        </div>
    </div>
    <!-- akhir wisata terpopuler -->
  <!-- wisata terbaru -->
  <div class="col-sm-12">
        <div class="container">
            <div class="row ">
                <div class="col-sm-12">
                    <h1 class="text-center mt-5">Wisata Terbaru</h1>
                </div>
            </div>
            <div class="row rounded border p-2">
                <?php
                $wisata = fetch_wisata('DESC');
                 for ($i = 0; $i < 3; $i++) {
                  if (isset($wisata[$i])) {
                      $nama = $wisata[$i]['nama'];
                      $deskripsi = $wisata[$i]['deskripsi'];
                      $foto =  $wisata[$i]["foto"];
                      if ($wisata[$i]["diskon"] == 'true') {
                          $discounted_price = $wisata[$i]["harga"] * 0.8;
                          $original_price = number_format($wisata[$i]["harga"], 0, ',', '.');
                          $discount_label = '<span class="badge bg-success">Discount 20%</span>';
                      } else {
                          $discounted_price = $wisata[$i]["harga"];
                          $original_price = '';
                          $discount_label = '';
                      }
                  } else {
                      $nama = "Coming Soon";
                      $deskripsi = "Coming Soon";
                      $foto = "coming_soon.jpeg"; // Gambar placeholder
                  }
                      echo '
                      
                          <div class="col-sm-4">
                              <div class="card mt-3">
                                  <img src="view/produk/' . $foto . '" class="img-fluid" style="object-fit: cover;height: 300px;" alt="...">
                              </div>
                              <div class="col-md-8 d-flex">
                                  <div class="card-body d-flex flex-column justify-content-between">
                                      <div class="d-md-block">
                                          <h5 class="card-title">' . $nama . '</h5>
                                          <p class="card-text">' . $deskripsi . '</p>
                                      </div>
                                      <div class="d-md-block">';
                                  if (isset($wisata[$i])){
                                    if ($wisata[$i]["diskon"] == 'true') {
                                        echo '
                                        <p class="card-text">
                                            <small class="text-body-secondary">
                                                <s>Rp.' . $original_price . '</s>
                                            </small>
                                        </p>
                                        <p class="card-text">
                                            <small class="text-body-secondary text-danger">
                                                Rp.' . $discounted_price . '
                                            </small> ' . $discount_label . '
                                        </p>';
                                    } else {
                                        echo '
                                        <p class="card-text">
                                            <small class="text-body-secondary">
                                                Rp.' . $discounted_price . '
                                            </small>
                                        </p>';
                                    }
                                  
                                        echo '
                                        <a href="model/user/transaksi.php?id_wisata=' . $wisata[$i]['id'] . '" class="btn btn-primary">
                                            Pesan Tiket Wisata
                                        </a>';
                                  }
                        echo'        </div>
                                  </div>
                              </div>
                          </div>
                      ';
                    
                    } 
                
                ?>
            </div>
        </div>
    </div>
  <!-- akhir wisata terbaru -->
  <!-- View All Product -->
  <div class="col-sm-12 text-center mt-4">
    <a class="btn btn-primary btn-lg p-2" href="model/user/product.php" role="button">Lihat Semua Wisata</a>
  </div>
  <!-- akhir View All Product -->
  <!-- Video Cuplikan Wisata -->
   <div class="container justify-content-center align-items-center">
      <div class="col-sm-12">
        <h1 class="text-center mt-5">Wisata Nusantara</h1>
      </div>
      <div class="col-sm-12 d-flex justify-content-center align-items-center">
        <video width="80%" height="40%" class="object-fit-cover" controls>
          <source src="view/assets/movie.mp4" type="video/mp4">
          Your browser does not support the video tag.
        </video>
      </div>
    </div>
  <!-- akhir Video Cuplikan Wisata -->
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
              <a href="model/user/product.php" class="text-white">Wisata</a>
            </p>
            <p>
              <a href="model/user/about.php" class="text-white
              ">About</a>
            </p>
            <p>
              <a href="model/user/galery.php" class="text-white
              ">Galery</a>
            </p>
            <p>
              <a href="model/user/pesanan.php" class="text-white
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
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>