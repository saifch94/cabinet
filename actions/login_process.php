<?php
include('../includes/db.php');
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM Patient WHERE Nomp='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();

        // Check the password
        if (password_verify($password, $row['password'])) {
            $_SESSION['username'] = $username;
            $_SESSION['role'] = $row['roleP'];

            if ($_SESSION['role'] === 'ADMIN') {
                header("Location: ../pages/admin_panel.php");
                exit();
            } elseif ($_SESSION['role'] === 'PATIENT') {
                header("Location: ../pages/dashboard.php");
                exit();
            }
        } else {
            echo "Login failed. Incorrect password.";
        }
    } else {
        echo "Login failed. User not found.";
    }
}

$conn->close();
?>
