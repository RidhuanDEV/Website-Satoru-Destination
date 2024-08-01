<?php
include 'koneksi.php';
session_start();
// Mengambil data dari form
$id_wisata = $_POST['id_wisata'];
$pelayanan = $_POST['pelayanan'];
$hari = $_POST['hari'];
$peserta = $_POST['peserta'];
$id_user = $_SESSION['user_id'];

// Mengambil harga tiket dari database
$sql = "SELECT harga FROM product WHERE id_wisata = $id_wisata";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$harga_tiket = $row['harga'];

// Menghitung total pembayaran
$total_pembayaran = $harga_tiket * $hari * $peserta;

// Menyimpan data ke tabel format_wisata
$sql = "INSERT INTO test_wisata (id_wisata, id_users, pelayanan, hari, peserta, total_pembayaran) VALUES ('$id_wisata', '$id_user', '$pelayanan', '$hari', '$peserta', '$total_pembayaran')";

if ($conn->query($sql) === TRUE) {
    echo "Pemesanan berhasil!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Menutup koneksi
$conn->close();
?>
