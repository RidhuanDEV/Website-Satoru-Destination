<?php
include 'koneksi.php';

if (isset($_GET['id'])) {
    $id_transaksi = $_GET['id'];

    // Mengupdate status tiket_wisata menjadi 'rejected'
    $sql = "UPDATE tiket_wisata SET status = 'Di Tolak' WHERE id_transaksi = '$id_transaksi'";  

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Pesanan telah ditolak.'); window.location.href='../model/admin/pemesanan_tiket.php';</script>";
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

$conn->close();
?>
