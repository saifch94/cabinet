<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    echo "test";
}
// Check if the user is super admin, if not, redirect to login
// Implement your logic here to check if the user is a super admin

// Display admin dashboard
echo "Welcome Super Admin!";
?>
