<?php
include 'koneksi.php';
session_start();
// Mengambil id_transaksi dari URL
$id_transaksi = isset($_GET['id_transaksi']) ? intval($_GET['id_transaksi']) : 0;
$id_user = $_SESSION['user_id'];

// Memeriksa apakah id_transaksi valid
if ($id_transaksi <= 0) {
    echo "<script>
            alert('ID Transaksi tidak valid');
            window.history.back();
          </script>";
    exit();
}

// Menyiapkan pernyataan SQL dengan prepared statements
$stmt = $conn->prepare("DELETE FROM test_wisata WHERE id_transaksi = ? AND id_users = ?");
$stmt->bind_param("ii", $id_transaksi, $id_user);

// Menjalankan pernyataan SQL
if ($stmt->execute()) {
    echo "<script>
            alert('Pesanan berhasil dihapus');
            window.location.href = '../model/user/pesanan.php';
          </script>";
} else {
    echo "Error: " . $stmt->error;
}

// Menutup statement dan koneksi
$stmt->close();
$conn->close();
