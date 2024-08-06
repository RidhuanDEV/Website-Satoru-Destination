<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Destinasi Wisata</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/product.css">
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
                        <a class="nav-link overflow-hidden" href="account.php">' . htmlspecialchars($userName) . '</a>
                      </li>
                      <li class="nav-item g-4 col-sm-5 mx-4">
                        <a class="nav-link" href="../../controller/logout.php">Log Out</a>
                      </li>
                    </ul>
                  ';
                    } else {
                        echo '
                            <ul class="navbar-nav col-sm-12 g-6 text-center justify-content-end">
                                <li class="nav-item g-4 col-sm-4 ">
                                    <a href="form/login.php" class="text-decoration-none">SIGN IN / SIGN UP</a>
                                </li>
                            </ul>';
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
    <div class="container w-100 overflow-auto border border-2 g-4" style="height: 1000px;">
        <?php
        include '../../controller/koneksi.php';

        $sql = "SELECT tbl_wisata.foto, tbl_wisata.id, tbl_wisata.nama, tbl_wisata.deskripsi, tbl_wisata.diskon, product.harga 
              FROM tbl_wisata 
              JOIN product ON tbl_wisata.id = product.id_wisata";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                if ($row["diskon"] == 'true') {
                    $discounted_price = $row["harga"] * 0.8;
                    $original_price = number_format($row["harga"], 0, ',', '.');
                    $discount_label = '<span class="badge bg-success">Discount 20%</span>';
                } else {
                    $discounted_price = $row["harga"];
                    $original_price = '';
                    $discount_label = '';
                }

                echo '
              <div class="card mb-3 flex-grow-1 mt-3 card-height-250" style="max-width: 100%;">
                  <div class="row g-0 h-100">
                      <div class="col-sm-4">
                          <img src="../../view/produk/' . $row['foto'] . '" class="img-fluid object-fit-cover w-100 border rounded" style="height:250px;" alt="...">
                      </div>
                      <div class="col-sm-8 d-flex">
                          <div class="card-body d-flex flex-column justify-content-between">
                              <div class="d-md-block">
                                  <h5 class="card-title">' . $row['nama'] . '</h5>
                                  <p class="card-text">' . $row['deskripsi'] . '</p>
                              </div>
                              <div class="d-md-block">';

                if ($row["diskon"] == 'true') {
                    echo '
                  <p class="card-text text-decoration-line-through">
                      <small class="text-body-secondary">
                          <s>Rp.' . $original_price . '</s>
                      </small>
                  </p>
                  <p class="card-text">
                      <small class="text-body-secondary text-danger">
                          Rp.' . $discounted_price . '
                      </small> <h5>' . $discount_label . '</h5>
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
                  <a href="transaksi.php?id_wisata=' . $row['id'] . '" class="btn btn-primary">
                      Pesan Tiket Wisata
                  </a>
              </div>
          </div>
      </div>
  </div>
</div>';
            }
        } else {
            echo "0 results";
        }

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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const cards = document.querySelectorAll('.card');
            if (cards.length < 6) {
                cards.forEach(card => {
                    card.classList.add('card-height-250');
                });
            }
        });
        document.addEventListener("DOMContentLoaded", function() {
            var descriptions = document.querySelectorAll('.card-text');

            descriptions.forEach(function(desc) {
                var fullText = desc.textContent;
                if (fullText.length > 80) {
                    var shortText = fullText.substring(0, 80) + '...';
                    var longTextSpan = document.createElement('span');
                    longTextSpan.classList.add('card-text-long');
                    longTextSpan.textContent = fullText;

                    var shortTextSpan = document.createElement('span');
                    shortTextSpan.classList.add('card-text-short');
                    shortTextSpan.textContent = shortText;

                    desc.innerHTML = '';
                    desc.appendChild(shortTextSpan);
                    desc.appendChild(longTextSpan);
                }
            });
        });
    </script>
</body>

</html>