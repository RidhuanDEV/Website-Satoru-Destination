<?php
session_start();
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = md5($_POST['password']);

    $sql = "SELECT id FROM tbl_user WHERE email='$email' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Login successful
        $row = $result->fetch_assoc();
        $_SESSION['user_id'] = $row['id'];
        echo "<script>
            alert('Selamat Datang di SATORU Destination');
            window.location.href = '../index.php';
          </script>";
          exit();
    } else {
        echo "<script>
            alert('Username atau Password Salah !');
            window.location.href = '../model/user/form/login.php';
          </script>";
    exit();
    }
}

$conn->close();
