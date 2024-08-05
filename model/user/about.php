<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tentang Kami - Satoru Destination</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/about.css">
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
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav col-8 g-6 text-center">
                    <li class="nav-item g-6 col-1">
                        <a class="nav-link" href="product.php">Product</a>
                    </li>
                    <li class="nav-item g-6 col-1">
                        <a class="nav-link active" href="about.php">About</a>
                    </li>
                    <li class="nav-item g-6 col-1">
                        <a class="nav-link" href="galery.php">Galery</a>
                    </li>
                    <li class="nav-item g-6 col-1">
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

    <!-- Hero Section -->
    <div class="hero-section">
        <h1>Selamat Datang di Satoru Destination</h1>
    </div>

    <!-- Tentang Kami Section -->
    <div class="container mt-5 about-section">
        <div class="row">
            <div class="col-12 box-shadow">
                <h2 class="section-title">Tentang Kami</h2>
                <p>Satoru Destination adalah perusahaan yang fokus di bidang pariwisata. Kami menyediakan banyak paket wisata yang ada di indonesia yang seru dan menantang. Dengan berbagai destinasi yang kami tawarkan, liburan kamu bakal lebih seru bareng keluarga dan teman-teman.</p>
                <p>Kami juga menyediakan berbagai fasilitas yang bikin perjalanan kamu makin nyaman. Dengan pelayanan yang ramah dan profesional, kami siap membantu merencanakan liburan kamu biar tak terlupakan.</p>
                <p>Untuk info lebih lanjut, hubungi kami di
                    <a href="mailto: satorufoundation@gmail.com">satorufoundation@gmail.com</a>.
                </p>
            </div>
        </div>
    </div>

    <!-- Tentang Developer Section -->
    <div class="container mt-5">
        <div class="row d-flex justify-content-between">
        <div class="col-md-4">
                <div class="card">
                    <img src="../../view/assets/profilsaya.jpg" class="card-img-top" alt="Keunggulan 1" style="height: 350px;">
                </div>
            </div>
            <div class="col-md-6">
                <h2 class="section-title">Tentang Developer</h2>
                <p class="box-shadow">SATORU Destination adalah sebuah website e-commerce yang saya buat untuk menjadi sebuah business dalam bidang pariwisata,
                     Nama Saya adalah Ridhuan Rangga Kusuma dan saya tinggal di Bogor, Seorang mahasiswa yang mengejar karir dalam dunia teknologi.</p>
            </div>
        </div>
    </div>

    <!-- Keunggulan Kami Section -->
    <div class="container mt-5">
        <div class="row text-center">
            <div class="col-12">
                <h2 class="section-title">Keunggulan Kami</h2>
            </div>
            <div class="col-md-4 mt-3">
                <div class="card">
                    <img src="../../view/assets/destinasi.jpg" class="card-img-top" alt="Keunggulan 1" style="height: 300px;">
                    <div class="card-body">
                        <h5 class="card-title">Banyak Pilihan Destinasi</h5>
                        <p class="card-text">Jelajahi berbagai destinasi dengan paket travel wisata kami yang lengkap, cocok untuk semua tipe traveler.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mt-3">
                <div class="card">
                    <img src="../../view/assets/professional.jpg" class="card-img-top" alt="Keunggulan 2" style="height: 300px;">
                    <div class="card-body">
                        <h5 class="card-title">Pelayanan Profesional</h5>
                        <p class="card-text">Tim kami siap memberikan pelayanan profesional dan ramah untuk memastikan pengalaman kamu tak terlupakan.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mt-3">
                <div class="card">
                    <img src="../../view/assets/money.jpg" class="card-img-top" alt="Keunggulan 3" style="height: 300px;">
                    <div class="card-body">
                        <h5 class="card-title">Harga Terjangkau</h5>
                        <p class="card-text">Kami menawarkan harga kompetitif untuk semua paket kami, jadi kamu bisa traveling tanpa khawatir soal budget.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Syarat Pesan Tiket Section -->
    <div class="container mt-5">
        <div class="row">
            <div class="col-12">
                <h2 class="section-title">Syarat Pesan Tiket</h2>
                <ol class="box-shadow">
                    <li>Semua pemesanan harus dilakukan minimal 48 jam sebelum keberangkatan.</li>
                    <li>Diperlukan identifikasi yang valid saat pemesanan dan saat tiba di tujuan.</li>
                    <li>Pembayaran penuh diperlukan untuk mengonfirmasi pemesanan Anda.</li>
                    <li>Kebijakan pembatalan berlaku. Silakan merujuk ke halaman kebijakan pembatalan kami untuk detail lebih lanjut.</li>
                    <li>Kebutuhan atau permintaan khusus harus dikomunikasikan saat pemesanan.</li>
                </ol>
            </div>
        </div>
    </div>
    <!-- akhir section -->
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
