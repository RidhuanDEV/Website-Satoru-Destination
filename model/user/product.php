
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Destinasi Wisata</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .card-height-250 {
            height: 250px;
        }

    </style>
</head>
<body>
    <!-- nav bar -->
    <nav class="navbar navbar-expand-lg bg-dark border-bottom border-body sticky-top" data-bs-theme="dark">
        <div class="container-fluid">
        <a class="navbar-brand" href="../../index.php">SATORU Destination</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse " id="navbarNav">
            <ul class="navbar-nav col-8 g-6 text-center">
            <li class="nav-item g-6 col-1">
                <a class="nav-link active" href="product.php">Product</a>
            </li>
            <li class="nav-item g-6 col-1">
                <a class="nav-link" href="about.php">About</a>
            </li>
            <li class="nav-item g-6 col-1">
                <a class="nav-link" href="galery.php">Galery</a>
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
                        <a class="nav-link overflow-hidden" href="model/user/account.php">' . htmlspecialchars($userName) . '</a>
                      </li>
                      <li class="nav-item g-4 col-sm-5 mx-4">
                        <a class="nav-link" href="model/user/logout.php">Log Out</a>
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

    <!-- product -->
    <div class="col-sm-12 text-center"> 
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <h1 class="text-center mt-5">Destinasi Wisata</h1>
                </div>
            </div>
        </div>
    </div>
    <div class="container w-100 overflow-auto border border-2 g-4 d-flex flex-wrap justify-content-between" style="height: 1000px;">
        <?php
        include '../../controller/koneksi.php';
        // Mengambil data dari tabel tbl_wisata
        $sql = "SELECT tbl_wisata.id, tbl_wisata.nama, tbl_wisata.deskripsi, product.harga 
                FROM tbl_wisata 
                JOIN product ON tbl_wisata.id = product.id_wisata   ";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Output data dari setiap baris
            while($row = $result->fetch_assoc()) {
                echo '<div class="card mb-3 flex-grow-1 mt-3 card-height-250" style="max-width: 600px;">';
                echo '    <div class="row g-0 h-100">';
                echo '        <div class="col-md-4">';
                echo '            <img src="../../view/assets/wisata1.jpg" class="img-fluid h-100" style="object-fit: cover;" alt="...">';
                echo '        </div>';
                echo '        <div class="col-md-8 d-flex">';
                echo '            <div class="card-body d-flex flex-column justify-content-between">';
                echo '                <div class="d-md-block">';
                echo '                    <h5 class="card-title">' . $row["nama"] . '</h5>';
                echo '                    <p class="card-text">' . $row["deskripsi"] . '</p>';
                echo '                </div>';
                echo '                <div class="d-md-block">';
                echo '                    <p class="card-text"><small class="text-body-secondary">' . 'Rp.'. $row["harga"] . '</small></p>';
                echo '                    <a href="transaksi.php?id_wisata=' . $row["id"] . '" class="btn btn-primary">Pesan Tiket Wisata</a>';
                echo '                </div>';
                echo '            </div>';
                echo '        </div>';
                echo '    </div>';
                echo '</div>';
            }
        } else {
            echo "0 results";
        }

        // Menutup koneksi
        $conn->close();
        ?>
    </div>
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
              <a href="#!" class="text-white">Wisata</a>
            </p>
            <p>
              <a href="#!" class="text-white
              ">About</a>
            </p>
            <p>
              <a href="#!" class="text-white
              ">Galery</a>
            </p>
            <p>
              <a href="#!" class="text-white
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
              <a href="#!" class="text-white"
              >Youtube</a>
            </p>
            <p>
              <a href="#!" class="text-white
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
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const cards = document.querySelectorAll('.card');
            if (cards.length < 6) {
                cards.forEach(card => {
                    card.classList.add('card-height-250');
                });
            }
        });
    </script>
</body>
</html>
