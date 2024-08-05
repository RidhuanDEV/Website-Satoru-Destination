<?php
include 'koneksi.php';
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: ../model/user/form/login.php");
    exit();
}

// Mengambil data dari form
$id_transaksi = $_POST['id_transaksi'];
$id_wisata = isset($_POST['id_wisata']) ? $conn->real_escape_string($_POST['id_wisata']) : '';
$pelayanan = isset($_POST['pelayanan']) ? $conn->real_escape_string($_POST['pelayanan']) : '';
$hari = isset($_POST['hari']) ? (int)$_POST['hari'] : 0;
$peserta = isset($_POST['peserta']) ? (int)$_POST['peserta'] : 0;
$id_user = isset($_SESSION['user_id']) ? (int)$_SESSION['user_id'] : 0;
// Validasi data input
if (empty($id_wisata) || empty($id_transaksi) || empty($pelayanan) || empty($hari) || empty($peserta)) {
    echo "<script>
            alert('Semua data harus diisi!');
            window.history.back();
          </script>";
    exit();
}

// Validasi input tidak boleh nilai minus atau nol
if ($hari <= 0 || $peserta <= 0) {
    echo "<script>
            alert('Jumlah hari dan peserta harus lebih dari 0.');
            window.history.back();
          </script>";
    exit();
}

// Mengambil harga tiket dan diskon dari database
$sql = "SELECT tbl_wisata.diskon, product.harga 
              FROM tbl_wisata 
              JOIN product ON tbl_wisata.id = product.id_wisata
              WHERE tbl_wisata.id = '$id_wisata'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
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
    $sql = "UPDATE test_wisata 
            SET pelayanan='$pelayanan', hari='$hari', peserta='$peserta', total_pembayaran='$total_pembayaran', tanggal_pemesanan = NOW()
            WHERE id_transaksi='$id_transaksi' AND id_users='$id_user'";
    if ($conn->query($sql) === TRUE) {
        echo "<script>
                alert('Update berhasil!');
                window.location.href = '../model/user/pesanan.php';
              </script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    echo "<script>
            alert('Data produk tidak ditemukan!');
            window.history.back();
          </script>";
}

// Menutup koneksi
$conn->close();
?>
