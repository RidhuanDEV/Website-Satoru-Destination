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
            <a href="index.php" class="nav-link px-3 active">
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
            <a href="tiket.php" class="nav-link px-3 ">
              <span class="me-2"><i class="bi bi-database-fill-gear"></i></span>
              <span>Daftar Pesanan Tiket</span>
            </a>
          </li>
          <li>
            <a href="pemesanan_tiket.php" class="nav-link px-3">
              <span class="me-2"><i class="bi bi-database-fill"></i></span>
              <span>Pemesanan Tiket</span>
            </a>
          </li>
          <li>
            <a href="book_tiket.php" class="nav-link px-3">
              <span class="me-2"><i class="bi bi-database-fill"></i></span>
              <span>Daftar Booking Tiket</span>
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
  <div class="container d-flex mt-4">
    <div style="width:   250px;height:fit-content"></div>
    <!-- Dashboard content -->
    <?php
    include '../../controller/koneksi.php';

    // Ambil total dari setiap tabel
    $sql_users = "SELECT COUNT(*) AS total_users FROM tbl_user";
    $sql_products = "SELECT COUNT(*) AS total_products FROM tbl_wisata";
    $sql_tickets = "SELECT COUNT(*) AS total_tickets FROM tiket_wisata";
    $sql_bookings = "SELECT COUNT(*) AS total_bookings FROM test_wisata";

    $result_users = $conn->query($sql_users);
    $result_products = $conn->query($sql_products);
    $result_tickets = $conn->query($sql_tickets);
    $result_bookings = $conn->query($sql_bookings);

    $total_users = $result_users->fetch_assoc()['total_users'];
    $total_products = $result_products->fetch_assoc()['total_products'];
    $total_tickets = $result_tickets->fetch_assoc()['total_tickets'];
    $total_bookings = $result_bookings->fetch_assoc()['total_bookings'];

    $conn->close();
    ?>
    <div class="container mt-5 pt-3">
      <div class="row">
        <!-- Card for Users -->
        <div class="col-md-4 mb-4">
          <div class="card text-white bg-primary">
            <div class="card-body">
              <h5 class="card-title">Total Users</h5>
              <p class="card-text"><?php echo $total_users; ?> User</p>
              <a href="user.php" class="btn btn-light">Lihat Detail</a>
            </div>
          </div>
        </div>
        <!-- Card for wisata -->
        <div class="col-md-4 mb-4">
          <div class="card text-white bg-success">
            <div class="card-body">
              <h5 class="card-title">Total Wisata</h5>
              <p class="card-text"><?php echo $total_products; ?> Wisata</p>
              <a href="product.php" class="btn btn-light">Lihat Detail</a>
            </div>
          </div>
        </div>
        <!-- Card for tiket wisata -->
        <div class="col-md-4 mb-4">
          <div class="card text-white bg-danger">
            <div class="card-body">
              <h5 class="card-title">Total Tiket Wisata</h5>
              <p class="card-text"><?php echo $total_tickets; ?> Daftar Tiket yang sudah diBayar</p>
              <a href="tiket.php" class="btn btn-light">Lihat Detail</a>
            </div>
          </div>
        </div>
        <!-- Card for pemesanan tiket -->
        <div class="col-md-4 mb-4">
          <div class="card text-white bg-info">
            <div class="card-body">
              <h5 class="card-title">Total Pemesanan Tiket</h5>
              <p class="card-text"><?php echo $total_bookings; ?> Pemesanan</p>
              <a href="pemesanan_tiket.php" class="btn btn-light">Lihat Detail</a>
            </div>
          </div>
        </div>
        <!-- card for booking tiket -->
        <div class="col-md-4 mb-4">
          <div class="card text-white bg-info">
            <div class="card-body">
              <h5 class="card-title">Total Booking Tiket</h5>
              <p class="card-text"><?php echo $total_bookings; ?> Tiket yang di Booking</p>
              <a href="book_tiket.php" class="btn btn-light">Lihat Detail</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- akhir Dashboard  -->
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>