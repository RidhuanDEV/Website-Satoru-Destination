<?php
session_start();

if (!isset($_SESSION['user_id'])) {
  header("Location: ../user/form/login.php");
  exit();
}

if ($_SESSION['user_id'] != 'admin') {
  header("Location: ../../index.php");
  exit();
}

include 'koneksi.php';

if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $sql_DeleteUser = "DELETE FROM tbl_user WHERE id=$id";
  $sql_deletePesanan = "DELETE FROM test_wisata WHERE id_users=$id";
  $sql_deleteTiket = "DELETE FROM tiket_wisata WHERE id_users=$id";

  if ($conn->query($sql_deletePesanan) && $conn->query($sql_deleteTiket) && $conn->query($sql_DeleteUser) === TRUE) {
    echo "<script>
            alert('User Berhasil di Hapus !');
            window.location.href = '../model/admin/user.php';
          </script>";
          exit();
  } else {
    echo "<script>
            alert('Error Data User Tidak Terhapus!');
            window.location.href = '../model/admin/user.php';
          </script>";
    exit();
  }
} else {
  header("Location: user.php");
  exit();
}

$conn->close();
?>
