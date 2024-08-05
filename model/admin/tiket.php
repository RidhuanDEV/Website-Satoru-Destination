<?php
session_start();

if (!isset($_SESSION['user_id'])) {
  // Pengguna belum login, arahkan ke halaman login
  header("Location: ../user/form/login.php");
  exit();
}

// Jika pengguna sudah login, periksa perannya
if ($_SESSION['user_id'] != 'admin') {
  // Arahkan pengguna biasa ke halaman user
  header("Location: ../../index.php");
  exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.datatables.net/2.1.3/css/dataTables.dataTables.min.css">
  <link rel="stylesheet" href="css/style.css">
  <title>Admin Dashboard</title>
</head>

<body>
  <!-- top navigation bar -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container-fluid">
      <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebar" aria-controls="offcanvasExample">
        <span class="navbar-toggler-icon" data-bs-target="#sidebar"></span>
      </button>
      <a class="navbar-brand me-auto ms-lg-0 ms-3 text-uppercase fw-bold" href="#">Halaman Admin Satoru Destination</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#topNavBar" aria-controls="topNavBar" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
    </div>
  </nav>
  <!-- top navigation bar -->
  <!-- offcanvas -->
  <div class="offcanvas sidebar-nav bg-dark" tabindex="-1" id="sidebar">
    <div class="offcanvas-body p-0">
      <nav class="navbar-dark">
        <ul class="navbar-nav">
          <li>
            <a href="index.php" class="nav-link px-3 ">
              <span class="me-2"><i class="bi bi-speedometer2"></i></span>
              <span>Dashboard</span>
            </a>
          </li>
          <li>
            <a href="user.php" class="nav-link px-3">
              <span class="me-2"><i class="bi bi-person"></i></span>
              <span>Users</span>
            </a>
          </li>
          <li>
            <a href="product.php" class="nav-link px-3">
              <span class="me-2"><i class="bi bi-database-fill-gear"></i></span>
              <span>Wisata</span>
            </a>
          </li>
          <li>
            <a href="tiket.php" class="nav-link px-3 active">
              <span class="me-2"><i class="bi bi-database-fill-gear"></i></span>
              <span>Daftar Booking Tiket</span>
            </a>
          </li>
          <li>
            <a href="pemesanan_tiket.php" class="nav-link px-3">
              <span class="me-2"><i class="bi bi-gear"></i></span>
              <span>Pemesanan Tiket</span>
            </a>
          </li>
          <li>
            <a href="../../controller/logout.php" class="nav-link px-3">
              <span class="me-2"><i class="bi bi-box-arrow-left"></i></span>
              <span>Log Out</span>
            </a>
          </li>
        </ul>
      </nav>
    </div>
  </div>
  <!-- offcanvas -->
  <!-- data wisata -->
  <div class="container d-flex">
    <div style="width: 250px;height: fit-content"></div>
    <div class="container mt-5 pt-3">
      <h1 class="mb-4">Daftar Booking Tiket Wisata</h1>
      <a href="form/create_wisata.php" class="btn btn-primary mb-3">Create Data</a>
      <table id="wisataTable" class="display">
        <thead>
          <tr>
            <th>ID Transaksi</th>
            <th>Email User</th>
            <th>Tanggal Pemesanan</th>
            <th>Total Pembayaran</th>
            <th>Time Out</th>
          </tr>
        </thead>
        <tbody>
          <?php
          include '../../controller/koneksi.php';
          include '../../controller/fungsi_konversi.php';
          // Mengambil data dari tabel tiket_wisata dan tabel tbl_user
          $sql = "SELECT tiket_wisata.*, tbl_user.email 
          FROM tiket_wisata 
          JOIN tbl_user ON tiket_wisata.id_users = tbl_user.id";

          $result = $conn->query($sql);

          if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
              echo "<tr>";
              echo "<td>" . $row["id_transaksi"] . "</td>";
              echo "<td>" . $row["email"] . "</td>";
              echo "<td>" . formatTanggal($row['tanggal_pemesanan']) . "</td>";
              echo "<td>" . formatRupiah($row['total_pembayaran']) . "</td>";
              echo "<td><a href='../../controller/timeout_pesanan.php?id=" . $row["id_transaksi"] . "' class='btn btn-danger' onclick='return confirm(\"Apakah Anda ingin Time Out pesanan ini?\")'>Time Out</a></td>";
              echo "</tr>";
            }
          } else {
            echo "<tr>
            <td colspan='1'>Tidak ada data.</td>
            <td colspan='1'>Tidak ada data.</td>
            <td colspan='1'>Tidak ada data.</td>
            <td colspan='1'>Tidak ada data.</td>
            <td colspan='1'>Tidak ada data.</td>
            </tr>";
          }

          $conn->close();
          ?>
        </tbody>
      </table>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https:////cdn.datatables.net/2.1.3/js/dataTables.min.js"></script>
  <script>
    $(document).ready(function() {
      $('#wisataTable').DataTable();
    });
  </script>
</body>

</html>