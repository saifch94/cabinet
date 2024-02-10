<?php
include 'db_connection.php';
// If the form is submitted
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM Patient WHERE uname='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();

        // Check the password
        if (password_verify($password, $row['pwd'])) {
            $_SESSION['username'] = $username;
            $_SESSION['role'] = $row['roleP'];

            if ($_SESSION['role'] === 'ADMIN') {
                header("Location: ./superadmin.php");
                exit();
            } elseif ($_SESSION['role'] === 'PATIENT') {
                header("Location: ./patient_dashboard.php");
                exit();
            }
        } else {
          $_SESSION['login_error'] = 'Invalid password.';
          echo "Login failed. Incorrect password.";
        }
    } else {
      $_SESSION['login_error'] = 'User not found.';
      echo "Login failed. User not found.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <div class="container">
    <div class="row justify-content-center mt-5">
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">Login</div>
          <div class="card-body">
            <?php if (isset($_SESSION['login_error'])): ?>
              <div class="alert alert-danger"><?php echo $_SESSION['login_error']; ?></div>
              <?php unset($_SESSION['login_error']); ?>
            <?php endif; ?>
            <form action="login.php" method="post">
              <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" name="username" class="form-control">
              </div>
              <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" name="password" class="form-control">
              </div>
              <button type="submit" class="btn btn-primary">Login</button>
            </form>
          </div>
          <div class="card-footer">
            <small>Don't have an account? <a href="register.php">Register</a></small>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
