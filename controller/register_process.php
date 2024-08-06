<?php
// Database connection
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = md5($_POST['password']);

    // Check if email already exists
    $checkEmailSql = "SELECT * FROM tbl_user WHERE email='$email'";
    $result = $conn->query($checkEmailSql);

    if ($result->num_rows > 0) {
        // Email already exists
        echo "<script>
        alert('Email sudah terpakai, gunakan email lain.');
        window.location.href = '../model/user/form/register.php';
        </script>";
    } else {
        // Email does not exist, proceed with registration
        $sql = "INSERT INTO tbl_user (nama, email, password) VALUES ('$name', '$email', '$password')";

        if ($conn->query($sql) === TRUE) {
            session_start();
            if (!isset($_SESSION['user_id'])) {
                echo "<script>
                    alert('Daftar Akun Berhasil silahkan Login.');
                    window.location.href = '../model/user/form/login.php';
                    </script>";
            } else if (isset($_SESSION['user_id'])) {
                echo "<script>
                    alert('Daftar Akun Berhasil.');
                    window.location.href = '../model/admin/user.php';
                    </script>";
            }
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

$conn->close();
?>
