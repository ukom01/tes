<?php
require 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["username"]) && isset($_POST["password"])) {
        $username = $_POST["username"];
        $password = $_POST["password"];

        $query_sql = "SELECT * FROM tb_user
            WHERE username = '$username' AND password ='$password'";

        $result = mysqli_query($conn, $query_sql);

        if (mysqli_num_rows($result) > 0) {
            header("Location: dashboard.html");
            exit();
        } else {
            $errorMessage = "Username atau password Anda salah. Silakan coba login kembali.";
        }
    }
}

// Tambahkan header "Cache-Control" di sini
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
?>



<!DOCTYPE html>
<html>
  <head>
    <title>Login Form</title>
    <link rel="stylesheet" type="text/css" href="css login.css" />
  </head>
  <body>
    <div class="background"></div>
    <div class="login-container">
      <h2>Login Form</h2>
      <form action="Login.php" method="POST">
        <div class="form-group">
          <label for="username">Username:</label>
          <input type="text" id="username" name="username" required autocomplete="off"/>
        </div>

        <div class="form-group">
          <label for="password">Password:</label>
          <input type="password" id="password" name="password" required autocomplete="off"/>
        </div>

        <div class="form-group">
          <button type="submit" name="Login" class="login-button">
            Login
          </button>
        </div>

        <!-- Notifikasi kesalahan -->
        <?php if(isset($errorMessage)): ?>
          <p class="error-message"><?php echo $errorMessage; ?></p>
        <?php endif; ?>
      </form>

      <div class="form-group">
        <p class="forgot-password">
          Belum Punya Akun? <a href="register.php">Register</a>
        </p>
      </div>
    </div>

    <!-- JavaScript untuk menghilangkan pesan kesalahan setelah 5 detik -->
    <script>
      setTimeout(function () {
        var errorMessage = document.querySelector('.error-message');
        if (errorMessage) {
          errorMessage.style.display = 'none';
        }
      }, 2000);
    </script>
  </body>
</html>
