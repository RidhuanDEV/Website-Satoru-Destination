<?php
include 'koneksi.php';

if (isset($_GET['id'])) {
    $id_transaksi = $_GET['id'];

    // Mengupdate status tiket_wisata menjadi 'done'
    $sql = "UPDATE tiket_wisata SET status = 'done' WHERE id_transaksi = '$id_transaksi'";

    if ($conn->query($sql) === TRUE) {
        echo "<script>
        alert('Pesanan telah disetujui.'); 
        window.location.href='../model/admin/pemesanan_tiket.php';
        </script>";
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

$conn->close();
?>
