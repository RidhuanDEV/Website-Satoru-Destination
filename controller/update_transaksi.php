<?php
include 'koneksi.php';
session_start();
// Mengambil data dari form
$id_wisata = $_POST['id_wisata'];
$id_transaksi = $_POST['id_transaksi'];
$pelayanan = $_POST['pelayanan'];
$hari = $_POST['hari'];
$peserta = $_POST['peserta'];
$id_user = $_SESSION['user_id'];

// Validasi data input
if(empty($id_wisata) || empty($id_transaksi) || empty($pelayanan) || empty($hari) || empty($peserta)) {
    echo "<script>
            alert('Semua data harus diisi!');
            window.history.back();
          </script>";
    exit();
}

// Mengambil harga tiket dari database
$sql = "SELECT harga FROM product WHERE id_wisata = $id_wisata";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $harga_tiket = $row['harga'];

    // Menghitung total pembayaran
    $total_pembayaran = $harga_tiket * $hari * $peserta;

    // Menyimpan data ke tabel test_wisata
    $sql = "UPDATE test_wisata 
            SET pelayanan='$pelayanan', hari='$hari', peserta='$peserta', total_pembayaran='$total_pembayaran'
            WHERE id_transaksi='$id_transaksi' AND id_users='$id_user'";
    $result = $conn->query($sql);
    if ($result === TRUE) {
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
