<?php
require 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $email = $_POST["email"];

    // Cek apakah username sudah terdaftar
    $cek_username = mysqli_query($conn, "SELECT * FROM tb_user WHERE username = '$username'");

    if (mysqli_num_rows($cek_username) > 0) {
        $status = "Username telah digunakan. Silakan pilih username lain.";
    } else {
        $query_sql = "INSERT INTO tb_user (username, password, email) VALUES ('$username', '$password', '$email')";

        if (mysqli_query($conn, $query_sql)) {
            header("Location: login.php"); // Redirect ke halaman login jika pendaftaran berhasil
            exit();
        } else {
            $status = "Pendaftaran Gagal: " . mysqli_error($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Registration Form</title>
    <link rel="stylesheet" type="text/css" href="css register.css" />
  </head>
  <body>
    <div class="background"></div>
    <div class="registration-container">
      <h2>Registration Form</h2>
      <form method="post" action="register.php">

        <div class="form-group">
          <label for="username">Username:</label>
          <input type="text" id="username" name="username" required autocomplete="off"/>
          <?php if(isset($status)): ?>
            <p class="error-message"><?php echo $status; ?></p>
          <?php endif; ?>
        </div>

        <div class="form-group">
          <label for="password">Password:</label>
          <input type="password" id="password" name="password" required autocomplete="off"/>
        </div>

        <div class="form-group" id="email">
          <label for="email" id="iemail">Email:</label>
          <input type="email" id="email" name="email" required autocomplete="off"/>
        </div>

        <div class="form-group">
        <button type="submit" name="Register" class="register">
          Register
        </button>

        </div>
      </form>

      <div class="form-group">
        <p class="login-link">
          Sudah Punya Akun? <a href="login.php">Log in</a>
        </p>
      </div>
    </div>

    <!-- JavaScript untuk menghilangkan pesan kesalahan setelah 5 detik -->
    <script>
      setTimeout(function () {
        var errorDiv = document.querySelector('.error-message');
        if (errorDiv) {
          errorDiv.style.display = 'none';
        }
      }, 2500);
    </script>
  </body>
</html>
