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

if (isset($_POST['id']) && isset($_POST['nama']) && isset($_POST['email'])) {
  $id = $_POST['id'];
  $nama = $_POST['nama'];
  $email = $_POST['email'];
  $password = isset($_POST['password']) ? $_POST['password'] : "default";

  if (!empty($password)) {
    $passwordHash = md5($password); 
    $sql = "UPDATE tbl_user SET nama='$nama', email='$email', password='$passwordHash' WHERE id=$id";
  } else {
    $sql = "UPDATE tbl_user SET nama='$nama', email='$email' WHERE id=$id";
  }

  if ($conn->query($sql) === TRUE) {
    echo "<script>
            alert('User Berhasil di Update !');
            window.location.href = '../model/admin/user.php';
          </script>";
    exit();
  } else {
    echo "<script>
            alert('Error Data User tidak bisa di Update !');
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
