<?php
session_start();
include 'koneksi.php';

// Ambil data dari form
$nama_baru = $_POST['nama'];
$password_lama = md5($_POST['password_lama']);
$password_baru = md5($_POST['password_baru']);
$konfirmasi_password = md5($_POST['konfirmasi_password']);

// Query untuk memeriksa password lama pengguna
$id_pengguna = 1; // Ganti dengan id pengguna yang sedang login
$sql = "SELECT password FROM tbl_user WHERE id = $id_pengguna";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();
  $password_db = $row['password'];

  if ($password_lama === $password_db && $password_baru === $konfirmasi_password) {
    // Password lama cocok, update password baru dan nama
    $sql_update = "UPDATE tbl_user SET password = '$password_baru', nama = '$nama_baru' WHERE id = $id_pengguna";
    if ($conn->query($sql_update) === TRUE) {
      echo "<script>
            alert('Update Berhasil !');
            window.location.href = '../model/user/account.php';
          </script>";
    } else {
      echo "Error: " . $sql_update . "<br>" . $conn->error;
    }
  } else {
    echo "Password lama tidak cocok atau password baru tidak sesuai dengan konfirmasi.";
  }
} else {
  echo "Data pengguna tidak ditemukan.";
}

$conn->close();
