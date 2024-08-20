<?php
session_start();
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT username FROM admin WHERE username='$username' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Admin login successful
        $_SESSION['user_id'] = 'admin';
        echo "<script>
            alert('Selamat Datang Admin');
            window.location.href = '../model/admin/index.php';
          </script>";
          exit();
    } else {
        echo "<script>
            alert('Username atau Password Salah !');
            window.location.href = '../model/admin/form/loginadmin.php';
          </script>";
    exit();
    }
}

$conn->close();
