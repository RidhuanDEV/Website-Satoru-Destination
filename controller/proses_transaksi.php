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
$hari = isset($_POST['hari']) ? (int)$_POST['hari'] : 0;
$peserta = isset($_POST['peserta']) ? (int)$_POST['peserta'] : 0;
$id_user = isset($_SESSION['user_id']) ? (int)$_SESSION['user_id'] : 0;

// Mengambil nilai pelayanan tambahan
$penginapan = isset($_POST['penginapan']) ? (float)$_POST['penginapan'] : 0;
$penerbangan = isset($_POST['penerbangan']) ? (float)$_POST['penerbangan'] : 0;
$makanMinum = isset($_POST['makan_minum']) ? (float)$_POST['makan_minum'] : 0;

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

// Menghitung total pembayaran tanpa pelayanan tambahan
$total_pembayaran = $harga_tiket * $hari * $peserta;

// Menambahkan biaya pelayanan tambahan
$total_pembayaran += ($penginapan + $penerbangan + $makanMinum) * $hari * $peserta;

// Menyiapkan string untuk kolom pelayanan
$pelayanan = [];
if ($penginapan > 0) {
    $pelayanan[] = "Penginapan";
}
if ($penerbangan > 0) {
    $pelayanan[] = "Penerbangan";
}
if ($makanMinum > 0) {
    $pelayanan[] = "Makan dan Minum";
}

// Menggabungkan pelayanan menjadi string
$pelayanan_str = implode(", ", $pelayanan);

// Menyimpan data ke tabel test_wisata
$sql = "INSERT INTO test_wisata (id_wisata, id_users, hari, peserta, total_pembayaran, pelayanan) 
        VALUES ('$id_wisata', '$id_user', '$hari', '$peserta', '$total_pembayaran', '$pelayanan_str')";

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
?>
