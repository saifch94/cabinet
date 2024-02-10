<?php
session_start();

if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'ADMIN') {
    header("Location: ../pages/login.php");
    exit();
}

include('../includes/db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Handle form submission to add a new session
    $date = $_POST['date'];
    $time = $_POST['time'];
    $typeSoin = $_POST['typeSoin'];

    $sql = "INSERT INTO Séance (DateS, HeureS, TypeSoin) VALUES ('$date', '$time', '$typeSoin')";

    if ($conn->query($sql) === TRUE) {
        header("Location: ../pages/admin_panel.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<h1>Add a New Session</h1>

<form action="" method="post">
    <label for="date">Date:</label>
    <input type="date" name="date" required>

    <label for="time">Time:</label>
    <input type="time" name="time" required>

    <label for="typeSoin">Type of Treatment:</label>
    <input type="text" name="typeSoin" required>

    <input type="submit" value="Add Session">
</form>

<p><a href='../pages/admin_panel.php'>Back to Admin Panel</a></p>

<?php
?>
