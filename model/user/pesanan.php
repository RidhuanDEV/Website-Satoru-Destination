<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    // Pengguna belum login, arahkan ke halaman login
    header("Location: form/login.php");
    exit();
}

// Jika pengguna sudah login, periksa perannya
if ($_SESSION['user_id'] == 'admin') {
    // Arahkan admin ke halaman admin
    header("Location: ../admin/index.php");
    exit();
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>
  
<body>
    <!-- nav bar -->
<nav class="navbar navbar-expand-lg bg-dark border-bottom border-body sticky-top " data-bs-theme="dark">
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
                    <a class="nav-link" href="galery.php">Galery</a>
                </li>
                <li class="nav-item g-6 col-1 ">
                    <a class="nav-link active" href="pesanan.php">Pesanan</a>
                </li>
                </ul>
                <div class="justify-content-end col-4 p-2"> 
                    <?php
                        
                        
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
                                        <a class="nav-link overflow-hidden" href="../account.php">' . htmlspecialchars($userName) . '</a>
                                    </li>
                                    <li class="nav-item g-4 col-sm-5 mx-4">
                                        <a class="nav-link" href="../../controller/logout.php">Log Out</a>
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
    <!-- daftar table pesanan -->
    <div class="col-sm-12 text-center"> 
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <h2 class="text-center my-4">Daftar Pesanan Tiket Wisata</h2>
                </div>
            </div>
        </div>
    </div>
    <?php
        include '../../controller/koneksi.php';
        include '../../controller/fungsi_konversi.php';
        // Mengambil data dari tabel test_wisata
        $sql = "SELECT * FROM test_wisata WHERE id_users = " . $_SESSION['user_id'];
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            echo "<div class='container border border-2 shadow overflow-auto' style='height: 400px;'>";
            echo "<table class='table table-striped'>";
            echo "<thead class='thead-dark'>
                    <tr>
                        <th scope='col'>ID Transaksi</th>
                        <th scope='col'>Tanggal Pemesanan</th>
                        <th scope='col'>Pelayanan</th>
                        <th scope='col'>Waktu</th>
                        <th scope='col'>Peserta</th>
                        <th scope='col'>Total Pembayaran</th>
                        <th scope='col'>Review Pesanan</th>
                        <th scope='col'>Bayar Pesanan</th>
                        <th scope='col'>Batalkan Pesanan</th>
                    </tr>
                </thead>
                <tbody>";
            // Output data of each row
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <th scope='row'>".$row['id_transaksi']."</th>
                        <td>".formatTanggal($row['tanggal_pemesanan'])."</td>
                        <td>".$row['pelayanan']."</td>
                        <td>".$row['hari']." Hari</td>
                        <td>".$row['peserta']." Orang</td>
                        <td>".formatRupiah($row['total_pembayaran'])."</td>
                        <td><a href='review_pesanan.php?id=".$row['id_transaksi']."&id_wisata=".$row['id_wisata']."' class='btn btn-primary btn-sm'>Review</a></td>
                        <td><a href=../../controller/bayar.php?id_transaksi=".$row['id_transaksi']."' class='btn btn-success btn-sm' onclick='return confirm(\"Apakah Anda yakin ingin membayar pesanan ini?\");'>Bayar</a></td>
                        <td><a href='../../controller/delete_pesanan.php?id_transaksi=".$row['id_transaksi']."' class='btn btn-danger btn-sm' onclick='return confirm(\"Apakah Anda yakin ingin membatalkan pesanan ini?\");'>Batalkan</a></td>
                    </tr>";
            }
            echo "</tbody></table></div>";
        } else {
            echo "<h2 class='text-center mt-5'>Tidak ada Pesanan</h2>";
        }
    ?>

    <!-- akhir daftar table pesanan-->
    <!-- daftar table TIKET -->
    <div class="col-sm-12 text-center border-top border-2"> 
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <h2 class="text-center my-4">Daftar Tiket Yang Anda Miliki</h2>
                </div>
            </div>
        </div>
    </div>
    <?php
        // Mengambil data dari tabel tiket_wisata
        $sql = "SELECT * FROM tiket_wisata WHERE id_users = " . $_SESSION['user_id'];
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            echo "<div class='container border border-2 shadow overflow-auto' style='height: 400px;'>";
            echo "<table class='table table-striped'>";
            echo "<thead class='thead-dark'>
                    <tr>
                        <th scope='col'>ID Transaksi</th>
                        <th scope='col'>Tanggal Pemesanan</th>
                        <th scope='col'>Pelayanan</th>
                        <th scope='col'>Waktu Berwisata</th>
                        <th scope='col'>Peserta</th>
                        <th scope='col'>Total Pembayaran</th>
                        <th scope='col'>Tiket Wisata</th>
                        
                    </tr>
                    </thead>
                    <tbody>";
            // Output data of each row
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <th scope='row'>" . $row['id_transaksi'] . "</th>
                        <td>" . formatTanggal($row['tanggal_pemesanan']) . "</td>
                        <td>" . $row['pelayanan'] . "</td>
                        <td>" . $row['hari'] . " Hari</td>
                        <td>" . $row['peserta'] . " Orang</td>
                        <td>" . formatRupiah($row['total_pembayaran']) . "</td>";
                
                if ($row['status'] == 'done') {
                    echo "<td><a href='cetak_tiket.php?id=" . $row['id_transaksi'] . "' class='btn btn-primary btn-sm'>Cetak Tiket</a></td>";
                } else {
                    echo "<td style='color: blue;'>".$row['status']."</td>";
                }
                
                echo "</tr>";
            }
            echo "
                    </tbody>
                  </table>
                </div>";
        } else {
            echo "<h2 class='text-center mt-5'>Tidak ada Pesanan</h2>";
        }
    ?>

    <!-- akhir daftar table TIKET-->
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
  </body>
</html>

