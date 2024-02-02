<?php
session_start();

if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'ADMIN') {
    header("Location: ../pages/login.php");
    exit();
}

// Include database connection file
include('../includes/db.php');
?>

<h1>Welcome to Admin Panel, <?php echo $_SESSION['username']; ?></h1>

<!-- Display sessions list with options to edit or delete -->
<h2>Session List:</h2>
<?php
// Fetch and display Séance data
$sql = "SELECT * FROM Séance";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table border='1'>
            <tr>
                <th>ID</th>
                <th>Date</th>
                <th>Time</th>
                <th>Type of Treatment</th>
                <th>Actions</th>
            </tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['IdS']}</td>
                <td>{$row['DateS']}</td>
                <td>{$row['HeureS']}</td>
                <td>{$row['TypeSoin']}</td>
                <td>
                    <a href='../actions/edit_session.php?sessionId={$row['IdS']}'>Edit</a>
                    |
                    <a href='../actions/delete_session.php?sessionId={$row['IdS']}'>Delete</a>
                </td>
              </tr>";
    }

    echo "</table>";
} else {
    echo "No sessions found.";
}
?>

<!-- Link to add a new session -->
<p><a href='../actions/add_session.php'>Add a New Session</a></p>

<!-- Logout link -->
<p><a href="../logout.php">Logout</a></p>

<?php
?>
