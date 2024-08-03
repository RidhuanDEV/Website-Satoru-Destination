<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "wisata";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

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
            echo "Registration successful";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

$conn->close();
?>
