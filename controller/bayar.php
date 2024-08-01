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

// Mulai transaksi
$conn->begin_transaction();

try {
    // Mengambil data dari test_wisata
    $sql = "SELECT *
            FROM test_wisata 
            WHERE id_transaksi = $id_transaksi AND id_users = $id_user";
    $result = $conn->query($sql);
    
    if ($result->num_rows === 0) {
        throw new Exception('Data tidak ditemukan');
    }
    
    $data = $result->fetch_assoc();

    // Debugging: tampilkan data yang diambil
    echo "<pre>";
    print_r($data);
    echo "</pre>";

    // Menyimpan data ke tabel tiket_wisata
    $sql_insert = "INSERT INTO tiket_wisata (id_transaksi,id_wisata, id_users, pelayanan, hari, peserta, total_pembayaran, tanggal_pemesanan) 
                   VALUES ('{$data['id_transaksi']}','{$data['id_wisata']}', '$id_user', '{$data['pelayanan']}', '{$data['hari']}', '{$data['peserta']}', '{$data['total_pembayaran']}', '{$data['tanggal_pemesanan']}')";
    if (!$conn->query($sql_insert)) {
        throw new Exception('Gagal menyimpan data ke tiket_wisata: ' . $conn->error);
    }

    // Menghapus data dari test_wisata
    $sql_delete = "DELETE FROM test_wisata WHERE id_transaksi = $id_transaksi AND id_users = $id_user";
    if (!$conn->query($sql_delete)) {
        throw new Exception('Gagal menghapus data dari test_wisata: ' . $conn->error);
    }

    // Commit transaksi
    $conn->commit();

    echo "<script>
            alert('Pesanan berhasil dihapus dan data telah disimpan ke tiket_wisata');
            window.location.href = '../model/user/pesanan.php';
          </script>";
} catch (Exception $e) {
    // Rollback transaksi jika terjadi kesalahan
    $conn->rollback();
    echo "Error: " . $e->getMessage();
}

// Menutup koneksi
$conn->close();
?>
