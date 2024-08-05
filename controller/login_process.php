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
        header("Location: ../index.php");
    } else {
        echo "Invalid email or password";
    }
}

$conn->close();
