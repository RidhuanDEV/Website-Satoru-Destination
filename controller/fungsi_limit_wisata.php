<?php
function fetch_wisata($order) {
    include 'koneksi.php';

    $sql = "
        (SELECT tbl_wisata.foto, tbl_wisata.id, tbl_wisata.nama, tbl_wisata.deskripsi, tbl_wisata.diskon, product.harga
        FROM tbl_wisata
        JOIN product ON tbl_wisata.id = product.id_wisata
        ORDER BY tbl_wisata.id $order
        LIMIT 3)
    ";

    $result = $conn->query($sql);
    
    $wisata = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $wisata[] = $row;
        }
    }

    $conn->close();
    return $wisata;
}
?>
