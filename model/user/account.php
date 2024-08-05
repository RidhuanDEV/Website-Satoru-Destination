<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Profil Pengguna</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <style>
    .container {
      background-color: #f0f0f0;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .profile-section,
    .form-section {
      background-color: #fff;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .profile-section {
      margin-left: 20px;
    }

    .row>div {
      margin-top: 20px;
    }
  </style>
</head>

<body>
  <!-- Update profile form -->
  <div class="container mt-5">
    <div class="row">
      <div class="col-md-6">
        <div class="form-section">
          <h3>Update Profil</h3>
          <form action="../../controller/update_profile.php" method="post">
            <div class="mb-3">
              <label for="nama" class="form-label">Nama Baru</label>
              <input type="text" class="form-control" id="nama" name="nama" required>
            </div>
            <div class="mb-3">
              <label for="password_lama" class="form-label">Password Lama</label>
              <input type="password" class="form-control" id="password_lama" name="password_lama" required>
            </div>
            <div class="mb-3">
              <label for="password_baru" class="form-label">Password Baru</label>
              <input type="password" class="form-control" id="password_baru" name="password_baru" required>
            </div>
            <div class="mb-3">
              <label for="konfirmasi_password" class="form-label">Konfirmasi Password Baru</label>
              <input type="password" class="form-control" id="konfirmasi_password" name="konfirmasi_password" required>
            </div>
            <button type="submit" class="btn btn-primary">Update Profil</button>
          </form>
        </div>
      </div>
      <div class="col-md-6">
        <div class="profile-section">
          <h2>Profil Pengguna</h2>
          <?php
          // Konfigurasi database
          include '../../controller/koneksi.php';

          // Query untuk mengambil data pengguna
          $sql = "SELECT nama, email FROM tbl_user WHERE id = " . $SESSION['user_id'] . "";
          $result = $conn->query($sql);

          if ($result->num_rows > 0) {
            // Output pROFILE pengguna
            while ($row = $result->fetch_assoc()) {
              echo "
              <p>Nama: " . $row["nama"] . "</p>
              <p>Email: " . $row["email"] . "</p>";
            }
          } else {
            echo "Data pengguna tidak ditemukan";
          }
          $conn->close();
          ?>
        </div>
      </div>
    </div>
  </div>
  <!-- akhir profile -->
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
              <a href="https://www.youtube.com/@SatoruFoundation" 0class="text-white">Youtube</a>
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
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>