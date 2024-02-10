<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
include 'db_connection.php';

// Fetch sessions for the patient
$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM sessions WHERE patient_id = $user_id";
$result = $conn->query($sql);

// Display sessions
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "Session Date: " . $row["session_date"]. " - Kiné Name: " . $row["kine_name"]. "<br>";
    }
} else {
    echo "No sessions found.";
}
$conn->close();
?>
