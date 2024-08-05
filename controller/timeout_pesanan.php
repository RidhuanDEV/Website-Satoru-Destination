<?php
include 'koneksi.php';

if (isset($_GET['id'])) {
    $id_transaksi = $_GET['id'];

    // Menghapus tiket berdasarkan id_transaksi
    $sql = "DELETE FROM tiket_wisata WHERE id_transaksi = '$id_transaksi'";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Tiket telah dihapus.'); window.location.href='../model/admin/tiket.php';</script>";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}

$conn->close();
