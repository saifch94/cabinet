<?php
session_start();

if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'ADMIN') {
    header("Location: ../pages/login.php");
    exit();
}

include('../includes/db.php');

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['sessionId'])) {
    $sessionId = $_GET['sessionId'];

    // Perform deletion
    $deleteSql = "DELETE FROM Séance WHERE IdS=$sessionId";

    if ($conn->query($deleteSql) === TRUE) {
        header("Location: ../pages/admin_panel.php");
        exit();
    } else {
        echo "Error deleting record: " . $conn->error;
    }
} else {
    echo "Invalid request.";
}

?>
