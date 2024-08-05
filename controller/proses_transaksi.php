<?php
include 'koneksi.php';
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: ../model/user/form/login.php");
    exit();
}

// Mengambil data dari form dan menyanitasi input
$id_wisata = isset($_POST['id_wisata']) ? $conn->real_escape_string($_POST['id_wisata']) : '';
$pelayanan = isset($_POST['pelayanan']) ? $conn->real_escape_string($_POST['pelayanan']) : '';
$hari = isset($_POST['hari']) ? (int)$_POST['hari'] : 0;
$peserta = isset($_POST['peserta']) ? (int)$_POST['peserta'] : 0;
$id_user = isset($_SESSION['user_id']) ? (int)$_SESSION['user_id'] : 0;

// Validasi input tidak boleh nilai minus atau nol
if ($hari <= 0 || $peserta <= 0) {
    echo "Jumlah hari dan peserta harus lebih dari 0.";
    exit();
}

// Mengambil harga tiket dan diskon dari database
$sql = "SELECT tbl_wisata.diskon, product.harga
        FROM tbl_wisata 
        JOIN product ON tbl_wisata.id = product.id_wisata 
        WHERE tbl_wisata.id = '$id_wisata'";
$result = $conn->query($sql);

if ($result === FALSE) {
    echo "Error: " . $conn->error;
    exit();
}

if ($result->num_rows == 0) {
    echo "Data wisata tidak ditemukan.";
    exit();
}

$row = $result->fetch_assoc();
$harga_tiket = $row['harga'];
$diskon = $row['diskon'];

// Menghitung harga setelah diskon jika ada diskon
if ($diskon === 'true') {
    $harga_tiket = $harga_tiket * 0.8;
}

// Menambahkan faktor multiplier untuk pelayanan VIP
if ($pelayanan === 'VIP') {
    $harga_tiket *= 1.5;
}

// Menghitung total pembayaran
$total_pembayaran = $harga_tiket * $hari * $peserta;

// Menyimpan data ke tabel test_wisata
$sql = "INSERT INTO test_wisata (id_wisata, id_users, pelayanan, hari, peserta, total_pembayaran) 
        VALUES ('$id_wisata', '$id_user', '$pelayanan', '$hari', '$peserta', '$total_pembayaran')";

if ($conn->query($sql) === TRUE) {
    echo "<script>
                alert('Transaksi berhasil!');
                window.location.href = '../model/user/pesanan.php';
              </script>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Menutup koneksi
$conn->close();
