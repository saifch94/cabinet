<?php

session_start();

if (!isset($_SESSION['username'])) {
    header("Location: ../pages/login.php");
    exit();
}

$username = $_SESSION['username'];
?>

<h1>Welcome to Your Dashboard, <?php echo $username; ?></h1>
<!-- Display patient-related information, sessions, etc. -->

<a href="../logout.php">Logout</a>

<?php

?>
