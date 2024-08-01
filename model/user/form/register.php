<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register</title>
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
      <h1 class="text-center">Register</h1>
      <form id="registerForm" action="../../../controller/register_process.php" method="POST">
        <div class="mb-3">
          <label for="name" class="form-label">Name</label>
          <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="mb-3">
          <label for="email" class="form-label">Email address</label>
          <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">Password</label>
          <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <div class="mb-3 form-check">
          <input type="checkbox" class="form-check-input" id="showPassword">
          <label class="form-check-label" for="showPassword">Show Password</label>
        </div>
        <button type="submit" class="btn btn-primary">Register</button>
      </form>
      <div class="mt-3">
        <a href="login.php" style="color: #ffffff;">Kembali</a>
      </div>
    </div>
    <script>
      document.getElementById('registerForm').addEventListener('submit', function(event) {
        const email = document.getElementById('email').value;
        const password = document.getElementById('password').value;
        const emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
        const passwordPattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/;

        if (!emailPattern.test(email)) {
          alert('Please enter a valid email address.');
          event.preventDefault();
        }

        if (!passwordPattern.test(password)) {
          alert('Password must contain at least 8 digits, one uppercase letter, one lowercase letter, and one number.');
          event.preventDefault();
        }
      });
      document.getElementById('showPassword').addEventListener('change', function() {
        const passwordField = document.getElementById('password');
        if (this.checked) {
          passwordField.type = 'text';
        } else {
          passwordField.type = 'password';
        }
      });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
