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


include '../../controller/koneksi.php';
// Mengambil ID wisata dari URL
$id_wisata = $_GET['id_wisata'];
$id = $_GET['id'];

// Mengambil data wisata berdasarkan ID
$sql = "SELECT tbl_wisata.nama, tbl_wisata.deskripsi,tbl_wisata.diskon, product.harga
        FROM tbl_wisata 
        JOIN product ON tbl_wisata.id = product.id_wisata 
        WHERE tbl_wisata.id = $id_wisata";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
} else {
    echo "Data tidak ditemukan";
    exit();
}
// Menghitung harga setelah diskon jika diskon = true
if ($row["diskon"] == 'true') {
    $discounted_price = $row["harga"] * 0.8;
} else {
    $discounted_price = $row["harga"];
}
$sql = "SELECT * FROM test_wisata WHERE id_transaksi = $id and id_users = " . $_SESSION['user_id'];
$results = $conn->query($sql);
if ($results->num_rows > 0) {
    $rows = $results->fetch_assoc();
} else {
    echo "Data tidak ditemukan";
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Review Pesanan - Pesan Tiket</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <script src="../../controller/hitungTotal.js"></script>
</head>

<body>
    <div class="container">
        <div class="form-container">
            <h1>Pesan Tiket: <?php echo $row['nama']; ?></h1>
            <p><?php echo $row['deskripsi']; ?></p>
            <p>Harga Tiket: Rp <?php echo number_format($discounted_price, 2, ',', '.'); ?></p>

            <form action="../../controller/update_transaksi.php" method="post">
                <input type="hidden" name="id_transaksi" value="<?php echo $rows['id_transaksi']; ?>">
                <input type="hidden" name="id_wisata" value="<?php echo $rows['id_wisata']; ?>">
                <input type="hidden" id="hargaTiket" value="<?php echo $discounted_price; ?>" data-discount="<?php echo $row['diskon']; ?>">
                <div class="mb-3">
                    <label class="form-label">Pelayanan</label><br>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="penginapan" name="penginapan" value="200000" onchange="hitungTotalPembayaran()">
                        <label class="form-check-label" for="penginapan">
                            Penginapan (Rp. 200.000)
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="penerbangan" name="penerbangan" value="300000" onchange="hitungTotalPembayaran()">
                        <label class="form-check-label" for="penerbangan">
                            Penerbangan (Rp. 300.000)
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="makan_minum" name="makan_minum" value="100000" onchange="hitungTotalPembayaran()">
                        <label class="form-check-label" for="makan_minum">
                            Makan dan Minum (Rp. 100.000)
                        </label>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="hari" class="form-label">Berapa Hari</label>
                    <input type="number" class="form-control" id="hari" name="hari" min="1" required value="<?php echo $rows['hari']; ?>" oninput="hitungTotalPembayaran()">
                </div>
                <div class="mb-3">
                    <label for="peserta" class="form-label">Jumlah Peserta</label>
                    <input type="number" class="form-control" id="peserta" name="peserta" min="1" required value="<?php echo $rows['peserta']; ?>" oninput="hitungTotalPembayaran()">
                </div>
                <div class="mb-3">
                    <p id="totalPembayaran" class="total-pembayaran">Total Pembayaran: Rp <?php echo number_format($rows['total_pembayaran'], 2, ',', '.'); ?></p>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
                <a href="product.php" class="btn btn-danger">Cancel</a>
            </form>
        </div>
    </div>

    <script>
        window.onload = function() {
            hitungTotalPembayaran();
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>

<?php
// Menutup koneksi
$conn->close();
?>