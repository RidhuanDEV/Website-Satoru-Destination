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
    .profile-section, .form-section {
      background-color: #fff;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    .profile-section {
      margin-left: 20px;
    }
    .row > div {
      margin-top: 20px;
    }
  </style>
</head>
<body>
  <div class="container mt-5">
    <div class="row">
      <div class="col-md-6">
        <div class="form-section">
          <h3>Update Profil</h3>
          <form action="update_profile.php" method="post">
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
          // Sesuaikan dengan konfigurasi database Anda
          $servername = "localhost";
          $username = "root";
          $password = "";
          $dbname = "wisata";

          // Membuat koneksi
          $conn = new mysqli($servername, $username, $password, $dbname);

          // Memeriksa koneksi
          if ($conn->connect_error) {
            die("Koneksi gagal: " . $conn->connect_error);
          }

          // Query untuk mengambil data pengguna
          $sql = "SELECT nama, email FROM tbl_user WHERE id = 1"; // Sesuaikan dengan id pengguna yang sedang login
          $result = $conn->query($sql);

          if ($result->num_rows > 0) {
            // Output data dari setiap baris
            while($row = $result->fetch_assoc()) {
              echo "<p>Nama: " . $row["nama"]. "</p><p>Email: " . $row["email"]. "</p>";
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

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
