// update_wisata.php
<?php
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_wisata = $_POST['id_wisata'];
    $nama = $_POST['nama_wisata'];
    $deskripsi = $_POST['deskripsi'];
    $harga = $_POST['harga'];
    $diskon = $_POST['diskon'] === 'true' ? 1 : 0;

    $target_dir = "../view/produk/";
    $target_file = $target_dir . basename($_FILES["foto"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    
    $sql = "SELECT foto FROM tbl_wisata WHERE id=$id_wisata";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    $check = getimagesize($_FILES["foto"]["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        echo "File bukan gambar.";
        $uploadOk = 0;
    }

    if (basename($_FILES["foto"]["name"]) != $row['foto'] && file_exists($target_file)) {
        echo "Maaf, file sudah ada.";
        $uploadOk = 0;
    }

    if ($_FILES["foto"]["size"] > 500000) {
        echo "Maaf, file terlalu besar.";
        $uploadOk = 0;
    }

    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        echo "Maaf, hanya format JPG, JPEG, PNG & GIF yang diperbolehkan.";
        $uploadOk = 0;
    }

    if ($uploadOk == 0) {
        echo "Maaf, file Anda tidak terunggah.";
    } else {
        if (move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file)) {
            $sql = "UPDATE tbl_wisata SET nama='$nama', deskripsi='$deskripsi', foto='".basename($_FILES["foto"]["name"])."', diskon=$diskon WHERE id=$id_wisata";

            if ($conn->query($sql) === TRUE) {
                $sql_product = "UPDATE product SET harga=$harga WHERE id_wisata=$id_wisata";
                if ($conn->query($sql_product) === TRUE) {
                    header("Location: ../model/admin/product.php");
                } else {
                    echo "Error: " . $sql_product . "<br>" . $conn->error;
                }
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            echo "Maaf, terjadi kesalahan saat mengunggah file.";
        }
    }
    
}

$conn->close();
?>