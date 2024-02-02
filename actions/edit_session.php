<?php
session_start();

if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'ADMIN') {
    header("Location: ../pages/login.php");
    exit();
}

include('../includes/db.php');

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['sessionId'])) {
    $sessionId = $_GET['sessionId'];

    // Fetch session details
    $sql = "SELECT * FROM Séance WHERE IdS=$sessionId";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $date = $row['DateS'];
        $time = $row['HeureS'];
        $typeSoin = $row['TypeSoin'];
    } else {
        echo "Session not found.";
        exit();
    }
} else {
    echo "Invalid request.";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Handle form submission to update the session
    $date = $_POST['date'];
    $time = $_POST['time'];
    $typeSoin = $_POST['typeSoin'];

    $sql = "UPDATE Séance SET DateS='$date', HeureS='$time', TypeSoin='$typeSoin' WHERE IdS=$sessionId";

    if ($conn->query($sql) === TRUE) {
        header("Location: admin_panel.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<h1>Edit Session</h1>

<form action="" method="post">
    <label for="date">Date:</label>
    <input type="date" name="date" value="<?php echo $date; ?>" required>

    <label for="time">Time:</label>
    <input type="time" name="time" value="<?php echo $time; ?>" required>

    <label for="typeSoin">Type of Treatment:</label>
    <input type="text" name="typeSoin" value="<?php echo $typeSoin; ?>" required>

    <input type="submit" value="Update Session">
</form>

<p><a href='../pages/admin_panel.php'>Back to
