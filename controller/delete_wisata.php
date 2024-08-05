<?php
include 'koneksi.php';
$id = $_GET['id'];
// Periksa apakah ada data terkait di tabel test_wisata
$sql_check = "SELECT COUNT(*) AS count FROM test_wisata WHERE id_wisata=$id";
$result_check = $conn->query($sql_check);
$row_check = $result_check->fetch_assoc();

if ($row_check['count'] > 0) {
    echo "<script>
        alert('Ada pelanggan yang sedang memesan tiket wisata ini. Tidak dapat menghapus data.');
        window.location.href = '../model/admin/product.php';
    </script>";
} else {
    // Ambil path foto dari database
    $sql = "SELECT foto FROM tbl_wisata WHERE id=$id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $foto_path = '../view/produk/' . $row['foto'];

        // Hapus entri dari tabel product terlebih dahulu
        $sql_product = "DELETE FROM product WHERE id_wisata=$id";
        if ($conn->query($sql_product) === TRUE) {
            // Hapus entri dari tabel tbl_wisata
            $sql_wisata = "DELETE FROM tbl_wisata WHERE id=$id";
            if ($conn->query($sql_wisata) === TRUE) {
                // Hapus file foto dari direktori
                if (file_exists($foto_path)) {
                    unlink($foto_path);
                }
                echo "<script>
                    alert('Data Berhasil dihapus !.');
                    window.location.href = '../model/admin/product.php';
                </script>";
            } else {
                echo "Error: " . $sql_wisata . "<br>" . $conn->error;
            }
        } else {
            echo "Error: " . $sql_product . "<br>" . $conn->error;
        }
    } else {
        echo "No record found";
    }
}

$conn->close();
