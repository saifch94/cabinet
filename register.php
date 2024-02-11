<?php
include 'db_connection.php';
session_start();

// If the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate form inputs
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $numTel = $_POST['numTel'];

    // Validate if all fields are not empty
    if (empty($firstname) || empty($lastname) || empty($username) || empty($password) || empty($numTel)) {
        $_SESSION['register_error'] = 'All fields are required.';
        header("Location: register.php");
        exit;
    }

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Check if the username already exists
    $sql_check_username = "SELECT * FROM Patient WHERE uname = '$username'";
    $result = $conn->query($sql_check_username);

    if ($result->num_rows > 0) {
        $_SESSION['register_error'] = 'Username already exists. Please choose a different one.';
        header("Location: register.php");
        exit;
    }

    // Insert the new user into the database
    $sql_insert_user = "INSERT INTO Patient (firstname, lastname, uname, pwd, numTel) VALUES ('$firstname', '$lastname', '$username', '$hashed_password', '$numTel')";
    if ($conn->query($sql_insert_user) === TRUE) {
        $_SESSION['register_success'] = 'Registration successful. You can now login.';
        header("Location: login.php");
        exit;
    } else {
        $_SESSION['register_error'] = 'Registration failed. Please try again later.';
        header("Location: register.php");
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register</title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <div class="container">
    <div class="row justify-content-center mt-5">
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">Register</div>
          <div class="card-body">
            <?php if (isset($_SESSION['register_error'])): ?>
              <div class="alert alert-danger"><?php echo $_SESSION['register_error']; ?></div>
              <?php unset($_SESSION['register_error']); ?>
            <?php endif; ?>
            <?php if (isset($_SESSION['register_success'])): ?>
              <div class="alert alert-success"><?php echo $_SESSION['register_success']; ?></div>
              <?php unset($_SESSION['register_success']); ?>
            <?php endif; ?>
            <form action="register.php" method="post">
              <div class="form-group">
                <label for="firstname">Firstname:</label>
                <input type="text" name="firstname" class="form-control">
              </div>
              <div class="form-group">
                <label for="lastname">Lastname:</label>
                <input type="text" name="lastname" class="form-control">
              </div>
              <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" name="username" class="form-control">
              </div>
              <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" name="password" class="form-control">
              </div>
              <div class="form-group">
                <label for="numTel">Phone Number:</label>
                <input type="text" name="numTel" class="form-control">
              </div>
              <button type="submit" class="btn btn-primary">Register</button>
            </form>
          </div>
          <div class="card-footer">
            <small>Already have an account? <a href="login.php">Login</a></small>
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
