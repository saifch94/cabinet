<?php
session_start();

// If no session exists, check if there is an admin patient, if not, create one
include 'db_connection.php';

$sql_check_admin = "SELECT * FROM Patient WHERE roleP = 'ADMIN' LIMIT 1";
$result_check_admin = $conn->query($sql_check_admin);

if ($result_check_admin->num_rows === 0) {
    // No admin patient found, create one
    $hashed_password = password_hash("admin123", PASSWORD_DEFAULT);
    $sql_insert_admin = "INSERT INTO Patient (firstname, lastname, uname, pwd, numTel, roleP) VALUES ('admin', 'admin', 'admin', '$hashed_password', '123456789', 'ADMIN')";
    $conn->query($sql_insert_admin);
}

// Redirect to login page
header("Location: login.php");
exit;
?>
