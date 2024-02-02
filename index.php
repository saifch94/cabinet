<?php
session_start();

// Include the database connection file
include('includes/db.php');

// Check if the user is logged in
if (isset($_SESSION['username'])) {
    // If logged in, redirect to the dashboard
    header("Location: dashboard.php");
    exit();
} else {
    // If not logged in, redirect to the login page
    header("Location: .\pages\login.php");
    exit();
}
?>
