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

include '../../../controller/koneksi.php';

if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $sql = "SELECT * FROM tbl_user WHERE id = $id";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $nama = $row["nama"];
    $email = $row["email"];
    $password = "";
  } else {
    header("Location: user.php");
    exit();
  }
} else {
  header("Location: user.php");
  exit();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    .update-form {
      max-width: 600px;
      margin: 50px auto;
      padding: 20px;
      border: 1px solid #ccc;
      border-radius: 5px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .update-form button {
      margin-right: 10px;
    }

    .update-form button:hover {
      background-color: #28a745;
      color: #fff;
    }
  </style>
  <title>Update User</title>
</head>

<body>
  <div class="container">
    <?php if (isset($_GET['status']) && $_GET['status'] == 'success'): ?>
      <div class="alert alert-success" role="alert">
        User successfully updated!
      </div>
    <?php endif; ?>
    <?php if (isset($_GET['status']) && $_GET['status'] == 'error'): ?>
      <div class="alert alert-danger" role="alert">
        There was an error updating the user.
      </div>
    <?php endif; ?>
    <div class="update-form">
      <h2 class="mb-4">Update User</h2>
      <form action="../../../controller/process_update_user.php" method="POST">
        <input type="hidden" name="id" value="<?= $id ?>">
        <div class="mb-3">
          <label for="nama" class="form-label">Nama</label>
          <input type="text" class="form-control" id="nama" name="nama" value="<?= $nama ?>" required>
        </div>
        <div class="mb-3">
          <label for="email" class="form-label">Email</label>
          <input type="email" class="form-control" id="email" name="email" value="<?= $email ?>" required>
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">Password</label>
          <input type="password" class="form-control" id="password" name="password" placeholder="Kosongkan Jika tidak ingin di Ubah">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
        <a href="../user.php" class="btn btn-secondary">Cancel</a>
      </form>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>
