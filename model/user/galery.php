<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>

