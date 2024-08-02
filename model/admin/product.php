<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <link rel="stylesheet" href="css/style.css">
  <title>Halaman Admin Satoru Destination</title>
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
            <a href="product.php" class="nav-link px-3 active">
              <span class="me-2"><i class="bi bi-database-fill-gear"></i></span>
              <span>Wisata</span>
            </a>
          </li>
          <li>
            <a href="tiket.php" class="nav-link px-3">
              <span class="me-2"><i class="bi bi-database-fill-gear"></i></span>
              <span>Tiket Wisata</span>
            </a>
          </li>
          <li>
            <a href="#" class="nav-link px-3">
              <span class="me-2"><i class="bi bi-gear"></i></span>
              <span>Settings</span>
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
      <h1 class="mb-4">Daftar Wisata</h1>
      <a href="form/create_wisata.php" class="btn btn-primary mb-3">Create Data</a>
      <table id="wisataTable" class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>ID</th>
            <th>Nama Wisata</th>
            <th>Deskripsi</th>
            <th>Foto</th>
            <th>Harga</th>
            <th>Diskon</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $servername = "localhost";
          $username = "root";
          $password = "";
          $dbname = "wisata";

          $conn = new mysqli($servername, $username, $password, $dbname);

          if ($conn->connect_error) {
            die("Koneksi gagal: " . $conn->connect_error);
          }

          $sql = "SELECT tbl_wisata.*, product.harga FROM tbl_wisata JOIN product ON tbl_wisata.id = product.id_wisata";
          $result = $conn->query($sql);

          if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
              echo "<tr>";
              echo "<td>" . $row["id"] . "</td>";
              echo "<td>" . $row["nama"] . "</td>";
              echo "<td>" . $row["deskripsi"] . "</td>";
              echo "<td><img src='../../view/produk/" . $row["foto"] . "' alt='foto' width='100'></td>";
              echo "<td>" . $row["harga"] . "</td>";
              echo "<td>" . ($row["diskon"] ? "Ya" : "Tidak") . "</td>";
              echo "<td><a href='form/update_wisata.php?id=" . $row["id"] . "' class='btn btn-warning'>Update</a> 
              <a href='../../controller/delete_wisata.php?id=" . $row["id"] . "' class='btn btn-danger'>Delete</a></td>";
              echo "</tr>";
            }
          } else {
            echo "<tr><td colspan='7'>Tidak ada data.</td></tr>";
          }

          $conn->close();
          ?>
        </tbody>
      </table>
      </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
  <script>
    $(document).ready(function() {
        $('#wisataTable').DataTable();
    });
  </script>
</body>
</html>
