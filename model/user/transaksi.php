<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: /form/login.php");
    exit();
}

include '../../controller/koneksi.php';
// Mengambil ID wisata dari URL
$id_wisata = $_GET['id_wisata'];

// Mengambil data wisata berdasarkan ID
$sql = "SELECT tbl_wisata.nama, tbl_wisata.deskripsi, product.harga
        FROM tbl_wisata 
        JOIN product ON tbl_wisata.id = product.id_wisata 
        WHERE tbl_wisata.id = $id_wisata";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaksi - Pesan Tiket</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .form-container {
            width: 600px;
            height: 600px;
            border: 1px solid #ddd;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            background-color: #f8f9fa;
            margin: auto;
            margin-top: 50px;
            border-radius: 10px;
        }
        .form-container h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        .form-container .form-label {
            margin-bottom: 5px;
        }
        .form-container .btn-primary {
            width: 100%;
        }
        .form-container .btn-danger {
            width: 100%;
            margin-top: 10px;
        }
        .total-pembayaran {
            font-size: 1.2em;
            font-weight: bold;
        }
    </style>
    <script>
        function hitungTotalPembayaran() {
            var hargaTiket = <?php echo $row['harga']; ?>;
            var hari = document.getElementById('hari').value;
            var peserta = document.getElementById('peserta').value;
            var total = hargaTiket * hari * peserta;
            document.getElementById('totalPembayaran').innerText = 'Total Pembayaran: Rp ' + total.toLocaleString('id-ID');
        }
    </script>
</head>
<body>
    <div class="container">
        <div class="form-container">
            <h1>Pesan Tiket: <?php echo $row['nama']; ?></h1>
            <p><?php echo $row['deskripsi']; ?></p>
            <p>Harga Tiket: Rp <?php echo number_format($row['harga'], 2, ',', '.'); ?></p>

            <form action="../../controller/proses_transaksi.php" method="post">
                <input type="hidden" name="id_wisata" value="<?php echo $id_wisata; ?>">
                <div class="mb-3">
                    <label for="pelayanan" class="form-label">Pelayanan</label>
                    <select class="form-select" id="pelayanan" name="pelayanan">
                        <option value="Standar">Standar</option>
                        <option value="VIP">VIP</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="hari" class="form-label">Berapa Hari</label>
                    <input type="number" class="form-control" id="hari" name="hari" required oninput="hitungTotalPembayaran()">
                </div>
                <div class="mb-3">
                    <label for="peserta" class="form-label">Jumlah Peserta</label>
                    <input type="number" class="form-control" id="peserta" name="peserta" required oninput="hitungTotalPembayaran()">
                </div>
                <div class="mb-3">
                    <p id="totalPembayaran" class="total-pembayaran">Total Pembayaran: Rp. 0</p>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
                <a href="product.php" class="btn btn-danger">Cancel</a>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>

<?php
// Menutup koneksi
$conn->close();
?>
