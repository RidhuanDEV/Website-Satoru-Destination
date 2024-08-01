<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
      body {
        background-color: #121212;
        color: white;
      }
      .form-control {
        background-color: #1f1f1f;
        color: white;
      }
      .btn-primary {
        background-color: #6200ea;
        border-color: #6200ea;
      }
      .btn-primary:hover {
        background-color: #3700b3;
        border-color: #3700b3;
      }
      .login-container {
        width: 500px;
        height: 500px;
        margin: 100px auto;
        padding: 20px;
        background-color: #333;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
      }
    </style>
  </head>
  <body>
    <div class="container login-container mt-5">
      <h1 class="text-center">Admin Login</h1>
      <form action="../../../controller/loginadmin_process.php" method="POST">
        <div class="mb-3">
          <label for="username" class="form-label">Username</label>
          <input type="text" class="form-control" id="username" name="username" required>
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">Password</label>
          <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <button type="submit" class="btn btn-primary">Login</button>
      </form>
      <div class="mt-3">
          <a href="../../user/form/login.php" style="color: #ffffff;">Login as User</a>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
