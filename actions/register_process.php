<?php
include('../includes/db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Nomp = $_POST['Nomp'];
    $prénomP = $_POST['prénomP'];
    $NumTel = $_POST['NumTel'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    // Hash the password before storing it
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO Patient (Nomp, prénomP, NumTel, password, roleP) VALUES ('$Nomp', '$prénomP', '$NumTel', '$hashed_password', '$role')";

    if ($conn->query($sql) === TRUE) {
        header("Location: ../pages/login.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
