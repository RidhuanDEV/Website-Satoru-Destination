<?php
  include("../../../controller/koneksi.php");

  $id = $_GET['id'];
  $sql = "SELECT tbl_wisata.*, product.harga FROM tbl_wisata JOIN product ON tbl_wisata.id = product.id_wisata WHERE tbl_wisata.id=$id";
  $result = $conn->query($sql);
  $row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <title>Update Wisata</title>
</head>
<body>
  <div class="container mt-5">
    <h2>Update Data Wisata</h2>
    <form action="../../../controller/update_wisata.php" method="post" enctype="multipart/form-data">
      <input type="hidden" name="id_wisata" value="<?php echo $row['id']; ?>">
      <div class="mb-3">
        <label for="nama_wisata" class="form-label">Nama Wisata</label>
        <input type="text" class="form-control" id="nama_wisata" name="nama_wisata" value="<?php echo $row['nama']; ?>" required>
      </div>
      <div class="mb-3">
        <label for="deskripsi" class="form-label">Deskripsi</label>
        <textarea class="form-control" id="deskripsi" name="deskripsi" required><?php echo $row['deskripsi']; ?></textarea>
      </div>
      <div class="mb-3">
        <label for="foto" class="form-label">Foto</label>
        <input type="file" class="form-control" id="foto" name="foto" required>
      </div>
      <div class="mb-3">
        <label for="harga" class="form-label">Harga</label>
        <input type="number" class="form-control" id="harga" name="harga" value="<?php echo $row['harga']; ?>" required>
      </div>
      <div class="mb-3">
        <label for="diskon" class="form-label">Diskon</label>
        <select class="form-control" id="diskon" name="diskon" required>
          <option value="true" <?php echo $row['diskon'] ? 'selected' : ''; ?>>Ya</option>
          <option value="false" <?php echo !$row['diskon'] ? 'selected' : ''; ?>>Tidak</option>
        </select>
      </div>
      <button type="submit" class="btn btn-primary">Update</button>
    </form>
  </div>
  <?php $conn->close();?>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
