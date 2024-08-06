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

  $sql1 = "SELECT COUNT(email) AS email FROM tbl_user WHERE id = $id";
  $sql2 = "SELECT COUNT(email) AS email FROM tbl_user WHERE email = '$email' AND id != $id";
  $result1 = $conn->query($sql1);
  $result2 = $conn->query($sql2);
  $row1 = $result1->fetch_assoc();
  $row2 = $result2->fetch_assoc();
  if ($row1['email'] == 1 && $row2['email'] == 0 && !empty($password)) {
    $passwordHash = md5($password); 
    $sql = "UPDATE tbl_user SET nama='$nama', email='$email', password='$passwordHash' WHERE id=$id";
  } else if ($row1['email'] == 1 && $row2['email'] == 0){
    $sql = "UPDATE tbl_user SET nama='$nama', email='$email' WHERE id=$id";
  } else {
    echo "<script>
            alert('Update gagal. Email Sudah terpakai !');
            window.location.href = '../model/admin/user.php';
          </script>";
    exit();
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
