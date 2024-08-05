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
        header("Location: ../model/admin/index.php");
    } else {
        echo "Invalid username or password";
    }
}

$conn->close();
