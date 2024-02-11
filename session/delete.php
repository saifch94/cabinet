<?php
include '../db_connection.php';
session_start();

if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'ADMIN') {
    header("Location: ../login.php");
    exit();
}

$id = $_GET['id'];

$sql = "DELETE FROM Séance WHERE IdS = $id";

if ($conn->query($sql) === TRUE) {
    header("Location: ../superadmin.php");
    exit();
} else {
    echo "Error deleting record: " . $conn->error;
}
?>
